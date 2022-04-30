<?php
include ('nav.php');
echo $navigation;
echo $extLinks;
include ('analyticsQueries.php');
?>

<head>
<div class="pieChart" style="float: left; height: 600px; width: 750px;">
  <canvas style="background-color: #ffffff;" id="myChart"></canvas>
</div>
</head>

<body>
<script>
  const myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
</script>
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