<?php
    session_start();
    //openning connection
    $conn_string = "host=localhost port=5432 dbname=postgres user=postgres password=postgres";
    $dbconn = pg_connect($conn_string) or die('Connection failed');
    
    $id = $_SESSION['cust_id'];
    
    $query = "select a.*
              from test_project.BillingAddress ba, test_project.address a
              where ba.address_id = a.address_id 
              and ba.cust_id = ".$id."
              order by a.address";
    //echo $query;
    $result = pg_query($dbconn, $query);

    if(!$result){
            die("Error in SQL query:" .pg_last_error());
    }
    $row_parity = 1;
    
    echo '<table class = "customer_result">
            <tr class = "even">
                <th>No</th>
                <th colspan="2">Address</th>
                <th>City</th>
                <th>Postal Code</th>
                <th>Phone Number</th>
            </tr>';
    while($row = pg_fetch_array($result)) {
        if ($row_parity%2 == 1) {
            //$row_parity += 1;
            echo '<tr class = "odd">
                    <td>'.$row_parity.'</td>
                    <td colspan="2">'.$row[1].'</td>
                    <td>'.$row[2].'</td>
                    <td>'.$row[4].'</td>
                    <td>'.$row[3].'</td>
                </tr>';
        } else {
            //$row_parity += 1;
            echo '<tr class = "even">
                    <td>'.$row_parity.'</td>
                    <td colspan="2">'.$row[1].'</td>
                    <td>'.$row[2].'</td>
                    <td>'.$row[4].'</td>
                    <td>'.$row[3].'</td>
                </tr>';
        }
        $row_parity += 1;
    }
    echo '</table>
        <br />
        <br />
        <br />
        <form id="addbilling_form" name="addbilling_form_form">
                <fieldset>
                    <legend>Add New Billing Address</legend>
                    <table>
                    <tr>
                        <td><label for="iaddress">Address: </label></td>
                        <td colspan="3"><input name="iaddress" type="text" id="iaddress" size="63"/></td>
                    </tr>
                    <tr>
                        <td><label for="icity">City: </label></td>
                        <td><input name="icity" type="text" id="icity"/></td>
                        <td><label for="ipc">Postal Code:</label></td>
                        <td><input name="ipc" type="text" id="ipc"/></td>        
                        <td><label for="iphone">Phone Number: </label></td>
                        <td><input name="iphone" type="text" id="iphone"/></td>        
                    </tr>
                    <tr>
                        <td><input type="button" name="save" value="Add"
                                onclick="addbillingaddress('.$id.')"/></td>
                    </tr>               
                </table>
        </fieldset>
    </form>'; 
?>
