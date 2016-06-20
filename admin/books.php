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
        <h2>Books</h2>

        <?php $books = get_books(); ?>
        <?php if($books) { ?>
        <table id="rounded-corner">
          <thead>
            <tr>
                            <th>S. No.</th>
                            <th>Image</th>
                            <th>Books</th>
			                <th>Authors</th>
							<th>Publishers</th>
							<th>Editions</th>
							<th>Price</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($books as $key => $book) { ?>
              <tr <?php if(($key + 1) % 2 == 0) echo "class='even'"; else echo "class='odd'"; ?>>
                <td><?php echo $book['book_id']; ?></td>
                <td><?php echo $book['book_name']; ?></td>
								<td><?php echo $book['author_name']; ?></td>
								<td><?php echo $book['publisher_name']; ?></td>
								<td>
									<?php
										if($book['book_edition_year'] > 0) {
											echo $book['book_edition_year'];
										}
									?>
								</td>
								<td>
									<?php
										if($book['book_price'] == -1 && $book['book_free'] == 1) {
											echo "Free eBook";
										} else {
											echo $book['book_price'];
										}
									?>
								</td>
                <td>
                  <a title="Edit" href="book-add-edit.php?action=edit&book_id=<?php echo $book['book_id'] ?>"><img title="Edit" src="images/edit.png" /></a>
                  <a title="Delete" href="book-process.php?action=delete&book_id=<?php echo $book['book_id'] ?>" onclick="return confirm('Are you sure you want to DELETE this record. There will be no roll back.?')"><img title="Delete" src="images/trash.gif" /></a>
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
