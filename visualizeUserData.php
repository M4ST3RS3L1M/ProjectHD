<!DOCTYPE html>
<html lang="en">
	<head>

        <?php
        include_once('nav.php');
        echo $extLinks;

        // STEPS
        // Query to get step data
        $stepQuery = (
            "SELECT hd.amount, hd.date
            FROM HD_HealthData hd
            JOIN HD_HealthType ht ON hd.healthTypeID = ht.healthTypeID
            WHERE hd.userID= {$_SESSION['userID']} AND ht.healthType='steps'"
        );

        $steps = "";
        $date = "";
        // Extracting data from returned object
        $result = mysqli_query($mysqli, $stepQuery);
        while($obj=$result->fetch_object()){
            $steps .= $obj->amount . " ";
            $date .= $obj->date . " ";
        }
        // Trim and convert to array
        $steps = trim($steps);
        $date = trim($date);
        $phpSteps = explode(' ', $steps);
        $phpStepDate = explode(' ', $date);



        // CALORIES
        // Query to get calorie data
        $calorieQuery = (
            "SELECT hd.amount, hd.date
            FROM HD_HealthData hd
            JOIN HD_HealthType ht ON hd.healthTypeID = ht.healthTypeID
            WHERE hd.userID= {$_SESSION['userID']} AND ht.healthType='calories'"
        );

        $calories = "";
        $date = "";
        // Extracting data from returned object
        $result = mysqli_query($mysqli, $calorieQuery);
        while($obj=$result->fetch_object()){
            $calories .= $obj->amount . " ";
            $date .= $obj->date . " ";
        }
        // Trim and convert to array
        $calories = trim($calories);
        $date = trim($date);
        $phpCalories = explode(' ', $calories);
        $phpCalorieDate = explode(' ', $date);



        // WALKING DIST
        // Query to get walking dist data
        $walkDQuery = (
            "SELECT ed.distance, ed.startTime
            FROM HD_ExerciseData ed
            JOIN HD_ExerciseType et ON ed.exerciseID = et.exerciseID
            WHERE ed.userID= {$_SESSION['userID']} AND et.exerciseType='walking'"
        );

        $walkDist = "";
        $date = "";
        // Extracting data from returned object
        $result = mysqli_query($mysqli, $walkDQuery);
        while($obj=$result->fetch_object()){
            $walkDist .= $obj->distance . " ";
            $time = $obj->startTime;
            $time = substr($time, 0, 10); // To just display the date
            $date .= $time . " ";
        }
        // Trim and convert to array
        $walkDist = trim($walkDist);
        $date = trim($date);
        $phpWalkDist = explode(' ', $walkDist);
        $phpWalkDate = explode(' ', $date);



        // CYCLING DIST
        // Query to get cycling dist data
        $cyclingDQuery = (
            "SELECT ed.distance, ed.startTime
            FROM HD_ExerciseData ed
            JOIN HD_ExerciseType et ON ed.exerciseID = et.exerciseID
            WHERE ed.userID= {$_SESSION['userID']} AND et.exerciseType='cycling'"
        );

        $cyclingDist = "";
        $date = "";
        // Extracting data from returned object
        $result = mysqli_query($mysqli, $cyclingDQuery);
        while($obj=$result->fetch_object()){
            $cyclingDist .= $obj->distance . " ";
            $time = $obj->startTime;
            $time = substr($time, 0, 10); // To just display the date
            $date .= $time . " ";
        }
        // Trim and convert to array
        $cyclingDist = trim($cyclingDist);
        $date = trim($date);
        $phpCyclingDist = explode(' ', $cyclingDist);
        $phpCyclingDate = explode(' ', $date);



        // SLEEP
        // Query to get sleep data
        $bedtimeQuery = (
            "SELECT bedTime, wakeTime
            FROM HD_SleepData
            WHERE userID= {$_SESSION['userID']}"
        );

        $phpSleepData = array();
        $date = "";
        // Extracting data from returned object
        $result = mysqli_query($mysqli, $bedtimeQuery);
        while($obj=$result->fetch_object()){
            $returnBedtime = $obj->bedTime;
            $returnWakeUp = $obj->wakeTime;

            $sleep = substr($returnBedtime, 11) . " "; // Get bedtime-part of returned data
            $date .= substr($returnBedtime, 0, 10) . " "; // Get date-part of returned data
            $sleep .= substr($returnWakeUp, 11); // Get wakeup-part of returned data
            $sleep = explode(' ', $sleep); // Make array out of bed-and-wakeup-time

            array_push($phpSleepData, $sleep); //Put one-night-array into many-nights-array
/*
            $keys = array_keys($phpSleepData);
            for($i = 0; $i < count($phpSleepData); $i++) {
                echo $keys[$i] . "{<br>";
                foreach($phpSleepData[$keys[$i]] as $key => $value) {
                    echo $key . " : " . $value . "<br>";
                }
                echo "}<br>";
            }
*/      }
        // Trim and convert to array
        $date = trim($date);
        $phpSleepDate = explode(' ', $date);


            // WAKE-UP TIME
            // Query to get wake-up time data
            $wakeUpQuery = (
                "SELECT wakeTime
                FROM HD_SleepData
                WHERE userID= {$_SESSION['userID']}"
            );

            $wakeUpTime = "";
            $date = "";
            // Extracting data from returned object
            $result = mysqli_query($mysqli, $wakeUpQuery);
            while($obj=$result->fetch_object()){
                $returnData = $obj->wakeTime;
                $wakeUpTime .= substr($returnData, 11) . " "; // Get wake-up-part of returned data
                $date .= substr($returnData, 0, 10) . " "; // Get date-part of returned data
            }

            // Trim and convert to array
            $wakeUpTime = trim($wakeUpTime);
            $date = trim($date);
            $phpWakeUpTime = explode(' ', $wakeUpTime);
            $phpWakeUpDate = explode(' ', $date);

        ?>

        <style>
                .flex-column .nav-link {
                    padding: 17px 29px 16px!important;
                }
                canvas {
                    background-color: #222629;
                }
        </style>

        <title>Visualize your data</title>

	</head>

	<body>
        <?php
            echo $navigation;
        ?>
        <div class="container text-light">
            <div class="row">
		        
                </div>
                <div class="row text-center">
                    <h1 class="air">Data overwiev</h1>
                    <h4 class="air">Select a tab</h4>
                </div>
                <div class="row">
                        
                    <!-- Nav tabs -->
                    <div class="d-flex align-items-start col-lg-auto">
                        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <button class="nav-link active" id="v-pills-steps-tab" data-bs-toggle="pill" data-bs-target="#v-pills-steps" type="button" role="tab" aria-controls="v-pills-steps" aria-selected="true">Steps per day</button>
                            <button class="nav-link" id="v-pills-energy-tab" data-bs-toggle="pill" data-bs-target="#v-pills-energy" type="button" role="tab" aria-controls="v-pills-energy" aria-selected="false">Energy expenditure</button>
                            <button class="nav-link" id="v-pills-walking-tab" data-bs-toggle="pill" data-bs-target="#v-pills-walking" type="button" role="tab" aria-controls="v-pills-walking" aria-selected="false">Daily walking dist.</button>
                            <button class="nav-link" id="v-pills-cycling-tab" data-bs-toggle="pill" data-bs-target="#v-pills-cycling" type="button" role="tab" aria-controls="v-pills-cycling" aria-selected="false">Daily cycling dist.</button>
                            <button class="nav-link" id="v-pills-bedtime-tab" data-bs-toggle="pill" data-bs-target="#v-pills-bedtime" type="button" role="tab" aria-controls="v-pills-bedtime" aria-selected="false">Sleeping times</button>
                            <button class="nav-link" id="v-pills-wakeup-tab" data-bs-toggle="pill" data-bs-target="#v-pills-wakeup" type="button" role="tab" aria-controls="v-pills-wakeup" aria-selected="false">Wake-up time</button>
                            <button class="nav-link" id="v-pills-sleep-tab" data-bs-toggle="pill" data-bs-target="#v-pills-sleep" type="button" role="tab" aria-controls="v-pills-sleep" aria-selected="false">Sleep duration</button>
                            <button class="nav-link" id="v-pills-nap-tab" data-bs-toggle="pill" data-bs-target="#v-pills-nap" type="button" role="tab" aria-controls="v-pills-nap" aria-selected="false">Daily naps</button>
                            <button class="nav-link" id="v-pills-weight-tab" data-bs-toggle="pill" data-bs-target="#v-pills-weight" type="button" role="tab" aria-controls="v-pills-weight" aria-selected="false">Weight</button>
                        </div>
                    </div>

                    <!-- Tab panes -->
                    <div class="tab-content col-lg-9" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-steps" role="tabpanel" aria-labelledby="v-pills-steps-tab">
                            <canvas id="steps-chart"></canvas>
                        </div>
                        <div class="tab-pane fade" id="v-pills-energy" role="tabpanel" aria-labelledby="v-pills-energy-tab">
                            <canvas id="energy-chart"></canvas>
                        </div>
                        <div class="tab-pane fade" id="v-pills-walking" role="tabpanel" aria-labelledby="v-pills-walking-tab">
                            <canvas id="walking-chart"></canvas>
                        </div>
                        <div class="tab-pane fade" id="v-pills-cycling" role="tabpanel" aria-labelledby="v-pills-cycling-tab">
                            <canvas id="cycling-chart"></canvas>
                        </div>
                        <div class="tab-pane fade" id="v-pills-bedtime" role="tabpanel" aria-labelledby="v-pills-bedtime-tab">
                            <canvas id="sleep-chart"></canvas>
                        </div>
                        <div class="tab-pane fade" id="v-pills-wakeup" role="tabpanel" aria-labelledby="v-pills-wakeup-tab">
                            <canvas id="wakeup-chart"></canvas>
                        </div>
                        <div class="tab-pane fade" id="v-pills-sleep" role="tabpanel" aria-labelledby="v-pills-sleep-tab">
                            <canvas id="sleep-chart"></canvas>
                        </div>
                        <div class="tab-pane fade" id="v-pills-nap" role="tabpanel" aria-labelledby="v-pills-nap-tab">
                            <canvas id="nap-chart"></canvas>
                        </div>
                        <div class="tab-pane fade" id="v-pills-weight" role="tabpanel" aria-labelledby="v-pills-weight-tab">
                            <canvas id="weight-chart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
            include('footer.php');
        ?>
        
        <!--Required scripts-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <!--Chart JS-->
        <script>

            let dataColor = "#61892F";
            let dataBgColor = "#86C232";

            //STEPS
            // Steps chart
            let stepsChart = document.getElementById("steps-chart").getContext("2d");
            
            let stepData = <?php echo json_encode($phpSteps); ?>;
            let stepLabels = <?php echo json_encode($phpStepDate) ?>; 

            let stepsChart1 = new Chart(stepsChart, {
                type: "line",
                data: {
                    labels: stepLabels,
                    datasets: [ {
                        label: "Steps",
                        data: stepData,
                        fill: false,
                        borderColor: dataColor,
                        backgroundColor: dataBgColor,
                        tension: 0.1
                    }]
                },
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: "Steps walked per day"
                        }    
                    }
                }
            });


            // CALORIES
            // Calories chart
            let caloriesChart = document.getElementById("energy-chart").getContext("2d");
            
            let calorieData = <?php echo json_encode($phpCalories); ?>;
            let calorieLabels = <?php echo json_encode($phpCalorieDate) ?>;
            //let stepColors = "#61892F"; // FIX THESE
            //let stepBgColor = "#86C232"; // ----

            let caloriesChart1 = new Chart(caloriesChart, {
                type: "bar",
                data: {
                    labels: calorieLabels,
                    datasets: [ {
                        label: "Energy expenditure (kcal)",
                        data: calorieData,
                        borderColor: dataColor,
                        backgroundColor: dataBgColor,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: "Calories burned per day"
                        }    
                    }
                }
            });


            // WALKING DIST
            // Walking distance chart
            let walkChart = document.getElementById("walking-chart").getContext("2d");
            
            let walkData = <?php echo json_encode($phpWalkDist); ?>;
            let walkLabels = <?php echo json_encode($phpWalkDate) ?>; 

            let walkChart1 = new Chart(walkChart, {
                type: "line",
                data: {
                    labels: walkLabels,
                    datasets: [ {
                        label: "Walking distance (km)",
                        data: walkData,
                        fill: false,
                        borderColor: dataColor,
                        backgroundColor: dataBgColor,
                        tension: 0.1
                    }]
                },
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: "Distance walked per day"
                        }    
                    }
                }
            });


            // CYCLING DIST
            // Cycling distance chart
            let cyclingChart = document.getElementById("cycling-chart").getContext("2d");
            
            let cyclingData = <?php echo json_encode($phpCyclingDist); ?>;
            let cyclingLabels = <?php echo json_encode($phpCyclingDate) ?>; 

            let cyclingChart1 = new Chart(cyclingChart, {
                type: "line",
                data: {
                    labels: cyclingLabels,
                    datasets: [ {
                        label: "Cycling distance (km)",
                        data: cyclingData,
                        fill: false,
                        borderColor: dataColor,
                        backgroundColor: dataBgColor,
                        tension: 0.1
                    }]
                },
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: "Distance cycled per day"
                        }    
                    }
                }
            });



            // SLEEP
            // Bedtime chart
            let sleepChart = document.getElementById("sleep-chart").getContext("2d");
            
            let sleepData = <?php echo json_encode($phpSleepData); ?>;
            let sleepLabels = <?php echo json_encode($phpSleepDate) ?>; 

            let sleepChart1 = new Chart(sleepChart, {
                type: "bar",
                data: {
                    labels: sleepLabels,
                    datasets: [ {
                        label: "Cycling distance (km)",
                        data: sleepData,
                        fill: false,
                        borderColor: dataColor,
                        backgroundColor: dataBgColor,
                        tension: 0.1
                    }]
                },
                options: {
                    yAxes: [{
                        ticks: {
                            callback: function(value) {
                                //"HH:mm:ss"
                                return moment(value).format("hh:mm:ss");
                            }
                        }
                    }],
                    plugins: {
                        title: {
                            display: true,
                            text: "Distance cycled per day"
                        }    
                    }
                }
            });


/*
            // WAKE-UP-TIME
            // Wake-up-time chart
            let wakeUpChart = document.getElementById("wakeup-chart").getContext("2d");
            
            let wakeUpData = <?php echo json_encode($phpWakeUpTime); ?>;
            let wakeUpLabels = <?php echo json_encode($phpWakeUpDate) ?>; 

            let wakeUpChart1 = new Chart(wakeUpChart, {
                type: "line",
                data: {
                    labels: wakeUpLabels,
                    datasets: [ {
                        label: "Cycling distance (km)",
                        data: wakeUpData,
                        fill: false,
                        borderColor: dataColor,
                        backgroundColor: dataBgColor,
                        tension: 0.1
                    }]
                },
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: "Distance cycled per day"
                        }    
                    }
                }
            });
*/
        </script>

    </body>
</html>

<!--
INSERT INTO `HD_SleepData` (`userID`, `exerciseID`, `distance`, `startTime`, `endTime`)
VALUES
('26', '3', '5.10', '2022-04-21 00:00:00','2022-04-21 23:59:59'),
('26', '3', '16.60', '2022-04-22 00:00:00','2022-04-22 23:59:59'),
('26', '3', '42.90', '2022-04-23 00:00:00','2022-04-23 23:59:59'),
('26', '3', '12.80', '2022-04-24 00:00:00','2022-04-24 21:51:53'),
('26', '3', '7.80', '2022-04-25 00:00:00','2022-04-25 23:40:38'),
('26', '3', '10.60', '2022-04-26 00:00:00','2022-04-26 23:59:59')

INSERT INTO `HD_SleepData` (`userID`, `bedTime`, `wakeTime`)
VALUES
('26', '2022-04-20 23:46:00','2022-04-21 10:33:59'),
('26', '2022-04-21 22:31:00','2022-04-22 09:24:59'),
('26', '2022-04-22 23:02:00','2022-04-23 09:15:59'),
('26', '2022-04-23 23:12:00','2022-04-24 10:44:59'),
('26', '2022-04-24 23:48:00','2022-04-25 08:51:53'),
('26', '2022-04-25 22:53:00','2022-04-26 08:40:38'),
('26', '2022-04-26 23:55:00','2022-04-27 09:30:59')
-->