<?php require_once("template/doctype.php"); ?>
<html>
	<?php require_once("template/head.php"); ?>
<body>
	<div class="shell">
		<?php require_once("template/header.php"); ?>
			<!-- Main -->
			<div id="main">
				<!-- Slider -->
				<?php require_once("template/slider.php"); ?>
				<?php require_once("template/sidepanel.php"); ?>
				<!-- Content -->
				<div id="content">
					<!-- Products -->
					<div class="products">
						<div class="title">
							<h2>Latest Books</h2>
							<img class="bullet" src="css/images/bullet.png" alt="small grey bullet" />
						</div>
						<?php $latest_books = get_books(" WHERE book_free = 0 ORDER BY b.book_id DESC LIMIT 9"); ?>
						<div class="row">
							<?php if($latest_books && sizeof($latest_books) > 0) { ?>
								<?php foreach($latest_books as $key => $book) { ?>
									<?php
										if($key != 0 && $key % 3 == 0) {
											echo "</div><div class='row'>";
										}
									?>
									<div class="product-holder">
										<div class="product">
											<a title="More Details" href="book.php?book_id=<?php echo $book['book_id']; ?>"><img src="images/books/<?php echo $book['book_cover']; ?>" alt="<?php echo $book['book_cover']; ?>" /></a>
											<img class="new-label" src="css/images/new.png" alt="new sign" /> 
											<div class="desc">
												<h3><a title="<?php echo $book['book_name'] ?>" href="book.php?book_id=<?php echo $book['book_id'] ?>"><?php echo $book['book_name'] ?></a></h3>
											
													<p>Price</p><p class="price"><span class="dollar">PKR:&nbsp;</span><?php echo $book['book_price']; ?></p>
											</div>
											<div class="bottom"></div>
										</div>
										<div class="product-bottom"></div>
									</div>
								<?php } ?>
							<?php } ?>
						</div>
						<div class="cl"></div>
					</div>
					
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
