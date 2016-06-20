<?php require_once("template/doctype.php"); ?>
<html>
	<?php require_once("template/head.php"); ?>
<body>
	<div class="shell">
		<?php require_once("template/header.php"); ?>
			<!-- Main -->
			<div id="main">
				<?php require_once("template/slider.php"); ?>
				<?php require_once("template/sidepanel.php"); ?>

				<?php $config = "WHERE b.book_free = 1"; $books = get_books($config); ?>
				<!-- Content -->
				<div id="content">
					<!-- Products -->
					<div class="products">
						<div class="title">
							<h2>Free E Books</h2>
							<img class="bullet" src="css/images/bullet.png" alt="small grey bullet" />
						</div>
						<div class="row">
							<?php if(isset($books) && sizeof($books) > 0) { ?>
								<table style="width:100%">
									<thead style="text-align: left;">
										<th>S.No</th>
										<th>Name</th>
										<th>Author</th>
										<th>Download</th>
									</thead>
									<tbody>
									<?php foreach($books as $key => $book) { ?>
										<tr>
											<td><?php echo $key + 1; ?></td>
											<td><img width="64" style="padding: 10px;" src="images/books/<?php echo $book['book_cover']; ?>"></td>
											<td><?php echo $book['book_name']; ?></td>
											<td><?php echo $book['author_name']; ?></td>
											<td><a href="e-books/<?php echo $book['book_ebook']; ?>">Download <?php echo $book['book_name']; ?></a></td>
										</tr>
									<?php } ?>
									</tbody>
							</table>
							<?php } else { ?>
								<p>No Free EBooks Found</p>
							<?php } ?>
						</div>
						<div class="cl"></div>
					</div>
					<!-- END Products -->
					<!-- Products -->
					<!-- END Products -->
				</div>
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
