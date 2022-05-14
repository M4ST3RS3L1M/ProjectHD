<!DOCTYPE html>
<html lang="en">
	<head>

        <?php
            $memberOnly = true;
            include_once('nav.php');
            include('chartQueries.php');
            echo $extLinks;
        ?>

        <style>
            .air {
                margin: 15px;
            }
            .flex-column .nav-link {
                padding: 17px 29px 16px!important;
            }
            .cardData {
                color: #1b136c;
                font-weight: bold;
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
            
            <!-- First row - Heading -->
            <div class="row text-center">
                <h1 class="air">Your Health Dashboard</h1>
                <hr class="air">
            </div>

            <!-- Second row - Subheading and cards 1 -->
            <div class="row justify-content-center  text-center">
                <h2 class="cardData">Exercise and Health</h2>
                <h4>Most recently logged data</h4>

                <!-- 5 Cards for displaying data -->
                <div class="col-lg-2">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Steps</h5>
                            <p class="cardData">
                                <!-- Last date and data -->
                                <?php
                                echo $phpStepDate[count($phpStepDate)-1] . "<br>";
                                echo number_format($phpStepData[count($phpStepData)-1], 0, ',', ' ');
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Calories</h5>
                            <p class="cardData">
                                <?php
                                echo $phpCalorieDate[count($phpCalorieDate)-1] . "<br>";
                                echo number_format($phpCalorieData[count($phpCalorieData)-1], 0, ',', ' ');
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Walking Dist.</h5>
                            <p class="cardData">
                                <?php
                                echo $phpWalkDate[count($phpWalkDate)-1] . "<br>";
                                echo $phpWalkData[count($phpWalkData)-1] . "km";
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Cycling Dist.</h5>
                            <p class="cardData">
                                <?php
                                echo $phpCyclingDate[count($phpCyclingDate)-1] . "<br>";
                                echo $phpCyclingData[count($phpCyclingData)-1] . "km";
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Weight</h5>
                            <p class="cardData">
                                <?php
                                echo $phpWeightDate[count($phpWeightDate)-1] . "<br>";
                                echo $phpWeightData[count($phpWeightData)-1] . "kg";
                                ?>
                            </p>
                        </div>
                    </div>
                </div>

                <hr class="air">
            </div>

            <!-- Third row - Graphs 1 -->
            <div class="row justify-content-center  text-center">
                <h4 class="air">Personalised graphs</h4>
                        
                <!-- Nav tabs -->
                <div class="d-flex align-items-start col-lg-auto">
                    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <button class="nav-link active" id="v-pills-steps-tab" data-bs-toggle="pill" data-bs-target="#v-pills-steps" type="button" role="tab" aria-controls="v-pills-steps" aria-selected="true">Steps per day</button>
                        <button class="nav-link" id="v-pills-energy-tab" data-bs-toggle="pill" data-bs-target="#v-pills-energy" type="button" role="tab" aria-controls="v-pills-energy" aria-selected="false">Energy expenditure</button>
                        <button class="nav-link" id="v-pills-walking-tab" data-bs-toggle="pill" data-bs-target="#v-pills-walking" type="button" role="tab" aria-controls="v-pills-walking" aria-selected="false">Daily walking dist.</button>
                        <button class="nav-link" id="v-pills-cycling-tab" data-bs-toggle="pill" data-bs-target="#v-pills-cycling" type="button" role="tab" aria-controls="v-pills-cycling" aria-selected="false">Daily cycling dist.</button>
                        <button class="nav-link" id="v-pills-weight-tab" data-bs-toggle="pill" data-bs-target="#v-pills-weight" type="button" role="tab" aria-controls="v-pills-weight" aria-selected="false">Weight</button>
                    </div>
                </div>

                <!-- Tab panes -->
                <div class="tab-content col-lg-9 air" id="v-pills-tabContent">
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
                    <div class="tab-pane fade" id="v-pills-weight" role="tabpanel" aria-labelledby="v-pills-weight-tab">
                        <canvas id="weight-chart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Fourth row - Subheading and cards 2 -->
            <div class="row justify-content-center  text-center">
                <hr class="air">
                <h2 class="cardData">Sleeping Routines</h2>
                <h4>Most recently logged data</h4>
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Bedtime</h5>
                            <p class="cardData">
                            <?php
                            echo $phpBedtimeDate[count($phpBedtimeDate)-1] . "<br>";
                            $lastBedtime = $phpBedtimeData[count($phpBedtimeData)-1];
                            $lastBedtime = floor($lastBedtime/60) . ":" . floor($lastBedtime%60) . ":" . floor((($lastBedtime%60) % 1)*60);
                            echo $lastBedtime;
                            ?>
                        </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Wake-Time</h5>
                            <p class="cardData">
                            <?php
                            echo $phpWaketimeDate[count($phpWaketimeDate)-1] . "<br>";
                            $lastWaketime = $phpWaketimeData[count($phpWaketimeData)-1];
                            $lastWaketime = floor($lastWaketime/60) . ":" . floor($lastWaketime%60) . ":" . floor((($lastWaketime%60) % 1)*60);
                            echo $lastWaketime;
                            ?>
                        </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Sleep Duration</h5>
                            <p class="cardData">
                            <?php
                            echo $phpBedtimeDate[count($phpBedtimeDate)-1] . "<br>";
                            echo number_format($phpSleepDurData[count($phpSleepDurData)-1], 1, ',', ' ') . "h";
                            ?>
                        </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Naps</h5>
                            <p class="cardData">
                            <?php
                            echo $phpNapDate[count($phpNapDate)-1] . "<br>";
                            echo $phpNapData[count($phpNapData)-1];
                            ?>
                        </p>
                        </div>
                    </div>
                </div>
                <hr class="air">
            </div>

            <!-- Fifth row - Graphs 2 -->
            <div class="row justify-content-center  text-center">
                <h4 class="air">Personalised graphs</h4>
                
                <!-- Nav tabs -->
                <div class="d-flex align-items-start col-lg-auto">
                    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <button class="nav-link active" id="v-pills-bedtime-tab" data-bs-toggle="pill" data-bs-target="#v-pills-bedtime" type="button" role="tab" aria-controls="v-pills-bedtime" aria-selected="true">Bedtimes</button>
                        <button class="nav-link" id="v-pills-waketime-tab" data-bs-toggle="pill" data-bs-target="#v-pills-waketime" type="button" role="tab" aria-controls="v-pills-waketime" aria-selected="false">Wake-up-times</button>
                        <button class="nav-link" id="v-pills-sleep-tab" data-bs-toggle="pill" data-bs-target="#v-pills-sleep" type="button" role="tab" aria-controls="v-pills-sleep" aria-selected="false">Sleep duration</button>
                        <button class="nav-link" id="v-pills-nap-tab" data-bs-toggle="pill" data-bs-target="#v-pills-nap" type="button" role="tab" aria-controls="v-pills-nap" aria-selected="false">Daily naps</button>
                    </div>
                </div>

                <!-- Tab panes -->
                <div class="tab-content col-lg-9" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-bedtime" role="tabpanel" aria-labelledby="v-pills-bedtime-tab">
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
                </div>

            </div>
            <hr class="air">
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
