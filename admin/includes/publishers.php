<?php

function get_publishers() {
	$query = "SELECT * FROM publishers";
	$result = process_query($query);

	$num_rows = $result->num_rows;
	if($num_rows > 0) {
		$publishers = array();
		while($publisher = $result->fetch_assoc()) {
			array_push($publishers, $publisher);
		}
		return $publishers;
	} else {
		return FALSE;
	}
}

function get_publisher($publisher_id) {
	$query = "SELECT * FROM publishers WHERE publisher_id = $publisher_id";
	$result = process_query($query);
	if($result->num_rows > 0) {
		return $result->fetch_assoc();
	} else {
		return FALSE;
	}
}

function insert_publisher($data) {
	$query = "INSERT INTO publishers (publisher_name, publisher_phone, publisher_email, publisher_website, publisher_address)
						VALUES ('$data[publisher_name]', '$data[publisher_phone]', '$data[publisher_email]', '$data[publisher_website]', '$data[publisher_address]')";
	return process_query($query, 1);
}

function update_publisher($data) {
	$query = "UPDATE publishers
						SET publisher_name = '$data[publisher_name]',
								publisher_phone = '$data[publisher_phone]',
								publisher_email = '$data[publisher_email]',
								publisher_website = '$data[publisher_website]',
								publisher_address = '$data[publisher_address]'";
	if($data['publisher_logo'] != "") {
		$query .= ", publisher_logo = '$data[publisher_logo]'";
	}
	$query .= "WHERE publisher_id = $data[publisher_id]";
	process_query($query);
}

function delete_publisher($publisher_id) {
	$query = "DELETE FROM publishers
						WHERE publisher_id = $publisher_id";
	process_query($query);
}

 ?>
