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
        <title>Search</title>
        <script type="text/javascript">
            function prodsearch(str) {
                if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp=new XMLHttpRequest();
                } else {// code for IE6, IE5
                    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
                if (str == 0) {
                    var d = document.forms["search_form"]["depts"].value;
                    var s = "q=10";
                    if (d != null && d != "") {
                            s = s + "&d=" + d;
                    }
                    xmlhttp.onreadystatechange=function() {
                        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                            document.getElementById("pt").innerHTML = xmlhttp.responseText;
                            document.getElementById("ct").innerHTML = "";
                            document.getElementById("rt").innerHTML = "";
                        }
                    }
                } else if (str == 1) {
                    var d = document.forms["cat_form"]["cats"].value;
                    <?php if ($_SESSION['cust_id'] != 10001) {?>
                        var s = "q=11";
                        xmlhttp.onreadystatechange=function() {
                        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                            document.getElementById("ct").innerHTML = xmlhttp.responseText;
                        }
                    }
                    <?php }
                    else if ($_SESSION['cust_id'] == 10001){?>
                        var s = "q=12";
                        xmlhttp.onreadystatechange=function() {
                        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                            document.getElementById("rt").innerHTML = xmlhttp.responseText;
                        }
                    }
                    <?php }?>
                    if (d != null && d != "") {
                            s = s + "&d=" + d;
                    }
                    /*xmlhttp.onreadystatechange=function() {
                        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                            document.getElementById("ct").innerHTML = xmlhttp.responseText;
                        }
                    }*/
                } else if (str == 2) {
                    var d = document.forms["pro_form"]["pnames"].value;
                    var s = "q=13";
                    if (d != null && d != "") {
                        s = s + "&d=" + d;
                    }                     
                    xmlhttp.onreadystatechange=function() {
                        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                            document.getElementById("rt").innerHTML = xmlhttp.responseText;
                        }
                    }
                }
                xmlhttp.open("GET","productsearch.php?"+s, true);
                xmlhttp.send();
            }
        </script>
    </head>
    <body>

        <div class="container" id="container">

            <div class="header" id="header">
                <h1>Welcome to Belimed!</h1>
            </div>
            
            <div class="title_menu" id="title_menu">
                <?php include 'titlemenu.php'; ?>
            </div>
            <div class="department">
                <form id="search_form">
                    Department Name:
                    <select name="depts" onchange="prodsearch(0)">
                        <option value="">
                            Select a Department:
                        </option>
                        <?php include 'deptnames.php'; ?>
                    </select>
                </form>
            </div>
            <div class="category" id ="pt"></div>
            <div class="category" id ="ct"></div>
            <div class="result" id ="rt"></div>
            <div class="footer "id="footer">
                Copyright © 2012 uOttawa.ca
            </div>
        </div>
    </body>
</html>
