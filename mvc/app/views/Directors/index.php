<?php if(!empty($alert)):?>
            <h3><?php echo $alert; ?></h3>
    <?php
endif;
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
    foreach( $directors as $row){?>
        <tr>
            <td><?php echo $row['id']?></td>
            <td><?php echo $row['S_Name']?></td>
            <td><?php echo $row['L_Name']?></td>
            <td><?php echo $row['Y_Birth']?></td>
            <td><?php echo $row['Y_Death']?></td>
            <td><?php echo $row['c_countries']?></td>
        </tr>
    <?php } ?>
</table><br />
<center>
    <a href="/mvc/directors/add"><button >Додати режисера!!!</button></a><br /><br />
<form method="post" action="">
    <p>
        <label>Видалити Режисера: </label>
        <select  name="delet">
            <option disabled></option>
            <?php foreach( $directors as $row) { ?>
                <option value="<?php echo $row['id']?>"><?php echo $row['S_Name']?></option>
            <?php } ?>
        </select>
        <input type="submit" value="Видалити!" />
    </p>
</form>
    </center>