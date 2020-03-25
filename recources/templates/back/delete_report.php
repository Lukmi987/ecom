<?php require_once("../../config.php");

if(isset($_GET['id'])) {
global $conn;
$id = $_GET['id'];
try{
$sql ="DELETE FROM reports WHERE report_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bindParam(1,$id);
$stmt->execute();
set_message("Report deleted");
redirect("../../../public/admin/index.php?reports");
} catch(\Exception $e) {
  throw $e;
}
}
