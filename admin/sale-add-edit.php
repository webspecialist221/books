<?php require_once("template/doctype.php"); ?>
<html>
<?php require_once("template/head.php"); ?>
<body>
<div id="panelwrap">

	<?php require_once("template/header.php"); ?>

    <div class="center_content">
    <div id="full_wrap">
      <div id="inner_content">
        <h2>Process Order</h2>
        <?php if(isset($_GET['status_id']) && $_GET['status_id'] == 1) { ?>
        <form name="sale_form" class="validate_form" enctype="multipart/form-data" action="sale-process.php" method="post" >
          <input type="hidden" name="sale_id" value="<?php echo $_GET['sale_id']; ?>" />
          <input type="hidden" name="status_id" value="<?php echo $_GET['status_id']; ?>" />
          <div class="form">
            <div class="form_row">
                <label for="message">Message</label>
                <textarea class="form_input" id="message" name="message" width="100%" required="required"></textarea>
            </div>

            <div class="clear"></div>
          </div>

          <div class="form_sub_buttons">
            <button type="submit" class="button green">Process</button>
            <button type="reset" class="button red">Clear</button>
          </div>
        </form>
        <?php } else { ?>
          <p class="error">Some error occured</p>
        <?php } ?>
       </div>
     </div><!-- end of right content-->
		<div class="clear"></div>
    </div> <!--end of center_content-->

    <?php require_once("template/footer.php"); ?>

</div>
<script type="text/javascript">
  validate_sale();
  function validate_sale() {
    if($("#sale_free").is(':checked')) {
      $("#sale_price_block").remove();
      var block = "<div class='form_row' id='sale_esale'><label for='sale_esale'>Upload eSale</label><input type='file' class='form_input' name='sale_esale' required='required' /></div>";
      $("#sale_free_block").after(block);
    } else {
      $("#sale_esale").remove();
      var block = "<div class='form_row' id='sale_price_block'><label for='sale_price'>Sale Price</label><input type='text' class='form_input' name='sale_price' value='<?php if(isset($sale['sale_price'])) echo $sale['sale_price']; ?>' required='required' /></div>";
      $("#sale_free_block").after(block);
    }
  }
</script>
</body>
</html>
