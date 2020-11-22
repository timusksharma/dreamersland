<?php
  date_default_timezone_set("Asia/Kolkata");

  echo date_default_timezone_get();
  echo"<br>".date("Y-m-d H:i:s");
  echo"<br>";
  $x =  gettimeofday(true);
  echo "<br>";
  $z= explode(":",date('H:i:s', $x));
  $w = explode("-",date('Y-m-d',$x));
print_r($z);
echo"<br>";
print_r($w);  
  $d=mktime(3, 7, 54, 2, 5, 2019);
  
  echo "<br>Created date is " . date("Y-m-d h:i:sa", $d);
  $y = strtotime("+5 hours");
	$k = explode(":",date('H:i:s', $y));
	$j = explode("-",date('Y-m-d',$y));
	$currentt= explode(":",date('H:i:s', $x));
	$currentd = explode("-",date('Y-m-d',$x));
	echo"<br>";
	if($currentd[0]==$w[0] && $currentd[1]==$w[1])
	{
		echo "current day"; 
	}

  
?>