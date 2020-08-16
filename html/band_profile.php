<?php
include 'continue.php';
include 'get_ads.php';
include 'get_band_members.php'
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
<body onload="load_band_members();load_ads()">
<div class="container-fluid d-flex dark-background account-management">
    <div class="d-block"><a class="nav-link" href="index.html">Home</a></div>
    <div class="d-block"><a class="nav-link" href="advanced_search.html">Search</a></div>
    <div class="d-block"><a class="nav-link" href="stats.php">Stats</a></div>
    <div class="d-block"><a class="nav-link" href="profile.php">Profile</a></div>
    <div class="d-block"><a class="nav-link" href="login.html">Log In</a></div>
    <div class="d-block"><a class="nav-link" href="logout.php">Log Out</a></div>
    <div class="d-block"><a class="nav-link" href="register.html">Register</a></div>
</div>
<div class="container-fluid d-flex justify-content-center note-bg-profile">
    <div class="d-block-fluid p-2 m-4 light-background rounded"><h2 class="p5"><?php echo $_SESSION['band'] ?></h2></div>
</div>
<div class="container-fluid dark-background">
    <div class="row">
        <div class="col-md d-flex flex-column">
            <div class="light-background"><h2>Your Band Members</h2></div>
            <div class="profile">
                <div id="band_members">
                </div>
            </div>
            <div class="profile">
                <p>Add a member to your band here</p>
                <form class="container form dark-background rounded" action="add_musician_to_band.php" mehod="post">
                    <label for="username">Musician's Email: </label>
                    <input type="text" name="email" id="email">
                    <input type="submit">
                </form>
            </div>
            <div class="profile">
                    <div>
                        <p>Remove a Band Member</p>
                        <form class="container form dark-background rounded" action="remove_musician_from_band.php" mehod="post">
                            <label for="username">Musician's Email: </label>
                            <input type="text" name="email" id="email">
                            <input type="submit">
                        </form>
                    </div>
                </div>
        </div>
        <div class="col-md d-flex flex-column">
            <div class="light-background"><h2>Your Posted Ads</h2></div>
            <div class="profile" id="ad_list">
                
            </div>
        </div>
        <div class="col-md d-flex flex-column">
            <div class="light-background"><h2>Post an Ad</h2></div>
            <div class="profile">
                <form action="post_ad.php">
                    <h6>Any ad you post will be sent to any musician who fit the criteria you fit</h6>
                    <p>optional fields</p>
                    <label for="instrument">Instrument: </label>
                    <select name="instrument" id="instrument">
                        <option value="">n/a</option>
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
                        <option value="">n/a</option>
                        <option value="pop">Pop</option>
                        <option value="rock">Rock</option>
                        <option value="jazz">Jazz</option>
                        <option value="blues">Blues</option>
                        <option value="country">Country</option>
                    </select><br>
                    <label for="city">City: </label>
                    <select name="city" id="city" requied>
                        <option value="">n/a</option>
                        <option value="windsor">Windsor</option>
                        <option value="london">London</option>
                        <option value="toronto">Toronto</option>
                        <option value="montreal">Montral</option>
                        <option value="waterloo">Waterloo</option>
                        <option value="guelph">Guelph</option>
                        <option value="vancover">Vancouver</option>
                    </select><br><br>
                    <label for="message">Include a personalized message</label><br>
                    <textarea id="message" name="message" rows="3" col="2"></textarea><br><br>
                
                    <h4>Available to fill spot for: </h4>
                    <p>must select one</p>
                    <input type="radio" id="one_time" name="time" value="one_time" required>
                    <label for="one_time">One time gigs</label><br>
                    <input type="radio" id="full_time" name="time" value="full_time">
                    <label for="full_time">Full Time Band Membership</label><br><br>
                    <input type="submit">    
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>