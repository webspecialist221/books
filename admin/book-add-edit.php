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
<body>
<div id="panelwrap">

	<?php require_once("template/header.php"); ?>

    <div class="center_content">
    <div id="full_wrap">
      <div id="inner_content">
        <h2><?php echo $title; ?></h2>
        <form name="book_form" class="validate_form" enctype="multipart/form-data" action="book-process.php" method="post" >
          <div class="form">
            <input type="hidden" name="action" value="<?php echo $action; ?>" />
            <?php if($action == "edit") { ?>
              <input type="hidden" name="book_id" value="<?php echo $book['book_id']; ?>" />
            <?php } ?>
              <div class="form_row">
                <label for="book_name">Book Name</label>
                <input type="text" class="form_input" name="book_name" value="<?php if(isset($book['book_name'])) echo $book['book_name']; ?>" required="required" />
              </div>
              <div class="form_row">
                <label for="book_preface">Book Preface</label>
                <input type="text" class="form_input" name="book_preface" value="<?php if(isset($book['book_preface'])) echo $book['book_preface']; ?>" required="required" />
              </div>
              <div class="form_row">
                  <label for='book_price'>Book Price</label>
                  <input type='text' class='form_input' name='book_price' value='<?php if(isset($book['book_price'])) echo $book['book_price']; ?>' required='required' />
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
                <label for="publisher_id">Book Publisher</label>
                <select id="publisher_id" class="form_input" name="publisher_id">
                  <option value="">Select Publisher</option>
                  <?php foreach($publishers as $key => $publisher) { ?>
                    <option value="<?php echo $publisher['publisher_id']; ?>" <?php if(isset($publisher['publisher_id']) && isset($book['publisher_id']) && $publisher['publisher_id'] == $book['publisher_id']) echo "selected='selected'"; ?>><?php echo $publisher['publisher_name']; ?></option>
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
          </div>

          <div class="form_sub_buttons">
            <button type="submit" class="button green"><?php echo $button; ?></button>
            <button type="reset" class="button red">Clear</button>
          </div>
        </form>


       </div>
     </div><!-- end of right content-->
		<div class="clear"></div>
    </div> <!--end of center_content-->

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
