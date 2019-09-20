<?php require_once("../recources/config.php");

 include(TEMPLATE_FRONT . DS . "header.php");
?>


  <?php 
  if(isset($_GET['tx'])){
    $amount = $_GET['amt'];
    $currency = $_GET['cc'];
    $transaction = $_GET['tx'];
    $status = $_GET['st'];}

//     try{
//       $sql = "INSERT INTO orders (order_amount, order_transaction, order_status, order_currency) VALUES(?,?,?,?)";
//       $stmt = $conn->prepare($sql);
//       $stmt->bindParam(1,$amount);
//       $stmt->bindParam(2,$transaction);
//       $stmt->bindParam(3,$status);
//       $stmt->bindParam(4,$currency);
//       $stmt->execute();
//     } catch(\Exception $e){
//         throw $e;
//     }
//   } else{
//   //redirect('index.php');
// }

report();


?>
    <!-- Page Content -->
    <div class="container">


<h1>Thank You</h1>

 </div><!--Main Content-->


<?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>         
