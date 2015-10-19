<?php
//Add New Record
if(array_key_exists('save',$_POST)) {
    $custid = 1;
    $firstname = $_POST['ifirstname'];
    $lastname = $_POST['ilastname'];
    $password = $_POST['ipassword'];
    $email = $_POST['iemail'];
    
    //openning connection
    $conn_string = "host=localhost port=5432 dbname=postgres user=postgres password=postgres";
    $dbconn = pg_connect($conn_string) or die('Connection failed');
    
    //generating cust_id based on the maxium cust_id on the database
    $id_query = "SELECT MAX(c.cust_id) as m
                 FROM test_project.customer c";
    $id = pg_query($dbconn, $id_query);
    
    if (!$id) { 
        die("Error in SQL query:" .pg_last_error());
    }
    $myrow = pg_fetch_assoc($id);
    $custid += $myrow['m'];
    
    // inserting customer into customer table
    
    $insert_query = "INSERT INTO test_project.customer
    (cust_id, last_name, first_name, password, email) VALUES 
    ('$custid','$lastname', '$firstname','$password','$email')";

    $result = pg_query($dbconn, $insert_query);
    
    if(!$result){
            die("Error in SQL query:" .pg_last_error());
    }
    //header('http://localhost:8888/PhpProject1/userhome.php');
    echo "Customer Successfully Registered";
    include 'index.php';
    //free memory
    pg_free_result($result);
    
    //close connection
    pg_close($dbconn);
}
?>
