<?php

/* ==============================
   OLD LOCALHOST CONFIG (COMMENTED)
   ==============================
$con = mysqli_connect('localhost','root','','bridge_talent');
if(!$con){
    echo 'could not connect to the database';
}

$siteName='Woodways';
*/

/* ==============================
   NEW RAILWAY PRODUCTION CONFIG
   ============================== */

$host = "zephyr.proxy.rlwy.net";
$user = "root";
$password = "vwukUfsZVrYOjHdkSaIJzaTvsldRwXik";
$database = "railway";
$port = 58449;

$con = mysqli_connect($host, $user, $password, $database, $port);

if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

$siteName = "Woodways";

?>