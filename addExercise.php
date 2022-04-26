<!DOCTYPE html>
<html lang="en">

    <head>


        <?php
        include_once('nav.php'); // Needed for db connection
        echo $extLinks;




        if (isset($_POST['add_button']) && isset($_SESSION['userID'])) {
            $exercise       = $mysqli->real_escape_string($_POST['exerciseType']);
            $dist           = $mysqli->real_escape_string($_POST['distance']);
            $starttime      = $mysqli->real_escape_string($_POST['startTime']); 
            $endtime        = $mysqli->real_escape_string($_POST['endTime']);
            $user           = $_SESSION['userID'];     
        }




        $stmt = "INSERT INTO HD_ExerciseData(userID, exerciseID, distance,startTime,endTime)
        VALUES ($user, (SELECT exerciseID FROM HD_ExerciseType WHERE exerciseType = '$exercise'), 36, '$startTime','$endTime');";

        $mysqli->query($stmt);

        ?>

    <meta charset="utf-8">
    <title>Add Exercise</title>
    </head>



    <body>
        <?php
        echo $navigation
        ?>

        <section id="contact vh-100">
            <div class="container-lg py-5">
                <div class="text-center text-white">
                <h2>Add exercises!</h2>
                <p class="lead text-white-50">Add an exercise below!</p>
                </div>
                <div class="row justify-content-center my-5">
                    <div class="col-lg-6">
                        <form>
                        <!-- 2 column grid layout with text inputs for the first and last names -->
                            <div class="row mb-4">
                                <div class="col">
                                    <div class="form">
                                        <label class="form-label text-white" for="form3Example1">Workout name</label>
                                        <input type="text" id="form3Example1" class="form-control" />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-select mb-4">
                                        <label class="form-label " for="form2Example33">Subscribe to our newsletter</label>
                                        <select class="form me-2" type="select" value="" id="form2Example33">
                                            <option value="1">TEST</option>
                                            <option value="2">TEST 1</option>
                                            <option value="3">TEST 2</option>
                                            <option value="4">TEST 3</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Email input -->
                            <div class="form mb-4">
                                <label class="form-label text-white" for="form3Example3">Distance</label>
                                <input type="email" id="form3Example3" class="form-control" />                            
                            </div>

                            <!-- Password input -->
                            <div class="row mb-4">
                                <div class="col">
                                    <div class="form mb-4">
                                        <label class="form-label text-white" for="form3Example4">Start time</label>
                                        <input type="password" id="form3Example4" class="form-control" />                            
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form mb-4">
                                        <label class="form-label text-white" for="form3Example4">End time</label>
                                        <input type="password" id="form3Example4" class="form-control"/>                            
                                    </div>
                                </div>
                            </div>

                    

                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary btn-block mb-4">Sign up</button>

                            
                        </form>
                    </div>
                </div>
            </div>
        </section>

        



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src='https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.1.4/dist/js/datepicker-full.min.js'></script>


    </body>


</html>