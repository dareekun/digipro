var ctx1 = document.getElementById('Chart1').getContext('2d');
Chart.register(ChartDataLabels);
// chart 1

function getRandomColor() {
    var letters = '23456789ABC';
    var color = '#';
    for (var i = 0; i < 6; i++) {
      color += letters[Math.floor(Math.random() * 11)];
    }
    return color;
  }

// Array
var y = document.getElementById('data').rows[0].cells.length - 1;
var array0 = Array();
var array1 = Array();
var bgColor  = Array();
var brColor  = Array();

for (x = 0; x < y; x++) {
    array0[x] = document.getElementsByClassName("namalini")[x].innerHTML;
}
for (x = 0; x < y; x++) {
    array1[x] = document.getElementsByClassName("dataactual")[x].innerHTML;
}
for (x = 0; x < y; x++) {
    color = getRandomColor();
    bgColor[x] = color + '99';
    brColor[x] = color; 
    console.log(bgColor);
    console.log(brColor);
}
function myFunc(total, num) {
    return total + num;
}
// chart 
var Chart = new Chart(ctx1, {
    type: 'bar',
    data: {
        labels: array0,
        datasets: [{
            label: 'Actual',
            data: array1,
            backgroundColor: bgColor,
            borderColor: brColor,
            borderWidth : 3,
            borderRadius : 5
        }]
    },
    options: {
    plugins: {
        datalabels: {
            anchor: 'end',
            align: 'end',
            backgroundColor: '#373843',
            borderRadius: 1,
            color: 'white',
            font: {
              weight: 'bold',
              size : 14
            },
            formatter: Math.round,
            padding: 6
          }
    },
    responsive: true,
    maintainAspectRatio: false,
    legend: {
       display: false
    },
    tooltips: {
       enabled: false
    }
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