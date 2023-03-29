<?php
session_start();
$connection = mysqli_connect('localhost','root','','MyHouse');
$_SESSION['$connection'] = $connection;

//check if the connection was successful 
if (!$connection) {
    die ("CONNECTION FAILURE !!".mysqli_connect_error());
}


?>