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
                    We have been Canada's number one stop for electronics for 
                    decades.
                    <br />
                    We strive to perfect our customers' in-store and online 
                    experience by 
                    <br />
                    providing top-notch assistance combined with a simple yet 
                    informative <br />
                    website.
                
            </div>
            <div class="footer "id="footer">
                Copyright © 2012 uOttawa.ca
            </div>
        </div>
    </body>
</html>