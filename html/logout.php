<?php
//end session and return to index
include 'continue.php';
destory_session_and_data();
header("Location: index.html");
?>