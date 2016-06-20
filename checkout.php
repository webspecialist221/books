<?php require_once("template/doctype.php"); ?>
<html>
	<?php require_once("template/head.php"); ?>
<body>
	<div class="shell">
		<?php require_once("template/header.php"); ?>
			<!-- Main -->
			<div id="main">
				<h1>Books listed in Your Cart</h1>
				<?php if(isset($_SESSION['products']) && is_array($_SESSION['products'])) { ?>
					<table style="width:100%">
						<thead style="text-align: left;">
							<th>S.No</th>
							<th>Book</th>
							<th>Copies</th>
							<th>Unit Price</th>
							<th>Price</th>
						</thead>
						<tbody>
						<?php $total = 0; ?>
						<?php foreach($_SESSION['products'] as $key => $product) { ?>
							<tr>
								<td><?php echo $key + 1; ?></td>
								<td>
									<img class="left" src="images/books/<?php echo $product['book_cover'] ?>" width="32" style="padding: 10px;">
									<?php echo "<strong>$product[book_name]</strong> written by <strong>$product[author_name]</strong> listed in <strong>$product[category_name]</strong>"; ?>
								</td>
								<td><?php echo $product['copies']; ?></td>
								<td><?php echo $product['book_price']; ?></td>
								<td><?php echo $total_unit_price = $product['copies'] * $product['book_price']; $total += $total_unit_price; ?></td>
							</tr>
						<?php } ?>
						</tbody>
				</table>
				<table style="width:40%; border: 1px solid #cfcfcf;" class="right">
					<tbody>
						<tr>
							<td width="200"><strong>Total Books</strong></td>
							<td><?php echo $_SESSION['total_books']; ?></td>
						</tr>
						<tr>
							<td><strong>Sub Total</strong></td>
							<td id="sub_total"><?php echo intval($total); ?></td>
						</tr>
						<tr>
							<td><strong>Delivery Charges</strong></td>
							<td id="delivery_charges"><?php echo CASH_ON_DELIVERY; ?></td>
						</tr>
						<tr>
							<td><strong>Total</strong></td>
							<td id="total"><?php echo intval($total) + CASH_ON_DELIVERY; ?></td>
						</tr>
					</tbody>
				</table>
				<div class="cl"></div>
				<form action="checkout-process.php" method="post">
					<?php foreach($_SESSION['products'] as $key => $product) { ?>
						<input type="hidden" name="book_id[]" value="<?php echo $product['book_id']; ?>">
						<input type="hidden" name="book_name[]" value="<?php echo $product['book_name']; ?>">
						<input type="hidden" name="book_price[]" value="<?php echo $product['book_price']; ?>">
						<input type="hidden" name="book_cover[]" value="<?php echo $product['book_cover']; ?>">
						<input type="hidden" name="book_edition[]" value="<?php echo $product['book_edition']; ?>">
						<input type="hidden" name="book_edition_year[]" value="<?php echo $product['book_edition_year']; ?>">
						<input type="hidden" name="category_name[]" value="<?php echo $product['category_name']; ?>">
						<input type="hidden" name="publisher_name[]" value="<?php echo $product['publisher_name']; ?>">
						<input type="hidden" name="author_name[]" value="<?php echo $product['author_name']; ?>">
						<input type="hidden" name="copies[]" value="<?php echo $product['copies']; ?>">
						<input type="hidden" name="unit_price[]" value="<?php echo intval($product['book_price']); ?>">
					<?php }

						if(isset($_SESSION['user_id'])) {
							$user = get_user($_SESSION['user_id']);
						?>
						<input type="hidden" value="<php echo $_SESSION['user_id']; ?>" name="user_id">
						<?php } else { ?>
							<input type="hidden" value="" name="user_id">
						<?php } ?>
					<label for="customer_name">Name: </label>
					<input type="text" name="customer_name" id="customer_name" required="required" <?php if(isset($user['user_first_name']) || isset($user['user_last_name'])) echo "value='$user[user_first_name] $user[user_last_name]'" ?>>
					<label for="customer_email">Email: </label>
					<input type="email" name="customer_email" id="customer_email" required="required" <?php if(isset($user['user_email'])) echo "value='$user[user_email]'" ?>>
					<label for="customer_phone">Phone: </label>
					<input type="text" name="customer_phone" id="customer_phone" required="required" <?php if(isset($user['user_phone'])) echo "value='$user[user_phone]'" ?>>
					<label for="customer_country">Country: </label> <br/>
					<select id="customer_country" name="customer_country" onchange="get_states()">
						<option value="">Select Country</option>
						<?php foreach($countries = get_countries() as $key => $country) { ?>
							<option value="<?php echo $country['country_id']; ?>" <?php if(isset($user['country_id']) && $country['country_id'] == $user['country_id']) echo "selected='selected'"; ?>><?php echo $country['country_name']; ?></option>
						<?php } ?>
					</select><br />
					<label for="customer_city">City: </label><br />
					<input type="text" name="customer_city" id="customer_city" required="required"<?php if(isset($user['user_city'])) echo "value='$user[user_city]'" ?>>
					<label for="customer_address">Address: </label>
					<input type="text" name="customer_address" id="customer_address" required="required"<?php if(isset($user['user_address'])) echo "value='$user[user_address]'" ?>>
					<h4>Delivery Options</h4>
					<label for="u_paisa">U Paisa (03339684385)</label>
					<input type="radio" name="delivery_charges" id="u_paisa" class="delivery_charges" value="<?php echo UPAISA; ?>" onclick="calculate_charges(this.value)"><br>
					<label for="easy_paisa">Easy Paisa (03459684385)</label>
					<input type="radio" name="delivery_charges" id="easy_paisa" class="delivery_charges" value="<?php echo EASY_PAISA; ?>" onclick="calculate_charges(this.value)"><br>
					<label for="cash_on_delivery">Cash on Delivery</label>
					<input type="radio" name="delivery_charges" id="cash_on_delivery" class="delivery_charges" value="<?php echo CASH_ON_DELIVERY; ?>" checked="checked" onclick="calculate_charges(this.value)"><br>
					<div class="cl"></div>
					<input type="hidden" name="delivery_type" id="delivery_type" value="CASH ON DELIVERY" />
					<input type="hidden" name="products_total" id="products_total" value="<?php echo $total; ?>" />
					<input type="hidden" name="total_amount" id="total_amount" value="<?php echo intval($total) + CASH_ON_DELIVERY; ?>" />
					<button type="submit">Checkout</button>
				</form>
				<?php } else { ?>
					<p>No Books Added to cart yet</p>
				<?php } ?>
				<!-- END Content -->
				<div class="cl"></div>
			</div>
			<!-- END Main -->
		</div>
		<!-- END Wrapper Middle -->
		<?php require_once("template/footer.php"); ?>
	</div>
	<script type="text/javascript">
		// calculate_charges();
		function calculate_charges(charges) {
			var sub_total = parseInt($("#sub_total").text());
			var total = parseInt(sub_total) + parseInt(charges);
			var delivery = $(".delivery_charges:checked").attr("id");
			var delivery_type = delivery.replace(/_/g, " ").toUpperCase();
			$("#delivery_type").val(delivery_type);
			$("#delivery_charges").text(charges);
			$("#total").text(total);
			$("#total_amount").val(total);
		}

		<?php if(isset($user['state_id'])) { ?>
			get_states(<?php echo $user['state_id']; ?>);
		<?php } ?>

		function get_states(state_id = 0) {
			$(".states").remove();
			$(".new-line").remove();
			var state = "";
			if(state_id > 0) {
				state = "&state_id=" + parseInt(state_id);
			}
			country_id = $("#customer_country").val();
			$.ajax({
				url: "get_states.php?country_id=" + parseInt(country_id) + state,
				type: "GET",
				success: function(result) {
					$("#customer_country").after(result);
				}
			});
		}
	</script>
</body>
</html>
