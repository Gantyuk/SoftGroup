<?php
	include("header.php");
	include("DB/db_conect.php");
?>
	<form method="post" action="">
		<p>
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
		<input type="submit" value="Пошук" />
		<br />
		</p>
	</form>
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
			<input type="submit" value="Пошук" />
			<br />
		</p>
	</form>
<?php
	if(isset($_POST['studion']) && !empty($_POST['studion'])) {
include("cap_plates.php");
	$studion = $_POST['studion'];
		$request1 = $request . " WHERE s.id = " . $studion ;
			if ($result = $mysqli->query($request1)){
					while( $row = $result->fetch_assoc() ){
						?>
						<?php include ("plate.php");?>
						<?php
					}
				}
	}
	if(isset($_POST['directors']) && !empty($_POST['directors'])) {
include("cap_plates.php");
	$directors = $_POST['directors'];
 	$request2 = $request . " WHERE d.id = ". $directors ;
			if ($result = $mysqli->query($request2)){
					while( $row = $result->fetch_assoc() ){
						?>
						<?php include ("plate.php");?>
						<?php
					}
				}
	}?>
</table>
<?php
	include("footer.php");
?>