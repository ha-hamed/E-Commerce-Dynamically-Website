<?php
    session_start();
    if(!isset($_SESSION['cust_id'])) {
        echo "Please"."<a href='index.php'>Login</a>";
        exit;
    } else if($_SESSION['cust_id'] == 10001) {
        include 'managerhome.php';
    } else {
        include 'userhome.php';
    }
?>  