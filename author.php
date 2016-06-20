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

				<?php $author = get_author($_GET['author_id'] * 1); ?>
				<!-- Content -->
				<div id="content">
					<!-- Products -->
					<div class="products">
						<div class="title">
							<h2><?php echo $author['author']['author_name'] ?></h2>
							<img class="bullet" src="css/images/bullet.png" alt="small grey bullet" />
						</div>
						<div class="row">
							<?php if(isset($author['books']) && sizeof($author['books']) > 0) { ?>
								<?php foreach($author['books'] as $key => $book) { ?>
									<?php
										if($key != 0 && $key % 3 == 0) {
											echo "</div><div class='row'>";
										}
									?>
									<div class="product-holder">
										<div class="product">
											<a title="More Details" href="book.php?book_id=<?php echo $book['book_id']; ?>"><img src="images/books/<?php echo $book['book_cover']; ?>" alt="<?php echo $book['book_cover']; ?>" /></a>
											<!-- <img class="new-label" src="css/images/new.png" alt="new sign" /> -->
											<div class="desc">
												<h3><a title="<?php echo $book['book_name'] ?>" href="book.php?book_id=<?php echo $book['book_id']; ?>"><?php echo $book['book_name'] ?></a></h3>
												<p>Price</p>
												<p class="price"><span class="dollar">PKR</span><?php echo $book['book_price']; ?></p>
											</div>
											<div class="bottom"></div>
										</div>
										<div class="product-bottom"></div>
									</div>
								<?php } ?>
							<?php } else { ?>
								<p>No Books Added to this author</p>
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
