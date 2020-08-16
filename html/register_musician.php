<?php //called if musician form is filled out on registeration
require_once 'login.php';

$connect = new mysqli( $hn, $un, $pw, $db);
if ($connect->connect_error) die($connect->connect_error);

if(isset($_REQUEST['musician_email'])   &&
    isset($_REQUEST['uname'])   &&
    isset($_REQUEST['instrument'])   &&
    isset($_REQUEST['city'])   &&
    isset($_REQUEST['genre']))
{
    //get form values
    $email = $_REQUEST['musician_email'];
    $password = $_REQUEST['musician_password'];
    $uname = $_REQUEST['uname'];
    $instrument = $_REQUEST['instrument'];
    $city = $_REQUEST['city'];
    $genre =  $_REQUEST['genre'];
    
    $one_time = 0;
    if($_REQUEST['one_time'] == "one_time"){
    $one_time = 1;
    }
    $full_time = 0;
     if($_REQUEST['full_time'] == "full_time"){
    $full_time = 1;
    }

    //salt and hash passwords
    $salt1 = "qm&h*";
    $salt2 = "pg!@";
    $token = hash('ripemd128', "$salt1$password$salt2");
    
    //insert user into database
    $query = "INSERT INTO users VALUES" . "('$email', '$token', 'musician')";
    $result = $connect->query($query);
    if(!$result) die($connect->error);
    
    //insert musician into database
    $query = "INSERT INTO musicians VALUES" . "('$email', '$uname', '$instrument', '$genre', '$city', NULL, $one_time, $full_time)";
    $result = $connect->query($query);
    if(!$result) die($connect->error);
    
    header("Location: login.html");
}
$result->close();
$connect->close();
?>