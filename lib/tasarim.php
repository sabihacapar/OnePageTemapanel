<?php 
include_once("fonksiyon.php");


class tasarim extends kurumsal{

	public $hiztercih,$reftercih,$yorumtercih,$videotercih,$bultentercih;
		function __construct(){
			$baglanti=new PDO("mysql:host=localhost;dbname=kurumsal;charset=utf8","root","");//veritabanı bağlantısının yapıldığı kısımdır.sunucu veritabanı adı kullanıcı adı ve şifreyi içerir.

			//parent:: miras alınan sınıftaki her fonksiyona veya değişkene erişmek için kullanılır
			$introal=$baglanti->prepare("SELECT * FROM tasarim");
			$introal->execute();
			$gelen=$introal->fetch();
			//veritabanından gelen değerle eşletirme yapıldı
			$this->hiztercih=$gelen["hiztercih"];
			$this->reftercih=$gelen["reftercih"];
			$this->yorumtercih=$gelen["yorumtercih"];
			$this->videotercih=$gelen["videotercih"];
			$this->bultentercih=$gelen["bultentercih"];

			parent::__construct();//kurumsal classındaki constract methodunu çağırır.Bunu çağırmasının nedeni ise kurumsal sınıfının construct methodununu içindekileri kullanmak istemektir


			
			//ilk olarak hangi alanların yönetilebileceğini belirtmek lazım
}


function HizmetTasarimDuzen($baglanti){//sitenin ön yüzünde eğer hizmetler kısmının görünmesini istemezsek bu kısımdan ayarlarız
	if($this->hiztercih==0):
		//göster
		echo '
<section id="hizmetler">
	<div class="container">';
	parent::hizmetler($baglanti,$this->hizmetlerbaslik);//kurumsal sınıfından miras aldığı için parent ile çağırıldı
    echo'</div></section>
';
	endif;
	

}
function ReferansTasarimDuzen($baglanti){//sitenin ön yüzünde eğer referanslar kısmının görünmesini istemezsek bu kısımdan ayarlarız
	
	if($this->reftercih==0):
			//göster
		echo '
<section id="referanslar" class="wow fadeInUp">
	<div class="container">';    				 
    parent::referans($baglanti,$this->referansbaslik);
    echo'</div></section>';		
	endif;
	

}
function YorumTasarimDuzen($baglanti){//sitenin ön yüzünde eğer müşteri yorumları kısmının görünmesini istemezsek bu kısımdan ayarlarız
	
	if($this->yorumtercih==0):
			//göster
echo'<section id="yorumlar" class="wow fadeInUp">
<div class="container">';
    parent::yorumlar($baglanti,$this->yorumbaslik);
echo'</div></section>';
	
	endif;


}

function VideoTasarimDuzen($baglanti){//sitenin ön yüzünde eğer müşteri yorumları kısmının görünmesini istemezsek bu kısımdan ayarlarız
	
	if($this->videotercih==0):
  echo'<section id="videolar" class="wow fadeInUp">';
  parent::videolar($baglanti); 
  echo'
  </section>';
			//göster
echo'<section id="videolar" class="wow fadeInUp">
<div class="container">';
    parent::yorumlar($baglanti,$this->videobaslik);
echo'</div></section>';
	
	endif;


}
function BultenTasarimDuzen($baglanti){//sitenin ön yüzünde eğer müşteri yorumları kısmının görünmesini istemezsek bu kısımdan ayarlarız
	
	if($this->yorumtercih==0):
			//göster
echo'<section id="bulten" class="wow fadeInUp">
<div class="container">';
    parent::yorumlar($baglanti,$this->yorumbaslik);
echo'</div></section>';
	
	endif;


}

}


?>