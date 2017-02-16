<?php
if (!empty($alert)):?>
    <h3><?php echo $alert; ?></h3>
    <?php
endif;

include(APP . "/views/layouts/cap_plates.php");
foreach ($movi as $row) {
    include(APP . "/views/layouts/plate.php");
} ?>

</table><br/>
<center>
    <a href="/mvc/main/add">
        <button>Додати фільм!!!</button>
    </a><br/><br/>
    <form method="post" action="">
        <button name="sort" value="Name">Сортувати за ім'ям</button>
        <button name="sort" value="year">Сортувати за роком</button>
        <button name="sort" value="Biudjet">Сортувати за бюджетом</button>
    </form>
    <form method="post" action="">
        <p>
            <label>Видалити Фільм: </label>
            <select name="delet">
                <option disabled>Фільм</option>
                <?php foreach ($movi as $row) { ?>
                    <option value="<?php echo $row['id'] ?>"><?php echo $row['Name'] ?></option>
                <?php } ?>
            </select>
            <input type="submit" value="Видалити!"/>
        </p>
    </form>
</center>