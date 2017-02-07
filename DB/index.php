<?php
	include("header.php");
	include("db_conect.php");
if(
	isset($_POST['directors']) && !empty($_POST['directors']) &&
	isset($_POST['name']) && !empty($_POST['name']) &&
	isset($_POST['duration']) && !empty($_POST['duration']) && is_numeric($_POST['duration']) &&
	isset($_POST['year']) && !empty($_POST['year']) && is_numeric($_POST['year']) &&
	isset($_POST['budjet']) && !empty($_POST['budjet']) && is_numeric($_POST['budjet']) &&
	isset($_POST['genres']) && !empty($_POST['genres']) &&
	isset($_POST['date']) && !empty($_POST['date']) &&
	isset($_POST['studion']) && !empty($_POST['studion'])
){
	function input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	$directors = $_POST['directors'];
	$name = input($_POST['name']);
	$duration = $_POST['duration'];
	$year = $_POST['year'];
	$budjet = $_POST['budjet'];
	$genres = $_POST['genres'];
	$date = $_POST['date'];
	$studion = $_POST['studion'];
	if ($year >= 1400 && $year <= date('Y') && $duration > 0 && $budjet > 0){
		$mysqli->query("
			INSERT INTO
				movies (id_directors, Name, id_genres, Duration, year, Biudjet, id_Studio, Date)
			VALUES
				('$directors','$name','$genres','$duration','$year','$budjet','$studion','$date')
		");
	}
	else { ?>
		<h3>Не коректні дані</h3>
<?php	}
}
if (isset($_POST['sort'])){
	$request = $request ." ORDER BY ".$_POST['sort'];

}
if(
	isset($_POST['num']) && !empty($_POST['num']) && is_numeric($_POST['num'])
){
	$mysqli->query("
						DELETE FROM movies
						WHERE id = " . $_POST['num']. ";"
	);
}
	include("cap_plates.php");
		if ($result = $mysqli->query($request)){
			while( $row = $result->fetch_assoc() ){
?>
			 <?php include ("plate.php");
			}
	}

?>

</table>

<center>
			<br>
			<form method="post" action="">
				<button name="sort" value="Name">Сортувати за ім'ям</button>
				<button name="sort" value="year">Сортувати за роком</button>
				<button name="sort" value="Biudjet">Сортувати за бюджетом</button>
			</form>
			<h1>Додати фільм:</h1>
			<form method="post" action="">
				<p>
					<label>Режисер:<br></label>
					<select  name="directors">
						<option disabled>Виберіть Режисера</option>
						<?php if ($result = $mysqli->query("SELECT id,L_Name FROM directors ")) {
									while ($row = $result->fetch_assoc()) {?>
						<option value="<?php echo $row['id']?>"><?php echo $row['L_Name']?></option>
							<?php	}
						}?>
					</select>
				</p>
				<p>
					Назва: <br> <input type="text" name="name" /><br />
				</p>
				<p>
					<label>Жанр:<br></label>
					<select  name="genres">
						<option disabled>Виберіть жанр</option>
						<?php if ($result = $mysqli->query("SELECT id,genres FROM genres ")) {
							while ($row = $result->fetch_assoc()) {?>
								<option value="<?php echo $row['id']?>"><?php echo $row['genres']?></option>
							<?php	}
						}?>
					</select>
				</p>
				<p>
					Тривальсть:<br> <input type="text" name="duration" /><br />
				</p>
				<p>
					Рік:<br> <input type="text" name="year" /><br />
				</p>
				<p>
					Бюджет:<br> <input type="text" name="budjet" /><br />
				</p>
				<p>
					<label>Студія:<br></label>
					<select  name="studion">
						<option disabled>Виберіть студію</option>
						<?php if ($result = $mysqli->query("SELECT id,Name_studio FROM studio ")) {
							while ($row = $result->fetch_assoc()) {?>
								<option value="<?php echo $row['id']?>"><?php echo $row['Name_studio']?></option>
							<?php	}
						}?>
					</select>
				</p>
				<p>
					Дата: <br><input type="date" name="date">
				</p>
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
				<input type="text" name="name_move" />
				<input type="submit" value="Пошук за назвою філму" />
				<br>
			</p>
		</form>
		<?php
		if(isset($_POST['name_move']) && !empty($_POST['name_move'])) {
			$name_move = $_POST['name_move'];
		include("cap_plates.php");
				$request = $request . " WHERE m.Name LIKE '%". $name_move ."%'";
				if ($result = $mysqli->query($request)){
					while( $row = $result->fetch_assoc() ){
						?>
						<?php include ("plate.php");?>
						<?php
					}
				}
			}
				?>
			</table>
	</center>
<?php
	include("footer.php");
?>
	