<?php
require_once 'login.php';

$connect = new mysqli( $hn, $un, $pw,$db);
if($connect->connect_error) die($connect->connect_error);
if(!$_REQUEST['category']){
    $category = 'instrument';
}
else {
    $category = $_REQUEST['category'];
}
$query = "SELECT " . $category . ", COUNT(*) as number from musicians GROUP BY " . $category;
$result = $connect->query($query);
if(!$result) die($connect->error);

?>
<html> 
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link href='https://fonts.googleapis.com/css?family=Recursive' rel='stylesheet'>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/js.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript"> google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            <?php
                echo "['" . $category ."' , 'Count']";
                while($row = mysqli_fetch_array($result))  
                {  
                echo ",['".$row[$category]."', ".$row["number"]."]";  
                }  
            ?>
        ]);
        var options = {
            title: 'Musicians data',
            is3D: true,
            chartArea:{width:'50%',height:'75%', stroke: 'gray', strokeWidth: '5'},
            legend:{position: 'bottom'}
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options); 
    }
    </script>
</head> 
<body>
<div class="container-fluid d-flex dark-background account-management">
    <div class="d-block"><a class="nav-link" href="index.html">Home</a></div>
    <div class="d-block"><a class="nav-link" href="advanced_search.html">Search</a></div>
    <div class="d-block"><a class="nav-link" href="stats.php">Stats</a></div>
    <div class="d-block"><a class="nav-link" href="profile.php">Profile</a></div>
    <div class="d-block"><a class="nav-link" href="login.html">Log In</a></div>
    <div class="d-block"><a class="nav-link" href="logout.php">Log Out</a></div>
    <div class="d-block"><a class="nav-link" href="register.html">Register</a></div>
</div>
<div class="d-flex justify-content-center note-bg-profile">
     <div class="d-block-fluid p-4 m-4 light-background rounded">
        <p>Curious about the types of musicians we have on our platform?  Select which category you're intrested in and see the distribution of all the musicians</p>
     </div>
 </div>
<div class="d-block">
        <form action="stats.php" method="post">
            <select name="category">
                 <option value="instrument">Intrument</option>
                 <option value = "genre">Genre</option>
                 <option value = "city">City</option>
            </select>
            <input type="submit">
        </form>
    </div>
<div class="container-fluid" style="width: 50%">
    <div class="d-block chart-div" id="piechart"></div> 
</div>
</body>
</html>