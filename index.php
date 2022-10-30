<?php
$host = "localhost";
$port = "5432";
$dbname = "signup";
$user = "postgres";
$password = "Zuhal1989."; 
$connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password} ";
$dbconn = pg_connect($connection_string);
session_start();

//require"topmenu.php";
if(isset($_POST['submit'])&&!empty($_POST['submit'])){
    
    $email= $_POST['email'];
    $pswd=$_POST['pwd'];
   //boş geçilmez kontrolleri
    if(!$email){
        echo "Lütfen email adresinizi giriniz.";
    }
    elseif(!$pswd){
        echo "Lütfen şifrenizi giriniz";
    }
    else{
        $hashpassword = md5($_POST['pwd']);
        $sql ="select *from public.user where email = '".pg_escape_string($_POST['email'])."' and password ='".$hashpassword."'";
        $data = pg_query($dbconn,$sql); 
        $login_check = pg_num_rows($data);
        if($login_check > 0){     
            echo "Giriş Başarılı";
            
           $result = pg_Exec ($dbconn, "SELECT * FROM public.user");
            if (!$result) {
            echo "Bir hata oluştu.\n";
            exit;
            }
            else{
                $query_r="SELECT roles FROM public.user WHERE email='".pg_escape_string($_POST['email'])."'";
                $query_name="SELECT sname  FROM public.user WHERE email='".pg_escape_string($_POST['email'])."'";

                
                $query_department="SELECT department  FROM public.user WHERE email='".pg_escape_string($email)."'";

                $query_email="SELECT email FROM public.user WHERE email='".pg_escape_string($_POST['email'])."'";

                $result_role=pg_query($dbconn,$query_r);
                $role_us=pg_fetch_result($result_role,0,0);

                $result_department=pg_query($dbconn,$query_department);
                $department_us=pg_fetch_result($result_department,0,0);

                $result_email=pg_query($dbconn,$query_email);
                $email_us=pg_fetch_result($result_email,0,0);

                $result_name=pg_query($dbconn,$query_name);
                $name_us=pg_fetch_result($result_name,0,0);



                //burada sessionları tutman gerek.
                $_SESSION['role']=$role_us;
                $_SESSION['department']= $department_us;
                $_SESSION['email']=$email_us;
                $_SESSION['name']=$name_us;
                  
              
               if($_SESSION['role']=="admin"){
                header('Location:admin.php');
               }
               elseif($_SESSION['role']=="superAdmin"){
                header('Location:superAdmin.php');
               }
               elseif($_SESSION['role']=="user"){
                header('Location:user.php');
               }
            

            }
                
       
    }
     else{
            
            echo "Email ya da parola yanlış";
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
    <title>Giriş Yap</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"
/>
</head>
<script src="js/popper.js"></script>
<script src="js/bootstrap.min.js"></script>
<body>
        <div class="login">
            <div class="login-screen">
                <div class="app-title">
                    <h1>Giriş Yap</h1>
                </div>
            <form  method="post">
                <div class="login-form">
                    <div class="control-group">
                        <input type="email" class="form-control" id="email" placeholder="Mail adresinizi giriniz" name="email" id=login-name>
                        <label for="login-name" class="login-field-icon ful-user"></label>
                    </div>
                    <div class="control-group">
                        <input type="password" class="form-control" id="pwd" placeholder="Şifrenizi giriniz" name="pwd" > <!--id="login-pass"-->
                        <input type="checkbox" onclick="show()">Göster
                        <i class="bi-eye-fill"></i>
                        
</svg>
                        
                        <label for="login-pass" class="login-field-icon ful-user"></label>
                        
                    </div>


                </div>
                <input type="submit" name="submit" class="btn btn-primary" value="Giriş Yap"> 
            </form>
            <a href="signup.php"><button class="btn btn-primary btn-large btn-block">Kayıt Ol</button> </a>
            </div>

        </div>
</body>
</html>
<script>
function show() {
var x = document.getElementById("pwd");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
