<?php
	include("header.php");
	include("DB/db_conect.php");
if(
	isset($_POST['s_name']) && !empty($_POST['s_name']) &&
	isset($_POST['l_name']) && !empty($_POST['l_name']) &&
	isset($_POST['y_birth']) && !empty($_POST['y_birth']) && is_numeric($_POST['y_birth']) &&
	isset($_POST['countries']) && !empty($_POST['countries'])
){
	function input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	$s_name = input($_POST['s_name']);
	$l_name = input($_POST['l_name']);
	$y_birth = $_POST['y_birth'];
	$y_death = $_POST['y_death'];
	$countries = $_POST['countries'];
	if ($y_birth >= 1400 && $y_birth <= date('Y')){
		$mysqli->query("
			INSERT INTO
				directors (S_Name, L_Name, Y_Birth, Y_Death, id_contries)
			VALUES
				('$s_name','$l_name','$y_birth','$y_death','$countries')
		");
	}
}
if(
	isset($_POST['num']) && !empty($_POST['num']) && is_numeric($_POST['num'])
){
	$mysqli->query("
						DELETE FROM directors
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

if ($result = $mysqli->query(
	"SELECT d.id, d.S_Name, d.L_Name, d.Y_Birth, d.Y_Death, c.countries AS c_countries      
					FROM directors d
					JOIN countries c ON d.id_contries = c.id"
	)) {
	while ($row = $result->fetch_assoc()) {?>
	<tr>
		<td><?php echo $row['id']?></td>
		<td><?php echo $row['S_Name']?></td>
		<td><?php echo $row['L_Name']?></td>
		<td><?php echo $row['Y_Birth']?></td>
		<td><?php echo $row['Y_Death']?></td>
		<td><?php echo $row['c_countries']?></td>
	</tr>
<?php }
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
			Рік народження:<br> <input type="text" name="y_birth" /><br />
		</p>
		<p>
			Рік смерті:<br> <input type="text" name="y_death" /><br />
		</p>
		<p>
			<label>Громадянство:<br></label>
			<select  name="countries">
				<option disabled>Виберіть Країну</option>
				<?php if ($result = $mysqli->query("SELECT * FROM countries ")) {
					while ($row = $result->fetch_assoc()) {?>
						<option value="<?php echo $row['id']?>"><?php echo $row['countries']?></option>
					<?php	}
				}?>
			</select>
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
			<input type="text" name="name_directors" />
			<input type="submit" value="Пошук фільму за режисером" />
			<br>
		</p>
	</form>
	<?php
	if(isset($_POST['name_directors']) && !empty($_POST['name_directors'])) {
	$name_directors = $_POST['name_directors'];
	include("cap_plates.php");
		$request = $request . " WHERE d.S_Name LIKE '%". $name_directors ."%'";
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

