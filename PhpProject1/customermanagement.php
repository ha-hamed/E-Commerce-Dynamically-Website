<?php
//openning connection
    $conn_string = "host=localhost port=5432 dbname=postgres user=postgres password=postgres";
    $dbconn = pg_connect($conn_string) or die('Connection failed');
    
    $minquery = "select min(i.price)
                 from test_project.invoice i";
    $maxquery = "select max(i.price)
                 from test_project.invoice i";
    $avgquery = "select avg(i.price)
                 from test_project.invoice i";
    
    $minresult = pg_query($dbconn, $minquery);

    if(!$minresult){
            die("Error in SQL query:" .pg_last_error());
    }
    
    $maxresult = pg_query($dbconn, $maxquery);

    if(!$maxresult){
            die("Error in SQL query:" .pg_last_error());
    }
    $avgresult = pg_query($dbconn, $avgquery);

    if(!$avgresult){
            die("Error in SQL query:" .pg_last_error());
    }
    $minrow = pg_fetch_array($minresult);
    $maxrow = pg_fetch_array($maxresult);
    $avgrow = pg_fetch_array($avgresult);
    $avgrow[0] += 1;
    $avgrow[0] -= 1; 
    
    
echo '
<div>
    <table>
        <tr>
            <td>
                <form id="cis_form" name="cis_form">
                    <fieldset>
                        <legend>Personal Information</legend>
                        <table>
                            <tr>
                                <td><label for="ifirstname">First name: </label></td>
                                <td>
                                    <input name="ifirstname" type="text" id="ifirstname"/>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="ilastname">Last name: </label></td>
                                <td>
                                    <input name="ilastname" type="text" id="ilastname"/>
                                </td>        
                            </tr>
                            <tr>
                                <td><label for="iemail">Email:</label></td>
                                <td>
                                    <input name="iemail" id="iemail" type="text"/>
                                </td>
                            </tr> 
                            <tr>
                                <td>
                                    <input type="button" name="searchci" 
                                    value="Search" onclick = "custsearch(0)"/>
                                </td>
                            </tr>
                        </table>
                    </fieldset>
                </form>
            </td>
            <td>
                <form id="iis_form" name="iis_form">
                    <fieldset>
                        <legend>Invoice Information</legend>
                        <table>
                            <tr>
                                <td>
                                    <input name="qtype" type="radio" id="qtype" 
                                    value="0"/>
                                    Have an Invoice Between:
                                </td>
                                <td>
                                    Max invoice: $'.$maxrow[0].'
                                </td>
                                
                            </tr>
                            <tr>
                                <td>
                                    <input name="qtype" type="radio" id="qtype" 
                                    value="1"/>
                                    Do Not Have Any Invoice Between:
                                </td>
                                <td>
                                    Avg invoice: $'.$avgrow[0].'
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input name="imin" id="imin" type="text" size="12"/>
                                    And 
                                    <input name="imax" id="imax" type="text"size="12"/>
                                </td>
                                <td>
                                    Min invoice: $'.$minrow[0].'
                                </td>
                            </tr> 
                            <tr>
                                <td>
                                    <input type="button" name="searchci" 
                                    value="Search" onclick = "custsearch(1)"/>
                                </td>
                            </tr>
                        </table>
                    </fieldset>
                </form>
            </td>
         </tr>
         <tr>
            <td>
                <form id="bis_form" name="bis_form">
                    <fieldset>
                        <legend>Billing Information</legend>
                        <table>
                            <tr>
                                <td>
                                    <label for="ibilling">No. Billing Type: </label>
                                </td>
                                <td>
                                    <input name="ibilling" type="text" id="ibilling"/>
                                </td>
                            </tr>
                            <tr>
                                <td>Customer Name:</td>
                                <td>
                                    <select name="customers">
                                        <option value="">
                                            Select a Department:
                                        </option>';
                                        include 'custnames.php';
                                        echo '
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><br/></td>
                                <td><br/></td>
                            </tr> 
                            <tr>
                                <td>
                                    <input type="button" name="searchci" 
                                    value="Search" onclick = "custsearch(2)"/>
                                </td>
                            </tr>
                        </table>
                    </fieldset>
                </form>    
            </td>
            <td>
                <form id="pis_form" name="pis_form">
                    <fieldset>
                        <legend>Product Information</legend>
                        <table>
                            <tr>
                                <td><label for="iproduct">Product Name: </label></td>
                                <td>
                                    <input name="iproduct" type="text" id="iproduct"/>
                                </td>
                            </tr>
                            <tr>
                                <td><br/></td>
                                <td><br/></td>
                            </tr>
                            <tr>
                                <td><br/></td>
                                <td><br/></td>
                            </tr> 
                            <tr>
                                <td>
                                    <input type="button" name="searchci" 
                                    value="Search" onclick = "custsearch(3)"/>
                                </td>
                            </tr>
                        </table>
                    </fieldset>
                </form>    
            </td>
         </tr>
    </table>
</div>';
?>

