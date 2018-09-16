<?php
$dbhost='localhost';
$dbname='corex';
$dbuser='root';
$dbpass='';
include('connect.php');
$qry="SELECT `ID`, `Date`, `Voltage` FROM `input`";
$run=mysqli_query($con,$qry);
$row1=[];
while($data=mysqli_fetch_array($run)){
	$row1[]=['ID'=>$data["ID"],'Voltage'=>(int)$data["Voltage"]];
}
echo json_encode($row1);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Data Logger</title>
</head>
<body>

</body>
</html>