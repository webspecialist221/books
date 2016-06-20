<?php
	require_once("includes/includes.php");
	if(isset($_POST) && $_POST['from'] == "add_to_cart") {
		$product = array(
			'book_id'							=> $_POST['book_id'],
			'book_name'						=> $_POST['book_name'],
			'book_price'					=> $_POST['book_price'],
			'book_cover'					=> $_POST['book_cover'],
			'book_edition'				=> $_POST['book_edition'],
			'book_edition_year'		=> $_POST['book_edition_year'],
			'category_name'				=> $_POST['category_name'],
			'publisher_name'			=> $_POST['publisher_name'],
    	'author_name'					=> $_POST['author_name'],
			'copies'							=> $_POST['copies']
		);
		if(!isset($_SESSION['products']) || !is_array($_SESSION['products'])) {
			$_SESSION['products'] = array();
		}
		if(!isset($_SESSION['total_books'])) {
			$_SESSION['total_books'] = 0;
		}
		$_SESSION['total_books'] += $_POST['copies'];
		array_push($_SESSION['products'], $product);
		header("Location: book.php?book_id=$product[book_id]&info=You have added $product[book_name] written by $product[author_name] to cart Successfully. Click on <a href='checkout.php'>Checkout</a> to buy directly or Click on <a href='cart.php'>Cart</a> to view listed products.");
	}
?>
