<?php
    include("header.php");
    include("DB/db_conect.php");
    $id = $_GET['id'];

				?>
    <table border="1" align="center">
        <tr>
            <th>Краіна</th>
            <th>Місто</th>
            <th>Вулиця</th>
            <th>№ будинку</th>
            <th>Індех</th>
        </tr>

<?php
if ($result = $mysqli->query("SELECT * FROM addreses WHERE id=".$id)) {
    while ($row = $result->fetch_assoc()) {
        if ($contry = $mysqli->query("SELECT * FROM contry WHERE id = " . $row['id_Contry'])) {
            while ($row_contry = $contry->fetch_assoc()) {
                if ($city = $mysqli->query("SELECT * FROM city WHERE id = " . $row['id_Citi'])) {
                    while ($row_city = $city->fetch_assoc()) {
                        if ($strets = $mysqli->query("SELECT * FROM strets WHERE id = " . $row['id_Stret'])) {
                            while ($row_stret = $strets->fetch_assoc()) {
                                echo "<tr>
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
include("footer.php");
?>