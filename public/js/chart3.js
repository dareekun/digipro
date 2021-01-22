var ctx1 = document.getElementById('chart1').getContext('2d');
// chart 1

// Array
var y = document.getElementById('bulanan').rows[0].cells.length - 1;
var array0 = Array();
var array1 = Array();
var array2 = Array();
var array3 = Array();
var pie = Array();
var bagi = Array();

for (x = 0; x < y; x++) {
    array0[x] = document.getElementsByClassName("tanggal")[x].innerHTML;
}

for (x = 0; x < y; x++) {
    array1[x] = document.getElementsByClassName("dataactual")[x].innerHTML;
}

for (x = 0; x < y; x++) {
    array2[x] = Math.abs(document.getElementsByClassName("dataplan")[x].innerHTML);
}

function myFunc(total, num) {
    return total + num;
}

var totalplan = array2.reduce(myFunc);

for (x = 0; x < y; x++) {
    array3[x] = totalplan;
}

// Chart 1
var chart1 = new Chart(ctx1, {
    data: {
        labels: array0,
        datasets: [{
            type: 'bar',
            data: array1,
            backgroundColor: 'rgba(57, 178, 200, 0.7)',
            borderColor: 'rgba(57, 178, 200, 1)',
        }, {
            data: array2,
            type: 'line',
            borderColor: [
                'rgba(75, 192, 45, 1)',
            ],
            backgroundColor: [
                'rgba(54, 162, 235, 0)',
            ]
        }, {
            data: array3,
            type: 'line',
            borderColor: [
                'rgba(255, 192, 36, 1)',
            ],
            backgroundColor: [
                'rgba(54, 162, 235, 0)',
            ],
            lineTension:0,
            options: {
                legend : {
                    display: false,
                    },
                    scales: {
                        xAxes: [{
                            stacked: true,
                        }],
                        yAxes: [{
                            stacked: true
                        }]}
            }
        }]
    },
    options: {
        legend : {
            display: false,
            },
            scales: {
                xAxes: [{
                    stacked: true,
                }],
                yAxes: [{
                    stacked: false
                }]}
    }
});