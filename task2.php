<?php
	include("header.php");
	define('filename', 'data.txt');
	function compare ($v1, $v2) {
		return strnatcmp($v1[4],$v2[4]);}
	$array = array();
	if(file_exists(filename)){
		$lines = file(filename);
		if(is_array($lines)){
			foreach($lines as $line){
				$array[] = split("\t", $line);
			}
			usort($array,'compare');
			echo '<hr/><pre><br />';
			$i = 1;
			$countMath = 0;
			$sumMath = 0;
			foreach($array as $arr){
				if($arr[1] == "Україна") {
					$countMath++;
					$sumMath+=$arr[4];
				}
				echo $i, ' ', implode($arr,' '), '<br />';
				$i++;
			}
			echo '<hr/></pre>';
			echo "<h3>Середній бюджет фільмів, що були зняті в Україні: ";
			echo $sumMath/$countMath;
			echo "</h3>";
		}
		
	}
	include("footer.php");
?>