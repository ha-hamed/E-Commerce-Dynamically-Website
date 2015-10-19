<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>User Home</title>
        <script type="text/javascript">
            function updateContent(str) {
                if (str=="") {
                    document.getElementById("content").innerHTML = "";
                    return;
                }
                switch(str) {
                    case 'BillingAddress' :
                        s = "billingaddress.php";
                        break;
                    case 'Computers & Software' :
                        s = "<h3>" +"1 " + str + "</h3>";
                        break;
                    case 'TV & Home Theatre' :
                        s = "<h3>" +"2 " + str + "</h3>";
                        break;
                    case 'Cameras & Camcorders' :
                        s = "<h3>" +"3 " + str + "</h3>";
                        break;
                    case 'Gaming' :
                        s = "<h3>" +"4 " + str + "</h3>";
                        break;
                    case 'Phones' :
                        s = "<h3>" +"5 " + str + "</h3>";
                        break;
                    case 'Movies & Music' :
                        s = "<h3>" +"6 " + str + "</h3>";
                        break;
                    case 'Ipod & MP3 Players' :
                        s = "<h3>" +"7 " + str + "</h3>";
                        break;
                    case 'DJ Gear & Musical Instrument' :
                        s = "<h3>" +"8 " + str + "</h3>";
                        break;
                    case 'GPS, Car & Marine Electronics' :
                        s = "<h3>" +"9 " + str + "</h3>";
                        break;
                    case 'Home & Outdoor Living' :
                        s = "<h3>" +"10 " + str + "</h3>";
                        break;
                    default :
                        s = "<h3>" +"0 " + str + "</h3>";
                        break;
                }
                if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp=new XMLHttpRequest();
                } else {// code for IE6, IE5
                    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange=function() {
                    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                        document.getElementById("content").innerHTML = xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET", s, true);
                xmlhttp.send();
            }
        
            function addbillingaddress(id) {
                var a = document.forms["addbilling_form"]["iaddress"].value;
                var c = document.forms["addbilling_form"]["icity"].value;
                var p = document.forms["addbilling_form"]["ipc"].value;
                var ph = document.forms["addbilling_form"]["iphone"].value;

                if (a == null || a == "") {
                    alert("Address must be filled out");
                    return false;
                } else if (c == null || c == "") {
                    alert("City must be filled out");
                    return false;
                } else if (p == null || p == "") {
                    alert("Postal Code must be filled out");
                    return false;
                } else if (ph == null || ph == "") {
                    alert("Phone Number must be filled out");
                    return false;
                }
                s = "addbillingaddress.php?";
                s = s +"a=" + a + "&c=" + c + "&p=" + p + "&ph=" + ph;
                
                if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp=new XMLHttpRequest();
                } else {// code for IE6, IE5
                    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange=function() {
                    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                        document.getElementById("content").innerHTML = xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET", s, true);
                xmlhttp.send();
            }
        </script>
        
    </head>
    <body>
        <table>
        <div class="container" id="container">

            <div class="header" id="header">
                <h1>Welcome to Belimed!</h1>
            </div>
            
            <div class="title_menu" id="title_menu">
                <?php include 'titlemenu.php'; ?>
            </div>

            <div class="menu" id="menu">
                <?php include 'leftmenu.php'; ?>
            </div>

            <div class="content" id="content">
            </div>

            <div class="footer "id="footer">
                Copyright © 2012 uOttawa.ca
            </div>

        </div>
        </table>
    </body>
</html>


