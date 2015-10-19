<?php
//openning connection
    $conn_string = "host=localhost port=5432 dbname=postgres user=postgres password=postgres";
    $dbconn = pg_connect($conn_string) or die('Connection failed');
    
    $aid = 1;
    $add = $_GET["a"];
    $city = $_GET["c"];
    $pc = $_GET["p"];    
    $phone = $_GET["ph"];
    
    $cid = 1;
    $first = $_GET["f"];
    $last = $_GET["l"];
    $sin = $_GET["sin"];
    
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
    
    $cid_query = "SELECT MAX(c.cash_id) as m
                 FROM test_project.cashier c";
    
    
    $cidm = pg_query($dbconn, $cid_query);
    if (!$cidm) { 
        die("Error in SQL query:" .pg_last_error());
    }
    $myrow = pg_fetch_assoc($cidm);
    $cid += $myrow['m'];
    
    $addcashierquery = "insert into test_project.cashier values
                        (".$aid.", ".$cid.", '".$last."','".$first."', ".$sin.")";
    
    $acqr = pg_query($dbconn, $addcashierquery);
    if (!$acqr) { 
        die("Error in SQL query:" .pg_last_error());
    }
    
    echo 'Cashier added successfully!';
    //free memory
    pg_free_result($aidm);
    pg_free_result($aaqr);
    pg_free_result($cidm);
    pg_free_result($acqr);
    
    //close connection
    pg_close($dbconn);
?>
