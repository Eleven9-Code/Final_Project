<?php


if(isset($_POST["submit"])){
    $userFName=$_POST["userFName"];
    $userEmail=$_POST["userEmail"];
    $userPhone=$_POST["userPhone"];
    $reserveTime=$_POST["reserveTime"];
    $numGuest=$_POST["numGuest"];

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
    if(unavailable($conn,$reserveTime) !== false){
        header("location:../reserve.php?error=timeunavailable");
        exit();
    }
    
    createReservation($conn,$userFName,$userEmail,$userPhone,$reserveTime,$numGuest);

}
else{
    header("location:../reserve.php");
    exit();
}