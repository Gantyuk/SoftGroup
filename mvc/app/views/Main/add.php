<center>
<h1>Додати фільм:</h1>
	<form method="post" action="">
		<p>
			<label>Режисер:<br></label>
			<select  name="directors">
				<option disabled>Виберіть Режисера</option>
				<?php foreach( $directors as $row) {?>
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
        <?php foreach( $genres as $row) { ?>
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
        <?php foreach( $studio as $row) { ?>
            <option value="<?php echo $row['id']?>"><?php echo $row['Name_studio']?></option>
        <?php } ?>
    </select>
</p>
<p>
    Дата: <br><input type="date" name="date">
</p>
<input type="submit" value="Додати!" />
</form>
</center>