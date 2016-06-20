<?php require_once("template/doctype.php"); ?>
<html>
<?php require_once("template/head.php"); ?>
<body>
<div id="panelwrap">

	<?php require_once("template/header.php"); ?>

    <div class="center_content">
    <div id="full_wrap">
      <div id="inner_content">
        <h2>Order Detail</h2>
        <?php if(isset($_GET['sale_id']) && intval($_GET['sale_id']) > 0) { ?>
					<?php $sale = get_sale($_GET['sale_id']); view_array($sale); ?>
					<h3>Customer Detail</h3>
					<table id="rounded-corner">
						<tr><th width="20%"><strong>Name</strong></th><td><?php echo $sale['customer_name'] ?></td></tr>
						<tr><th width="20%"><strong>Email</strong></th><td><?php echo $sale['customer_email'] ?></td></tr>
						<tr><th width="20%"><strong>Phone</strong></th><td><?php echo $sale['customer_phone'] ?></td></tr>
						<tr><th width="20%"><strong>Address</strong></th><td><?php echo "$sale[customer_address] $sale[customer_city] $sale[customer_state] $sale[customer_country]" ?></td></tr>
					</table>
					<h3>Products</h3>
					<table id="rounded-corner">
						<tr>
							<th>S.No.</th>
							<th>Book</th>
							<th>Author</th>
							<th>Publisher</th>
							<th>Category</th>
							<th>Copies</th>
							<th>Unit Price</th>
							<th>Sell Price</th>
						</tr>
						<?php $copies = 0; foreach(json_decode($sale['sale_products'], 1) as $key => $product) { ?>
							<tr <?php if(($key + 1) % 2 == 0) echo "class='even'"; else echo "class='odd'"; ?>>
								<td><?php echo $key + 1; ?></td>
								<td><?php echo $product['book_name']; ?></td>
								<td><?php echo $product['author_name']; ?></td>
								<td><?php echo $product['publisher_name']; ?></td>
								<td><?php echo $product['category_name']; ?></td>
								<td><?php echo $product['copies']; $copies += $product['copies'];?></td>
								<td><?php echo $product['unit_price']; ?></td>
								<td><?php echo $product['sell_price']; ?></td>
							</tr>
						<?php } ?>
						<tr>
							<th colspan="5">Total</th>
							<th colspan="2"><?php echo $copies; ?></th>
							<th><?php echo $sale['products_total']; ?></th>
						</tr>
					</table>
					<div class="clear"></div>
					<br><br><br>
					<table id="rounded-corner" width="50%" style="float:right; width:50%;">
						<?php if($sale['order_date'] != "0000-00-00") { ?>
						<tr><th width="20%"><strong>Order Date</strong></th><td><?php echo date("l, F d, Y", strtotime($sale['order_date'])); ?></td></tr>
						<?php } ?>
						<?php if($sale['process_date'] != "0000-00-00") { ?>
						<tr><th width="20%"><strong>Process Date</strong></th><td><?php echo date("l, F d, Y", strtotime($sale['process_date'])); ?></td></tr>
						<?php } ?>
						<?php if($sale['order_complete_date'] != "0000-00-00") { ?>
						<tr><th width="20%"><strong>Complete Date</strong></th><td><?php echo date("l, F d, Y", strtotime($sale['order_complete_date'])); ?></td></tr>
						<?php } ?>
						<tr><th width="20%"><strong>Order Status</strong></th><td><?php echo $sale['status_name']; ?></td></tr>
						<tr><th width="20%"><strong>Delivery Type</strong></th><td><?php echo $sale['delivery_type']; ?></td></tr>
						<tr><th width="20%"><strong>Sub Total</strong></th><td><?php echo $sale['products_total'] ?></td></tr>
						<tr><th width="20%"><strong>Delivery Charges</strong></th><td><?php echo $sale['delivery_charges'] ?></td></tr>
						<tr><th width="20%"><strong>Total Amount</strong></th><td><?php echo $sale['total_amount'] ?></td></tr>
					</table>
        <?php } else { ?>
          <p class="error">Some error occured</p>
        <?php } ?>
       </div>
     </div><!-- end of right content-->
		<div class="clear"></div>
    </div> <!--end of center_content-->

    <?php require_once("template/footer.php"); ?>

</div>
</body>
</html>
