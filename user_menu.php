<?php
session_start(); 
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="css/userr.css">
</head>
<body>

<h3>Talep Formu</h3>

<div class="container">
  <form  method="post">
  <label for="country">Birim:  </label>
  <label for="lname"><?php  echo (String)$_SESSION['department']; ?> </label> <br><br>

  <label for="lname">Kullanıcı Adı :</label>
  
  <label for="lname"><?php  echo (String) $_SESSION['name']; ?> </label> <br><br>


  <label for="country">Talep Kategori</label><br>
      <select id="country" name="material">
      <option value="Bilgisayar">Bilgisayar</option>
      <option value="Mouse">Mouse</option>
      <option value="Harici">Harici</option>
      <option value="Klavye">Klavye</option>
      <option value="Flash Bellek">Flash Bellek</option>
    </select>

<br>
    <label for="fname">Ürün Adedi</label><br><br>
    <input type="number" id="fname" name="amount" placeholder="Ürün Adedi"><br><br>

    <label for="subject">Açıklama/Gerekçe</label> <br><br>
    <textarea id="subject" name="description" placeholder="Ürün talep nedenini giriniz " style="height:200px"></textarea>
    <br>

    <input type="submit" name="submit" id="submitbtn" value="Talep Oluştur"> <br><br>
    
   
  </form>

   <a href="user_product.php"> <input type="submit" name="submit" value="Talepleri Görüntüle"></a>
   
  
    




</div>

</body>
</html>
