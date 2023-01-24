<?php

$host = "localhost";
$port = "5432";
$dbname = "signup";
$user = "*****";
$password = "*****";
$connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password} ";
$dbconn = pg_connect($connection_string); //pg ile bağlantı kuruldu
session_start();


if($_POST['gonderimTipi']=='Iletme')
{
    $productID=$_POST['productID'];
    $query_state="update public.product SET state_request=1  WHERE product_id='".$productID."'";
	$result_state=pg_query($dbconn,$query_state);
    echo ' İletme Basarili';
}

elseif($_POST['gonderimTipi']=='Silme'){
    $productID=$_POST['productID'];
    $query_delete="DELETE FROM public.product WHERE product_id='".$productID."'";
    $result_delete=pg_query($dbconn,$query_delete);
    echo 'Silme Basarili';
    
    
}
elseif($_POST['gonderimTipi']=='Onaylama'){
   
    $productID=$_POST['productID'];
    $query_onay="update public.product SET state_onay=0  WHERE product_id='".$productID."'";
    $result_onay=pg_query($dbconn,$query_onay);
   
    echo 'Onay Başarılı';
    
    
}

elseif($_POST['gonderimTipi']=='Reddetme'){
   
    $productID=$_POST['productID'];
    $query_onay="update public.product SET state_onay=-1  WHERE product_id='".$productID."'";
    $result_onay=pg_query($dbconn,$query_onay);
   
    echo 'Reddetme Başarılı';
    
    
}
elseif($_POST['gonderimTipi']=='Iade'){
   
    $productID=$_POST['productID'];
    $query_onay="update public.product SET state_onay=-2  WHERE product_id='".$productID."'";
    $result_onay=pg_query($dbconn,$query_onay);
   
    echo 'Iade Başarılı';
    
    
}
elseif($_POST['gonderimTipi']=='GeriAl'){
   
    $productID=$_POST['productID'];
    $query_onay="update public.product SET state_onay=1 WHERE product_id='".$productID."'";
    $result_onay=pg_query($dbconn,$query_onay);
   
    echo 'Iade Başarılı';
    
    
}





?>