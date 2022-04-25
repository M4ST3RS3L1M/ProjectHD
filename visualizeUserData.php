<!DOCTYPE html>
<html lang="en">
	<head>

        <?php
        include_once('nav.php');
        echo $extLinks;

        $query = (
            "SELECT * FROM HD_ExersiceData WHERE ed.userID='CURRENT USER' AND et.exerciseType='excerciseType'"
        );

        ?>

        <style>
                .flex-column .nav-link {
                    padding: 17px 29px 16px!important;
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
                    <div class="d-flex align-items-start col-lg-3">
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

                    <!--Alternative version-->
                    <hr>
                    <hr>
                    <hr>
                    <hr>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="steps-tab" data-bs-toggle="tab" data-bs-target="#steps" type="button" role="tab" aria-controls="steps" aria-selected="true">Steps per day</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="energy-tab" data-bs-toggle="tab" data-bs-target="#energy" type="button" role="tab" aria-controls="energy" aria-selected="false">Energy expenditure</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="walking-tab" data-bs-toggle="tab" data-bs-target="#walking" type="button" role="tab" aria-controls="walking" aria-selected="false">Daily walking dist.</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="cycling-tab" data-bs-toggle="tab" data-bs-target="#cycling" type="button" role="tab" aria-controls="cycling" aria-selected="false">Daily cycling dist.</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="bedtime-tab" data-bs-toggle="tab" data-bs-target="#bedtime" type="button" role="tab" aria-controls="bedtime" aria-selected="false">Bedtime</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="wakeup-tab" data-bs-toggle="tab" data-bs-target="#wakeup" type="button" role="tab" aria-controls="wakeup" aria-selected="false">Wake-up time</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="sleep-tab" data-bs-toggle="tab" data-bs-target="#sleep" type="button" role="tab" aria-controls="sleep" aria-selected="false">Sleep duration</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="nap-tab" data-bs-toggle="tab" data-bs-target="#nap" type="button" role="tab" aria-controls="nap" aria-selected="false">Daily naps</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="weight-tab" data-bs-toggle="tab" data-bs-target="#weight" type="button" role="tab" aria-controls="weight" aria-selected="false">Weight</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="steps" role="tabpanel" aria-labelledby="steps-tab">...</div>
                        <div class="tab-pane fade" id="energy" role="tabpanel" aria-labelledby="energy-tab">...</div>
                        <div class="tab-pane fade" id="walking" role="tabpanel" aria-labelledby="walking-tab">...</div>
                        <div class="tab-pane fade" id="cycling" role="tabpanel" aria-labelledby="cycling-tab">...</div>
                        <div class="tab-pane fade" id="bedtime" role="tabpanel" aria-labelledby="bedtime-tab">...</div>
                        <div class="tab-pane fade" id="wakeup" role="tabpanel" aria-labelledby="wakeup-tab">...</div>
                        <div class="tab-pane fade" id="sleep" role="tabpanel" aria-labelledby="sleep-tab">...</div>
                        <div class="tab-pane fade" id="nap" role="tabpanel" aria-labelledby="nap-tab">...</div>
                        <div class="tab-pane fade" id="weight" role="tabpanel" aria-labelledby="weight-tab">...</div>
                    </div>
            </div>
        </div>

        <?php
            include('footer.php');
        ?>
        
        <!--Required scripts-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="Media/js/charts.js"></script>

    </body>
</html>