<?php
    session_start();
    if(array_key_exists('login',$_POST)) {
        $username = $_POST['iusername'];
        $password = $_POST['ipassword'];
        
    $conn_string = "host=localhost port=5432 dbname=postgres user=postgres password=postgres";
    $dbconn = pg_connect($conn_string) or die('Connection failed');

        $query = "SELECT * 
                    FROM test_project.customer 
                    WHERE email = '$username' AND password = '$password'";

        $result = pg_query($dbconn, $query);

        if(!$result){
            die("Error in SQL query:" .pg_last_error());
        }

        $row_count = pg_num_rows($result);

        if($row_count > 0) {
            $myrow = pg_fetch_assoc($result);
            $_SESSION['cust_id'] = $myrow['cust_id'];
            $header = header("Location: http://localhost:8888/phpproject1/home.php");
            exit;
        }
        echo "Wrong username or password ". "<a href='index.php'>login now</a>";
        //free memory
        pg_free_result($result);
        //close connection
        pg_close($dbconn);
    }
?>
