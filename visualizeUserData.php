<!DOCTYPE html>
<html lang="en">
	<head>

        <?php
        $memberOnly = true;
        include_once('nav.php');
        echo $extLinks;

        // CHART QUERIES //

        // STEPS
        // Query to get step data
        $stepQuery = (
            "SELECT hd.amount, hd.date
            FROM HD_HealthData hd
            JOIN HD_HealthType ht ON hd.healthTypeID = ht.healthTypeID
            WHERE hd.userID= {$_SESSION['userID']} AND ht.healthType='steps'"
        );

        $phpStepData = array();
        $phpStepDate = array();
        // Extracting data from returned object
        $result = mysqli_query($mysqli, $stepQuery);
        while($obj=$result->fetch_object()){
            array_push($phpStepData, $obj->amount);
            array_push($phpStepDate, $obj->date);
        }



        // CALORIES
        // Query to get calorie data
        $calorieQuery = (
            "SELECT hd.amount, hd.date
            FROM HD_HealthData hd
            JOIN HD_HealthType ht ON hd.healthTypeID = ht.healthTypeID
            WHERE hd.userID= {$_SESSION['userID']} AND ht.healthType='calories'"
        );

        $phpCalorieData = array();
        $phpCalorieDate = array();
        // Extracting data from returned object
        $result = mysqli_query($mysqli, $calorieQuery);
        while($obj=$result->fetch_object()){
            array_push($phpCalorieData, $obj->amount);
            array_push($phpCalorieDate, $obj->date);
        }



        // WALKING DIST
        // Query to get walking dist data
        $walkDQuery = (
            "SELECT ed.distance, ed.startTime
            FROM HD_ExerciseData ed
            JOIN HD_ExerciseType et ON ed.exerciseID = et.exerciseID
            WHERE ed.userID= {$_SESSION['userID']} AND et.exerciseType='walking'"
        );

        $phpWalkData = array();
        $phpWalkDate = array();
        // Extracting data from returned object
        $result = mysqli_query($mysqli, $walkDQuery);
        while($obj=$result->fetch_object()){
            $walkDate = $obj->startTime;
            $walkDate = substr($walkDate, 0, 10); // To just display the date
            array_push($phpWalkData, $obj->distance);
            array_push($phpWalkDate, $walkDate);
        }



        // CYCLING DIST
        // Query to get cycling dist data
        $cyclingDQuery = (
            "SELECT ed.distance, ed.startTime
            FROM HD_ExerciseData ed
            JOIN HD_ExerciseType et ON ed.exerciseID = et.exerciseID
            WHERE ed.userID= {$_SESSION['userID']} AND et.exerciseType='cycling'"
        );

        $phpCyclingData = array();
        $phpCyclingDate = array();
        // Extracting data from returned object
        $result = mysqli_query($mysqli, $cyclingDQuery);
        while($obj=$result->fetch_object()){
            $cycleDate = $obj->startTime;
            $cycleDate = substr($cycleDate, 0, 10); // To just display the date
            array_push($phpCyclingData, $obj->distance);
            array_push($phpCyclingDate, $cycleDate);
        }



        // SLEEP AND DURATION
        // Query to get sleep data
        $bedtimeQuery = (
            "SELECT bedTime, wakeTime
            FROM HD_SleepData
            WHERE userID= {$_SESSION['userID']}"
        );

        // Initializing needed arrays
        $phpBedtimeData = array();
        $phpBedtimeDate = array();
        $phpWaketimeData = array();
        $phpWaketimeDate = array();
        $phpSleepDurData = array();

        // Extracting data from returned object
        $result = mysqli_query($mysqli, $bedtimeQuery);
        while($obj=$result->fetch_object()){
            $returnBedtime = $obj->bedTime;
            $returnWakeUp = $obj->wakeTime;

            // Get the date-part for bedtime and wake-up time of returned data
            array_push($phpBedtimeDate, substr($returnBedtime, 0, 10));
            array_push($phpWaketimeDate, substr($returnWakeUp, 0, 10));

            // Get bedtime-part of returned data and format it as minutes
            $bedtime = new DateTime(substr($returnBedtime, 11));
            $bedtimeMinutes = $bedtime->format('H')*60 + ($bedtime->format('i')) + ($bedtime->format('s')/60);

            // Get wakeup-part of returned data and format it as minutes
            $waketime = new DateTime(substr($returnWakeUp, 11));
            $waketimeMinutes = $waketime->format('H')*60 + ($waketime->format('i')) + ($waketime->format('s')/60);

            // Adds bed- and waketime to array as in-data for chart
            array_push($phpBedtimeData, $bedtimeMinutes);
            array_push($phpWaketimeData, $waketimeMinutes);

            // Part to extract SLEEP DURATION data

            // If bedtime is before midnight
            if ($bedtime > $waketime) {
                // Calculate hours slept before midnight
                $timeToMidnight = $bedtime->diff(new DateTime("24:00:00"));
                $hoursToMidnight = $timeToMidnight->h + ($timeToMidnight->i/60) + ($timeToMidnight->s/3600);

                // Calculate hourse slept after midnight
                $remainingHours = new DateTime("00:00:00");
                $remainingHours = $remainingHours->diff($waketime);
                $remainingHours = $remainingHours->h + ($remainingHours->i/60) + ($remainingHours->s/3600);
                
                // Adds hours together for total sleep duration
                $sleepDuration = $hoursToMidnight + $remainingHours;
            }
            //If bedtime is after midnight
            else {
                // Calculate total sleep duration
                $timeSlept = $waketime->diff($bedtime);
                $sleepDuration = $timeSlept->h + ($timeSlept->i/60) + ($timeSlept->s/3600);
            }
            
            array_push($phpSleepDurData, $sleepDuration);
        }



        // NAPS
        // Query to get nap data
        $napQuery = (
            "SELECT date, napsToday
            FROM HD_NapData
            WHERE userID= {$_SESSION['userID']}"
        );

        $phpNapData = array();
        $phpNapDate = array();
        // Extracting data from returned object
        $result = mysqli_query($mysqli, $napQuery);
        while($obj=$result->fetch_object()){
            array_push($phpNapData, $obj->napsToday);
            array_push($phpNapDate, $obj->date);
        }



        // WEIGHT
        // Query to get weight data
        $weightQuery = (
            "SELECT hd.amount, hd.date
            FROM HD_HealthData hd
            JOIN HD_HealthType ht ON hd.healthTypeID = ht.healthTypeID
            WHERE hd.userID= {$_SESSION['userID']} AND ht.healthType='weight'"
        );

        $phpWeightData = array();
        $phpWeightDate = array();
        // Extracting data from returned object
        $result = mysqli_query($mysqli, $weightQuery);
        while($obj=$result->fetch_object()){
            array_push($phpWeightData, $obj->amount);
            array_push($phpWeightDate, $obj->date);
        }

        ?>

        <style>
            .air {
                margin: 15px;
            }
            .flex-column .nav-link {
                padding: 17px 29px 16px!important;
            }
            canvas {
                background-color: #f5f5f5;
            }
        </style>

        <title>Visualize your data</title>

	</head>

	<body>
        <?php
            echo $navigation;
        ?>
        <div class="container text-black-50">
            <div class="row">
		        
                </div>
                <div class="row text-center">
                    <h1 class="air">Data overview</h1>
                    <h4 class="air">Select a tab</h4>
                    <hr>
                </div>
                <div class="row">
                        
                    <!-- Nav tabs -->
                    <div class="d-flex align-items-start col-lg-auto">
                        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <button class="nav-link active" id="v-pills-steps-tab" data-bs-toggle="pill" data-bs-target="#v-pills-steps" type="button" role="tab" aria-controls="v-pills-steps" aria-selected="true">Steps per day</button>
                            <button class="nav-link" id="v-pills-energy-tab" data-bs-toggle="pill" data-bs-target="#v-pills-energy" type="button" role="tab" aria-controls="v-pills-energy" aria-selected="false">Energy expenditure</button>
                            <button class="nav-link" id="v-pills-walking-tab" data-bs-toggle="pill" data-bs-target="#v-pills-walking" type="button" role="tab" aria-controls="v-pills-walking" aria-selected="false">Daily walking dist.</button>
                            <button class="nav-link" id="v-pills-cycling-tab" data-bs-toggle="pill" data-bs-target="#v-pills-cycling" type="button" role="tab" aria-controls="v-pills-cycling" aria-selected="false">Daily cycling dist.</button>
                            <button class="nav-link" id="v-pills-bedtime-tab" data-bs-toggle="pill" data-bs-target="#v-pills-bedtime" type="button" role="tab" aria-controls="v-pills-bedtime" aria-selected="false">Bedtimes</button>
                            <button class="nav-link" id="v-pills-waketime-tab" data-bs-toggle="pill" data-bs-target="#v-pills-waketime" type="button" role="tab" aria-controls="v-pills-waketime" aria-selected="false">Wake-up-times</button>
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
                            <canvas id="bedtime-chart"></canvas>
                        </div>
                        <div class="tab-pane fade" id="v-pills-waketime" role="tabpanel" aria-labelledby="v-pills-waketime-tab">
                            <canvas id="waketime-chart"></canvas>
                        </div>
                        <div class="tab-pane fade" id="v-pills-sleep" role="tabpanel" aria-labelledby="v-pills-sleep-tab">
                            <canvas id="sleepDur-chart"></canvas>
                        </div>
                        <div class="tab-pane fade" id="v-pills-nap" role="tabpanel" aria-labelledby="v-pills-nap-tab">
                            <canvas id="nap-chart"></canvas>
                        </div>
                        <div class="tab-pane fade" id="v-pills-weight" role="tabpanel" aria-labelledby="v-pills-weight-tab">
                            <canvas id="weight-chart"></canvas>
                        </div>
                    </div>
                </div>
                <hr>
            </div>
        </div>

        <?php
            include('footer.php');
        ?>
        
        <!--Required scripts-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <!--Chart JS-->
        <script>

            let dataColor   = "#1b136c";
            let dataBgColor = "#2a1fad";

            //STEPS
            // Steps chart
            let stepsChart = document.getElementById("steps-chart").getContext("2d");
            
            let stepData   = <?php echo json_encode($phpStepData); ?>;
            let stepLabels = <?php echo json_encode($phpStepDate); ?>; 

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
            
            // Colour scheme for charts
            let calorieData   = <?php echo json_encode($phpCalorieData); ?>;
            let calorieLabels = <?php echo json_encode($phpCalorieDate); ?>;

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
            let walkChart  = document.getElementById("walking-chart").getContext("2d");
            
            let walkData   = <?php echo json_encode($phpWalkData); ?>;
            let walkLabels = <?php echo json_encode($phpWalkDate); ?>; 

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
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
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
            let cyclingChart  = document.getElementById("cycling-chart").getContext("2d");
            
            let cyclingData   = <?php echo json_encode($phpCyclingData); ?>;
            let cyclingLabels = <?php echo json_encode($phpCyclingDate); ?>; 

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
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: "Distance cycled per day"
                        }    
                    }
                }
            });



            // BEDTIME
            // Bedtime chart
            let bedtimeChart  = document.getElementById("bedtime-chart").getContext("2d");
            
            let bedtimeData   = <?php echo json_encode($phpBedtimeData); ?>;
            let bedtimeLabels = <?php echo json_encode($phpBedtimeDate); ?>; 

            let bedtimeChart1 = new Chart(bedtimeChart, {
                type: "line",
                data: {
                    labels: bedtimeLabels,
                    datasets: [ {
                        label: "Bedtime",
                        data: bedtimeData,
                        fill: false,
                        pointStyle: 'rectRot',
                        pointRadius: 7.5,
                        showLine: false,
                        backgroundColor: dataBgColor,
                        tension: 0.1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            min: 0,
                            max: 1440,
                            ticks: {
                                stepSize: 180,
                                callback: function(value, index, ticks) {
                                    return Math.floor(value/60) + ':0' + Math.floor((value%60)*60) + ':0' + (value%60)
                                }
                            },
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            labels: {
                                usePointStyle: true,
                            },
                        },
                        tooltip: {
                            callbacks: {
                                label: function(item, everything) {
                                    // Gets minute data before tooltip is rendered
                                    let minData = item.raw
                                    // Calculates hours
                                    let hour = Math.floor(minData/60)
                                    if (hour.toString().length < 2) { // Adds leading zero if needed
                                        hour = '0' + hour
                                    }
                                    // Calculates minutes
                                    let min = Math.floor(minData%60)
                                    if (min.toString().length < 2) { //Adds leading zero if needed
                                        min = '0' + min
                                    }
                                    // Calculates seconds
                                    let sec = Math.floor(((minData%60) % 1)*60)
                                    if (sec.toString().length < 2) { //Adds leading zero if needed
                                        sec = '0' + sec
                                    }
                                    // Concatenates into neat format
                                    let displayData = hour + ':' + min + ':' + sec
                                    
                                    return displayData
                                }
                            }
                        },
                        title: {
                            display: true,
                            text: "Bedtimes each logged day"
                        }    
                    }
                }
            });



            // WAKETIME
            // Bedtime chart
            let waketimeChart  = document.getElementById("waketime-chart").getContext("2d");
            
            let waketimeData   = <?php echo json_encode($phpWaketimeData); ?>;
            let waketimeLabels = <?php echo json_encode($phpWaketimeDate); ?>; 

            let waketimeChart1 = new Chart(waketimeChart, {
                type: "line",
                data: {
                    labels: waketimeLabels,
                    datasets: [ {
                        label: "Wake-up time",
                        data: waketimeData,
                        fill: false,
                        pointStyle: 'rectRot',
                        pointRadius: 7.5,
                        showLine: false,
                        backgroundColor: dataBgColor,
                        tension: 0.1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            min: 0,
                            max: 1440,
                            ticks: {
                                stepSize: 180,
                                callback: function(value, index, ticks) {
                                    return Math.floor(value/60) + ':0' + Math.floor((value%60)*60) + ':0' + (value%60)
                                }
                            },
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            labels: {
                                usePointStyle: true,
                            },
                        },
                        tooltip: {
                            callbacks: {
                                label: function(item, everything) {
                                    // Gets minute data before tooltip is rendered
                                    let minData = item.raw
                                    // Calculates hours
                                    let hour = Math.floor(minData/60)
                                    if (hour.toString().length < 2) { // Adds leading zero if needed
                                        hour = '0' + hour
                                    }
                                    // Calculates minutes
                                    let min = Math.floor(minData%60)
                                    if (min.toString().length < 2) { //Adds leading zero if needed
                                        min = '0' + min
                                    }
                                    // Calculates seconds
                                    let sec = Math.floor(((minData%60) % 1)*60)
                                    if (sec.toString().length < 2) { //Adds leading zero if needed
                                        sec = '0' + sec
                                    }
                                    // Concatenates into neat format
                                    let displayData = hour + ':' + min + ':' + sec
                                    
                                    return displayData
                                }
                            }
                        },
                        title: {
                            display: true,
                            text: "Wake-up times each logged day"
                        }    
                    }
                }
            });



            // SLEEP DURATION
            // Sleep Duration chart
            let sleepDurChart  = document.getElementById("sleepDur-chart").getContext("2d");
            
            let sleepDurData   = <?php echo json_encode($phpSleepDurData); ?>;
            let sleepDurLabels = <?php echo json_encode($phpBedtimeDate); ?>; 

            let sleepDurChart1 = new Chart(sleepDurChart, {
                type: "bar",
                data: {
                    labels: sleepDurLabels,
                    datasets: [ {
                        label: "Sleeping duration (h)",
                        data: sleepDurData,
                        fill: false,
                        borderColor: dataColor,
                        backgroundColor: dataBgColor,
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
                            text: "Hours slept per day"
                        }    
                    }
                }
            });



            // NAPS
            // Nap chart
            let napChart  = document.getElementById("nap-chart").getContext("2d");
            
            let napData   = <?php echo json_encode($phpNapData); ?>;
            let napLabels = <?php echo json_encode($phpNapDate); ?>; 

            let napChart1 = new Chart(napChart, {
                type: "bar",
                data: {
                    labels: napLabels,
                    datasets: [ {
                        label: "Amount of naps",
                        data: napData,
                        fill: false,
                        borderColor: dataColor,
                        backgroundColor: dataBgColor,
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
                            text: "Naps per day"
                        }    
                    }
                }
            });



            // WEIGHT
            // Weight chart
            let weightChart  = document.getElementById("weight-chart").getContext("2d");
            
            let weightData   = <?php echo json_encode($phpWeightData); ?>;
            let weightLabels = <?php echo json_encode($phpWeightDate); ?>; 

            let weightChart1 = new Chart(weightChart, {
                type: "line",
                data: {
                    labels: weightLabels,
                    datasets: [ {
                        label: "Weight",
                        data: weightData,
                        fill: false,
                        borderColor: dataColor,
                        backgroundColor: dataBgColor,
                        tension: 0.1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

        </script>

    </body>
</html>