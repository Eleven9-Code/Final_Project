<?php
$hide="hide";
if(isset($_POST["submit"])){
    $userFName=$_POST['userFName'];
    $userEmail=$_POST['userEmail'];
    $userPhone=$_POST['userPhone'];
    $reserveTime=$_POST['reserveTime'];
    $numGuest=(int)$_POST['numGuest'];
    $CCinfo=$_POST['CreditCard'];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
    
    if(emptyInputSignup( $userFName,$userEmail,$userPhone,$reserveTime,$numGuest) !== false){
        header("location:../reserve.php?error=emptyinput");
        exit();
    }

    if(invalidEmail($userEmail) !== false){
        header("location:../reserve.php?error=invalidemail");
        exit();
    }
    if(TrafficController($conn)==true){
        $hide="";
    }
    //if a function returns true then you should check if the unavailable function is true 
    // this function should take 
    if(unavailable($conn,$reserveTime,$numGuest,$userFName,$userPhone,$CCinfo) == false){
        header("location:../reserve.php?error=timeunavailable");
        exit();
    }
    if (BreakDownNumGuest($conn,$reserveTime,$numGuest,$userFName,$userPhone,$CCinfo) == false){
        header("location:../reserve.php?error==CouldntGetT");
        exit();
    }
    
        echo '<script>alert("Welcome to Geeks for Geeks")</script>';
    
        
 }


