<?php

function get_authors() {
	$query = "SELECT * FROM authors";
	$result = process_query($query);

	$num_rows = $result->num_rows;
	if($num_rows > 0) {
		$authors = array();
		while($author = $result->fetch_assoc()) {
			array_push($authors, $author);
		}
		return $authors;
	} else {
		return FALSE;
	}
}

function get_author($author_id) {
	$query = "SELECT * FROM authors WHERE author_id = $author_id";
	$result = process_query($query);
	if($result->num_rows > 0) {
		return $result->fetch_assoc();
	} else {
		return FALSE;
	}
}

function insert_author($data) {
	$query = "INSERT INTO authors (author_name, author_phone, author_email, author_website, author_address)
						VALUES ('$data[author_name]', '$data[author_phone]', '$data[author_email]', '$data[author_website]', '$data[author_address]')";
	return process_query($query, 1);
}

function update_author($data) {
	$query = "UPDATE authors
						SET author_name = '$data[author_name]',
								author_phone = '$data[author_phone]',
								author_email = '$data[author_email]',
								author_website = '$data[author_website]',
								author_address = '$data[author_address]',
								author_biography = '$data[author_biography]'";
	if($data['author_image'] != "") {
		$query .= ", author_image = '$data[author_image]'";
	}
	$query .= "WHERE author_id = $data[author_id]";
	process_query($query);
}

function delete_author($author_id) {
	$query = "DELETE FROM authors
						WHERE author_id = $author_id";
	process_query($query);
}

 ?>
