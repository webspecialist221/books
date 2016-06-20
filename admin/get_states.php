<?php
	require_once("includes/includes.php");
	$country_id = intval($_GET['country_id']);
	$states = get_states($country_id);
?>
<div class="states form_row">
	<label for="state_id">State</label>
	<select class="form_input" name="state_id" id="state_id">
		<option value="">Select State</option>
		<?php foreach ($states as $key => $state) { ?>
			<option value="<?php echo $state['state_id'] ?>" <?php if(isset($_GET['state_id']) && $_GET['state_id'] == $state['state_id']) echo "selected='selected'" ?>><?php echo $state['state_name']; ?></option>
		<?php } ?>
	</select>
</div>
