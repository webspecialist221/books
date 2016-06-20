<?php require_once 'includes/connection.php'; ?>
<?php 
	$id = $_GET['author_id'] * 1;
	$query1 = mysqli_query($conn,"select * from `authors` where `author_id`='$id'");
	$row = mysqli_fetch_array($query1);

 ?>
<?php require_once("template/doctype.php"); ?>
<html>
	<?php require_once("template/head.php"); ?>
<body>
	<div class="shell">
		<?php require_once("template/header.php"); ?>
			<!-- Main -->
			<div id="main">
				<?php require_once("template/slider.php"); ?>
				<?php require_once("template/sidepanel2.php"); ?>

				<?php $author = get_author($_GET['author_id'] * 1); ?>
				<!-- Content -->
				<div id="content">
					<!-- Products -->
					<div class="products">
						<div class="title">
							<h2><?php echo $row['author_name'] ?></h2>
							<img class="bullet" src="css/images/bullet.png" alt="small grey bullet" />
						</div>
						<div class="row">
								<?php 
									$query = mysqli_query($conn,"select * from `ads` where `book_auther`='$id'");
								 ?>
								<?php while($book = mysqli_fetch_array($query)) { ?>
									<div class="product-holder">
										<div class="product">
											<a title="More Details" href="ads_book.php?id=<?php echo $book['id']; ?>"><img src="images/books/<?php echo $book['book_cover']; ?>" alt="<?php echo $book['book_cover']; ?>" /></a>
											<!-- <img class="new-label" src="css/images/new.png" alt="new sign" /> -->
											<div class="desc">
												<h3><a title="<?php echo $book['book_name'] ?>" href="ads_book.php?id=<?php echo $book['id']; ?>"><?php echo $book['book_name'] ?></a></h3>
												<p>Price</p>
												<p class="price"><span class="dollar">PKR</span><?php echo $book['orginal_price']; ?></p>
											</div>
											<div class="bottom"></div>
										</div>
										<div class="product-bottom"></div>
									</div>
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
