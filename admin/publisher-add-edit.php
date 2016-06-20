<?php require_once("template/doctype.php"); ?>
<html>
<?php require_once("template/head.php"); ?>
<?php
if(isset($_GET['action'])) {
  $action = $_GET['action'];
  if($action == "add") {
    $title = "Add Publisher";
    $button = "Add";
  } else if($action == "edit") {
    $title = "Edit Publisher";
    $button = "Update";
    $publisher_id = $_GET['publisher_id'] * 1;
    $publisher = get_publisher($publisher_id);
  } else {
    die("Something went wrong.");
  }
} else {
  $action = "add";
  $title = "Add Publisher";
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
        <form name="publisher_form" class="validate_form" enctype="multipart/form-data" action="publisher-process.php" method="post" >
          <div class="form">
            <input type="hidden" name="action" value="<?php echo $action; ?>" />
            <?php if($action == "edit") { ?>
              <input type="hidden" name="publisher_id" value="<?php echo $publisher['publisher_id']; ?>" />
            <?php } ?>
              <div class="form_row">
                <label for="publisher_name">Publisher Name</label>
                <input type="text" class="form_input" name="publisher_name" value="<?php if(isset($publisher['publisher_name'])) echo $publisher['publisher_name']; ?>" required="required" />
              </div>
              <div class="form_row">
                <label for="publisher_phone">Publisher Phone</label>
                <input type="text" class="form_input" name="publisher_phone" value="<?php if(isset($publisher['publisher_phone'])) echo $publisher['publisher_phone']; ?>" required="required" />
              </div>
              <div class="form_row">
                <label for="publisher_email">Publisher Email</label>
                <input type="email" class="form_input" name="publisher_email" value="<?php if(isset($publisher['publisher_email'])) echo $publisher['publisher_email']; ?>" required="required" />
              </div>
              <div class="form_row">
                <label for="publisher_website">Publisher Website</label>
                <input type="text" class="form_input" name="publisher_website" value="<?php if(isset($publisher['publisher_website'])) echo $publisher['publisher_website']; ?>" />
              </div>
              <div class="form_row">
                <label for="publisher_address">Publisher Address</label>
                <input type="text" class="form_input" name="publisher_address" value="<?php if(isset($publisher['publisher_address'])) echo $publisher['publisher_address']; ?>" />
              </div>
              <!-- <div class="form_row">
                <label for="publisher_logo">Publisher Logo</label>
                <input type="file" class="form_input" name="publisher_logo" />
                <?php if(isset($publisher['publisher_logo']) && file_exists("../images/publishers/$publisher[publisher_logo]")) { ?>
                  <img src="../images/publishers/<?php echo $publisher['publisher_logo']; ?>" />
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
