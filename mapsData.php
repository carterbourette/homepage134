<?php
  // set HTTP header
  $headers = array('Content-Type: application/json',);

  // Important addresses
  $home   = array(43.519543, -80.228988);
  $school = array(43.5301401, -80.22631060000001);

  $curLat = $_GET['curLat'];
  $curLong = $_GET['curLong'];
  $travelMode = $_GET['travelMode'];
  $distanceToHome = $_GET['distanceToHome'];
  // $distanceToHome = sqrt(($curLat - $home[0])*($curLat - $home[0]) + ($curLong - $home[1])*($curLong - $home[1]));
  // echo("distance: " . $distanceToHome);

  // If we're close enough to home, take us from home to school
  if ($distanceToHome < 0.001) {
    $origin = $home[0] . "," . $home[1];
    $destination = $school[0] . "," . $school[1];
  // Otherwise, we want our current location to home
  } else {
    $origin = $curLat . "," . $curLong;
    $destination = $home[0] . "," . $home[1];
  }

  // $url = "https://maps.googleapis.com/maps/api/directions/json?origin=" . $origin . "&destination=" . $destination . "&avoid=highways&mode=transit&key=AIzaSyAuZODWQu06M9hC-sGrhazBKCrLIIj9fzI";
  // $url = "https://maps.googleapis.com/maps/api/directions/json?origin=" . $origin . "&destination=" . $destination . "&avoid=highways&mode=" . $travelMode . "&key=AIzaSyAuZODWQu06M9hC-sGrhazBKCrLIIj9fzI";
  $url = "https://maps.googleapis.com/maps/api/directions/json?origin=" . $origin . "&destination=" . $destination . "&mode=" . $travelMode . "&key=AIzaSyAuZODWQu06M9hC-sGrhazBKCrLIIj9fzI";

  // Open connection
  $ch = curl_init();

  // Set the url, number of GET vars, GET data
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, false);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

  // Execute request
  $result = curl_exec($ch);

  // Close connection
  curl_close($ch);

  // get the result and parse to JSON
  echo(json_encode(json_decode($result, true)));
?>
