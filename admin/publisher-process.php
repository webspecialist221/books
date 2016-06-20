<?php
require("includes/includes.php");
	if(sizeof($_POST) > 0) {
		$action = $_POST['action'];
		$data = array(
			'publisher_name'  =>  $_POST['publisher_name'],
			'publisher_phone'  =>  $_POST['publisher_phone'],
			'publisher_email'  =>  $_POST['publisher_email'],
			'publisher_website'  =>  $_POST['publisher_website'],
			'publisher_address'  =>  $_POST['publisher_address']
		);

		if($action == 'add') {
			$last_id = insert_publisher($data);
			$logo_error = "";
			if(isset($_FILES) && $_FILES['publisher_logo']['size'] > 0 && validate_image($_FILES['publisher_logo']['name'])) {
				$new_name = create_file_name($data['publisher_name'] . " " . $last_id);
				$data['publisher_logo'] = $new_name . "." . get_file_extension($_FILES['publisher_logo']['name']);
				$reply = upload_image($_FILES, $new_name);
				if($reply == "yes") {
					$data['publisher_id'] = $last_id;
					update_publisher($data);
				} else {
					$logo_error = $reply;
				}
			}
			header("Location: publishers.php?success=Record Added Successfully. $logo_error");
			exit;
		} else if($action == 'edit') {
      $data['publisher_id'] = $_POST['publisher_id'] * 1;
			update_publisher($data);
			$logo_error = "";
			if(isset($_FILES) && $_FILES['publisher_logo']['size'] > 0 && validate_image($_FILES['publisher_logo']['name'])) {
				$new_name = create_file_name($data['publisher_name'] . " " . $data['publisher_id']);
				$data['publisher_logo'] = $new_name . "." . get_file_extension($_FILES['publisher_logo']['name']);
				$reply = upload_image($_FILES, $new_name);
				if($reply == "yes") {
					update_publisher($data);
				} else {
					$logo_error = $reply;
				}
			}
			header("Location: publishers.php?success=Record Updated Successfully. $logo_error");
			exit;
		} else {
      die("Something went Wrong.");
    }
	}

function upload_image($file, $name) {
	$_FILES = $file;
	$handle = new upload($_FILES['publisher_logo']);
	if ($handle->uploaded) {
		$handle->file_new_name_body   = strtolower($name);
		$handle->file_safe_name 			= true;
		$handle->image_resize         = true;
		$handle->image_x              = 200;
		$handle->image_ratio_y        = true;
		$handle->dir_auto_create 			= true;
		$handle->file_overwrite				= true;
		$handle->allowed = array("image/*");
		$handle->process("../images/publishers");
		if ($handle->processed) {
			$handle->clean();
			return "yes";
		} else {
			return $handle->error;
		}
	}
}

  if(sizeof($_GET) > 0) {
    $action = $_GET['action'];
    if($action = "delete") {
      if(is_numeric($_GET['publisher_id'])) {
        delete_publisher($_GET['publisher_id']);
        header("Location: publishers.php?success=Record Deleted Successfully");
      } else {
        header("Location: publishers.php?error=Invalid Publisher ID");
      }
    }
  }
?>
