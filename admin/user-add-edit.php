<?php require_once("template/doctype.php"); ?>
<?php
	if($_SESSION['role_id'] != 1) {
			header("location: index.php");
	}
?>
<html>
<?php require_once("template/head.php"); ?>
<?php
if(isset($_GET['action'])) {
  $action = $_GET['action'];
  if($action == "add") {
    $title = "Add User";
    $button = "Add";
  } else if($action == "edit") {
    $title = "Edit User";
    $button = "Update";
    $user_id = $_GET['user_id'] * 1;
    $user = get_user($user_id);
  } else {
    die("Something went wrong.");
  }
} else {
  $action = "add";
  $title = "Add User";
  $button = "Add";
}
?>
<body>
<div id="panelwrap">

	<?php require_once("template/header.php"); ?>

    <div class="center_content">
    <div id="full_wrap">
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
      <div id="inner_content">
        <h2><?php echo $title; ?></h2>
        <form name="user_form" class="validate_form" enctype="multipart/form-data" action="user-process.php" method="post" >
          <div class="form">
            <input type="hidden" name="action" value="<?php echo $action; ?>" />
            <?php if($action == "edit") { ?>
              <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>" />
            <?php } ?>
              <div class="form_row">
                <label for="user_name">User Name</label>
                <input type="text" class="form_input" name="user_name" value="<?php if(isset($user['user_name'])) echo $user['user_name']; ?>" required="required" />
              </div>

              <div class="form_row">
                <label for="user_first_name">First Name</label>
                <input type="text" class="form_input" name="user_first_name" value="<?php if(isset($user['user_first_name'])) echo $user['user_first_name']; ?>" required="required" />
              </div>

              <div class="form_row">
                <label for="user_last_name">Last Name</label>
                <input type="text" class="form_input" name="user_last_name" value="<?php if(isset($user['user_last_name'])) echo $user['user_last_name']; ?>" required="required" />
              </div>

              <div class="form_row">
                <label for="user_email">Email</label>
                <input type="email" class="form_input" name="user_email" value="<?php if(isset($user['user_email'])) echo $user['user_email']; ?>" required="required" />
              </div>

              <div class="form_row">
                <label for="user_phone">Phone</label>
                <input type="text" class="form_input" name="user_phone" value="<?php if(isset($user['user_phone'])) echo $user['user_phone']; ?>" />
              </div>

              <div class="countries form_row">
                <?php $countries = get_countries(); ?>
                <label for="country_id">Country</label>
                <select class="form_input" name="country_id" id="country_id" onchange="get_states()" onselect="get_states()">
                  <option value="">Select Country</option>
                  <?php foreach ($countries as $key => $country) { ?>
                    <option value="<?php echo $country['country_id'] ?>" <?php if(isset($user['country_id']) && $user['country_id'] == $country['country_id']) echo "selected='selected'" ?>><?php echo $country['country_name']; ?></option>
                  <?php } ?>
                </select>
              </div>

              <div class="form_row">
                <label for="user_city">City</label>
                <input type="text" class="form_input" name="user_city" value="<?php if(isset($user['user_city'])) echo $user['user_city']; ?>" />
              </div>

              <div class="form_row">
                <label for="user_address">Address</label>
                <input type="text" class="form_input" name="user_address" value="<?php if(isset($user['user_address'])) echo $user['user_address']; ?>" />
              </div>

              <div class="form_row">
                <?php $roles = get_user_roles(); ?>
                <label for="user_role_id">Role</label>
                <select class="form_input" name="user_role_id" id="user_role_id">
                  <option value="">Select Role</option>
                  <?php foreach ($roles as $key => $role) { ?>
                    <option value="<?php echo $role['user_role_id'] ?>" <?php if(isset($user['user_role_id']) && $user['user_role_id'] == $role['user_role_id']) echo "selected='selected'" ?>><?php echo $role['user_role']; ?></option>
                  <?php } ?>
                </select>
              </div>

              <div class="form_row">
                <label for="user_password">Password</label>
                <input type="password" class="form_input" name="user_password" />
              </div>

              <div class="form_row">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" class="form_input" name="confirm_password" />
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
  get_states();
  function get_states() {
    var user_state = "<?php echo $user['state_id']; ?>";
    $(".states").remove();
    country_id = $("#country_id").val();
    $.ajax({
      url: "get_states.php?country_id=" + parseInt(country_id) + "&state_id=" + parseInt(user_state),
      type: "GET",
      success: function(result) {
        $(".countries").after(result);
      }
    });
  }
</script>
</body>
</html>
