<?php
function get_categories($config = "") {
  $query = "SELECT * FROM categories " . $config;
  return process_query($query);
}

function get_category($category_id) {
  $query = "SELECT * FROM categories WHERE category_id = " . $category_id * 1;
  $category = process_query($query);
  $result['category'] = $category->fetch_assoc();
  $query = "SELECT * FROM books WHERE book_free = 0 AND category_id = " . $category_id * 1;
  $books = process_query($query);
  $num_rows = $books->num_rows;
	if($num_rows > 0) {
		$result['books'] = array();
		while($book = $books->fetch_assoc()) {
			array_push($result['books'], $book);
		}
  }
	return $result;
}

function get_ads_category($category_id) {
  $query = "SELECT * FROM categories WHERE category_id = " . $category_id * 1;
  $category = process_query($query);
  $result['category'] = $category->fetch_assoc();
  $query = "SELECT * FROM ads WHERE  category_id = " . $category_id * 1;
  $books = process_query($query);
  $num_rows = $books->num_rows;
  if($num_rows > 0) {
    $result['books'] = array();
    while($book = $books->fetch_assoc()) {
      array_push($result['books'], $book);
    }
  }
  return $result;
}

function get_authors($config = "") {
  $query = "SELECT * FROM authors " . $config;
  return process_query($query);
}

function get_author($author_id) {
  $query = "SELECT * FROM authors WHERE author_id = " . $author_id * 1;
  $author = process_query($query);
  $result['author'] = $author->fetch_assoc();
  $query = "SELECT * FROM books WHERE book_free = 0 AND author_id = " . $author_id * 1;
  $books = process_query($query);
  $num_rows = $books->num_rows;
	if($num_rows > 0) {
		$result['books'] = array();
		while($book = $books->fetch_assoc()) {
			array_push($result['books'], $book);
		}
  }
	return $result;
}

function get_publishers($config = "") {
  $query = "SELECT * FROM publishers " . $config;
  return process_query($query);
}

function get_publisher($publisher_id) {
  $query = "SELECT * FROM publishers WHERE publisher_id = " . $publisher_id * 1;
  $publisher = process_query($query);
  $result['publisher'] = $publisher->fetch_assoc();
  $query = "SELECT * FROM books WHERE book_free = 0 AND publisher_id = " . $publisher_id * 1;
  $books = process_query($query);
  $num_rows = $books->num_rows;
	if($num_rows > 0) {
		$result['books'] = array();
		while($book = $books->fetch_assoc()) {
			array_push($result['books'], $book);
		}
  }
	return $result;
}

function get_books($config = "") {
  $query = "SELECT b.*, c.*, p.*, a.* FROM books b
						LEFT JOIN categories c ON b.category_id = c.category_id
						LEFT JOIN publishers p ON b.publisher_id = p.publisher_id
						LEFT JOIN authors a ON b.author_id = a.author_id " . $config;
  $result = process_query($query);
  $num_rows = $result->num_rows;
  if($num_rows > 0) {
    $books = array();
    while($book = $result->fetch_assoc()) {
      array_push($books, $book);
    }
  }
  return $books;
}

function get_book($book_id) {
  $query = "SELECT b.*, c.*, p.*, a.* FROM books b
						LEFT JOIN categories c ON b.category_id = c.category_id
						LEFT JOIN publishers p ON b.publisher_id = p.publisher_id
						LEFT JOIN authors a ON b.author_id = a.author_id
            WHERE book_free = 0 AND b.book_id = " . $book_id * 1;
  $result = process_query($query);
  return $result->fetch_assoc();
}

function get_free_ebook($book_id) {
  $query = "SELECT b.*, c.*, p.*, a.* FROM books b
						LEFT JOIN categories c ON b.category_id = c.category_id
						LEFT JOIN publishers p ON b.publisher_id = p.publisher_id
						LEFT JOIN authors a ON b.author_id = a.author_id
            WHERE book_free = 1 AND b.book_id = " . $book_id * 1;
  $result = process_query($query);
  return $result->fetch_assoc();
}

function get_countries($config = "") {
  $query = "SELECT * FROM countries" . $config;
  $result = process_query($query);
  $num_rows = $result->num_rows;
  if($num_rows > 0) {
    if($num_rows == 1) {
      $countries = $result->fetch_assoc();
    } else {
      $countries = array();
      while($country = $result->fetch_assoc()) {
        array_push($countries, $country);
      }
    }
  }
return $countries;
}

function get_states($config = "") {
  $query = "SELECT * FROM states" . $config;
  $result = process_query($query);
  $num_rows = $result->num_rows;
  $states = array();
  if($num_rows > 0) {
    if($num_rows == 1) {
      $states = $result->fetch_assoc();
    } else {
      $states = array();
      while($state = $result->fetch_assoc()) {
        array_push($states, $state);
      }
    }
  }
return $states;
}

function validate_user_name($user_name) {
  $query = "SELECT * FROM users WHERE user_name = '$user_name'";
  $result = process_query($query);
  $num_rows = $result->num_rows;
  if($num_rows > 0) {
    return true;
  } else {
    return false;
  }
}

function validate_user_email($email) {
  $query = "SELECT * FROM users WHERE user_email = '$email'";
  $result = process_query($query);
  $num_rows = $result->num_rows;
  if($num_rows > 0) {
    return true;
  } else {
    return false;
  }
}

function register_user($data) {
  $query = "INSERT INTO users (user_role_id, country_id, state_id, user_name, user_first_name, user_last_name, user_email, user_password, user_address, user_phone, user_city) VALUES (3, $data[country_id], $data[state_id], '$data[user_name]', '$data[user_first_name]', '$data[user_last_name]', '$data[user_email]', '$data[user_password]', '$data[user_address]', '$data[user_phone]',  '$data[user_city]')";
  return process_query($query, 1);
}

function get_user_role($role_id) {
  $query = "SELECT * FROM user_roles WHERE user_role_id = $role_id";
  $result = process_query($query);
  $num_rows = $result->num_rows;
  if($num_rows > 0) {
    return $result->fetch_assoc();
  } else {
    return false;
  }
}

function add_sale($data) {
  $query = "INSERT INTO sales (user_id, customer_name, customer_email, customer_phone, customer_address, customer_city, customer_state, customer_country, sale_products, delivery_type, delivery_charges, products_total, total_amount) VALUES ($data[user_id], '$data[customer_name]', '$data[customer_email]', '$data[customer_phone]', '$data[customer_address]', '$data[customer_city]', '$data[customer_state]', '$data[customer_country]', '$data[sale_products]', '$data[delivery_type]', $data[delivery_charges], $data[products_total], $data[total_amount])";
  return process_query($query, 1);
}
