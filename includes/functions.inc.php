<?php
date_default_timezone_set('US/Central');
$createReservation;
$availableTableSize;
$availableTableClass;
 $reservedTableID;
 $reservedTableSize;
 $reservedTableClass;
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
        $result=false;
    }
    else{
        $result=true;
    }
    return $result;
}

function checkifused($reservingTables,$availableTable){
    $flag=false;
    if(sizeof($reservingTables)!==0){
        for($i=0;$i<=sizeof($reservingTables);$i++){
            if($availableTable!==$reservingTables[$i]){
                $flag=false;
            }
            else{
                $flag=true;
            }
        }
    }
    else{
        $flag=false;
    }
    
    return $flag;
}
function checkfortwo($conn,$reserveTime){
    global $availableTableSize;
    global $availableTableClass;
    $sql="SELECT * FROM mytables WHERE tableId NOT IN(SELECT tableID FROM  reservedtables WHERE tableTime = '$reserveTime');"; 
    
    $reservingTables=array();
    $resultsData=mysqli_query($conn, $sql);
    while($row=mysqli_fetch_assoc($resultsData)){
        if($row["tableClass"]=="A"){
            $availableTableID=$row["tableId"];
            $availableTableSize=$row["tableSize"];
            $availableTableClass=$row["tableClass"];
            break;
        }
        else{
            $availableTableID=90;
        }
    }
    return $availableTableID;

}
function checkforfour($conn,$reserveTime){
    global $availableTableSize;
    global $availableTableClass;
    $sql="SELECT * FROM mytables WHERE tableId NOT IN(SELECT tableID FROM  reservedtables WHERE tableTime = '$reserveTime');"; 
    
    $reservingTables=array();
    $resultsData=mysqli_query($conn, $sql);
    while($row=mysqli_fetch_assoc($resultsData)){
        if($row["tableClass"]=="B"){
            $availableTableID=$row["tableId"];
            $availableTableSize=$row["tableSize"];
            $availableTableClass=$row["tableClass"];
            break;
        }
        else{
            $availableTableID=91;
        }
    }
    return $availableTableID;

}
function checkforSix($conn,$reserveTime){
    global $availableTableSize;
    global $availableTableClass;
    $sql="SELECT * FROM mytables WHERE tableId NOT IN(SELECT tableID FROM  reservedtables WHERE tableTime = '$reserveTime');"; 
    
    $reservingTables=array();
    $resultsData=mysqli_query($conn, $sql);

    while($row=mysqli_fetch_assoc($resultsData)){
        if($row["tableClass"]=="C"){
            $availableTableID=$row["tableId"];
            $availableTableSize=$row["tableSize"];
            $availableTableClass=$row["tableClass"];
            break;
        }
        else{
            $availableTableID=92;
        }
    }
    return $availableTableID;

}

function checkforeight($conn,$reserveTime){
    global $availableTableSize;
    global $availableTableClass;
    $sql="SELECT * FROM mytables WHERE tableId NOT IN(SELECT tableID FROM  reservedtables WHERE tableTime = '$reserveTime');"; 
    
    $reservingTables=array();
    $resultsData=mysqli_query($conn, $sql);

    while($row=mysqli_fetch_assoc($resultsData)){
        if($row["tableClass"]=="D"){
            $availableTableID=$row["tableId"];
            $availableTableSize=$row["tableSize"];
            $availableTableClass=$row["tableClass"];
            break;
        }
        else{
            $availableTableID=93;
        }
    }
    return $availableTableID;

} 
function createReservation($conn,$reservedTableID,$reservedTableSize,$reserveTime,$reservedTableClass,$userFName,$userPhone,$numGuest,$CCinfo){
    $result;
    global $reservedTableID;
    global $reservedTableSize;
    global $reservedTableClass; 
    //select all tables that are available
    $sql="INSERT INTO reservedtables(tableID,tableSize,tableTime,tableClass,userFName,userPhone,numGuest,cc)
     VALUES(?,?,?,?,?,?,?,?)"; 
    //$reservedTableID,$reservedTableSize,$reserveTime,$userFName,$userEmail,$userPhone,$numGuest
    
        $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location:../reserve.php?error=stmtfailed");
        return $result=false;
        exit();
    }
        //mysqli_stmt_bind_param($stmt,"iiissss",$userFName,$userEmail,$userPhone,$reserveTime,$numGuest);
        mysqli_stmt_bind_param($stmt,"sssssssi",$reservedTableID,$reservedTableSize,$reserveTime,$reservedTableClass,$userFName,$userPhone,$numGuest,$CCinfo);
        mysqli_stmt_execute($stmt);
         mysqli_stmt_close($stmt);
    return $result=true;
}

function  createAccount($conn,$userFName,$userEmail,$userPass,$userMailing,$userBilling,$userPayment){
    $sql="INSERT INTO userinfo(userFName,userEmail,userPass,userMailing,userBilling,userPayment)
     VALUES(?,?,?,?,?,?)";
    //$reservedTableID,$reservedTableSize,$reserveTime,$userFName,$userEmail,$userPhone,$numGuest
    
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location:../reserve.php?error=stmtfailed");
        return $result=false;
        exit();
        }
        //mysqli_stmt_bind_param($stmt,"iiissss",$userFName,$userEmail,$userPhone,$reserveTime,$numGuest);
        mysqli_stmt_bind_param($stmt,"ssssss",$userFName,$userEmail,$userPass,$userMailing,$userBilling,$userPayment);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $result=true;
}
function checkifMatch($conn,$userEmail,$userPass){
    $sql="SELECT * FROM userinfo";
    $resultsData=mysqli_query($conn, $sql);
    while($row=mysqli_fetch_assoc($resultsData)){
        if($userEmail==$row["userEmail"]&&$userPass==$row["userPass"]){
                return true;
        }
        else{
            return false;
        }
    }

}

function numGuestCheck($conn,$numGuest,$reservingTables,$reserveTime,$requestedTable){
    $result;
    global $availableTableSize;
    global $availableTableClass;
    global $reservedTableID;
    global $reservedTableSize;
    global $reservedTableClass;
    
    //select all tables that are available if theres none available then it should return false
    $sql="SELECT * FROM mytables WHERE tableId NOT IN(SELECT tableID FROM  reservedtables WHERE tableTime = '$reserveTime');"; 
    
    $reservingTables=array();
    $resultsData=mysqli_query($conn, $sql);
   
    $i=0;
    if($requestedTable==0){
        $tableRequestTwo=checkfortwo($conn,$reserveTime);
        $tableRequestFour=checkforfour($conn,$reserveTime);
        $tableRequestSix=checkforsix($conn,$reserveTime);
        $tableRequestEight=checkforeight($conn,$reserveTime);
        
    }
    else{
        $tableRequestTwo=$requestedTable;
        $tableRequestFour=$requestedTable;
        $tableRequestSix=$requestedTable;
        $tableRequestEight=$requestedTable;
    }

    
    while($row=mysqli_fetch_assoc($resultsData)){

            if(1==$numGuest||2==$numGuest){
                $availableTable= checkfortwo($conn,$reserveTime);

                if($availableTable==90){
                    header("location:../reserve.php?error=TwoNotAvailable");
                    exit();
                }
                else{
                    $flag=checkifused($reservingTables,$availableTable);
                    if($flag==false){
                        $result=true;
                        $reservedTableID=$availableTable;
                        $reservingTables[$i]= $reservedTableID ;
                        $reservedTableClass=$availableTableClass;
                        $reservedTableSize=$availableTableSize;
                        $availableTableSize;
                        break;
                    }
                    else{
                        continue;
                    }

                }
            }
            
            if(3==$numGuest||4==$numGuest){
                $availableTable= checkforfour($conn,$reserveTime);
                if($availableTable==91){
                        $availableTable= checkfortwo($conn,$reserveTime);
                        $flag=checkifused($reservingTables,$availableTable);
                            if($flag==false){
                                $result=2;
                                $reservedTableClass=$availableTableClass;
                                $reservedTableID=$availableTable;
                                $reservedTableSize=$availableTableSize;
                                $reservingTables[$i]= $reservedTableID ;
                                break;
                            }
                            else{
                                    continue;
                                }
                }
                else{
                    $flag=checkifused($reservingTables,$availableTable);
                    if($flag==false){
                        $result=1;
                        $reservedTableClass=$availableTableClass;
                        $reservedTableID=$availableTable;
                        $reservedTableSize=$availableTableSize;
                        $reservingTables[$i]= $reservedTableID ;
                        break;
                    }
                    else{
                        continue;
                    }

                }
            }
            
             if(5==$numGuest||6==$numGuest){

                $availableTable=checkforSix($conn,$reserveTime);
                    if($availableTable==92){
                        $availableTable=checkforfour($conn,$reserveTime);
                        if($availableTable==91){
                            $i=1;
                            $availableTable= checkfortwo($conn,$reserveTime);;
                            
                            if($availableTable==90){
                                header("location:../reserve.php?error=theresNONE");
                                    exit();
                            }
                            $flag=checkifused($reservingTables,$availableTable);
                            if($flag==false){
                                $result=3;
                                $reservedTableClass=$availableTableClass;
                                $reservedTableID=$availableTable;
                                $reservedTableSize=$availableTableSize;
                                $reservingTables[$i]= $reservedTableID ;
                                break;
                                }
                                else{
                                    continue;
                                }
                        }
                        $flag=checkifused($reservingTables,$availableTable);
                        if($flag==false){
                                $result=2;
                                $reservedTableClass=$availableTableClass;
                                $reservedTableID=$availableTable;
                                $reservedTableSize=$availableTableSize;
                                $reservingTables[$i]= $reservedTableID ;
                                break;
                                        }
                        else{ continue;}
                        
                    }
                    else{
                        $flag=checkifused($reservingTables,$availableTable);
                        if($flag==false){
                                $result=1;
                                    $reservedTableClass=$availableTableClass;
                                    $reservedTableID=$availableTable;
                                    $reservedTableSize=$availableTableSize;
                                    $reservingTables[$i]= $reservedTableID ;
                                    break;
                                }
                                else{
                                        continue;
                                    }

                    }
            }
            if(7==$numGuest||8==$numGuest){

                $availableTable=checkforeight($conn,$reserveTime);
                    if($availableTable==93){
                        $availableTable=checkforfour($conn,$reserveTime);
                        if($availableTable==91){
                            $i=1;
                            $availableTable= checkfortwo($conn,$reserveTime);
                            
                            if($availableTable==90){
                                header("location:../reserve.php?error=theresNONE");
                                    exit();
                            }
                            $flag=checkifused($reservingTables,$availableTable);
                            if($flag==false){
                                $result=3;
                                $reservedTableClass=$availableTableClass;
                                $reservedTableID=$availableTable;
                                $reservedTableSize=$availableTableSize;
                                $reservingTables[$i]= $reservedTableID ;
                                break;
                                }
                                else{
                                    continue;
                                }
                        }
                        $flag=checkifused($reservingTables,$availableTable);
                        if($flag==false){
                                $result=2;
                                $reservedTableClass=$availableTableClass;
                                $reservedTableID=$availableTable;
                                $reservedTableSize=$availableTableSize;
                                $reservingTables[$i]= $reservedTableID ;
                                break;
                                        }
                        else{ continue;}
                        
                    }
                    else{
                        $flag=checkifused($reservingTables,$availableTable);
                        if($flag==false){
                                $result=1;
                                    $reservedTableClass=$availableTableClass;
                                    $reservedTableID=$availableTable;
                                    $reservedTableSize=$availableTableSize;
                                    $reservingTables[$i]= $reservedTableID ;
                                    break;
                                }
                                else{
                                        continue;
                                    }

                    }
            }
            $i+1;
        
    }
    return $result; 
}
function unavailable($conn,$reserveTime,$numGuest,$userFName,$userPhone,$CCinfo){
    $result;
    $requestedTable=0;
    global $availableTableSize;
    global $availableTableClass;
    global $reservedTableID;
    global $reservedTableSize;
    global $reservedTableClass;
    
    //select all tables that are available if theres none available then it should return false
    $sql="SELECT * FROM mytables WHERE tableId NOT IN(SELECT tableID FROM  reservedtables WHERE tableTime = '$reserveTime');";
    $reservingTables=array();
    $resultsData=mysqli_query($conn, $sql);
    $i=0;
    while($row=mysqli_fetch_assoc($resultsData)){
        if(1==$numGuest||2==$numGuest){
            $result=true;
            numGuestCheck($conn,$numGuest,$reservingTables,$reserveTime,$requestedTable,);
            createReservation($conn,$reservedTableID,$reservedTableSize,$reserveTime,$reservedTableClass,$userFName,$userPhone,$numGuest,$CCinfo);
            header("location:../reserve.php?error=ReservationSuccess");
                break;
        }

        if(3==$numGuest||4==$numGuest){
            $result=true;
            if(numGuestCheck($conn,$numGuest,$reservingTables,$reserveTime,$requestedTable)==1){
                createReservation($conn,$reservedTableID,$reservedTableSize,$reserveTime,$reservedTableClass,$userFName,$userPhone,$numGuest,$CCinfo);
                header("location:../reserve.php?error=ReservationSuccess");
                break;
            }
            else{
                
                if(numGuestCheck($conn,$numGuest,$reservingTables,$reserveTime,$requestedTable)==2){
                    createReservation($conn,$reservedTableID,$reservedTableSize,$reserveTime,$reservedTableClass,$userFName,$userPhone,$numGuest,$CCinfo);
                    numGuestCheck($conn,$numGuest,$reservingTables,$reserveTime,$requestedTable);
                    createReservation($conn,$reservedTableID,$reservedTableSize,$reserveTime,$reservedTableClass,$userFName,$userPhone,$numGuest,$CCinfo);
                    header("location:../reserve.php?error=ReservationSuccess");
                    break;
                }
            }
            
            
        }
        if(5==$numGuest||6==$numGuest){
            $result=true;
            //if 1 then table of 6 is available
            if(numGuestCheck($conn,$numGuest,$reservingTables,$reserveTime,$requestedTable)==1){
                createReservation($conn,$reservedTableID,$reservedTableSize,$reserveTime,$reservedTableClass,$userFName,$userPhone,$numGuest,$CCinfo);
                header("location:../reserve.php?error=ReservationSuccess");
                break;
            }
            else{
                 //if 2 then 1 table of 4 and 1 table of 2
                if(numGuestCheck($conn,$numGuest,$reservingTables,$reserveTime,$requestedTable)==2){
                    createReservation($conn,$reservedTableID,$reservedTableSize,$reserveTime,$reservedTableClass,$userFName,$userPhone,$numGuest,$CCinfo);
                    numGuestCheck($conn,$numGuest=2,$reservingTables,$reserveTime,$requestedTable);
                    createReservation($conn,$reservedTableID,$reservedTableSize,$reserveTime,$reservedTableClass,$userFName,$userPhone,$numGuest,$CCinfo);
                    header("location:../reserve.php?error=ReservationSuccess");
                    break;
                }
                else{
                    if(numGuestCheck($conn,$numGuest,$reservingTables,$reserveTime,$requestedTable)==3){
                        createReservation($conn,$reservedTableID,$reservedTableSize,$reserveTime,$reservedTableClass,$userFName,$userPhone,$numGuest,$CCinfo);
                        numGuestCheck($conn,$numGuest=2,$reservingTables,$reserveTime,$requestedTable);
                        createReservation($conn,$reservedTableID,$reservedTableSize,$reserveTime,$reservedTableClass,$userFName,$userPhone,$numGuest,$CCinfo);
                        numGuestCheck($conn,$numGuest=2,$reservingTables,$reserveTime,$requestedTable);
                        createReservation($conn,$reservedTableID,$reservedTableSize,$reserveTime,$reservedTableClass,$userFName,$userPhone,$numGuest,$CCinfo);
                        header("location:../reserve.php?error=ReservationSuccess");
                        break;
                    }
                }
                //if 3 then 3 table of 2
            }
            
            
        }
        if(7==$numGuest||8==$numGuest){
            $result=true;
            //if 1 then table of 6 is available
            //if num guest is greater than 8 then it should reserve multiple tables equal to the numGuest

            if(numGuestCheck($conn,$numGuest,$reservingTables,$reserveTime,$requestedTable)==1){
               
                createReservation($conn,$reservedTableID,$reservedTableSize,$reserveTime,$reservedTableClass,$userFName,$userPhone,$numGuest,$CCinfo);
                header("location:../reserve.php?error=ReservationSuccess");
                break;
            }
            else{
                 //if 2 then 1 table of 4 and 1 table of 2
                if(numGuestCheck($conn,$numGuest,$reservingTables,$reserveTime,$requestedTable)==2){
                    createReservation($conn,$reservedTableID,$reservedTableSize,$reserveTime,$reservedTableClass,$userFName,$userPhone,$numGuest,$CCinfo);
                    numGuestCheck($conn,$numGuest=2,$reservingTables,$reserveTime,$requestedTable);
                    createReservation($conn,$reservedTableID,$reservedTableSize,$reserveTime,$reservedTableClass,$userFName,$userPhone,$numGuest,$CCinfo);
                    numGuestCheck($conn,$numGuest=2,$reservingTables,$reserveTime,$requestedTable);
                    createReservation($conn,$reservedTableID,$reservedTableSize,$reserveTime,$reservedTableClass,$userFName,$userPhone,$numGuest,$CCinfo);
                    header("location:../reserve.php?error=ReservationSuccess");
                    break;
                }
                else{
                    if(numGuestCheck($conn,$numGuest,$reservingTables,$reserveTime,$requestedTable)==3){
                        createReservation($conn,$reservedTableID,$reservedTableSize,$reserveTime,$reservedTableClass,$userFName,$userPhone,$numGuest,$CCinfo);
                        numGuestCheck($conn,$numGuest=2,$reservingTables,$reserveTime,$requestedTable);
                        createReservation($conn,$reservedTableID,$reservedTableSize,$reserveTime,$reservedTableClass,$userFName,$userPhone,$numGuest,$CCinfo);
                        numGuestCheck($conn,$numGuest=2,$reservingTables,$reserveTime,$requestedTable);
                        createReservation($conn,$reservedTableID,$reservedTableSize,$reserveTime,$reservedTableClass,$userFName,$userPhone,$numGuest,$CCinfo);
                        numGuestCheck($conn,$numGuest=2,$reservingTables,$reserveTime,$requestedTable);
                        createReservation($conn,$reservedTableID,$reservedTableSize,$reserveTime,$reservedTableClass,$userFName,$userPhone,$numGuest,$CCinfo);
                        header("location:../reserve.php?error=ReservationSuccess");
                        break;
                    }
                }
                //if 3 then 3 table of 2
            }
            
            
        }
        else{
            if($numGuest>8){
                BreakDownNumGuest($conn,$reserveTime,$numGuest,$userFName,$userPhone,$CCinfo);     
            }
        }
        }
        $i+1;
    return $result;
    
}

function BreakDownNumGuest($conn,$reserveTime,$numGuest,$userFName,$userPhone,$CCinfo){
    $numofCalls;
    $extraGroup=0;
    if($numGuest%8==0){
        $numofCalls=$NumberofGroup=round($numGuest/8);
    }
    else{
        $NumberofGroup=floor($numGuest/8);
        $extraGroup=$numGuest%8;//
        $numofCalls=$NumberofGroup;
        
    }
    for($i=0;$i<$numofCalls;$i++){
        unavailable($conn,$reserveTime,8,$userFName,$userPhone,$CCinfo);
    }
    if($extraGroup!=0){
        unavailable($conn,$reserveTime,$extraGroup,$userFName,$userPhone,$CCinfo);
    }
    exit();
}

function TrafficController($conn){
    $date=date('Y-m-d');
    $total=0;
       //select all tables that are available if theres none available then it should return false
       $sql="SELECT * FROM reservedtables WHERE DATE(tableTime)='$date';";
       $resultsData=mysqli_query($conn, $sql);
       while($row=mysqli_fetch_assoc($resultsData)){
        $total=$total+$row["numGuest"];
       }
        if($total>40){
            return true;
        }
        else{
            return false;
        }
}
