<?php

 $weather ="";
 $error = "";
if(array_key_exists('city', $_GET)){
    $city = str_replace(' ', '-', $_GET['city']);

    $file_headers = @get_headers("http://www.weather-forecast.com/locations/".$city."/forecasts/latest");
    if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
      $error = "That city could not be found";
  }
  else{
    $forecastPage = file_get_contents("http://www.weather-forecast.com/locations/".$city."/forecasts/latest");
    $pageArray = explode('3 Day Weather Forecast Summary:</b><span class="read-more-small"><span class="read-more-content"> <span class="phrase">', $forecastPage);
    if (sizeof ($pageArray) > 1) {
      $secondPageArray = explode('</span></span></span></p>', $pageArray[1]);
  if (sizeof ($secondPageArray) > 1){
      $weather = $secondPageArray[0];
    }else {
      $error = "That city could not be found";
    }
  }
    else {
      $error = "That city could not be found";
    }

}
}
 ?>
 <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
      <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
    <style type="text/css">

  
    body{
      text-align: center;
      background: url(background.jpg) no-repeat center center fixed;
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;
      font-family: Open Sans;
    	font-size: 14px;
    	font-style: normal;
    	font-variant: normal;
    	font-weight: 400;
    	line-height: 20px;
    }
    #name{
      margin-top: 150px;
      font-family: Open Sans;
      color: white;
      background: none;
    }
    h1 {
    	font-family: Open Sans;
    	font-size: 24px;
    	font-style: normal;
    	font-variant: normal;
    	font-weight: 500;
      background: none;
    	line-height: 26.4px;
    }
    #cityLabel{
      color:white;
      margin-bottom: 25px;
      margin-bottom: 25px;
    }
    #textBox{
      margin-top: 60px;
      align-content: center;
      width: 600px;
    }
    #city{
      position: relative;
      margin-left: auto;
      margin-right: auto;
      width: 600px;
    }
    .alert{
      position: relative;
      margin-left: auto;
      margin-right: auto;
      width: 600px;
    }
    .btn-pink{
      background-color: #e91e63;
      color:white;
    }
    #submitButton{
      margin-top: 25px;
    }
    .alert-teal{
      background-color:  #009688;
      color:white;
    }
    .alert-red{
      background-color: #e53935;
      color: white;
    }
    #weather{
      margin-top: 50px;
    }
    </style>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">
  </head>
  <body>
    <h1 id="name">What's the Weather?</h1>
    <div class="container" id="textBox">
      <form id="cityForm">
        <div class="form-group">
    <label for="city" id="cityLabel">Enter your city</label>
    <input type="text" class="form-control" name="city" id="city" placeholder="Example: Madrid" value ="<?php  if( array_key_exists('city', $_GET)){ echo $_GET['city'];}?>">
  </div>
  <div id="weather"><?php
  if($weather){
    echo '<div class="alert alert-teal" role="alert">
  '.$weather.'
</div>';
  } else if($error){
    echo '<div class="alert alert-red" role="alert">
  '.$error.'
</div>';

  }
   ?>
  </div>
  <button type="submit" class="btn btn-pink btn-lg" id="submitButton">Submit</button>
      </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
  </body>
</html>
