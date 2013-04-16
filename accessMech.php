<!DOCTYPE html>
<html>
<pre>
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
// SELECT DATA FROM DYNAMODB

	// Instantiate
	$dynamodb = new AmazonDynamoDB();
	$table_name = 'org.comtor.usage';
 
####################################################################

	$response = $dynamodb->query(array(
	    'TableName'    => $table_name,
	    'AttributesToGet' => array(
	    	'datetime', 'webcatUID', 'email', 'ipAddress', 'webcatInstitution', 'accessMechanism'),
	    'HashKeyValue' => array(
	        AmazonDynamoDB::TYPE_STRING => 'depasqua@tcnj.edu'
	    )
	));

	$wwwCount = 0;
	$apiCount = 0;
	$eclipseCount = 0;
	$netbeansCount = 0;
	$emailCount = 0;

	$emailStr = $response->body->Items;
	$email1 = json_decode($emailStr->email->to_json())->{'S'};

	if($response->isOK()) {
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
			$emailStr = $response->body->Items;
			$email2 = json_decode($emailStr->email->to_json())->{'S'};
			if($email1 === $email2)
				$emailCount++;
			else {

			}
		}
	}
	
	$totalAM = $wwwCount + $apiCount + $eclipseCount + $netbeansCount;

?>

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

<!-- EMAIL TABLE -->
<table border="1">
	<tr>
		<th>Email</th>
		<th>Usage Count</th>
	</tr>
	<tr>
		<td><?php echo $email1; ?></td>
		<td><?php echo $emailCount; ?></td>
	</tr>
</table>

	
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		<title>Access Mechanism Table</title>
		<!--<link rel="stylesheet" href="./bootstrap/css/bootstrap.css">
		<link href="css/bootstrap.css" rel="stylesheet" media="screen">-->
		<style type="text/css" media="screen">
		body {
			margin: 0;
			padding: 0;
			font: 14px/1.5em "Helvetica Neue", "Lucida Grande", Verdana, Arial, sans;
			background-color: #fff;
			color: #333;
		}
		table {
			margin: 50px auto 0 auto;
			padding: 0;
			border-collapse: collapse;
		}
		table th {
			background-color: #eee;
		}
		table td,
		table th {
			padding: 5px 10px;
			border: 1px solid #eee;
		}
		table td {
			border: 1px solid #ccc;
		}
		</style>
		
	</head>
	<body>
		<!-- Display HTML table -->
		<!-- <?php echo $html; ?> -->

	</body>
</pre>
</html>
