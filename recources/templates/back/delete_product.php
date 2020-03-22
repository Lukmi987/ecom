<?php require_once("../../config.php");

if(isset($_GET['id'])) {
global $conn;
$id = $_GET['id'];
try{
$sql ="DELETE FROM products WHERE product_id = $id";
$stmt = $conn->prepare($sql);
$stmt->execute();
set_message("Product deleted");
redirect("../../../public/admin/index.php?products");
} catch(\Exception $e) {
  throw $e;
}
}
