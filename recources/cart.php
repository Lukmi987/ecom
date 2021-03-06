<?php require_once("config.php"); ?>

<?php
if(isset($_GET['add'])){

try{
    $sql = "SELECT * FROM products WHERE product_id = ?";
   $stmt =  $conn->prepare($sql);
   $stmt->bindParam(1, $_GET['add']);
   $stmt->execute();
   $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}catch(\Exception $e){
    throw $e;
}
//($_SESSION['product_' . $_GET['add']]);
foreach ($result as $row) {
    //So we are comparing the value in that session superglobal under the key for example: product_1 , which means we are not comparing the product_1  string against the quantity! But the value of it.


    if($row['product_quantity'] != $_SESSION['product_' . $_GET['add']]){ //we can add the product till it reaches the real quantity in our db
    $_SESSION['product_' . $_GET['add']] +=1; //in GET add session is current product_id
        redirect('../public/checkout.php');
    } else{
        set_message("We only have" . $row['product_quantity'] . "" . "Available");
        redirect('../public/checkout.php');
    }

 }
}


if(isset($_GET['remove'])){

    $_SESSION['product_' . $_GET['remove']]--;
    //var_dump($_SESSION['product_' . $_GET['remove']]); //in the session is product_ and the value in GET request so number 1
    if($_SESSION['product_' . $_GET['remove']] < 1) {
        unset($_SESSION['item_total']);
        unset($_SESSION['item_quantity']);
        redirect("../public/checkout.php");
    } else{
        redirect("../public/checkout.php");
    }
}

if(isset($_GET['delete'])){
    $_SESSION['product_' . $_GET['delete']] = '0';
    unset($_SESSION['item_total']);
    unset($_SESSION['item_quantity']);

    redirect("../public/checkout.php");
}

function cart(){
global $conn;

    $total = 0;
    $item_quantity = 0;
    $item_name = 1;
    $item_number = 1;
    $amount = 1;
    $quantity = 1;
    $products_id = [];

foreach($_SESSION as $name => $value){
//  var_dump($_SESSION[$name]);

   if($value > 0){
    if(substr($name, 0, 8) == "product_"){ //$value from from assoc array, but just from first index it needs to be equal product_

    $id = intval(str_replace("product_", "",$name));  //finds product_  in $name(representing kyes in asssoc array) and is replaced by "" , so what is left is the id
   $products_id[]= $id;

    try{
        $sql = "SELECT * FROM products WHERE product_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }catch(\Exception $e){
        throw $e;
    }


foreach ($result as $row) {

    $sub = $row['product_price'] * $value; //value is current quantity

    $_SESSION['item_total'] = $total +=$sub;
    $item_quantity += $value;

    $product_image = display_image($row['product_image']);
     $product = <<<DELIMETER
     <tr>
                <td>{$row['product_title']}<br>
                <img width='100' src="../recources/{$product_image}">
                </td>
                <td>&#36;{$row['product_price']}</td>
                <td>{$value}</td>
                <td>&#36;{$sub}</td>
                <td><a class='btn btn-warning' href="../recources/cart.php?remove={$row['product_id']}"><span class='glyphicon glyphicon-minus'></span></a>
                <a class='btn btn-success' href="../recources/cart.php?add={$row['product_id']}"><span class='glyphicon glyphicon-plus'></span></a>
                </td>
                <td><a class='btn btn-danger' href="../recources/cart.php?delete={$row['product_id']}"><span class='glyphicon glyphicon-remove'></span></a></td>
    </tr>

<input type="hidden" name="item_name_{$item_name}" value="{$row['product_title']}">
<input type="hidden" name="item_number_{$item_number}" value="{$row['product_id']}">
<input type="hidden" name="amount_{$amount}" value="{$row['product_price']}">
<input type="hidden" name="quantity_{$quantity}" value="{$value}">

DELIMETER;
echo $product;

// variables for paypal name attribute
    $item_name++;
    $item_number++;
    $amount++;
    $quantity++;

    }

        $_SESSION['item_quantity'] = $item_quantity;

   } // end of if substr condition
  } // end if value >0

 }// end of for each $session loop
 $_SESSION['productsid'] = $products_id;
 // print_r($_SESSION['productsid']);
 // print_r($_SESSION['item_quantity']);
 // exit();
}

// in each input field in name attr we need to have an underscore just to provide paypal  a different item


function show_paypal(){
if(isset($_SESSION['item_quantity']) && ($_SESSION['item_quantity'] >= 1)){

    $paypal_button = <<<DELIMETER

    <input type="image" name="upload"
    src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
    alt="PayPal - The safer, easier way to pay online">

DELIMETER;

return $paypal_button;
    }
}



function proccess_transaction(){
global $conn;

if(isset($_GET['tx'])){
    $amount = $_GET['amt'];
    $currency = $_GET['cc'];
    $transaction = $_GET['tx'];
    $status = $_GET['st'];
// for one order transaction i can have multiple products in a cart
    $lastId = 0;
    try{ //insert current order into db
      $sql = "INSERT INTO orders (order_amount, order_transaction, order_currency, order_status) VALUES(?,?,?,?)";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(1,$amount);
      $stmt->bindParam(2,$transaction);
      $stmt->bindParam(3,$currency);
      $stmt->bindParam(4,$status);
      $stmt->execute();
      $lastId = intval($conn->lastInsertId());
    } catch(\Exception $e){
        throw $e;
    }

    $total = 0;
    $item_quantity = 0;

foreach($_SESSION as $name => $value){
   if($value > 0){
    if(substr($name, 0, 8) == "product_"){
    $id = intval(str_replace("product_", "",$name));  //finds product_  in $name and is replaced by "" , so what is left is the id


    try{ //fetch the product according current id
        $sql = "SELECT * FROM products WHERE product_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }catch(\Exception $e){
        throw $e;
    }


foreach ($result as $row) {
    $sub = $row['product_price'] * $value;
    $product_title = $row['product_title'];
    $item_quantity += $value;
    try{
        $sql ="INSERT INTO reports(product_id,order_id,product_price,product_title,product_quantity) VALUES(?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1,$id);
        $stmt->bindParam(2,$lastId);
        $stmt->bindParam(3,$row['product_price']);
        $stmt->bindParam(4,$product_title);
        $stmt->bindParam(5,$value);
        $stmt->execute();
    }catch(\Exception $e){
            throw $e;
        }
    }
        $total += $sub;
        echo $item_quantity;
    } // end of if substr condition
   } // end if value >0
  }// end of for each $session loop
 } // isset get[tx]
}
?>
