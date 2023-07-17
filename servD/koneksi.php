<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbnm = "servdevice";
    $link = mysqli_connect($host,$user,$pass,$dbnm);
if (!$link) {
    die ("Database tidak dapat dibuka");
}
?>
