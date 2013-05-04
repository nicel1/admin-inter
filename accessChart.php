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
      $www = $_POST['www'];
      $api = $_POST['api'];
      $eclipse = $_POST['eclipse'];
      $netbeans = $_POST['netbeans'];
    ?>


    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Access Mechanism', '% of total'],
          ['www',      <?php echo $www; ?>],
          ['API',      <?php echo $api; ?>],
          ['Eclipse',  <?php echo $eclipse; ?>],
          ['Netbeans', <?php echo $netbeans; ?>]
        ]);

        var options = {
          title: 'Access Mechanisms'
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
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