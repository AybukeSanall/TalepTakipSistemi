<?php
$host = "localhost";
$port = "5432";
$dbname = "signup";
$user = "*****";
$password = "*****";
$connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password} ";
$dbconn = pg_connect($connection_string);
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/menu.css">
</head>
<body>
<?php
if($_SESSION['role']=='user'){
  echo"
<div class='topnav'>
  <a class='active' href='user.php'>Anasayfa</a>
  <a href='logout.php'>Çıkış Yap</a>
</div>";
}
else{
  echo"
  <div class='topnav'>
    <a class='active' href='admin.php'>Anasayfa</a>
    <a href='logout.php'>Çıkış Yap</a>
  </div>";
}

?>
</body>
</html>
