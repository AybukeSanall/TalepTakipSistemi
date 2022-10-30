<?php
require"user_menu.php";

$host = "localhost";
$port = "5432";
$dbname = "signup";
$user = "postgres";
$password = "Zuhal1989."; 
$connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password} ";
$dbconn = pg_connect($connection_string); 
session_destroy();
header("Location:index.php");
?>