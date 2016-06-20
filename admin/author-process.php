<?php
require("includes/includes.php");
	if(sizeof($_POST) > 0) {
		$action = $_POST['action'];
		$data = array(
			'author_name'  =>  $_POST['author_name'],
			'author_phone'  =>  $_POST['author_phone'],
			'author_email'  =>  $_POST['author_email'],
			'author_website'  =>  $_POST['author_website'],
			'author_address'  =>  $_POST['author_address'],
			'author_biography'  =>  $_POST['author_biography']
		);

		if($action == 'add') {
			$last_id = insert_author($data);
			$image_error = "";
			if(isset($_FILES) && $_FILES['author_image']['size'] > 0 && validate_image($_FILES['author_image']['name'])) {
				$new_name = create_file_name($data['author_name'] . " " . $last_id);
				$data['author_image'] = $new_name . "." . get_file_extension($_FILES['author_image']['name']);
				$reply = upload_image($_FILES, $new_name);
				if($reply == "yes") {
					$data['author_id'] = $last_id;
					update_author($data);
				} else {
					$image_error = $reply;
				}
			}
			header("Location: authors.php?success=Record Added Successfully. $image_error");
			exit;
		} else if($action == 'edit') {
      $data['author_id'] = $_POST['author_id'] * 1;
			update_author($data);
			$image_error = "";
			if(isset($_FILES) && $_FILES['author_image']['size'] > 0 && validate_image($_FILES['author_image']['name'])) {
				$new_name = create_file_name($data['author_name'] . " " . $data['author_id']);
				$data['author_image'] = $new_name . "." . get_file_extension($_FILES['author_image']['name']);
				$reply = upload_image($_FILES, $new_name);
				if($reply == "yes") {
					update_author($data);
				} else {
					$image_error = $reply;
				}
			}
			header("Location: authors.php?success=Record Updated Successfully. $image_error");
			exit;
		} else {
      die("Something went Wrong.");
    }
	}

function upload_image($file, $name) {
	$_FILES = $file;
	$handle = new upload($_FILES['author_image']);
	if ($handle->uploaded) {
		$handle->file_new_name_body   = strtolower($name);
		$handle->file_safe_name 			= true;
		$handle->image_resize         = true;
		$handle->image_x              = 200;
		$handle->image_ratio_y        = true;
		$handle->dir_auto_create 			= true;
		$handle->file_overwrite				= true;
		$handle->allowed = array("image/*");
		$handle->process("../images/authors");
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
      if(is_numeric($_GET['author_id'])) {
        delete_author($_GET['author_id']);
        header("Location: authors.php?success=Record Deleted Successfully");
      } else {
        header("Location: authors.php?error=Invalid Author ID");
      }
    }
  }
?>
