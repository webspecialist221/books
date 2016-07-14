<?php require_once 'includes/connection.php'; ?>
<?php require_once("template/doctype.php");
		require_once("includes/functions.php"); ?>
<html>
	<?php require_once("template/head.php"); ?>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<body>
	<?php 
		if(isset($_GET['id']))
		{
			$id = $_GET['id'];
			// echo "select * from `ads` join `users` on ads.user_id=users.user_id where `id`='$id'";
			$query = mysqli_query($conn , "select * from `ads` join `users` on ads.user_id=users.user_id join `categories` on ads.book_category_id=categories.category_id  where `id`='$id'");
			$row = mysqli_fetch_array($query);
		}

	 ?>
	<div class="shell">
		<?php require_once("template/header.php"); ?>
			<!-- Main -->
			<div id="main">
				<?php require_once("template/slider.php"); ?>
				<?php //require_once("template/sidepanel.php"); ?>

				<!-- Content -->
				<div id="content1">
					<div class="">
						<div class="row">
							<div class="col-md-12">
								<div class="title">
									<h2><?php echo $row['book_name']; ?></h2>
								</div>
							</div>
						</div>	
						<div class="row">
							<div class="col-md-4">
								<div class="book_cover left">
									<img style="margin: 20px; border: 1px solid #efefef; padding: 5px;" src="images/ads/<?php echo $row['book_cover']; ?>" title=<?php echo $row['book_name']; ?> />
								</div>
							</div>
							
								<div class="col-md-4 col-md-offset-2">
									<div class="book_detail">
										<h3>Category: <?php echo $row['category_name']; ?></h3>
										<h3>Author: <?php echo $row['book_auther']; ?></h3>
										<h4>Edition: <?php echo $row['book_edition']; ?></h4>
										<h4>Owner Email: <?php echo $row['user_email']; ?></h4>
										<h4>Owner Phone: <?php echo $row['user_phone']; ?></h4>
										<h4>Owner Address: <?php echo $row['user_city']; ?> </h4>
										<?php if($row['rent'] == 1){ ?>
										<h4 style="color:crimson">Available On Rent</h4>
										<?php }else{ ?>
										<h4>Orginal Price: PKR<?php echo $row['orginal_price']; ?></h4>
										<h4>Sale Price: PKR<?php echo $row['sale_price']; ?></h4>
										<?php } ?>
									</div>
								</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<div class="comments">
									<form class="cart_form" action="ads_book.php" method="post">
										<input type="hidden" id="from" name="from" value="add_to_cart">
										<?php if (isset($_SESSION['user_id'])) {
											$userid=$_SESSION['user_id'];
											$username=$_SESSION['user_name'];										
										} else{
											$userid='555';
											$username='Anonymus';
											}  ?>
									
										<input type="hidden" id="bookid" name="bookid" value="<?php echo $row['id'] ; ?>"></input>
										<input type="text" id="username" name="username" value="<?php echo $username ; ?>" placeholder="<?php echo $username; ?>"></input>
										<textarea name="comment" id="comment" cols="30" rows="5"></textarea>
										<button type="submit" name="addcomment" id="addcomment">Add Comments</button>
									</form>
									<?php if(isset($_POST['addcomment'])) {
											
											$bookid=$_POST['bookid'];
											$name=$_POST['username'];
											$comment=$_POST['comment'];
											$result= add_comments($bookid, $name , $comment);
											header("location:ads_book.php?id=$bookid");
											}
											?>
								</div>
							</div>
						</div>
						<div class="row" style="margin-top:20px;">
							<div class="col-md-12">
								<div class="comments">
								
								<?php 
								$bookid=$row['id'];
								$display_comments=get_comments($bookid);
									foreach ($display_comments as $key => $value) {
										$uname=$value['comment_user_name'];
										$ucoment=$value['user_comment'];?>
										<p><b><?php echo $uname.' :'; ?></b><?php echo $ucoment.' .'; ?></p>
									<?php }?>
								</div>	
							</div>
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
