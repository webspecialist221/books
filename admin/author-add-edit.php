<?php require_once("template/doctype.php"); ?>
<html>
<?php require_once("template/head.php"); ?>
<?php
if(isset($_GET['action'])) {
  $action = $_GET['action'];
  if($action == "add") {
    $title = "Add Author";
    $button = "Add";
  } else if($action == "edit") {
    $title = "Edit Author";
    $button = "Update";
    $author_id = $_GET['author_id'] * 1;
    $author = get_author($author_id);
  } else {
    die("Something went wrong.");
  }
} else {
  $action = "add";
  $title = "Add Author";
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
        <form name="author_form" class="validate_form" enctype="multipart/form-data" action="author-process.php" method="post" >
          <div class="form">
            <input type="hidden" name="action" value="<?php echo $action; ?>" />
            <?php if($action == "edit") { ?>
              <input type="hidden" name="author_id" value="<?php echo $author['author_id']; ?>" />
            <?php } ?>
              <div class="form_row">
                <label for="author_name">Author Name</label>
                <input type="text" class="form_input" name="author_name" value="<?php if(isset($author['author_name'])) echo $author['author_name']; ?>" required="required" />
              </div>
              <div class="form_row">
                <label for="author_phone">Author Phone</label>
                <input type="text" class="form_input" name="author_phone" value="<?php if(isset($author['author_phone'])) echo $author['author_phone']; ?>" />
              </div>
              <div class="form_row">
                <label for="author_email">Author Email</label>
                <input type="email" class="form_input" name="author_email" value="<?php if(isset($author['author_email'])) echo $author['author_email']; ?>" />
              </div>
              <div class="form_row">
                <label for="author_website">Author Website</label>
                <input type="text" class="form_input" name="author_website" value="<?php if(isset($author['author_website'])) echo $author['author_website']; ?>" />
              </div>
              <div class="form_row">
                <label for="author_address">Author Address</label>
                <input type="text" class="form_input" name="author_address" value="<?php if(isset($author['author_address'])) echo $author['author_address']; ?>" />
              </div>
              <div class="form_row">
                <label for="author_biography">Author Biography</label>
                <textarea class="form_input" name="author_biography"><?php if(isset($author['author_biography'])) echo $author['author_biography']; ?></textarea>
              </div>
              <!-- <div class="form_row">
                <label for="author_image">Author Logo</label>
                <input type="file" class="form_input" name="author_image" />
                <?php if(isset($author['author_image']) && file_exists("../images/authors/$author[author_image]")) { ?>
                  <img src="../images/authors/<?php echo $author['author_image']; ?>" />
                <?php } ?>

              </div> -->
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

</body>
</html>
