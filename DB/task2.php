<?php
include("header.php");
include("db_conect.php");
if(
	isset($_POST['name']) && !empty($_POST['name']) &&
	isset($_POST['contact']) && !empty($_POST['contact']) &&
	isset($_POST['town']) && !empty($_POST['town']) &&
	isset($_POST['street']) && !empty($_POST['street']) &&
	isset($_POST['_index']) && !empty($_POST['_index']) && is_numeric($_POST['_index']) &&
	isset($_POST['countries']) && !empty($_POST['countries'])

){
	function input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	$town = $_POST['town'];
	$street = input($_POST['street']);
	$index = $_POST['_index'];
	$contries = $_POST['countries'];
	$name = input($_POST['name']);
	$contact = input($_POST['contact']);
	if ($index > 0) {
		$mysqli->query("
			INSERT INTO
				address (id_countries, id_town, street, _index)
			VALUES
				('$contries','$town','$street', '$index')
		");
		$mysqli->query("
					INSERT INTO
						studio (Name_studio, id_Address, Contact)
					VALUES
						('$name','$mysqli->insert_id','$contact')
				");



}}
if(
	isset($_POST['num']) && !empty($_POST['num']) && is_numeric($_POST['num'])
){
	$mysqli->query("
						DELETE FROM studio
						WHERE id = " . $_POST['num']. ";"
	);
}
				?>
	<table border="1" align="center">
		<tr>
			<th>№</th>
			<th>Назва</th>
			<th>Адреса </th>
			<th>Контакт</th>
		</tr>

				<?php
if ($result = $mysqli->query("SELECT s.id, s.Name_studio, c.countries AS c_countries, t.town AS t_town, a.street AS a_street, a._index AS a_index, s.Contact     
					FROM studio s
					JOIN address a ON s.id_Address = a.id
                    JOIN countries c ON a.id_countries = c.id
                    JOIN town t ON a.id_town = t.id"
	)) {
		while ($row = $result->fetch_assoc()) {?>
			<tr>
				<td><?php echo $row['id']?></td>
				<td><?php echo $row['Name_studio']?></td>
				<td><?php echo $row['c_countries'] . ' ' . $row['t_town'] . ' ' . $row['a_street'] . ' ' . $row['a_index']?></td>
				<td><?php echo $row['Contact']?></td>
			</tr>
	<?php }
}?>
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
						<?php if ($result = $mysqli->query("SELECT * FROM countries ")) {
							while ($row = $result->fetch_assoc()) {?>
								<option value="<?php echo $row['id']?>"><?php echo $row['countries']?></option>
							<?php	}
						}?>
					</select>
				</p>
				<p>
					<label>Місто:<br></label>
					<select  name="town">
						<option disabled>Виберіть Місто</option>
						<?php if ($result = $mysqli->query("SELECT * FROM town ")) {
							while ($row = $result->fetch_assoc()) {?>
								<option value="<?php echo $row['id']?>"><?php echo $row['town']?></option>
							<?php	}
						}?>
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
	$name_studio = $_POST['name_studio'];
	include("cap_plates.php");
				$request = $request . " WHERE s.Name_studio LIKE '%". $name_studio ."%'";
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