<?php
$host = "localhost";
$port = "5432";
$dbname = "signup";
$user = "postgres";
$password = "Zuhal1989."; 
$connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password} ";
$dbconn = pg_connect($connection_string); 
session_start();
require"topmenu.php";
?>

<!Doctype html>
<html lang="en">
  <head>
  	<title>Satın Alma Daire Başkanlığı</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/table.css">

	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Satın Alma Daire Başkanlığı</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="table-wrap">
						<table class="table table-striped">
							<?php 
					
						
							echo"<thead>
							<tr>
							<th></th>
							<th><strong> Katagori</strong></th>
							<th> <strong>Adet</strong></th>
							<th><strong>Açıklama</strong></th>
							
							<th><div class='btn-group'>
							<button type='button' class='btn btn-warning dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
								Reddedilen Talepler
							</button>
							<div class='dropdown-menu'>
								<a class='dropdown-item' href='user_product.php'>Tüm Talepler</a>
								<div class='dropdown-divider'></div>
								<a class='dropdown-item' href='check.php'>Onaylanan Talepler</a>
								<div class='dropdown-divider'></div>
								
								
							</div>
							</div></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							
						  </tr>
						</thead>";
							?> 
						  <tbody>
							<?php
						$last_query=pg_query($dbconn,"SELECT max(product_id) from public.product");
                        $last_id=pg_fetch_result($last_query,0,0);
                        $result = pg_query($dbconn, "SELECT * FROM public.product"); 

					
						$result_requ=pg_query($dbconn,"SELECT *  FROM public.product WHERE person_name='".pg_escape_string($_SESSION['name'])."' order by product_id desc "  );
						$id_product_last=pg_query($dbconn,"SELECT max(product_id)  FROM public.product WHERE person_name='".pg_escape_string($_SESSION['name'])."'");
						$product_id_max=pg_fetch_result($id_product_last,0,0);
						

						$id_product_first=pg_query($dbconn,"SELECT min(product_id)  FROM public.product WHERE person_name='".pg_escape_string($_SESSION['name'])."'");
						$product_id_min=pg_fetch_result($id_product_first,0,0);
						

						$different=(int)$product_id_max-(int)$product_id_min; //o kişiye ait kaç tane kayıt var bulmak için
						$different=$different+1;


						$count_id=pg_query("SELECT COUNT(*) FROM public.product WHERE person_name='".pg_escape_string($_SESSION['name'])."'");
						$count_id_res=pg_fetch_result($count_id,0,0);
							?>
						
							<form method="post">

							

							<?php 
						
							$id_value=0;
							
						for($i=0; $i <$count_id_res; $i++){
							$arr2 = pg_fetch_array ($result_requ, $i);
							
							$id_value=$id_value+1;
							$cat_u=(String)$arr2[0];
							$amo_u=(String)$arr2[3];
							$desc_u=(String)$arr2[2]; 
							
							$_SESSION['id_p']=(String) $arr2[6]; 
							//echo $_SESSION['id_p'];
                            if((int)$arr2[6]==1 &&(int)$arr2[7]!=1){
                                echo "<tr>
							<th>$id_value</th>
							<td>$cat_u</td>
							<td>$amo_u</td>
							<td>$desc_u</td>
							<td></td>";
                            echo"
								<td><a href='#' class='btn btn-info disabled'>Güncelle</a></td>
								<td><a href='#' class='btn btn-info disabled'>Sil</a></td>
								<td></td>
								<td></td>";
                            }
							
							echo"</tr>"; 
						}
                       
							?>
							</form>
						  </tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
	
  <script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
  
	</body>
</html>
