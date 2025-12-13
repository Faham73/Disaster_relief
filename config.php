<?php
$conn = mysqli_connect("localhost","root","","disaster_relief");

if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}
?>
