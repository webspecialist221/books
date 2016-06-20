<?php
function get_users() {
	$query = "SELECT * FROM users u
						JOIN user_roles ur ON ur.user_role_id = u.user_role_id
						JOIN countries c ON c.country_id = u.country_id
						JOIN states s ON s.state_id = u.state_id";
	$result = process_query($query);

	$num_rows = $result->num_rows;
	if($num_rows > 0) {
		$users = array();
		while($user = $result->fetch_assoc()) {
			array_push($users, $user);
		}
		return $users;
	} else {
		return FALSE;
	}
}

function get_user($user_id) {
	$query = "SELECT * FROM users u
						JOIN user_roles ur ON ur.user_role_id = u.user_role_id
						JOIN countries c ON c.country_id = u.country_id
						JOIN states s ON s.state_id = u.state_id
						WHERE u.user_id = $user_id";
	$result = process_query($query);
	if($result->num_rows > 0) {
		return $result->fetch_assoc();
	} else {
		return FALSE;
	}
}

function insert_user($data) {
	if(validate_user_name($data['user_name'])) {
		header("location: user-add-edit.php?error=Username Already exists");
	}

	if(validate_user_email($data['user_email'])) {
		header("location: user-add-edit.php?error=Email Already exists");
	}
	$query = "INSERT INTO users (user_role_id, country_id, state_id, user_name, user_first_name, user_last_name, user_email, user_phone, user_city, user_address, user_password)
						VALUES ($data[user_role_id], $data[country_id], $data[state_id], '$data[user_name]', '$data[user_first_name]', '$data[user_last_name]', '$data[user_email]', '$data[user_phone]', '$data[user_city]', '$data[user_address]', '$data[user_password]')";
						die;
	return process_query($query, 1);
}

function update_user($data) {
	$query = "UPDATE users
						SET user_id = $data[user_id],
								user_role_id = $data[user_role_id],
								country_id = $data[country_id],
								state_id = $data[state_id],
								user_name = '$data[user_name]',
								user_first_name = '$data[user_first_name]',
								user_last_name = '$data[user_last_name]',
								user_phone = '$data[user_phone]',
								user_email = '$data[user_email]',
								user_city = '$data[user_city]',
								user_address = '$data[user_address]'
								WHERE user_id = $data[user_id]";
	process_query($query);
}

function delete_user($user_id) {
	$query = "DELETE FROM users
						WHERE user_id = $user_id";
	process_query($query);
}

function get_countries() {
	$query = "SELECT * FROM countries";
	$result = process_query($query);

	$num_rows = $result->num_rows;
	if($num_rows > 0) {
		$countries = array();
		while($country = $result->fetch_assoc()) {
			array_push($countries, $country);
		}
		return $countries;
	} else {
		return FALSE;
	}
}

function get_states($country_id) {
	$query = "SELECT * FROM states WHERE country_id = $country_id";
	$result = process_query($query);
	$num_rows = $result->num_rows;
	if($num_rows > 0) {
		$states = array();
		while($state = $result->fetch_assoc()) {
			array_push($states, $state);
		}
		return $states;
	} else {
		return FALSE;
	}
}

function get_user_roles() {
	$query = "SELECT * FROM user_roles";
	$result = process_query($query);

	$num_rows = $result->num_rows;
	if($num_rows > 0) {
		$roles = array();
		while($role = $result->fetch_assoc()) {
			array_push($roles, $role);
		}
		return $roles;
	} else {
		return FALSE;
	}
}
 ?>
