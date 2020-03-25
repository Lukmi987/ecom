<?php require_once("../../config.php");

if(isset($_GET['id'])) {
global $conn;
$id = $_GET['id'];
try{
$sql ="DELETE FROM users WHERE user_id = $id";
$stmt = $conn->prepare($sql);
$stmt->execute();
set_message("User deleted");
redirect("../../../public/admin/index.php?users");
} catch(\Exception $e) {
  throw $e;
}
}
