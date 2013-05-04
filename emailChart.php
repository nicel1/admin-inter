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
      $emailArray = array($_POST['email0'], $_POST['email1'], $_POST['email2']);
      $countArray = array($_POST['count0'], $_POST['count1'], $_POST['count2']);
    ?>
    
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Email Address', 'Times Used'],
          [<?php var_dump($emailArray[0]); ?>'fd',  1000],
          ['2005',  1170],
          ['2006',  660],
          ['2007',  1030]
        ]);

        var options = {
          title: 'Users',
          vAxis: {title: 'Email Address',  titleTextStyle: {color: 'blue'}}
        };

        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>

  <body>
    <div id="chart_div" style="width: 900px; height: 500px;"></div>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <title>COMTOR Admin Interface</title>
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.css">
    <link href="css/bootstrap.css" rel="stylesheet" media="screen">
    <style type="text/css" media="screen">
  </body>
</html>