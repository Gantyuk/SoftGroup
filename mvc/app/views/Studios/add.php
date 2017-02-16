<center>
    <h1>Додати Студію:</h1>
    <form method="post" action="">
        <p>
            Назва: <br> <input type="text" name="name"
                               value="<?php if (!empty($_POST['name'])) echo $_POST['name']; ?>"/>
            <?php if ($nameErr != '') echo '<span>' . $nameErr . '</span>'; ?>
        </p>
        <p>
            Контакт:<br> <input type="text" name="contact"
                                value="<?php if (!empty($_POST['contact'])) echo $_POST['contact']; ?>"/>
            <?php if ($contactErr != '') echo '<span>' . $contactErr . '</span>'; ?>
        </p>
        <p>
            <label>Краіна:<br></label>
            <select name="countries">
                <option disabled>Виберіть Країну</option>
                <?php foreach ($countries as $row) { ?>
                    <option value="<?php echo $row['id'] ?>"><?php echo $row['countries'] ?></option>
                <?php } ?>
            </select>
        </p>
        <p>
            <label>Місто:<br></label>
            <select name="town">
                <option disabled>Виберіть Місто</option>
                <?php foreach ($town as $row) { ?>
                    <option value="<?php echo $row['id'] ?>"><?php echo $row['town'] ?></option>
                <?php } ?>
            </select>
        </p>
        <p>
            <label>Вулиця:<br></label>
            <input type="text" name="street"
                   value="<?php if (!empty($_POST['street'])) echo $_POST['street']; ?>"/>
            <?php if ($stretErr != '') echo '<span>' . $stretErr . '</span>'; ?>
        </p>
        <p>
            Індех:<br> <input type="text" name="_index"
                              value="<?php if (!empty($_POST['_index'])) echo $_POST['_index']; ?>"/>
            <?php if ($_indexErr != '') echo '<span>' . $_indexErr . '</span>'; ?>
        </p>
        <input type="submit" value="Додати!"/>
    </form>
</center>