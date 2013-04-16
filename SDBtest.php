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
// SELECT DATA FROM SIMPLEDB

	// Instantiate
	$sdb = new AmazonSDB();
	$select_expression = 'SELECT count(*) FROM `org.comtor.cloud.usage`';
 
	// Success?
	//var_dump($response->isOK());

	echo '<pre>';
	$response = $sdb->select($select_expression);
	var_dump($response);
	echo '</pre>';
	$next_token = null;
	$i = 0;

	/*do {
        //can't happen first time through the loop
	    if ($next_token)
	    {
	        $response = $sdb->select($select_expression, array('NextToken' => $next_token));
	    }
	    else
	    {
	        $response = $sdb->select($select_expression);
	    }

        //$CFArray = $response->body->SelectResult->Item->to_array();
        $CFArray = $response->body->SelectResult->to_array();

		echo '<pre>';

        //Traverse each array of 99 items
        for(; $i < 100; $i++)
	    {
	        //Get data
	        $Date = $CFArray[Item][$i][Name];
	        $SesID = $CFArray[Item][$i][Attribute][0][Value];
	        $IPAdd = $CFArray[Item][$i][Attribute][1][Value];
	        $EmAdd = $CFArray[Item][$i][Attribute][2][Value];
	        $RepURL = $CFArray[Item][$i][Attribute][3][Value];
	    
	        //Print data
	        //Get rid of labels and whitespace
	        print_r($CFArray);
	        /*echo '<p>';
	        echo 'Date: ' . $Date . '<br>';
	        echo 'Session ID: ' . $SesID . '<br>';
	        echo 'IP Address: ' . $IPAdd . '<br>';
	        echo 'Email Address: ' . $EmAdd . '<br>';
	        echo 'Report URL: ' . $RepURL . '<br>';
	        echo '<br>';
	        echo '------------------------------------------------';*/
	    //}

	  /*  $next_token = isset($response->body->SelectResult->NextToken)
	        ? (string) $response->body->SelectResult->NextToken
	        : null;

		echo '</pre>';

	} while ($next_token);*/
	 
	echo 'Bottom of code';



?><!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		<title>sdb_create_domain_data</title>
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
