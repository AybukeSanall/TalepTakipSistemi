<?php
require"user_menu.php";
$host = "localhost";
$port = "5432";
$dbname = "signup";
$user = "*****"; 
$password = "*****"; 
$connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password} ";
$dbconn = pg_connect($connection_string);


//session_start();

if(isset($_POST['submit'])&&!empty($_POST['submit'])){
    $category= $_POST['material'];
    $amount=$_POST['amount'];
   
    $unit=$_SESSION['department'];
    $explanation=$_POST['description'];

   $person_name =$_SESSION['name'];

   


 $state;

    if(!$category){
        echo "Lütfen katagoriyi seçiniz";
    }
    elseif(!$amount){
        echo "Lütfen miktarı giriniz";
    }
   elseif(!$unit){
        echo "Lütfen biriminizi giriniz";
    }
    elseif(!$explanation){
        echo "Lütfen ürünü isteme gerekçesini  giriniz";
    }
   
    elseif(!$person_name){
        echo "Lütfen adınızı soyadınızı  giriniz";
    }
  
   
   else{ //boş geçilmemişse
    include "connection.php";
             $last_query=pg_query($dbconn,"SELECT max(id) from public.user");
             $last_id=pg_fetch_result($last_query,0,0);
             //echo (int) $last_id;
             $result = pg_query($dbconn, "SELECT * FROM public.user");
             for ( $i = 0; $i < $last_id; $i++) {
                
                $arr = pg_fetch_array ($result, $i); //mail adresini yaptım bunu tüm sütunlar için yapmalıyım.
                $name=$arr[0]; //mail adresini bir değişkende tutuyoruz.
        
            }
           
             $sql = "insert into product(category,unit,explanation,person_name,amount) values('".$category."','".$unit."','".$explanation."','". $person_name."','".$amount."')";
             $ret = pg_query($dbconn, $sql);
             if($ret){
                       echo "Talep işlemi başarılı bir şekilde gerçekleştirildi <br><br>";
                      
               }
                else{
                
                    echo "Bir hata oluştu";
                } 
              
   }

           
        }

?>
