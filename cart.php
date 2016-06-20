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
					<?php
						//	Creating an Array of Products
					?>
					<table style="width:100%">
						<thead style="text-align: left;">
							<th>S.No</th>
							<th>Book</th>
							<th>Copies</th>
							<th>Unit Price</th>
							<th>Price</th>
						</thead>
						<tbody>
						<?php $total = 0 ?>
						<?php foreach($_SESSION['products'] as $key => $product) { ?>
							<tr>
								<td><?php echo $key + 1; ?></td>
								<td>
									<img class="left" src="images/books/<?php echo $product['book_cover'] ?>" width="32" style="padding: 10px;">
									<?php echo "<strong>$product[book_name]</strong> written by <strong>$product[author_name]</strong> listed in <strong>$product[category_name]</strong>"; ?>
								</td>
								<td><?php echo $product['copies']; ?></td>
								<td><?php echo $product['book_price'];?></td>
								<td><?php echo $total_unit_price = $product['copies'] * $product['book_price']; $total += $total_unit_price; ?></td>
							</tr>
						<?php } ?>
						</tbody>
				</table>
				<table style="width:40%; border: 1px solid #cfcfcf;" class="right">
					<tbody>
						<tr>
							<td width="100"><strong>Total Books</strong></td>
							<td><?php echo $_SESSION['total_books']; ?></td>
						</tr>
						<tr>
							<td><strong>Sub Total</strong></td>
							<td><?php echo $total; ?></td>
						</tr>
						<tr>
							<td><strong>Total</strong></td>
							<td><?php echo $total; ?></td>
						</tr>
					</tbody>
				</table>

				<a href="checkout.php" class="button">Checkout</a>
				<a href="index.php" class="button">Shop More</a>

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
</body>
</html>
