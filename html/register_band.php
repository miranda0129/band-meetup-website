<?php //called if band profile form is filled on registration page
require_once 'login.php';

$connect = new mysqli( $hn, $un, $pw, $db);
if ($connect->connect_error) die($connect->connect_error);

if(isset($_REQUEST['band_email'])   &&
    isset($_REQUEST['band_password'])   &&
    isset($_REQUEST['bname']))
{
    $email = $_REQUEST['band_email'];
    $password = $_REQUEST['band_password'];
    $bname = $_REQUEST['bname'];
    
    //salt and hash password
    $salt1 = "qm&h*";
    $salt2 = "pg!@";
    $token = hash('ripemd128', "$salt1$password$salt2");
   
    //insert user info into database
    $query = "INSERT INTO users VALUES" . "('$email', '$token', 'band')";
    $result = $connect->query($query);
    if(!$result) die($connect->error);
    
    //insert band info into database
    $query = "INSERT INTO bands VALUES" . "('$email', '$bname')";
    $result = $connect->query($query);
    if(!$result) die($connect->error);
    
    header("Location: login.html");
}

$result->close();
$connect->close();
?>