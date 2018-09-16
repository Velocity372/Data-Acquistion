<!DOCTYPE html>
<html>
<head>
	<title>Data Logging Using Php And AM Charts</title>
</head>
<body>

</body>
</html>



<?php
require('connect.php');
if($_GET['action']=='D'){
	$qr="DELETE FROM `input`";
	$ru=mysqli_query($con,$qr);
}
?>

<?php

$qry="SELECT * FROM `input` ";
$run=mysqli_query($con,$qry);
$data=mysqli_fetch_assoc($run);
$ID=$data['ID'];
$Date=$data['Date'];
$Time=$data['Time'];
$Status=$data['Running Status'];
$Voltage=$data['Voltage'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Data Logging Using Hardware</title>
  	  <script type="text/javascript" src="amcharts/amcharts.js"></script>
    <script type="text/javascript" src="amcharts/serial.js"></script>
    <script type="text/javascript" src="amcharts/themes/chalk.js"></script>
    <script type="text/javascript" src="dataloader.min.js"></script>

    <script type="text/javascript" src="
    https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
	<script>
var tableToExcel = (function() {
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  return function(table, name) {
    if (!table.nodeType) table = document.getElementById(table)
    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    window.location.href = uri + base64(format(template, ctx))
  }
})()
</script>
</head>
<body>
	<input type="submit" name="button" onclick="tableToExcel('example','<?=date('Y-m-d')?>')" value="Export To Excel">
	<input type="submit" name="delete" onclick="window.location.href='index.php?action=D'" value="Delete">
	<input type="submit" name="Refresh" onclick="window.location.href='index.php?action=0'" value="Refresh">
	<table id="example" border="1" style="border-collapse: collapse;">
		<tr>
			<th>S.no</th>
			<th>ID</th>
			<th>Date</th>
			<th>Time</th>
			<th>Running Status</th>
			<th>Voltage</th>
		</tr>
		<?php
			$i=1;
			$qry="SELECT * FROM `input` ";
			$run=mysqli_query($con,$qry);
			$json1=[];
			$json2=[];
			while($data = mysqli_fetch_assoc($run)){
			$ID=$data['ID'];
			$Date=$data['Date'];
			$Time=$data['Time'];
			$Status=$data['Running Status'];
			$Voltage=$data['Voltage'];
			$json1[]=$data['ID'];
			$json2[]=(int)$data['Voltage'];
				?>
		<tr>
			<td><?php echo $i;?></td>
			<td><?php echo $ID; ?></td>
			<td><?php echo $Date ?></td>
			<td><?php echo $Time; ?></td>
			<td><?php echo $Status; ?></td>
			<td><?php echo $Voltage; ?></td>
		</tr>
		<?php
		$i++;}
		?>
		
	
	</table>
	<canvas id="myChart" width="400" height="100"></canvas>
	<script type="text/javascript">

	var ctx = document.getElementById("myChart").getContext('2d');
	var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($json1);?>,
        datasets: [{
            label: '# of Votes',
            data: <?php echo json_encode($json2);?>,
            backgroundColor:'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255,99,132,1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>
<script type="text/javascript">
	  AmCharts.makeChart( "chartdiv",{
	"type": "serial",
	"categoryField": "date",
	"dataDateFormat": "YYYY-MM",
	"theme": "chalk",
	"categoryAxis": {
		"minPeriod": "MM",
		"parseDates": true
	},
	/*"dataLoader":{
		"url":"data.php",
		"format":"json"
	},*/
	"chartCursor": {
		"enabled": true,
		"categoryBalloonDateFormat": "MMM YYYY"
	},
	"chartScrollbar": {
		"enabled": true
	},
	"trendLines": [],
	"graphs": [
		{
			"bullet": "triangleUp",
			"id": "AmGraph-1",
			"title": "Voltage",
			"valueField": "column-1"
		},
		{
			"bullet": "square",
			"id": "AmGraph-2",
			"title": "Running Status",
			"valueField": "column-2"
		}
	],
	"guides": [],
	"valueAxes": [
		{
			"id": "ValueAxis-1",
			"title": "Axis title"
		}
	],
	"allLabels": [],
	"balloon": {
		"animationDuration": 2,
		"fadeOutDuration": 1.5
	},
	"legend": {
		"enabled": true,
		"useGraphSettings": true
	},
	"titles": [
		{
			"id": "Title-1",
			"size": 15,
			"text": "Chart Title"
		}
	],
	"dataProvider": [
		{
			"date": "2014-01",
			"column-1": 6,
			"column-2": 5
		},
		{
			"date": "2014-02",
			"column-1": 6,
			"column-2": 7
		},
		{
			"date": "2014-03",
			"column-1": 2,
			"column-2": 3
		},
		{
			"date": "2014-04",
			"column-1": 1,
			"column-2": 3
		},
		{
			"date": "2014-05",
			"column-1": 2,
			"column-2": 1
		},
		{
			"date": "2014-06",
			"column-1": 3,
			"column-2": 2
		},
		{
			"date": "2014-07",
			"column-1": 6,
			"column-2": 8
		}
	]
});
</script>
<div style="height:100px;">
<div id="chartdiv" style="width:100%;height: 480px;background-color: black; "></div>
</body>
</html>