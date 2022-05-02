<?php
$memberOnly = true;
include ('nav.php'); //Required for db connection.
echo $navigation;
echo $extLinks;
include ('analyticsQueries.php'); //Includes all the queries that are needed.
?>

<head>
<div class="pieChart" style="float: left; height: 600px; width: 750px;">
  <canvas style="background-color: #ffffff;" id="myChart"></canvas>
</div>
</head>

<body>

<!-- The pie chart is called below. -->

<script>
  const myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
</script>

<!-- The IP address statistics table is created below. -->

<h1 id="tableTitles">IP address statistics</h1>
<table class="analyticsTable">
    <thead>
    <tr>
        <th id="tableHeads">IP address</th>
        <th id="tableHeads">Number of connections</th> 
        <th id="tableHeads">Last connection</th>
     </tr>
     </thead>
     <tbody>
        <tr>

      <!-- For each row of IP information, three columns are created 
           with the corresponding values being echoed as the content. -->

     <?php foreach ($IPaddress as $i => $ip):
              $con = $connections[$i];
              $time = $timestamp[$i];
          ?>       
          <td id="tableBodies"><?php echo $ip; ?></td>
          <td id="tableBodies"><?php echo $con; ?></td>
          <td id="tableBodies"><?php echo $time; ?></td>
        </tr>
     <?php endforeach; ?>
    </tbody>
</table>

<!-- The access log statistics table is created below. -->

<h1 id="tableTitles">Access log</h1>
<table class="analyticsTable">
    <thead>
    <tr>
        <th id="tableHeads">Username</th>
        <th id="tableHeads">Page</th> 
        <th id="tableHeads">Date</th>
        <th id="tableHeads">Time</th>
     </tr>
     </thead>
     <tbody>
        <tr>

      <!-- For each row of access log information, four columns are created 
           with the corresponding values being echoed as the content. -->

     <?php foreach ($username as $i => $user):
              $page = $pageTitle[$i];
              $da = $dates[$i];
              $ti = $times[$i];
          ?>       
          <td id="tableBodies"><?php echo $user; ?></td>
          <td id="tableBodies"><?php echo $page; ?></td>
          <td id="tableBodies"><?php echo $da; ?></td>
          <td id="tableBodies"><?php echo $ti; ?></td>
        </tr>
     <?php endforeach; ?>
    </tbody>
</table>

</body>
    <?php
        include("footer.php")
    ?>
</html>