<?php
	$mysqli =  new mysqli("localhost", "root", "", "vidioteka");
	
	if (mysqli_connect_error()) {
		die('Ошибка подключения (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
	}
	$mysqli->query("SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
	$mysqli->query("SET CHARACTER SET 'utf8'");
?>