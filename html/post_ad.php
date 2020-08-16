<?php
require_once 'login.php';
include 'continue.php';

$connect = new mysqli( $hn, $un, $pw,$db);
if($connect->connect_error) die($connect->connect_error);

$band = $_SESSION['band'];
$timestamp = date("Y-m-d");
$string = "INSERT INTO ads VALUES (NULL ,'$band', CURRENT_TIMESTAMP()";

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


$query = $string;
$result = $connect->query($query);
if(!$result) die($connect->error);
header("Location: band_profile.php");
?>