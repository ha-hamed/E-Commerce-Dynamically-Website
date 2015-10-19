<?php

    $conn_string = "host=localhost port=5432 dbname=postgres user=postgres password=postgres";
    $dbconn = pg_connect($conn_string) or die('Connection failed');

    $custnamequery = "select c.last_name
                      from test_project.customer c
                      order by c.last_name ASC";
    
    $result = pg_query($dbconn, $custnamequery);
    
    if (!$result) { 
        die("Error in SQL query:" .pg_last_error());
    } else {
        while($row = pg_fetch_array($result)) {
            echo '<option value="'.$row[0].'">'
                    .$row[0].'
                 </option>';
        }
        
    }
    //free memory
    pg_free_result($result);
    //close connection
    pg_close($dbconn);

?>
