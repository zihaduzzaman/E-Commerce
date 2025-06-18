<?php
$dbname="localhost";
$dbuser="root";
$dbpass="";
$dbname="shopping";

$conn = mysqli_connect("localhost", "root", "", "shopping");

if(!$conn){
    die("Connection Failed".mysqli_connect_error());
}

?>