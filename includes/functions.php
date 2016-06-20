<?php
function add_comments($bookid, $name, $comment){
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
	$sql="INSERT INTO comments (book_id, comment_user_name, user_comment) VALUES ( '$bookid', '$name', '$comment')";
	$query = mysqli_query($conn,$sql);
    //$result = mysqli_fetch_assoc($query);

}
function get_comments($bookid){
	$datum=array();
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
	$sql="SELECT comment_user_name, user_comment FROM comments WHERE book_id='$bookid' ";
	//var_dump($sql);
	$query = mysqli_query($conn,$sql);
	//var_dump($query);
    //$result = mysqli_fetch_assoc($query);
     while ($result = mysqli_fetch_assoc($query)) {
            $datum[] = array(
                'comment_user_name' => $result['comment_user_name'],
                'user_comment' => $result['user_comment']
                );
        }
        return $datum;
}
////////////////////////////////////////////////////////////////////////////////////////////////////////
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

function get_user($user_id) {
	$query = "SELECT * FROM users u JOIN user_roles ur ON u.user_role_id = ur.user_role_id WHERE u.user_id = $user_id";
	$result = process_query($query);
	return $result->fetch_assoc();
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

function create_password($password) {
	return md5($password . SALT);
}

function validate_user($data) {
	$query = "SELECT * FROM users u
						JOIN user_roles ur ON u.user_role_id = ur.user_role_id
						WHERE (u.user_name = '$data[user_name]' OR u.user_email = '$data[user_name]') AND u.user_password = '$data[user_password]'";
	$result = process_query($query);
	$num_rows = $result->num_rows;
	if($num_rows > 0) {
		return $result->fetch_assoc();
	} else {
		return false;
	}
}
?>
