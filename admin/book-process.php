<?php
require("includes/includes.php");
	if(sizeof($_POST) > 0) {
		$action = $_POST['action'];
		$data = array(
			'publisher_id'  =>  intval($_POST['publisher_id']) * 1,
			'author_id'  =>  intval($_POST['author_id']) * 1,
			'category_id'  =>  intval($_POST['category_id']) * 1,
			'book_name'  =>  $_POST['book_name'],
			'book_preface'  =>  $_POST['book_preface'],
			'book_edition'  =>  $_POST['book_edition'],
			'book_edition_year'  =>  intval($_POST['book_edition_year'])
		);
		if(isset($_POST['book_price'])) {
			$data['book_price'] = floatval($_POST['book_price']) * 1;
		} else {
			$data['book_price'] = -1;
		}
		if(isset($_POST['book_free'])) {
			$data['book_free'] = 1;	// Free Book
		} else {
			$data['book_free'] = 0;	// Paid Book
		}
		if($action == 'add') {
			$last_id = insert_book($data);

			// Upload Image Code
			$image_error = "";
			if(isset($_FILES) && $_FILES['book_cover']['size'] > 0 && validate_image($_FILES['book_cover']['name'])) {
				$new_name = create_file_name($data['book_name'] . " " . $last_id);
				$data['book_cover'] = $new_name . "." . get_file_extension($_FILES['book_cover']['name']);
				$reply = upload_image($_FILES, $new_name);
				if($reply == "yes") {
					$data['book_id'] = $last_id;
					update_book($data);
				} else {
					$image_error = $reply;
				}
			}

			// Upload Free eBook Code
			$ebook_error = "";
			if(isset($_FILES) && $_FILES['book_ebook']['size'] > 0 && validate_pdf($_FILES['book_ebook']['name'])) {
				$new_name = create_file_name($data['book_name'] . " " . $last_id);
				$data['book_ebook'] = $new_name . "." . get_file_extension($_FILES['book_ebook']['name']);
				$reply = upload_ebook($_FILES, $new_name);
				if($reply == "yes") {
					$data['book_id'] = $last_id;
					update_book($data);
				} else {
					$ebook_error = $reply;
				}
			}
			header("Location: books.php?success=Record Added Successfully. $image_error $ebook_error");
			exit;
		} else if($action == 'edit') {
      $data['book_id'] = $_POST['book_id'] * 1;
			update_book($data);

			// Upload Image Code
			$image_error = "";
			if(isset($_FILES) && $_FILES['book_cover']['size'] > 0 && validate_image($_FILES['book_cover']['name'])) {
				$new_name = create_file_name($data['book_name'] . " " . $data['book_id']);
				$data['book_cover'] = $new_name . "." . get_file_extension($_FILES['book_cover']['name']);
				$reply = upload_image($_FILES, $new_name);
				if($reply == "yes") {
					update_book($data);
				} else {
					$image_error = $reply;
				}
			}

			// Upload Free e-Book Code
			$ebook_error = "";
			if(isset($_FILES) && $_FILES['book_ebook']['size'] > 0 && validate_pdf($_FILES['book_ebook']['name'])) {
				$new_name = create_file_name($data['book_name'] . " " . $data['book_id']);
				$data['book_ebook'] = $new_name . "." . get_file_extension($_FILES['book_ebook']['name']);
				$reply = upload_ebook($_FILES, $new_name);
				if($reply == "yes") {
					$data['book_id'] = $data['book_id'];
					update_book($data);
				} else {
					$ebook_error = $reply;
				}
			}
			header("Location: books.php?success=Record Updated Successfully. $image_error $ebook_error");
			exit;
		} else {
      die("Something went Wrong.");
    }
	}

function upload_image($file, $name) {
	$_FILES = $file;
	$handle = new upload($_FILES['book_cover']);
	if ($handle->uploaded) {
		$handle->file_new_name_body   = strtolower($name);
		$handle->file_safe_name 			= true;
		$handle->image_resize         = true;
		$handle->image_x              = 200;
		$handle->image_ratio_y        = true;
		$handle->dir_auto_create 			= true;
		$handle->file_overwrite				= true;
		$handle->allowed = array("image/*");
		$handle->process("../images/books");
		if ($handle->processed) {
			$handle->clean();
			return "yes";
		} else {
			return $handle->error;
		}
	}
}

function upload_ebook($file, $name) {
	$_FILES = $file;
	$handle = new upload($_FILES['book_ebook']);
	if ($handle->uploaded) {
		$handle->file_new_name_body   = strtolower($name);
		$handle->file_safe_name 			= true;
		$handle->dir_auto_create 			= true;
		$handle->file_overwrite				= true;
		$handle->allowed = array("application/pdf");
		$handle->process("../e-books");
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
      if(is_numeric($_GET['book_id'])) {
        delete_book($_GET['book_id']);
        header("Location: books.php?success=Record Deleted Successfully");
      } else {
        header("Location: books.php?error=Invalid Book ID");
      }
    }
  }
?>
