<?php

header("Content-type: image/jpeg");
$jpeg = fopen("/Applications/MAMP/htdocs/PhpProject1/tmp.jpg","r");
$image = fread($jpeg,filesize("/Applications/MAMP/htdocs/PhpProject1/tmp.jpg"));
echo $image;

?>