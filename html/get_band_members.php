<?php
require_once 'login.php';

$connect = new mysqli( $hn, $un, $pw,$db);
if($connect->connect_error) die($connect->connect_error);

$query = 'SELECT * FROM musicians WHERE band="' . $_SESSION['band'] . '"';

$result = $connect->query($query);
if(!$result) die($connect->error);
$rows = $result->num_rows;

$file = fopen("../js/band_members.json", "w") or die("Unable to open file");
$txt = '[';
for($j = 0; $j < $rows; ++$j){
    $result->data_seek($j);
    $txt .= '{ "username" :"' . $result->fetch_assoc()['username'] . '"}';
    if ($j < $rows-1) $txt.= ',';
}
$txt .= ']';
fwrite($file, $txt);
fclose($file);
$result->close();
$connect->close();
?>

