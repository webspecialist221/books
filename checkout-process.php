<?php
	require_once("includes/includes.php");
	// view_array($_POST);
	$products = array();
	foreach($_POST['book_id'] as $key => $product) {
		$products[$key] = array(
			'book_id'							=>	$_POST['book_id'][$key],
			'book_name'						=>	$_POST['book_name'][$key],
			'book_price'					=>	$_POST['book_price'][$key],
			'book_cover'					=>	$_POST['book_cover'][$key],
			'book_edition'				=>	$_POST['book_edition'][$key],
			'book_edition_year'		=>	$_POST['book_edition_year'][$key],
			'category_name'				=>	$_POST['category_name'][$key],
			'publisher_name'			=>	$_POST['publisher_name'][$key],
			'author_name'					=>	$_POST['author_name'][$key],
			'copies'							=>	$_POST['copies'][$key],
			'unit_price'					=>	$_POST['unit_price'][$key],
			'sell_price'					=>	$_POST['unit_price'][$key] * $_POST['copies'][$key],
		);
	}

	$country = get_countries(" WHERE country_id = $_POST[customer_country]");
	$state = get_states(" WHERE state_id = $_POST[customer_state]");

	$data = array(
		'user_id'							=>	0,
		'customer_name'				=>	$_POST['customer_name'],
		'customer_email'			=>	$_POST['customer_email'],
		'customer_phone'			=>	$_POST['customer_phone'],
		'customer_email'			=>	$_POST['customer_email'],
		'customer_country'		=>	$country['country_name'],
		'customer_state'			=>	$state['state_name'],
		'customer_city'				=>	$_POST['customer_city'],
		'customer_address'		=>	$_POST['customer_address'],
		'delivery_charges'		=>	$_POST['delivery_charges'],
		'delivery_type'				=>	$_POST['delivery_type'],
		'products_total'			=>	$_POST['products_total'],
		'total_amount'				=>	$_POST['total_amount'],
		'sale_products'				=>	json_encode($products)
	);
	if(isset($_SESSION['user_id'])) {
		$data['user_id'] = $_SESSION['user_id'];
	}
	add_sale($data);
// Email to Admin
$to = ADMIN_EMAIL;

$subject = "You got an order from <?php echo $data[customer_name]; ?>&lt;<?php echo $data[customer_email]; ?>&gt";

$headers = "From: " . strip_tags($data['customer_email']) . "\r\n";
$headers .= "Reply-To: ". strip_tags($data['customer_email']) . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";

$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";


$message = "<html><body>";
$message .= "<h1>New Order</h1>";
$message .= "<h3>Customer Details</h3><table width='100%'><tr><td><strong>Name:</strong></td><td>$data[customer_name]</td><td><strong>Email:</strong></td><td>$data[customer_email]</td><td><strong>Phone:</strong></td><td>$data[customer_phone]</td></tr>";
$message .= "<tr><td><strong>Address:</strong></td><td>$data[customer_address] $data[customer_city]</td><td><strong>State:</strong></td><td>$data[customer_state]</td><td><strong>Country:</strong></td><td>$data[customer_country]</td></tr></table>";
$message .= "<h3>Order Details</h3><table width='100%'><tr><td><strong>S.No.</strong></td><td colspan='2'><strong>Book Detail</strong></td><td><strong>Copies</strong></td><td><strong>Unit Price</strong></td><td><strong>Total Amount</strong></td></tr>";
$total_payment = 0;
foreach(json_decode($data['sale_products'], 1) as $key => $product) {
	$sno = $key + 1;
	$image_address = WEBSITE_ADDRESS . "images/books/$product[book_cover]";
	$message .= "<tr><td>$sno</td><td><img width='100' src='$image_address' /></td><td><strong>$product[book_name]</strong> written by <strong>$product[author_name]</strong> listed in <strong>$product[category_name]</strong> category published by <strong>$product[publisher_name]</strong></td><td>$product[copies]</td><td>$product[unit_price]</td><td>$product[sell_price]</td></tr></table>";
}
$message .= "<table width='50%' align='right'><tr><td><strong>Payment Through</strong></td><td>$data[delivery_type]</td></tr>";
$message .= "<tr><td><strong>Sub Total</strong></td><td>$data[products_total]</td></tr>";
$message .= "<tr><td><strong>Delivery Charges</strong></td><td>$data[delivery_charges]</td></tr>";
$message .= "<tr><td><strong>Total Payment</strong></td><td>$data[total_amount]</td></tr></table></body></html>";

mail($to, $subject, $message, $headers);


$to = $_POST['customer_email'];

$subject = "You have ordered <?php echo $_POST[book_name]; ?>";

$headers = "From: " . strip_tags(ADMIN_EMAIL) . "\r\n";
$headers .= "Reply-To: ". strip_tags(ADMIN_EMAIL) . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";

$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";


$message = '<html><body>';
$message .= '<h1>New Order</h1>';
$message .= "<h3>Customer Details</h3><table width='100%'><tr><td><strong>Name:</strong></td><td>$data[customer_name]</td><td><strong>Email:</strong></td><td>$data[customer_email]</td><td><strong>Phone:</strong></td><td>$data[customer_phone]</td></tr>";
$message .= "<tr><td><strong>Address:</strong></td><td>$data[customer_address] $data[customer_city]</td><td><strong>State:</strong></td><td>$data[customer_state]</td><td><strong>Country:</strong></td><td>$data[customer_country]</td></tr></table>";
$message .= "<h3>Order Details</h3><table width='100%'><tr><td><strong>S.No.</strong></td><td colspan='2'><strong>Book Detail</strong></td><td><strong>Copies</strong></td><td><strong>Unit Price</strong></td><td><strong>Total Amount</strong></td></tr>";
foreach(json_decode($data['sale_products'], 1) as $key => $product) {
	$sno = $key + 1;
	$image_address = WEBSITE_ADDRESS . "images/books/$product[book_cover]";
	$message .= "<tr><td>$sno</td><td><img width='100' src='$image_address' /></td><td><strong>$product[book_name]</strong> written by <strong>$product[author_name]</strong> listed in <strong>$product[category_name]</strong> category published by <strong>$product[publisher_name]</strong></td><td>$product[copies]</td><td>$product[unit_price]</td><td>$product[sell_price]</td></tr>";
}
$message .= "<table width='50%' align='right'><tr><td><strong>Payment Through</strong></td><td>$data[delivery_type]</td></tr>";
$message .= "<tr><td><strong>Sub Total</strong></td><td>$data[products_total]</td></tr>";
$message .= "<tr><td><strong>Delivery Charges</strong></td><td>$data[delivery_charges]</td></tr>";
$message .= "<tr><td><strong>Total Payment</strong></td><td>$data[total_amount]</td></tr></table></body></html>";

mail($to, $subject, $message, $headers);
unset($_SESSION['products']);
header("Location: index.php");
?>
