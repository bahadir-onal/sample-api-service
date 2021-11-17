
<?php

function apisistemi ($hizmet,$token,$ciktituru,$resim=false){

$deger=array("token" => $token);

if ($resim): $deger["resimad"]=$resim; endif;

$oturum=curl_init("http://"myhost"/api.php?islem=".$hizmet); // &token=4455
curl_setopt($oturum,CURLOPT_RETURNTRANSFER, true);
curl_setopt($oturum,CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($oturum,CURLOPT_POSTFIELDS, json_encode($deger));
$cikti=curl_exec($oturum);
curl_close($oturum);

return json_decode($cikti,$ciktituru);


} // hizmet bağlantısı kuran fonksiyonumuz ?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>Api İçin Arayüz</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>

<div class="container-fluid">
	<div class="row">
			<div class="col-12 bg-dark p-2 text-center">
				<a href="index.php?hizmet=bilgi" class="btn btn-warning">Bilgi</a>
				<a href="index.php?hizmet=hava" class="btn btn-warning">Hava Durumu</a>
				<a href="index.php?hizmet=resim" class="btn btn-warning">Resim</a>
				<a href="index.php?hizmet=durum" class="btn btn-warning">Durum sorgula</a>
			</div>
			<div class="col-12  p-2 text-center">


			<?php

				switch (@$_GET["hizmet"]):

				case "bilgi":

				// TEKLİ VERİ HİZMETİ ALIYORUZ
						$al=apisistemi("bilgi","1RTHt2pfE2yo0g9km35",false);
						if (!isset($al->hata)):
						echo $al->Ad;
						else:
						echo $al->hata."<br>";
						echo $al->durum;
						endif;
				break;
				case "hava":

				// ÇOK BOYUTLU DİZİ VERİ HİZMETİ ALIYORUZ

							$al=apisistemi("hava","1RTHt2pfE2yo0g9km35",false);
							if (!isset($al->hata)):
							/*
							echo "<pre>";
							print_r($al);
							echo "</pre>";*/

							foreach ($al as $deger => $a):

							echo "Şehir : ".$deger."<br>";
							echo "Bugün : ".$al->$deger->Bugün."<br>";
							echo "Dün : ".$al->$deger->Dün."<br><hr>";

							endforeach;

							else:
							echo $al->hata."<br>";
							echo $al->durum;
							endif;
				break;
				case "resim":

				// RESİM HİZMETİ ALIYORUZ

					?>
					<h5>RESİM ARA</h5>
					<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
					<input type="text" name="resimad" class="form-control col-lg-3 mx-auto"><br>
					<input type="submit" value="Ara" class="btn btn-success mt-2">
					</form>

					<?php

					if ($_POST):
					$al=apisistemi("resim","1RTHt2pfE2yo0g9km35",false,$_POST["resimad"]);
						if (!isset($al->hata)):

							foreach ($al as $deger):

							echo '<img src="http://bahadironal.xyz/'.$deger.'" width="200" heigth="200">';

							endforeach;

						else:
							echo $al->hata."<br>";
							echo $al->durum;
							endif;

					endif;
				break;


				case "durum":

                    $al=apisistemi("tokenbilgiver","1RTHt2pfE2yo0g9km35",false);
                    if (!isset($al->hata)):

                            echo 'Günlük Limit : '. $al->Gunluk_limit."<br>";
                            echo 'Mevcut Sorgu : '. $al->Mevcut_sorgu."<br>";
                            echo 'Resim Limit : '. $al->Resim_limit."<br>";

                    else:
                        echo $al->hata."<br>";
                        echo $al->durum;


                endif;
				break;

				endswitch;

?>

		</div>
	</div>
</div>

</body>
</html>
