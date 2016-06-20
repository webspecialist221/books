<?php
require("includes/includes.php");
	if($_SESSION['role_id'] != 1) {
			header("location: index.php");
	}
	if(sizeof($_POST) > 0) {
		$action = $_POST['action'];
		$data = array(
			'user_role_id'			=>	$_POST['user_role_id'],
			'country_id'				=>	$_POST['country_id'],
			'state_id'					=>	$_POST['state_id'],
			'user_name'  				=>  $_POST['user_name'],
			'user_first_name'		=>	$_POST['user_first_name'],
			'user_last_name'		=>	$_POST['user_last_name'],
			'user_email'  			=>  $_POST['user_email'],
			'user_phone'			  =>  $_POST['user_phone'],
			'user_city'			  	=>  $_POST['user_city'],
			'user_address'			=>	$_POST['user_address'],
			'user_password'			=>	$_POST['user_password'],
			'conform_password'	=>	$_POST['confirm_password']
		);

		if($action == 'add') {
			$last_id = insert_user($data);
			header("Location: users.php?success=Record Added Successfully.");
			exit;
		} else if($action == 'edit') {
      $data['user_id'] = $_POST['user_id'] * 1;
			update_user($data);
			header("Location: users.php?success=Record Updated Successfully.");
			exit;
		} else {
      die("Something went Wrong.");
    }
	}

  if(sizeof($_GET) > 0) {
    $action = $_GET['action'];
    if($action = "delete") {
      if(is_numeric($_GET['user_id'])) {
        delete_user($_GET['user_id']);
        header("Location: users.php?success=Record Deleted Successfully");
      } else {
        header("Location: users.php?error=Invalid User ID");
      }
    }
  }
?>
