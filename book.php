<?php require_once("template/doctype.php"); ?>
<html>
	<?php require_once("template/head.php"); ?>
<body>
	<?php
		if(isset($_POST['from']) && $_POST['from'] == "add_to_cart") {
			$_SESSION['book_name'] = $_POST['book_name'];
			$_SESSION['book_price'] = $_POST['book_price'];
			$_SESSION['book_cover'] = $_POST['book_cover'];
			$_SESSION['book_edition'] = $_POST['book_edition'];
			$_SESSION['book_edition_year'] = $_POST['book_edition_year'];
			$_SESSION['category_name'] = $_POST['category_name'];
			$_SESSION['publisher_name'] = $_POST['publisher_name'];
			$_SESSION['author_name'] = $_POST['author_name'];
		}
	?>
	<div class="shell">
		<?php require_once("template/header.php"); ?>
			<!-- Main -->
			<div id="main">
				<?php require_once("template/slider.php"); ?>
				<?php require_once("template/sidepanel.php"); ?>

				<?php $book = get_book($_GET['book_id'] * 1); ?>
				<!-- Content -->
				<div id="content">
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
					<div class="products">
						<div class="title">
							<h2><?php echo $book['book_name']; ?></h2>
						</div>
						<div class="book_cover left">
							<img style="margin: 20px; border: 1px solid #efefef; padding: 5px;" src="images/books/<?php echo $book['book_cover']; ?>" title=<?php echo $book['book_name']; ?> />
							<form class="cart_form" action="add_to_cart.php" method="post">
								<input type="hidden" id="from" name="from" value="add_to_cart">
								<input type="hidden" id="book_id" name="book_id" value="<?php echo $book['book_id']; ?>">
								<input type="hidden" id="book_name" name="book_name" value="<?php echo $book['book_name']; ?>">
								<input type="hidden" id="book_price" name="book_price" value="<?php echo $book['book_price']; ?>">
								<input type="hidden" id="book_cover" name="book_cover" value="<?php echo $book['book_cover']; ?>">
								<input type="hidden" id="book_edition" name="book_edition" value="<?php echo $book['book_edition']; ?>">
								<input type="hidden" id="book_edition_year" name="book_edition_year" value="<?php echo $book['book_edition_year']; ?>">
								<input type="hidden" id="category_name" name="category_name" value="<?php echo $book['category_name']; ?>">
								<input type="hidden" id="publisher_name" name="publisher_name" value="<?php echo $book['publisher_name']; ?>">
								<input type="hidden" id="author_name" name="author_name" value="<?php echo $book['author_name']; ?>">
								<div class="quantity_block">
									<h2>Number of Copies</h2>
									<button type="button" class="left" onclick="minus()">-</button>
									<input type="text" name="copies" value="1" id="copies" class="left" onkeyup="validate_quantity(this.value);">
									<button type="button" class="left" onclick="plus()">+</button>
									<div class="cl"></div>
								</div>
								<button type="submit">Add to Cart</button>
							</form>
						</div>
						<div class="book_detail left">
							<h3>Category: <?php echo $book['category_name']; ?></h3>
							<h3>Author: <?php echo $book['author_name']; ?></h3>
							<h4>Edition: <?php echo $book['book_edition']; ?></h4>
							<h4>Published in: <?php echo $book['book_edition_year']; ?></h4>
							<h2>Preface</h2>
							<p><?php echo $book['book_preface']; ?></p>
							<h2>Price: PKR<?php echo $book['book_price']; ?></h2>
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
	<script>
		function validate_quantity(value) {
			if(isNaN(value) || value <= 1) {
				$("#copies").val(1);
			}
		}
		function minus() {
			quantity = $("#copies").val();
			if(isNaN(quantity) || quantity <= 1) {
				$("#copies").val(1);
			} else {
				quantity -= 1;
				$("#copies").val(quantity);
			}
		}
		function plus() {
			quantity = $("#copies").val();
			if(isNaN(quantity) || quantity < 1) {
				$("#copies").val(1);
			} else {
				quantity = parseInt(quantity);
				quantity += 1;
				$("#copies").val(quantity);
			}
		}
		function add_to_cart() {

			// book_name = $("form #book_name").val();
			// book_price = $("form #book_price").val();
			// book_cover = $("form #book_cover").val();
			// book_edition = $("form #book_edition").val();
			// book_edition_year = $("form #book_edition_year").val();
			// category_name = $("form #category_name").val();
			// publisher_name = $("form #publisher_name").val();
			// author_name = $("form #author_name").val();
			$(".cart_form").submit(function(e) {
				var form_data = $(this).serialize();
				$.ajax({
					type: 'post',
					url: 'add_to_cart.php',
					dataType: 'json',
					data: form_data,
					beforeSend: function() {
						// $("#submit_button").text("Adding...");
					},
					complete: function() {
						// $("#submit_button").text("Request Complete");
					},
					error: function() {

					},
					success: function(result) {
						//$("#submit_button").text("Add to Cart");
						alert(result);
					}
				});
				e.preventDefault();
			});
		}
	</script>
</body>
</html>
