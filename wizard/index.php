<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Install Easypanel</title>

	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-theme.min.css">

	<style>
		label.validation-error {
			color: red;
			font-weight: 400;
			font-style: italic;
		}

		.alert {
			display: none;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
			  <h1>Easypanel wizard</h1>
				<p>Hello, hello!</p>
				<p>
					Fill in the following inputs and your application should be done in seconds!
				</p>

				<?php
					if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on') {
					  $base_url = "https://".$_SERVER['HTTP_HOST'];
					} else {
					  $base_url = "http://".$_SERVER['HTTP_HOST'];
					}

					$base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
				?>

				<p class="alert alert-success">
					Perfect! Now you can go to <a href="../">your website</a> or to <a href="../_control.php">your admin panel</a>
				</p>
				<p class="alert alert-info">
					Please don't forget to delete the folder 'wizard'.
				</p>
				<p class="alert alert-danger">
					Oops! Please check your credentials and try again.
				</p>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<form id="do-magic" name="do-magic" method="post">
				  <div class="form-group">
				    <label for="db_host">Database host</label>
				    <input type="text" class="form-control" id="db_host" name="db_host" placeholder="Enter your host">
				  </div>
				  <div class="form-group">
				    <label for="db_user">Database user</label>
				    <input type="text" class="form-control" id="db_user" name="db_user" placeholder="Enter your database user">
				  </div>
				  <div class="form-group">
				    <label for="db_pass">Database password</label>
				    <input type="text" class="form-control" id="db_pass" name="db_pass" placeholder="Enter your database password, if you have any">
				  </div>
				  <div class="form-group">
				    <label for="db_name">Database name</label>
				    <input type="text" class="form-control" id="db_name" name="db_name" placeholder="Enter your database name">
				  </div>

				  <button type="submit" class="btn btn-default">Do your magic!</button>
				</form>
			</div>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="http://malsup.github.com/jquery.form.js"></script>
	<script src="js/jquery.validate.min.js"></script>
	<script src="js/main.js"></script>
</body>
</html>