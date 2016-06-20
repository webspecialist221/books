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
							<h2>SEARCH RESULTS</h2>
							<img class="bullet" src="css/images/bullet.png" alt="small grey bullet" />
						</div>
						<?php $books = get_books("WHERE b.book_name LIKE '%$_POST[search]%'"); ?>
						<div class="row">
							<?php if($books && sizeof($books) > 0) { ?>
								<?php foreach($books as $key => $book) { ?>
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
												<h3><a title="<?php echo $book['book_name'] ?>" href="book.php?book_id=<?php echo $book['book_id'] ?>"><?php echo $book['book_name'] ?></a></h3>
												<p>Price</p>
												<p class="price"><span class="dollar">PKR</span><?php echo $book['book_price']; ?></p>
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
					<!-- END Products -->
					<!-- Products -->
					<!-- <div class="products best-sellers">
						<div class="title">
							<h2>Bestsellers</h2>
							<a class="title-link" title="More Bestsellers" href="#">More Bestsellers</a>
							<img class="bullet" src="css/images/bullet.png" alt="small grey bullet" />
						</div>
						<div class="row">
							<div class="product-holder">
								<div class="product">
									<a title="More Details" href="product-detail.html"><img src="css/images/8.jpg" alt="software engineering" /></a>
									<img class="top-label" src="css/images/top.png" alt="top sign" />
									<div class="desc">
										<p>price</p>
										<p class="price">
											<span class="dollar">$</span>99.00&nbsp;&nbsp;<strike><span class="dollar">$</span>115.00</strike>
										</p>
									</div>
									<div class="bottom"></div>
								</div>
								<div class="product-bottom"></div>
							</div>
							<div class="product-holder">
								<div class="product">
									<a title="More Details" href="product-detail.html"><img src="css/images/9.jpg" alt=""/></a>
									<img class="top-label" src="css/images/top.png" alt="top sign" />

									<div class="desc">
										<p>price</p>
										<p class="price">
											<span class="dollar">$</span>110.00&nbsp;&nbsp;<strike><span class="dollar">$</span>120.00</strike>
										</p>
									</div>
									<div class="bottom"></div>
								</div>
								<div class="product-bottom"></div>
							</div>
							<div class="product-holder">
								<div class="product">
									<a title="More Details" href="product-detail.html"><img src="css/images/6.jpg" alt="" /></a>
									<img class="top-label" src="css/images/top.png" alt="top sign" />
									<div class="desc">
										<p>price</p>
										<p class="price">
											<span class="dollar">$</span>79.00&nbsp;&nbsp;<strike><span class="dollar">$</span>90.00</strike>
										</p>
									</div>
									<div class="bottom"></div>
								</div>
								<div class="product-bottom"></div>
							</div>
						</div>
						<div class="cl"></div>
					</div> -->
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
