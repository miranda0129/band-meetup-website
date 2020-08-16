<?php
require_once 'login.php';

$connect = new mysqli( $hn, $un, $pw,$db);
if($connect->connect_error) die($connect->connect_error);

if($_SESSION['type'] == 'musician'){
    $str;
    $str .= '(instrument ="' .$_SESSION['instrument'] . '" || instrument IS NULL) &&';
    $str .= '(genre ="' .$_SESSION['genre'] . '" || genre IS NULL) &&';
    $str .= '(city ="' .$_SESSION['city'] . '" || city IS NULL) &&';
    $str .= '(one_time =' .$_SESSION['one_time'] . ' || full_time =' .$_SESSION['full_time'] . ')';
    $query = "SELECT * FROM ads WHERE " . $str;
}

if($_SESSION['type'] == 'band'){
    $query = 'SELECT * FROM ads WHERE band ="' . $_SESSION['band'] . '"';
}

$result = $connect->query($query);
if(!$result) die($connect->error);
$rows = $result->num_rows;

$file = fopen("../js/ad_list.json", "w") or die("Unable to open file");
$txt = '[';
for($j = 0; $j < $rows; ++$j){
    $result->data_seek($j);
    $band = $result->fetch_assoc()['band'];
    $txt .= '{ "band" : "'. $band . '", ';
    $result->data_seek($j);
    $txt .= ' "instrument" : "'. $result->fetch_assoc()['instrument'] . '", ';
    $result->data_seek($j);
    $txt .= ' "genre" : "'. $result->fetch_assoc()['genre'] . '", ';
    $result->data_seek($j);
    $txt .= ' "city" : "'. $result->fetch_assoc()['city'] . '", ';
    $result->data_seek($j);
    $txt .= ' "one_time" : '. $result->fetch_assoc()['one_time'] . ',';
    $result->data_seek($j);
    $txt .= ' "full_time" : ' . $result->fetch_assoc()['full_time'] . ',';
    $result->data_seek($j);
    $txt .= ' "message" :"' . $result->fetch_assoc()['message'] . '",';
    
    $query_email = 'SELECT * FROM bands WHERE band_name ="' . $band . '"';
    $result_email = $connect->query($query_email);
    if(!$result_email) die($connect->error);
    $result_email->data_seek(0);
    $txt .= ' "email" :"' . $result_email->fetch_assoc()['email'] . '"}';
    $result_email->close();

    if ($j < $rows-1) $txt.= ',';
}
$txt .= ']';
fwrite($file, $txt);
fclose($file);
$result->close();
$connect->close();
?>