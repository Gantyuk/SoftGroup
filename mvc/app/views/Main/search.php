<center xmlns="http://www.w3.org/1999/html">
    <form method="post" action="">
        <p>
        <p>
            <label>Пошук за студією:<br></label>
            <select  name="studion">
                <option disabled>Виберіть студію</option>
                <?php foreach( $studio as $row) { ?>
                    <option value="<?php echo $row['id']?>"><?php echo $row['Name_studio']?></option>
                <?php } ?>
            </select>
            <input type="submit" value="Пошук" />
        </p>
    </form>
    <form method="post" action="">
        <p>
            <label>Пошук за режисером:<br></label>
            <select  name="directors">
                <option disabled>Виберіть Режисера</option>
                <?php foreach( $directors as $row) {?>
                    <option value="<?php echo $row['id']?>"><?php echo $row['L_Name']?></option>
                <?php } ?>
            </select>
            <input type="submit" value="Пошук" />
            <br />
        </p>
    </form>
    <form method="post" action="">
        <label>Пошук по частині :<br></label>
        <input type="text" name="search_str"  /><br />
        <button name="search" value="m.Name">Назві фільму!</button>
        <button name="search" value="s.Name_studio">Назві студій!</button>
        <button name="search" value="d.S_Name">Прізвища режисера!</button>
    </form>
    <?php
    if(isset($movi) && !empty($movi)) {
        include(APP. "/views/layouts/cap_plates.php");
        foreach( $movi as $row){
            include (APP. "/views/layouts/plate.php");
        }
    }
    ?>
    </table>
</center>
