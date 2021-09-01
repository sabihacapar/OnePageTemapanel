<?php
session_start();//bir sayfada eğer session kullanılacaksa bunu sayfanın en başında başlatmak lazım

include_once("lib/fonksiyon.php");
include_once("lib/tasarim.php");


$sinif=new kurumsal;
$tas=new tasarim;



 ?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8">
  <title><?php echo $sinif->normaltitle;?></title>
  <meta name="title" content="<?php echo $sinif->metatitle;?>"/>
  <meta name="description" content="<?php echo $sinif->metadesc;?>"/>
  <meta name="keywords" content="<?php echo $sinif->metakey;?>"/>
  <meta name="aouthor" content="<?php echo $sinif->metaaout;?>"/>
  <meta name="owner" content="<?php echo $sinif->metaaout;?>"/>
  <meta name="copyright" content="<?php echo $sinif->metaaout;?>"/>


  <!-- Fontlar -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800|Montserrat:300,400,700" rel="stylesheet">

  <!-- Bootstrap stil dosyası -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- işimize yarayacak diğer kütüphane css dosyalarımız -->
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="lib/magnific-popup/magnific-popup.css" rel="stylesheet">
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">

  <!-- bizim stil dosyamız -->
  <link href="css/style.css" rel="stylesheet">


  <!-- Kütüphaneler -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/jquery/jquery-migrate.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/superfish/hoverIntent.js"></script>
  <script src="lib/superfish/superfish.min.js"></script>
  <script src="lib/wow/wow.min.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="lib/magnific-popup/magnific-popup.min.js"></script>
  <script src="lib/sticky/sticky.js"></script>
  <script src="js/main.js"></script>


<script>

  $(document).ready(function(e){//sayfa açıldığı zaman direkt çalışması için bir kod blogu
$('#gonderbtn').click(function(){//tıklandığında ne yapmasını istiyorsak

$.ajax({
  type:"POST",
  url:'lib/mail/gonder.php',
  data:$('#mailform').serialize(),//bu butonu kapsayan tüm inputların değerini burada al
success:function(donen){//donen dosyanın verdiği cevap
$('#mailform').trigger("reset");//formu resetlemek için
$('#formtutucu').fadeOut(500);//formu yok etmek için
$('#mesajsonuc').html(donen);//html tutucu

},



});
});

  });
  

</script>
</head>

<body id="body">

<!-- ÜST BAR -->

<section id="topbar" class="d-none d-lg-block">
<div class="container clearfix">

	<div class="contact-info float-left">
    <i class="fa fa-envelope-o"></i><a href="<?php echo $sinif->mailadres;?>"><?php echo $sinif->mailadres;?></a>
    <i class="fa fa-phone"></i><?php echo $sinif->telno;?>    
    
    </div>    
    <div class="social-links float-right">    
    <a href="<?php echo $sinif->tvit;?>" class="twitter"><i class="fa fa-twitter"></i></a>
     <a href="<?php echo $sinif->face;?>" class="facebook"><i class="fa fa-facebook"></i></a>
      <a href="<?php echo $sinif->insta;?>" class="instagram"><i class="fa fa-instagram"></i></a> 

          <a href="index.php?dil=tr" class="twitter">TR</a>
          <a href="index.php?dil=en" class="twitter">EN</a>



      </div>
</div>

</section> 

<?php
@$dil=$_GET["dil"];
if($dil=="tr"|| $dil=="en"):
   @$_SESSION["dil"]=$dil;//hangi dil seçilmiş ise ata,Session olarak atanmasının nedeni sistemde dolaşabiliyor olması
  header("Location:index.php");
elseif(!isset($_SESSION["dil"]))://eğer hiçbir tercih yoksa direkt türkçeye ata
  $_SESSION["dil"]="tr";
endif;

  



 ?>


<!-- header -->

<header id="header">

	<div class="container">
    
    	<div id="logo" class="pull-left">
        <h1><a href="#body" class="scrollto"><?php echo $sinif->logoyazi;?></a></h1>
        
        
        </div>
        
        
        <nav id="nav-menu-container">
        <ul class="nav-menu"> 
        <?php $sinif->linkler($baglanti); ?>
       
        
        </ul>
        </nav>
    
    </div>




</header>


<!-- İNTRO -->

<section id="intro">


<div class="intro-content">
<h2><?php echo $sinif->slogan;?></h2>



</div>


<div id="intro-carousel" class="owl-carousel">

<?php 
 $sinif->introbak($baglanti);
?>





</div>




</section>


<!-- ana main -->
<main id="main">

<section id="hakkimizda" class="wow fadeInUp">

<div class="container">

		<?php $sinif->hakkimizda($baglanti); ?><!-- hakkımızda sayfasının bilgilerini bu kısımda alırız -->

</div>




</section>

<!-- hizmet -->
<?php $tas->HizmetTasarimDuzen($baglanti); ?>

<!-- referanslar -->

<?php $tas->ReferansTasarimDuzen($baglanti); ?>


<!-- Filomuz -->


<section id="filo" class="wow fadeInUp">
<?php $sinif->filomuz($baglanti); ?>

</section>

<!-- Vidoelar -->


<?php $tas->VideoTasarimDuzen($baglanti); ?>


<!-- müşteri Yorumlar -->


<?php $tas->YorumTasarimDuzen($baglanti); ?>



<!-- iletişim -->

<section id="iletisim" class="wow fadeInUp">

<div class="container">


			<div class="section-header">
       <h2><?php echo $sinif->iletisimustbaslik; ?></h2>
        <p><?php echo $sinif->iletisimbaslik; ?> </p>
   		 </div>
         
         <div class="row contact-info">
         
         <div class="col-md-4">
         <div class="contact-address">
         <i class="ion-ios-location-outline"></i>
         <h3><?php echo $sinif->adresbaslik;?></h3>
         <address><?php echo $sinif->normaladres;?></address>
         </div>
         </div>
         
          <div class="col-md-4">
         <div class="contact-phone">
         <i class="ion-ios-telephone-outline"></i>
         <h3><?php echo $sinif->telnobaslik;?></h3>
         <p><a href="<?php echo $sinif->telno;?>"><?php echo $sinif->telno;?></a></p>
         </div>
         </div>
         
          <div class="col-md-4">
         <div class="contact-email">
         <i class="ion-ios-email-outline"></i>
         <h3>Mail</h3>
         <p><a href="<?php echo $sinif->mailadres;?>"><?php echo $sinif->mailadres;?></a></p>
         </div>
         </div>
         
         
         
</div>

</div>

<div class="container mb-4">
<iframe src="<?php echo $sinif->haritabilgi;?>" width="100%" height="380" frameborder="0" style="border:0" allowfullscreen></iframe>

</div>


<div class="container">
<div class="form">

<div id="mesajsonuc"></div>

<div id="formtutucu">
<form id="mailform">

<div class="form-row">

<div class="form-group col-md-6">
<input type="text" name="isim" class="form-control" placeholder="<?php echo $sinif->ad;?>" required="required" />

</div>

<div class="form-group col-md-6">
<input type="text" name="mail" class="form-control" placeholder="<?php echo $sinif->mail;?>" required="required" />

</div>
</div>



<div class="form-group">
<input type="text" name="konu" class="form-control" placeholder="<?php echo $sinif->mesajkonu;?>" required="required" />
</div>

<div class="form-group">
<textarea class="form-control" name="mesaj" rows="5"></textarea>
</div>



<div class="text-center">
  <input type="button" id="gonderbtn"  value="<?php echo $sinif->buton;?>"  class="btn btn-info"/>
</div>

</form>
</div>


</div>
</div>
</section>


</main>

<!-- footer -->

<footer id="footer">

<div class="container">
<div class="copyright">
<?php echo $sinif->footer;?>
</div>
<div class="credits">
<?php echo $sinif->metaown;?>
</div>
</div>
</footer>
<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>


</body>
</html>
