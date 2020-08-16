<?php
session_start();
if(isset($_SESSION['email']))//check if logged in
{
    $email = $_SESSION['email'];
    $password = $_SESSION['password'];
    
    if($_SESSION['type'] == 'musician'){
        $username = $_SESSION['username'];
        $instrument = $_SESSION['instrument'];
        $city = $_SESSION['city'];
        $genre = $_SESSION['genre'];
        $band = $_SESSION['band'];
        $one_time = $_SESSION['one_time'];
        $full_time = $_SESSION['full_time'];
    }
    
    if($_SESSION['type'] == 'band'){
        $band = $_SESSION['band'];
    }
}
else//not logged in
{
    header("Location: login.html");
}

function destory_session_and_data()
{
    setcookie(session_name(), "", time()-1, '/');
    session_destroy();
}
?>