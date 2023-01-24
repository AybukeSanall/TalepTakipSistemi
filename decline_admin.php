<?php
$host = "localhost";
$port = "5432";
$dbname = "signup";
$user = "*****";
$password ="*****"; 
$connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password} ";
$dbconn = pg_connect($connection_string); //pg ile bağlantı kuruldu

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
						  <thead>
						    <tr>
							  <th></th>
						      <th>Talep Katagori</th>
						      <th>Adet</th>
						      <th>Birim</th>
						      <th>Ad Soyad</th>
							
						<br>
							<th><div class='btn-group'>
							<button type='button' class='btn btn-warning dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
								Reddedilen Talepler
							</button>
							
							<div class='dropdown-menu'>
								<a class='dropdown-item' href='admin.php'>Tüm Talepler</a>
								<div class='dropdown-divider'></div>
								<a class='dropdown-item' href=''>Birime Göre Filitreleme</a>
								<div class='dropdown-divider'></div> 
								<a class='dropdown-item' href='check_admin.php'>Onaylanan Talepler</a>
								<div class='dropdown-divider'></div>
								<a class='dropdown-item' href=''>İade Edilen Talepler </a>
								
							</div>
							
						    </tr>
						  </thead>

						  <tbody>
							<?php
						$last_query=pg_query($dbconn,"SELECT max(product_id) from public.product");
                        $last_id=pg_fetch_result($last_query,0,0);

						//deneme
						$first_query=pg_query($dbconn,"SELECT min(product_id) from public.product");
						$first_id=pg_fetch_result($first_query,0,0);
					

						$last=pg_query($dbconn,"SELECT count(*) FROM public.product RETURN");
						$last2=pg_fetch_result($last,0,0);
						$last2=(int)$last2;

                        $result = pg_query($dbconn, "SELECT * FROM public.product");

                          
							$count=1; ?>
							<form method="post">
							<?php
							
							 for($i=0; $i <$last2; $i++){
								
                                $arr = pg_fetch_array ($result, $i); 
                                $cat=(String)$arr[0];
                                $department=(String)$arr[1];
                                $usern=(String)$arr[4];
                                $description=(String)$arr[2];
								$un=(String)$arr[3];
								$pid=(String)$arr[5];
								$state_req=(String)$arr[6];
								$state_onay=(String)$arr[7];

								$product_id=$arr['product_id'];
								if( (int)$state_req==1 &&(int)$state_onay==-1){
                                  echo "<tr>
							  <td>$count</td>  
						      <td>$cat</td>
						      <td>$un</td>
						      <td>$department</td>
						      <td>$usern</td> 
							  <td><a href='#' class='btn btn-success'  onclick='gerial($pid)'>Geri al</a></td>
						    </tr>";  
                                $count=$count+1;
							  
							}
						}
							?>
							
						  </tbody>
						</form>
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
<script>



function gerial(gelenproductID)
	{
		if(confirm("talep reddetme işlemini geri almak istediğinize emin misiniz?")==true){
				$.ajax({
				url: 'deneme.php',
				type: 'post',
				data: {gonderimTipi:'GeriAl',productID: gelenproductID},
				success: function(response){

				alert("Geri alma işlemi başarılı");
				document.location.reload(true);
				


			}
			});
		}
		
	
	}
</script>

