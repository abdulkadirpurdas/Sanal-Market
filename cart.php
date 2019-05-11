<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SANAL | MARKET</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->
<script type="text/javascript">
	var geneltoplam=0;
</script>>
<body>
	<!--header kısmını çagırıyoruz-->
	<?php require_once("header_kullanici.php"); ?>
	<?php 
	    if(@$_SESSION){               
	         $_SESSION["uye"]; 
	           $_SESSION["id"];     
	    }
	?>  

	<section id="cart_items">
		<div class="container">
			
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<?php
						 $sepet=$db->query("select  * from sepet where sepet_uyeid='".$_SESSION["id"]."' and sepet_durum=0")->fetchAll(PDO::FETCH_ASSOC);
						 
					 ?>
					<thead>
						<tr class="cart_menu">
							<td class="image">Ürünler</td>
							<td class="description"></td>
							<td class="price">Fiyat</td>
							<td class="quantity">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Adet</td>
							<td class="total">Toplam</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						
					<?php	
						$a=0;
						 $toplam=0;

						 $x=0;
						 foreach ($sepet as $key => $value)
						 	{
						 		$value['sepet_id'];
						 		$urun=$db->query("select  * from urun where urun_id='".$value["sepet_urunid"]."'")->fetchAll(PDO::FETCH_ASSOC);
					 			foreach ($urun as $keys => $values)
					 			{

					 			 $toplam= $toplam+$values['urun_fiyat']; 
								}
					  		}
					  echo "<div id='gtop' hidden> ".$toplam."</div>"; 
					foreach ($sepet as $key => $value){ 
						$value['sepet_id'];

						 $urun=$db->query("select  * from urun where urun_id='".$value["sepet_urunid"]."'")->fetchAll(PDO::FETCH_ASSOC);
					 	

					foreach ($urun as $keys => $values){   
						$values['urun_id'];


								$a=$a+1;
								$x=$x+1;
				 ?>
				
						<tr>
							<td class="cart_product">
								<a href=""><img src="admin_firma/<?php echo $values['urun_resim'];?>" alt="" style="width: 25%; height: 100px;" ></a>
							</td>
							<td class="cart_description">
								<h4><a href=""><?php echo $values['urun_isim'];?></a></h4>
								<p>Ürün ID: <?php echo $values['urun_id'];?></p>
							</td>
							<td id="abc" class="cart_price">
								<p><?php echo $values['urun_fiyat']; ?>.00 TL </p>
									
								 
							</td>
										
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<a class="cart_quantity_up"   onclick="arttir('<?php echo $values['urun_id']; ?>','<?php echo $values['urun_fiyat']; ?>','<?php echo $a;?>','<?php echo $toplam; ?>')" href="#"> + </a>
									<input class="cart_quantity_input" type="text" id="<?php echo $values['urun_id']; ?>" name="quantity" value="1" autocomplete="off" size="2">
									<a class="cart_quantity_down"  onclick="azalt('<?php echo $values['urun_id']; ?>','<?php echo $values['urun_fiyat']; ?>','<?php echo $a;?>')" href="#"> - </a>
									<script>
										function arttir(id,fiyat,satir,toplam)
										{
												 
											var adet=document.getElementById(id);
											adet.value=Number(adet.value)+1; 
											
											document.getElementById(satir).innerHTML=Number(adet.value*fiyat)+".00 TL"; 
											 var geneltoplam=document.getElementById("gtop").innerHTML;
											 
											 geneltoplam=Number(document.getElementById("gtop").innerHTML)+Number(fiyat);

											document.getElementById("gtop").innerHTML=geneltoplam;
											 
											document.getElementById("toplam").innerHTML=Number(geneltoplam)+".00 TL";
										}

										function azalt(id,fiyat,satir)
										{

											var adet=document.getElementById(id);
											if(adet.value>1)
											{ 	
												 adet.value=Number(adet.value)-1;
												  document.getElementById(satir).innerHTML=Number(adet.value*fiyat)+".00 TL";
												  var geneltoplam=document.getElementById("gtop").innerHTML;
												  
												   geneltoplam=Number(document.getElementById("gtop").innerHTML)-Number(fiyat);
												  document.getElementById("gtop").innerHTML=geneltoplam;
													 
												  document.getElementById("toplam").innerHTML=Number(geneltoplam)+".00 TL";
											} 
										}
										
										
						 			 </script>
								</div>
								
							</td>
							
									
							
							<td class="cart_total">
								<p id="<?php echo $a; ?>" class="cart_total_price"><?php  echo number_format($values['urun_fiyat']*1,2)?> TL</p>
							</td>
							

							<td class="cart_delete">
								<a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
							</td>
						</tr>
					
					<?php }	?>

					<?php }	?>

					</tbody>
				</table>
				
			</div>
		</div>
	</section> <!--/#cart_items-->
<?php echo "<div id='odemetip' hidden> </div>"; ?>
	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>Ödeme İşlemleri</h3>
				
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li >Toplam <span id="toplam"><?php echo $toplam;?>.00 TL</span></li>
						
							<li>Kargo Ücreti <span>Ücretsiz</span></li>
							
						</ul>
							
					</div>
				</div>
				<div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option">
							
							<select id="turrr"  class="form-control">
							<option> Ödeme Türünü Seçiniz</option>
							<option> Kapıda  Ödeme</option>
							<option> Kredi Kartı</option>
							<option> Sanal Kart</option>

						</select>
							
						</ul>
						
						<a class="btn btn-default update" href="index_kullanici.php">Alışverişe Devam Et</a>
							<a class="btn btn-default check_out" href="#" data-toggle="modal" id="alisveris" data-target="#sepetModal">Alışverişi Bitir</a>
					</div>
				</div>

				
 

						
			</div>
		</div>
		
	</section><!--/#do_action-->
				<div class="modal fade" id="sepetModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
					  <div class="modal-content">
						<div class="modal-header">
						  <h5 class="modal-title"  id="exampleModalLabel" style="font-size:20px; text-align:center">Ödeme Yap</h5>
						</div>
						<div class="modal-body">
						  <form action="" method="post">
							<div class="form-group">
							  <input type="text" class="form-control" name="uye_eposta" id="recipient-name" value=" ">
							</div>
							<div class="form-group">
							  <input type="password" class="form-control" name="uye_sifre" id="message-text"  placeholder="Şifrenizi Giriniz"/>
							</div>
						  
						</div>
						<div class="modal-footer">
							
						  	<button type="button" class="btn btn-secondary"   data-dismiss="modal">Vazgeç</button>
						  	<button type="submit" name="btn_tamamla" class="btn btn-primary">Ödemeyi Bitir</button>
						</div>
						</form>
					  </div>
					</div>
				</div>
	<!--footer kısmını çagırıyoruz-->
	<?php require_once("footer.php"); ?>

    <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>