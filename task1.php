<?php
	include("header.php");
	define('filename', 'data.txt');
	if(
		isset($_POST['nam']) && !empty($_POST['nam']) &&
		isset($_POST['contry']) && !empty($_POST['contry']) &&
		isset($_POST['genre']) && !empty($_POST['genre']) &&
		isset($_POST['yer']) && !empty($_POST['yer']) && is_numeric($_POST['yer']) &&
		isset($_POST['budget']) && !empty($_POST['budget']) && is_numeric($_POST['budget']) &&
		isset($_POST['fname_lname_autor']) && !empty($_POST['fname_lname_autor'])
	){
		function input($data) {
		  $data = trim($data);
		  $data = stripslashes($data);
		  $data = htmlspecialchars($data);
		  return $data;
		}
		$nam = input($_POST['nam']);
		$contry = input($_POST['contry']);
		$genre = input($_POST['genre']);
		$yer = input($_POST['yer']);
		$budget = input($_POST['budget']);
		$fname_lname_autor = input($_POST['fname_lname_autor']);
		
		$str = $nam . "\t" . $contry . "\t" . $genre . "\t" . $yer . "\t" . $budget  . "\t" . $fname_lname_autor . "\r\n";
		
		$f = fopen(filename, 'a');
		if(is_resource($f)){
			fputs($f, $str);
			fclose($f);
		}
		header('Location: ' . $_SERVER['PHP_SELF']);
		exit;
	}
	if(file_exists('data.txt')){
		$lines = file('data.txt');
		if(is_array($lines)){
			echo '<hr/><pre><br />';
			$i = 1;
			foreach($lines as $line){
				echo $i, ' ', $line, '<br />';
				$i++;
			}
			echo '<hr/></pre>';
		}
		
	}
?>
	<center>
	<h1>Додати фільм:</h1>
	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<p>
			Назва фільму: <br> <input type="text" name="nam" /><br />
		</p>
		<p>
			Країна, у якій створено фільм: <br> <input type="text" name="contry" /><br />
		</p>
		<p>
			Жанр:<br> <input type="text" name="genre" /><br />
		</p>
		<p>
			Рік створення:<br> <input type="text" name="yer" /><br />
		</p>
		<p>
			Бюджет фільму: <br><input type="text" name="budget" /><br />
		</p>
		<p>
			Прізвище та ім’я режисера, що зняв фільм: <br><input type="text" name="fname_lname_autor" /><br />
		</p>
		<br />
		<input type="submit" value="Додати!" />
	</form>
	</center>
<?php
	include("footer.php");
?>