<!DOCTYPE html>
<html>
	<div class="navbar">
		<div class="navbar-static-top">
		<div class="navbar-inner">
			<a class="brand" href="#">COMTOR Admin</a>
	      	<ul class="nav">
	        	<li><a href="http://localhost:8888/COMTOR/index.php">Home</a></li>
	        	<li><a href="http://localhost:8888/COMTOR/accessMech.php">Access Mechanisms</a></li>
	        	<li><a href="http://localhost:8888/COMTOR/emailAddr.php">Email Addresses</a></li>
	        	<li class ="active"><a href="http://localhost:8888/COMTOR/time.php">Time</a></li>
	        	<li><a href="https://github.com/nicel1/admin-inter">GitHub</a></li>
	        	<li><a href="http://computerscience.pages.tcnj.edu/">TCNJ CompSci</a></li>
			</ul>
			</div>
		</div>
	</div>

<body>
<h1>
	Usage by Hour
</h1>

<?php
/*%******************************************************************************************%*/
// SETUP

	// Enable full-blown error reporting. http://twitter.com/rasmus/status/7448448829
	error_reporting(-1);

	// Set HTML headers
	header("Content-type: text/html; charset=utf-8");

	// Include the SDK
	require_once './sdk.class.php';

/*%******************************************************************************************%*/

	// Instantiate
	$dynamodb = new AmazonDynamoDB();
	$table_name = 'org.comtor.usage';

	//Get data from database
	$response = $dynamodb->scan(array('TableName' => $table_name, 
		'AttributesToGet' => array('datetime')));

	//Variables for datetime data
	$hourArray = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23);
	$hourCounts = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
	$i = 0;	//to iterate through $hourArray
	$j = 0;	//to iterate through array of items given by database
	$numItems = 0;

	if($response->isOK()) {
		//Number of items total in database
		$numItemsDB = intval(json_decode($response->body->Count));
		
		foreach ($response->body->Items as $xml) {
			//Temporary placeholder to create array of hours
			$datetime = json_decode($response->body->Items[$j]->datetime->to_json())->{'N'};
			$hour = date('H', $datetime);
			$numItems++;

			switch($hour)
			{
				case 0:
					$hourCounts[0]++;
					break;
				case 1:
					$hourCounts[1]++;
					break;
				case 2:
					$hourCounts[2]++;
					break;
				case 3:
					$hourCounts[3]++;
					break;
				case 4:
					$hourCounts[4]++;
					break;
				case 5:
					$hourCounts[5]++;
					break;
				case 6:
					$hourCounts[6]++;
					break;
				case 7:
					$hourCounts[7]++;
					break;
				case 8:
					$hourCounts[8]++;
					break;
				case 9:
					$hourCounts[9]++;
					break;
				case 10:
					$hourCounts[10]++;
					break;
				case 11:
					$hourCounts[11]++;
					break;
				case 12:
					$hourCounts[12]++;
					break;
				case 13:
					$hourCounts[13]++;
					break;
				case 14:
					$hourCounts[14]++;
					break;
				case 15:
					$hourCounts[15]++;
					break;
				case 16:
					$hourCounts[16]++;
					break;
				case 17:
					$hourCounts[17]++;
					break;
				case 18:
					$hourCounts[18]++;
					break;
				case 19:
					$hourCounts[19]++;
					break;
				case 20:
					$hourCounts[20]++;
					break;
				case 21:
					$hourCounts[21]++;
					break;
				case 22:
					$hourCounts[22]++;
					break;
				case 23:
					$hourCounts[23]++;
					break;
				default:
					echo "Something went wrong in the switch statement<br>";
			}
			$j++;
		}
	}
?>

<br>

<!-- EMAIL TABLE -->
<?php
	//TABLE
	//Not necessary since graph works, but kept here in comments in case it's ever needed again
	/*echo '<table border="1">';
	echo "<tr>
			<th>Hour</th>
			<th>Usage (%)</th>
		</tr>";
	foreach($hourArray as $hour){
		echo "<tr>";
		echo "<td>" . $hour . "</td>";
		echo "<td>" . round($hourCounts[$hour]/24*100, 0);
		echo "</tr>";
	}
	echo '</table>';*/

	//Variable to traverse arrays
	$a = 0;
	
	//This is all Google Charts stuff
    echo '<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    	<script type="text/javascript">
    	google.load("visualization", "1", {packages:["corechart"]});
    	';
    echo "google.setOnLoadCallback(drawChart);
    	";
    echo "function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Hour', 'Users'],
          ";

        foreach($hourArray as $hour) {
	        echo "['"; 
	        echo $hour; 
	        echo "', "; 
	        echo $hourCounts[$hour]; 
	        echo "],
	        ";
	        $a++;
		}
        echo "]);

        var options = {
          title: '',
          vAxis: {title: 'Hour of the Day',  titleTextStyle: {color: 'orange'}}
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
    ";
    ?>
    <div id="chart_div" style="width: 1400px; height: 600px;"></div>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<title>COMTOR Admin Interface</title>
	<link rel="stylesheet" href="./bootstrap/css/bootstrap.css">
	<link href="css/bootstrap.css" rel="stylesheet" media="screen">
	<style type="text/css" media="screen">
</head>
</html>