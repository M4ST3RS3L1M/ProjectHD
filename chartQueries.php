<?php

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