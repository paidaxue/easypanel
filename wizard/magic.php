<?php

// get input data
$db_host = trim($_POST['db_host']);
$db_user = trim($_POST['db_user']);
$db_pass = trim($_POST['db_pass']);
$db_name = trim($_POST['db_name']);

// write in config file
$filename = "../common/config/database.php";
$lines = file( realpath($filename) , FILE_IGNORE_NEW_LINES );
$lines[5] = '$db[\'default\'][\'hostname\'] = \'' . $db_host . '\';';
$lines[6] = '$db[\'default\'][\'username\'] = \'' . $db_user . '\';';
$lines[7] = '$db[\'default\'][\'password\'] = \'' . $db_pass . '\';';
$lines[8] = '$db[\'default\'][\'database\'] = \'' . $db_name . '\';';
file_put_contents( $filename , implode( "\n", $lines ) );

$sql_filename = 'easypanel.sql';
$sql_contents = file_get_contents($sql_filename);
$sql_contents = explode(";", $sql_contents);

if($db = new PDO("mysql:host=" . $db_host . ";dbname=" . $db_name, $db_user, $db_pass)) {
	echo 'OK';
} else {
	echo 'error';
}

foreach($sql_contents as $query) {
	$sth = $db->prepare($query);
	$sth->execute();

	if (!$sth) {
    echo "\nPDO::errorInfo():\n";
    print_r($db->errorInfo());
	}
}

