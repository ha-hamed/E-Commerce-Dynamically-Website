<?php
    //openning connection
    $conn_string = "host=localhost port=5432 dbname=postgres user=postgres password=postgres";
    $dbconn = pg_connect($conn_string) or die('Connection failed');
    
    $dname = $_GET["n"];
    $ddesc = $_GET["d"];
    $did = 1;
    
    $deptidquery = "select max(d.dept_id) as m
                     from test_project.department d";
    
    $diqm = pg_query($dbconn, $deptidquery);
    if (!$diqm) {
        die("Error in SQL query:" .pg_last_error());
    } else {
        $myrow = pg_fetch_assoc($diqm);
        $did += $myrow['m'];
        
        $adq = "insert into test_project.department values
                (".$did.", '".$dname."', '".$ddesc."')";
        $adqr = pg_query($dbconn, $adq);
        if (!$adqr) {
            die("Error in SQL query:" .pg_last_error());
        } else {
            echo 'Department added successfully!';
        }
    }
    
    //free memory
    pg_free_result($diqm);
    pg_free_result($adqr);
    //close connection
    pg_close($dbconn);
?>
