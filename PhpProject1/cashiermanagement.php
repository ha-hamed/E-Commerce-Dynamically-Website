<?php
    echo '
        <div>
            <form id="cais_form" name="cais_form">
                <fieldset>
                    <legend>Cashier Information</legend>
                    <table>
                        <tr>
                            <td>
                                No. of Return Handled:
                                <input type="text" size="10" 
                                name="ireturn" id="ireturn"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="button" name="searchpcai" 
                                value="Search" onclick = "cashsearch()"/>
                            </td>
                        </tr>
                    </table>
                </fieldset>
            </form>
            <form id="cashadd_form" name="cashadd_form">
                <fieldset>
                    <legend>Add New Cashier</legend>
                    <table>
                            <tr>
                                <td><label for="ifname">First Name: </label></td>
                                <td><input name="ifname" type="text" id="ifname"/></td>
                                <td><label for="ilname">Last Name: </label></td>
                                <td><input name="ilname" type="text" id="ilname"/></td>        
                                <td><label for="isin">SIN Number: </label></td>
                                <td><input name="isin" type="text" id="isin"/></td>        
                            </tr>
                            <tr>
                                <td><label for="iaddress">Address: </label></td>
                                <td colspan="2"><input name="iaddress" type="text" id="iaddress" size="50"/></td>
                            </tr>
                            <tr>
                                <td><label for="icity">City: </label></td>
                                <td><input name="icity" type="text" id="icity"/></td>
                                <td><label for="ipc">Postal Code</label></td>
                                <td><input name="ipc" type="text" id="ipc"/></td>        
                                <td><label for="iphone">Phone Number: </label></td>
                                <td><input name="iphone" type="text" id="iphone"/></td>        
                            </tr>
                            <tr>
                                <td><input type="button" name="save" value="Create"
                                        onclick="addcashier()"/></td>
                            </tr>               
                        </table>
                </fieldset>
            </form>
        </div>';
?>