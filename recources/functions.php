<?php

function redirect ($location){
	header("Location: $location");
}

function query($sql) {
	global $conn; // if I want to  bring it inside a func I need to use global
	$stmt = $conn->prepare($sql); 
    return $stmt->execute();
}

function escape_string($string){
	global $conn;
	return $conn->quote($string);
}

function fetch_array($result){
	return $result->fetchAll(PDO::FETCH_ASSOC);
}
