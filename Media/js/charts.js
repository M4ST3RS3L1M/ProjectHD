let stepsChart = document.getElementById("steps-chart").getContext("2d");

let = stepLabels [Utils.days({count: 15})]; 
let = stepData ["filler"];
let = stepColors ["filler"];

let stepsChart1 = new Chart(stepsChart, {
    type: "line",
    data: {
        labels: stepLabels,
        datasets: [ {
            data: stepData,
            fill: false,
            backgroundColor: stepColors,
            tension: 0.1
        }]
    },
    options: {
        title: {
            text: "Steps walked per day",
            display: true
        }
    }
});

/* Example Query
SELECT hd.amount, hd.date
FROM HD_HealthData hd
JOIN HD_HealthType ht ON hd.healthTypeID = ht.healthTypeID
WHERE hd.userID='26' AND ht.healthType='steps'
*/
