<?php
echo '
<div>
    <form id="deptadd_form" name="deptadd_form">
        <fieldset>
            <legend>Add New Department</legend>
            <table>
                    <tr>
                        <td><label for="idepname">Department Name: </label></td>
                        <td><input name="idepname" type="text" id="idepname" size="100"/></td>
                    </tr>
                    <tr>
                        <td><label for="ideptdesc">Department Description: </label></td>
                        <td><input name="ideptdesc" type="text" id="ideptdesc" size="100"/></td>        
                    </tr>   
                    <tr>
                        <td />
                        <td><input type="button" name="save" value="Create"
                                   onclick="adddept()"/></td>
                    </tr>               
                </table>
        </fieldset>
    </form>
</div>';
?>