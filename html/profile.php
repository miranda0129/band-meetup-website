<?php
include 'continue.php';
if($_SESSION['type'] == 'musician'){
    header("Location: musician_profile.php");
}
elseif($_SESSION['type'] == 'band'){
    header("Location: band_profile.php");
}
else{
    header("Location: login.html");
}
?>