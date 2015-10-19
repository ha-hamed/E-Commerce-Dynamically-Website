<?php
    $q = $_GET["q"];
    
    //openning connection
    $conn_string = "host=localhost port=5432 dbname=postgres user=postgres password=postgres";
    $dbconn = pg_connect($conn_string) or die('Connection failed');
    
    if ($q == 0) {
        $dept = $_GET["d"];


        $query = "select count(p.name) as c, dp.name as n 
                  from test_project.product p";
        if ($dept) {
            if ($dept != 'ALL') {
                $query = $query.", test_project.department dp  
                                  where dp.name = '$dept' 
                                  and dp.dept_id = p.dept_id 
                                  group by dp.name";
            } else {
                $query = $query.", test_project.department dp  
                                  where dp.dept_id = p.dept_id 
                                  group by dp.name";
                
            }
        }
        $result = pg_query($dbconn, $query);
    
        if(!$result){
                die("Error in SQL query:" .pg_last_error());
        }
        $row_parity = 1;

        echo '<table class = "customer_result">
            <tr class = "even">
                <th>No</th>
                <th>Department Name</th>
                <th>Product Name</th>
            </tr>';
        while($row = pg_fetch_array($result)) {
            if ($row_parity%2 == 1) {
                echo '<tr class = "odd">
                        <td>'.$row_parity.'</td>
                        <td>'.$row["n"].'</td>
                        <td>'.$row["c"].'</td>
                    </tr>';
            } else {
                echo '<tr class = "even">
                        <td>'.$row_parity.'</td>
                        <td>'.$row["n"].'</td>
                        <td>'.$row["c"].'</td>
                    </tr>';
            }
            $row_parity += 1;
        }
        echo '</table>';
    } else if ($q == 1) {
        $type = $_GET["ty"];
        $store = $_GET["st"];
        $dept = $_GET["dp"];
        
        if ($type == 0) {
            $query = "select p1.name, sum(b1.quantity)
                        from test_project.product p1, test_project.basket b1";  
                        if ($dept != "ALL")
                            $query = $query ." ,test_project.department d1 ";
                        if ($store != 0)
                            $query = $query .",test_project.invoice i1 ";
                        $query = $query ." where p1.sku = b1.sku ";
                        if ($store != 0){    
                            $query = $query." and b1.invoice_number = i1.invoice_number
                                and i1.store_id = ".$store." ";
                        }
                        if ($dept != "ALL") {
                            $query = $query." and p1.dept_id = d1.dept_id
                                              and d1.name = '".$dept."'";
                            
                        }
                        $query = $query." group by p1.name 
                        having sum(b1.quantity) >= All(
                                                        select sum(b.quantity)
                                                        from test_project.product p, test_project.basket b ";
                                                        if ($dept != "ALL")
                                                            $query = $query ." ,test_project.department d ";
                                                        if ($store != 0)
                                                            $query = $query ." ,test_project.invoice i ";
                                                        $query = $query ."where p.sku = b.sku ";
                                                        if ($store != 0){    
                                                            $query = $query."and b.invoice_number = i.invoice_number
                                                                and i.store_id = ".$store." ";
                                                        }
                                                        if ($dept != "ALL") {
                                                            $query = $query." and p.dept_id = d.dept_id
                                                                            and d.name = '".$dept."'";
                                                        }
                                                        
                                                        $query .= " group by p.sku
                                                        )";
       
        } elseif ($type == 1) {
            $query = "select distinct p.name, p.sale_price
                        from test_project.product p, test_project.invoice i, test_project.basket b";
                        if ($dept != "ALL")
                            $query.=", test_project.department d";
                        $query .= " where p.sku = b.sku
                        and i.invoice_number = b.invoice_number
                        and (i.type = 'cash')";
                        if ($store != 0)
                            $query .= " and i.store_id = ".$store."";
                        
                        if ($dept != "ALL"){
                            $query.= " and p.dept_id = d.dept_id
                                        and d.name = '".$dept."'";
                        }
                        $query .= " order by p.name Asc, p.sale_price";
        } elseif ($type == 2) {
            $query = "select p1.name, p1.sale_price
                        from test_project.product p1";
                        if ($dept != "ALL")
                            $query .= ", test_project.department d";
                        $query .= " where p1.sku not in (
                                            select b2.sku 
                                            from test_project.basket b2";
                                        if($store != 0) {
                                            $query .= ", test_project.invoice i
                                            where b2.invoice_number = i.invoice_number
                                            and i.store_id = ".$store."";
                                        }
                                        $query.=")";
                        if ($dept != "ALL") {
                            $query.= " and p1.dept_id = d.dept_id
                            and d.name = '".$dept."'";
                        }
                        $query.= " group by p1.name, p1.sale_price
                        order by p1.name Asc, p1.sale_price";
        }elseif ($type == 3) {
            $query = "select distinct p.name, p.sale_price
                        from test_project.product p, test_project.invoice i, test_project.basket b";
                        if ($dept != "ALL")
                            $query.=", test_project.department d";
                        $query .= " where p.sku = b.sku
                        and i.invoice_number = b.invoice_number
                        and (i.type = 'Gift Card')";
                        if ($store != 0)
                            $query .= " and i.store_id = ".$store."";
                        
                        if ($dept != "ALL"){
                            $query.= " and p.dept_id = d.dept_id
                                        and d.name = '".$dept."'";
                        }
                        $query .= " order by p.name Asc, p.sale_price";
            
        }elseif ($type == 4) {
            $query = "select p1.name, temp.quantity, p1.sale_price
                        from test_project.product p1, (
                        select b1.sku as id,sum(b1.quantity) as quantity
                        from test_project.basket b1, test_project.invoice i
                        where b1.quantity < 0 ";
                        if ($store !=0) {
                            $query = $query ."and i.store_id = ".$store." ";
                        }
                        $query = $query ."
                        and i.invoice_number = b1.invoice_number 
                        and b1.sku in (select p.sku
                        from test_project.department d, test_project.product p
                        where d.dept_id = p.dept_id ";
                        if ($dept != "ALL")
                            $query = $query ."and d.name = '".$dept."')";
                        else 
                            $query = $query .") ";
                        $query = $query ." group by b1.sku
                        having sum(b1.quantity) <= ALL(select sum(b5.quantity)
                        from test_project.basket b5, test_project.invoice i5
                        where b5.quantity < 0 ";
                        if ($store !=0)
                            $query = $query ."and i5.store_id = ".$store." ";
                        $query = $query ." 
                        and i5.invoice_number = b5.invoice_number 
                        and b5.sku in (select p6.sku
                        from test_project.department d6, test_project.product p6
                        where d6.dept_id = p6.dept_id ";
                        if ($dept != "ALL")
                            $query = $query ."and d6.name = '".$dept."') ";
                        else 
                            $query = $query .") ";
                        $query = $query ." 
                        group by b5.sku)
                        ) as temp
                        where p1.sku = temp.id";
            
        }elseif ($type == 5) {
            $query = "select distinct p.name, p.sale_price
                        from test_project.product p, test_project.invoice i, test_project.basket b";
                        if ($dept != "ALL")
                            $query.=", test_project.department d";
                        $query .= " where p.sku = b.sku
                        and i.invoice_number = b.invoice_number
                        and (i.type = 'Visa' or i.type = 'MasterCard' or i.type = 'American Express')";
                        if ($store != 0)
                            $query .= " and i.store_id = ".$store."";
                        
                        if ($dept != "ALL"){
                            $query.= " and p.dept_id = d.dept_id
                                        and d.name = '".$dept."'";
                        }
                        $query .= " order by p.name Asc, p.sale_price";
        }
        $result = pg_query($dbconn, $query);
    
        if(!$result){
                die("Error in SQL query:" .pg_last_error());
        }
        $row_parity = 1;

        echo '<table class = "customer_result">
            <tr class = "even">
                <th>No</th>
                <th>Product Name</th>';
                if ($type == 0 || $type == 4)
                	echo '<th>Quantity</th>';
                else
                	echo '<th>Price</th>';
               if ($type == 4)
               	echo '<th>Price</th>';
        echo '</tr>';
        while($row = pg_fetch_array($result)) {
            if ($row_parity%2 == 1) {
                echo '<tr class = "odd">
                        <td>'.$row_parity.'</td>
                        <td>'.$row[0].'</td>';
                        if ($type == 0 || $type == 4){
                			echo '<td>'.$row[1].'</td>';
                			if ($type == 4)
               					echo '<td>$'.$row[2].'</td>';
                        }else
                			echo '<td>$'.$row[1].'</td>';
                    echo '</tr>';
            } else {   
                echo '<tr class = "even">
                        <td>'.$row_parity.'</td>
                        <td>'.$row[0].'</td>';
                        if ($type == 0 || $type == 4){
                			echo '<td>'.$row[1].'</td>';
                			if ($type == 4)
               					echo '<td>$'.$row[2].'</td>';
                        }else
                			echo '<td>$'.$row[1].'</td>';
                    echo '</tr>';
            }
            $row_parity += 1;
        }
        echo '</table>';
        
    } elseif ($q == 10) {
        $dept = $_GET["d"];

        $query1 = "select distinct p.category 
                  from test_project.product p";
        if ($dept) {
            if ($dept != 'ALL') {   
                $query1 = $query1.", test_project.department dp  
                                  where dp.name = '$dept' 
                                  and dp.dept_id = p.dept_id";
            } else {
                /*$query1 = $query1.", test_project.department dp  
                                  where dp.dept_id = p.dept_id 
                                  group by dp.name";*/
                
            }
        }
        $result = pg_query($dbconn, $query1);
        
        if(!$result){
                die("Error in SQL query:" .pg_last_error());
        }
        echo '<form id="cat_form">
                    Categories Name:
                    <select name="cats" onchange="prodsearch(1)">
                        <option value="">
                            Select a Category:
                        </option>';
        while($row = pg_fetch_array($result)) {
            echo '<option value="'.$row[0].'">'.
                            $row[0].
                '</option>';
        }          
        echo '  </select>
              </form>';
        
    } elseif ($q == 11) {
        $dept = $_GET["d"];

        $query1 = "select distinct p.name 
                  from test_project.product p";
        if ($dept) {
            if ($dept != 'All') {   
                $query1 = $query1." where p.category = '$dept'";
            } else {
                $query1 = $query1.", test_project.department dp  
                                  where dp.dept_id = p.dept_id 
                                  group by dp.name";
                
            }
        }
        $result = pg_query($dbconn, $query1);
        
        if(!$result){
                die("Error in SQL query:" .pg_last_error());
        }
        $row_parity = 1;
        echo '<form id="pro_form">
                    Product Name:
                    <select name="pnames" onchange="prodsearch(2)">
                        <option value="">
                            Select a Product:
                        </option>';
        while($row = pg_fetch_array($result)) {
            echo '<option value="'.$row[0].'">'.
                            $row[0].
                '</option>';
        }          
        echo '  </select>
              </form>';
    }elseif ($q == 12) {
        $cat = $_GET["d"];

        $query = "select p.*, temp.mtime
                  from test_project.product p, 
                        (select b.sku as id, max(i.time) as mtime
                         from test_project.invoice i, test_project.basket b
                         where i.invoice_number = b.invoice_number
                         and b.sku in(select p.sku
                                      from test_project.product p
                                      where p.category = '".$cat."')
                         group by b.sku) as temp
                  where p.sku = temp.id";

        $result = pg_query($dbconn, $query);
        
        if(!$result){
                die("Error in SQL query:" .pg_last_error());
        }
        
        $row_parity = 1;
        
        echo '<table class = "customer_result">
                <tr class = "even">
                    <th>No</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Last Purchased Date and Time</th>
                </tr>';
        while($row = pg_fetch_array($result)) {
            if($row_parity%2 == 1) {
                echo '<tr class="odd">
                        <td>'.$row_parity.'</td>
                        <td>'.$row[2].'</td>
                        <td>$'.$row[4].'</td>
                        <td>'.$row[5].'</td>
                        <td>'.$row[6].'</td>
                      </tr>';
            } else {
                echo '<tr class="even">
                        <td>'.$row_parity.'</td>
                        <td>'.$row[2].'</td>
                        <td>$'.$row[4].'</td>
                        <td>'.$row[5].'</td>
                        <td>'.$row[6].'</td>
                      </tr>';
            }
            $row_parity += 1;
        }          
        echo '</table>';
        
    } elseif ($q == 13) {
        $prod = $_GET["d"];

        $query = "select * 
                  from test_project.product p";
        if ($prod) {
            $query = $query." where p.name = '$prod'";
        }
        $result = pg_query($dbconn, $query);
        
        if(!$result){
                die("Error in SQL query:" .pg_last_error());
        }
        
        $temp = '/Applications/MAMP/htdocs/PhpProject1/tmp.jpg';

        
        $row_parity = 1;
        echo '<table class = "customer_result">
            <tr class = "even">
                <th>No</th>
                <th>Image</th>
                <th>Product Name</th>
                <th>Product Description</th>
                <th>Price</th>
            </tr>';
        while($row = pg_fetch_array($result)) {
            echo '<tr class = "odd">
                        <td>'.$row_parity.'</td>
                        <td>';
            			$query = "select lo_export(image, '".$temp."') from test_project.image where sku = ".$row[0]."";
						$iresult = pg_query($query);
        				while ($line = pg_fetch_array($iresult))
					    {
					        $ctobj = $line["image"];
					        echo "<IMG SRC=show.php>";
					        printf ("<br/>".$line["name"]." - ".$line["day"]." ");
					    }
            			echo '</td>
                        <td>'.$row[2].'</td>
                        <td>'.$row[3].'</td>
                        <td>$'.$row[4].'</td>
                    </tr>';
        }
        echo '</table>';
        
    }
?>
