<?php
    echo '
        <form id="sis_form" name="sis_form">
            <fieldset>
                <legend>Store Information</legend>
                <table>
                    <tr>
                        <td>
                            <b>Find Store With:</b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input name="qtype" type="radio" id="qtype" value="0"/>
                            Most Customer Shop
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input name="qtype" type="radio" id="qtype" value="1"/>
                            Highest Sales
                        </td>
                        <td>
                            <!--select name="stores">
                                <option value="">Select a store:</option>
                                <option value="1">Online</option>
                                <option value="2">South Keys</option>
                                <option value="3">Behzad</option>
                                <option value="4">Ali</option>
                                <option value="5">Hamed</option>
                                <option value="6">Gloucester</option>
                                <option value="7">Orleans</option>
                                <option value="8">Kanata</option>
                                <option value="9">Hull</option>
                                <option value="10">Rideau</option>
                            </select-->
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="button" name="searchsi" 
                            value="Search" onclick = "storsearch()"/>
                        </td>
                    </tr>
                </table>
            </fieldset>
        </form>';
?>
