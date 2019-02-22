<?php 
ob_start();
session_start();

$timezone = date_default_timezone_set('America/Chicago');

$con = mysqli_connect('localhost', 'root', '', 'social');
if(mysqli_connect_error()) {
    echo 'Failed to connect: ' . mysqli_connect_error();
}

?>