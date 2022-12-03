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
    createAccount($conn,$userFName,$userEmail,$userPass,$userMailing,$userBilling,$userPayment);
    header("Location: ../login.php");
}

