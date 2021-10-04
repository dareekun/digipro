var ctx1 = document.getElementById('chart1').getContext('2d');
// chart 1

// Array
var y = document.getElementById('data').rows[0].cells.length - 1;
var array0 = Array();
var array1 = Array();
var array2 = Array();
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
// chart 2
var chart1 = new Chart(ctx1, {
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
        responsive: true,
        maintainAspectRatio: false,
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