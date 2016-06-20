<?php

function get_categories() {
	$query = "SELECT * FROM categories";
	$result = process_query($query);

	$num_rows = $result->num_rows;
	if($num_rows > 0) {
		$categories = array();
		while($category = $result->fetch_assoc()) {
			array_push($categories, $category);
		}
		return $categories;
	} else {
		return FALSE;
	}
}

function get_category($category_id) {
	$query = "SELECT * FROM categories WHERE category_id = $category_id";
	$result = process_query($query);
	if($result->num_rows > 0) {
		return $result->fetch_assoc();
	} else {
		return FALSE;
	}
}

function insert_category($data) {
	$query = "INSERT INTO categories (category_name) VALUES ('$data[category_name]')";
	return process_query($query, 1);
}

function update_category($data) {
	$query = "UPDATE categories
						SET category_name = '$data[category_name]'";
	if($data['category_image'] != "") {
		$query .= ", category_image = '$data[category_image]'";
	}
	$query .= "WHERE category_id = $data[category_id]";
	process_query($query);
}

function delete_category($category_id) {
	$query = "DELETE FROM categories
						WHERE category_id = $category_id";
	process_query($query);
}

 ?>
