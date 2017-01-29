<?php
	include("header.php");
	include("DB/db_conect.php");
if(
	isset($_POST['s_name']) && !empty($_POST['s_name']) &&
	isset($_POST['l_name']) && !empty($_POST['l_name']) &&
	isset($_POST['y_bird']) && !empty($_POST['y_bird']) && is_numeric($_POST['y_bird']) &&
	isset($_POST['contry']) && !empty($_POST['contry'])
){
	function input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	$s_name = input($_POST['s_name']);
	$l_name = input($_POST['l_name']);
	$y_bird = input($_POST['y_bird']);
	$y_ded = $_POST['y_ded'];
	$cont = input($_POST['contry']);
	$zap ="SELECT * FROM contry WHERE Contry = '" .$cont. "'";
	if ($y_bird >= 1400 && $y_bird <= date('Y')){
		if ($citiza = $mysqli->query($zap)) {
			while ($row = $citiza->fetch_assoc()) {
				if (!is_null($row)) {
					$cont = $row['id'];
				}}
			if (!is_numeric($cont)) {
					$mysqli->query("
						INSERT INTO	contry (Contry)
						VALUES ( '$cont')
					");
					if ($citiza = $mysqli->query($zap)) {
						while ($row = $citiza->fetch_assoc()) {
							$cont = $row['id'];
						}
					}
			}


		}
		$mysqli->query("
			INSERT INTO
				regisers (S_Name, L_Name, Y_Byrd, Y_Dead, id_Citizeche)
			VALUES
				('$s_name','$l_name','$y_bird','$y_ded','$cont')
		");
	}
}
if(
	isset($_POST['num']) && !empty($_POST['num']) && is_numeric($_POST['num'])
){
	$mysqli->query("
						DELETE FROM regisers
						WHERE id = " . $_POST['num']. ";"
	);

}
?>
	<table border="1" align="center">
	<tr>
		<th>№</th>
		<th>Прізвиша</th>
		<th>Ім'я</th>
		<th>Рік народження</th>
		<th>Рік смерті</th>
		<th>Громадянство</th>

	</tr>

<?php

if ($result = $mysqli->query("SELECT * FROM regisers")) {
	while ($row = $result->fetch_assoc()) {
		if ($citizen = $mysqli->query("SELECT * FROM contry WHERE id = " . $row['id_Citizeche'])) {
			while ($row_contry = $citizen->fetch_assoc()) {
					echo "<tr><td>", $row['id'], "</td> 
					<td>", $row['S_Name'], "</td>
					<td>", $row['L_Name'], "</td>
					<td>", $row['Y_Byrd'], "</td>
					<td>", $row['Y_Dead'], "</td>
					<td>", $row_contry['Contry'], "</td>		
				</tr>
			";
				}
			}
		}
	}
?>
	</table>
<center>
<h1>Додати Режисера:</h1>
<form method="post" action="">
	<p>
		Ім'я: <br> <input type="text" name="l_name" /><br />
	</p>
	<p>
		Прізивща: <br> <input type="text" name="s_name" /><br />
	</p>
	<p>
		Рік народження:<br> <input type="text" name="y_bird" /><br />
	</p>
	<p>
		Рік смерті:<br> <input type="text" name="y_ded" /><br />
	</p>
	<p>
		<label>Громадянство:<br></label>
		<input type="text" name="contry"  list="Contry_list">
		<datalist id="Contry_list">
			<?php
			if ($citiz = $mysqli->query("SELECT * FROM contry ")) {
				while ($row = $citiz->fetch_assoc()) {
					echo "<option >", $row['Contry'], "</option >";
				}
			}
			?>
		</datalist><br />
	</p>
	<br />
	<input type="submit" value="Додати!" />
	</form>
	<form method="post" action="">
	<p>
		Видалити №: <br> <input type="text" name="num" /><br />
	</p>
		<input type="submit" value="Видалити!" />
	</form>
	<form method="post" action="">
		<p>
			<input type="text" name="str" />
			<input type="submit" value="Пошук фільму за режисером" />
			<br>
		</p>
	</form>
	<?php
	if(isset($_POST['str']) && !empty($_POST['str'])) {
	$str = $_POST['str'];
	?>
	<table border="1">
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
		if ($name = $mysqli->query("SELECT * FROM regisers WHERE L_Name LIKE '%" . $str . "%'")) {
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
	}
		echo '</table> </center>';
	include("footer.php");
?>

