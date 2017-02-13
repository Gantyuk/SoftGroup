<?php if(!empty($alert)):?>
    <h3><?php echo $alert; ?></h3>
    <?php
endif;
?>
<table border="1" align="center">
    <tr>
        <th>№</th>
        <th>Назва</th>
        <th>Адреса </th>
        <th>Контакт</th>
    </tr>

    <?php foreach( $studio as $row){?>
        <tr>
            <td><?php echo $row['id']?></td>
            <td><?php echo $row['Name_studio']?></td>
            <td><?php echo $row['c_countries'] . ' ' . $row['t_town'] . ' ' . $row['a_street'] . ' ' . $row['a_index']?></td>
            <td><?php echo $row['Contact']?></td>
        </tr>
    <?php }?>
</table><br />
<center>
    <a href="/mvc/studios/add"><button >Додати студію!!!</button></a><br />
    <form method="post" action="">
        <p>
            <label>Видалити Режисера: </label>
            <select  name="delet">
                <option disabled></option>
                <?php foreach( $studio as $row) { ?>
                    <option value="<?php echo $row['id']?>"><?php echo $row['Name_studio']?></option>
                <?php } ?>
            </select>
            <input type="submit" value="Видалити!" />
        </p>
</form>
</center>