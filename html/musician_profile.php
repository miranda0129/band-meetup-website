<?php
include 'continue.php';
include 'get_ads.php';
?>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link href='https://fonts.googleapis.com/css?family=Recursive' rel='stylesheet'>    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/styles.css">
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/js.js"></script>
</head>
<body onload="load_ads()">
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
    <div class="d-block-fluid p-4 m-4 light-background rounded"><h2 class="p5"><?php echo $username?></h2></div>
</div>
<div class="container-fluid dark-background">
    <div class="row">
        <div class="col-md d-flex flex-column">
            <h2>Your Profile</h2>
            <div class="profile">
                <h6>These criterias are used to help match you to the right project through the search and ad features</h6>
                <div class="p-2" style="border: solid;">
                    <h5>Instrument: </h5>
                    <p><?php echo $instrument?></p><br>
                    <h5>Genre: </h5>
                    <p><?php echo $genre?></p><br>
                    <h5>City: </h5>
                    <p><?php echo $city?></p><br>
                    <h5>Band: </h5>
                    <p><?php echo $band?></p><br><br>
                    <h5>One Time: </h5>
                    <?php if($one_time == 1) echo 'available';
                    else echo '<p>unavailable</p><br>';?>
                    <h5>Full Time: </h5>
                    <?php if($full_time == 1) echo 'available';
                    else echo '<p>unavailable</p><br>';?>
                </div>
            </div>
        </div>
        <div class="col-md d-flex flex-column">
            <h2>Ads For You</h2>
            <div class="profile" id="ad_list"><p>All ads posted that match your critera are displayed here</p></div>
        </div>
        <div class="col-md d-flex flex-column">
            <h2>Edit</h2>
            <div class="profile"><form action="edit_musician.php">
                <p>If your style changes, edit it easily here</p>
                <div class="p-2" style="border: solid;">
                    <label for="instrument">Instrument: </label>
                    <select name="instrument" id="instrument">
                        <option value="">Leave Unchanged</option>
                        <option value="guitar">Guitar</option>
                        <option value="drums">Drums</option>
                        <option value="bass">Bass</option>
                        <option value="saxophone">Saxophone</option>
                        <option value="vocal">Vocal</option>
                        <option value="flute">Flute</option>
                        <option value="banjo">Banjo</option>
                        <option value="ukulele">Ukulele</option>
                    </select><br>
                    <label for="genre">Genre: </label>
                    <select name="genre" id="genre">
                        <option value="">Leave Unchanged</option>
                        <option value="pop">Pop</option>
                        <option value="rock">Rock</option>
                        <option value="jazz">Jazz</option>
                        <option value="blues">Blues</option>
                        <option value="country">Country</option>
                    </select><br>
                    <label for="city">City: </label>
                    <select name="city" id="city">
                        <option value="">Leave Unchanged</option>
                        <option value="windsor">Windsor</option>
                        <option value="london">London</option>
                        <option value="toronto">Toronto</option>
                        <option value="montreal">Montral</option>
                        <option value="waterloo">Waterloo</option>
                        <option value="guelph">Guelph</option>
                        <option value="vancover">Vancouver</option>
                    </select><br><br>
                    <input type="submit">
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>