<?php
	require_once("includes/includes.php");
	$country_id = intval($_GET['country_id']);
	$states = get_states(" WHERE country_id = $country_id");
?>
<br class="new-line" />
<label class="states" for="customer_state">State</label>
<br class="new-line" />
<select id="customer_state" name="customer_state" class="states">
	<option value="">Select State</option>
	<?php foreach($states as $key => $state) { ?>
		<option value="<?php echo $state['state_id']; ?>" <?php if(isset($_GET['state_id'])) echo "selected='selected'"; ?>><?php echo $state['state_name']; ?></option>
	<?php } ?>
</select>
