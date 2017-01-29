<?php
	include("header.php");
	include("DB/db_conect.php");
if(
	isset($_POST['r_name']) && !empty($_POST['r_name']) && !is_numeric($_POST['r_name']) &&
	isset($_POST['name']) && !empty($_POST['name']) &&
	isset($_POST['duration']) && !empty($_POST['duration']) && is_numeric($_POST['duration']) &&
	isset($_POST['yer']) && !empty($_POST['yer']) && is_numeric($_POST['yer']) &&
	isset($_POST['budjet']) && !empty($_POST['budjet']) && is_numeric($_POST['budjet']) &&
	isset($_POST['janre']) && !empty($_POST['janre']) && !is_numeric($_POST['janre']) &&
	isset($_POST['date']) && !empty($_POST['date']) &&
	isset($_POST['studion']) && !empty($_POST['studion']) && !is_numeric($_POST['studion'])
){
	function input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	$r_name = input($_POST['r_name']);
	$name = input($_POST['name']);
	$duration = $_POST['duration'];
	$yer = $_POST['yer'];
	$budjet = $_POST['budjet'];
	$janr = input($_POST['janre']);
	$date = input($_POST['date']);
	$studion = input($_POST['studion']);
	$zap ="SELECT * FROM regisers WHERE  L_Name= '" . $r_name . "'";
	if ($yer >= 1400 && $yer <= date('Y') && $duration > 0 && $budjet > 0){
		if ($result = $mysqli->query($zap)) {
			while ($row = $result->fetch_assoc()) {
				if (!is_null($row)) {
					$r_name = $row['id'];
				}
			}
			if (!is_numeric($r_name)) {
				echo "<h3>Не коректні дані</h3>";
				exit;
			}
		}
		if ($result = $mysqli->query("SELECT * FROM janres WHERE  janre= '" . $janr . "'")) {
			while ($row = $result->fetch_assoc()) {
				if (!is_null($row)) {
					$janr = $row['id'];
				}
			}
			if (!is_numeric($janr)) {
				$mysqli->query("
						INSERT INTO	janres (janre)
						VALUES ( '$janr')
					");
				if ($result = $mysqli->query("SELECT * FROM janres WHERE  janre= '" . $janr . "'")) {
					while ($row = $result->fetch_assoc()) {
						$janr = $row['id'];
					}
				}
			}
		}
		if ($result = $mysqli->query("SELECT * FROM studions WHERE  Name_studion = '" . $studion . "'")) {
			while ($row = $result->fetch_assoc()) {
				if (!is_null($row)) {
					$studion = $row['id'];
				}
			}
			if (!is_numeric($studion)) {
				echo "<h3>Не коректні дані</h3>";
				exit;
			}
		}
		$mysqli->query("
			INSERT INTO
				movies (id_S_L_Name, Name, id_Janre, Duration, Yer, Biudjet, id_Studio, Date)
			VALUES
				('$r_name','$name','$janr','$duration','$yer','$budjet','$studion','$date')
		");
	}
}
if(
	isset($_POST['num']) && !empty($_POST['num']) && is_numeric($_POST['num'])
){
	$mysqli->query("
						DELETE FROM movies
						WHERE id = " . $_POST['num']. ";"
	);

}
?>
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
		if ($result = $mysqli->query('SELECT * FROM movies')){
			while( $row = $result->fetch_assoc() ){
				if ($name = $mysqli->query("SELECT * FROM regisers WHERE id = ".$row['id_S_L_Name'])){
					while( $row_regiser = $name->fetch_assoc() ){
						if ($janre = $mysqli->query("SELECT * FROM janres WHERE id = ".$row['id_Janre'])){
							while( $row_janre = $janre->fetch_assoc() ){
								if ($studios = $mysqli->query("SELECT * FROM studions WHERE id = ".$row['id_Studio'])){
									while( $row_studions = $studios->fetch_assoc() ){
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
?>
		<center>
			<h1>Додати фільм:</h1>
			<form method="post" action="">
				<p>
					<label>Режисер:<br></label>
					<input type="text" name="r_name"  list="r_list">
					<datalist id="r_list">
						<?php
						if ($citiz = $mysqli->query("SELECT * FROM regisers ")) {
							while ($row = $citiz->fetch_assoc()) {
								echo "<option >", $row['L_Name'], "</option >";
							}
						}
						?>
					</datalist><br />
				</p>
				<p>
					Назва: <br> <input type="text" name="name" /><br />
				</p>
				<p>
					<label>Жанр:<br></label>
					<input type="text" name="janre"  list="j_list">
					<datalist id="j_list">
						<?php
						if ($citiz = $mysqli->query("SELECT * FROM janres ")) {
							while ($row = $citiz->fetch_assoc()) {
								echo "<option >", $row['janre'], "</option >";
							}
						}
						?>
					</datalist><br />
				</p>
				<p>
					Тривальсть:<br> <input type="text" name="duration" /><br />
				</p>
				<p>
					Рік:<br> <input type="text" name="yer" /><br />
				</p>
				<p>
					Бюджет:<br> <input type="text" name="budjet" /><br />
				</p>
				<p>
					<label>Студія:<br></label>
					<input type="text" name="studion"  list="Stud_list">
					<datalist id="Stud_list">
						<?php
						if ($citiz = $mysqli->query("SELECT * FROM studions ")) {
							while ($row = $citiz->fetch_assoc()) {
								echo "<option >", $row['Name_studion'], "</option >";
							}
						}
						?>
					</datalist><br />
				</p>
				<p>
					Дата: <br><input type="date" name="date">
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
				<input type="submit" value="Пошук за назвою філму" />
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
			if ($result = $mysqli->query("SELECT * FROM movies WHERE Name LIKE '%" . $str . "%'")) {
				while ($row = $result->fetch_assoc()) {
					if ($name = $mysqli->query("SELECT * FROM regisers WHERE id = " . $row['id_S_L_Name'])) {
						while ($row_regiser = $name->fetch_assoc()) {
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
	