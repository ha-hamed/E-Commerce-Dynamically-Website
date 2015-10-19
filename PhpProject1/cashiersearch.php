<?php
    $q = $_GET["q"];
    $retNumber = $_GET["d"];
    
    //openning connection
    $conn_string = "host=localhost port=5432 dbname=postgres user=postgres password=postgres";
    $dbconn = pg_connect($conn_string) or die('Connection failed');
    
    if ($q == 0) {
        if ($retNumber == 0) {
            $query = "select c.last_name, c.first_name
                        from test_project.cashier c
                        where c.cash_id not in (
                        select i.cash_id
                        from test_project.invoice i
                        where i.price < 0
                        group by i.cash_id)
                        order by c.last_name ASC, c.first_name ASC";
        } else {
                        $query = "select c.last_name, c.first_name
                        from test_project.cashier c
                        where c.cash_id in (
                        select i.cash_id
                        from test_project.invoice i
                        where i.price < 0
                        group by i.cash_id
                        having count(*) = $retNumber)
                        order by c.last_name ASC, c.first_name ASC";
        }
        
        $result = pg_query($dbconn, $query);

        if(!$result){
                die("Error in SQL query:" .pg_last_error());
        }
        $row_parity = 1;

        echo '<table class = "customer_result">
            <tr class = "even">
                <th>No</th>
                <th>Firstname</th>
                <th>Lastname</th>
            </tr>';
        while($row = pg_fetch_array($result)) {
            if ($row_parity%2 == 1) {
                echo '<tr class = "odd">
                        <td>'.$row_parity.'</td>
                        <td>'.$row[1].'</td>
                        <td>'.$row[0].'</td>
                    </tr>';
            } else {   
                echo '<tr class = "even">
                        <td>'.$row_parity.'</td>
                        <td>'.$row[1].'</td>
                        <td>'.$row[0].'</td>
                    </tr>';
            }
            $row_parity += 1;
        }
        echo '</table>';

        }

?>
