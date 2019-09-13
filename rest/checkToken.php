<?php 
	include("../database/connect.php");
	$data = json_decode(file_get_contents("php://input"));
	$token = trim($data->token, '"');
	//json_encode($token);
	$check = $db->query("SELECT live_token From emp_details WHERE live_token='$token'");
	//echo json_encode($check);
	$check = $check->fetchAll();
	//echo json_encode(count($check));
	if(count($check) == 1){
		echo "authorized";
	} else {
		echo "unauthorized";
	}
?>