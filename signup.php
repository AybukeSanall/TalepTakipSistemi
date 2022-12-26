<?php
//session_start();
$host = "localhost";
$port = "5432";
$dbname = "signup";
$user = "*****";
$password = "*****"; 
$connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password} ";
$dbconn = pg_connect($connection_string); //pg ile bağlantı kuruldu

if(isset($_POST['submit'])&&!empty($_POST['submit'])){
    
    $username= $_POST['name'];
    $email=$_POST['email'];
    $password=$_POST['pwd'];
    $mobile=$_POST['mobno'];
   

   
    if(!$username){
        echo "Lütfen adınızı giriniz";
    }
    elseif(!$email){
        echo "Lütfen email adresinizi giriniz";
    }
    elseif(!$password){
        echo "Lütfen şifrenizi giriniz";
    }
    elseif(!$mobile){
        echo "Lütfen telefon numaranızı giriniz";
    }
    
   
  

   else{ //boş geçilmemişse 
        
            $last_query=pg_query($dbconn,"SELECT max(id) from public.user");
            $last_id=pg_fetch_result($last_query,0,0);

            $result = pg_query($dbconn, "SELECT * FROM public.user");

            $state=true;
            $state_name=true;

            $username=trim((String)$username);
         
            $us_dizi=explode(" ",$username);
            $userandsur="";
            foreach($us_dizi as $value){
                $userandsur.=$value;
            }
            $username=$userandsur;
            
            for ( $i = 0; $i < $last_id; $i++ ) {
                
                $arr = pg_fetch_array ($result, $i); 
                $mailAdr=$arr[1]; //mail adresini bir değişkende tutuyoruz.
                $username_query=$arr[0];
                if($mailAdr==$email){
                    
                    $state=false;
                    break;
                    
                }
                if($username==$username_query){
                    $state_name=false;
                    break;
                }
             }
             $control=false;

             if($password)
             {
              $sifre =$password;
              $kontrol = "/\S*((?=\S{8,})(?=\S*[A-Z]))\S*/";
             
             
              if(preg_match($kontrol,$sifre))
              {  
               //echo "Şifreniz uygun formatta.";
               $control=true;
              }
               
              else
              {
               echo "<b> Hata : </b>Şifreniz uygun formatta değil.";
              }
             } 


         if($state && $state_name ){
            if($control){
                   $sql = "insert into public.user(sname,email,password,mobno)values('".$username."','".$_POST['email']."','".md5($_POST['pwd'])."','".$_POST['mobno']."')";
                $ret = pg_query($dbconn, $sql);
                if($ret){
                    
                    //giriş yap sayfasına yönlendir.
                    header('Location: index.php');
                       
                }
                else{
                
                    echo "Bir hata oluştu";
                } 
                 
             }
             
            }
            else{
                echo "Bu email veya kullanıcı adı daha önceden alınmış";
             } 

            
            
           }
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt Ol</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
        <div class="login">
            <div class="login-screen">
                <div class="app-title">
                    <h1>Kayıt Ol</h1>
                </div>
            <form  method="post">
                <div class="login-form">
                    <div class="control-group">
                        <input type="text" name="name" class="login-field" placeholder="Kullanıcı Adı" id="login-name">
                        <label for="login-name" class="login-field-icon ful-user"></label>
                    </div>
                    <div class="control-group">
                        <input type="email" name="email" class="login-field" placeholder="Mailinizi Giriniz" id="login-pass">
                        <label for="login-pass" class="login-field-icon ful-user"></label>
                    </div>
                    <div class="control-group">
                        <input type="number" maxlength="10" name="mobno" class="login-field" placeholder="Telefon Numaranızı Giriniz" id="login-pass">
                        <label for="login-pass" class="login-field-icon ful-user"></label>
                    </div>
                    
                    
                    <div class="control-group">
                        <input type="password"  name="pwd" class="login-field" placeholder="Şifrenizi Giriniz" id="login-pass">
                        <label for="login-pass" class="login-field-icon ful-user"></label>
                    </div>
             
                    <input type="submit" name="submit" class="btn btn-primary btn-large btn-block" value="Kayıt Ol">
                   
                </div>
               
            </form>
            <a href="index.php"> <button href="index.php" class="btn btn-primary btn-large btn-block">Giriş Yap</button> </a>
            </div>

        </div>
        
        
</body>
</html>
