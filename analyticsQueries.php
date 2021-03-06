<?php 
$memberOnly = true;
//Below is the query to retrieve browsernames and number of connections for the browser pie chart.

$pieChartQuery = "SELECT t2.browserName, COUNT(t1.browserID) 
FROM HD_WebAnalytics t1 
INNER JOIN HD_Browser t2 ON t1.browserID = t2.browserID 
GROUP BY t2.browserID";
$result = $mysqli->query($pieChartQuery);

//The results of the query are put into two different arrays, labels and data for the pie chart.

while($row = mysqli_fetch_assoc($result))
{
  $labels[] = $row["browserName"];
  $data[] = $row["COUNT(t1.browserID)"];
}

?>

<!-- Below is the script that creates and defines the pie chart. -->

<script>
  const labels = <?php echo json_encode($labels); ?>;

  const data = {
    labels: labels,
    datasets: [{
      backgroundColor: ['rgb(219, 212, 4)','rgb(32, 146, 227)',
                        'rgb(46, 209, 89)','rgb(240, 129, 19)',
                        'rgb(240, 19, 19)','rgb(186, 11, 169)'],
      data: <?php echo json_encode($data); ?>,
    }]
  };

  const config = {
    type: 'pie',
    data: data,
    options: {
      maintainAspectRatio: false,
      plugins: {
        title: {
          display: true,
          color: "#1b136c",
          text: 'Most common browsers using the website',  
          font: {
            size: 25,
            weight: 'bold',
          }
        },
        legend: {
          labels: {
            font: {
              size: 18
            }
          }
        }
      }
    }
  };

</script>

<?php

//Below is the query to retrieve IP address information for the IP address connections statistics.

$ipQuery = "SELECT IP_Address, COUNT(IP_Address), max(timestamp) 
        FROM HD_WebAnalytics 
        WHERE IP_Address IS NOT NULL 
        GROUP BY IP_Address 
        ORDER BY (COUNT(IP_Address)) DESC, date(timestamp)
        LIMIT 15";

$result = $mysqli->query($ipQuery);

//The results of the query are put into three different arrays, to be echoed in the statistics table.

while($row = mysqli_fetch_assoc($result))
{
  $IPaddress[] = $row["IP_Address"];
  $connections[] = $row["COUNT(IP_Address)"];
  $timestamp[] = $row["max(timestamp)"];
}

//Below is the query to retrieve user information for the access log.

$accessLogQuery = "SELECT u.username, pi.pageTitle, date(wa.timestamp), time(wa.timestamp) 
        FROM HD_WebAnalytics wa 
        INNER JOIN HD_UserRequest ur ON ur.requestID = wa.requestID 
        INNER JOIN HD_Users u ON u.userID = ur.userID 
        INNER JOIN HD_PageIndex pi ON pi.pageID = wa.pageID
        ORDER BY (date(wa.timestamp)) DESC, (time(wa.timestamp)) DESC
        LIMIT 10";

$result = $mysqli->query($accessLogQuery);

//The results of the query are put into four different arrays, to be echoed in the access log table.

while($row = mysqli_fetch_assoc($result))
{
  $username[] = $row["username"];
  $pageTitle[] = $row["pageTitle"];
  $dates[] = $row["date(wa.timestamp)"];
  $times[] = $row["time(wa.timestamp)"];
}

?>