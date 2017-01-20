<?php
	include("header.php");
	define('filename', 'data.txt');
	$array = array();
?>
	
	<p>
		Введіть набір символів:
	</p>
	
	<form method="post" action="">
		<p>
			<input type="text" name="symbol" />     
			<input type="submit" value="Знайти" />
			<br>
			<i>
				*Символи розділити пробілами.
			</i>
		</p>
	</form>
<?php	
	if(isset($_POST['symbol']) && !empty($_POST['symbol'])){
		$symbol = split(" ",$_POST['symbol']);
		if(file_exists(filename)){
			$lines = file(filename);
			if(is_array($lines)){
				foreach($lines as $line){
					$array[] = split("\t", $line);
				}
				echo '<hr/><pre><br />';
				$i = 1;
				foreach($array as $arr){
					foreach($symbol as $sym){
						if(substr_count($arr[0],$sym)>0) {
							echo $i, ' ', implode($arr,' '), '<br />';
							$i++;
							break;
						}
						
					}
				}
				echo '<hr/></pre>';
			}
			
		}
	}
	include("footer.php");
?>