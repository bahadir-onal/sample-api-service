<?php
try {
$baglanti=new PDO("mysql:host=localhost;dbname="";charset=utf8","","");
$baglanti->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e) {
die($e->getMessege());
}

  class apimiz {
//Hata
      public $Hata_token="Token Geçerli Değil";
      public $Hata_yetki="Bu alan için yetkiniz yok";
      public $Hata_limit="İşlem limitinize ulaştınız";
      public $Hata_sonucyok="Kritere göre resim yok.";
      public $Hata_resim="Kelime girilmedi.";
      public $Hata_yontem="Yöntemde hata var.";
//Durum
      public $Durum_olumsuz="İşlem Başarısız";
//Genel Değişkenler
      public $resimad,$resimlimit,$mevcutsorgu,$gunluklimit;

      function cevap(array $veriler) {

          echo json_encode(array(
              "hata"=> $veriler[0],
              "durum"=> $veriler[1]
          ));
      }

      function kontrol($baglanti,array $izinListesi,$durum=false){

          if ($_SERVER['REQUEST_METHOD']=='GET') {

              $input=file_get_contents("php://input");

                  if (empty($input)){
                     $this->cevap(array($this->Hata_yontem,$this->Durum_olumsuz));
                  } else {
                     $sonuc=json_decode($input,false);

                  $gelenToken=$sonuc->token;
                  $anahtar=$baglanti->prepare("select * from anahtarlar where token='$gelenToken'");
                  $anahtar->execute();

                  $baglanti->query("update anahtarlar set tarih=NOW(),mevcutsorgu=0 where tarih < DATE_FORMAT(NOW(),'%Y-%m-%d') and token='$gelenToken'");

                  if ($anahtar->rowCount()==0) {

                      $this->cevap(array($this->Hata_token,$this->Durum_olumsuz));

                  } else {
                      $gelenBilgi=$anahtar->fetch(PDO::FETCH_ASSOC);
                      $this->resimlimit=$gelenBilgi['resimlimit'];
                      $this->mevcutsorgu=$gelenBilgi['mevcutsorgu'];
                      $this->gunluklimit=$gelenBilgi['gunluklimit'];
                      $this->resimad=$sonuc->resimad;

                      if (!in_array($gelenBilgi['izin'],$izinListesi)) {
                         $this->cevap(array($this->Hata_yetki, $this->Durum_olumsuz));

                      }elseif ($gelenBilgi['mevcutsorgu']==$gelenBilgi['gunluklimit']){
                         $this->cevap(array($this->Hata_limit, $this->Durum_olumsuz));
                      } else {
                         if (!$durum) {
                              $baglanti->query("update anahtarlar set mevcutsorgu=mevcutsorgu+1 where token='$gelenToken'");
                         }

                          return true;
                      }
                  }
              } //Veri boş değilse
           } else {
           $this->cevap(array($this->Hata_yontem,$this->Durum_olumsuz));
        }
    }
}
$apimiz=new apimiz;

  switch ($_GET["islem"]):

  case "bilgi":

      if ($apimiz->kontrol($baglanti,array(1,2))){

      $deger=$baglanti->query("select * from bilgi")->fetch(PDO::FETCH_ASSOC);
      echo json_encode(array(
          "Ad" => $deger["ad"],
          "Yaş" => $deger["yas"],
          "Memleket"=> $deger["memleket"]));

      }
  break;

  case "hava":


      if ($apimiz->kontrol($baglanti,array(1,2))){

          $havadurumu=$baglanti->prepare("SELECT sehirler.ad AS sehirad, havadurumu.* FROM sehirler JOIN havadurumu ON sehirler.id=havadurumu.sehirid");
          $havadurumu->execute();
          $json_icin=array();

          while ($veriler=$havadurumu->fetch(PDO::FETCH_ASSOC)) {

                $json_icin[$veriler['sehirad']]=array(
                  "Bugün" => $veriler['bugun'],
                  "Dün" => $veriler['dun']
              );
          }
          echo json_encode($json_icin);
      }
  break;

  case "resim":

          if ($apimiz->kontrol($baglanti,array(1,2))){

              $resimad = $apimiz->resimad;

              if (!isset($resimad)) {
                  $apimiz->cevap(array($apimiz->Hata_resim, $apimiz->Durum_olumsuz));
              } else {
              $resimsor = $baglanti->prepare("SELECT * FROM resimler where adveyol LIKE '%$resimad%' LIMIT " . $apimiz->resimlimit);
              $resimsor->execute();
            }
            if ($resimsor->rowCount() == 0) {
              $apimiz->cevap(array($apimiz->Hata_sonucyok, $apimiz->Durum_olumsuz));
            } else {
              $json_icin = array();
              while ($veriler = $resimsor->fetch(PDO::FETCH_ASSOC)) {
                  $json_icin[] = $veriler["adveyol"];
              }
              echo json_encode($json_icin);
            }
         }
  break;

  case "tokenbilgiver":

      if ($apimiz->kontrol($baglanti,array(1,2),true)){

          echo json_encode(array(
              "Gunluk_limit" => $apimiz->gunluklimit,
              "Mevcut_sorgu" => $apimiz->mevcutsorgu,
              "Resim_limit" => $apimiz->resimlimit
          ));
      }


  break;
  
  case "tokenolustur":
  // burası için bir arayüz yapmayacağız. Şifre çok farklı yollar ile üretilebilir. Amaç zaten burada bir kod üretmek ve veritabanına kaydetmek
 
  // 1.YÖNTEM
  echo str_shuffle('HymgtkopERTf'. mt_rand(0,9999990))."<br>";
  // 2.YÖNTEM
  echo md5(mt_rand(0,9999990))."<br>";
  // 3.YÖNTEM
  echo md5(sha1(mt_rand(0,9999990)))."<br>";
  // 4.YÖNTEM
  echo base64_encode(md5(sha1(mt_rand(0,9999990))))."<br>";

  break;
  endswitch;