<?php require_once("template/doctype.php"); ?>
<html>
	<?php require_once("template/head.php"); ?>
<body>
	<div class="shell">
		<?php require_once("template/header.php"); ?>
			<!-- Main -->
			<div id="main">
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
				<div id="register" class="left" style="width: 46%">
					<form action="register.php" method="post">
							<p>
								<label for="user_name">Username</label>
								<br>
								<input type="text" id="user_name" name="user_name" required="required">
							</p>
							<p>
								<label for="user_first_name">First Name</label>
								<br>
								<input type="text" id="user_first_name" name="user_first_name" required="required">
							</p>
							<p>
								<label for="user_last_name">Last Name</label>
								<br>
								<input type="text" id="user_last_name" name="user_last_name" required="required">
							</p>
							<p>
								<label for="user_email">Email</label>
								<br>
								<input type="email" id="user_email" name="user_email" required="required">
							</p>
							<p>
								<label for="country_id">Country</label>
								<br>
								<?php $countries = get_countries(); ?>
								<select class="countries" id="country_id" name="country_id" required="required" onchange="get_states()"  onckeyup="get_states()">
									<option value="">Select Country</option>
									<?php foreach ($countries as $key => $country) { ?>
										<option value="<?php echo $country['country_id']; ?>"><?php echo $country['country_name']; ?></option>
									<?php } ?>
								</select>
							</p>
							<p>
								<label for="user_city">City</label>
								<br>
								<input type="text" id="user_city" name="user_city" required="required">
							</p>
							<p>
								<label for="user_address">Address</label>
								<br>
								<input type="text" id="user_address" name="user_address" required="required">
							</p>
							<p>
								<label for="user_phone">Phone</label>
								<br>
								<input type="text" id="user_phone" name="user_phone" required="required">
							</p>
							<p>
								<label for="user_password">Password</label>
								<br>
								<input type="password" id="user_password" name="user_password" required="required">
							</p>
							<p>
								<label for="confirm_password">Confirm Password</label>
								<br>
								<input type="password" id="confirm_password" name="confirm_password" required="required">
							</p>
							<p>
								<button type="submit" name="submit">Register</button>
							</p>
					</form>
				</div>
				<div id="login" class="right" style="width: 46%">
					<form action="login-process.php?action=login" method="post">
							<p>
								<label for="username">Username or Email</label>
								<br>
								<input type="text" id="username" name="username">
							</p>
							<p>
								<label for="password">Password</label>
								<br>
								<input type="password" id="password" name="password">
							</p>
							<p>
								<!-- <input type="checkbox" id="remember" name="remember"> -->
								<!-- <label for="remember">Remember me</label> -->
							</p>
							<p>
								<button type="submit" name="submit">LOGIN</button>
							</p>
					</form>
				</div>
				<!-- END Content -->
				<div class="cl"></div>
			</div>
			<!-- END Main -->
		</div>
		<!-- END Wrapper Middle -->
		<?php require_once("template/footer.php"); ?>
	</div>
	<script type="text/javascript">
		function get_states() {
			$(".states").remove();
			country_id = $("#country_id").val();
			$.ajax({
				url: "get_states.php?country_id=" + parseInt(country_id),
				type: "GET",
				success: function(result) {
					$("#country_id").after(result);
				}
			});
		}
	</script>
</body>
</html>
