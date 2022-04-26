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
                            <button class="nav-link" id="v-pills-bedtime-tab" data-bs-toggle="pill" data-bs-target="#v-pills-bedtime" type="button" role="tab" aria-controls="v-pills-bedtime" aria-selected="false">Bedtime</button>
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
                            <canvas id="bedtime-chart"></canvas>
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
        <script src="Media/js/charts.js"></script>

        <!--Chart JS-->
        <script>
            //STEPS
            // Steps chart
            let stepsChart = document.getElementById("steps-chart").getContext("2d");
            
            let stepData = <?php echo json_encode($phpSteps); ?>;
            let stepLabels = <?php echo json_encode($phpStepDate) ?>; 
            let stepColors = "#61892F";
            let stepBgColor = "#86C232";

            let stepsChart1 = new Chart(stepsChart, {
                type: "line",
                data: {
                    labels: stepLabels,
                    datasets: [ {
                        label: "Steps",
                        data: stepData,
                        fill: false,
                        borderColor: stepColors,
                        backgroundColor: stepBgColor,
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
                        borderColor: stepColors,
                        backgroundColor: stepBgColor,
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

        </script>

    </body>
</html>