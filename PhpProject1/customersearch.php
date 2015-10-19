<?php
    $q = $_GET["q"];
    
    //openning connection
    $conn_string = "host=localhost port=5432 dbname=postgres user=postgres password=postgres";
    $dbconn = pg_connect($conn_string) or die('Connection failed');
    
    if ($q == 0) {
        $firstname = $_GET["f"];
        $lastname = $_GET["l"];
        $email = $_GET["e"];

        $query = "select * from test_project.customer";
        if ($firstname) {
            $query = $query ." where first_name = '$firstname'";
            if ($lastname) {
                $query = $query." and last_name = '$lastname'";
            }
            if ($email) {
                $query = $query." and email = '$email'";
            }
        } elseif ($lastname) {
            $query = $query." where last_name = '$lastname'";
            if ($email) {
                $query = $query." and email = '$email'";
            }
        } elseif ($email) {
            $query = $query." where email = '$email'";
        }

    } elseif ($q == 1){
        $min = $_GET["min"];
        $max = $_GET["max"];
        $ty = $_GET["ty"];
        
        $query = "select * from test_project.customer c";
        
        if($ty == 0) {
            $query = $query." where c.cust_id in ";
        } else {
            $query = $query." where c.cust_id not in ";
        }
        $query = $query."(select i.cust_id
                            from test_project.invoice i
                            where i.price >= $min
                            and i.price <= $max)";
        
    } elseif ($q == 2){
        $billingi = $_GET["b"];
        $clast = $_GET["l"];
        
        if ($billingi) {
            $query = "select * from test_project.customer c";
            $query = $query." where c.cust_id in (
                            select bi.cust_id
                            from test_project.billinginformation bi
                            group by bi.cust_id
                            having count(*) = $billingi)";
        } else if ($clast) {
            $query = "select c1.first_name, c1.last_name, c1.email, bi.card_number, bi.type
                        from test_project.customer c1, test_project.billinginformation bi
                        WHERE c1.cust_id = bi.cust_id
                        and c1.last_name = '".$clast."'
                        ORDER BY c1.cust_id ASC";
        }
        
    } else {
        $pname = $_GET["b"];
        if ($pname) {
            $query = "select c.last_name, c.first_name, c.email, temp.quantity
                    from test_project.customer c, 
                    (select i.cust_id as id, sum(b.quantity) as quantity
                    from test_project.customer c, test_project.invoice i, test_project.basket b, test_project.product p
                    where i.cust_id = c.cust_id
                    and i.store_id = 1
                    and p.name = '$pname'
                    and b.invoice_number = i.invoice_number
                    and p.sku = b.sku
                    group by i.cust_id
                    having sum(b.quantity) >= all (select  sum(b1.quantity)
                                                    from test_project.customer c1, test_project.invoice i1, test_project.basket b1, test_project.product p1
                                                    where i1.cust_id = c1.cust_id
                                                    and i1.store_id = 1
                                                    and p1.name = '$pname'
                                                    and b1.invoice_number = i1.invoice_number
                                                    and p1.sku = b1.sku
                                                    group by i1.cust_id)
                    order by i.cust_id) as temp
                    where c.cust_id = temp.id";
        }
        
    }

    $result = pg_query($dbconn, $query);

    if(!$result){
            die("Error in SQL query:" .pg_last_error());
    }
    $row_parity = 1;
    
    if ($q == 3) {
        echo '<table class = "customer_result">
            <tr class = "even">
                <th>No</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Email</th>
                <th>Quantity</th>
            </tr>';
        while($row = pg_fetch_array($result)) {
            if ($row_parity%2 == 1) {
                echo '<tr class = "odd">
                        <td>'.$row_parity.'</td>
                        <td>'.$row[1].'</td>
                        <td>'.$row[0].'</td>
                        <td>'.$row[2].'</td>
                        <td>'.$row[3].'</td>
                    </tr>';
            } else {    
                echo '<tr class = "even">
                        <td>'.$row_parity.'</td>
                        <td>'.$row[1].'</td>
                        <td>'.$row[0].'</td>
                        <td>'.$row[2].'</td>
                        <td>'.$row[3].'</td>
                    </tr>';
            }
            $row_parity += 1;
        }
        echo '</table>';
    } elseif ($q == 2 && !$billingi) {
        echo '<table class = "customer_result">
            <tr class = "even">
                <th>No</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Email</th>
                <th>Card Number</th>
                <th>Type</th>
            </tr>';
        while($row = pg_fetch_array($result)) {
            if ($row_parity%2 == 1) {
                echo '<tr class = "odd">
                        <td>'.$row_parity.'</td>
                        <td>'.$row[0].'</td>
                        <td>'.$row[1].'</td>
                        <td>'.$row[2].'</td>
                        <td>'.$row[3].'</td>
                        <td>'.$row[4].'</td>
                    </tr>';
            } else { 
                echo '<tr class = "even">
                        <td>'.$row_parity.'</td>
                        <td>'.$row[0].'</td>
                        <td>'.$row[1].'</td>
                        <td>'.$row[2].'</td>
                        <td>'.$row[3].'</td>
                        <td>'.$row[4].'</td>
                    </tr>';
            }
            $row_parity += 1;
        }
        echo '</table>';
    } else {
        echo '<table class = "customer_result">
            <tr class = "even">
                <th>No</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Email</th>
            </tr>';
        while($row = pg_fetch_array($result)) {
            if ($row_parity%2 == 1) {
                echo '<tr class = "odd">
                        <td>'.$row_parity.'</td>
                        <td>'.$row[2].'</td>
                        <td>'.$row[1].'</td>
                        <td>'.$row[4].'</td>
                    </tr>';
            } else {   
                echo '<tr class = "even">
                        <td>'.$row_parity.'</td>
                        <td>'.$row[2].'</td>
                        <td>'.$row[1].'</td>
                        <td>'.$row[4].'</td>
                    </tr>';
            }
            $row_parity += 1;
        }
        echo '</table>';
    }
?>
