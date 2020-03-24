<?php require_once("../../config.php");

if(isset($_GET['id'])) {
global $conn;
$id = $_GET['id'];
try{
$sql ="DELETE FROM categories WHERE cat_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bindParam(1,$id);
$stmt->execute();
set_message("Category deleted");
redirect("../../../public/admin/index.php?categories");
} catch(\Exception $e) {
  throw $e;
}
}
