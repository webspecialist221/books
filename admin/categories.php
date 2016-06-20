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
        <h2>Categories</h2>

        <?php $categories = get_categories(); ?>
        <?php if($categories) { ?>
        <table id="rounded-corner">
          <thead>
            <tr>
              <th>S. No.</th>
              <th>Categories</th>
              <th colspan="2">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($categories as $key => $category) { ?>
              <tr <?php if(($key + 1) % 2 == 0) echo "class='even'"; else echo "class='odd'"; ?>>
                <td><?php echo $category['category_id']; ?></td>
                <td><?php echo $category['category_name']; ?></td>
                <td>
                  <a title="Edit" href="categories-add-edit.php?action=edit&category_id=<?php echo $category['category_id'] ?>"><img title="Edit" src="images/edit.png" /></a>
                  <a title="Delete" href="categories-process.php?action=delete&category_id=<?php echo $category['category_id'] ?>" onclick="return confirm('Are you sure you want to DELETE this record. There will be no roll back.?')"><img title="Delete" src="images/trash.gif" /></a>
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
