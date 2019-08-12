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
        redirect("checkout.php");
    } else{
        redirect("checkout.php");
    }
}

if(isset($_GET['delete'])){
    $_SESSION['product_' . $_GET['delete']] = '0';
    redirect("checkout.php");
}

function cart(){
global $conn;
    try{
        $sql = "SELECT * FROM products";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }catch(\Exception $e){
        throw $e;
    }

foreach ($result as $row) {
     $product = <<<DELIMETER
     <tr>
                <td>{$row['product_title']}</td>
                <td>$23</td>
                <td>3</td>
                <td>2</td>
                <td><a class='btn btn-warning' href="cart.php?remove={$row['product_id']}"><span class='glyphicon glyphicon-minus'></span></a>
                <a class='btn btn-success' href="cart.php?add={$row['product_id']}"><span class='glyphicon glyphicon-plus'></span></a>
                </td>
                <td><a class='btn btn-danger' href="cart.php?delete={$row['product_id']}"><span class='glyphicon glyphicon-remove'></span></a></td>
    </tr>
DELIMETER;
echo $product;
    }
}



// if(isset($_GET['add'])){
//         $_SESSION['product_' . $_GET['add']] +=1;
//         redirect("index.php");


?>