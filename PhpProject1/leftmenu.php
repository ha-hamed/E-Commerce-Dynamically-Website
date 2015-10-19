<?php 
    if(!isset($_SESSION['cust_id'])) {
            echo "Please"."<a href='index.php'>Login</a>";
            exit;
        } else if($_SESSION['cust_id'] == 10001) {?>
    <ul>
 		<li onclick = "updateContent('Management Menu')"><b style="color:#A0522D">Management Menu</b></li>   
        <li onclick = "updateContent('Departments')"><i>Departments</i></li>
        <li onclick = "updateContent('Customers')"><i>Customers</i></li>
        <li onclick = "updateContent('Products')"><i>Products</i></li>
        <li onclick = "updateContent('Cashiers')"><i>Cashiers</i></li>
        <li onclick = "updateContent('Stores')"><i>Stores</i></li>
    </ul>
<?php } else { ?>
    <ul>
    	<b onclick = "updateContent('User Menu')" style="color:#A0522D">User Menu</b>
        <li onclick = "updateContent('BillingAddress')">Billing Address</li>
        <!--li onclick = "updateContent('Computers and Software')">Computers and Software</li>
        <li onclick = "updateContent('TV and Home Theatre')">TV and Home Theatre</li>
        <li onclick = "updateContent('Cameras and Camcorders')">Cameras and Camcorders</li>
        <li onclick = "updateContent('Gaming')">Gaming</li>
        <li onclick = "updateContent('Phones')">Phones</li>
        <li onclick = "updateContent('Movies and Music')">Movies and Music</li>
        <li onclick = "updateContent('Ipod and MP3 Players')">Ipod and MP3 Players</li>
        <li onclick = "updateContent('DJ Gear and Musical Instrument')">DJ Gear and Musical Instrument</li>
        <li onclick = "updateContent('GPS, Car and Marine Electronics')">GPS, Car and Marine Electronics</li>
        <li onclick = "updateContent('Home and Outdoor Living')">Home and Outdoor Living</li-->
    </ul>
<?php } ?>
