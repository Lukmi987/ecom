<?php require_once("../../config.php");

if(isset($_GET['id'])) {
global $conn;
$id = $_GET['id'];
try{
$sql ="DELETE FROM orders WHERE order_id = $id";
$stmt = $conn->prepare($sql);
$stmt->execute();
set_message("Order deleted");
redirect("../../../public/admin/index.php?orders");
} catch(\Exception $e) {
  throw $e;
}
}
