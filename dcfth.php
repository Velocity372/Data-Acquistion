<?php
$final=$_REQUEST['z'];
$id=substr($final,0,1);
date_default_timezone_set( 'Asia/calcutta' );
$datestring=date('dmyhis');
$date=substr($datestring, 0,6);
$time=substr($datestring,6);
$status=substr($final,3,1);
$punt=substr($final,4,5);
$voltage=$punt*10/2;
require('connect.php');
$qry="INSERT INTO `input`(`ID`, `Date`, `Time`, `Running Status`, `Voltage`) VALUES ('$id','$date','$time','$status','$voltage')";
$run=mysqli_query($con,$qry);
echo "Data=*".$date.$time."<br>";
echo "<br> <br>";
echo "EveryTime I Update  A Value...Its Gonna Go To the Database ...<br>
<b>1.Store The Data...</b><br>
<b>2.Will Fetch The Data Onto the Server and Will Display It Dynamically..</b>";
echo "ggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbddfffffffffffffddddddddddddddddddd";
?>

