<!DOCTYPE html>
<html>

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
# Query the database

	$response = $dynamodb->query(array(
	    'TableName'    => $table_name,
	    'AttributesToGet' => array(
	    	'datetime', 'webcatUID', 'email', 'ipAddress', 'webcatInstitution', 'accessMechanism'),
	    'HashKeyValue' => array(
	        AmazonDynamoDB::TYPE_STRING => 'depasqua@tcnj.edu'
	    )/*,
	    'RangeKeyCondition' => array(
	        'ComparisonOperator' => AmazonDynamoDB::CONDITION_GREATER_THAN_OR_EQUAL,
	        'AttributeValueList' => array(
	            array(AmazonDynamoDB::TYPE_NUMBER => '1')
	        ),
	    )*/
	));
	
	$item_array = $response->body->Items;
	$i = 0;

	//Print 
	//**********set up count variable to know how many rows
	echo '<pre>';
	var_dump($response);
	for ($i; $i < 28; $i++)
	//	var_dump($item_array[$i]);
	echo '</pre>';


####################################################################
# Scan the database
 
	// Scan the database for matches
	/*$response = $dynamodb->scan(array(
	    'TableName'       => $table_name
	        )
	    );

	// Did we get back what we expected?
	echo '<pre>';
	var_dump($response);
	echo '</pre>';*/


?>
	
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		<title>sdb_create_domain_data</title>
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
</html>
