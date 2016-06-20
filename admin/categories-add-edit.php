<?php require_once("template/doctype.php"); ?>
<html>
<?php require_once("template/head.php"); ?>
<?php
if(isset($_GET['action'])) {
  $action = $_GET['action'];
  if($action == "add") {
    $title = "Add Category";
    $button = "Add";
  } else if($action == "edit") {
    $title = "Edit Category";
    $button = "Update";
    $category_id = $_GET['category_id'] * 1;
    $category = get_category($category_id);
  } else {
    die("Something went wrong.");
  }
} else {
  $action = "add";
  $title = "Add Category";
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
        <form name="category_form" class="validate_form" enctype="multipart/form-data" action="categories-process.php" method="post" >
          <div class="form">
            <input type="hidden" name="action" value="<?php echo $action; ?>" />
            <?php if($action == "edit") { ?>
              <input type="hidden" name="category_id" value="<?php echo $category['category_id']; ?>" />
            <?php } ?>
              <div class="form_row">
                <label for="category_name">Category Name</label>
                <input type="text" class="form_input" name="category_name" value="<?php if(isset($category['category_name'])) echo $category['category_name']; ?>" required="required" />
              </div>
              <div class="form_row">
                <label for="category_image">Category Image</label>
                <input type="file" class="form_input" name="category_image" />
                <?php if(isset($category['category_image']) && file_exists("../images/categories/$category[category_image]")) { ?>
                  <img src="../images/categories/<?php echo $category['category_image']; ?>" />
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

</body>
</html>
