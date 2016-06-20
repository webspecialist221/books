<?php
	require("includes/includes.php");
	if(sizeof($_POST) > 0 && isset($_POST['status_id']) && isset($_POST['sale_id']) && $_POST['status_id'] == 1) {
		$data = array (
			'sale_id'					=>	$_POST['sale_id'],
			'message'					=>	$_POST['message'],
			'process_date'		=>	date("Y-m-d"),
			'status_id'				=>	2
		);
		process_order($data);
		header("Location: sales.php?status_id=2&success=Order Process Started");
	} elseif(sizeof($_GET) > 0 && isset($_GET['status_id']) && isset($_GET['sale_id']) && $_GET['status_id'] == 2) {
		$data = array (
			'sale_id'								=>	$_GET['sale_id'],
			'order_complete_date'		=>	date("Y-m-d"),
			'status_id'							=>	3
		);
		complete_order($data);
		header("Location: sales.php?status_id=3&success=Order Completed Successfully");
	} else {
		header("Location: sales.php?error=Some Error Occured");
	}
?>
