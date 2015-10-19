<?php
    $q = $_GET["q"];
    $ret = $_GET["ty"];

    //openning connection
    $conn_string = "host=localhost port=5432 dbname=postgres user=postgres password=postgres";
    $dbconn = pg_connect($conn_string) or die('Connection failed');

    if ($q == 0) {
        if ($ret == 0) {
            $query = "select s1.name, count(*)
                        from test_project.store s1, test_project.invoice i1
                        where s1.store_id = i1.store_id
                        group by s1.name
                        having count(*) >= All (
                        select count (*)
                        from  test_project.store s, test_project.invoice i
                        where s.store_id = i.store_id
                        group by s.store_id 
                        )";
        } else {
            $query = "select s.name, sum (i1.price)
                        from test_project.invoice i1, test_project.store s
                        where i1.store_id = s.store_id
                        group by s.name
                        having sum (i1.price) >= all(select sum (i.price)
                        from test_project.invoice i
                        group by i.store_id
                        order by i.store_id)";
        }

        $result = pg_query($dbconn, $query);

        if(!$result){
                die("Error in SQL query:" .pg_last_error());
        }
        $row_parity = 1;

        echo '<table class = "customer_result">
            <tr class = "even">
                <th>No</th>
                <th>Store Name</th>';
                if ($ret == 0)
                        echo '<th>Number of Invoices</th>';
                	else
                		echo '<th>Sale</th>';
                   echo '</tr>';
        while($row = pg_fetch_array($result)) {
            if ($row_parity%2 == 1) {
                echo '<tr class = "odd">
                        <td>'.$row_parity.'</td>
                        <td>'.$row[0].'</td>';
                	if ($ret == 0)
                        echo '<td>'.$row[1].'</td>';
                	else
                		echo '<td>$'.$row[1].'</td>';
                   echo '</tr>';
            } else {  
                echo '<tr class = "even">
                        <td>'.$row_parity.'</td>
                        <td>'.$row[0].'</td>';
                    if ($ret == 0)
                        echo '<td>'.$row[1].'</td>';
                	else
                		echo '<td>$'.$row[1].'</td>';
                   echo '</tr>';
            }
            $row_parity += 1;
        }
        echo '</table>';

        }


?>
