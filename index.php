<?php
	include("header.php");
	require_once ("M/conect_db.php");
	require_once ("M/movies.php");
	$mysqli = new Conect_db();
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
	$movi = new movies();
	$movi->setIdDirectors( $_POST['directors']);
	$movi->setName(input($_POST['name']));
	$movi->setDuration($_POST['duration']);
	$movi->setYear($_POST['year']);
	$movi->setBiudjet($_POST['budjet']);
	$movi->setIdGenres($_POST['genres']);
	$movi->setDate($_POST['date']);
	$movi->setIdStudio($_POST['studion']);
	if ($movi->getYear() >= 1400 && $movi->getYear() <= date('Y') && $movi->getDuration() > 0 && $movi->getBiudjet() > 0){
		$movi->Add($mysqli->getMysqli());
	}
	else { ?>
		<h3>Не коректні дані</h3>
	<?php	}
}
if (isset($_POST['sort'])){
	$mysqli->Movies_Sort($_POST["sort"]);
}
if(	isset($_POST['num']) && !empty($_POST['num']) && is_numeric($_POST['num'])){
	$mysqli->DeletId($_POST['num'],"movies");
}
include("cap_plates.php");
foreach( $mysqli->Display_Muvies() as $row){
		include ("plate.php");
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
				<?php foreach( $mysqli->Select("id,L_Name" ,"directors") as $row) {?>
						<option value="<?php echo $row['id']?>"><?php echo $row['L_Name']?></option>
				<?php } ?>
			</select>
		</p>
		<p>
			Назва: <br> <input type="text" name="name" /><br />
		</p>
		<p>
			<label>Жанр:<br></label>
			<select  name="genres">
				<option disabled>Виберіть жанр</option>
				<?php foreach( $mysqli->Select("id,genres" , "genres") as $row) { ?>
					<option value="<?php echo $row['id']?>"><?php echo $row['genres']?></option>
				<?php } ?>
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
				<?php foreach( $mysqli->Select("id,Name_studio" , "studio") as $row) { ?>
						<option value="<?php echo $row['id']?>"><?php echo $row['Name_studio']?></option>
					<?php } ?>
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
		include("cap_plates.php");
		foreach( $mysqli->Display_Muvies_Search("m.Name", $_POST['name_move']) as $row){
				include ("plate.php");
		}
	}
	?>
	</table>
</center>
<?php include("footer.php");?>