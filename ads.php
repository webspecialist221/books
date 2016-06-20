<?php require_once 'includes/connection.php'; ?>
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
				<?php require_once("template/sidepanel2.php"); ?>
				<!-- Content -->
				<div id="content">
					<!-- Products -->
					<div class="products">
						<div class="title">
							<h2>Latest Books Ads</h2>
							
							<img class="bullet" src="css/images/bullet.png" alt="small grey bullet" />
						</div>
						<?php $ads_books = mysqli_query($conn , "select * from `ads`") ?>
						<div class="row">
							<?php 
								while($row = mysqli_fetch_array($ads_books)){
							 ?>
							<div class="product-holder">
										<div class="product">
											<a title="More Details" href="ads_book.php?id=<?php echo $row['id'];?>"><img src="images/ads/<?php echo $row['book_cover'];?>" alt="<?php echo $row['book_cover'];?>"></a>
											<!-- <img class="new-label" src="css/images/new.png" alt="new sign">  -->
											<div class="desc">
												<h3><a title="demo book name" href="book.php?id=<?php echo $row['id'];?>"><?php echo $row['book_name'] ?></a></h3>
											
													<p>Price</p><p class="price"><span class="dollar">PKR:&nbsp;</span><?php echo $row['orginal_price'] ?></p>
											</div>
											<div class="bottom"></div>
										</div>
										<div class="product-bottom"></div>
									</div>
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
