<?php

$serverName="localhost";
$dbUserName="root";
$dbPassword="";
$dbName="reservationSys";

$conn= myspli_connect($serverName,$dbUserName,$dbPassword,$dbName);

if(!conn){
    die("connection Failed: ". mysqli_connect_error());
}
