<?php

    $conn_string = "host=localhost port=5432 dbname=postgres user=postgres password=postgres";
    $dbconn = pg_connect($conn_string) or die('Connection failed');

    $deptnamequery = "select d.name
                      from test_project.department d
                      order by d.name ASC";
    
    $result = pg_query($dbconn, $deptnamequery);
    
    if (!$result) { 
        die("Error in SQL query:" .pg_last_error());
    } else {
        while($row = pg_fetch_array($result)) {
            echo '<option value="'.$row[0].'">'
                    .$row[0].'
                 </option>';
        }
        
    }
?>
