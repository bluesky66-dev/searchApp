<?php 
include('../database/connect.php');
$data = json_decode(file_get_contents('php://input'));

	$username = $data->username;
	$password = sha1($data->password);

	$userInfo = $db->query("SELECT username From emp_details WHERE username='$username' AND password='$password'");
	$userInfo = $userInfo->fetchAll();

	$token;
	if(count($userInfo) == 1){
		//This means that the user is logged in and let's give a token :D :D
		$token = $username."|".uniqid().uniqid().uniqid();
		$q = "UPDATE emp_details SET live_token=:token WHERE username=:username AND password=:password";
		$query = $db->prepare($q);
		$execute = $query->execute(array(
				":token" => $token,
				":username" => $username,
				":password" => $password
			));
		echo json_encode($token);
	} else {
		echo "ERROR";
	}
	
?>