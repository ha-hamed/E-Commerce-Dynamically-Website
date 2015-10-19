<?php session_start();?>
<ul>
    <li><a href="home.php">Home</a></li>
    <li><a href="search.php">Search</a></li>
    <li><a href="aboutus.php">About Us</a></li>
    <li><a href="contactus.php">Contact Us</a></li>
    <?php if(!isset($_SESSION['cust_id'])) 
            echo'<li><a href="index.php">Log in</a></li>';
          else
            echo'<li><a href="logout.php">Log out</a></li>';
    ?>
</ul>
