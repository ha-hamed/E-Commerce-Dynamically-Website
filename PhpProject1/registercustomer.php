<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Register</title>
        
        <script type="text/javascript">
            function validate() {
                var f = document.forms["register_form"]["ifirstname"].value;
                var l = document.forms["register_form"]["ilastname"].value;
                var p = document.forms["register_form"]["ipassword"].value;
                var c = document.forms["register_form"]["iconfpass"].value;
                var e = document.forms["register_form"]["iemail"].value;
                if (f == null || f == "") {
                    alert("First name must be filled out");
                    return false;
                } else if (l == null || l == "") {
                    alert("Last name must be filled out");
                    return false;
                } else if (p == null || p == "") {
                    alert("Password must be filled out");
                    return false;
                } else if (c == null || c == "") {
                    alert("Confirm password must be filled out");
                    return false;
                } else if (c != p) {
                    alert("Confirm password and password must be the same");
                    return false;
                } else if (e == null || e == "") {
                    alert("Email must be filled out");
                    return false;
                }
                return true;
            }
        </script>
        
        
    </head>
    <body>
        <div class="register_box">
            <form id="register_form" name="register_form" action="addcustomer.php"
                  method="POST" onsubmit="return validate()">
                <table>
                    <tr>
                        <td><label for="ifirstname">First name: </label></td>
                        <td><input name="ifirstname" type="text" id="ifirstname"/></td>
                    </tr>
                    <tr>
                        <td><label for="ilastname">Last name: </label></td>
                        <td><input name="ilastname" type="text" id="ilastname"/></td>        
                    </tr>
                    <tr>
                        <td><label for="ipassword">Password:</label></td>
                        <td><input name="ipassword" type="password" id="ipassword"/></td>
                    </tr>
                    <tr>
                        <td><label for="iconfpass">Confirm password:</label></td>
                        <td><input name="iconfpass" type="password" id="iconfpass"/></td>
                    </tr>
                    <tr>
                        <td><label for="iemail">Email:</label></td>
                        <td><input name="iemail" id="iemail" type="text"/></td>
                    </tr>   
                    <tr>
                        <td />
                        <td><input type="submit" name="save" value="Register"/></td>
                    </tr>               
                </table>
            </form>
        </div>
    </body>
</html>
