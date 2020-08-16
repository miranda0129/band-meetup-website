<?php
require_once 'login.php';

$connect = new mysqli( $hn, $un, $pw,$db);
if ($connect->connect_error) die($connect->connect_error);

$rec_un = $_REQUEST['email-login'];
$rec_pw = $_REQUEST['pw-login'];

if(isset($_REQUEST['email-login']) && 
    isset($_REQUEST['pw-login']))
{
    $un_temp = mysql_entities_fix_string($connect, $rec_un);
    $pw_temp = mysql_entities_fix_string($connect, $rec_pw);
    $query = "SELECT * FROM users WHERE email='$un_temp'";
    $result = $connect->query($query);
    if(!$result) die($connect->error);
        
    elseif($result->num_rows)
    {
        $row = $result->fetch_array(MYSQLI_NUM);
        $result->close();
        $salt1 = "qm&h*";
        $salt2 = "pg!@";
        $token = hash('ripemd128', "$salt1$pw_temp$salt2");
       
        if($token == $row[1])
        {
            session_start();
            $_SESSION['email'] = $un_temp;
            $_SESSION['password'] = $pw_temp;
            $_SESSION['type'] = $row[2];
            
           if($_SESSION['type'] == 'musician'){
                $query = "SELECT * FROM musicians WHERE email='$un_temp'";
                $result = $connect->query($query);
                if(!$result) die($connect->error);
                $row = $result->fetch_array(MYSQLI_NUM);
                $_SESSION['username'] = $row[1];
                $_SESSION['instrument'] = $row[2];
                $_SESSION['genre'] = $row[3];
                $_SESSION['city'] = $row[4];
                $_SESSION['band'] = $row[5];
                $_SESSION['one_time'] = $row[6];
                $_SESSION['full_time'] = $row[7];
                header('Location: musician_profile.php');
            }
            
            if($_SESSION['type'] == 'band'){
                $query = "SELECT * FROM bands WHERE email='$un_temp'";
                $result = $connect->query($query);
                if(!$result) die($connect->error);
                $row = $result->fetch_array(MYSQLI_NUM);
                $_SESSION['band'] = $row[1];
                header('Location: band_profile.php');
            }
        }
        else die("Invalid username/password combination");
    }
    else die("Invalid username/password combination");
}

else
{
    header('Location:login.html');
    $connect->close();
}


function mysql_entities_fix_string($connect, $string)
{
    return htmlentities(mysql_fix_string($connect, $string));
}

function mysql_fix_string($connect, $string){
    if(get_magic_quotes_gpc()) $string = stripslashes($string);
    return $connect->real_escape_string($string);
}
?>