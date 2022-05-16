<!DOCTYPE html>
<html lang="en">

    <head>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        
        <?php
        $memberOnly = true;
        include_once('nav.php'); // Needed for db connection
        echo $extLinks;



        //register for Exercise
        if (isset($_POST['submit']) && isset($_SESSION['userID'])) {
            $exercise       = $mysqli->real_escape_string($_POST['exerciseType']);
            $dist           = $mysqli->real_escape_string($_POST['distance']);
            $sdate          = $mysqli->real_escape_string($_POST['sdate']); 
            $stime          = $mysqli->real_escape_string($_POST['stime']); 
            $edate          = $mysqli->real_escape_string($_POST['edate']); 
            $etime          = $mysqli->real_escape_string($_POST['etime']);
            $user           = $_SESSION['userID'];
            $starttime      = $sdate.' '.$stime;
            $endtime        = $edate.' '.$etime;

            
            $query = "INSERT INTO HD_ExerciseData (userID, exerciseID, distance, startTime, endTime) 
            VALUES ('$user', (SELECT exerciseID FROM HD_ExerciseType WHERE exerciseType = '$exercise'), '$dist', '$starttime', '$endtime')";
           
            $mysqli->query($query);
            echo $mysqli->error;


        }

        //Register for Health data
        if (isset($_POST['submit2']) && isset($_SESSION['userID'])) {
            $health       = $mysqli->real_escape_string($_POST['healthType']);
            $amount       = $mysqli->real_escape_string($_POST['amount']);
            $date         = $mysqli->real_escape_string($_POST['date']); 
            $user         = $_SESSION['userID'];


            $query = "INSERT INTO HD_HealthData (userID, healthTypeID, amount, date) 
            VALUES ('$user', (SELECT healthTypeID FROM HD_HealthType WHERE healthType = '$health'), '$amount', '$date')";
           
            $mysqli->query($query);
            echo $mysqli->error;

        }


        //register for sleep
        if (isset($_POST['submit3']) && isset($_SESSION['userID'])) {
            $bdate          = $mysqli->real_escape_string($_POST['bdate']); 
            $btime          = $mysqli->real_escape_string($_POST['btime']); 
            $wdate          = $mysqli->real_escape_string($_POST['wdate']); 
            $wtime          = $mysqli->real_escape_string($_POST['wtime']);
            $user           = $_SESSION['userID'];
            $bedtime        = $bdate.' '.$btime;
            $waketime       = $wdate.' '.$wtime;

            
            $query = "INSERT INTO HD_SleepData (userID, bedTime, wakeTime) 
            VALUES ('$user', '$bedtime', '$waketime')";
           
            $mysqli->query($query);
            echo $mysqli->error;


        }




        //Register for number of naps 
        if (isset($_POST['submit4']) && isset($_SESSION['userID'])) {
            $naps           = $mysqli->real_escape_string($_POST['naps']);
            $date           = $mysqli->real_escape_string($_POST['date2']); 
            $user           = $_SESSION['userID'];


            $query = "INSERT INTO HD_NapData (userID, date, napsToday) 
            VALUES ('$user', '$date', '$naps')";
           
            $mysqli->query($query);
            echo $mysqli->error;

        }



        


            





        ?>

    <meta charset="utf-8">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.1.4/dist/css/datepicker.min.css'>  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <title>Add Exercise</title>
    
    <style>
        
    </style>


    </head>

    

    <body class="topp" onload="click()">
        <?php
        echo $navigation
        ?>
        
            

        <section id="contact vh-100">
            <div class="container-lg py-5">
                <div class="text-center">
                <h2>Log Exercises and Health Data below!</h2>
                <p class="lead text-black-50">Use the navigation field to navigate through the tabs.</p>
                </div>

                <div class="row justify-content-center my-5">

                    <!-- Navigation field for registering different user data-->
                    <ul class="nav nav-pills mb-3 justify-content-center" >
                        <li class="nav-pills"><a class="nav-link" id="exerciselink" href="#exercise">Add Exercise Data</a></li>
                        <li class="nav-pills"><a class="nav-link" href="#health">Add Health Data</a></li>
                        <li class="nav-pills"><a class="nav-link" href="#sleep">Add Sleep Time</a></li>
                        <li class="nav-pills"><a class="nav-link" href="#numNaps">Add Number of Naps</a></li>
                    </ul>


                    <div class="tab-content col-4">

                        <!-- Contains Add Exercise data-->
                        <div id="exercise" class="tab-pane fade in justify-content-center">
                            <div class="card shadow-2-strong " style="border-radius: 1rem;">
                                <div class="card-body p-5 text-center">

                                    <div class="col">
                                        <form action="" method="POST">
                                        
                                            <div class="row mb-4 justify-content-center">

                                                <div class="col-6">
                                                    <label class="form-label" for="exerciseType">Choose exercise</label>
                                                    <select class="form-control form-select" name="exerciseType" required>
                                                        <option value="">Exercises</option>
                                                        <option value="walking">Walking</option>
                                                        <option value="running">Running</option></option>
                                                        <option value="cycling">Cycling</option>
                                                    </select>
                                                </div>   
                                                
                                                <div class="col-5">
                                                    <div class="form mb-4 km">
                                                        <label class="form-label" for="distance">Distance km/h</label>
                                                        <input type="number" min="0" id="dist" name="distance" class="form-control" autocomplete="off" required/>                            
                                                    </div>
                                                </div>
                                                
                                            </div>


                                            <div class="row mb-4">
                                                <label class="form-label" for="startTime">Start time</label>

                                                <div class="col">
                                                    <div class="form mb-4"> 
                                                        <div>
                                                            <input class="form-control" type="date" id="sdate" name="sdate" value="<?php echo date('Y-m-d'); ?>" required />
                                                        </div>                                                
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <div class="form mb-4">
                                                        <div>
                                                            <input class="form-control" type="time" id="stime" name="stime" value="<?php echo date('H:i'); ?>" required />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label class="form-label" for="endTime">End time</label>

                                                <div class="col">
                                                    <div class="form mb-4"> 
                                                        <div>
                                                            <input class="form-control" type="date" id="edate" name="edate" value="<?php echo date('Y-m-d'); ?>" required />
                                                        </div>                                                
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <div class="form mb-4">
                                                        <div>
                                                            <input class="form-control" type="time" id="etime" name="etime" value="<?php echo date('H:i'); ?>" required />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Submit button -->
                                            <button type="submit" name="submit" class="btn btn-primary btn-block mb-4">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>


                        
                        
                        <!-- Contains Add Health data-->
                        <div id="health" class="tab-pane fade in justify-content-center">
                        
                            <div class="card shadow-2-strong" style="border-radius: 1rem; z-index: 1;">
                                <div class="card-body p-5 text-center">
                                
                                    <div class="col">
                                        <form action="" method="POST">
                                        
                                            <div class="row mb-4">
                                                
                                                <div class="col">
                                                    
                                                    <label class="form-label mb-4" for="healthType">Choose a type of health data</label>
                                                    <select class="form-control form-select" name="healthType" required>
                                                        <option value="">Health Data</option>
                                                        <option value="steps">Steps</option>
                                                        <option value="calories">calories</option>
                                                        <option value="weight">weight</option>
                                                    </select>
                                                    
                                                </div>                                    
                                                
                                            </div>

                                            <div class="row mb-4">
                                                <div class="col">
                                                    <div class="form mb-4">
                                                        <label class="form-label" for="amount">Amount</label>
                                                        <input type="number" min="0" id="dist" name="amount" class="form-control" autocomplete="off" required/>                            
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <div class="form mb-4">                                        
                                                        <label class="form-label" for="date">Date</label>
                                                        <div class="col">
                                                            <input class="form-control" type="date" id="date" name="date" value="<?php echo date('Y-m-d'); ?>" required>
                                                        </div>    
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Submit button -->
                                            <button type="submit" name="submit2" class="btn btn-primary btn-block mb-4">Submit</button>

                                            
                                        </form>
                                    </div>
                                </div>             
                            </div>
                        </div>






                        <!-- Contains Add sleep data-->
                        <div id="sleep" class="tab-pane fade in justify-content-center">
                            <div class="card shadow-2-strong " style="border-radius: 1rem;">
                                <div class="card-body p-5 text-center">

                                    <div class="col">
                                        <form action="" method="POST">
                                        


                                            <div class="row mb-4">
                                                <label class="form-label" for="bedTime">Start time</label>

                                                <div class="col">
                                                    <div class="form mb-4"> 
                                                        <div>
                                                            <input class="form-control" type="date" id="bdate" name="bdate" value="<?php echo date('Y-m-d'); ?>" required />
                                                        </div>                                                
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <div class="form mb-4">
                                                        <div>
                                                            <input class="form-control" type="time" id="btime" name="btime" value="<?php echo date('H:i'); ?>" required />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row mb-4">
                                                <label class="form-label" for="wakeTime">End time</label>

                                                <div class="col">
                                                    <div class="form mb-4"> 
                                                        <div>
                                                            <input class="form-control" type="date" id="wdate" name="wdate" value="<?php echo date('Y-m-d'); ?>" required />
                                                        </div>                                                
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <div class="form mb-4">
                                                        <div>
                                                            <input class="form-control" type="time" id="wtime" name="wtime" value="<?php echo date('H:i'); ?>" required />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <!-- Submit button -->
                                            <button type="submit" name="submit3" class="btn btn-primary btn-block mb-4">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>





                        <!-- Contains Add naps data-->
                        <div id="numNaps" class="tab-pane fade in justify-content-center">
                        
                            <div class="card shadow-2-strong" style="border-radius: 1rem; z-index: 1;">
                                <div class="card-body p-5 text-center">
                                
                                    <div class="col">
                                        <form action="" method="POST">                                    

                                            <div class="row mb-4">

                                                
                                                <div class="col-8">
                                                    <div class="form mb-4">                                        
                                                        <label class="form-label" for="date2">Date</label>
                                                        <div class="col">
                                                            <input class="form-control"  type="date" id="date2" name="date2" value="<?php echo date('Y-m-d'); ?>" required />  
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-4">
                                                    <div class="form mb-4">
                                                        <label class="form-label" for="naps">Nr of naps</label>
                                                        <input type="number" id="naps" min="0" name="naps" class="form-control" autocomplete="off" required/>                            
                                                    </div>
                                                </div>

                                            </div>

                                            <!-- Submit button -->
                                            <button type="submit" name="submit4" class="btn btn-primary btn-block mb-4">Submit</button>

                                            
                                        </form>
                                    </div>
                                </div>             
                            </div>
                        </div>










                        
                    </div>

                </div>
            </div>
        </section>

        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src='https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.1.4/dist/js/datepicker-full.min.js'></script>





        <!-- Script for select form-->
        <script>

            const inputScreen = $('<select class="selectpicker"><option>test</option></select>').appendTo(conScreen);
            inputScreen.selectpicker();

        </script>

        <script src="https://code.jquery.com/jquery-1.9.1.js"></script>

        <!-- AJAX script for loading in different tabs without refreshing-->
        <script >
            $(function(){
            $(document).ready(function () {
                $('#exerciselink')[0].click();
                
            });
        });
        </script> 

        <script>
        $(document).ready(function(){
            $(".nav-pills a").click(function(){
                $(this).tab('show');
                preventDefault();
            });
        });
        </script>

        <?php
            include('footer.php');
        ?>
    </body>
    


</html>