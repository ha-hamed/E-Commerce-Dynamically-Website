<?php

    $conn_string = "host=localhost port=5432 dbname=postgres user=postgres password=postgres";
    $dbconn = pg_connect($conn_string) or die('Connection failed');
    
$name = $_POST['name'];
$temp = '/Applications/MAMP/htdocs/PhpProject1/tmp.jpg';

$query = "select lo_export(image, '".$temp."') from test_project.image where sku = ".$name."";
$result = pg_query($query);
//echo "name = $name \n \n";
//echo "temp = $temp\n";
//echo "query = $query\n";

if($result)
{
    while ($line = pg_fetch_array($result))
    {
        $ctobj = $line["image"];
        echo "<IMG SRC=show.php>";
        printf ("<br/>".$line["name"]." - ".$line["day"]." ");
    }

}
else { echo "File does not exists."; }
pg_close($dbconn);

?>