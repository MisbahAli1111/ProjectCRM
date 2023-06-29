<?
session_start();
include_once("database.php");
error_reporting(E_ERROR);
ini_set('display_errors', '1');


if (isset($_SESSION['email'])&&isset($_SESSION['password']))
{
        $session_password = $_SESSION['password'];
        $session_email =  $_SESSION['email'];
        $query = "SELECT *  FROM jhm_admins WHERE email='$session_email' AND password='$session_password'";
        $result = $con->query($query);
        if ($result->num_rows > 0){
            while($row = $result->fetch_assoc()) 
            {
            $logged=1;
            $session_id = $row['id'];
            $session_password = $row['password'];
            $session_name = $row['name'];
            $session_email = $row['email'];
            $session_data = $row;
           }
        }else
        {
            $logged=0;
        }

}
else
{
        $logged=0;
}

if(isset($_GET['logout']))
{
    $_SESSION['password']="";
    $_SESSION['email']="";
    $logged=0;
    header("Location:../index.php");
    exit();
}

function mb_htmlentities($string, $hex = true, $encoding = 'UTF-8') {
    global $con;
    return mysqli_real_escape_string($con, $string);
}

function clear($string, $hex = true, $encoding = 'UTF-8') {
    global $con;
    return mysqli_real_escape_string($con, $string);
}

function generateRandomString($length = 10) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

include_once("./includes/core/dbmodel.php");


function runQuery($query){
    global $con;
    $result=$con->query($query);
    if(!$result){
        echo $con->error;
        exit();
    }
}

?>