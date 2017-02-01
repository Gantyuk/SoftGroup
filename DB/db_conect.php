<?php
	$mysqli =  new mysqli("localhost", "root", "", "vidioteka");
	
	if (mysqli_connect_error()) {
		die('Ошибка подключения (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
	}
	$mysqli->query("SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
	$mysqli->query("SET CHARACTER SET 'utf8'");
	$request = "SELECT m.id, m.Name, d.S_Name  AS d_S_name, d.L_Name AS d_L_name , g.genres AS g_genres, m.Duration, m.year, m.Biudjet, s.Name_studio AS s_Name_studio, m.Date       
					FROM movies m
					INNER JOIN directors d  ON m.id_directors = d.id
                    INNER JOIN genres g ON m.id_genres = g.id
                    INNER JOIN studio s ON m.id_Studio = s.id";
?>