//untuk linesetup.blade.php
function pass() {
    var x = document.forms["check"]["lokasi"].value;
    var y = document.forms["check"]["tipe"].value;
    var w = document.forms["check"]["qtyinner"].value;
    var z = document.forms["check"]["qtyouter"].value;
        document.getElementById("rslttipe").style.color = "#000000";
        document.getElementById("rsltshift").style.color = "#000000";
        document.getElementById("rsltpic").style.color = "#000000";
        document.getElementById("rslttanggal").style.color = "#000000";
        document.getElementById("rslttanggal").innerHTML = $("#lokasi").val();
        document.getElementById("rsltpic").innerHTML = $("#tipe").val();
        document.getElementById("rsltshift").innerHTML = $("#qtyinner").val();
        document.getElementById("rslttipe").innerHTML = $("#qtyouter").val();
    if (x.length == 0) {
        document.getElementById("rslttanggal").style.color = "#ff0000";
        document.getElementById("rslttanggal").innerHTML = "Error! Form Belum Terisi";
        document.getElementById("linesubmit").disabled = true;
    }
    if (y.length == 0) {
        document.getElementById("rsltpic").style.color = "#ff0000";
        document.getElementById("rsltpic").innerHTML = "Error! Form Belum Terisi";
        document.getElementById("linesubmit").disabled = true;
    }
    if (w.length == 0) {
        document.getElementById("rsltshift").style.color = "#ff0000";
        document.getElementById("rsltshift").innerHTML = "Error! Form Belum Terisi";
        document.getElementById("linesubmit").disabled = true;
    }
    if (z.length == 0) {
        document.getElementById("rslttipe").style.color = "#ff0000";
        document.getElementById("rslttipe").innerHTML = "Error! Form Belum Terisi";
        document.getElementById("linesubmit").disabled = true;
    } else {
        document.getElementById("rslttipe").style.color = "#000000";
        document.getElementById("rsltshift").style.color = "#000000";
        document.getElementById("rsltpic").style.color = "#000000";
        document.getElementById("rslttanggal").style.color = "#000000";
        document.getElementById("rslttanggal").innerHTML = $("#lokasi").val();
        document.getElementById("rsltpic").innerHTML = $("#tipe").val();
        document.getElementById("rsltshift").innerHTML = $("#qtyinner").val();
        document.getElementById("rslttipe").innerHTML = $("#qtyouter").val();
        document.getElementById("linesubmit").disabled = false;
    }
}
// untuk inputharian.blade.php
function oper() {
    var a = document.getElementById("tanggal").value;
    var b = document.getElementById("pic").value;
    var c = document.getElementById("tipe").value;
    var d = document.getElementById("shift").value;
    var e = document.getElementById("hasil").value;

        document.getElementById("rslthasil").style.color = "#000000";
        document.getElementById("rslttipe").style.color = "#000000";
        document.getElementById("rsltshift").style.color = "#000000";
        document.getElementById("rsltpic").style.color = "#000000";
        document.getElementById("rslttanggal").style.color = "#000000";
        document.getElementById("rslttanggal").innerHTML = $("#tanggal").val();
        document.getElementById("rsltpic").innerHTML = $("#pic").val();
        document.getElementById("rsltshift").innerHTML = $("#shift").val();
        document.getElementById("rslttipe").innerHTML = $("#tipe").val();
        document.getElementById("rslthasil").innerHTML = $("#hasil").val();
    if (a.length == 0) {
        document.getElementById("rslttanggal").style.color = "#ff0000";
        document.getElementById("rslttanggal").innerHTML = "Error! Form Belum Terisi";
        document.getElementById("submit").disabled = true;
    }
    if (b.length == 0) {
        document.getElementById("rsltpic").style.color = "#ff0000";
        document.getElementById("rsltpic").innerHTML = "Error! Form Belum Terisi";
        document.getElementById("submit").disabled = true;
    }
    if (c.length == 0) {
        document.getElementById("rsltshift").style.color = "#ff0000";
        document.getElementById("rsltshift").innerHTML = "Error! Form Belum Terisi";
        document.getElementById("submit").disabled = true;
    }
    if (d.length == 0) {
        document.getElementById("rslttipe").style.color = "#ff0000";
        document.getElementById("rslttipe").innerHTML = "Error! Form Belum Terisi";
        document.getElementById("submit").disabled = true;
    }
    if (e.length == 0) {
        document.getElementById("rslthasil").style.color = "#ff0000";
        document.getElementById("rslthasil").innerHTML = "Error! Form Belum Terisi";
        document.getElementById("submit").disabled = true;
    } else {
        document.getElementById("rslthasil").style.color = "#000000";
        document.getElementById("rslttipe").style.color = "#000000";
        document.getElementById("rsltshift").style.color = "#000000";
        document.getElementById("rsltpic").style.color = "#000000";
        document.getElementById("rslttanggal").style.color = "#000000";
        document.getElementById("rslttanggal").innerHTML = $("#tanggal").val();
        document.getElementById("rsltpic").innerHTML = $("#pic").val();
        document.getElementById("rsltshift").innerHTML = $("#shift").val();
        document.getElementById("rslttipe").innerHTML = $("#tipe").val();
        document.getElementById("rslthasil").innerHTML = $("#hasil").val();
        document.getElementById("submit").disabled = false;
    }
}