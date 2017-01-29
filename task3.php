<?php
	include("header.php");
	include("DB/db_conect.php");
?>
	<form method="post" action="">
		<p>
			<label>Студія:<br></label>
			<input type="text" name="studi"  list="st_list">
			<datalist id="st_list">
				<?php
				if ($result = $mysqli->query("SELECT * FROM studions ")) {
					while ($row = $result->fetch_assoc()) {
						echo "<option >", $row['Name_studion'], "</option >";
					}
				}
				?>
			</datalist>
		<input type="submit" value="Пошук" />
		<br />
		</p>
	</form>
	<form method="post" action="">
		<p>
			<label>Режисер:<br></label>
			<input type="text" name="rejis"  list="rej_list">
			<datalist id="rej_list">
				<?php
				if ($result = $mysqli->query("SELECT * FROM regisers ")) {
					while ($row = $result->fetch_assoc()) {
						echo "<option >", $row['L_Name'], "</option >";
					}
				}
				?>
			</datalist>
			<input type="submit" value="Пошук" />
			<br />
		</p>
	</form>
<table border = "1">
	<tr>
		<th>№</th>
		<th>Режисер</th>
		<th>Назва</th>
		<th>Жанр</th>
		<th>Тривальсть</th>
		<th>Рік</th>
		<th>Бюджет</th>
		<th>Студія</th>
		<th>Дата поступлення</th>

	</tr>

	<?php
	if(isset($_POST['studi']) && !empty($_POST['studi'])) {
			$studi = $_POST['studi'];
		if ($studios = $mysqli->query("SELECT * FROM studions WHERE Name_studion = '" .$studi. "'")){
			while( $row_studions = $studios->fetch_assoc() ){
				if ($result = $mysqli->query("SELECT * FROM movies WHERE id_Studio =" .$row_studions['id'])){
					while( $row = $result->fetch_assoc() ){
						if ($name = $mysqli->query("SELECT * FROM regisers WHERE id = ".$row['id_S_L_Name'])){
							while( $row_regiser = $name->fetch_assoc() ){
								if ($janre = $mysqli->query("SELECT * FROM janres WHERE id = ".$row['id_Janre'])){
									while( $row_janre = $janre->fetch_assoc() ){
										echo "<tr><td>" , $row['id'] , "</td> 
				<td>" , $row_regiser['L_Name'] , ' ', $row_regiser['S_Name'] , "</td>
				<td>" , $row['Name'] , "</td>
				<td>" , $row_janre['janre'] , "</td>
				<td>" , $row['Duration'] , "</td>
				<td>" , $row['Yer'] , "</td>
				<td>" , $row['Biudjet'] , "</td>
				<td>" , $row_studions['Name_studion'] , "</td>
				<td>" , $row['Date'] , "</td>
		
	</tr>";
									}
								}
							}
						}
					}
				}
			}
		}
		echo '</table>';
	}
	if(isset($_POST['rejis']) && !empty($_POST['rejis'])) {
		$regis = $_POST['rejis'];
		if ($name = $mysqli->query("SELECT * FROM regisers WHERE L_Name ='" . $regis . "'")) {
			while ($row_regiser = $name->fetch_assoc()) {
				if ($result = $mysqli->query("SELECT * FROM movies WHERE id_S_L_Name = '" . $row_regiser['id'] . "'")) {
					while ($row = $result->fetch_assoc()) {
						if ($janre = $mysqli->query("SELECT * FROM janres WHERE id = " . $row['id_Janre'])) {
							while ($row_janre = $janre->fetch_assoc()) {
								if ($studios = $mysqli->query("SELECT * FROM studions WHERE id = " . $row['id_Studio'])) {
									while ($row_studions = $studios->fetch_assoc()) {
										echo "<tr><td>", $row['id'], "</td> 
				<td>", $row_regiser['L_Name'], ' ', $row_regiser['S_Name'], "</td>
				<td>", $row['Name'], "</td>
				<td>", $row_janre['janre'], "</td>
				<td>", $row['Duration'], "</td>
				<td>", $row['Yer'], "</td>
				<td>", $row['Biudjet'], "</td>
				<td>", $row_studions['Name_studion'], "</td>
				<td>", $row['Date'], "</td>
		
	</tr>";
									}
								}
							}
						}
					}
				}
			}
		}
		echo '</table>';

	}
	include("footer.php");
?>