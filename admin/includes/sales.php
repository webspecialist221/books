<?php

function get_sales($status_id = 0) {
	$query = "SELECT sa.*, st.*, u.* FROM sales sa
						JOIN statuses st ON st.status_id = sa.status_id
						LEFT JOIN users u ON u.user_id = sa.user_id";
	if($status_id > 0) {
		$query .= " WHERE sa.status_id = $status_id";
	}
	$result = process_query($query);

	$num_rows = $result->num_rows;
	if($num_rows > 0) {
		$sales = array();
		while($sale = $result->fetch_assoc()) {
			array_push($sales, $sale);
		}
		return $sales;
	} else {
		return FALSE;
	}
}

function get_sale($sale_id) {
	$query = "SELECT sa.*, st.*, u.* FROM sales sa
						JOIN statuses st ON st.status_id = sa.status_id
						LEFT JOIN users u ON u.user_id = sa.user_id
						WHERE sa.sale_id = $sale_id";
	$result = process_query($query);
	if($result->num_rows > 0) {
		return $result->fetch_assoc();
	} else {
		return FALSE;
	}
}

function insert_sale($data) {
	$query = "INSERT INTO sales (publisher_id, author_id, category_id, sale_name, sale_preface, sale_price, sale_edition, sale_edition_year, sale_free)
						VALUES ($data[publisher_id], $data[author_id], $data[category_id], '$data[sale_name]', '$data[sale_preface]', $data[sale_price], '$data[sale_edition]', $data[sale_edition_year], $data[sale_free])";
	return process_query($query, 1);
}

function process_order($data) {
	$query = "UPDATE sales
						SET message = '$data[message]',
								process_date = '$data[process_date]',
								status_id = 2
						WHERE sale_id = $data[sale_id]";
	process_query($query);
}

function complete_order($data) {
	$query = "UPDATE sales
						SET order_complete_date = '$data[order_complete_date]',
								status_id = 3
						WHERE sale_id = $data[sale_id]";
	process_query($query);
}
?>
