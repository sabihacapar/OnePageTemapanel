<?php 


 try{
	$baglanti=new PDO("mysql:host=localhost;dbname=kurumsal;charset=utf8","root","");//veritabanı bağlantısının yapıldığı kısımdır.sunucu veritabanı adı kullanıcı adı ve şifreyi içerir.
	$baglanti->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);//hataları yakalamak için kullanılır,bir defa yazılması yeterlidir.

}catch(PDOException $e){//bağlantı hatası,şifre hatası,veritabanı hatası vs gibi hataları yakalayabilmek için Try catch in içindeki catch kısmında hatalar yakalanır
	die($e->getMessage());//eğer bir hata var ise

}

class kurumsal{
	//sayfa dahil edildiğinde içindeki kodlar çalışır.
	public $normaltitle,$metatitle,$metadesc,$metakey,$metaaout,$metaown,$metacopy,$logoyazi,$tvit,$face,$insta,$telno,$telnobaslik,$mailadres,$normaladres,$adresbaslik,$slogan,$referansbaslik,$referansustbaslik,$filobaslik,$filoustbaslik,$yorumbaslik,$yorumustbaslik,$iletisimbaslik,$iletisimustbaslik,$hizmetlerbaslik,$haritabilgi,$footer,$ad,$mail,$mesajkonu,$buton,$hizmetlerustbaslik,$videoUstBaslik,$videobaslik;

protected $linkidleri=array();

	function __construct(){//ayarların gelmesi için



    try{
	$baglanti=new PDO("mysql:host=localhost;dbname=kurumsal;charset=utf8","root","");//veritabanı bağlantısının yapıldığı kısımdır.sunucu veritabanı adı kullanıcı adı ve şifreyi içerir.
	$baglanti->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);//hataları yakalamak için kullanılır,bir defa yazılması yeterlidir.

}catch(PDOException $e){//bağlantı hatası,şifre hatası,veritabanı hatası vs gibi hataları yakalayabilmek için Try catch in içindeki catch kısmında hatalar yakalanır
	die($e->getMessage());//eğer bir hata var ise

}




		//class çağırıldığında ilk çalışacak fonksiyon burasıdır.
		$ayarcek=$baglanti->prepare("SELECT * FROM ayarlar");
		$ayarcek->execute();//sorguyu çalıştırır
		$sorguson=$ayarcek->fetch();//gelen sonuçları arraye atmak için

		//veritabanından gelen veri ile yukarıda tanımlanan veriyi birbirine kaynaştırmak için

		$this->normaltitle=$sorguson["title"];//veritabanındaki title erişmek için ,diğer sayfada class çağırıldığında direkt erişim gerçekleşir.
		$this->metatitle=$sorguson["metatitle"];
		$this->metadesc=$sorguson["metadesc"];
		$this->metakey=$sorguson["metakey"];
		$this->metaaout=$sorguson["metaauthor"];
		$this->metaown=$sorguson["metaowner"];
		$this->metacopy=$sorguson["metacopy"];
		$this->tivit=$sorguson["twitter"];
		$this->face=$sorguson["facebook"];
		$this->insta=$sorguson["instagram"];
		$this->telno=$sorguson["telefonno"];
		$this->mailadres=$sorguson["mailadres"];
		$this->logoyazi=$sorguson["logoyazisi"];

		
		$this->haritabilgi=$sorguson["haritabilgi"];
		$this->footer=$sorguson["footer"];
		

		if(@$_SESSION["dil"]=="tr"):
			$this->slogan=$sorguson["slogan_tr"];
			//------------REFRANSLAR--------------
			$this->referansbaslik=$sorguson["referansbaslik_tr"];
			$this->referansustbaslik=$sorguson["referansUstBaslik_tr"];
			//------------FİLO--------------
			$this->filobaslik=$sorguson["filobaslik_tr"];
			$this->filoustbaslik=$sorguson["filoustbaslik_tr"];
			//------------YORUMLAR--------------
			$this->yorumbaslik=$sorguson["yorumbaslik_tr"];
			$this->yorumustbaslik=$sorguson["yorumustbaslik_tr"];
			//---------İLETİŞİM------------------------
			$this->iletisimbaslik=$sorguson["iletisimbaslik_tr"];
			$this->iletisimustbaslik=$sorguson["iletisimustbaslik_tr"];
			$this->ad=$sorguson["ad_tr"];
			$this->mail=$sorguson["mailadres_tr"];
			$this->mesajkonu=$sorguson["konu_tr"];
			$this->buton=$sorguson["buton_tr"];

			//----------LOGO YAZISI--------
			//---------------adres------------
			$this->normaladres=$sorguson["adres_tr"];
			$this->adresbaslik=$sorguson["adresbaslik_tr"];
			//--------telefon------
			$this->telnobaslik=$sorguson["telbaslik_tr"];
			//----------HİZMETLER-------------
			$this->hizmetlerbaslik=$sorguson["hizmetlerbaslik_tr"];
			$this->hizmetlerustbaslik=$sorguson["hizmetlerustbaslik_tr"];
			//----------VİDEOLAR-------------
			$this->videobaslik=$sorguson["videobaslik_tr"];
			$this->videoUstBaslik=$sorguson["videoUstBaslik_tr"];









			elseif(@$_SESSION["dil"]=="en"):
			$this->slogan=$sorguson["slogan_en"];
			//------------REFRANSLAR İNGİLİZCE-------------
			$this->referansbaslik=$sorguson["referansbaslik_en"];
			$this->referansustbaslik=$sorguson["referansUstBaslik_en"];
			//------------FİLO İNGİLİZCE--------------
			$this->filobaslik=$sorguson["filobaslik_en"];
			$this->filoustbaslik=$sorguson["filoustbaslik_en"];
			//------------YORUMLAR--------------
			$this->yorumbaslik=$sorguson["yorumbaslik_en"];
			$this->yorumustbaslik=$sorguson["yorumustbaslik_en"];
			//---------İLETİŞİM------------------------
			$this->iletisimbaslik=$sorguson["iletisimbaslik_en"];
			$this->iletisimustbaslik=$sorguson["iletisimustbaslik_en"];
			$this->ad=$sorguson["ad_en"];
			$this->mail=$sorguson["mailadres_en"];
			$this->mesajkonu=$sorguson["konu_en"];
			$this->buton=$sorguson["buton_en"];
			
			//---------------adres------------
			$this->normaladres=$sorguson["adres_en"];
			$this->adresbaslik=$sorguson["adresbaslik_en"];
			//--------telefon------
			$this->telnobaslik=$sorguson["telbaslik_en"];
			//----------HİZMETLER-------------
			$this->hizmetlerbaslik=$sorguson["hizmetlerbaslik_en"];
			$this->hizmetlerustbaslik=$sorguson["hizmetlerustbaslik_en"];
			//----------VİDEOLAR-------------
			$this->videobaslik=$sorguson["videobaslik_en"];
			$this->videoUstBaslik=$sorguson["videoUstBaslik_en"];





		endif;





	}
	function introbak($baglanti){
		$introal=$baglanti->prepare("SELECT * FROM intro");
		$introal->execute();

		while($sonucum=$introal->fetch(PDO::FETCH_ASSOC)):
			
			echo '<div class="item" style="background-image:url('.$sonucum["resimyol"].');"></div>';

		endwhile;

	}

	function hakkimizda($baglanti){//hakkımızda sayfasının işlemleri için kullanılır
		$introal=$baglanti->prepare("SELECT * FROM hakkimizda");
		$introal->execute();

		$sonucum=$introal->fetch();//tek bir sorgu çekerken sadece fetch kullanmak yeterlidir
			echo '<div class="row">
        
        <div class="col-lg-6 hakkimizda-img">
        <img src="'.$sonucum["resim"].'"  alt="'.$sonucum["resim"].'-Hakkında"/>
        
        </div>
        
        
        
        <div class="col-lg-6 content">
        <h2>'.$sonucum["baslik_".$_SESSION["dil"]].'</h2>
        <h3>'.$sonucum["icerik_".$_SESSION["dil"]].'</h3>
        
        
        
        </div>

 </div>';
			



	}

	function hizmetler($baglanti,$baslik=false){//hizmetler sayfasının işlemleri için kullanılır
		$introal=$baglanti->prepare("SELECT * FROM hizmetler");
		$introal->execute();

		
			echo '<div class="section-header">
        <h2>'.$this->hizmetlerustbaslik.'</h2>
        <p>'.$baslik. '</p>
   		 </div>
    
    <div class="row">';
    while($sonucum=$introal->fetch(PDO::FETCH_ASSOC))://tek bir sorgu çekerken sadece fetch kullanmak yeterlidir;
    echo '	<div class="col-lg-6">
            	<div class="box wow fadeInTop">
                	<div class="icon"><i class="fa fa-certificate"></i></div>
                    <h4 class="title"><a href="#">'.$sonucum["baslik_".$_SESSION["dil"]].'</a></h4>
                    <p class="description">'.$sonucum["icerik_".$_SESSION["dil"]].'</p>
                    </div> 
                  </div>';
  endwhile;
    
   echo '</div>';
			



	}

	function referans($baglanti,$baslik=false){
		$introal=$baglanti->prepare("SELECT * FROM referanslar");
		$introal->execute();
		echo '<div class="section-header">
        <h2>'.$this->referansustbaslik.'</h2>
        <p>'.$baslik. '</p>
   		 </div>
         
         <div class="owl-carousel clients-carousel">
      ';
      //daha önce ayarlar tablosundan referans başlığı çektiğimiz için tekrardan çekmeye gerek yoktur

		while($sonucum=$introal->fetch(PDO::FETCH_ASSOC)):
			
			echo '<img src="'.$sonucum["resimyol"].'" alt="Referans - '.$sonucum["id"].' " />';
		endwhile;
		echo '</div>';

	}


	function filomuz($baglanti){
		$introal=$baglanti->prepare("SELECT * FROM filomuz");
		$introal->execute();
        
       echo '<div class="container">


		<div class="section-header">
        <h2>'.$this->filoustbaslik.'</h2>
        <p>'; echo $this->filobaslik; echo  '</p>
   		 </div>
         </div>
         
         
         
         
         <div class="container-fluid">
         <div class="row no-gutters">';

         while($sonucum=$introal->fetch(PDO::FETCH_ASSOC)):

         	echo'	<div class="col-lg-3 col-md-4">         
         	<div class="filo-item wow fadeInUp">            
            <a href="'.$sonucum["resimyol"].'" class="filo-popup">
            <img src="'.$sonucum["resimyol"].'" alt="Referans - '.$sonucum["id"].'" />
            <div class="filo-overlay">
            
            </div>
            </a>
            </div>
            </div>';
			
		endwhile;




         
         
           echo '</div></div>';

	}


function yorumlar($baglanti,$baslik=false){
		$introal=$baglanti->prepare("SELECT * FROM yorumlar");
		$introal->execute();



		echo '	<div class="section-header">
        <h2>'.$this->yorumustbaslik.'</h2>
        <p>'.$baslik. '</p>
   		 </div>
         
         <div class="owl-carousel testimonials-carousel">';


         while($sonucum=$introal->fetch(PDO::FETCH_ASSOC)):

         	echo '
         	<div class="testimonial-item">
            
            <p>
            <img src="img/sol.png" class="quote-sign-left" />
           '.$sonucum["icerik"].'
            <img src="img/sag.png" class="quote-sign-right" />
            </p>
            <img src="img/yorum.jpg" class="testimonial-img" alt="Müşteri Yorum -'.$sonucum["id"].'" />
            <h3>'.$sonucum["isim"].'</h3>
            </div>';
		endwhile;  
echo '</div>';
         
               

	}

	function linkler($db){

		$tercihbak=$db->prepare("SELECT hiztercih,videotercih FROM tasarim");
		$tercihbak->execute();
		$gelen=$tercihbak->fetch();

		$arama=$db->prepare("SELECT * FROM linkler where ad_tr LIKE ? or ad_tr LIKE ?");
		$arama->execute(array('hizmet%','video%'));

		while($d=$arama->fetch()):
			$this->linkidleri[]=$d["id"];


		endwhile;




		$linkal=$db->prepare("SELECT * FROM linkler order by siralama asc");
		$linkal->execute();
		$sayi=0;
		while($linkson=$linkal->fetch(PDO::FETCH_ASSOC)):
			if($sayi==0):
			echo '<li class="menu-active"><a href="'.$linkson["etiket"].'">'.$linkson["ad_".$_SESSION["dil"]].'</a></li>';
			$sayi=1;
		else:
			if($linkson["id"]==$this->linkidleri[0])://eğer id 3 eşitse
				if($gelen["hiztercih"]==0)://ve gelen hiztercih 0 a eşitse
	        echo '<li><a href="'.$linkson["etiket"].'">'.$linkson["ad_".$_SESSION["dil"]].'</a></li>';
	     else:
	     	continue;//eğer değilse döngüyü başa dönderip bir sonraki elemana geç
          endif;
          elseif($linkson["id"]==$this->linkidleri[1])://eğer id 3 eşitse
				if($gelen["videotercih"]==0)://ve gelen hiztercih 0 a eşitse
	        echo '<li><a href="'.$linkson["etiket"].'">'.$linkson["ad_".$_SESSION["dil"]].'</a></li>';
	     else:
	     	continue;//eğer değilse döngüyü başa dönderip bir sonraki elemana geç
          endif;
       else:

       		echo '<li><a href="'.$linkson["etiket"].'">'.$linkson["ad_".$_SESSION["dil"]].'</a></li>';
			endif;
			endif;
		endwhile;


	}


	function videolar($baglanti){
		
		$videoal=$baglanti->prepare("SELECT * FROM videolar WHERE  durum=1 ORDER BY siralama asc");
		$videoal->execute();
        
       echo '<div class="container">


		<div class="section-header">
        <h2>'.$this->videoUstBaslik.'</h2>
        <p>'; echo $this->videobaslik; echo  '</p>
   		 </div>
         </div>
         
         
         
         
         <div class="container">
         <div class="row no-gutters">';

         while($sonucum=$videoal->fetch(PDO::FETCH_ASSOC)):

         	echo'<div class="col-lg-3 col-md-4 m-1">         
         	<div class="embed-responsive embed-responsive-16by9">
         	<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'.$sonucum["link"].'" allowfullscreen></iframe>
         	</div>
            </div>';
			
		endwhile;

       echo '</div></div>';
	}
}

?>