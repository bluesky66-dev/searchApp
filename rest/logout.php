<?php 
	include("../database/connect.php");
	$data = json_decode(file_get_contents('php://input'));
	$token = $data->token;
	$q = $db->query("UPDATE emp_details SET live_token='LOGGED OUT' WHERE live_token=$token");
?>