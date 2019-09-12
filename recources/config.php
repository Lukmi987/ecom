<?php

ob_start(); //output buffaring it will send a lot of request at the same time
//if we use header() and do not have ob_start it will throw error like header has been already sent

session_start();
//session_destroy(); //for testing purpuses only

defined("DS") ? null : define("DS", DIRECTORY_SEPARATOR);
defined("TEMPLATE_FRONT") ? null : define("TEMPLATE_FRONT", __DIR__ . DS . "templates" . DS . "front");
defined("TEMPLATE_BACK") ? null : define("TEMPLATE_BACK", __DIR__ . DS . "templates" . DS . "back");


// defined("DB_HOST") ? null : define("DB_HOST","localhost");
// defined("DB_USER") ? null : define("DB_USER","root");
// defined("DB_PASS") ? null : define("DB_PASS","");
// defined("DB_NAME") ? null : define("DB_NAME","ecom_db");


$host="localhost";
$db="ecom_db";
$username="root";
$password="";

$dsn = "mysql:host=$host;dbname=$db";

try{
	$conn = new PDO($dsn, $username,$password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
} catch (Exception $e){
	echo $e->getMessage();
	die();
	
}

require_once("functions.php");
require_once("cart.php");