<?php

function emptyInputSignup( $userFName,$userEmail,$userPhone,$reserveTime,$numGuest){
    $result;
    if(empty($userFName)||empty($userEmail)||empty($userPhone)||empty($reserveTime)||empty($numGuest)){
        $result=true;
    }
    else{
        $result=false;
    }
    return $result;
}


function invalidEmail($userEmail){
    $result;
    if(filter_var($userEmail, FILTER_VALIDATE_EMAIL)){
        $result=true;
    }
    else{
        $result=false;
    }
    return $result;
}

function unavailable($conn,$reserveTime){
    $result;
    $sql="SELECT * FROM mytables WHERE reserveTime = ?"; //select all tables that have been reserved
    $stmt=mysqli_stmt_init_($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location:../reserve.php?error=stmtfailed");
        exit();
        }
    mysqli_stmt_bind_param($stmt,"");
    
    $resultsData=mysqli_stmt_get_results($stmt);

    if(mysqli_fetch_assoc($resultsData)){

    }

    }
