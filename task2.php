<?php
include("header.php");
include("DB/db_conect.php");
if(
	isset($_POST['adres']) && !empty($_POST['adres']) &&
	isset($_POST['name']) && !empty($_POST['name']) &&
	isset($_POST['cont']) && !empty($_POST['cont'])
){
	function input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	$name = input($_POST['name']);
	$adres = input($_POST['adres']);
	$cont = input($_POST['cont']);
	$zap ="SELECT * FROM addreses WHERE _index = '" .$adres. "'";
	$fl = 0;
		if ($result = $mysqli->query($zap)) {
			while ($row = $result->fetch_assoc()) {
				if (!is_null($row)) {
					$adres = $row['id'];
					$fl = 1;
				}
			}
			if (!is_numeric($adres)) {
				echo "<h4>Не вірний індех адрес</h4>";
			}
			elseif ($fl == 1){
				$mysqli->query("
					INSERT INTO
						studions (Name_studion, id_Adres, Contact)
					VALUES
						('$name','$adres','$cont')
				");
			}
			else{
				echo "<h4>Не вірний індех адрес</h4>";
			}

		}


}
if(
	isset($_POST['num']) && !empty($_POST['num']) && is_numeric($_POST['num'])
){
	$mysqli->query("
						DELETE FROM studions
						WHERE id = " . $_POST['num']. ";"
	);

}

				?>
	<table border="1" align="center">
		<tr>
			<th>№</th>
			<th>Назва</th>
			<th>Адреса індех</th>
			<th>Контакт</th>
		</tr>

				<?php
if ($result = $mysqli->query("SELECT * FROM studions")) {
	while ($row = $result->fetch_assoc()) {
		if ($adres = $mysqli->query("SELECT * FROM addreses WHERE id = " . $row['id_Adres'])) {
			while ($row_adres = $adres->fetch_assoc()) {
				echo "<tr>
						<td>", $row['id'], "</td> 
						<td>", $row['Name_studion'], "</td>
						<td><a href='adres.php?id=", $row['id_Adres'] , "'> ", $row_adres['_index'], "</a></td>
						<td>", $row['Contact'], "</td>		
					</tr>";
			}
		}
	}
}
echo "</table>";
?>
		<center>
			<h1>Додати Студію:</h1>
			<form method="post" action="">
				<p>
					<label>Адрес індех:<br></label>
					<input type="text" name="adres"  list="adr_list">
					<datalist id="adr_list">
						<?php
						if ($result = $mysqli->query("SELECT * FROM addreses ")) {
							while ($row = $result->fetch_assoc()) {
								echo "<option >", $row['_index'], "</option >";
							}
						}
						?>
					</datalist><br />
					<h2><a href="add_adres.php">Додати новий індех!</a></h2>
				</p>
				<p>
					Назва: <br> <input type="text" name="name" /><br />
				</p>

				<p>
					Контакт:<br> <input type="text" name="cont" /><br />
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
			<input type="submit" value="Пошук фільму за студією" />
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
	if ($studios = $mysqli->query("SELECT * FROM studions WHERE Name_studion LIKE '%" .$str. "%'")){
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
}
echo '</table> </center>';

	include("footer.php");
?>