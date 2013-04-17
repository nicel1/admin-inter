<!DOCTYPE html>
<html>
	<div class="navbar">
		<div class="navbar-inner">
			<a class="brand" href="#">Navigation</a>
	      	<ul class="nav">
	        	<li class ="active"><a href="#">Home</a></li>
	        	<li><a href="https://github.com/nicel1/admin-inter">GitHub</a></li>
	        	<li><a href="http://computerscience.pages.tcnj.edu/">TCNJ CompSci</a></li>
			</ul>
		</div>
	</div>

<body>
<h1>
	COMTOR Administrative Interface
</h1>

<!--<pre>-->
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
	$response = $dynamodb->query(array(
	    'TableName'    => $table_name,
	    'AttributesToGet' => array(
	    	'datetime', 'webcatUID', 'email', 'ipAddress', 'webcatInstitution', 'accessMechanism'),
	    'HashKeyValue' => array(
	        AmazonDynamoDB::TYPE_STRING => 'depasqua@tcnj.edu'
	    )
	));

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
			else if($accessString === 'API')
				$apiCount++;
			else if($accessString === 'eclipse')
				$eclipseCount++;
			else if($accessString === 'netbeans')
				$netbeansCount++;

			//Email stuff
			$tempEmail = json_decode($response->body->Items->email->to_json())->{'S'};
			if (in_array($tempEmail, $emailStrs)) {
				$emailCounts[$tempEmail]++;
			}
			else {
				$emailStrs[$i] = $tempEmail;
				$emailCounts[$tempEmail] = 1;
				$i++;
			}
		}
	}
	else
		echo "Something went wrong when retrieving data from the database.";
	
	//Count total access mech
	$totalAM = $wwwCount + $apiCount + $eclipseCount + $netbeansCount;
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
		<td><?php echo $wwwCount/$totalAM*100; ?></td>
	</tr>
	<tr>
		<td>API</td>
		<td><?php echo $apiCount; ?></td>
		<td><?php echo $apiCount/$totalAM*100; ?></td>
	</tr>
	<tr>
		<td>Eclipse</td>
		<td><?php echo $eclipseCount; ?></td>
		<td><?php echo $eclipseCount/$totalAM*100; ?></td>
	</tr>
	<tr>
		<td>Netbeans</td>
		<td><?php echo $netbeansCount; ?></td>
		<td><?php echo $netbeansCount/$totalAM*100; ?></td>
	</tr>
</table>

<br><br>

<!-- EMAIL TABLE -->
<table border="1">

<?php
	echo "<tr>
			<th>Email</th>
			<th>Usage Count</th>
		</tr>";
	foreach($emailStrs as $email){
		echo "<td>" . $email . "</td>";
		echo "<td>" . $emailCounts[$email] . "</td>";
	}
?>

</table>
</body>

	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		<title>COMTOR ADMIN INTERFACE</title>
		<link rel="stylesheet" href="./bootstrap/css/bootstrap.css">
		<link href="css/bootstrap.css" rel="stylesheet" media="screen">
		<style type="text/css" media="screen">
	</head>
</html>