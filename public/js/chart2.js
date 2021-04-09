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

$(document).ready(function() {
    refreshAt(07, 00, 05);
    refreshAt(16, 15, 05);
    refreshAt(00, 25, 05);
})

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
            label: 'Actual',
            data: array1,
            backgroundColor: ["#8e5ea2", "#8e5ea2","#8e5ea2","#8e5ea2","#8e5ea2","#8e5ea2","#8e5ea2","#8e5ea2"],
        }, {
            label: 'Plan',
            data: array2,
            type: 'bar',
            backgroundColor: ["#3e95cd", "#3e95cd","#3e95cd","#3e95cd","#3e95cd","#3e95cd","#3e95cd","#3e95cd"],
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

function refreshAt(hours, minutes, seconds) {
    var now = new Date();
    var then = new Date();
    if (now.getHours() > hours ||
        (now.getHours() == hours && now.getMinutes() > minutes) ||
        now.getHours() == hours && now.getMinutes() == minutes && now.getSeconds() >= seconds) {
        then.setDate(now.getDate() + 1);
    }
    then.setHours(hours);
    then.setMinutes(minutes);
    then.setSeconds(seconds);
    var timeout = (then.getTime() - now.getTime());
    setTimeout(function() {
        window.location.reload(true);
    }, timeout);
}