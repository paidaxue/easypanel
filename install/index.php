<!DOCTYPE html>

<html>
	<head>
		<title>EasyPanel Installation Panel</title>

		<link rel="stylesheet" type="text/css" href="css/style.css">
		<script src="../applications/_control/js/jquery_1.7.1.min.js" ></script>
		<script src="../applications/_control/js/backend_custom.js" ></script>
	</head>

	<body>
		<div id="logo">
			<a href="www.easypanel-cms.com"><img src="img/logo.png" alt="Logo" /></a>
		</div><!--logo-->
		<div id="inst_wiz">
			<div id="inst_head">
				<h1 id="inst_head_title">Database configuration</h1>
			</div><!--inst_head-->
			<div id="container">
				<form id="form_wiz" method="post">
					<div id="input">
						<label for="host">Host</label>
						<input type="text" name="host" id="host" placeholder="localhost">
					</div><!--input-->
					<div id="input_error">
						<label id="label_error">Error! This input is very important!</label>
					</div><!--input-->
					<div id="input">
						<label for="username">Username</label>
						<input type="text" name="username" id="username" placeholder="root">
					</div><!--input-->
					<div id="input_error">
						<label id="label_error">Error! This input is very important!</label>
					</div><!--input-->
					<div id="input">
						<label for="password">Password</label>
						<input type="password" name="password" id="password" placeholder="password">
					</div><!--input-->
					<div id="input_error">
						<label id="label_error">Error! This input is very important!</label>
					</div><!--input-->
					<div id="input">
						<label for="database_name">Database name</label>
						<input type="text" name="database_name" id="database_name" placeholder="easypanel">
					</div><!--input-->
					<div id="input_error">
						<label id="label_error">Error! This input is very important!</label>
					</div><!--input-->
					<div id="input">
						<input type="submit" name="submit" id="submit_install" value="Submit">
					</div><!--input-->
				</form>
			</div><!--container-->
		</div><!--inst_wiz-->
	</body>
</html>
