<?php

function get_books() {
	$query = "SELECT b.*, c.*, p.*, a.* FROM books b
						LEFT JOIN categories c ON b.category_id = c.category_id
						LEFT JOIN publishers p ON b.publisher_id = p.publisher_id
						LEFT JOIN authors a ON b.author_id = a.author_id";
	$result = process_query($query);

	$num_rows = $result->num_rows;
	if($num_rows > 0) {
		$books = array();
		while($book = $result->fetch_assoc()) {
			array_push($books, $book);
		}
		return $books;
	} else {
		return FALSE;
	}
}

function get_book($book_id) {
	$query = "SELECT b.*, c.*, p.*, a.* FROM books b
						LEFT JOIN categories c ON b.category_id = c.category_id
						LEFT JOIN publishers p ON b.publisher_id = p.publisher_id
						LEFT JOIN authors a ON b.author_id = a.author_id
						WHERE b.book_id = $book_id";
	$result = process_query($query);
	if($result->num_rows > 0) {
		return $result->fetch_assoc();
	} else {
		return FALSE;
	}
}

function insert_book($data) {
	$query = "INSERT INTO books (publisher_id, author_id, category_id, book_name, book_preface, book_price, book_edition, book_edition_year, book_free)
						VALUES ($data[publisher_id], $data[author_id], $data[category_id], '$data[book_name]', '$data[book_preface]', $data[book_price], '$data[book_edition]', $data[book_edition_year], $data[book_free])";
	return process_query($query, 1);
}

function update_book($data) {
	$query = "UPDATE books
						SET publisher_id = $data[publisher_id],
								author_id = $data[author_id],
								category_id = $data[category_id],
								book_name = '$data[book_name]',
								book_preface = '$data[book_preface]',
								book_price = '$data[book_price]',
								book_edition = '$data[book_edition]',
								book_edition_year = '$data[book_edition_year]'";
	if(isset($data['book_cover']) && $data['book_cover'] != "") {
		$query .= ", book_cover = '$data[book_cover]'";
	}
	if(isset($data['book_ebook']) && $data['book_ebook'] != "") {
		$query .= ", book_ebook = '$data[book_ebook]'";
	}
	$query .= "WHERE book_id = $data[book_id]";
	process_query($query);
}

function delete_book($book_id) {
	$query = "DELETE FROM books
						WHERE book_id = $book_id";
	process_query($query);
}

 ?>
