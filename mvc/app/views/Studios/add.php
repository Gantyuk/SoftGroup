<center>
    <h1>Додати Студію:</h1>
    <form method="post" action="">
        <p>
            Назва: <br> <input type="text" name="name" /><br />
        </p>
        <p>
            Контакт:<br> <input type="text" name="contact" /><br />
        </p>
        <p>
            <label>Краіна:<br></label>
            <select  name="countries">
                <option disabled>Виберіть Країну</option>
                <?php foreach( $countries as $row) { ?>
                    <option value="<?php echo $row['id']?>"><?php echo $row['countries']?></option>
                <?php } ?>
            </select>
        </p>
        <p>
            <label>Місто:<br></label>
            <select  name="town">
                <option disabled>Виберіть Місто</option>
                <?php foreach( $town as $row) { ?>
                    <option value="<?php echo $row['id']?>"><?php echo $row['town']?></option>
                <?php } ?>
            </select>
        </p>
        <p>
            <label>Вулиця:<br></label>
            <input type="text" name="street"  >
        </p>
        <p>
            Індех:<br> <input type="text" name="_index" /><br />
        </p>
        <input type="submit" value="Додати!" />
    </form>
</center>