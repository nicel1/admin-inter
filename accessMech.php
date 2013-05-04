<!DOCTYPE html>
<html>
	<div class="navbar">
		<div class="navbar-static-top">
		<div class="navbar-inner">
			<a class="brand" href="#">COMTOR Admin</a>
	      	<ul class="nav">
	        	<li><a href="http://localhost:8888/COMTOR/index.php">Home</a></li>
	        	<li class ="active"><a href="http://localhost:8888/COMTOR/accessMech.php">Access Mechanisms</a></li>
	        	<li><a href="http://localhost:8888/COMTOR/emailAddr.php">Email Addresses</a></li>
	        	<li><a href="http://localhost:8888/COMTOR/time.php">Time</a></li>
	        	<li><a href="https://github.com/nicel1/admin-inter">GitHub</a></li>
	        	<li><a href="http://computerscience.pages.tcnj.edu/">TCNJ CompSci</a></li>
			</ul>
			</div>
		</div>
	</div>

<body>
<h1>
	Usage by Access Mechanism
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
		'AttributesToGet' => array(
	    	'accessMechanism'),));

	//Variables for Access Mechanism data
	$wwwCount = 0;
	$apiCount = 0;
	$eclipseCount = 0;
	$netbeansCount = 0;

	//Variables for email data
	$emailStrs = array();
	$emailCounts = array();
	$i = 0;

	if($response->isOK()) {
		//Traverse data
		foreach ($response->body->Items as $xml) {
			//Access mech stuff
			$accessString = json_decode($xml->accessMechanism->to_json())->{'S'};
			if($accessString === 'www')
				$wwwCount++;
			else if($accessString === 'api')
				$apiCount++;
			else if($accessString === 'eclipse')
				$eclipseCount++;
			else if($accessString === 'netbeans')
				$netbeansCount++;

			//General data table
			/*echo "<tr>
					<th>Date and Time</th>
					<th>Webcat UID</th>
					<th>Email Address</th>
					<th>IP Address</th>
					<th>Webcat Institution</th>
					<th>Access Mechanism</th>
				</tr>";
			echo "<td>" . $datetime . "</td></table>";*/
		}
	}
	else
		echo "Something went wrong when retrieving data from the database.<br>";
	
	//Count total access mech
	$totalAM = $wwwCount + $apiCount + $eclipseCount + $netbeansCount;

	/*echo '<pre>';
	var_dump($emailStrs);
	echo '</pre>';

	echo '<pre>';
	var_dump($emailCounts);
	echo '</pre>';*/

?>

<br>

<!-- ACCESS MECHANISM TABLE -->
<table border="1">
	<tr>
		<th>Access Mechanism</th>
		<th>Count</th>
		<th>% of total</th>
	</tr>
	<tr>
		<td>www</td>
		<td><?php echo $wwwCount; ?></td>
		<td><?php echo round($wwwCount/$totalAM*100, 0); ?></td>
	</tr>
	<tr>
		<td>API</td>
		<td><?php echo $apiCount; ?></td>
		<td><?php echo round($apiCount/$totalAM*100, 0); ?></td>
	</tr>
	<tr>
		<td>Eclipse</td>
		<td><?php echo $eclipseCount; ?></td>
		<td><?php echo round($eclipseCount/$totalAM*100, 0); ?></td>
	</tr>
	<tr>
		<td>Netbeans</td>
		<td><?php echo $netbeansCount; ?></td>
		<td><?php echo round($netbeansCount/$totalAM*100, 0); ?></td>
	</tr>
</table>

<br><br>

<?php
	echo '<form action="accessChart.php" method="post">';
	echo '<input type="hidden" name="www" value="' . round($wwwCount/$totalAM*100, 0) . '">';
	echo '<input type="hidden" name="api" value="' . round($apiCount/$totalAM*100, 0) . '">';
	echo '<input type="hidden" name="eclipse" value="' . round($eclipseCount/$totalAM*100, 0) . '">';
	echo '<input type="hidden" name="netbeans" value="' . round($netbeansCount/$totalAM*100, 0) . '">';
	echo '<input type="submit" value="See chart"></form>';
?>

</body>
	<?php //http://bootswatch.com/united/ ?>
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		<title>COMTOR Admin Interface</title>
		<link rel="stylesheet" href="./bootstrap/css/bootstrap.css">
		<link href="css/bootstrap.css" rel="stylesheet" media="screen">
		<style type="text/css" media="screen">
	</head>
</html>