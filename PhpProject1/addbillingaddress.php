<?php
    session_start();
    //openning connection
    $conn_string = "host=localhost port=5432 dbname=postgres user=postgres password=postgres";
    $dbconn = pg_connect($conn_string) or die('Connection failed');
    
    $cid = $_SESSION['cust_id'];
    $aid = 1;
    $add = $_GET["a"];
    $city = $_GET["c"];
    $pc = $_GET["p"];
    $phone = $_GET["ph"];
    
    $aid_query = "SELECT MAX(a.address_id) as m
                 FROM test_project.address a";
    
    $aidm = pg_query($dbconn, $aid_query);
    if (!$aidm) { 
        die("Error in SQL query:" .pg_last_error());
    }
    $myrow = pg_fetch_assoc($aidm);
    $aid += $myrow['m'];
    
    $addaddressquery = "insert into test_project.address values
                        (".$aid.", '".$add."', '".$city."','".$phone."', '".$pc."')";
    
    $aaqr = pg_query($dbconn, $addaddressquery);
    if (!$aaqr) { 
        die("Error in SQL query:" .pg_last_error());
    }
    
    $addbillingaddressquery = "insert into test_project.billingaddress values
                                (".$aid.", ".$cid.")";
    $abaqr = pg_query($dbconn, $addbillingaddressquery);
    if (!$abaqr) { 
        die("Error in SQL query:" .pg_last_error());
    }
    //echo $query;
    echo 'Billing Address added successfully!';
    
    //free memory
    pg_free_result($aidm);
    pg_free_result($aaqr);
    pg_free_result($abaqr);
    //close connection
    pg_close($dbconn);
?>
