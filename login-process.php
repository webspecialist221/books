<?php
	require_once("includes/includes.php");

	if(isset($_GET['action']) && ($_GET['action'] == "logout" || $_GET['action'] == "login")) {
		$action = $_GET['action'];
	}

	if($action == "logout") {
		unset($_SESSION['user_id']);
		unset($_SESSION['user_name']);
		unset($_SESSION['full_name']);
		unset($_SESSION['role_id']);
		unset($_SESSION['role_name']);

		header("location: index.php");
	} else if($action == "login") {
		view_array($_POST);
		$data = array(
			'user_name'			=>	$_POST['username'],
			'user_password'	=>	create_password($_POST['password'])
		);

		$user = validate_user($data);

		$_SESSION = array(
			'user_id'			=>	$user['user_id'],
			'user_name'		=>	$user['user_name'],
			'full_name'		=>	"$user[user_first_name] $user[user_last_name]",
			'role_id'			=>	$user['user_role_id'],
			'role_name'		=>	$user['user_role'],
		);
		header("location: index.php");
	} else {
		die("some error occured");
	}
?>
