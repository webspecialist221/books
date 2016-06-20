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

				<?php $categories = get_categories(); ?>
				<!-- Content -->
				<div id="content">
					<!-- Products -->
					<div class="products">
						<div class="title">
							<h2>Categories</h2>
							<img class="bullet" src="css/images/bullet.png" alt="small grey bullet" />
						</div>
						<div class="row">
							<?php if(isset($categories) && sizeof($categories) > 0) { ?>
								<?php foreach($categories as $key => $category) { ?>
									<?php
										if($key != 0 && $key % 3 == 0) {
											echo "</div><div class='row'>";
										}
									?>
									<div class="product-holder">
										<div class="product">
											<a title="More Details" href="category.php?category_id=<?php echo $category['category_id']; ?>"><img src="images/categories/<?php echo $category['category_image']; ?>" alt="<?php echo $category['category_name']; ?>" /></a>
											<!-- <img class="new-label" src="css/images/new.png" alt="new sign" /> -->
											<div class="desc">
												<p><a title="<?php echo $category['category_name']; ?>" href="category.php?category_id=<?php echo $category['category_id']; ?>"><?php echo $category['category_name']; ?></a></p>
											</div>
											<div class="bottom"></div>
										</div>
										<div class="product-bottom"></div>
									</div>
								<?php } ?>
							<?php } else { ?>
								<p>No Categories Added</p>
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
