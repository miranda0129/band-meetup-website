<?php
require_once 'login.php';

$connect = new mysqli( $hn, $un, $pw,$db);
if($connect->connect_error) die($connect->connect_error);

$string;
//if value is not empty add query to string
if($_REQUEST['instrument'] != ""){
$string .= "instrument='" .$_REQUEST['instrument'] ."'&&"; 
}

if($_REQUEST['genre'] != ""){
$string .= "genre='" .$_REQUEST['genre'] ."'&&"; 
}

if($_REQUEST['city'] != ""){
$string .= "city='" .$_REQUEST['city'] ."'&&"; 
}

if($_REQUEST['time'] == "one_time"){
$string .= "one_time=1"; 
}

if($_REQUEST['time'] == "full_time"){
$string .= "full_time=1";
}
//query musician table to select * musicians where critera meet
$query = "SELECT * FROM musicians WHERE $string";
$result = $connect->query($query);
if(!$result) die($connect->error);
$rows = $result->num_rows;

//open and write to json file
$file = fopen("../js/search_results.json", "w") or die("Unable to open file");
$txt = '[';
for($j = 0; $j < $rows; ++$j){
    $result->data_seek($j);
    $txt.= ' {"email" : " '. $result->fetch_assoc()['email'] . ' ", ';
    $result->data_seek($j);
    $txt .= ' "username" :  " '. $result->fetch_assoc()['username'] . ' ", ';
    $result->data_seek($j);
    $txt .= ' "instrument" : " '. $result->fetch_assoc()['instrument'] . ' ", ';
    $result->data_seek($j);
    $txt .= ' "genre" : " '. $result->fetch_assoc()['genre'] . ' ", ';
    $result->data_seek($j);
    $txt .= ' "city" : " '. $result->fetch_assoc()['city'] . ' ", ';
    $result->data_seek($j);
    $txt .= ' "band" : " '. $result->fetch_assoc()['band'] . ' ", ';
    $result->data_seek($j);
    $txt .= ' "one_time" : '. $result->fetch_assoc()['one_time'] . ',';
    $result->data_seek($j);
    $txt .= ' "full_time" : ' . $result->fetch_assoc()['full_time'] . '}';
    
    if ($j < $rows-1) $txt.= ',';
}
$txt .= ']';
fwrite($file, $txt);
fclose($file);
$result->close();
$connect->close();
header("Location: search_results.html");
?>