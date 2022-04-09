<?php
include('nav.php');
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <title>Add Execise</title>
    </head>



    <body>
        <?php
        echo $navigation
        ?>


        <div id="logContainer" class="col-md-9" style="display: block;">
            <h2 id="exerName" class="fontWeight300 swlOrange text-center marginBottom3pc">TEST</h2>
            <div id="exerciseHeaders" class="row">

                <form role="form" id="newCardioForm">
                    <div class="col-xs-12 swlOrangeUnderline marginBottom2pc marginTop4pc">DATE &amp; TIME</div>
                    <div class="col-xs-6 marginBottom15px">
                        <input type="text" class="form-control" id="newDate">
                    </div>
                    <div class="col-xs-6 marginBottom15px">
                        <input type="text" class="form-control" id="newTime">
                    </div>

                    <div class="col-xs-12 swlOrangeUnderline marginBottom2pc marginTop4pc">DURATION</div>
                    
                    <div class="col-xs-4 marginBottom15px">
                        <input id="cardioDurationHour" placeholder="hr" type="number" min="0" max="99" class="form-control">
                    </div>

                    <div class="col-xs-4 marginBottom15px">
                        <input id="cardioDurationMinute" placeholder="min" type="number" min="0" max="60" class="form-control">
                    </div>

                    <div class="col-xs-4 marginBottom15px">
                        <input id="cardioDurationSecond" placeholder="sec" type="number" min="0" max="60" class="form-control">
                    </div>

                    <div class="col-xs-12 swlOrangeUnderline marginBottom2pc marginTop4pc">DISTANCE</div>
                    <div class="col-sm-6 col-xs-12">
                        <div class="form-group input-group">
                            <input id="cardioDistance" type="number" min="0" max="99999" step="any" class="form-control">
                            <span class="input-group-addon">mi/km</span>
                        </div>
                    </div>

                    <div class="col-xs-12 swlOrangeUnderline marginBottom2pc marginTop4pc">HEART RATE</div>
                    <div class="col-sm-6 col-xs-12">
                        <div class="form-group input-group">
                            <input id="cardioHeartRate" type="number" min="0" max="999" step="1" class="form-control">
                            <span class="input-group-addon">bpm</span>
                        </div>
                    </div>

                    <div class="col-xs-12 swlOrangeUnderline marginBottom2pc marginTop4pc">CALORIES</div>
                    <div class="col-sm-6 col-xs-12">
                        <div class="form-group input-group">
                            <input id="cardioCalories" type="number" min="0" max="99999" step="any" class="form-control">
                            <span class="input-group-addon">cal</span>
                        </div>
                    </div>

                    <div class="col-xs-12 swlOrangeUnderline marginBottom2pc marginTop4pc">NOTES</div>
                    <div class="col-xs-12">
                        <textarea id="cardioComment" rows="3" class="form-control width100pc maxWidth100pc"></textarea>
                    </div>
                    <button type="submit" class="btn btn-warning btn-circle btn-lg swlOrange fab" onclick="saveNewCardio(2);"><i class="fa fa-check"></i></button>
                </form>
            </div>
        </div>




    </body>


</html>