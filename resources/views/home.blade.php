@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    <!-- Row 1 -->
                    <div class="row">
                        <div class="col-md-2">
                            Informasi Hari Ini
                        </div>
                        <div class="col-md-8">
                        </div>
                        <div class="col-md-2" align="right">
                            Tanggal {{ date('Y-m-d') }}
                            <br>
                            <div align="right">
                                <div id="MyClockDisplay" class="clock" onload="showTime()"></div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="slideshow-container" id="slideshow">
                        <div class="mySlides">
                            <p class="author">{{$info1}}</p>
                        </div>
                        <div class="mySlides">
                            <p class="author">{{$info2}}</p>
                        </div>
                        <div class="mySlides">
                            <p class="author">{{$info3}}</p>
                        </div>
                        <div class="mySlides">
                            <p class="author">{{$info4}}</p>
                        </div>
                        <div class="mySlides">
                            <p class="author">{{$info5}}</p>
                        </div>
                        <div class="mySlides">
                            <p class="author">{{$info6}}</p>
                        </div>
                        <div class="mySlides">
                            <p class="author">{{$info7}}</p>
                        </div>
                        <div class="mySlides">
                            <p class="author">{{$info8}}</p>
                        </div>
                        <div class="mySlides">
                            <p class="author">{{$info9}}</p>
                        </div>
                        <div class="mySlides">
                            <p class="author">{{$info10}}</p>
                        </div>
                        <a class="prev" onclick="plusSlides(-1)">❮</a>
                        <a class="nextt" onclick="plusSlides(1)">❯</a>
                    </div>

                    <div class="dot-container">
                        <span class="dot" onclick="currentSlide(1)"></span>
                        <span class="dot" onclick="currentSlide(2)"></span>
                        <span class="dot" onclick="currentSlide(3)"></span>
                        <span class="dot" onclick="currentSlide(4)"></span>
                        <span class="dot" onclick="currentSlide(5)"></span>
                        <span class="dot" onclick="currentSlide(6)"></span>
                        <span class="dot" onclick="currentSlide(7)"></span>
                        <span class="dot" onclick="currentSlide(8)"></span>
                        <span class="dot" onclick="currentSlide(9)"></span>
                        <span class="dot" onclick="currentSlide(10)"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@push('scripts')
<script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

setInterval(function (){
  currentSlide(slideIndex);
  slideIndex++
  if (slideIndex == 11) {
    slideIndex = 1;
  }
}, 3000);

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}
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
</script>

@endpush