<center>
    <h1>Додати Режисера:</h1>
    <form method="post" action="">
        <p>
            Ім'я: <br> <input type="text" name="l_name"
                              value="<?php if (!empty($_POST['l_name'])) echo $_POST['l_name']; ?>"/>
            <?php if ($L_nameErr != '') echo '<span>' . $L_nameErr . '</span>'; ?> <br/>
        </p>
        <p>
            Прізвище: <br> <input type="text" name="s_name"
                                  value="<?php if (!empty($_POST['s_name'])) echo $_POST['s_name']; ?>"/>
            <?php if ($S_nameErr != '') echo '<span>' . $S_nameErr . '</span>'; ?> <br/>
        </p>
        <p>
            Рік народження:<br> <input type="text" name="y_birth"
                                       value="<?php if (!empty($_POST['y_birth'])) echo $_POST['y_birth']; ?>"/>
            <?php if ($y_birthErr != '') echo '<span>' . $y_birthErr . '</span>'; ?> <br/>
        </p>
        <p>
            Рік смерті:<br> <input type="text" name="y_death"
                                   value="<?php if (!empty($_POST['y_death'])) echo $_POST['y_death']; ?>"/>
            <?php if ($y_deathErr != '') echo '<span>' . $y_deathErr . '</span>'; ?> <br/>
        </p>
        <p>
            <label>Громадянство:<br></label>
            <select name="countries">
                <option disabled>Виберіть Країну</option>
                <?php foreach ($countries as $row) { ?>
                    <option value="<?php echo $row['id'] ?>"><?php echo $row['countries'] ?></option>
                <?php } ?>
            </select>
        </p>
        <input type="submit" value="Додати!"/>
    </form>
</center>