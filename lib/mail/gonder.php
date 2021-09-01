<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

	$baglanti=new PDO("mysql:host=localhost;dbname=kurumsal;charset=utf8","root","");//veritabanı bağlantısının 

$ayarlar=$baglanti->prepare("SELECT * from gelenmailayar");
$ayarlar->execute();
$ayarson=$ayarlar->fetch();
//---------------TERİCİHİ ALMAK İÇİN
$ayarlar2=$baglanti->prepare("SELECT mesajtercih from ayarlar");
$ayarlar2->execute();
$tercihgeldi=$ayarlar2->fetch();



$mail= new PHPMailer(true);
$mail->SMTPDebug=0;//hataları yakalamak için

$mail->isSMTP();//protokolü başlatmak için
$mail->CharSet='UTF-8';
$mail->Host=$ayarson["host"];//veritabanındaki host blogu
$mail->SMTPAuth=true;
$mail->Username=$ayarson["mailadres"];
$mail->Password=$ayarson["sifre"];
$mail->SMTPSecure="tls";//güvenlik derecesinin ne olacağını söylüyor.tls bir sertifikadır
$mail->Port=$ayarson["port"];
$mail->isHTML(true);//bu formatın html formatı olduğunu doğrulamak için
$mail->addAddress($ayarson["aliciadres"]);//gönderilecek adresler

if($_POST)://eğer post edildiyse
$isim=htmlspecialchars(strip_tags($_POST["isim"]));
$mailadres=htmlspecialchars(strip_tags($_POST["mail"]));
$konu=htmlspecialchars(strip_tags($_POST["konu"]));
$mesaj=htmlspecialchars(strip_tags($_POST["mesaj"]));

 

   switch($tercihgeldi["mesajtercih"]):

   	case 1://sadece mail göndermek için
   	
$mail->setFrom($mailadres,$isim);//gönderenin kim olduğu
$mail->addReplyTo($mailadres,"yanıt");//mail cevaplanmak istendiğinde hangi adrese gitmeli.//mail gönderen kişinin maili yer almalı

$mail->Subject=$konu;//konu
$mail->Body=$mesaj;

if($mail->send())://eğer mail gönderildiyse
echo '<div class="alert alert-success text-center mx-auto">Mesaj Başarıyla Alındı<br>TEŞEKKÜR EDERİZ</div>';
else:

	$zaman=date("d.m.Y")."/".date("H:i");

	//gönderilmedi ise
	$kaydet=$baglanti->prepare("INSERT INTO gelenmail (ad,mailadres,konu,mesaj,zaman) VALUES (?,?,?,?,?)");
	$kaydet->bindParam(1,$isim,PDO::PARAM_STR);
	$kaydet->bindParam(2,$mailadres,PDO::PARAM_STR);
	$kaydet->bindParam(3,$konu,PDO::PARAM_STR);
	$kaydet->bindParam(4,$mesaj,PDO::PARAM_STR);
	$kaydet->bindParam(5,$zaman,PDO::PARAM_STR);
	$kaydet->execute();
	echo '<div class="alert alert-success text-center mx-auto">Mesaj Başarıyla Alındı<br>TEŞEKKÜR EDERİZ</div>';


	endif;
//post etmek için

   		
   	break;

   	case 2://mail ve mesaj göndermek için
   	   	
$mail->setFrom($mailadres,$isim);//gönderenin kim olduğu
$mail->addReplyTo($mailadres,"yanıt");//mail cevaplanmak istendiğinde hangi adrese gitmeli.//mail gönderen kişinin maili yer almalı

$mail->Subject=$konu;//konu
$mail->Body=$mesaj;
$$mail->send();

$zaman=date("d.m.Y")."/".date("H:i");

	//gönderilmedi ise
	$kaydet=$baglanti->prepare("INSERT INTO gelenmail (ad,mailadres,konu,mesaj,zaman) VALUES (?,?,?,?,?)");
	$kaydet->bindParam(1,$isim,PDO::PARAM_STR);
	$kaydet->bindParam(2,$mailadres,PDO::PARAM_STR);
	$kaydet->bindParam(3,$konu,PDO::PARAM_STR);
	$kaydet->bindParam(4,$mesaj,PDO::PARAM_STR);
	$kaydet->bindParam(5,$zaman,PDO::PARAM_STR);
	$kaydet->execute();
	echo '<div class="alert alert-success text-center mx-auto">Mesaj Başarıyla Alındı<br>TEŞEKKÜR EDERİZ</div>';

   	break;

   	case 3://sadece mesaj göndermek için
   	$zaman=date("d.m.Y")."/".date("H:i");

	//gönderilmedi ise
	$kaydet=$baglanti->prepare("INSERT INTO gelenmail (ad,mailadres,konu,mesaj,zaman) VALUES (?,?,?,?,?)");
	$kaydet->bindParam(1,$isim,PDO::PARAM_STR);
	$kaydet->bindParam(2,$mailadres,PDO::PARAM_STR);
	$kaydet->bindParam(3,$konu,PDO::PARAM_STR);
	$kaydet->bindParam(4,$mesaj,PDO::PARAM_STR);
	$kaydet->bindParam(5,$zaman,PDO::PARAM_STR);
	$kaydet->execute();
	echo '<div class="alert alert-success text-center mx-auto">Mesaj Başarıyla Alındı<br>TEŞEKKÜR EDERİZ</div>';
   	break;

   endswitch;






//buraya gelindiğinde veritabanındaki tercihlere bakılmalı



	endif;
?>