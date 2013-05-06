<!DOCTYPE html>
<html>
	<div class="navbar">
		<div class="navbar-static-top">
		<div class="navbar-inner">
			<a class="brand" href="#">COMTOR Admin</a>
	      	<ul class="nav">
	        	<li><a href="http://localhost:8888/COMTOR/index.php">Home</a></li>
	        	<li><a href="http://localhost:8888/COMTOR/accessMech.php">Access Mechanisms</a></li>
	        	<li class ="active"><a href="http://localhost:8888/COMTOR/emailAddr.php">Email Addresses</a></li>
	        	<li><a href="http://localhost:8888/COMTOR/time.php">Time</a></li>
	        	<li><a href="https://github.com/nicel1/admin-inter">GitHub</a></li>
	        	<li><a href="http://computerscience.pages.tcnj.edu/">TCNJ CompSci</a></li>
			</ul>
			</div>
		</div>
	</div>

<body>
<h1>
	Usage by Email Address
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
		'AttributesToGet' => array('email')));

	//Variables for email data
	$emailStrs = array();
	$emailCounts = array();
	$i = 0;	//to iterate through $emailStrs
	$j = 0;	//to iterate through array of items given by database
	$numItems = 0;

	if($response->isOK()) {
		//Number of items total in database
		$numItemsDB = intval(json_decode($response->body->Count));

		//Traverse data
		foreach ($response->body->Items as $xml) {

			//Temporary placeholder as I create array of emails
			$tempEmail = json_decode($xml[$j]->email->to_json())->{'S'};
			$numItems++;

			//If this email is already in the array, don't add it again, do increase count
			if (in_array($tempEmail, $emailStrs, true)) {
				$emailCounts[$tempEmail]++;
			}
			//Otherwise, add email to array, initialize count for that email
			else {
				$emailStrs[$i] = $tempEmail;
				$emailCounts[$tempEmail] = 1;
				$i++;	//move to next spot in email array
			}

			$j++;	//get ready to get next item from database
		}
		
		//Debugging in case my logic is flawed
		if($numItems != $numItemsDB) {
			echo 'The number of items is not correct.<br>';
			echo '$numItems = ' . $numItems . '<br>';
			echo '$numItemsDB = ' . $numItemsDB . '<br>';
		}
	}
	else
		echo "Something went wrong when retrieving data from the database.<br>";
?>

<br>

</body>
<head>
<table border="1">
<?php
	//Table headers
	echo "<tr>
			<th>Email Address</th>
			<th>Usage Count</th>
		</tr>";
	//Table rows
	foreach($emailStrs as $email){
		echo "<tr>";
		echo "<td>" . $email . "</td>";
		echo "<td>" . $emailCounts[$email] . "</td>";
		echo "</tr>";
	}
	echo '</table><br>';



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
          ['Email Address', 'Times Used'],
          ";

        foreach($emailStrs as $email) {
	        echo "['"; 
	        echo $emailStrs[$a]; 
	        echo "', "; 
	        echo $emailCounts[$emailStrs[$a]]; 
	        echo "],
	        ";
	        $a++;
		}
        echo "]);

        var options = {
          title: 'Users',
          vAxis: {title: 'Email Address',  titleTextStyle: {color: 'blue'}}
        };

        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
    ";
    ?>
    <div id="chart_div" style="width: 900px; height: 500px;"></div>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<title>COMTOR Admin Interface</title>
	<link rel="stylesheet" href="./bootstrap/css/bootstrap.css">
	<link href="css/bootstrap.css" rel="stylesheet" media="screen">
	<style type="text/css" media="screen">
</head>
</html>