<?php
	include("header.php");
	require_once ("M/directors.php");
	require_once ("M/conect_db.php");
	$mysqli = new Conect_db();
if(
	isset($_POST['s_name']) && !empty($_POST['s_name']) &&
	isset($_POST['l_name']) && !empty($_POST['l_name']) &&
	isset($_POST['y_birth']) && !empty($_POST['y_birth']) && is_numeric($_POST['y_birth']) &&
	isset($_POST['countries']) && !empty($_POST['countries'])
){
	$directors = new Directors();
	$directors->setSName(input($_POST['s_name']));
	$directors->setLName(input($_POST['l_name']));
	$directors->setYBirth($_POST['y_birth']);
	$directors->setYDeath($_POST['y_death']);
	$directors->setIdContries($_POST['countries']);
	if ($directors->getYBirth() >= 1400 && $directors->getYBirth() <= date('Y')){
		$directors->Add($mysqli->getMysqli());
	}
}
if(	isset($_POST['num']) && !empty($_POST['num']) && is_numeric($_POST['num'])){
	$mysqli->DeletId($_POST['num'],"directors");
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
foreach( $mysqli->Display_Directors() as $row){?>
	<tr>
		<td><?php echo $row['id']?></td>
		<td><?php echo $row['S_Name']?></td>
		<td><?php echo $row['L_Name']?></td>
		<td><?php echo $row['Y_Birth']?></td>
		<td><?php echo $row['Y_Death']?></td>
		<td><?php echo $row['c_countries']?></td>
	</tr>
<?php } ?>
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
				<?php foreach( $mysqli->Select("id,countries" , "countries") as $row) { ?>
					<option value="<?php echo $row['id']?>"><?php echo $row['countries']?></option>
				<?php } ?>
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
		include("cap_plates.php");
		foreach( $mysqli->Display_Muvies_Search("d.S_Name", $_POST['name_directors']) as $row){
			include ("plate.php");
		}
	}?>
	</table>
</center>	
<?php
	include("footer.php");
?>

