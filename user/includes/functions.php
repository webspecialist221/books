<?php
function view_array($data, $flag = FALSE) {
	echo "<pre>";
	print_r($data);
	echo "</pre>";
	if($flag == TRUE)
		die;
}
function process_query($query, $last_insert_id = FALSE) {
	$conn = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE_NAME);

  /* check connection */
  if ($conn->connect_errno) {
    printf("Connect failed: %s\n", $conn->connect_error);
    exit();
  }

	$result = $conn->query($query);
	if($last_insert_id) {
		return $conn->insert_id;
	} else {
		return $result;
	}
  /* If we have to retrieve large amount of data we use MYSQLI_USE_RESULT */
}

/* function last_insert_id() {
	$query = "select last_insert_id() as last_insert_id";
	$result = process_query($query);
	view_array($result, 1);
	// return $conn->insert_id;
} SOME FISHI THINGS*/

function get_configuration() {
  $query = "SELECT * FROM config";
	$result = process_query($query);
  while($row = $result->fetch_assoc()) {
    $config_name = $row['config_name'];
    $config_value = $row['config_value'];
    define($config_name, $config_value);
  }
}

function base_url($uri = "") {
	return WEBSITE_ADDRESS . $uri;
}

function admin_url($uri = "") {
	return WEBSITE_ADDRESS . "admin/" . $uri;
}

function page_name() {
	return basename($_SERVER['PHP_SELF']);
}

function create_file_name($name) {
	return strtolower(str_replace(" ", "_", $name));
}

function validate_user() {
	if(!isset($_SESSION) || !isset($_SESSION['user_id']) || !isset($_SESSION['user_name']) || !isset($_SESSION['full_name']) || !isset($_SESSION['role_id']) || !isset($_SESSION['role_name']) || $_SESSION['role_id'] < 3) {
		header("location: " . base_url("login-register.php"));
		exit;
	}
}

function create_password($password) {
	return md5($password . SALT);
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

?>
