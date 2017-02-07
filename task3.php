<?php
	include("header.php");
	require_once ("M/conect_db.php");
	$mysqli = new Conect_db()
?>
	<form method="post" action="">
		<p>
		<p>
			<label>Студія:<br></label>
			<select  name="studion">
				<option disabled>Виберіть студію</option>
				<?php foreach( $mysqli->Select("id,Name_studio" , "studio") as $row) { ?>
					<option value="<?php echo $row['id']?>"><?php echo $row['Name_studio']?></option>
				<?php } ?>
			</select>
		<input type="submit" value="Пошук" />
		<br />
		</p>
	</form>
	<form method="post" action="">
		<p>
			<label>Режисер:<br></label>
			<select  name="directors">
				<option disabled>Виберіть Режисера</option>
				<?php foreach( $mysqli->Select("id,L_Name" ,"directors") as $row) {?>
					<option value="<?php echo $row['id']?>"><?php echo $row['L_Name']?></option>
				<?php } ?>
			</select>
			<input type="submit" value="Пошук" />
			<br />
		</p>
	</form>
<?php
	if(isset($_POST['studion']) && !empty($_POST['studion'])) {
		include("cap_plates.php");
		foreach ($mysqli->Display_Muvies_Search("s.id", $_POST['studion']) as $row) {
			include("plate.php");
		}
	}
	if(isset($_POST['directors']) && !empty($_POST['directors'])) {
		include("cap_plates.php");
		foreach ($mysqli->Display_Muvies_Search("d.id", $_POST['directors']) as $row) {
			include("plate.php");
		}
	}?>
</table>
<?php	include("footer.php");?>