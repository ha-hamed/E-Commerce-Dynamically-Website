<?php
    session_start();
    session_destroy();
    $header = header("Location: http://localhost:8888/phpproject1/index.php");
?>
