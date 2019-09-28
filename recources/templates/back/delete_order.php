 <?php require_once("../../config.php");

 if(isset($_GET['id'])){
 	$orderId = $_GET['id'];
 try{
 	$sql = "DELETE FROM orders WHERE order_id = ?";
 	$stmt = $conn->prepare($sql);
 	$stmt->bindParam(1,$orderId);
 	$stmt->execute(); 
 	set_message('Order has been deleted');
 	redirect("../../../public/admin/index.php?orders");
 }catch(\Exception $e){
 	throw $e;
 	}
 	redirect("../../../public/admin/index.php?orders");
}

 ?>