<?php require_once("template/doctype.php"); ?>
<html>
<?php require_once("template/head.php"); ?>
<body>
<div id="panelwrap">

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
        <h2>Publishers</h2>

        <?php $publishers = get_publishers(); ?>
        <?php if($publishers) { ?>
        <table id="rounded-corner">
          <thead>
            <tr>
              <th>S. No.</th>
              <th>Publishers</th>
							<th>Phone</th>
							<th>Email</th>
							<th>Website</th>
							<th>Address</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($publishers as $key => $publisher) { ?>
              <tr <?php if(($key + 1) % 2 == 0) echo "class='even'"; else echo "class='odd'"; ?>>
                <td><?php echo $publisher['publisher_id']; ?></td>
                <td><?php echo $publisher['publisher_name']; ?></td>
								<td><?php echo $publisher['publisher_phone']; ?></td>
								<td><?php echo $publisher['publisher_email']; ?></td>
								<td><?php echo $publisher['publisher_website']; ?></td>
								<td><?php echo $publisher['publisher_address']; ?></td>
                <td>
                  <a title="Edit" href="publisher-add-edit.php?action=edit&publisher_id=<?php echo $publisher['publisher_id'] ?>"><img title="Edit" src="images/edit.png" /></a>
                  <a title="Delete" href="publisher-process.php?action=delete&publisher_id=<?php echo $publisher['publisher_id'] ?>" onclick="return confirm('Are you sure you want to DELETE this record. There will be no roll back.?')"><img title="Delete" src="images/trash.gif" /></a>
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
