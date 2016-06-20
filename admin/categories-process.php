<?php
require("includes/includes.php");
	if(sizeof($_POST) > 0) {
		$action = $_POST['action'];
		$data = array(
			'category_name'  =>  $_POST['category_name']
		);

		if($action == 'add') {
			$last_id = insert_category($data);
			$image_error = "";
			if(isset($_FILES) && $_FILES['category_image']['size'] > 0 && validate_image($_FILES['category_image']['name'])) {
				$new_name = create_file_name($data['category_name'] . " " . $last_id);
				$data['category_image'] = $new_name . "." . get_file_extension($_FILES['category_image']['name']);
				$reply = upload_image($_FILES, $new_name);
				if($reply == "yes") {
					$data['category_id'] = $last_id;
					update_category($data);
				} else {
					$image_error = $reply;
				}
			}
			header("Location: categories.php?success=Record Added Successfully. $image_error");
			exit;
		} else if($action == 'edit') {
      $data['category_id'] = $_POST['category_id'] * 1;
			update_category($data);
			$image_error = "";
			if(isset($_FILES) && $_FILES['category_image']['size'] > 0 && validate_image($_FILES['category_image']['name'])) {
				$new_name = create_file_name($data['category_name'] . " " . $data['category_id']);
				$data['category_image'] = $new_name . "." . get_file_extension($_FILES['category_image']['name']);
				$reply = upload_image($_FILES, $new_name);
				if($reply == "yes") {
					update_category($data);
				} else {
					$image_error = $reply;
				}
			}
			header("Location: categories.php?success=Record Updated Successfully. $image_error");
			exit;
		} else {
      die("Something went Wrong.");
    }
	}

function upload_image($file, $name) {
	$_FILES = $file;
	$handle = new upload($_FILES['category_image']);
	if ($handle->uploaded) {
		$handle->file_new_name_body   = strtolower($name);
		$handle->file_safe_name 			= true;
		$handle->image_resize         = true;
		$handle->image_x              = 500;
		$handle->image_ratio_y        = true;
		$handle->dir_auto_create 			= true;
		$handle->file_overwrite				= true;
		$handle->allowed = array("image/*");
		$handle->process("../images/categories");
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
      if(is_numeric($_GET['category_id'])) {
        delete_category($_GET['category_id']);
        header("Location: categories.php?success=Record Deleted Successfully");
      } else {
        header("Location: categories.php?error=Invalid Category ID");
      }
    }
  }
?>
