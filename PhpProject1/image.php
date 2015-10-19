<?php
$uploaddir = '/Applications/MAMP/htdocs/PhpProject1/';
$uploadfile = $uploaddir.basename($_FILES['userfile']['name']);
//echo "uploadfile = '$uploadfile'\n";
$name = $_POST['name'];
//echo "'name = $name'\n";

if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {    
	echo "File is valid.\n";
} else   {   
	echo "File size greater than 300kb!\n\n";   
}

echo "'$name'\n";
$test = 'large';

    $conn_string = "host=localhost port=5432 dbname=postgres user=postgres password=postgres";
    $dbconn = pg_connect($conn_string) or die('Connection failed');$name = $_POST['name'];
    
    //$query = "INSERT INTO test_project.StoreDepartment VALUES (2, 6, '".$test."')";
    $query = "insert into test_project.image values ('".$name."', lo_import('".$uploadfile."'))";
    
	$result = pg_query($query);

if($result)
{
    echo "File was successfully uploaded.\n";
    unlink($uploadfile);
}
else
{
    echo "Filename already exists. Use another filename. Enter all the values.";
    unlink($uploadfile);
}
pg_close($dbconn);
?>