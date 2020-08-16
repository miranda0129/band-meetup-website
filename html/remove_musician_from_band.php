<?php
require_once 'login.php';
include 'continue.php';

$connect = new mysqli( $hn, $un, $pw,$db);
if($connect->connect_error) die($connect->connect_error);

//get email from form and update musician at band to NULL 
$musician_email = $_REQUEST['email'];
$query = 'UPDATE musicians SET band=NULL WHERE email="' . $musician_email . '"';

$result = $connect->query($query);
if(!$result) die($connect->error);

header("Location: band_profile.php")
?>