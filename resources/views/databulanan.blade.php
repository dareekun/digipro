<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap.min.css') }}">
        <script type="text/javascript" src="{{ asset('/js/jquery.js') }}"></script> 
        <script type="text/javascript" src="{{ asset('/js/chart.js') }}"></script> 
        <title>Input Produksi</title>
    </head>
    <body>
    <!-- Nav Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="/">Line 1</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link" href="/">Rekap Data</a>
      <a class="nav-item nav-link" href="total">Total Data</a>
      <a class="nav-item nav-link" href="harian">Input Harian</a>
      <a class="nav-item nav-link active" href="bulanan">Data Bulanan</a>
      <a class="nav-item nav-link" href="setup">Setup</a>
    </div>
  </div>
</nav>
<div class="container-md">
<!-- row chart 1 -->
<div class="row">
<!-- chart 2 -->
<div class="col-sm">
<br>
<canvas id="chart2" height="90%"></canvas>
</div>
</div>
<!-- row chart 2 -->
<br>
<div class="row">
<!-- chart 4 -->
<div class="col-sm-8">
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Test</th>
      <th scope="col">Plan</th>
      <th scope="col">Actual</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">Bisnis Plan</th>
      <td>200</td>
      <td>100</td>
    </tr>
    <tr>
      <th scope="row">Target Produksi</th>
      <td>200</td>
      <td>100</td>
    </tr>
    <tr>
      <th scope="row">Total Produksi</th>
      <td>320</td>
      <td>140</td>
    </tr>
  </tbody>
</table>
</div>
<div class="col-sm-4">
<canvas id="chart1"></canvas>
</div>
</div>
</div>
<script type="text/javascript" src="{{ asset('/js/chart1.js') }}"></script> 
    </body>
</html>
