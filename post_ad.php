<?php require_once 'includes/connection.php'; ?>
<?php require_once("template/doctype.php"); ?>
<html>
<?php require_once("template/head.php"); ?>
<?php
$categories = get_categories();
$authors = get_authors();
$publishers = get_publishers();
if(isset($_GET['action'])) {
  $action = $_GET['action'];
  if($action == "add") {
    $title = "Add Book";
    $button = "Add";
  } else if($action == "edit") {
    $title = "Edit Book";
    $button = "Update";
    $book_id = $_GET['book_id'] * 1;
    $book = get_book($book_id);
  } else {
    die("Something went wrong.");
  }
} else {
  $action = "add";
  $title = "Add Book";
  $button = "Add";
}
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<body>
	<div class="shell">
		<?php require_once("template/header.php");
			  if (!isset($_SESSION['user_id'])) {
			  	header('Location: login-register.php');
			  }
		 ?>
		<!-- Main -->
		<div id="main">
			<!-- Slider -->
			<?php require_once("template/slider.php"); ?>
			<!-- Content -->
			<div id="container">
				<div class="row">
					<div class="col-md-12">
						<div class="title">
						<?php /*print_r($_SESSION)*/ ?>
							<h2>Post Ads</h2>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<form name="book_form" class="validate_form" enctype="multipart/form-data" action="" method="post" >
							<div class="form">
								<div class="form_row">
									<label for="book_name">Book Name</label>
									<input type="text" class="form_input" name="book_name" value="<?php if(isset($book['book_name'])) echo $book['book_name']; ?>" required="required" />
								</div>
								<div class="form_row">
									<label for="book_preface">Book Original Price</label>
									<input type="text" class="form_input" name="original_price" value="<?php if(isset($book['book_preface'])) echo $book['book_preface']; ?>" required="required" />
								</div>
								<div class="form_row">
									<label for="book_preface">Book Sale Price</label>
									<input type="text" class="form_input" name="sale_price" value="<?php if(isset($book['book_preface'])) echo $book['book_preface']; ?>" required="required" />
								</div>
								<div class="form_row">
									<label for="author_id">Book Author</label>
									<select id="author_id" class="form_input" name="author_id" required="required">
										<option value="">Select Author</option>
										<?php foreach($authors as $key => $author) { ?>
										<option value="<?php echo $author['author_id']; ?>" <?php if(isset($author['author_id']) && isset($book['author_id']) && $author['author_id'] == $book['author_id']) echo "selected='selected'"; ?>><?php echo $author['author_name']; ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="form_row">
									<label for="category_id">Book Category</label>
									<select id="category_id" class="form_input" name="category_id" required="required">
										<option value="">Select Category</option>
										<?php foreach($categories as $key => $category) { ?>
										<option value="<?php echo $category['category_id']; ?>" <?php if(isset($category['category_id']) && isset($book['category_id']) && $category['category_id'] == $book['category_id']) echo "selected='selected'"; ?>><?php echo $category['category_name']; ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="form_row">
									<label for="book_edition">Book Edition</label>
									<input type="text" class="form_input" name="book_edition" value="<?php if(isset($book['book_edition'])) echo $book['book_edition']; ?>" />
								</div>
								<div class="form_row">
									<label for="book_edition_year">Book Edition Year</label>
									<input type="text" class="form_input" name="book_edition_year" value="<?php if(isset($book['book_edition_year'])) echo $book['book_edition_year']; ?>" />
								</div>
								<div class="form_row">
									<label for="book_cover">Book cover</label>
									<input type="file" class="form_input" name="book_cover" />
									<?php if(isset($book['book_cover']) && file_exists("../images/books/$book[book_cover]")) { ?>
									<img src="../images/books/<?php echo $book['book_cover']; ?>" />
									<?php } ?>

								</div>
								<div class="clear"></div>
							</div><br>

							<div class="form_sub_buttons">
								<input type="submit" name="add_post" class="button green" value="Submit">
								<button type="reset" class="button red">Clear</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<?php require_once("template/footer.php"); ?>
	</div>
	<script type="text/javascript">
  validate_book();
  function validate_book() {
    if($("#book_free").is(':checked')) {
      $("#book_price_block").remove();
      var block = "<div class='form_row' id='book_ebook'><label for='book_ebook'>Upload eBook</label><input type='file' class='form_input' name='book_ebook' required='required' /></div>";
      $("#book_free_block").after(block);
    } else {
      $("#book_ebook").remove();
      var block = "<div class='form_row' id='book_price_block'><label for='book_price'>Book Price</label><input type='text' class='form_input' name='book_price' value='<?php if(isset($book['book_price'])) echo $book['book_price']; ?>' required='required' /></div>";
      $("#book_free_block").after(block);
    }
  }
</script>
</body>
</html>
<?php 
		if(isset($_POST['add_post'])){

			extract($_POST);
			$user_id = $_SESSION['user_id'];
			$pic = $_FILES['book_cover']['name'];
			$tmp = $_FILES['book_cover']['tmp_name'];
			$target_dir = "images/ads/".$pic;
			if(move_uploaded_file($tmp, $target_dir))
			{
				$query = mysqli_query($conn,"INSERT INTO `ads` (`user_id`, `book_category_id`, `book_name`, `book_auther`, `book_cover`, `book_edition`, `orginal_price`, `sale_price`) VALUES ('$user_id' , '$category_id' , '$book_name' , '$author_id' , '$pic' , '$book_edition' , '$original_price' , '$sale_price')");
				if($query)
				{
					header("location:post_ad.php?msg=Successfully added");
				}
				else
				{
					header("location:post_ad.php?msg=Record Insertion Failed");
				}
			}
			else{
					header("location:post_ad.php?msg=Image Insertion Failed");
			}	

		}
?>