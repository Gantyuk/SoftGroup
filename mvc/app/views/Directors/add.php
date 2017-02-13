<center>
    <h1>Додати Режисера:</h1>
    <form method="post" action="">
        <p>
            Ім'я: <br> <input type="text" name="l_name" /><br />
        </p>
        <p>
            Прізивща: <br> <input type="text" name="s_name" /><br />
        </p>
        <p>
            Рік народження:<br> <input type="text" name="y_birth" /><br />
        </p>
        <p>
            Рік смерті:<br> <input type="text" name="y_death" /><br />
        </p>
        <p>
            <label>Громадянство:<br></label>
            <select  name="countries">
                <option disabled>Виберіть Країну</option>
                <?php foreach( $countries as $row) { ?>
                    <option value="<?php echo $row['id']?>"><?php echo $row['countries']?></option>
                <?php } ?>
            </select>
        </p>
        <input type="submit" value="Додати!" />
    </form>
</center>