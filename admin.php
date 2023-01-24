<?php
$host = "localhost";
$port = "5432";
$dbname = "signup";
$user = "*****";
$password = "*****"; 
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


	<div class="modal fade" id="myModal">
	<div class="modal-dialog open-sm modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header ">
				<h4>Header</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body ">
				Talebi iade etmek istediğinizden emin misiniz? 
				<form method="POST" action="#" id="cuser">
					<input type="hidden" name="id">
				</form>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Hayır</button>
				<button type="submit" id="yesbtn_iade" form="cuser" class="btn btn-info">Evet</button>
			</div>

		</div>
	</div>

</div>


<div class="modal fade" id="modalOnayla">
	<div class="modal-dialog open-sm modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header ">
				<h4>Header</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body ">
				Talebi onaylamak istediğinize emin misiniz?
				<form method="POST" action="#" id="cuser">
					<input type="hidden" name="id">
				</form>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Hayır</button>
				<button type="submit" id="yesbtn_onayla" form="cuser" class="btn btn-info">Evet</button>
			</div>

		</div>
	</div>

</div>
<div class="modal fade" id="modalReddet">
	<div class="modal-dialog open-sm modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header ">
				<h4>Header</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body ">
				Talebi reddetmek istediğinize emin misiniz?
				<form method="POST" action="#" id="cuser">
					<input type="hidden" name="id">
				</form>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Hayır</button>
				<button type="submit" id="yesbtn_reddet" form="cuser" class="btn btn-info">Evet</button>
			</div>

		</div>
	</div>

</div>

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
							 
							  
						      <th><div class='btn-group'>
							<button type='button' class='btn btn-warning dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
								Tüm Talepler
							</button>
							<div class='dropdown-menu'>
								<a class='dropdown-item' href=''>Birime Göre Filitreleme</a>
								<div class='dropdown-divider'></div>
								<a class='dropdown-item' href='check_admin.php'>Onaylanan Talepler</a>
								<div class='dropdown-divider'></div>
								<a class='dropdown-item' href='decline_admin.php'>Reddedilen Talepler </a>
								<div class='dropdown-divider'></div>
								<a class='dropdown-item' href=''>İade Edilen Talepler </a>
								<div class='dropdown-divider'></div>
								
							</div>
							</div>
							<th></th></th>
                              <th></th>
							  <th></th>
							  
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
								if( (int)$state_req>0 &&(int)$state_onay>0){
                                  echo "<tr>
							  <td>$count</td>  
						      <td>$cat</td>
						      <td>$un</td>
						      <td>$department</td>
						      <td>$usern</td>
									<td></td>
									
							  <td><a href='#' class='btn btn-warning' onclick='iade($pid)' >İade </a></td>
                              <td><a href='#' class='btn btn-success'  onclick='onayla($pid)'>Onayla</a></td>
                              <td><a href='#' class='btn btn-danger'onclick='reddet($pid)' >Reddet </a></td>
							  <td></td>
							
							 
						
							  
							  
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

	function onayla(gelenproductID)
	{
		const yesbtn_onayla = document.querySelector("#yesbtn_onayla");
		var id = gelenproductID;
		document.getElementById("cuser").id.value = id;
		$("#modalOnayla").modal("show");
		yesbtn_onayla.addEventListener("click", function() {
			$.ajax({
				url: 'deneme.php',
				type: 'post',
				data: {
					gonderimTipi: 'Onaylama',
					productID: gelenproductID
				},
				success: function(response) {

					console.log("başarılı");
					document.location.reload(true);

				}


			});
		})
	}
	
		
		
	
	function reddet(gelenproductID)
	{
		const yesbtn = document.querySelector("#yesbtn_reddet");
		var id = gelenproductID;
		document.getElementById("cuser").id.value = id;
		
		$("#modalReddet").modal("show");
			yesbtn.addEventListener("click", function() {
		$.ajax({
			url: 'deneme.php',
			type: 'post',
			data: {
				gonderimTipi: 'Reddetme',
				productID: gelenproductID
			},
			success: function(response) {
				console.log("başarılı");

				document.location.reload(true);

			}
			
		});
	})
	
	}
	


	function iade(gelenproductID)
	{
		const yesbtn = document.querySelector("#yesbtn_iade");
		var id = gelenproductID;
		document.getElementById("cuser").id.value = id;
		$("#myModal").modal("show");
			yesbtn.addEventListener("click", function() {
		$.ajax({
			url: 'deneme.php',
			type: 'post',
			data: {
				gonderimTipi: 'Iade',
				productID: gelenproductID
			},
			success: function(response) {
				console.log("başarılı");

				document.location.reload(true);

			}
			
		});
	})
	
	}

	




</script>

