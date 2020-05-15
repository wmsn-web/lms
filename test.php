<?php
$db = mysqli_connect("localhost","root","","new_mlm");
$under_userid = "U-209515";
$total_count=10;
		$i=1;
		
			$i;
			$q = mysqli_query($db,"SELECT * FROM tree WHERE userid='$under_userid'");
			while($r = mysqli_fetch_array($q))
				echo $current_temp_side_count = $r['rightcount']+1;
			$i++;
			
		}
