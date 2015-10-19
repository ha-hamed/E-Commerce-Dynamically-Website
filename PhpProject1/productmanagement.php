<?php
    echo '
    <div>
        <table>
            <tr>
                <td>
                    <form id="dis_form" name="dis_form">
                        <fieldset>
                            <legend>Department Information</legend>
                            <table>
                                <tr>
                                    <td>
                                        Department Name:
                                        <select name="depts">
                                            <option value="">
                                                Select a Department:
                                            </option>';
                                            include 'deptnames.php';
                                            echo '
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="button" name="searchpi" 
                                        value="Search" onclick = "prodsearch(0)"/>
                                    </td>
                                </tr>            
                            </table>
                        </fieldset>
                    </form>
                </td>
            </tr>
            <tr>
                <td>
                    <form id="saleis_form" name="saleis_form">
                        <fieldset>
                            <legend>Sale Information</legend>
                            <!--table>
                                <tr>
                                    <td-->
                                        <table>
                                            <tr>
                                                <td>
                                                    <input name="stype" type="radio" 
                                                        id="qtype" value="0"/>
                                                    Best Seller
                                                </td>
                                                <td>
                                                    <input name="stype" type="radio" 
                                                        id="qtype" value="1"/>
                                                    Bought With Cash
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input name="stype" type="radio" 
                                                        id="qtype" value="2"/>
                                                    Never Sold
                                                </td>
                                                <td>
                                                    <input name="stype" type="radio" 
                                                        id="qtype" value="3"/>
                                                    Bought With Gift Cards
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input name="stype" type="radio" 
                                                        id="qtype" value="4"/>
                                                    Highest Return Rate
                                                </td>
                                                <td>
                                                    <input name="stype" type="radio" 
                                                        id="qtype" value="5"/>
                                                    Bought With Credit Cards
                                                </td>
                                            </tr>
                                        <!--/table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    <table-->
                                    <tr>
                                    <td>
                                        <select name="stores">
                                            <option value="">Select a store:</option>
                                            <option value="0">ALL</option>
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
                                        </select>  
                                    </td>
                                    <td>
                                        <select name="deptsname">
                                            <option value="">
                                                Select a Department:
                                            </option>';
                                            include 'deptnames.php';
                                            echo '
                                        </select>
                                    </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="button" name="searchpi" 
                                            value="Search" onclick = "prodsearch(1)"/>
                                        </td>
                                    </tr>
                                    </table>
                                    <!--/td>
                                </tr>
                                <tr> 
                                <tr>
                                    <td>
                                        <input type="button" name="searchpi" 
                                        value="Search" onclick = "prodsearch(1)"/>
                                    </td>
                                </tr-->
                            </table>
                        </fieldset>
                    </form>
                </td>
            </tr>
        </table>
    </div>';
?>


