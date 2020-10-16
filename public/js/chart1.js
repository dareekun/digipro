//initialize
var y = document.getElementById('data').rows[1].cells.length - 2;
var array1 = Array();
var array2 = Array();
var pie = Array();
var bagi = Array();

for (x = 0; x < y; x++) {
    array1[x] = document.getElementsByClassName("dataactual")[x].innerHTML;
}

for (x = 0; x < y; x++) {
    array2[x] = document.getElementsByClassName("dataplan")[x].innerHTML;
}

pie[0] = document.getElementsByClassName("total")[0].innerHTML;
pie[1] = document.getElementsByClassName("total")[1].innerHTML;

bagi[0] = (pie[1] / pie[0]) * 100 ;
bagi[1] = 100 - bagi[0] ;

var ctx1 = document.getElementById('chart1').getContext('2d');
var ctx2 = document.getElementById('chart2').getContext('2d');
// chart 1
var myChart = new Chart(ctx1, {
    type: 'pie',
    data: {
        labels: ['Actual', 'Plan'],
        datasets: [{
            data: bagi,
            backgroundColor: [
                'rgba(170, 0, 255, 0.2)',
                'rgba(0, 204, 0, 0.2)',
            ],
            borderColor: [
                'rgba(170, 0, 255, 1)',
                'rgba(0, 204, 0, 1)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        legend: {
            display: false,
        }
    }
});
// chart 2

var myChart = new Chart(ctx2, {
    type: 'bar',
    data: {
        labels: ['Assy WD', 'Compression', 'Injection', 'Metal Part', 'Export'],
        datasets: [{
            data: array1,
            backgroundColor: [
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(75, 192, 192, 0.2)',
            ],
            borderColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(75, 192, 192, 1)',
            ],
            borderWidth: 1
        }, {
            data: array2,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        legend: {
            display: false,
        },
            scales: { 
                yAxes: [{ ticks: { beginAtZero: true } }] }
    }
});