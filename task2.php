<?php
	include("header.php");
	require_once ("M/conect_db.php");
	require_once ("M/address.php");
	require_once ("M/studio.php");
	$mysqli = new Conect_db();
	if(
		isset($_POST['name']) && !empty($_POST['name']) &&
		isset($_POST['contact']) && !empty($_POST['contact']) &&
		isset($_POST['town']) && !empty($_POST['town']) &&
		isset($_POST['street']) && !empty($_POST['street']) &&
		isset($_POST['_index']) && !empty($_POST['_index']) && is_numeric($_POST['_index']) &&
		isset($_POST['countries']) && !empty($_POST['countries'])
	
	){
		$address = new Address();
		$address->setIdTown($_POST['town']);
		$address->setStreet(input($_POST['street']));
		$address->setIndex($_POST['_index']);
		$address->setIdCountries($_POST['countries']);
		$studio = new Studio();
		$studio->setNameStudio(input($_POST['name']));
		$studio->setContact(input($_POST['contact']));
		if ($address->getIndex() > 0) {
			$address->Add_to_DB($mysqli->getMysqli());
			$studio->setIdAddress($mysqli->getMysqli()->insert_id);
			$studio->Add_to_DB($mysqli->getMysqli());
		}}
	if(	isset($_POST['num']) && !empty($_POST['num']) && is_numeric($_POST['num'])){
		$mysqli->DeletId($_POST['num'],"studio");
	}
?>
	<table border="1" align="center">
		<tr>
			<th>№</th>
			<th>Назва</th>
			<th>Адреса </th>
			<th>Контакт</th>
		</tr>

		<?php foreach( $mysqli->Display_Studio() as $row){?>
				<tr>
					<td><?php echo $row['id']?></td>
					<td><?php echo $row['Name_studio']?></td>
					<td><?php echo $row['c_countries'] . ' ' . $row['t_town'] . ' ' . $row['a_street'] . ' ' . $row['a_index']?></td>
					<td><?php echo $row['Contact']?></td>
				</tr>
			<?php }?>
	</table>
	<center>
		<h1>Додати Студію:</h1>
		<form method="post" action="">
			<p>
				Назва: <br> <input type="text" name="name" /><br />
			</p>
			<p>
				Контакт:<br> <input type="text" name="contact" /><br />
			</p>
			<p>
				<label>Краіна:<br></label>
				<select  name="countries">
					<option disabled>Виберіть Країну</option>
					<?php foreach( $mysqli->Select("id,countries" , "countries") as $row) { ?>
						<option value="<?php echo $row['id']?>"><?php echo $row['countries']?></option>
					<?php } ?>
				</select>
			</p>
			<p>
				<label>Місто:<br></label>
				<select  name="town">
					<option disabled>Виберіть Місто</option>
					<?php foreach( $mysqli->Select("id,town" , "town") as $row) { ?>
						<option value="<?php echo $row['id']?>"><?php echo $row['town']?></option>
					<?php } ?>
				</select>
			</p>
			<p>
				<label>Вулиця:<br></label>
				<input type="text" name="street"  >
			</p>
			<p>
				Індех:<br> <input type="text" name="_index" /><br />
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
				<input type="text" name="name_studio" />
				<input type="submit" value="Пошук фільму за студією" />
				<br>
			</p>
		</form>
		<?php
		if(isset($_POST['name_studio']) && !empty($_POST['name_studio'])) {
			include("cap_plates.php");
			foreach( $mysqli->Display_Muvies_Search("s.Name_studio", $_POST['name_studio']) as $row){
				include ("plate.php");
			}
		}
		?>
		</table>
	</center>
<?php
	include("footer.php");
?>