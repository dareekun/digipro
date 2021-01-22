var ctx1 = document.getElementById('chart1').getContext('2d');
var ctx2 = document.getElementById('chart2').getContext('2d');
// chart 1

// Array
var y = document.getElementById('data').rows[0].cells.length - 1;
var array0 = Array();
var array1 = Array();
var array2 = Array();
var pie = Array();
var bagi = Array();

for (x = 0; x < y; x++) {
    array0[x] = document.getElementsByClassName("namalini")[x].innerHTML;
}

for (x = 0; x < y; x++) {
    array1[x] = document.getElementsByClassName("dataactual")[x].innerHTML;
}

for (x = 0; x < y; x++) {
    array2[x] = document.getElementsByClassName("dataplan")[x].innerHTML;
}

function myFunc(total, num) {
    return total + num;
}

document.getElementsByClassName("totala").innerHTML = array1.reduce(myFunc);
document.getElementsByClassName("totalp").innerHTML = array2.reduce(myFunc);

pie[0] = document.getElementsByClassName("totala")[0].innerHTML;
pie[1] = document.getElementsByClassName("totalp")[0].innerHTML;

bagi[0] = (pie[1] / pie[0]) * 100 ;
bagi[1] = Math.abs(100 - bagi[0]) ;

var chart1 = new Chart(ctx1, {
    type: 'pie',
    data: {
        labels: ['Percentage', ],
        datasets: [{
            data: bagi,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
            ],
            borderWidth: 1
        }]
    },
    options: {}
});
// chart 2
var chart2 = new Chart(ctx2, {
    type: 'bar',
    data: {
        labels: array0,
        datasets: [{
            data: array1,
            backgroundColor: [
                'rgba(54, 162, 235, 0.7)',
                'rgba(255, 206, 86, 0.7)',
                'rgba(75, 192, 192, 0.7)',
                'rgba(153, 102, 255, 0.7)',
                'rgba(255, 99, 132, 0.7)',
                'rgba(255, 64, 64, 0.7)',
                'rgba(159, 255, 64, 0.7)',
                'rgba(255, 159, 164, 0.7)',
                'rgba(64, 159, 64, 0.7)',
                'rgba(255, 59, 164, 0.7)',
            ],
            borderColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 64, 64, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(159, 255, 64, 1)',
                'rgba(255, 159, 164, 1)',
                'rgba(64, 159, 64, 1)',
                'rgba(255, 59, 164, 1)',
            ]
        }, {
            data: array2,
            type: 'line',
            borderColor: [
                'rgba(75, 192, 192, 1)',
            ],
            backgroundColor: [
                'rgba(54, 162, 235, 0)',
            ]
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
                    stacked: true
                }]}
    }
});