<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Login Page</title>
        <script type="text/javascript">
            function validate() {
                var u = document.forms["login_form"]["iusername"].value;
                var p = document.forms["login_form"]["ipassword"].value;
                if (u == null || u == "") {
                    alert("Username must be filled out");
                    return false;
                } else if (p == null || p == "") {
                    alert("Password must be filled out");
                    return false;
                }
                return true;
            }
        </script>
    </head>
    <body> 
        <div class="login_box">
            <form   id="login_form" name="login_form" method="post"  
                    action="login.php" onsubmit="return validate()">
                <br />
                <br />
                <br />
                <table>
                    <tr>
                        <td><label for="iusername">Enter Your Email Address: </label></td>
                        <td><input name="iusername" type="text" id="iusername"/></td>
                    </tr>
                    <tr>
                        <td><label for="ipassword">Enter Your Password: </label></td>
                        <td><input name="ipassword" type="password" id="ipassword"/></td>
                    </tr>
                    <tr>
                        <td><a href="registercustomer.php">Join Now!</a></td>
                        <td><input name="login" type="submit" value="Login" id="login"/></td>
                    </tr>
                </table>
            </form>        
        </div>
    </body>
</html>
