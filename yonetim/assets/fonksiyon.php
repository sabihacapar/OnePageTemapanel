
<?php ob_start();//dersek eğer oturum başlatılacağını bildirir.daha önce aldığımız oturum hatasının nedeni budur


 try{
	$baglanti=new PDO("mysql:host=localhost;dbname=kurumsal;charset=utf8","root","");//veritabanı bağlantısının yapıldığı kısımdır.sunucu veritabanı adı kullanıcı adı ve şifreyi içerir.
	$baglanti->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);//hataları yakalamak için kullanılır,bir defa yazılması yeterlidir.

}catch(PDOException $e){//bağlantı hatası,şifre hatası,veritabanı hatası vs gibi hataları yakalayabilmek için Try catch in içindeki catch kısmında hatalar yakalanır
	die($e->getMessage());//eğer bir hata var ise

}

class yonetim{
  private $veriler=array();

	function sorgum($vt,$sorgu,$tercih=0){

		$al=$vt->prepare($sorgu);
		$al->execute();

		if($tercih==1)://tek bir sorgu var ise
			return $al->fetch();

		elseif ($tercih==2)://döngü kullanılacak ise
			return $al;
		

		endif;



		//NOT::::silme veya güncelleme işleminde fetch e gerek yoktur.

		

	}
       function siteayar($baglanti){
		$sonuc=$this->sorgum($baglanti,"SELECT * FROM ayarlar",1);//veritabanına bağlandı sorguyu yaptı ve seçim yaptı.Seçim seçeneğini sorgum fonksiyonunda yaptı
		//her seferinde tekrar tekrar sorgu yapmak yerine srogu işlemini tek satırda yapmak için bu yöntem kullanılır

		//this in alternatifi olarak self::  de kullanılabilir
		//this class içindeki herhangi bir fonksiyona veya değişkene ulaşmak için kullanılır


    if ($_POST):

    	//veritabanı işlemleri bu kısımda gerçekleşir
    	//htmlspecialchars ile güvenlik önlemi alınmış oldu
    	$title=htmlspecialchars($_POST["title"]);
    	$metatitle=htmlspecialchars($_POST["metatitle"]);
    	$metadesc=htmlspecialchars($_POST["metadesc"]);	
    	$metakey=htmlspecialchars($_POST["metakey"]);
    	$metaaouthor=htmlspecialchars($_POST["metaauthor"]);
    	$metaowner=htmlspecialchars($_POST["metaowner"]);	
    	$metacopy=htmlspecialchars($_POST["metacopy"]);	
    	$logoyazisi=htmlspecialchars($_POST["logoyazisi"]);	
    	$twitter=htmlspecialchars($_POST["twitter"]);
    	$facebook=htmlspecialchars($_POST["facebook"]);
    	$instagram=htmlspecialchars($_POST["instagram"]);
    	$telno=htmlspecialchars($_POST["telefonno"]);
   		$mailadres=htmlspecialchars($_POST["mailadres"]);	


        $adres_tr=htmlspecialchars($_POST["adres_tr"]);
        $adres_en=htmlspecialchars($_POST["adres_en"]);

   		$slogan_tr=htmlspecialchars($_POST["slogan_tr"]);
        $slogan_en=htmlspecialchars($_POST["slogan_en"]);

        $referansustbaslik_tr=htmlspecialchars($_POST["referansbaslik_tr"]);
        $referansustbaslik_en=htmlspecialchars($_POST["referansUstBaslik_en"]);
   		$referansbaslik_tr=htmlspecialchars($_POST["referansbaslik_tr"]);
        $referansbaslik_en=htmlspecialchars($_POST["referansbaslik_en"]);

   		$filoustbaslik_tr=htmlspecialchars($_POST["filoustbaslik_tr"]);
        $filoustbaslik_en=htmlspecialchars($_POST["filoustbaslik_en"]);
        $filobaslik_tr=htmlspecialchars($_POST["filobaslik_tr"]);
        $filobaslik_en=htmlspecialchars($_POST["filobaslik_tr"]);

   		$yorumustbaslik_tr=htmlspecialchars($_POST["yorumustbaslik_tr"]);
        $yorumustbaslik_en=htmlspecialchars($_POST["yorumustbaslik_en"]);
        $yorumbaslik_tr=htmlspecialchars($_POST["yorumbaslik_tr"]);
        $yorumbaslik_en=htmlspecialchars($_POST["yorumbaslik_en"]);

   		$iletisimustbaslik_tr=htmlspecialchars($_POST["iletisimustbaslik_tr"]);
        $iletisimustbaslik_en=htmlspecialchars($_POST["iletisimustbaslik_en"]);
        $iletisimbaslik_tr=htmlspecialchars($_POST["iletisimbaslik_tr"]);
        $iletisimbaslik_en=htmlspecialchars($_POST["iletisimbaslik_en"]);


       $hizmetlerustbaslik_tr=htmlspecialchars($_POST["hizmetlerustbaslik_tr"]);
       $hizmetlerustbaslik_en=htmlspecialchars($_POST["hizmetlerustbaslik_en"]);
       $hizmetlerbaslik_tr=htmlspecialchars($_POST["hizmetlerbaslik_tr"]);
       $hizmetlerbaslik_en=htmlspecialchars($_POST["hizmetlerbaslik_en"]);

      $mesajtercih=htmlspecialchars($_POST["mesajtercih"]);
      $haritabilgi=htmlspecialchars($_POST["haritabilgi"]);
      $footer=htmlspecialchars($_POST["footer"]);


   		//bunların boş vea doluluk kontrolü bu kısımda yapılabilir

   		$guncelleme=$baglanti->prepare("UPDATE ayarlar SET title=?,metatitle=?,metadesc=?,metakey=?,metaauthor=?,metaowner=?,metacopy=?,logoyazisi=?,twitter=?,facebook=?,instagram=?,telefonno=?,adres_tr=?,adres_en=?,mailadres=?,slogan_tr=?,slogan_en=?,referansbaslik_tr=?,referansUstBaslik_tr=?,referansUstBaslik_en=?,referansbaslik_en=?,filoustbaslik_tr=?,filoustbaslik_en=?,filobaslik_tr=?,filobaslik_en=?,yorumustbaslik_tr=?,yorumustbaslik_en=?,yorumbaslik_tr=?,yorumbaslik_en=?,iletisimustbaslik_tr=?,iletisimustbaslik_en=?,iletisimbaslik_tr=?,iletisimbaslik_en=?,hizmetlerustbaslik_tr=?,hizmetlerustbaslik_en=?,hizmetlerbaslik_tr=?,hizmetlerbaslik_en=?,mesajtercih=?,haritabilgi=?,footer=?");
   		$guncelleme->bindParam(1,$title,PDO::PARAM_STR);
   		$guncelleme->bindParam(2,$metatitle,PDO::PARAM_STR);
   		$guncelleme->bindParam(3,$metadesc,PDO::PARAM_STR);
   		$guncelleme->bindParam(4,$metakey,PDO::PARAM_STR);
   		$guncelleme->bindParam(5,$metaaouthor,PDO::PARAM_STR);
   		$guncelleme->bindParam(6,$metaowner,PDO::PARAM_STR);
   		$guncelleme->bindParam(7,$metacopy,PDO::PARAM_STR);
   		$guncelleme->bindParam(8,$logoyazisi,PDO::PARAM_STR);
   		$guncelleme->bindParam(9,$twitter,PDO::PARAM_STR);
   		$guncelleme->bindParam(10,$facebook,PDO::PARAM_STR);
   		$guncelleme->bindParam(11,$instagram,PDO::PARAM_STR);
   		$guncelleme->bindParam(12,$telno,PDO::PARAM_STR);

   		$guncelleme->bindParam(13,$adres_tr,PDO::PARAM_STR);
        $guncelleme->bindParam(14,$adres_en,PDO::PARAM_STR);

   		$guncelleme->bindParam(15,$mailadres,PDO::PARAM_STR);

   		$guncelleme->bindParam(16,$slogan_tr,PDO::PARAM_STR);
        $guncelleme->bindParam(17,$slogan_en,PDO::PARAM_STR);

        $guncelleme->bindParam(18,$referansustbaslik_tr,PDO::PARAM_STR);
        $guncelleme->bindParam(19,$referansustbaslik_en,PDO::PARAM_STR);
   		$guncelleme->bindParam(20,$referansbaslik_tr,PDO::PARAM_STR);
        $guncelleme->bindParam(21,$referansbaslik_en,PDO::PARAM_STR);

        $guncelleme->bindParam(22,$filoustbaslik_tr,PDO::PARAM_STR);
        $guncelleme->bindParam(23,$filoustbaslik_en,PDO::PARAM_STR);
   		$guncelleme->bindParam(24,$filobaslik_tr,PDO::PARAM_STR);
        $guncelleme->bindParam(25,$filobaslik_en,PDO::PARAM_STR);

        $guncelleme->bindParam(26,$yorumustbaslik_tr,PDO::PARAM_STR);
        $guncelleme->bindParam(27,$yorumustbaslik_en,PDO::PARAM_STR);
   		$guncelleme->bindParam(28,$yorumbaslik_tr,PDO::PARAM_STR);
        $guncelleme->bindParam(29,$yorumbaslik_en,PDO::PARAM_STR);

   		$guncelleme->bindParam(30,$iletisimustbaslik_tr,PDO::PARAM_STR);
        $guncelleme->bindParam(31,$iletisimustbaslik_en,PDO::PARAM_STR);
        $guncelleme->bindParam(32,$iletisimbaslik_tr,PDO::PARAM_STR);
        $guncelleme->bindParam(33,$iletisimbaslik_en,PDO::PARAM_STR);

       $guncelleme->bindParam(34,$hizmetlerustbaslik_tr,PDO::PARAM_STR);
       $guncelleme->bindParam(35,$hizmetlerustbaslik_en,PDO::PARAM_STR);
       $guncelleme->bindParam(36,$hizmetlerbaslik_tr,PDO::PARAM_STR);
       $guncelleme->bindParam(37,$hizmetlerbaslik_en,PDO::PARAM_STR);

       $guncelleme->bindParam(38,$mesajtercih,PDO::PARAM_INT);
       $guncelleme->bindParam(39,$haritabilgi,PDO::PARAM_STR);
       $guncelleme->bindParam(40,$footer,PDO::PARAM_STR);
   		$guncelleme->execute();

   		echo '<div class="alert alert-success mt-5"><strong>Site Ayarları</strong> başarıyla güncellendi.</div>';
   		header("refresh:2,url=control.php?sayfa=siteayar");//2 saniye sonra istenilen sayfaya yönlendirir



    else:
    	?>
    	 <form action="control.php?sayfa=siteayar" method="POST">
                        <div class="row">
                             <div class="col-lg-9 mx-auto mt-2">
                               <h3 class="text-info">SİTE AYARLARI </h3>
                                 

                             </div>
<!--******************** -->
                             <div class="col-lg-9 border mx-auto mt-2">
                                <div class="row">

                                    <div class="col-lg-3 border-right pt-3 text-left">
                                        <span id="siteayarfont">Title</span>
                                    </div>
                                     <div class="col-lg-9 p-1">
                                        <input type="text" name="title" class="form-control" value="<?php echo $sonuc["title"]; ?>" />
                                    </div>


                                </div>
                                <!--******************** -->
                             </div>
                               <div class="col-lg-9 border mx-auto">
                                <div class="row">

                                     <div class="col-lg-3 border-right pt-3 text-left">
                                         <span id="siteayarfont"> Meta Title</span>
                                    </div>
                                    <div class="col-lg-9 p-1">
                                       <input type="text" name="metatitle" class="form-control" value="<?php echo $sonuc["metatitle"]; ?>"/>
                                    </div>
                                    </div>
                                </div>
                                 <div class="col-lg-9 border mx-auto">
                                <div class="row">

                                     <div class="col-lg-3 border-right pt-3 text-left">
                                         <span id="siteayarfont"> Meta Desc</span>
                                    </div>
                                    <div class="col-lg-9 p-1">
                                       <input type="text" name="metadesc" class="form-control" value="<?php echo $sonuc["metadesc"]; ?>"/>
                                    </div>
                                    </div>
                                </div>
                                 <div class="col-lg-9 border mx-auto">
                                <div class="row">

                                    <div class="col-lg-3 border-right pt-3 text-left">
                                         <span id="siteayarfont"> Meta Key</span>
                                    </div>
                                    <div class="col-lg-9 p-1">
                                       <input type="text" name="metakey" class="form-control" value="<?php echo $sonuc["metakey"]; ?>"/>
                                    </div>
                                    </div>
                                </div>
                                 <div class="col-lg-9 border mx-auto">
                                <div class="row">

                                     <div class="col-lg-3 border-right pt-3 text-left">
                                         <span id="siteayarfont"> Meta Author</span>
                                    </div>
                                    <div class="col-lg-9 p-1">
                                       <input type="text" name="metaauthor" class="form-control" value="<?php echo $sonuc["metaauthor"]; ?>"/>
                                    </div>
                                    </div>
                                </div>
                                 <div class="col-lg-9 border mx-auto">
                                <div class="row">

                                     <div class="col-lg-3 border-right pt-3 text-left">
                                         <span id="siteayarfont"> Meta Owner</span>
                                    </div>
                                    <div class="col-lg-9 p-1">
                                       <input type="text" name="metaowner" class="form-control" value="<?php echo $sonuc["metaowner"]; ?>"/>
                                    </div>
                                    </div>
                                </div>
                                 <div class="col-lg-9 border mx-auto">
                                <div class="row">

                                    <div class="col-lg-3 border-right pt-3 text-left">
                                         <span id="siteayarfont"> Meta Copy</span>
                                    </div>
                                    <div class="col-lg-9 p-1">
                                       <input type="text" name="metacopy" class="form-control" value="<?php echo $sonuc["metacopy"]; ?>"/>
                                    </div>
                                    </div>
                                </div>
                                 <div class="col-lg-9 border mx-auto">
                                <div class="row">

                                   <div class="col-lg-3 border-right pt-3 text-left">
                                         <span id="siteayarfont">Logo Yazısı</span>
                                    </div>
                                    <div class="col-lg-9 p-1">
                                       <input type="text" name="logoyazisi" class="form-control" value="<?php echo $sonuc["logoyazisi"]; ?>"/>
                                    </div>
                                    </div>
                                </div>
                                 <div class="col-lg-9 border mx-auto">
                                <div class="row">

                                    <div class="col-lg-3 border-right pt-3 text-left">
                                         <span id="siteayarfont"> Twitter</span>
                                    </div>
                                    <div class="col-lg-9 p-1">
                                       <input type="text" name="twitter" class="form-control" value="<?php echo $sonuc["twitter"]; ?>"/>
                                    </div>
                                    </div>
                                </div>
                                 <div class="col-lg-9 border mx-auto">
                                <div class="row">

                                    <div class="col-lg-3 border-right pt-3 text-left">
                                         <span id="siteayarfont">Facebook</span>
                                    </div>
                                    <div class="col-lg-9 p-1">
                                       <input type="text" name="facebook" class="form-control" value="<?php echo $sonuc["facebook"]; ?>"/>
                                    </div>
                                    </div>
                                </div>
                                 <div class="col-lg-9 border mx-auto">
                                <div class="row">

                                     <div class="col-lg-3 border-right pt-3 text-left">
                                         <span id="siteayarfont">İnstagram</span>
                                    </div>
                                    <div class="col-lg-9 p-1">
                                       <input type="text" name="instagram" class="form-control" value="<?php echo $sonuc["instagram"]; ?>"/>
                                    </div>
                                    </div>
                                </div>
                                 <div class="col-lg-9 border mx-auto">
                                <div class="row">

                                     <div class="col-lg-3 border-right pt-3 text-left">
                                         <span id="siteayarfont">Telefon No</span>
                                    </div>
                                    <div class="col-lg-9 p-1">
                                       <input type="text" name="telefonno" class="form-control" value="<?php echo $sonuc["telefonno"]; ?>"/>
                                    </div>
                                    </div>
                                </div>
                                 <div class="col-lg-9 border mx-auto">
                                <div class="row">

                                     <div class="col-lg-3 border-right pt-3 text-left">
                                         <span id="siteayarfont">Adres </span><span class="text-danger"> TR</span>
                                    </div>
                                    <div class="col-lg-9 p-1">
                                       <input type="text" name="adres_tr" class="form-control" value="<?php echo $sonuc["adres_tr"]; ?>"/>
                                    </div>
                                    </div>
                                </div>

                                 <div class="col-lg-9 border mx-auto">
                                <div class="row">

                                     <div class="col-lg-3 border-right pt-3 text-left">
                                         <span id="siteayarfont">Adres </span><span class="text-success"> EN</span>
                                    </div>
                                    <div class="col-lg-9 p-1">
                                       <input type="text" name="adres_en" class="form-control" value="<?php echo $sonuc["adres_en"]; ?>"/>
                                    </div>
                                    </div>
                                </div>

                                 <div class="col-lg-9 border mx-auto">
                                <div class="row">

                                     <div class="col-lg-3 border-right pt-3 text-left">
                                         <span id="siteayarfont">Mail Adres</span>
                                    </div>
                                    <div class="col-lg-9 p-1">
                                       <input type="text" name="mailadres" class="form-control" value="<?php echo $sonuc["mailadres"]; ?>"/>
                                    </div>
                                    </div>
                                </div>
                                 <div class="col-lg-9 border mx-auto">
                                <div class="row">

                                    <div class="col-lg-3 border-right pt-3 text-left">
                                         <span id="siteayarfont">Slogan  </span><span class="text-danger"> TR</span>
                                    </div>
                                    <div class="col-lg-9 p-1">
                                       <input type="text" name="slogan_tr" class="form-control" value="<?php echo $sonuc["slogan_tr"]; ?>"/>
                                    </div>
                                    </div>
                                </div>

                                    <!-- ***********************************************  -->
                                     <div class="col-lg-9 border mx-auto">
                                <div class="row">

                                    <div class="col-lg-3 border-right pt-3 text-left">
                                         <span id="siteayarfont">Slogan </span><span class="text-success"> EN</span>
                                    </div>
                                    <div class="col-lg-9 p-1">
                                       <input type="text" name="slogan_en" class="form-control" value="<?php echo $sonuc["slogan_en"]; ?>"/>
                                    </div>
                                    </div>
                                </div>
                                 <!-- ***********************************************  -->
                                 <div class="col-lg-9 border mx-auto">
                                <div class="row">

                                     <div class="col-lg-3 border-right pt-3 text-left">
                                         <span id="siteayarfont">Referans Üst Başlık</span><span class="text-danger"> TR</span>
                                    </div>
                                    <div class="col-lg-9 p-1">
                                       <input type="text" name="referansUstBaslik_tr" class="form-control" value="<?php echo $sonuc["referansUstBaslik_tr"]; ?>"/>
                                    </div>
                                    </div>
                                </div>
                                  <!-- ***********************************************  -->
                                 <div class="col-lg-9 border mx-auto">
                                <div class="row">

                                     <div class="col-lg-3 border-right pt-3 text-left">
                                         <span id="siteayarfont">Referans Üst Başlık </span><span class="text-success"> EN</span>
                                    </div>
                                    <div class="col-lg-9 p-1">
                                       <input type="text" name="referansUstBaslik_en" class="form-control" value="<?php echo $sonuc["referansUstBaslik_en"]; ?>"/>
                                    </div>
                                    </div>
                                </div>
                                 <!-- ***********************************************  -->
                                 <div class="col-lg-9 border mx-auto">
                                <div class="row">

                                     <div class="col-lg-3 border-right pt-3 text-left">
                                         <span id="siteayarfont">Referans Başlık </span><span class="text-danger"> TR</span>
                                    </div>
                                    <div class="col-lg-9 p-1">
                                       <input type="text" name="referansbaslik_tr" class="form-control" value="<?php echo $sonuc["referansbaslik_tr"]; ?>"/>
                                    </div>
                                    </div>
                                </div>
                             
                                 <!-- ***********************************************  -->
                                 <div class="col-lg-9 border mx-auto">
                                <div class="row">

                                     <div class="col-lg-3 border-right pt-3 text-left">
                                         <span id="siteayarfont">Referans Başlık </span><span class="text-success"> EN</span>
                                    </div>
                                    <div class="col-lg-9 p-1">
                                       <input type="text" name="referansbaslik_en" class="form-control" value="<?php echo $sonuc["referansbaslik_en"]; ?>"/>
                                    </div>
                                    </div>
                                </div>
                                 <!-- ***********************************************  -->
                                 <div class="col-lg-9 border mx-auto">
                                <div class="row">

                                     <div class="col-lg-3 border-right pt-3 text-left">
                                         <span id="siteayarfont">Filo Üst Başlık</span><span class="text-danger"> TR</span>
                                    </div>
                                    <div class="col-lg-9 p-1">
                                       <input type="text" name="filoustbaslik_tr" class="form-control" value="<?php echo $sonuc["filoustbaslik_tr"]; ?>"/>
                                    </div>
                                    </div>
                                </div>
                                  <!-- ***********************************************  -->
                                 <div class="col-lg-9 border mx-auto">
                                <div class="row">

                                     <div class="col-lg-3 border-right pt-3 text-left">
                                         <span id="siteayarfont">Filo Üst Başlık</span><span class="text-success"> EN</span>
                                    </div>
                                    <div class="col-lg-9 p-1">
                                       <input type="text" name="filoustbaslik_en" class="form-control" value="<?php echo $sonuc["filoustbaslik_en"]; ?>"/>
                                    </div>
                                    </div>
                                </div>
                              
                                 <!-- ***********************************************  -->


                                 <div class="col-lg-9 border mx-auto">
                                <div class="row">

                                     <div class="col-lg-3 border-right pt-3 text-left">
                                         <span id="siteayarfont">Filo Başlık</span><span class="text-danger"> TR</span>
                                    </div>
                                    <div class="col-lg-9 p-1">
                                       <input type="text" name="filobaslik_tr" class="form-control" value="<?php echo $sonuc["filobaslik_tr"]; ?>"/>
                                    </div>
                                    </div>
                                </div>
                                  <!-- ***********************************************  -->

                                 <div class="col-lg-9 border mx-auto">
                                <div class="row">

                                     <div class="col-lg-3 border-right pt-3 text-left">
                                         <span id="siteayarfont">Filo Başlık </span><span class="text-success"> EN</span>
                                    </div>
                                    <div class="col-lg-9 p-1">
                                       <input type="text" name="filobaslik_en" class="form-control" value="<?php echo $sonuc["filobaslik_en"]; ?>"/>
                                    </div>
                                    </div>
                                </div>
                                <!-- ***********************************************  -->
                                 <div class="col-lg-9 border mx-auto">
                                <div class="row">

                                     <div class="col-lg-3 border-right pt-3 text-left">
                                         <span id="siteayarfont">Yorum Üst Başlık</span><span class="text-danger"> TR</span>
                                    </div>
                                    <div class="col-lg-9 p-1">
                                       <input type="text" name="yorumustbaslik_tr" class="form-control" value="<?php echo $sonuc["yorumustbaslik_tr"]; ?>"/>
                                    </div>
                                    </div>
                                </div>
                                  <!-- ***********************************************  -->
                                 <div class="col-lg-9 border mx-auto">
                                <div class="row">

                                     <div class="col-lg-3 border-right pt-3 text-left">
                                         <span id="siteayarfont">Yorum Üst Başlık </span><span class="text-success"> EN</span>
                                    </div>
                                    <div class="col-lg-9 p-1">
                                       <input type="text" name="yorumustbaslik_en" class="form-control" value="<?php echo $sonuc["yorumustbaslik_en"]; ?>"/>
                                    </div>
                                    </div>
                                </div>

                                 <!-- ***********************************************  -->


                                 <div class="col-lg-9 border mx-auto">
                                 	<div class="row">

                                     <div class="col-lg-3 border-right pt-3 text-left">
                                         <span id="siteayarfont">Yorum Başlık </span><span class="text-danger"> TR</span>
                                    </div>
                                    <div class="col-lg-9 p-1">
                                       <input type="text" name="yorumbaslik_tr" class="form-control" value="<?php echo $sonuc["yorumbaslik_tr"]; ?>"/>
                                    </div>
                                    </div>
                                </div>
                                 <!-- ***********************************************  -->


                                 <div class="col-lg-9 border mx-auto">
                                    <div class="row">

                                     <div class="col-lg-3 border-right pt-3 text-left">
                                         <span id="siteayarfont">Yorum Başlık </span><span class="text-success"> EN</span>
                                    </div>
                                    <div class="col-lg-9 p-1">
                                       <input type="text" name="yorumbaslik_en" class="form-control" value="<?php echo $sonuc["yorumbaslik_en"]; ?>"/>
                                    </div>
                                    </div>
                                </div>
                                <!-- ***********************************************  -->
                                 <div class="col-lg-9 border mx-auto">
                                <div class="row">

                                     <div class="col-lg-3 border-right pt-3 text-left">
                                         <span id="siteayarfont">İletişim Üst Başlık</span><span class="text-danger"> TR</span>
                                    </div>
                                    <div class="col-lg-9 p-1">
                                       <input type="text" name="iletisimustbaslik_tr" class="form-control" value="<?php echo $sonuc["iletisimustbaslik_tr"]; ?>"/>
                                    </div>
                                    </div>
                                </div>
                                  <!-- ***********************************************  -->
                                 <div class="col-lg-9 border mx-auto">
                                <div class="row">

                                     <div class="col-lg-3 border-right pt-3 text-left">
                                         <span id="siteayarfont">İletişim Üst Başlık </span><span class="text-success"> EN</span>
                                    </div>
                                    <div class="col-lg-9 p-1">
                                       <input type="text" name="iletisimustbaslik_en" class="form-control" value="<?php echo $sonuc["iletisimustbaslik_en"]; ?>"/>
                                    </div>
                                    </div>
                                </div>
                                 <!-- ***********************************************  -->


                                <div class="col-lg-9 border mx-auto">
                                  <div class="row">

                                     <div class="col-lg-3 border-right pt-3 text-left">
                                         <span id="siteayarfont">İletisim Başlık </span><span class="text-danger"> TR</span>
                                    </div>
                                    <div class="col-lg-9 p-1">
                                       <input type="text" name="iletisimbaslik_tr" class="form-control" value="<?php echo $sonuc["iletisimbaslik_tr"]; ?>"/>
                                    </div>
                                    </div>
                                </div>
                                 <!-- ***********************************************  -->
                                  <div class="col-lg-9 border mx-auto">
                                  <div class="row">

                                     <div class="col-lg-3 border-right pt-3 text-left">
                                         <span id="siteayarfont">İletisim Başlık </span><span class="text-success"> EN</span>
                                    </div>
                                    <div class="col-lg-9 p-1">
                                       <input type="text" name="iletisimbaslik_en" class="form-control" value="<?php echo $sonuc["iletisimbaslik_en"]; ?>"/>
                                    </div>
                                    </div>
                                </div>
                                <!-- ***********************************************  -->
                                 <div class="col-lg-9 border mx-auto">
                                <div class="row">

                                     <div class="col-lg-3 border-right pt-3 text-left">
                                         <span id="siteayarfont">Hizmetler Üst Başlık</span><span class="text-danger"> TR</span>
                                    </div>
                                    <div class="col-lg-9 p-1">
                                       <input type="text" name="hizmetlerustbaslik_tr" class="form-control" value="<?php echo $sonuc["hizmetlerustbaslik_tr"]; ?>"/>
                                    </div>
                                    </div>
                                </div>
                                  <!-- ***********************************************  -->
                                 <div class="col-lg-9 border mx-auto">
                                <div class="row">

                                     <div class="col-lg-3 border-right pt-3 text-left">
                                         <span id="siteayarfont">Hizmetler Üst Başlık </span><span class="text-success"> EN</span>
                                    </div>
                                    <div class="col-lg-9 p-1">
                                       <input type="text" name="hizmetlerustbaslik_en" class="form-control" value="<?php echo $sonuc["hizmetlerustbaslik_en"]; ?>"/>
                                    </div>
                                    </div>
                                </div>
                                 <!-- ***********************************************  -->
                              <div class="col-lg-9 border mx-auto">
                                
                                <div class="row">

                                     <div class="col-lg-3 border-right pt-3 text-left">
                                         <span id="siteayarfont">Hizmetler Başlık </span><span class="text-danger"> TR</span>
                                    </div>
                                    <div class="col-lg-9 p-1">
                                       <input type="text" name="hizmetlerbaslik_tr" class="form-control" value="<?php echo $sonuc["hizmetlerbaslik_tr"]; ?>"/>
                                    </div>
                                    </div>
                                </div>
                                 <!-- ***********************************************  -->
                              <div class="col-lg-9 border mx-auto">
                                
                                <div class="row">

                                     <div class="col-lg-3 border-right pt-3 text-left">
                                         <span id="siteayarfont">Hizmetler Başlık </span><span class="text-success"> EN</span>
                                    </div>
                                    <div class="col-lg-9 p-1">
                                       <input type="text" name="hizmetlerbaslik_en" class="form-control" value="<?php echo $sonuc["hizmetlerbaslik_en"]; ?>"/>
                                    </div>
                                    </div>
                                </div>
                                 <!-- ***********************************************  -->
                              <div class="col-lg-9 border mx-auto">
                                
                                <div class="row">

                                     <div class="col-lg-3 border-right pt-3 text-left">
                                         <span id="siteayarfont">Harita Bilgisi</span>
                                    </div>
                                    <div class="col-lg-9 p-1">
                                       <input type="text" name="haritabilgi" class="form-control" value="<?php echo $sonuc["haritabilgi"]; ?>"/>
                                    </div>
                                    </div>
                                </div>
                                 <!-- ***********************************************  -->
                       
                              <div class="col-lg-9 border mx-auto">
                                
                                <div class="row">

                                     <div class="col-lg-3 border-right pt-3 text-left">
                                         <span id="siteayarfont">Footer Bilgisi</span>
                                    </div>
                                    <div class="col-lg-9 p-1">
                                       <input type="text" name="footer" class="form-control" value="<?php echo $sonuc["footer"]; ?>"/>
                                    </div>
                                    </div>
                                </div>
                         <!-- ***********************************************  -->

                              <div class="col-lg-9 border mx-auto">
                                
                                <div class="row">

                                     <div class="col-lg-3 border-right pt-3 text-left">
                                         <span id="siteayarfont">Mesaj Tercih</span>
                                    </div>
                                    <div class="col-lg-9 p-1">
                                      <div class="row">
                                        <div class="col-lg-4 pt-1 text-danger border-right">
                                           Sadece Mail
                                      <input type="radio" name="mesajtercih" value="1" class="mt-2 ml-2" <?php echo ($sonuc["mesajtercih"]==1) ? "checked='checked'":"" ?> />
                                        </div>
                                        <div class="col-lg-4 pt-1 text-danger border-right">
                                        Hem Mail Hem Mesaj
                                      <input type="radio" name="mesajtercih" value="2" class="mt-2 ml-2" <?php echo ($sonuc["mesajtercih"]==2) ? "checked='checked'":"" ?>/>
                                        </div>
                                        <div class="col-lg-4 pt-1 text-danger border-right">
                                      Sadece Mesaj
                                      <input type="radio" name="mesajtercih" value="3" class="mt-2 ml-2" <?php echo ($sonuc["mesajtercih"]==3) ? "checked='checked'":"" ?>/>
                                        </div>                                       
                                      </div>                                                                        
                                    </div>
                                    </div>
                                </div>
                                 <!-- ***********************************************  -->
                             
                              <div class="col-lg-9 border-bottom mx-auto mt-2">
                               <input type="submit" name="button" class="btn btn-rounded btn-info m-1" value="GÜNCELLE">
                                 

                             </div>

<!--******************** -->
                             


                        </div>


                        

                        </form>
    	<?php
    	//form ise burada

    endif;
	}

	function sifrele($veri){//şifreleme için gerekli olan fonksiyon

		 return base64_encode(gzdeflate(gzcompress(serialize($veri))));
		//64 bitlik bir veri ile gelen verinin şifrelenmesini sğlar
		//gzdeflate //gelen veriyi sıkıştırarak şifreler




	}
	function coz($veri){//şifrelemeyi çözmek için gerekli olan fonksiyon

		return unserialize(gzuncompress(gzinflate(base64_decode($veri))));


	}

	function kuladial($vt){//kullanıcı adını almak için fonksiyon

		$cookid=$_COOKIE["kulbilgi"];

		$cozduk=self::coz($cookid);

		$sorgusonuc=$this->sorgum($vt,"SELECT * FROM yonetim WHERE id=$cozduk",1);
		return $sorgusonuc["kulad"];


	}

	function giriskontrol($kulad,$sifre,$vt){//kullanıcının giriş yapması çin gerekli olan fonksiyon

		$sifrelihal=md5(sha1(md5($sifre)));//şifreyi direkt yazmak yerine kodlar
		//güvenliği arttırmak için birden çok fonksiyon kullanıldı

		$sor=$vt->prepare("SELECT * from yonetim where kulad='$kulad' and sifre='$sifrelihal'");


		$sor->execute();
		

		if($sor->rowCount()==0)://satır sayısı 0 a eşit değilse

			  echo '<div class="container-fluid bg-white">
        <div class="alert alert-white border border-danger mt-5 col-md-5 mx-auto p-3 text-dark font-14 font-weight-bold">Bilgiler Hatalı ! Yönlendiriliyor</div>
        </div>

        ';
			header("refresh:2,url=index.php");
		else:
			$gelendeger=$sor->fetch();

			$sor=$vt->prepare("UPDATE yonetim SET aktif=1 WHERE kulad='$kulad' and sifre='$sifrelihal'");
			$sor->execute();

			  echo '<div class="container-fluid bg-white">
        <div class="alert alert-white border border-info mt-5 col-md-5 mx-auto p-3 text-dark font-14 font-weight-bold">Giriş Yapılıyor! Control Sayfasına yönlendiriliyorsunuz </div>
        </div>

        ';
				header("refresh:2,url=control.php");

				//eğer giriş işlemi başarılı ise burada cookie oluşturulur

				$id=self::sifrele($gelendeger["id"]);
				//self this yerine kullanıldı

				setcookie("kulbilgi",$id,time() + 60*60*24);

		endif;



	}

	function cikis($vt){//kullanıcının çıkış yapması için gerekli olan fonksiyon

		$cookid=$_COOKIE['kulbilgi'];//idyi aldı

		$cozduk=$this->coz($cookid);//idyi çözdü

		$this->sorgum($vt,"UPDATE yonetim SET aktif=1 WHERE id=$cozduk",0);
		setcookie("kulbilgi",$cookid,time() - 5);
		  echo '<div class="container-fluid bg-white">
        <div class="alert alert-white border border-dark mt-5 col-md-5 mx-auto p-3 text-dark font-14 font-weight-bold">Çıkış Yapılıyor!! </div>
        </div>

        ';
				header("refresh:2,url=index.php");
	}

	function kontrolet($sayfa){
		/*

		-giriş yapan kullanıcının bilgilerini teyit etmek için db ye bağlanabilirsin
		-daha fazla kontrol için kullanılır


		*/

		if(isset($_COOKIE['kulbilgi']))://eğer kullanıcı tanımlı ise

			if($sayfa=="ind") : header("Location:control.php"); //eğer sayfaya verdiğin index değeri tanımlı ise control php ye yönlendir
			endif;


		else://kullanıcı tanımlı değil ise
			if($sayfa=="cot") : header("Location:index.php");endif;//eğer kullanıcı tanımlı değil ise control sayfasına giriş engellenir
		endif;


}


/*----------------İNTRO  BÖLÜMÜ ------------------*/

     function introayar($vt){
     	echo '<div class="row text-center">
     	<div class="col-lg-12"><h4 class="float-left mt-3 text-dark mb-2">
      <a href="control.php?sayfa=introresimekle" class="ti-plus bg-dark p-1 text-white mr-2 mt-3"></a>
      İNTRO RESİMLERİ</h4></div>

     	';
     	$introbilgiler=self::sorgum($vt,"SELECT * FROM intro",2);
     	//veritabanı sorgu ve tercih yer alır
     	while ($sonbilgi=$introbilgiler->fetch(PDO::FETCH_ASSOC)) ://gelen veri aktarılır
     	echo '<div class="col-lg-4">
     	<div class="row border-bottom  p-1 m-1">
     	<div class="col-lg-12">
     	<img src="../'.$sonbilgi["resimyol"].'">
      <kbd class="bg-white p-2" style="position:absolute; bottom:10px; right:10px;">

<a href="control.php?sayfa=introresimguncelle&id='.$sonbilgi["id"].'" class="ti-reload m-2 text-success" style="font-size:20px;"></a>
<a href="control.php?sayfa=introresimsil&id='.$sonbilgi["id"].'" class="ti-trash m-2 text-danger" style="font-size:20px;"></a>
      </kbd>
     	</div>
     	
     	</div>
     	</div>';
     	endwhile;
     	echo '</div>';

     }
     //mevcut introlar getiriliyor
     function introresimekleme($vt){//yeni intro eklemek için bu satır kullanılır
      echo '<div class="row text-center>
      <div class="col-lg-12">';
      if($_POST):
        //php işlemleri
        //ilk dosyanın boş olup olmaması
        //dosyanın boyutu
        //dosyanın uzantısı

        if($_FILES["dosya"]["name"]==""):
          echo '<div class="alert alert-danger mt-5">Dosya Yüklenmedi Boş Olamaz</div>';
          header("refresh:2,url=control.php?sayfa=introresimekle");
        else:
          //eğer boş değil ise
           if($_FILES["dosya"]["size"]>1024*1024*5):
             echo '<div class="alert alert-danger mt-5">Dosya Boyutu Çok Fazla</div>';
             header("refresh:2,url=control.php?sayfa=introresimekle");
           else:
            //boyutta bir problem yok ise
            $izinverilen =array("image/png","image/jpeg");//izin verilen dosyaların uzantıları
             if(!in_array($_FILES["dosya"]["type"],$izinverilen))://in arrayin yaptığı iş verilen dosya ile dosya tipinin uyup uymadığını karşılaştırmaktır

              echo '<div class="alert alert-danger mt-5">İzin Verilen Uzantı Değil</div>';
              header("refresh:2,url=control.php?sayfa=introresimekle");
            else://artık her şey tamam
            $dosyaminyolu='../img/carousel/'.$_FILES['dosya']['name'];

            move_uploaded_file($_FILES["dosya"]["tmp_name"],$dosyaminyolu);
            echo '<div class="alert alert-danger mt-5">Dosya Başarıyla Yüklendi</div>';
            header("refresh:2,url=control.php?sayfa=introayar");

            $dosyaminyolu2=str_replace('../','',$dosyaminyolu);//ne aranacak ne ile değişecek ve nereye gidecek
            //dosya yüklendikten sonra veritabanına kaydın eklenmesi lazım
            $kayitekle=self::sorgum($vt,"INSERT into intro (resimyol) values ('$dosyaminyolu2')",0);

             endif;
           endif;
        endif;
       
      else:
        ?>

        <div class="col-lg-4 mx-auto mt-2">
          <div class="card card-bordered">
            <div class="card-body">
              <h5 class="title border-bottom">İntro Resim Yükleme Formu</h5>
              <form action="" method="POST" enctype="multipart/form-data">
                <p class="card-text"><input type="file"  name="dosya"/></p>
                <input type="submit" name="buton" value="YÜKLE" class="btn btn-primary mb-1"/>
                <p class="card-text text-left text-danger border-top">
                  <!-- izin verilen formatlar: -->
                  
                  * İzin verilen formatlar : jpg-png<br/>
                  * İzin verilen max.boyut : 5MB

                </p>


              </form>
            </div>
          </div>
        </div>
        <?php 
endif;
echo '</div></div></div>';

     }

     function introsil($vt){//intro resim silme
      $introid=$_GET['id'];
      $verial=self::sorgum($vt,"SELECT * FROM intro where id=$introid",1);//resmin yolunu almak için ilk olarak veritabanından çekilir

      echo '<div class="row text-center"><div class="col-lg-12">';


      //dosyayı silme işlemi
      unlink("../".$verial["resimyol"]);

      //veritabanı veri silme işlemi
      self::sorgum($vt,"DELETE FROM intro where id=$introid",0);

      
      echo '<div class="alert alert-success mt-5">Silmeler Başarılı"</div>';

      echo '</div></div>';
      header("refresh:2,url=control.php?sayfa=introayar");
   

     }

     function introresimguncelleme($vt){

      $gelenintroid=$_GET['id'];

       echo '<div class="row text-center>
      <div class="col-lg-12">';
      if($_POST):
        //php işlemleri
        //ilk dosyanın boş olup olmaması
        //dosyanın boyutu
        //dosyanın uzantısı

        $formdangelenid=$_POST['introid'];

        if($_FILES["dosya"]["name"]==""):
          echo '<div class="alert alert-danger mt-5">Dosya Yüklenmedi Boş Olamaz</div>';
          header("refresh:2,url=control.php?sayfa=introayar");
        else:
          //eğer boş değil ise
           if($_FILES["dosya"]["size"]>1024*1024*5):
             echo '<div class="alert alert-danger mt-5">Dosya Boyutu Çok Fazla</div>';
             header("refresh:2,url=control.php?sayfa=introayar");
           else:
            //boyutta bir problem yok ise
            $izinverilen =array("image/png","image/jpeg");//izin verilen dosyaların uzantıları
             if(!in_array($_FILES["dosya"]["type"],$izinverilen))://in arrayin yaptığı iş verilen dosya ile dosya tipinin uyup uymadığını karşılaştırmaktır

              echo '<div class="alert alert-danger mt-5">İzin Verilen Uzantı Değil</div>';
              header("refresh:2,url=control.php?sayfa=introayar");
            else://artık her şey tamam


            //db den mevcut veri çekildi ve dosya silindi
            $resimyolunabak=self::sorgum($vt,"SELECT * FROM intro where id=$gelenintroid",1);
            $dbgelenyol="../".$resimyolunabak["resimyol"];

            unlink($dbgelenyol);
             //db den mevcut veri çekildi ve dosya silindi

           //dosyanın yeni gelen yolu
            $dosyaminyolu='../img/carousel/'.$_FILES['dosya']['name'];

            move_uploaded_file($_FILES["dosya"]["tmp_name"],$dosyaminyolu);
             $dosyaminyolu2=str_replace('../','',$dosyaminyolu);//ne aranacak ne ile değişecek ve nereye gidecek
            //dosya yüklendikten sonra veritabanına kaydın eklenmesi lazım
           self::sorgum($vt,"UPDATE intro SET resimyol='$dosyaminyolu2' where id=$gelenintroid",0);

            echo '<div class="alert alert-danger mt-5">Dosya Başarıyla Güncellendi</div>';
            header("refresh:2,url=control.php?sayfa=introayar");

           
             endif;
           endif;
        endif;
       
      else:
        ?>

        <div class="col-lg-4 mx-auto mt-2">
          <div class="card card-bordered">
            <div class="card-body">
              <h5 class="title border-bottom">İntro Resim Güncelleme Formu</h5>
              <form action="" method="POST" enctype="multipart/form-data">
                <p class="card-text"><input type="file"  name="dosya"/></p>
                 <p class="card-text"><input type="hidden"  name="introid" value="<?php echo $gelenintroid; ?>" /></p>
                <input type="submit" name="buton" value="YÜKLE" class="btn btn-primary mb-1"/>
                <p class="card-text text-left text-danger border-top">
                  <!-- izin verilen formatlar: -->
                  
                  * İzin verilen formatlar : jpg-png<br/>
                  * İzin verilen max.boyut : 5MB

                </p>


              </form>
            </div>
          </div>
        </div>
        <?php 
endif;
echo '</div></div></div>';



     }

     /*---------------------------ARAÇ FİLOSU-----------------*/


     function aracfilo($vt){//mevcut filo araçlar
      echo '<div class="row text-center">
      <div class="col-lg-12 border-bottom"><h4 class="float-left mt-3 text-dark mb-2">
      <a href="control.php?sayfa=aracfiloekle" class="ti-plus bg-dark p-1 text-white mr-2 mt-3"></a>
      ARAÇ FİLO RESİMLERİ</h4></div>
      

      ';
      $introbilgiler=self::sorgum($vt,"SELECT * FROM filomuz",2);
      //veritabanı sorgu ve tercih yer alır
      while ($sonbilgi=$introbilgiler->fetch(PDO::FETCH_ASSOC)) ://gelen veri aktarılır
      echo '<div class="col-lg-4">
      <div class="row border-bottom p-1 m-1">
      <div class="col-lg-12">
      <img src="../'.$sonbilgi["resimyol"].'">
      <kbd class="bg-white p-2" style="position:absolute; bottom:10px; right:10px;">

      <a href="control.php?sayfa=aracfiloguncelle&id='.$sonbilgi["id"].'" class="fa fa-edit m-2 text-success" style="font-size:20px;"></a>
      <a href="control.php?sayfa=aracfilosil&id='.$sonbilgi["id"].'" class="fa fa-trash m-2 text-danger" style="font-size:20px;"></a>
      </kbd>
      </div>
       
      </div>
      </div>';
      endwhile;
      echo '</div>';

     }
     
     function aracfiloekleme($vt){//yeni araç eklemek için bu satır kullanılır
      echo '<div class="row text-center>
      <div class="col-lg-12">';
      if($_POST):
        //php işlemleri
        //ilk dosyanın boş olup olmaması
        //dosyanın boyutu
        //dosyanın uzantısı

        if($_FILES["dosya"]["name"]==""):
          echo '<div class="alert alert-danger mt-5">Dosya Yüklenmedi Boş Olamaz</div>';
          header("refresh:2,url=control.php?sayfa=aracfiloekle");
        else:
          //eğer boş değil ise
           if($_FILES["dosya"]["size"]>1024*1024*5):
             echo '<div class="alert alert-danger mt-5">Dosya Boyutu Çok Fazla</div>';
             header("refresh:2,url=control.php?sayfa=aracfiloekle");
           else:
            //boyutta bir problem yok ise
            $izinverilen =array("image/png","image/jpeg");//izin verilen dosyaların uzantıları
             if(!in_array($_FILES["dosya"]["type"],$izinverilen))://in arrayin yaptığı iş verilen dosya ile dosya tipinin uyup uymadığını karşılaştırmaktır

              echo '<div class="alert alert-danger mt-5">İzin Verilen Uzantı Değil</div>';
              header("refresh:2,url=control.php?sayfa=aracfiloekle");
            else://artık her şey tamam
            $dosyaminyolu='../img/filo/'.$_FILES['dosya']['name'];

            move_uploaded_file($_FILES["dosya"]["tmp_name"],$dosyaminyolu);
            echo '<div class="alert alert-danger mt-5">Dosya Başarıyla Yüklendi</div>';
            header("refresh:2,url=control.php?sayfa=aracfilo");

            $dosyaminyolu2=str_replace('../','',$dosyaminyolu);//ne aranacak ne ile değişecek ve nereye gidecek
            //dosya yüklendikten sonra veritabanına kaydın eklenmesi lazım
            self::sorgum($vt,"INSERT into filomuz (resimyol) values ('$dosyaminyolu2')",0);

             endif;
           endif;
        endif;
       
      else:
        ?>

        <div class="col-lg-4 mx-auto mt-2">
          <div class="card card-bordered">
            <div class="card-body">
              <h5 class="title border-bottom">Araç Filo Resim Yükleme Formu</h5>
              <form action="" method="POST" enctype="multipart/form-data">
                <p class="card-text"><input type="file"  name="dosya"/></p>
                <input type="submit" name="buton" value="YÜKLE" class="btn btn-primary mb-1"/>
                <p class="card-text text-left text-danger border-top">
                  <!-- izin verilen formatlar: -->
                  
                  * İzin verilen formatlar : jpg-png<br/>
                  * İzin verilen max.boyut : 5MB

                </p>


              </form>
            </div>
          </div>
        </div>
        <?php 
endif;
echo '</div></div></div>';

     }

     function aracfilosil($vt){//araç silme
      $filoid=$_GET['id'];
      $verial=self::sorgum($vt,"SELECT * FROM filomuz where id=$filoid",1);//resmin yolunu almak için ilk olarak veritabanından çekilir

      echo '<div class="row text-center"><div class="col-lg-12">';


      //dosyayı silme işlemi
      unlink("../".$verial["resimyol"]);

      //veritabanı veri silme işlemi
      self::sorgum($vt,"DELETE FROM filomuz where id=$filoid",0);

      
      echo '<div class="alert alert-success mt-5">Silmeler Başarılı"</div>';

      echo '</div></div>';
      header("refresh:2,url=control.php?sayfa=aracfilo");
   

     }

     function aracfiloguncelleme($vt){//araç güncelleme

      $gelenfiloid=$_GET['id'];

       echo '<div class="row text-center>
      <div class="col-lg-12">';
      if($_POST):
        //php işlemleri
        //ilk dosyanın boş olup olmaması
        //dosyanın boyutu
        //dosyanın uzantısı

        $formdangelenid=$_POST['filoid'];

        if($_FILES["dosya"]["name"]==""):
          echo '<div class="alert alert-danger mt-5">Dosya Yüklenmedi Boş Olamaz</div>';
          header("refresh:2,url=control.php?sayfa=aracfilo");
        else:
          //eğer boş değil ise
           if($_FILES["dosya"]["size"]>1024*1024*5):
             echo '<div class="alert alert-danger mt-5">Dosya Boyutu Çok Fazla</div>';
             header("refresh:2,url=control.php?sayfa=aracfilo");
           else:
            //boyutta bir problem yok ise
            $izinverilen =array("image/png","image/jpeg");//izin verilen dosyaların uzantıları
             if(!in_array($_FILES["dosya"]["type"],$izinverilen))://in arrayin yaptığı iş verilen dosya ile dosya tipinin uyup uymadığını karşılaştırmaktır

              echo '<div class="alert alert-danger mt-5">İzin Verilen Uzantı Değil</div>';
              header("refresh:2,url=control.php?sayfa=aracfilo");
            else://artık her şey tamam


            //db den mevcut veri çekildi ve dosya silindi
            $resimyolunabak=self::sorgum($vt,"SELECT * FROM filomuz where id=$gelenfiloid",1);
            $dbgelenyol="../".$resimyolunabak["resimyol"];

            unlink($dbgelenyol);
             //db den mevcut veri çekildi ve dosya silindi

           //dosyanın yeni gelen yolu
            $dosyaminyolu='../img/filo/'.$_FILES['dosya']['name'];

            move_uploaded_file($_FILES["dosya"]["tmp_name"],$dosyaminyolu);
             $dosyaminyolu2=str_replace('../','',$dosyaminyolu);//ne aranacak ne ile değişecek ve nereye gidecek
            //dosya yüklendikten sonra veritabanına kaydın eklenmesi lazım
           self::sorgum($vt,"UPDATE filomuz SET resimyol='$dosyaminyolu2' where id=$gelenfiloid",0);

            echo '<div class="alert alert-danger mt-5">Dosya Başarıyla Güncellendi</div>';
            header("refresh:2,url=control.php?sayfa=aracfilo");

           
             endif;
           endif;
        endif;
       
      else:
        ?>

        <div class="col-lg-4 mx-auto mt-2">
          <div class="card card-bordered">
            <div class="card-body">
              <h5 class="title border-bottom">Araç Filo Resim Güncelleme Formu</h5>
              <form action="" method="POST" enctype="multipart/form-data">
                <p class="card-text"><input type="file"  name="dosya"/></p>
                 <p class="card-text"><input type="hidden"  name="filoid" value="<?php echo $gelenfiloid; ?>" /></p>
                <input type="submit" name="buton" value="YÜKLE" class="btn btn-primary mb-1"/>
                <p class="card-text text-left text-danger border-top">
                  <!-- izin verilen formatlar: -->
                  
                  * İzin verilen formatlar : jpg-png<br/>
                  * İzin verilen max.boyut : 5MB

                </p>


              </form>
            </div>
          </div>
        </div>
        <?php 
endif;
echo '</div></div></div>';



     }
  
   

     //---------------------GELEN MESAJ---------------------------
     private function mailgetir($vt,$veriler){
      //$veriler en üstte tanımlanmış olan arraydir. bu fonksiyonun içine verildi
      $sor=$vt->prepare("SELECT * FROM $veriler[0] WHERE durum=$veriler[1]");
//fonksiyona array verirsen ilk yazılan değeri buraya yapıştır.ikinci yazılan değeri ise durum= in karşısına yapıştır
      $sor->execute();
      return $sor;


     }
     function gelenmesaj($vt){
      //veritabanından mesajları çekerek  bilgi vermesini sağlar
      echo '<div class=row>
      <div class="col-lg-12 mt-2">
      <div class="card">
      <div class="card-body">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item">
      <a class="nav-link active" id="gelen-tab" data-toggle="tab" href="#gelen" role="tab" aria-control="gelen" aria-selected="true"><kbd>'.self::mailgetir($vt,array("gelenmail",0))->rowCount().'</kbd>Gelen Mesajlar</a></li>
<li class="nav-item">
        <a class="nav-link" id="okunmus-tab" data-toggle="tab" href="#okunmus" role="tab" aria-control="okunmus" aria-selected="false"><kbd>'.self::mailgetir($vt,array("gelenmail",1))->rowCount().'</kbd> Okunmuş Mesajlar</a></li>
<li class="nav-item">
          <a class="nav-link" id="arsiv-tab" data-toggle="tab" href="#arsiv" role="tab" aria-control="arsiv" aria-selected="false"><kbd>'.self::mailgetir($vt,array("gelenmail",2))->rowCount().'</kbd> Arşivlenmiş Mesajlar</a></li>
      </ul>
      <div class="tab-content mt-3" id="myTab">
      <div class="tab-pane fade show active" id="gelen" role="tabpanel" aria-labelledby="gelen-tab">';

      $sonuc=self::mailgetir($vt,array("gelenmail",0));//fonksiyona array yapısı ile veriler bu şekilde gönderilir.
      if($sonuc->rowCount()!=0)://eğer satır sayısı eşit değilse 0 a
      while($sonucson=$sonuc->fetch(PDO::FETCH_ASSOC)):
        echo '<div class="row">
        <div class="col-lg-12 bg-light mt-2 font-weight-bold" style="border-radius:5px; border:1px; solid #eeeeee;">
        <div class="row border-bottom">
        <div class="col-lg-1 p-1">Ad</div>
        <div class="col-lg-2 p-1 text-primary">'.$sonucson["ad"].'</div>
         <div class="col-lg-1 p-1">Mail Adres</div>
        <div class="col-lg-2 p-1 text-primary">'.$sonucson["mailadres"].'</div>
        <div class="col-lg-1 p-1">Konu</div>
        <div class="col-lg-2 p-1 text-primary">'.$sonucson["konu"].'</div>
        <div class="col-lg-1 p-1">Tarih</div>
        <div class="col-lg-1 p-1 text-primary">'.$sonucson["zaman"].'</div>
        <div class="col-lg-1 p-1">

       <a href="control.php?sayfa=mesajoku&id='.$sonucson["id"].'"><i class="fa fa-folder-open border-right pr-2 text-dark" style="font-size:20px;"></i></a>
      <a href="control.php?sayfa=mesajarsivle&id='.$sonucson["id"].'">  <i class="fa fa-share border-right pr-2 text-dark" style="font-size:20px;"></i></a>
<a href="control.php?sayfa=mesajsil&id='.$sonucson["id"].'">
<i class="fa fa-close  pr-2 text-dark" style="font-size:18px;"></i></a>


        </div>

        </div>
        </div>
        </div>

        ';


      endwhile;
    else:
      echo '<div class="alert alert-info">Gelen Mesaj Yok</div>';


    endif;


      echo'</div>
      <div class="tab-pane fade" id="okunmus" role="tabpanel" aria-labelledby="okunmus-tab">';
      $sonuc=self::mailgetir($vt,array("gelenmail",1));//fonksiyona array yapısı ile veriler bu şekilde gönderilir.
      if($sonuc->rowCount()!=0)://eğer satır sayısı eşit değilse 0 a
      while($sonucson=$sonuc->fetch(PDO::FETCH_ASSOC)):
        echo '<div class="row">
        <div class="col-lg-12 bg-light mt-2 font-weight-bold" style="border-radius:5px; border:1px; solid #eeeeee;">
        <div class="row border-bottom">
        <div class="col-lg-1 p-1">Ad</div>
        <div class="col-lg-2 p-1 text-primary">'.$sonucson["ad"].'</div>
         <div class="col-lg-1 p-1">Mail Adres</div>
        <div class="col-lg-2 p-1 text-primary">'.$sonucson["mailadres"].'</div>
        <div class="col-lg-1 p-1">Konu</div>
        <div class="col-lg-2 p-1 text-primary">'.$sonucson["konu"].'</div>
        <div class="col-lg-1 p-1">Tarih</div>
        <div class="col-lg-1 p-1 text-primary">'.$sonucson["zaman"].'</div>
        <div class="col-lg-1 p-1">

       <a href="control.php?sayfa=mesajoku&id='.$sonucson["id"].'"><i class="fa fa-folder-open border-right pr-2 text-dark" style="font-size:20px;"></i></a>
      <a href="control.php?sayfa=mesajarsivle&id='.$sonucson["id"].'">  <i class="fa fa-share border-right pr-2 text-dark" style="font-size:20px;"></i></a>
<a href="control.php?sayfa=mesajsil&id='.$sonucson["id"].'">
<i class="fa fa-close  pr-2 text-dark" style="font-size:20px;"></i></a>


        </div>

        </div>
        </div>
        </div>

        ';


      endwhile;
    else:
      echo '<div class="alert alert-info">Okunmuş Mesaj Yok</div>';


    endif;


      echo'</div>
      <div class="tab-pane fade" id="arsiv" role="tabpanel" aria-labelledby="arsiv-tab">';
      $sonuc=self::mailgetir($vt,array("gelenmail",2));//fonksiyona array yapısı ile veriler bu şekilde gönderilir.
      if($sonuc->rowCount()!=0)://eğer satır sayısı eşit değilse 0 a
      while($sonucson=$sonuc->fetch(PDO::FETCH_ASSOC)):
        echo '<div class="row">
        <div class="col-lg-12 bg-light mt-2 font-weight-bold" style="border-radius:5px; border:1px; solid #eeeeee;">
        <div class="row border-bottom">
        <div class="col-lg-1 p-1">Ad</div>
        <div class="col-lg-2 p-1 text-primary">'.$sonucson["ad"].'</div>
         <div class="col-lg-1 p-1">Mail Adres</div>
        <div class="col-lg-2 p-1 text-primary">'.$sonucson["mailadres"].'</div>
        <div class="col-lg-1 p-1">Konu</div>
        <div class="col-lg-2 p-1 text-primary">'.$sonucson["konu"].'</div>
        <div class="col-lg-1 p-1">Tarih</div>
        <div class="col-lg-1 p-1 text-primary">'.$sonucson["zaman"].'</div>
        <div class="col-lg-1 p-1">

       <a href="control.php?sayfa=mesajoku&id='.$sonucson["id"].'"><i class="fa fa-folder-open border-right pr-2 text-dark" style="font-size:20px;"></i></a>
      <a href="control.php?sayfa=mesajarsivle&id='.$sonucson["id"].'">  <i class="fa fa-share border-right pr-2 text-dark" style="font-size:20px;"></i></a>
<a href="control.php?sayfa=mesajsil&id='.$sonucson["id"].'">
<i class="fa fa-close  pr-2 text-dark" style="font-size:20px;"></i></a>


        </div>

     </div>
        </div>
        </div>

        ';


      endwhile;
    else:
      echo '<div class="alert alert-info">Arşivlenmiş Mesaj Yok</div>';


    endif;


      echo'
      </div>


      </div>
      </div>
      </div>
      </div>
      </div>


      ';



     }

     function mesajdetay($vt,$id){
     $mesajbilgi= self::sorgum($vt,"SELECT * FROM gelenmail WHERE id=$id",1);
       echo '<div class="row m-2">
        <div class="col-lg-12 bg-light mt-2 font-weight-bold" style="border-radius:5px; border:1px; solid #eeeeee;">
        <div class="row border-bottom">
        <div class="col-lg-1 p-1">Ad</div>
        <div class="col-lg-2 p-1 text-primary">'.$mesajbilgi["ad"].'</div>
         <div class="col-lg-1 p-1">Mail Adres</div>
        <div class="col-lg-2 p-1 text-primary">'.$mesajbilgi["mailadres"].'</div>
        <div class="col-lg-1 p-1">Konu</div>
        <div class="col-lg-2 p-1 text-primary">'.$mesajbilgi["konu"].'</div>
        <div class="col-lg-1 p-1">Tarih</div>
        <div class="col-lg-1 p-1 text-primary">'.$mesajbilgi["zaman"].'</div>
        <div class="col-lg-1 p-1">

       
      <a href="control.php?sayfa=mesajarsivle&id='.$mesajbilgi["id"].'">  <i class="fa fa-share border-right pr-2 text-dark" style="font-size:20px;"></i></a>
<a href="control.php?sayfa=mesajsil&id='.$mesajbilgi["id"].'">
<i class="fa fa-close  pr-2 text-dark" style="font-size:18px;"></i></a>

</div>
        </div>
        <div class="row text-left p-2">
        <div class="col-lg-12">
        '.$mesajbilgi["mesaj"].'

        </div>

        </div>

        
        </div>
        </div></div>

        ';


    //mesajın durumu güncelleniyor
 self::sorgum($vt,"UPDATE gelenmail SET durum=1 WHERE id=$id",0);


      
     }


     function mesajarsiv($vt,$id){//mesajları arşivlemek için
    
       echo '<div class="row m-2">
        <div class="col-lg-12  mt-2 font-weight-bold" style="border-radius:5px; border:1px; solid #eeeeee;">
        <div class="alert alert-info mt-5">MESAJ ARŞİVLENDİ</div>
        </div></div>

        ';
header("refresh:2,url=control.php?sayfa=gelenmesaj");

    //mesajın durumu güncelleniyor
 self::sorgum($vt,"UPDATE gelenmail SET durum=2 WHERE id=$id",0);


      
     }

     function mesajsil($vt,$id){//mesajları silmek için
    
       echo '<div class="row m-2">
        <div class="col-lg-12  mt-2 font-weight-bold" style="border-radius:5px; border:1px; solid #eeeeee;">
        <div class="alert alert-info mt-5">MESAJ SİLİNDİ</div>
        </div></div>

        ';
header("refresh:2,url=control.php?sayfa=gelenmesaj");

    //mesajın durumu güncelleniyor
 self::sorgum($vt,"DELETE FROM gelenmail WHERE id=$id",0);


      
     }



     /*---------------------------VİDEOLAR-----------------*/


     function videolar($vt){//mevcut filo araçlar
      echo '<div class="row text-center">
      <div class="col-lg-12 border-bottom"><h4 class="float-left mt-3 text-dark mb-2">
      <a href="control.php?sayfa=videoekle" class="ti-plus bg-dark p-1 text-white mr-2 mt-3"></a>
      VİDEOLAR</h4>

      <h6 class="float-right mt-3 text-dark mb-2">
      <a href="control.php?sayfa=videolar&tercih=1" class="ti-check bg-success p-1 text-white mr-2 mt-3"></a>
      <a href="control.php?sayfa=videolar&tercih=0" class="ti-close bg-danger p-1 text-white mr-2 mt-3"></a>

      </h6>



      </div>';
      if(@$_GET['tercih']!=""):

        $introbilgiler=self::sorgum($vt,"SELECT * FROM videolar WHERE durum=".$_GET['tercih'],2);
    else:

        $introbilgiler=self::sorgum($vt,"SELECT * FROM videolar",2);



      endif;
      
      //veritabanı sorgu ve tercih yer alır
      while ($sonbilgi=$introbilgiler->fetch(PDO::FETCH_ASSOC)) ://gelen veri aktarılır


      echo'<div class="col-lg-4 col-md-4 m-1">   
       <div class="row  p-1 m-1">
        <div class="col-lg-12">      
            <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'.$sonbilgi["link"].'" allowfullscreen></iframe>
            </div>
            
            <kbd class="bg-white p-1" style="position:absolute; bottom:30px; right:10px;">

      <a href="control.php?sayfa=videoguncelle&id='.$sonbilgi["id"].'" class="fa fa-edit m-2 text-success" style="font-size:20px;"></a>
      <a href="control.php?sayfa=videosil&id='.$sonbilgi["id"].'" class="fa fa-trash m-2 text-danger" style="font-size:20px;"></a>
      </kbd>
            </div>
            </div>
            <div class="col-lg-12 row">
            <div class="col-lg-6 text-info">

           <strong> Sıra:'.$sonbilgi["siralama"].'  Durum:'.$sonbilgi["durum"].'</strong>
            </div>
            </div>
            </div>';
      endwhile;
      echo '</div>';

     }
     
     function videoekle($vt){//yeni araç eklemek için bu satır kullanılır
      echo '<div class="row text-center>
      <div class="col-lg-12">';
      if($_POST):
        $videoyol=htmlspecialchars(strip_tags($_POST['videoyol']));
        $siralama=htmlspecialchars(strip_tags($_POST['siralama']));
        $durum=htmlspecialchars(strip_tags($_POST['durum']));
        if(empty($videoyol) || empty($siralama)):
             echo '<div class="alert alert-danger mt-12 mx-auto">ALANLAR BOŞ OLAMAZ</div>';
            header("refresh:2,url=control.php?sayfa=videoekle");


    else:
        self::sorgum($vt,"INSERT into videolar (link,siralama,durum) values ('$videoyol','$siralama','$durum')",0);
         echo '<div class="alert alert-success mt-12 mx-auto">Video Ekleme Başarılı</div>';
            header("refresh:2,url=control.php?sayfa=videolar");
endif;


        else:
      
        ?>


        <div class="col-lg-4 mx-auto mt-2">
          <div class="card card-bordered">
            <div class="card-body">
              <h5 class="title border-bottom">Video Ekleme Formu</h5>
              <form action="" method="POST">
                <p class="card-text"><input type="text"  name="videoyol" class="form-control" placeholder="Video Yolu" required="required" /></p>
                <p class="card-text"><input type="text"  name="siralama" class="form-control" placeholder="Video Sırası" required="required"  /></p>
                <p class="card-text">
                    <select name="durum" class="form-control">
                        <option value="1">Aktif</option>
                        <option value="0">Pasif</option>
                        
                    </select>
                </p>
                <input type="submit" name="buton" value="EKLE" class="btn btn-primary mb-1"/>
              </form>
            </div>
          </div>
        </div>
        <?php 
endif;
echo '</div></div></div>';

     }

     function videosil($vt){//araç silme
      $videoid=$_GET['id'];
      echo '<div class="row text-center">
      <div class="col-lg-12">';

      //veritabanı veri silme işlemi
      self::sorgum($vt,"DELETE FROM videolar where id=$videoid",0);

      
      echo '<div class="alert alert-success mt-5">VİDEO BAŞARILI BİR ŞEKİLDE SİLİNDİ"</div>';

      echo '</div></div>';
      header("refresh:2,url=control.php?sayfa=videolar");
   

     }

     function videoguncelleme($vt){//araç güncelleme

      $videoid=$_GET['id'];
       $introbilgiler=self::sorgum($vt,"SELECT * FROM videolar WHERE id=$videoid",2);
      //veritabanı sorgu ve tercih yer alır
      $sonbilgi=$introbilgiler->fetch(PDO::FETCH_ASSOC);//gelen veri aktarılır

      $tumvideolar=self::sorgum($vt,"SELECT * FROM videolar",2);
      //veritabanı sorgu ve tercih yer alır
      



       echo '<div class="row text-center>
      <div class="col-lg-12">';
      if($_POST):
        $videoyol=htmlspecialchars(strip_tags($_POST['videoyol']));
        $siralama=htmlspecialchars(strip_tags($_POST['siralama']));
        $mevcutsira=htmlspecialchars(strip_tags($_POST['mevcutsira']));
        $durum=htmlspecialchars(strip_tags($_POST['durum']));
        if(empty($videoyol) || empty($siralama)):
             echo '<div class="alert alert-danger mt-12 mx-auto">ALANLAR BOŞ OLAMAZ</div>';
            header("refresh:2,url=control.php?sayfa=videoguncelle");

    else:
    self::sorgum($vt,"UPDATE videolar SET  siralama=$mevcutsira WHERE siralama=$siralama",0);

    self::sorgum($vt,"UPDATE videolar SET  link='$videoyol',siralama='$siralama',durum='$durum' WHERE id='$videoid'",0);

         echo '<div class="alert alert-success mt-12 mx-auto">Video Güncelleme Başarılı</div>';
            header("refresh:2,url=control.php?sayfa=videolar");

endif;
        else:
      
        ?>


        <div class="col-lg-4 mx-auto mt-2">
          <div class="card card-bordered">
            <div class="card-body">
              <h5 class="title border-bottom">Video Güncelleme Formu</h5>
              <form action="" method="POST">
                <p class="card-text text-danger">Link:<input type="text"  name="videoyol" class="form-control" value="<?php echo $sonbilgi["link"]; ?>" /></p>
                <p class="card-text text-danger">Sırası:<?php echo $sonbilgi["siralama"];  ?>
                    <select name="siralama" class="form-control">
                    <?php 

                    while($tumvideolarson=$tumvideolar->fetch(PDO::FETCH_ASSOC))://gelen veri aktarılır

                    if($tumvideolarson["siralama"]!=$sonbilgi["siralama"]):
                        echo '<option value="'.$tumvideolarson["siralama"].'">'.$tumvideolarson["siralama"].'</option>';

                    endif;
                endwhile;


                    ?>
                </select>
                   
                <p class="card-text text-danger">Durum:
                    <select name="durum" class="form-control">
                        <?php
                        if( $sonbilgi["durum"]==0):
                            echo '<option value="0" selected="selected">Pasif</option>
                            <option value="1">Aktif</option>';
                        else:
                        echo '<option value="0">Pasif</option>
                            <option value="1"  selected="selected">Aktif</option>';
                    endif;
                            ?>
                        
                       
                        
                    </select>
                </p>
                <input type="hidden" name="mevcutsira" value="<?php echo $sonbilgi["siralama"]; ?>"/>
                <input type="submit" name="buton" value="GÜNCELLE" class="btn btn-primary mb-1"/>
              </form>
            </div>
          </div>
        </div>
        <?php 
endif;
echo '</div></div></div>';


     }
  
 

}
?>