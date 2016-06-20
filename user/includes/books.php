<?php
////////////////////////
function get_user_books($userid) {
	$query = "SELECT b.*, c.*, a.*,u.* FROM ads b
						LEFT JOIN categories c ON b.book_category_id = c.category_id
						LEFT JOIN authors a ON b.book_auther= a.author_id
						LEFT JOIN users u ON b.user_id = u.user_id
						WHERE b.user_id='$userid'";
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


//////////////////////////////////////////
function get_books() {
	$query = "SELECT b.*, c.*, p.*, a.* FROM ads b
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
	$query = "SELECT b.*, c.*, a.* FROM ads b 
					LEFT JOIN categories c ON b.book_category_id = c.category_id 
					LEFT JOIN authors a ON b.book_auther = a.author_id 
					WHERE b.id = $book_id";
	$result = process_query($query);
	//var_dump($query);
	if($result->num_rows > 0) {
		return $result->fetch_assoc();
	} else {
		return FALSE;
	}
}

function insert_book($data) {
	 $query = "INSERT INTO ads (user_id,book_category_id, book_name, book_auther, book_edition, orginal_price, sale_price)
						VALUES ('$data[user_id]','$data[book_category_id]', '$data[book_name]', '$data[book_auther]', '$data[book_edition]', '$data[orginal_price]', $data[sale_price])";
						//var_dump($query); exit();
	return process_query($query, 1);
}

function update_book($data) {
	//var_dump($data);exit();
	$query = "UPDATE ads
						SET 
						user_id = '$data[user_id]',
						book_category_id = '$data[book_category_id]',
								book_name = '$data[book_name]',
								book_auther = '$data[book_auther]',
								book_edition = '$data[book_edition]',
								orginal_price = '$data[orginal_price]',
								sale_price = '$data[sale_price]'";
	if(isset($data['book_cover']) && $data['book_cover'] != "") {
		$query .= ", book_cover = '$data[book_cover]'";
	}
	 $query .= "WHERE id = '$data[book_id]'";
	 //var_dump($query);exit();
	process_query($query);
}

function delete_book($book_id) {
	$query = "DELETE FROM ads
						WHERE id = $book_id";
	process_query($query);
}
function insert_book_ads($data){
	//print_r($data); exit();
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "pak_books";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password , $dbname);

	// Check connection
	if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
	} 
	$sql="INSERT INTO ads (user_id,book_category_id, book_name, book_auther, book_edition, orginal_price, sale_price)
						VALUES ($data[user_id],$data[book_category_id], $data[book_name], $data[book_auther], '$data[book_edition]', '$data[orginal_price]', $data[sale_price])";
						/*var_dump($sql);
						exit();*/
	$query = mysqli_query($conn,$sql);
    //$result = mysqli_fetch_assoc($query);

}

 ?>
