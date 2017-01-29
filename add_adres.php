<?php
    include("header.php");
    include("DB/db_conect.php");
if(
    isset($_POST['city']) && !empty($_POST['city']) &&
    isset($_POST['stret']) && !empty($_POST['stret']) &&
    isset($_POST['_index']) && !empty($_POST['_index']) && is_numeric($_POST['_index']) &&
    isset($_POST['num_hom']) && !empty($_POST['num_hom']) && is_numeric($_POST['num_hom']) &&
    isset($_POST['contry']) && !empty($_POST['contry'])
){
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $city = input($_POST['city']);
    $stret = input($_POST['stret']);
    $index = input($_POST['_index']);
    $num_hom = $_POST['num_hom'];
    $cont = input($_POST['contry']);
    $zap ="SELECT * FROM contry WHERE Contry = '" .$cont. "'";
    if ($index > 0 && $num_hom > 0){
        if ($citiza = $mysqli->query($zap)) {
            while ($row = $citiza->fetch_assoc()) {
                if (!is_null($row)) {
                    $cont = $row['id'];
                }
            }
            if (!is_numeric($cont)) {
                $mysqli->query("
						INSERT INTO	contry (Contry)
						VALUES ( '$cont')
					");
                if ($citiza = $mysqli->query($zap)) {
                    while ($row = $citiza->fetch_assoc()) {
                        $cont = $row['id'];
                    }
                }
            }
        }
        if ($rezult = $mysqli->query("SELECT * FROM city WHERE City = '" . $city . "'")) {
            while ($row = $rezult->fetch_assoc()) {
                if (!is_null($row)) {
                    $city = $row['id'];
                }
            }
            if (!is_numeric($city)) {
                $mysqli->query("
						INSERT INTO	city (City)
						VALUES ( '$city')
					");
                if ($citiza = $mysqli->query("SELECT * FROM city WHERE City = '" . $city . "'")) {
                    while ($row = $citiza->fetch_assoc()) {
                        $city = $row['id'];
                    }
                }
            }
        }
        if ($rezult = $mysqli->query("SELECT * FROM strets WHERE stret = '" . $stret . "'")) {
            while ($row = $rezult->fetch_assoc()) {
                if (!is_null($row)) {
                    $stret = $row['id'];
                }
            }
            if (!is_numeric($stret)) {
                $mysqli->query("
						INSERT INTO	strets (stret)
						VALUES ( '$stret')
					");
                if ($citiza = $mysqli->query("SELECT * FROM strets WHERE stret = '" .$stret. "'")) {
                    while ($row = $citiza->fetch_assoc()) {
                        $stret = $row['id'];
                    }
                }
            }
        }
        $mysqli->query("
			INSERT INTO
				addreses (id_Contry, id_Citi, id_Stret, Home, _index)
			VALUES
				('$cont','$city','$stret','$num_hom','$index')
		");
    }
}
if(
    isset($_POST['num']) && !empty($_POST['num']) && is_numeric($_POST['num'])
){
    $mysqli->query("
						DELETE FROM addreses
						WHERE id = " . $_POST['num']. ";"
    );

}
				?>
<table border="1" align="center">
    <tr>
        <th>№</th>
        <th>Краіна</th>
        <th>Місто</th>
        <th>Вулиця</th>
        <th>№ будинку</th>
        <th>Індех</th>
    </tr>

    <?php
    if ($result = $mysqli->query("SELECT * FROM addreses ")) {
        while ($row = $result->fetch_assoc()) {
            if ($contry = $mysqli->query("SELECT * FROM contry WHERE id = " . $row['id_Contry'])) {
                while ($row_contry = $contry->fetch_assoc()) {
                    if ($city = $mysqli->query("SELECT * FROM city WHERE id = " . $row['id_Citi'])) {
                        while ($row_city = $city->fetch_assoc()) {
                            if ($strets = $mysqli->query("SELECT * FROM strets WHERE id = " . $row['id_Stret'])) {
                                while ($row_stret = $strets->fetch_assoc()) {
                                    echo "<tr>
                                        <td>", $row['id'], "</td> 
                                        <td>", $row_contry['Contry'], "</td> 
                                        <td>", $row_city['City'], "</td>
                                        <td>", $row_stret['stret'], "</td>
                                        <td>", $row['Home'], "</td>
                                        <td>", $row['_index'], "</td>		
                                    </tr>";
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    echo "</table>";
?>
<center>
<h1>Додати Адрес:</h1>
<form method="post" action="">
    <p>
        <label>Краіна:<br></label>
        <input type="text" name="contry"  list="Contry_list">
        <datalist id="Contry_list">
            <?php
            if ($citiz = $mysqli->query("SELECT * FROM contry ")) {
                while ($row = $citiz->fetch_assoc()) {
                    echo "<option >", $row['Contry'], "</option >";
                }
            }
            ?>
        </datalist><br />
    </p>
    <p>
        <label>Місто:<br></label>
        <input type="text" name="city"  list="City_list">
        <datalist id="City_list">
            <?php
            if ($citiz = $mysqli->query("SELECT * FROM city ")) {
                while ($row = $citiz->fetch_assoc()) {
                    echo "<option >", $row['City'], "</option >";
                }
            }
            ?>
        </datalist><br />
    </p>
    <p>
        <label>Вулиця:<br></label>
        <input type="text" name="stret"  list="Stret_list">
        <datalist id="Stret_list">
            <?php
            if ($citiz = $mysqli->query("SELECT * FROM strets ")) {
                while ($row = $citiz->fetch_assoc()) {
                    echo "<option >", $row['stret'], "</option >";
                }
            }
            ?>
        </datalist><br />
    </p>
	<p>
        № Будинку:<br> <input type="text" name="num_hom" /><br />
	</p>
	<p>
        Індех:<br> <input type="text" name="_index" /><br />
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
    <h2><a href="task2.php">Назад</a> </h2>
</center>

<?php
include("footer.php");
?>