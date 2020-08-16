<?php
require_once 'login.php';
include 'continue.php';

$connect = new mysqli( $hn, $un, $pw,$db);
if($connect->connect_error) die($connect->connect_error);

//if value is not empty update table & session vairiable 
if($_REQUEST['instrument'] != ""){
$query = 'UPDATE musicians SET instrument = "' . $_REQUEST['instrument'] . '" WHERE email="' . $_SESSION['email'] . '"';
$result = $connect->query($query);
if(!$result) die($connect->error);
$_SESSION['instrument'] = $_REQUEST['instrument'];
}

if($_REQUEST['genre'] != ""){
$query = 'UPDATE musicians SET genre = "' . $_REQUEST['genre'] . '" WHERE email="' . $_SESSION['email'] . '"';
$result = $connect->query($query);
if(!$result) die($connect->error);
$_SESSION['genre'] = $_REQUEST['genre'];
}

if($_REQUEST['city'] != ""){
$query = 'UPDATE musicians SET city = "' . $_REQUEST['city'] . '" WHERE email="' . $_SESSION['email'] . '"';
echo $query . "<br>";
$result = $connect->query($query);
if(!$result) die($connect->error);
$_SESSION['city'] = $_REQUEST['city'];
}

header("Location: musician_profile.php");
?>