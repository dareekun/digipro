function showTime() {
    var date = new Date();
    var h = date.getHours(); // 0 - 23
    var m = date.getMinutes(); // 0 - 59
    var s = date.getSeconds(); // 0 - 59

    h = (h < 10) ? "0" + h : h;
    m = (m < 10) ? "0" + m : m;
    s = (s < 10) ? "0" + s : s;

    var time = h + ":" + m + ":" + s;
    document.getElementById("MyClockDisplay").innerText = time;
    document.getElementById("MyClockDisplay").textContent = time;
    setTimeout(showTime, 1000);
}
showTime();

function del1() {
    document.getElementById("masuk").submit();
}
function del2() {
    document.getElementById("masuk").submit();
}
function del3() {
    document.getElementById("masuk").submit();
}
function del4() {
    document.getElementById("masuk").submit();
}
function del5() {
    document.getElementById("masuk").submit();
}

function data1() {  
    var a1 = document.forms["masuk"]["regprob0"].value;
    var a2 = document.forms["masuk"]["regstart0"].value;
    var a3 = document.forms["masuk"]["regfinish0"].value;
    var a4 = document.forms["masuk"]["regdur0"].value;
    var a6 = document.forms["masuk"]["regket0"].value;
    if (a1 != "Tidak Ada Masalah" && (a2 == "" || a3 == "" || a4 == "" || a6 == "" )) {
        alert("Mohon Lengkapi Form");
        event.preventDefault()
        return false;
    }
    else {
        document.getElementById("masuk").submit();
    }
    
}
function data2() {  
    var a1 = document.forms["masuk"]["wrkprob0"].value;
    var a2 = document.forms["masuk"]["wrkstart0"].value;
    var a3 = document.forms["masuk"]["wrkfinish0"].value;
    var a4 = document.forms["masuk"]["wrkdur0"].value;
    var a5 = document.forms["masuk"]["wrkprod0"].value;
    var a6 = document.forms["masuk"]["wrkket0"].value;
    if (a1 != "Tidak Ada Masalah" && (a2 == "" || a3 == "" || a4 == "" || a6 == "" )) {
        alert("Mohon Lengkapi Form");
        event.preventDefault()
        return false;
    }
    else {
        document.getElementById("masuk").submit();
    }
    
}
function data3() {  
    var a1 = document.forms["masuk"]["orprob0"].value;
    var a2 = document.forms["masuk"]["orstart0"].value;
    var a3 = document.forms["masuk"]["orfinish0"].value;
    var a4 = document.forms["masuk"]["ordur0"].value;
    var a6 = document.forms["masuk"]["orket0"].value;
    if (a1 != "Tidak Ada Masalah" && (a2 == "" || a3 == "" || a4 == "" || a6 == "" )) {
        alert("Mohon Lengkapi Form");
        event.preventDefault()
        return false;
    }
    else {
        document.getElementById("masuk").submit();
    }
    
}
function data4() {  
    var a1 = document.forms["masuk"]["defprob0"].value;
    var a2 = document.forms["masuk"]["defstart0"].value;
    var a3 = document.forms["masuk"]["deffinish0"].value;
    var a4 = document.forms["masuk"]["defdur0"].value;
    var a6 = document.forms["masuk"]["defket"].value;
    if (a1 != "Tidak Ada Masalah" && (a2 == "" || a3 == "" || a4 == "" || a6 == "" )) {
        alert("Mohon Lengkapi Form");
        event.preventDefault()
        return false;
    }
    else {
        document.getElementById("masuk").submit();
    }
    
}
function data5() {  
    var b1 = document.forms["masuk"]["reslt1"].value;
    var b2 = document.forms["masuk"]["reslt2"].value;
    var b3 = document.forms["masuk"]["reslt3"].value;
    var b4 = document.forms["masuk"]["reslt4"].value;
    var b5 = document.forms["masuk"]["reslt5"].value;
    var b6 = document.forms["masuk"]["reslt6"].value;
    var b7 = document.forms["masuk"]["reslt7"].value;
    var b8 = document.forms["masuk"]["reslt8"].value;
    var b9 = document.forms["masuk"]["reslt9"].value;
    if (b1 == "" || b2 == "" || b3 == "" || b4 == "" || b5 == "" || b6 == "" ||
    b7 == "" || b8 == "" || b9 == "") 
    {
        alert("Mohon Lengkapi Form");
        event.preventDefault()
        return false;
    }
    else {
        document.getElementById("masuk").submit();
    }
    
}
