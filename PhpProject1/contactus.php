<!DOCTYPE html>
<?php
session_start();
    if(!isset($_SESSION['cust_id'])) {
        echo "Please"."<a href='index.php'>Login</a>";
        exit;
    }
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>About us</title>
    </head>
    <body>

        <div class="container" id="container">

            <div class="header" id="header">
                <h1>Welcome to Belimed!</h1>
            </div>
            
            <div class="title_menu" id="title_menu">
                <?php include 'titlemenu.php'; ?>
            </div>
            <div class="about">
            		<br />
            		Please don't hesitate to contact us!
                    <br />
                    Our email address: admin@databaseproject.com
                    <br />
                    Our phone number: (613) 555-2121
            </div>
            <div class="footer "id="footer">
                Copyright © 2012 uOttawa.ca
            </div>
        </div>
    </body>
</html>