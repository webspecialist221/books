<?php
	require_once("includes/includes.php");
	if($_POST['user_password'] != $_POST['confirm_password']) {
		header("location: login-register.php?error=Password Confirmation Failed.");
		exit;
	} else {
		$data = array(
			"user_name"					=> $_POST['user_name'],
	    "user_first_name"		=> $_POST['user_first_name'],
	    "user_last_name"		=> $_POST["user_last_name"],
	    "user_email"				=> $_POST['user_email'],
			"user_phone"				=> $_POST['user_phone'],
	    "country_id"				=> $_POST['country_id'],
	    "state_id"					=> $_POST['customer_state'],
	    "user_city"					=> $_POST['user_city'],
	    "user_address"			=> $_POST['user_address'],
	    "user_password"			=> create_password($_POST['user_password']),
		);

		if(validate_user_name($data['user_name'])) {
			header("location: login-register.php?info=Username Already exist. Select another username.");
			exit;
		}

		if(validate_user_email($data['user_email'])) {
			header("location: login-register.php?info=Email Already Registered.");
			exit;
		}
		$data['user_id'] = register_user($data);
		$role = get_user_role(3);
		
		$_SESSION['user_id'] = $data['user_id'];
		$_SESSION['user_name'] = $data['user_name'];
		$_SESSION['full_name'] = "$data[user_first_name] $data[user_last_name]";
		$_SESSION['role_id'] = $role['user_role_id'];
		$_SESSION['role_name'] = $role['user_role'];
		header("location: index.php");
	}


?>
