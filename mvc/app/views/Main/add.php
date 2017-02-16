<center>
    <h1>Додати фільм:</h1>
    <form method="post" action="" name="add">
        <p>
            <label>Режисер:<br></label>
            <select name="directors">
                <option disabled>Виберіть Режисера</option>
                <?php foreach ($directors as $row) { ?>
                    <option value="<?php echo $row['id'] ?>"><?php echo $row['L_Name'] ?></option>
                <?php } ?>
            </select>
        </p>
        <p>
            Назва: <br> <input type="text" name="name"
                               value="<?php if (!empty($_POST['name'])) echo $_POST['name']; ?>"/>
            <?php if ($nameErr != '') echo '<span>' . $nameErr . '</span>'; ?> <br/>
        </p>
        <p>
            <label>Жанр:<br></label>
            <select name="genres">
                <option disabled>Виберіть жанр</option>
                <?php foreach ($genres as $row) { ?>
                    <option value="<?php echo $row['id'] ?>"><?php echo $row['genres'] ?></option>
                <?php } ?>
            </select>
        </p>
        <p>
            Тривальсть:<br> <input type="text" name="duration"
                                   value="<?php if (isset($_POST['duration'])) echo $_POST['duration']; ?>"/>
            <?php if ($durationErr != '') echo '<span>' . $durationErr . '</span>'; ?><br/>
        </p>
        <p>
            Рік:<br> <input type="text" name="year"
                            value="<?php if (isset($_POST['year'])) echo $_POST['year']; ?>"/>
            <?php if ($yearErr != '') echo '<span>' . $yearErr . '</span>'; ?><br/>
        </p>
        <p>
            Бюджет:<br> <input type="text" name="budjet"
                               value="<?php if (isset($_POST['budjet'])) echo $_POST['budjet']; ?>"/>
            <?php if ($budjetErr != '') echo '<span>' . $budjetErr . '</span>'; ?><br/>
        </p>
        <p>
            <label>Студія:<br></label>
            <select name="studion">
                <option disabled>Виберіть студію</option>
                <?php foreach ($studio as $row) { ?>
                    <option value="<?php echo $row['id'] ?>"><?php echo $row['Name_studio'] ?></option>
                <?php } ?>
            </select>
        </p>
        <p>
            Дата: <br><input type="date" name="date"
                             value="<?php if (isset($_POST['date'])) echo $_POST['date']; ?>"/>
            <?php if ($dateErr != '') echo '<span>' . $dateErr . '</span>'; ?>
        </p>
        <input type="submit" value="Додати!"/>
    </form>
</center>