<?php


if(isset($_POST["submit"])){
    $userFName=$_POST['userFName'];
    $userEmail=$_POST['userEmail'];
    $userPass=$_POST['userPass'];
    $userMailing=$_POST['userMailing'];
    $userBilling=$_POST['userBiling'];
    $userPayment=$_POST['userPayment'];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
    if(checkifMatch($conn,$userEmail,$userPass)==true){
        header("Location: ../reserve.php");
    }
    else{
        header("Location: ../Login.php");
    }
}
