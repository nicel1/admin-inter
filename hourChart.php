<html>
  <div class="navbar">
    <div class="navbar-static-top">
    <div class="navbar-inner">
      <a class="brand" href="#">COMTOR Admin</a>
          <ul class="nav">
            <li><a href="http://localhost:8888/COMTOR/index.php">Home</a></li>
            <li><a href="http://localhost:8888/COMTOR/accessMech.php">Access Mechanisms</a></li>
            <li><a href="http://localhost:8888/COMTOR/emailAddr.php">Email Addresses</a></li>
            <li><a href="http://localhost:8888/COMTOR/time.php">Time</a></li>
            <li><a href="https://github.com/nicel1/admin-inter">GitHub</a></li>
            <li><a href="http://computerscience.pages.tcnj.edu/">TCNJ CompSci</a></li>
      </ul>
      </div>
    </div>
  </div>

  <head>
    <?php 
      $hoursArray = array();
      $hoursArray = $_POST['hours'];
      var_dump($hoursArray);
    ?> 

    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
    google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(drawChart);
    function drawChart() {
          var data = google.visualization.arrayToDataTable([
            ['Hour',  'Usage'],
            ['12am',  <?php echo $hoursArray[0]; ?>],
            ['1am',   <?php echo $hoursArray[1]; ?>],
            ['2am',   <?php echo $hoursArray[2]; ?>],
            ['3am',   <?php echo $hoursArray[3]; ?>],
            ['4am',   <?php echo $hoursArray[4]; ?>],
            ['5am',   <?php echo $hoursArray[5]; ?>],
            ['6am',   <?php echo $hoursArray[6]; ?>],
            ['7am',   <?php echo $hoursArray[7]; ?>],
            ['8am',   <?php echo $hoursArray[8]; ?>],
            ['9am',   <?php echo $hoursArray[9]; ?>],
            ['10am',  <?php echo $hoursArray[10]; ?>],
            ['11am',  <?php echo $hoursArray[11]; ?>],
            ['12pm',  <?php echo $hoursArray[12]; ?>],
            ['1pm',   <?php echo $hoursArray[13]; ?>],
            ['2pm',   <?php echo $hoursArray[14]; ?>],
            ['3pm',   <?php echo $hoursArray[15]; ?>],
            ['4pm',   <?php echo $hoursArray[16]; ?>],
            ['5pm',   <?php echo $hoursArray[17]; ?>],
            ['6pm',   <?php echo $hoursArray[18]; ?>],
            ['7pm',   <?php echo $hoursArray[19]; ?>],
            ['8pm',   <?php echo $hoursArray[20]; ?>],
            ['9pm',   <?php echo $hoursArray[21]; ?>],
            ['10pm',  <?php echo $hoursArray[22]; ?>],
            ['11pm',  <?php echo $hoursArray[23]; ?>],
          ]);

          var options = {
            title: 'Usage by Hour of Day'
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>

    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <title>COMTOR Admin Interface</title>
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.css">
    <link href="css/bootstrap.css" rel="stylesheet" media="screen">
    <style type="text/css" media="screen">
  </head>
  <body>
    
    <div id="chart_div" style="width: 900px; height: 500px;"></div>
  </body>
</html>