<?php require_once("template/doctype.php"); ?>
<html>
<?php require_once("template/head.php"); ?>
<body>
<div id="panelwrap">
	<?php
		$status_id = 0;
		if(isset($_GET['status_id'])) {

			$status_id = $_GET['status_id'];
		}
	?>
	<?php require_once("template/header.php"); ?>

    <div class="center_content">
		<?php // require_once("template/sidebar.php"); ?>
    <div id="full_wrap">
      <div id="inner_content">
				<?php if(isset($_GET['info'])) { ?>
					<div class="info">
						<i class="fa fa-info-circle"></i>
						<?php echo $_GET['info']; ?>
					</div>
				<?php } ?>
				<?php if(isset($_GET['success'])) { ?>
					<div class="success">
						<i class="fa fa-check"></i>
						<?php echo $_GET['success']; ?>
					</div>
				<?php } ?>
				<?php if(isset($_GET['warning'])) { ?>
					<div class="warning">
						<i class="fa fa-warning"></i>
						<?php echo $_GET['warning']; ?>
					</div>
				<?php } ?>
				<?php if(isset($_GET['error'])) { ?>
					<div class="error">
						<i class="fa fa-times-circle"></i>
						<?php echo $_GET['error']; ?>
					</div>
				<?php } ?>
        <h2>Sales</h2>

        <?php $sales = get_sales($status_id); //view_array($sales); ?>
        <?php if($sales) { ?>
        <table id="rounded-corner">
          <thead>
            <tr>
              <th>S. No.</th>
							<th>Customer Name</th>
							<th>Email</th>
							<th>Phone</th>
							<th>Status</th>
							<th>Amount</th>
							<th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($sales as $key => $sale) { ?>
              <tr <?php if(($key + 1) % 2 == 0) echo "class='even'"; else echo "class='odd'"; ?>>
                <td><?php echo $key + 1; ?></td>
                <td><?php echo $sale['customer_name']; ?></td>
								<td><?php echo $sale['customer_email']; ?></td>
								<td><?php echo $sale['customer_phone']; ?></td>
								<td><?php echo $sale['customer_phone']; ?></td>
								<td><?php echo $sale['total_amount']; ?></td>
								<td><?php echo $sale['status_name']; ?></td>
                <td>
									<a title="View Detail" href="sale-view.php?sale_id=<?php echo $sale['sale_id'] ?>"><img src="images/view.png" /></a>
									<?php if($sale['status_id'] == 1) { ?>
										<a title="Process Order" href="sale-add-edit.php?status_id=<?php echo $sale['status_id']; ?>&sale_id=<?php echo $sale['sale_id'] ?>"><img src="images/process.png" /></a>
									<?php } elseif($sale['status_id'] == 2) { ?>
                  	<a title="Complete Order" href="sale-process.php?status_id=<?php echo $sale['status_id']; ?>&sale_id=<?php echo $sale['sale_id'] ?>"><img src="images/complete.png" /></a>
									<?php } ?>
                </td>
              </tr>
            <?php } ?>
          </tbody>
          <tfoot>
          </tfoot>
        </table>
        <?php } else { ?>
          <p class="error">No Record Found</p>
        <?php } ?>
      </div><!-- end of inner content-->
    </div><!-- end of right content-->


    <?php // require_once("template/sidebar.php"); ?>
		<div class="clear"></div>
    </div> <!--end of center_content-->

    <?php require_once("template/footer.php"); ?>

</div>


</body>
</html>
