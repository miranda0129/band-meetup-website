<?php
require_once 'login.php';
include 'continue.php';

$connect = new mysqli( $hn, $un, $pw,$db);
if($connect->connect_error) die($connect->connect_error);

//get band name and time for ads table
$band = $_SESSION['band'];
$timestamp = date("Y-m-d");
//start query string
$string = "INSERT INTO ads VALUES (NULL ,'$band', CURRENT_TIMESTAMP()";

//if value != empty add value else ad NULL
if($_REQUEST['instrument'] != ""){
    $instrument = $_REQUEST['instrument'];
    $string .= ", '$instrument'";
}
else $string .= ", NULL";

if($_REQUEST['genre'] != ""){
    $genre = $_REQUEST['genre'];
    $string .= ", '$genre'";
}
else $string .= ", NULL";

if($_REQUEST['city'] != ""){
    $city = $_REQUEST['city'];
    $string .= ", '$city'";
}
else $string .= ", NULL";

//one time XOR full_time is required
if(isset($REQUEST['time']) == "one_time"){
    $one_time = 1;
    $string .= ", 1, 0";
}
elseif(isset($_REQUEST['time']) == "full_time"){
    $full_time = 1;
    $string .= ", 0, 1";
}
if($_REQUEST['message'] != ""){
   $message = $_REQUEST['message'];
    $string .= ", '$message')";
}
else $string .= ", NULL)";

//insert into database and redirect to profile
$query = $string;
$result = $connect->query($query);
if(!$result) die($connect->error);
header("Location: band_profile.php");
?>