<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Manager Home</title>
        <script type="text/javascript">
            function updateContent(str) {
                if (str=="") {
                    document.getElementById("content").innerHTML = "";
                    return;
                }
                switch (str) {
                    case 'Departments':
                        s = "departmentmanagement.php";
                        break;
                    case 'Customers':
                        s = "customermanagement.php";
                        break;
                    case 'Products':
                        s = "productmanagement.php";
                        break;
                    case 'Cashiers':
                        s = "cashiermanagement.php";
                        break;
                    case 'Stores':
                        s = "storemanagement.php";
                        break;
                    default :
                        s = "<h3>" + "0 " + str + "</h3>";
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
            
            function custsearch(str) {
                if (str == 0) {
                    var f = document.forms["cis_form"]["ifirstname"].value;
                    var l = document.forms["cis_form"]["ilastname"].value;
                    var e = document.forms["cis_form"]["iemail"].value;
                    
                    var s = "q=0";
                    if (f != null && f != "") {
                        s = s + "&f=" + f;
                        if (l != null && l != "") {
                            s = s + "&l=" + l;
                            if (e != null && e != "") {
                                s = s + "&e=" + e;
                            }
                        } else if (e != null && e != "") {
                                s = s + "&e=" + e;
                        }
                    } else if (l != null && l != "") {
                        s = s + "&l=" + l;
                        if (e != null && e != "") {
                            s = s + "&e=" + e;
                        }
                    }else if (e != null && e != "") {
                            s = s + "&e=" + e;
                    }
                } else if (str == 1) {
                    var min = document.forms["iis_form"]["imin"].value;
                    var max = document.forms["iis_form"]["imax"].value;
                    var qtype = document.forms["iis_form"]["qtype"];

                    for (var i=0; i < qtype.length; i++)
		    {
		        if (qtype[i].checked)
			 {
			        var rad_val = qtype[i].value;
			 }
		    }
                    
                    var s = "q=1";  
                    
                    if (rad_val != null && rad_val != "") {
                        s = s +"&ty=" + rad_val;
                    }else {
                        alert("You must select a type for the query!");
                        return; 
                    }
                    
                    if (min != null && min != "") {
                        s = s +"&min=" + min;
                    } else {
                        alert("You must enter a min for the query!");
                        return; 
                    }
                    if (max != null && max != "") {
                        s = s +"&max=" + max;
                    }else {
                        alert("You must enter a max for the query!");
                        return; 
                    }

                    
                } else if (str == 2) {
                    var b = document.forms["bis_form"]["ibilling"].value;
                    var l = document.forms["bis_form"]["customers"].value;
                    var s = "q=2";
                    if ((b == null || b =="") && (l == null || l == "")) {
                        alert("You must select a type for the query!");
                        return; 
                    }
                    if (b != null && b != "") {
                            s = s + "&b=" + b;
                    } else if ( l != null && l != ""){
                            s = s + "&l=" + l;
                    }
                } else {
                    var b = document.forms["pis_form"]["iproduct"].value;
                    var s = "q=3";
                    if (b != null && b != "") {
                        s = s + "&b=" + b;
                    } else {
                        alert("You must enter a product name for the query!");
                        return; 
                    }
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
                xmlhttp.open("GET","customersearch.php?"+s, true);
                xmlhttp.send();
            }
            
            function prodsearch(str) {
                if (str == 0) {
                    var d = document.forms["dis_form"]["depts"].value;
                    var s = "q=0";

                    if (d != null && d != "") {
                        s = s + "&d=" + d;
                    } else {
                        alert("You must select a department for the query!");
                        return;  
                    }
                } else {
                    var s = "q=1";
                    var stype = document.forms["saleis_form"]["stype"];
                    var store = document.forms["saleis_form"]["stores"].value;
                    var dept = document.forms["saleis_form"]["deptsname"].value;
                
                    for (var i=0; i < stype.length; i++) {
                        if (stype[i].checked)
                            {
                                var rad_val = stype[i].value;
                         }
                    }
                    if (rad_val != null && rad_val != "") {
                            s = s +"&ty=" + rad_val;
                    } else {
                        alert("You must select a type for the query!");
                        return;
                    }
                    if (store != null && store != "") {
                            s = s +"&st=" + store;
                    } else {
                        alert("You must select a store for the query!");
                        return;  
                    }
                    if (dept != null && dept != "") {
                            s = s +"&dp=" + dept;
                    }else {
                        alert("You must select a department for the query!");
                        return; 
                    }
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
                xmlhttp.open("GET","productsearch.php?"+s, true);
                xmlhttp.send();
            }
            
            function cashsearch() {
                var d = document.forms["cais_form"]["ireturn"].value;
                var s = "q=0";
                
                if (d != null && d != "") {
                    s = s + "&d=" + d;
                }else {
                    alert("You must enter a number for the query!");
                    return; 
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
                xmlhttp.open("GET","cashiersearch.php?"+s, true);
                xmlhttp.send();

            }
            
            function storsearch() {
                var qtype = document.forms["sis_form"]["qtype"];
                var s = "q=0";
                
                for (var i=0; i < qtype.length; i++) {
                    if (qtype[i].checked)
                        {
                            var rad_val = qtype[i].value;
                     }
                }
                if (rad_val != null && rad_val != "") {
                        s = s +"&ty=" + rad_val;
                } else {
                    alert("You must select a type for the query!");
                    return; 
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
                xmlhttp.open("GET","storesearch.php?"+s, true);
                xmlhttp.send();
            }
            
            function addcashier() {
                var f = document.forms["cashadd_form"]["ifname"].value;
                var l = document.forms["cashadd_form"]["ilname"].value;
                var sin = document.forms["cashadd_form"]["isin"].value;
                var a = document.forms["cashadd_form"]["iaddress"].value;
                var c = document.forms["cashadd_form"]["icity"].value;
                var p = document.forms["cashadd_form"]["ipc"].value;
                var ph = document.forms["cashadd_form"]["iphone"].value;
                
                if (f == null || f == "") {
                    alert("First name must be filled out");
                    return false;
                } else if (l == null || l == "") {
                    alert("Last name must be filled out");
                    return false;
                } else if (sin == null || sin == "") {
                    alert("SIN must be filled out");
                    return false;
                } else if (a == null || a == "") {
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
                s = "addcashier.php?";
                s = s +"a=" + a + "&c=" + c + "&p=" + p + "&ph=" + ph;
                s = s +"&f=" + f + "&l=" + l + "&sin=" + sin;
                
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
            
            function adddept() {
                var n = document.forms["deptadd_form"]["idepname"].value;
                var d = document.forms["deptadd_form"]["ideptdesc"].value;
                
                if (n == null || n == "") {
                    alert("Department name must be filled out");
                    return false;
                } else if (d == null || d == "") {
                    alert("Department description must be filled out");
                    return false;
                }
                s = "adddept.php?";
                s = s +"&n=" + n + "&d=" + d;
                
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
   

