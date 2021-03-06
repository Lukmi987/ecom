<?php require_once("../recources/config.php"); ?>

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
    $_SESSION['product_' . $_GET['add']] +=1;   
        redirect('checkout.php');
    } else{
        set_message("We only have" . $row['product_quantity'] . "" . "Available");
        redirect('checkout.php');
    }

 }
}


if(isset($_GET['remove'])){
    
    $_SESSION['product_' . $_GET['remove']]--; //we create the session product_remove in this step
    if($_SESSION['product_' . $_GET['remove']] < 1) {
        unset($_SESSION['item_total']);
        unset($_SESSION['item_quantity']);
        redirect("checkout.php");
    } else{
        redirect("checkout.php");
    }
}

if(isset($_GET['delete'])){
    $_SESSION['product_' . $_GET['delete']] = '0';
    unset($_SESSION['item_total']);
    unset($_SESSION['item_quantity']);

    redirect("checkout.php");
}

function cart(){
global $conn;
    
    $total = 0;
    $item_quantity = 0;
    $item_name = 1;
    $item_number = 1;
    $amount = 1;
    $quantity = 1;
foreach($_SESSION as $name => $value){ 
   if($value > 0){ 
    if(substr($name, 0, 8) == "product_"){

    $id = intval(str_replace("product_", "",$name));  //finds product_  in $name and is replaced by "" , so what is left is the id

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
    
    $sub = $row['product_price'] * $value;
   
    $_SESSION['item_total'] = $total +=$sub;
    $item_quantity += $value;
    
     $product = <<<DELIMETER
     <tr>
                <td>{$row['product_title']}</td>
                <td>&#36;{$row['product_price']}</td>
                <td>{$value}</td>
                <td>&#36;{$sub}</td>
                <td><a class='btn btn-warning' href="cart.php?remove={$row['product_id']}"><span class='glyphicon glyphicon-minus'></span></a>
                <a class='btn btn-success' href="cart.php?add={$row['product_id']}"><span class='glyphicon glyphicon-plus'></span></a>
                </td>
                <td><a class='btn btn-danger' href="cart.php?delete={$row['product_id']}"><span class='glyphicon glyphicon-remove'></span></a></td>
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

?>