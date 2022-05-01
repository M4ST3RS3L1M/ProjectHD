<!DOCTYPE html>
<html lang="en">

    <head>

        <?php
        $memberOnly = true;
        include_once('nav.php'); // Needed for db connection
        echo $extLinks;




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

            /*echo $starttime;
            echo $endtime;

            echo "exercise: ", $exercise;
            echo "<br>";
            echo "distance: ", $dist;
            echo "<br>";
            echo "Startdate:", $sdate;
            echo "<br>";
            echo "Starttime:", $stime;
            echo "<br>";
            echo "Enddate: ", $edate," ",  $etime;
            echo "<br>";
            echo "Endtime: ", $etime;
            echo "<br>";
            echo "USER: ", $user;
            */

            
            $query = "INSERT INTO HD_ExerciseData (userID, exerciseID, distance, startTime, endTime) 
            VALUES ('$user', (SELECT exerciseID FROM HD_ExerciseType WHERE exerciseType = '$exercise'), '$dist', '$starttime', '$endtime')";
           
            $mysqli->query($query);
            echo $mysqli->error;

        }







        ?>

    <meta charset="utf-8">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.1.4/dist/css/datepicker.min.css'>  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <title>Add Exercise</title>



    </head>



    <body>
        <?php
        echo $navigation
        ?>

        <section id="contact vh-100">
            <div class="container-lg py-5">
                <div class="text-center">
                <h2>Add exercises!</h2>
                <p class="lead text-black-50">Add an exercise below!</p>
                </div>

                
                <ul class="nav nav-pills mb-3" id="ex1" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a
                        class="nav-link active"
                        id="ex1-tab-1"
                        data-mdb-toggle="pill"
                        href="#ex1-pills-1"
                        role="tab"
                        aria-controls="ex1-pills-1"
                        aria-selected="true"
                        >Tab 1</a
                        >
                    </li>
                    <li class="nav-item" role="presentation">
                        <a
                        class="nav-link"
                        id="ex1-tab-2"
                        data-mdb-toggle="pill"
                        href="#ex1-pills-2"
                        role="tab"
                        aria-controls="ex1-pills-2"
                        aria-selected="false"
                        >Tab 2</a
                        >
                    </li>
                    <li class="nav-item" role="presentation">
                        <a
                        class="nav-link"
                        id="ex1-tab-3"
                        data-mdb-toggle="pill"
                        href="#ex1-pills-3"
                        role="tab"
                        aria-controls="ex1-pills-3"
                        aria-selected="false"
                        >Tab 3</a
                        >
                    </li>
                </ul>
                
                <div class="tab-content" id="ex1-content">
                    <div
                        class="tab-pane fade show active"
                        id="ex1-pills-1"
                        role="tabpanel"
                        aria-labelledby="ex1-tab-1"
                    >
                        Tab 1 content
                    </div>
                    <div class="tab-pane fade" id="ex1-pills-2" role="tabpanel" aria-labelledby="ex1-tab-2">
                        Tab 2 content
                    </div>
                    <div class="tab-pane fade" id="ex1-pills-3" role="tabpanel" aria-labelledby="ex1-tab-3">
                        Tab 3 content
                    </div>
                </div>










                <div class="row justify-content-center my-5">
                    <div class="col-lg-6">
                        <form action="" method="POST">
                        
                            <div class="row mb-4">

                                <div class="col">
                                    <div class="form">
                                        <label class="form-label">Workout name</label>
                                        <input type="text" class="form-control" autocomplete="off"/>
                                    </div>
                                </div>
                                
                                <div class="col">
                                    
                                    <label class="form-label" for="exerciseType">Choose a type of exercise</label>
                                    <select class="form-control form-select" name="exerciseType">
                                        <option value="1">Exercises</option>
                                        <option value="walking">Walking</option>
                                        <option value="running">Running</option></option>
                                        <option value="cycling">Cycling</option>
                                    </select>
                                    
                                </div>

                            
                                
                            </div>

                            


                         
                            <div class="row mb-4">
                                <div class="col">
                                    <div class="form mb-4">
                                        <label class="form-label" for="distance">Distance</label>
                                        <input type="number" id="dist" name="distance" class="form-control" autocomplete="off"/>                            
                                    </div>
                                </div>

                                <div class="col-5">
                                    <div class="form mb-4">                                        
                                        <label class="form-label" for="startTime">Start time</label>
                                        <div style="display: inline-flex;">
                                            <div class="col-6">
                                                <input class="form-control" type="date" id="sdate" name="sdate" value="2022-04-28">
                                            </div>
                                                <span></span>
                                            <div class="col-5">
                                                <input class="form-control" type="time" id="stime" name="stime" value="08:00">
                                            </div>
                                            
                                        </div>
                                        <!--<input type="datetime-local" class="form-control" name="startTime"/>-->
                                        <!-- <input type="text" id="datepicker" class="datepicker_input form-control" name="DOB" placeholder="YYYY-MM-DD" required aria-label="Select your date of birth">-->
                                    </div>
                                </div>

                                <div class="col-5">
                                    <div class="form mb-4">
                                        <label class="form-label" for="endTime">End time</label>
                                        <div style="display: inline-flex;">
                                            <div class="col-6">
                                                <input class="form-control" type="date" id="edate" name="edate" value="2022-04-28">
                                            </div>
                                                <span></span>
                                            <div class="col-5">
                                                <input class="form-control" type="time" id="etime" name="etime" value="08:00">
                                            </div>
                                            
                                        </div>
                                        <!--<input type="datetime-local" class="form-control" name="endTime" />-->
                                                                    
                                    </div>
                                </div>
                            </div>

                    

                            <!-- Submit button -->
                            <button type="submit" name="submit" class="btn btn-primary btn-block mb-4">Submit</button>

                            
                        </form>
                    </div>
                </div>
            </div>
        </section>

        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src='https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.1.4/dist/js/datepicker-full.min.js'></script>


        <script>

            const inputScreen = $('<select class="selectpicker"><option>test</option></select>').appendTo(conScreen);
            inputScreen.selectpicker();

        </script>

    </body>


</html>