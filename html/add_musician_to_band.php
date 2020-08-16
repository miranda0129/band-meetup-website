<?php
require_once 'login.php';
include 'continue.php';

$connect = new mysqli( $hn, $un, $pw,$db);
if($connect->connect_error) die($connect->connect_error);

//get email from form and query musician table to update band column
$musician_email = $_REQUEST['email'];
$query = 'UPDATE musicians SET band="' . $_SESSION['band'] .'" WHERE email="' . $musician_email . '"';

$result = $connect->query($query);
if(!$result) die($connect->error);
//redirect back to profile
header("Location: band_profile.php");
?>