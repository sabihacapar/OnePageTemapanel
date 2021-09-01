<?php
include_once("fonksiyon.php");
class yonetim2 extends yonetim{
  protected $tercihArray=array("Açık","Kapalı");
    //yonetim classından miras alınır
    //nesne tabanlı programlama
      /*---------------------REFERANSLAR---------------------------------*/


     function referanslarhepsi($vt){//mevcut referanslar
       echo '<div class="row text-center">
      <div class="col-lg-12"><h4 class="float-left mt-3 text-dark mb-2">
      <a href="control.php?sayfa=refekle" class="ti-plus bg-dark p-1 text-white mr-2 mt-3"></a>
      REFERANSLAR</h4></div>

      ';

    
      $introbilgiler=self::sorgum($vt,"SELECT * FROM referanslar",2);
      //veritabanı sorgu ve tercih yer alır
      while ($sonbilgi=$introbilgiler->fetch(PDO::FETCH_ASSOC)) ://gelen veri aktarılır
      echo '<div class="col-lg-2 p-1">
      <div class="row border border-light p-1 m-1">
      <div class="col-lg-12">
      <img src="../'.$sonbilgi["resimyol"].'">
      </div>
        <div class="col-lg-6 text-right">
      <a href="control.php?sayfa=refsil&id='.$sonbilgi["id"].'" class="ti-trash m-2 text-danger" style="font-size:25px;"></a>
      </div>
       
      </div>
      </div>';
      endwhile;
      echo '</div>';

     }
     
     function refekleme($vt){//referans ekleme
      echo '<div class="row text-center>
      <div class="col-lg-12">';
      if($_POST):
        //php işlemleri
        //ilk dosyanın boş olup olmaması
        //dosyanın boyutu
        //dosyanın uzantısı

        if($_FILES["dosya"]["name"]==""):
          echo '<div class="alert alert-danger mt-5">Dosya Yüklenmedi Boş Olamaz</div>';
          header("refresh:2,url=control.php?sayfa=referans");
        else:
          //eğer boş değil ise
           if($_FILES["dosya"]["size"]>1024*1024*5):
             echo '<div class="alert alert-danger mt-5">Dosya Boyutu Çok Fazla</div>';
             header("refresh:2,url=control.php?sayfa=referans");
           else:
            //boyutta bir problem yok ise
            $izinverilen =array("image/png","image/jpeg");//izin verilen dosyaların uzantıları
             if(!in_array($_FILES["dosya"]["type"],$izinverilen))://in arrayin yaptığı iş verilen dosya ile dosya tipinin uyup uymadığını karşılaştırmaktır

              echo '<div class="alert alert-danger mt-5">İzin Verilen Uzantı Değil</div>';
              header("refresh:2,url=control.php?sayfa=referans");
            else://artık her şey tamam
            $dosyaminyolu='../img/referans/'.$_FILES['dosya']['name'];

            move_uploaded_file($_FILES["dosya"]["tmp_name"],$dosyaminyolu);
            echo '<div class="alert alert-success mt-5">Dosya Başarıyla Yüklendi</div>';
            header("refresh:2,url=control.php?sayfa=referans");

            $dosyaminyolu2=str_replace('../','',$dosyaminyolu);//ne aranacak ne ile değişecek ve nereye gidecek
            //dosya yüklendikten sonra veritabanına kaydın eklenmesi lazım
            self::sorgum($vt,"INSERT into referanslar (resimyol) values ('$dosyaminyolu2')",0);

             endif;
           endif;
        endif;
       
      else:
        ?>

        <div class="col-lg-4 mx-auto mt-2">
          <div class="card card-bordered">
            <div class="card-body">
              <h5 class="title border-bottom">Referans Ekleme Formu Formu</h5>
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

     function refsil($vt){//referans silme
      $refid=$_GET['id'];
      $verial=self::sorgum($vt,"SELECT * FROM referanslar where id=$refid",1);//resmin yolunu almak için ilk olarak veritabanından çekilir

      echo '<div class="row text-center"><div class="col-lg-12">';


      //dosyayı silme işlemi
      unlink("../".$verial["resimyol"]);

      //veritabanı veri silme işlemi
      self::sorgum($vt,"DELETE FROM referanslar where id=$refid",0);

      
      echo '<div class="alert alert-success mt-5">SİLME BAŞARILI"</div>';

      echo '</div></div>';
      header("refresh:2,url=control.php?sayfa=referans");
   

     }

     /*--------------YORUMLAR------------------------*/

      function yorumlarhepsi($vt){//yorumları getirmek için

         echo '<div class="row text-center">
      <div class="col-lg-12 border-bottom"><h4 class="float-left mt-3 text-dark mb-1">
      <a href="control.php?sayfa=refekle" class="ti-plus bg-dark p-1 text-white mr-2 mt-3"></a>
      MÜSTERİ YORUMLARI</h4></div>

      ';
     
      $yorumbilgiler=self::sorgum($vt,"SELECT * FROM yorumlar",2);
      //veritabanı sorgu ve tercih yer alır
      while ($sonbilgi=$yorumbilgiler->fetch(PDO::FETCH_ASSOC)) ://gelen veri aktarılır
      echo '<div class="col-lg-3">
       <div class="row card-bordered p-1 m-1 bg-light" style="border-radius:10px;">
      <div class="col-lg-9 pt-1 text-left">
     <h5>İsim: '.$sonbilgi["isim"].'</h5>
      </div>
      <div class="col-lg-3 p-2 text-right">
      <a href="control.php?sayfa=yorumguncelle&id='.$sonbilgi["id"].'" class="ti-reload text-success " style="font-size:20px;"></a>
       <a href="control.php?sayfa=yorumsil&id='.$sonbilgi["id"].'" class="ti-trash text-danger" style="font-size:20px;"></a>
      
      </div>
      <div class="col-lg-12 border-top text-secondary text-left bg-white">
      '.$sonbilgi["icerik"].'
      </div>
      
      </div>
      </div>';
      endwhile;
      echo '</div>';

     }


     function yorumekle($vt){//hizmet ekleme işlemi için
      echo '<div class="row text-center">
      <div class="col-lg-12 border-bottom "><h3 class="mt-3 text-info">YORUM EKLE</h3></div> ';

      if(!$_POST):

     
     
      echo '<div class="col-lg-6 mx-auto">
      <div class="row card-bordered p-1 m-1 bg-light">
        <div class="col-lg-2 pt-3">
      <form action="" method="POST">
      İsim
      </div>

       <div class="col-lg-10 p-2">
      <input type="text" name="isim" class="form-control">
      </div>
     
   
     
      <div class="col-lg-12 border-top p-2">
      İçerik
      </div>
       <div class="col-lg-12 border-top p-2">
      <textarea name="icerik" rows="5" class="form-control"></textarea>
      </div>

      <div class="col-lg-12 border-top p-2">
      <input type="submit" name="buton" value="YORUM EKLE" class="btn btn-primary">
      </form>
      </div>
      
      </div>
      </div>';

    else:
      $isim=htmlspecialchars($_POST["isim"]);
      $icerik=htmlspecialchars($_POST["icerik"]);

      if($isim=="" && $icerik==""):
        echo '<div class="alert alert-danger mt-5">VERİLER BOŞ OLAMAZ</div>
         </div>';

     
      header("refresh:2,url=control.php?sayfa=yorumlar");
    else:
      self::sorgum($vt,"INSERT INTO yorumlar (icerik,isim) values ('$icerik','$isim')",0);
       echo '<div class="alert alert-success mt-5">EKLEME BAŞARILI</div>
         </div>';

     
      header("refresh:2,url=control.php?sayfa=yorumlar");
      endif;

       endif;
 
      echo '</div>';

     }
      function yorumguncelleme($vt){//hizmet ekleme işlemi için
      echo '<div class="row text-center">
      <div class="col-lg-12 border-bottom "><h3 class="mt-3 text-info">YORUM GÜNCELLE</h3></div> ';

      $kayitid=$_GET["id"];
      $kayitbilgial=self::sorgum($vt,"SELECT * FROM yorumlar where id=$kayitid",1);

      if(!$_POST):

     
     
      echo '<div class="col-lg-6 mx-auto">
      <div class="row card-bordered p-1 m-1 bg-light">
        <div class="col-lg-2 pt-3">
      
      İsim
      </div>

       <div class="col-lg-10 p-2">
       <form action="" method="POST">
      <input type="text" name="isim" class="form-control" value="'.$kayitbilgial["isim"].'">
      </div>
     
   
     
      <div class="col-lg-12 border-top p-2">
      İçerik
      </div>
       <div class="col-lg-12 border-top p-2">
      <textarea name="icerik" rows="5" class="form-control">'.$kayitbilgial["icerik"].'</textarea>
      </div>

      <div class="col-lg-12 border-top p-2">
      <input type="hidden" name="kayitidsi" value="'.$kayitbilgial["id"].'">
      <input type="submit" name="buton" value="YORUM GÜNCELLE" class="btn btn-primary">
      </form>
      </div>
      
      </div>
      </div>';

    else:
      $isim=htmlspecialchars($_POST["isim"]);
      $icerik=htmlspecialchars($_POST["icerik"]);
      $kayitidsi=htmlspecialchars($_POST["kayitidsi"]);

      if($isim=="" && $icerik==""):
        echo '<div class="alert alert-danger mt-5">VERİLER BOŞ OLAMAZ</div>
         </div>';

     
      header("refresh:2,url=control.php?sayfa=yorumlar");
    else:
      self::sorgum($vt,"UPDATE yorumlar SET icerik='$icerik',isim='$isim' where id='$kayitidsi'",0);
       echo '<div class="alert alert-success mt-5">GÜNCELLEME BAŞARILI</div>
         </div>';

     
      header("refresh:2,url=control.php?sayfa=yorumlar");
      endif;

       endif;
 
      echo '</div>';

     }
     function yorumsil($vt){

      $kayitid=$_GET['id'];
      

      echo '<div class="row text-center"><div class="col-lg-12">';

      //veritabanı veri silme işlemi
      self::sorgum($vt,"DELETE FROM yorumlar where id=$kayitid",0);

      
      echo '<div class="alert alert-success mt-5">SİLME BAŞARILI"</div>';

      echo '</div></div>';
      header("refresh:2,url=control.php?sayfa=yorumlar");
   


     }
         /*---------------------------------MAİL AYARLARI------------------------*/
     function mailayar($baglanti){//mail ayarları
    $sonuc=$this->sorgum($baglanti,"SELECT * FROM gelenmailayar",1);//veritabanına bağlandı sorguyu yaptı ve seçim yaptı.Seçim seçeneğini sorgum fonksiyonunda yaptı
    //her seferinde tekrar tekrar sorgu yapmak yerine srogu işlemini tek satırda yapmak için bu yöntem kullanılır

    //this in alternatifi olarak self::  de kullanılabilir
    //this class içindeki herhangi bir fonksiyona veya değişkene ulaşmak için kullanılır


    if ($_POST):

      //veritabanı işlemleri bu kısımda gerçekleşir
      //htmlspecialchars ile güvenlik önlemi alınmış oldu
      $host=htmlspecialchars($_POST["host"]);
      $mailadres=htmlspecialchars($_POST["mailadres"]);
      $sifre=htmlspecialchars($_POST["sifre"]); 
      $port=htmlspecialchars($_POST["port"]);
      $alicimail=htmlspecialchars($_POST["alicimail"]);

      
      //bunların boş vea doluluk kontrolü bu kısımda yapılabilir

      $guncelleme=$baglanti->prepare("UPDATE gelenmailayar SET host=?,mailadres=?,sifre=?,port=?,aliciadres=?");
      $guncelleme->bindParam(1,$host,PDO::PARAM_STR);
      $guncelleme->bindParam(2,$mailadres,PDO::PARAM_STR);
      $guncelleme->bindParam(3,$sifre,PDO::PARAM_STR);
      $guncelleme->bindParam(4,$port,PDO::PARAM_STR);
      $alicimail->bindParam(4,$alicimail,PDO::PARAM_STR);

    
      $guncelleme->execute();

      echo '<div class="alert alert-success mt-5"><strong>Mail Ayarları</strong> başarıyla güncellendi.</div>';
      header("refresh:2,url=control.php?sayfa=mailayar");//2 saniye sonra istenilen sayfaya yönlendirir



    else:
      ?>
       <form action="control.php?sayfa=mailayar" method="POST">
                        <div class="row">
                             <div class="col-lg-7 mx-auto mt-2">
                               <h3 class="text-info">MAİL AYARLARI </h3>
                                 

                             </div>
<!--******************** -->
                             <div class="col-lg-7 border mx-auto mt-2">
                                <div class="row">

                                    <div class="col-lg-3 border-right pt-3 text-left">
                                        <span id="siteayarfont">Host</span>
                                    </div>
                                     <div class="col-lg-9 p-1">
                                        <input type="text" name="host" class="form-control" value="<?php echo $sonuc["host"]; ?>" />
                                    </div>


                                </div>
                                <!--******************** -->
                             </div>
                               <div class="col-lg-7 border mx-auto">
                                <div class="row text-center">


                                     <div class="col-lg-3 border-right pt-3 text-left">
                                         <span id="siteayarfont"> Mail Adres</span>
                                    </div>
                                    <div class="col-lg-9 p-1">
                                       <input type="text" name="mailadres" class="form-control" value="<?php echo $sonuc["mailadres"]; ?>"/>
                                    </div>
                                    </div>
                                </div>
                                 <div class="col-lg-7 border mx-auto">
                                <div class="row">

                                     <div class="col-lg-3 border-right pt-3 text-left">
                                         <span id="siteayarfont"> Şifre</span>
                                    </div>
                                    <div class="col-lg-9 p-1">
                                       <input type="text" name="sifre" class="form-control" value="<?php echo $sonuc["sifre"]; ?>"/>
                                    </div>
                                    </div>
                                </div>
                                 <div class="col-lg-7 border mx-auto">
                                <div class="row">

                                    <div class="col-lg-3 border-right pt-3 text-left">
                                         <span id="siteayarfont">Port</span>
                                    </div>
                                    <div class="col-lg-9 p-1">
                                       <input type="text" name="port" class="form-control" value="<?php echo $sonuc["port"]; ?>"/>
                                    </div>
                                    </div>
                                </div>
                                  <div class="col-lg-7 border mx-auto">
                                <div class="row">

                                    <div class="col-lg-3 border-right pt-3 text-left">
                                         <span id="siteayarfont">Alıcı Mail</span>
                                    </div>
                                    <div class="col-lg-9 p-1">
                                       <input type="text" name="alicimail" class="form-control" value="<?php echo $sonuc["aliciadres"]; ?>"/>
                                    </div>
                                    </div>
                                </div>
                                
                                
                              <div class="col-lg-7 mx-auto mt-2">
                               <input type="submit" name="button" class="btn btn-rounded btn-info m-1" value="GÜNCELLE">
                                 

                             </div>

<!--******************** -->
                             


                        </div>


                        

                        </form>
      <?php
      //form ise burada

    endif;
  }
   /*---------------------------------KULLANICI AYARLARI------------------------*/
     function ayarlar($baglanti){//mail ayarları

      $id=self::coz($_COOKIE['kulbilgi']);//şifreli halini çözüp id ye akatardık.
       $sonuc=$this->sorgum($baglanti,"SELECT * FROM yonetim WHERE id=$id",1);//veritabanına bağlandı sorguyu yaptı ve seçim yaptı.Seçim seçeneğini sorgum fonksiyonunda yaptı
    //her seferinde tekrar tekrar sorgu yapmak yerine srogu işlemini tek satırda yapmak için bu yöntem kullanılır
   
    //this in alternatifi olarak self::  de kullanılabilir
    //this class içindeki herhangi bir fonksiyona veya değişkene ulaşmak için kullanılır


    if ($_POST):

      //veritabanı işlemleri bu kısımda gerçekleşir
      //htmlspecialchars ile güvenlik önlemi alınmış oldu
      @$kulad=htmlspecialchars($_POST["kulad"]);
      @$eskisif=htmlspecialchars($_POST["sifre"]);
      @$yenisif=htmlspecialchars($_POST["yenisifre"]); 
      @$yenisif2=htmlspecialchars($_POST["yenisifre2"]);

      if($kulad=="" || $eskisif=="" || $yenisif=="" || $yenisif2=="" ):
        echo '<div class="alert alert-danger">ALANLAR BOŞ OLAMAZ</div>';
      header("refresh:2,url=control.php?sayfa=ayarlar");
      else:

      //ilk yazılan eski şifre şifreleme algoritmamıza göre şifrelenecek db ile karşılaştırılacak
      $sifrelihal=md5(sha1(md5($eskisif)));

      if($sonuc["sifre"]!=$sifrelihal)://şifreler birbirine eşit değilse
      echo '<div class="alert alert-danger">ESKİ ŞİFRE HATALI GİRİLDİ</div>';
      header("refresh:2,url=control.php?sayfa=ayarlar");
    else:
      if($yenisif!=$yenisif2):
        echo '<div class="alert alert-danger">YENİ ŞİFRELER UYUŞMUYOR</div>';
      header("refresh:2,url=control.php?sayfa=ayarlar");
       
    else:
      $yenisifson=md5(sha1(md5($yenisif)));
         $guncelleme=$baglanti->prepare("UPDATE yonetim SET kulad=?,sifre=? where id=$id");
      $guncelleme->bindParam(1,$kulad,PDO::PARAM_STR);
      $guncelleme->bindParam(2,$yenisifson,PDO::PARAM_STR);
      echo '<div class="alert alert-success mt-5>BİLGİLER BAŞARIYLA GÜNCELLENDİ</div>';
      header("refresh:2,url=control.php?sayfa=ayarlar");
     
    
      $guncelleme->execute();





      endif;

      endif;
endif;

      //girilen yeni şifreler birbirleri ile aynı mı bunun kontrolü yapılır
      
      //bunların boş vea doluluk kontrolü bu kısımda yapılabilir

   

     



    else:
      ?>
       <form action="control.php?sayfa=ayarlar" method="POST">
                        <div class="row">
                             <div class="col-lg-7 mx-auto mt-2">
                               <h3 class="text-info">KULLANICI AYARLARI </h3>
                                 

                             </div>
<!--******************** -->
                             <div class="col-lg-7 border mx-auto mt-2">
                                <div class="row">

                                    <div class="col-lg-3 border-right pt-3 text-left">
                                        <span id="siteayarfont">Kullanıcı Adı</span>
                                    </div>
                                     <div class="col-lg-9 p-1">
                                        <input type="text" name="kulad" class="form-control" value="<?php echo $sonuc["kulad"]; ?>" />
                                    </div>


                                </div>
                                <!--******************** -->
                             </div>
                               <div class="col-lg-7 border mx-auto">
                                <div class="row text-center">
                                  

                                     <div class="col-lg-3 border-right pt-3 text-left">
                                         <span id="siteayarfont"> Güncel Şifre</span>
                                    </div>
                                    <div class="col-lg-9 p-1">
                                       <input type="password" name="sifre" class="form-control" />
                                    </div>
                                    </div>
                                </div>
                                 <div class="col-lg-7 border mx-auto">
                                <div class="row">

                                     <div class="col-lg-3 border-right pt-3 text-left">
                                         <span id="siteayarfont">Yeni Şifre</span>
                                    </div>
                                    <div class="col-lg-9 p-1">
                                       <input type="password" name="yenisifre" class="form-control"/>
                                    </div>
                                    </div>
                                </div>
                                 <div class="col-lg-7 border mx-auto">
                                <div class="row">

                                    <div class="col-lg-3 border-right pt-3 text-left">
                                         <span id="siteayarfont">Yeni Şifre 2</span>
                                    </div>
                                    <div class="col-lg-9 p-1">
                                       <input type="password" name="yenisifre2" class="form-control"/>
                                    </div>
                                    </div>
                                </div>
                                
                              <div class="col-lg-7 mx-auto mt-2">
                               <input type="submit" name="button" class="btn btn-info m-1" value="DEĞİŞTİR">
                                 

                             </div>

<!--******************** -->
                             


                        </div>


                        

                        </form>
      <?php
      //form ise burada

    endif;
  }
  /*-----------------------KULLANICI EKLEME VE SİLME--------------------*/

  function kullistele($vt){

    $al=self::sorgum($vt,"SELECT * FROM yonetim",2);


    echo '<div class="row text-center">
    <div class="col-lg-6 mt-5 mx-auto">
    <div class="card">
    <div class="card-body">
    <h4 class="header-title">
    <a href="control.php?sayfa=yonekle" class="ti-plus bg-dark p-1 text-white mr-2 mt-3"></a>
 
    KULLANICILAR</h4>
    <div class="single-table"></div>
    <div class="table-responsive">
    <table class="table text-center border">
    <thead class="text-uppercase">
    <tr>
    <th scope="col" class="border-right">Ad</th>
    <th scope="col">İşlem</th>
    </tr>
    </thead>
    <tbody >';

    while($yonson=$al->fetch(PDO::FETCH_ASSOC)):


   echo' <tr>
    <th scope="row" class="border-right">'.$yonson["kulad"].'</th>
    <th scope="row"><a href="control.php?sayfa=yonsil&id='.$yonson["id"].'"><i class="ti-trash text-danger" style="font-size:20px;"></i></a></th>
    </tr>';
  endwhile;
    echo'</tbody>
    </table>

    </div>
    
    </div>
    </div>

    </div>
    </div>






    ';

  }
   function yonsil($vt,$id){//yöneticileri silmek için
    
       echo '<div class="row m-2">
        <div class="col-lg-12  mt-2 font-weight-bold" style="border-radius:5px; border:1px; solid #eeeeee;">
        <div class="alert alert-info mt-5">YÖNETİCİ SİLİNDİ</div>
        </div></div>

        ';
header("refresh:2,url=control.php?sayfa=kulayar");

    //mesajın durumu güncelleniyor
 self::sorgum($vt,"DELETE FROM yonetim WHERE id=$id",0);


      
     }
      /*---------------------------------YÖNETİCİ EKLE------------------------*/
    
  function yonekle($baglanti){//yönetici ekleme ayarları

    if ($_POST):

      //veritabanı işlemleri bu kısımda gerçekleşir
      //htmlspecialchars ile güvenlik önlemi alınmış oldu
      @$kulad=htmlspecialchars($_POST["kulad"]);
      @$yenisif=htmlspecialchars($_POST["yenisifre"]); 
      @$yenisif2=htmlspecialchars($_POST["yenisifre2"]);

      if($kulad=="" ||  $yenisif=="" || $yenisif2=="" ):
        echo '<div class="alert alert-danger">ALANLAR BOŞ OLAMAZ</div>';
      header("refresh:2,url=control.php?sayfa=yonekle");
      else:

      if($yenisif!=$yenisif2):
        echo '<div class="alert alert-danger">YENİ ŞİFRELER UYUŞMUYOR</div>';
      header("refresh:2,url=control.php?sayfa=yonekle");
       
    else:
      $yenisifson=md5(sha1(md5($yenisif)));
         $ekle=$baglanti->prepare("INSERT INTO yonetim (kulad,sifre) values (?,?)");
      $ekle->bindParam(1,$kulad,PDO::PARAM_STR);
      $ekle->bindParam(2,$yenisifson,PDO::PARAM_STR);
      echo '<div class="alert alert-success mt-5">YÖNETİCİ EKLENDİ</div>';
      header("refresh:2,url=control.php?sayfa=kulayar");
     
    
      $ekle->execute();





      endif;


endif;

      //girilen yeni şifreler birbirleri ile aynı mı bunun kontrolü yapılır
      
      //bunların boş vea doluluk kontrolü bu kısımda yapılabilir

   

     



    else:
      ?>
       <form action="control.php?sayfa=yonekle" method="POST">
                        <div class="row">
                             <div class="col-lg-7 mx-auto mt-2">
                               <h3 class="text-info">YÖNETİCİ EKLE </h3>
                                 

                             </div>
<!--******************** -->
                           
                                <!--******************** -->
                             </div>
                               <div class="col-lg-7 border mx-auto">
                                <div class="row text-center">
                                  

                                     <div class="col-lg-3 border-right pt-3 text-left">
                                         <span id="siteayarfont"> Kullanıcı Adı</span>
                                    </div>
                                    <div class="col-lg-9 p-1">
                                       <input type="text" name="kulad" class="form-control" />
                                    </div>
                                    </div>
                                </div>
                                 <div class="col-lg-7 border mx-auto">
                                <div class="row">

                                     <div class="col-lg-3 border-right pt-3 text-left">
                                         <span id="siteayarfont">Yeni Şifre</span>
                                    </div>
                                    <div class="col-lg-9 p-1">
                                       <input type="password" name="yenisifre" class="form-control"/>
                                    </div>
                                    </div>
                                </div>
                                 <div class="col-lg-7 border mx-auto">
                                <div class="row">

                                    <div class="col-lg-3 border-right pt-3 text-left">
                                         <span id="siteayarfont">Yeni Şifre (Tekrar)</span>
                                    </div>
                                    <div class="col-lg-9 p-1">
                                       <input type="password" name="yenisifre2" class="form-control"/>
                                    </div>
                                    </div>
                                </div>
                                
                              <div class="col-lg-7 mx-auto mt-2">
                               <input type="submit" name="button" class="btn btn-info m-1" value="YÖNETİCİ EKLE">
                                 

                             </div>

<!--******************** -->
                             


                        </div>


                        

                        </form>
      <?php
      //form ise burada

    endif;
  }
     /*---------------------HAAKIMIZDA-------------------*/

     function hakkimizda($vt){//hakkımızda ayar bölümü
      echo '<div class="row text-center">
      <div class="col-lg-12 border-bottom "><h4 class="mt-3 text-dark float-left">HAKKIMIZDA AYARLARI</h4></div>';
     
      if(!$_POST)://eğer forma basılmadıysa
       $sonbilgi=self::sorgum($vt,"SELECT * FROM hakkimizda",1);
  

      echo '<div class="col-lg-6 mx-auto">

      <div class="row card-bordered p-1 m-1">



      <div class="col-lg-3 border-bottom bg-light pt-5" id="hakkimizdayazilar">
      Resim
      </div>
       <div class="col-lg-9 border-bottom">
       <img src="../'.$sonbilgi["resim"].'"><br/>
       <form action="" method="POST" enctype="multipart/form-data">
       <input type="file" name="dosya">
      </div>

      <div class="col-lg-3 border-bottom bg-light pt-3" id="hakkimizdayazilarn">
      Başlık<span class="text-success"> TR</span>
      </div>
       <div class="col-lg-9  border-bottom">
       <input type="text" name="baslik_tr" class="form-control m-2" value="'.$sonbilgi["baslik_tr"].'">
       
      </div>
       <div class="col-lg-3 border-bottom bg-light pt-3" id="hakkimizdayazilarn">
      Başlık<span class="text-danger"> EN</span>
      </div>
       <div class="col-lg-9  border-bottom">
       <input type="text" name="baslik_en" class="form-control m-2" value="'.$sonbilgi["baslik_en"].'">
       
      </div>




      <div class="col-lg-3 border-bottom bg-light pt-3" id="hakkimizdayazilarn">
       İçerik<span class="text-success"> TR</span>
      </div>
       <div class="col-lg-9">
       <textarea name="icerik_tr" class="form-control" rows="8"> '.$sonbilgi["icerik_tr"].'</textarea>   
      </div>



       <div class="col-lg-3 border-bottom bg-light pt-3" id="hakkimizdayazilarn">
     İçerik<span class="text-danger"> EN</span>
      </div>
       <div class="col-lg-9">
       <textarea name="icerik_en" class="form-control" rows="8"> '.$sonbilgi["icerik_en"].'</textarea>   
      </div> 

       <div class="col-lg-12  border-top">
       <input type="submit" name="guncel" class="btn btn-primary m-2" value="GÜNCELLE">
       </form>
      </div>
      </div>
      </div>';
      else://eğer forma basıldıysa işlemler burada yapılır
      
      $baslik_tr=$_POST["baslik_tr"];
      $baslik_en=$_POST["baslik_en"];
      $icerik_tr=$_POST["icerik_tr"];
      $icerik_en=$_POST["icerik_en"];
       if(@$_FILES["dosya"]["name"]!=""):

      //form basıldıysa
        if($_FILES["dosya"]["size"]<1024*1024*5):
            
            //boyutta bir problem yok ise
            $izinverilen =array("image/png","image/jpeg");//izin verilen dosyaların uzantıları
             if(in_array($_FILES["dosya"]["type"],$izinverilen))://in arrayin yaptığı iş verilen dosya ile dosya tipinin uyup uymadığını karşılaştırmaktır
//artık her şey tamam
            $dosyaminyolu='../img/'.$_FILES['dosya']['name'];

            move_uploaded_file($_FILES["dosya"]["tmp_name"],$dosyaminyolu);
            

            $veritabaniicin=str_replace('../','',$dosyaminyolu);//ne aranacak ne ile değişecek ve nereye gidecek
            //dosya yüklendikten sonra veritabanına kaydın eklenmesi lazım
          endif;
        endif;
      endif;
      if(@$_FILES["dosya"]["name"]!=""):
        self::sorgum($vt,"UPDATE hakkimizda SET baslik_tr='$baslik_tr',baslik_en='$baslik_en',icerik_tr='$icerik_tr',icerik_en='$icerik_en',resim='$veritabaniicin '",0);
        echo '<div class="col-lg-6 mx-auto">
         <div class="alert alert-success mt-5">GÜNCELLEME BAŞARILI</div>
         </div>';

     
      header("refresh:2,url=control.php?sayfa=hakkimiz");


      else:
        self::sorgum($vt,"UPDATE hakkimizda SET baslik_tr='$baslik_tr',baslik_en='$baslik_en',icerik_tr='$icerik_tr',icerik_en='$icerik_en' ",0);
         echo '
         <div class="col-lg-6 mx-auto">
         <div class="alert alert-success mt-5">GÜNCELLEME BAŞARILI</div>
         </div>';

     
      header("refresh:2,url=control.php?sayfa=hakkimiz");

      endif;

      echo '</div>';


    endif;

     }

      /*---------------------HİZMETLER-------------------*/

      function hizmetlerhepsi($vt){//hizmetleri getirmek için

         echo '<div class="row text-center">
      <div class="col-lg-12"><h4 class="float-left mt-3 text-dark mb-2">
      <a href="control.php?sayfa=hizmetekle" class="ti-plus bg-dark p-1 text-white mr-2 mt-3"></a>
      HİZMETLERİMİZ</h4></div>

      ';
      $introbilgiler=self::sorgum($vt,"SELECT * FROM hizmetler",2);
      //veritabanı sorgu ve tercih yer alır
      while ($sonbilgi=$introbilgiler->fetch(PDO::FETCH_ASSOC)) ://gelen veri aktarılır
      echo '<div class="col-lg-6">
      <div class="row card-bordered p-1 m-1 bg-light">
      <div class="col-lg-10 pt-1 pb-1">
     <h5>'.$sonbilgi["baslik_tr"].' - '.$sonbilgi["baslik_en"].'</h5>

      </div>
      <div class="col-lg-2 text-right">
      <a href="control.php?sayfa=hizmetguncelle&id='.$sonbilgi["id"].'" class="ti-reload text-success" style="font-size:20px;"></a>
       <a href="control.php?sayfa=hizmetsil&id='.$sonbilgi["id"].'" class="ti-trash text-danger pl-2" style="font-size:20px;"></a>
      
      </div>
      <div class="col-lg-12 border-top text-secondary text-left bg-white">
      <span class="text-success"> TR</span> - '.$sonbilgi["icerik_tr"].'
      </div>
       <div class="col-lg-12 border-top text-secondary text-left bg-white">
      <span class="text-danger"> EN</span> - '.$sonbilgi["icerik_en"].'
      </div>
      </div>
      </div>';
      endwhile;
      echo '</div>';

     }


     function hizmetekle($vt){//hizmet ekleme işlemi için
      echo '<div class="row text-center">
      <div class="col-lg-12 border-bottom "><h3 class="mt-3 text-info">HİZMET EKLE</h3></div> ';
      if(!$_POST):
      echo '<div class="col-lg-6 mx-auto">
      <div class="row card-bordered p-1 m-1 bg-light">
        <div class="col-lg-2 pt-3">
      <form action="" method="POST">
      Başlık <span class="text-success"> TR</span>
      </div>
       <div class="col-lg-10 p-2">
      <input type="text" name="baslik_tr" class="form-control">
      </div> 
       <div class="col-lg-2 pt-3">
      Başlık <span class="text-danger"> EN</span>
      </div>
       <div class="col-lg-10 p-2">
      <input type="text" name="baslik_en" class="form-control">
      </div>   
      <div class="col-lg-12 border-top p-2">
      İçerik <span class="text-success"> TR</span>
      </div>
       <div class="col-lg-12 border-top p-2">
      <textarea name="icerik_tr" rows="5" class="form-control"></textarea>
      </div>
      <div class="col-lg-12 border-top p-2">
      İçerik <span class="text-success">EN</span>
      </div>
       <div class="col-lg-12 border-top p-2">
      <textarea name="icerik_en" rows="5" class="form-control"></textarea>
      </div>
      <div class="col-lg-12 border-top p-2">
      <input type="submit" name="buton" value="HİZMET EKLE" class="btn btn-primary">
      </form>
      </div>    
      </div>
      </div>';

    else:
      $baslik_tr=htmlspecialchars($_POST["baslik_tr"]);
      $icerik_tr=htmlspecialchars($_POST["icerik_tr"]);
      $baslik_en=htmlspecialchars($_POST["baslik_en"]);
      $icerik_en=htmlspecialchars($_POST["icerik_en"]);

      if($baslik_tr=="" && $baslik_en=="" && $icerik_tr=="" && $icerik_en==""):
        echo '<div class="alert alert-danger mt-5">VERİLER BOŞ OLAMAZ</div>
         </div>';

     
      header("refresh:2,url=control.php?sayfa=hizmetler");
    else:
      self::sorgum($vt,"INSERT INTO hizmetler (baslik_tr,baslik_en,icerik_tr,icerik_en) values ('$baslik_tr','$baslik_en','$icerik_tr','$icerik_en')",0);
       echo '<div class="alert alert-success mt-5 mx-auto">EKLEME BAŞARILI</div>
         </div>';

     
      header("refresh:2,url=control.php?sayfa=hizmetler");
      endif;

       endif;
 
      echo '</div>';

     }
      function hizmetguncelleme($vt){//hizmet ekleme işlemi için
      echo '<div class="row text-center">
      <div class="col-lg-12 border-bottom "><h3 class="mt-3 text-info">HİZMET GÜNCELLE</h3></div> ';

      $kayitid=$_GET["id"];
      $kayitbilgial=self::sorgum($vt,"SELECT * FROM hizmetler where id=$kayitid",1);

      if(!$_POST):

     
     
      echo '<div class="col-lg-6 mx-auto">
      <div class="row card-bordered p-1 m-1 bg-light">
      <div class="col-lg-2 pt-3">
      
      Başlık <span class="text-success"> TR</span>
      </div>

       <div class="col-lg-10 p-2">
       <form action="" method="POST">
      <input type="text" name="baslik_tr" class="form-control" value="'.$kayitbilgial["baslik_tr"].'">
      </div>

      <div class="col-lg-2 pt-3">
      
      Başlık <span class="text-danger"> EN</span>
      </div>

       <div class="col-lg-10 p-2">
       
      <input type="text" name="baslik_en" class="form-control" value="'.$kayitbilgial["baslik_en"].'">
      </div>
     
   
     
      <div class="col-lg-2 pt-3">
      İçerik <span class="text-success"> TR</span>
      </div>
      <div class="col-lg-10 p-2">
      <textarea name="icerik_tr" rows="5" class="form-control">'.$kayitbilgial["icerik_tr"].'</textarea>
      </div>


      <div class="col-lg-2 pt-3">
      İçerik <span class="text-danger"> EN</span>
      </div>
      <div class="col-lg-10 p-2">
      <textarea name="icerik_en" rows="5" class="form-control">'.$kayitbilgial["icerik_en"].'</textarea>
      </div>

      <div class="col-lg-12 border-top p-2">
      <input type="hidden" name="kayitidsi" value="'.$kayitbilgial["id"].'">
      <input type="submit" name="buton" value="HİZMET GÜNCELLE" class="btn btn-primary">
      </form>
      </div>
      
      </div>
      </div>';

    else:
      $baslik_tr=htmlspecialchars($_POST["baslik_tr"]);
      $baslik_en=htmlspecialchars($_POST["baslik_en"]);
      $icerik_tr=htmlspecialchars($_POST["icerik_tr"]);
      $icerik_en=htmlspecialchars($_POST["icerik_en"]);
      $kayitidsi=htmlspecialchars($_POST["kayitidsi"]);

      if($baslik_tr=="" && $baslik_en=="" && $icerik_tr=="" && $icerik_en==""):
        echo '<div class="alert alert-danger mt-5">VERİLER BOŞ OLAMAZ</div>
         </div>';

     
      header("refresh:2,url=control.php?sayfa=hizmetler");
    else:
      self::sorgum($vt,"UPDATE hizmetler SET baslik_tr='$baslik_tr',baslik_en='$baslik_en',icerik_tr='$icerik_tr',icerik_en='$icerik_en' where id='$kayitidsi'",0);
       echo '<div class="alert alert-success mt-5 mx-auto">GÜNCELLEME BAŞARILI</div>
         </div>';

     
      header("refresh:2,url=control.php?sayfa=hizmetler");
      endif;

       endif;
 
      echo '</div>';

     }
     function hizmetsil($vt){

      $kayitid=$_GET['id'];
      

      echo '<div class="row text-center"><div class="col-lg-12">';

      //veritabanı veri silme işlemi
      self::sorgum($vt,"DELETE FROM hizmetler where id=$kayitid",0);

      
      echo '<div class="alert alert-success mt-5 mx-auto">SİLME BAŞARILI"</div>';

      echo '</div></div>';
      header("refresh:2,url=control.php?sayfa=hizmetler");
   


     }
     function tasarimGetir($gelenTercih,$radioName){
      foreach($this->tercihArray as $key => $value):

      if($gelenTercih==$key):
      echo'<label class="m-2 mr-3">'.$value.':<input type="radio" name="'.$radioName.'" value="'.$key.'" checked="checked"></label>';
       else:
        echo'<label class="m-2 mr-3">'.$value.':<input type="radio" name="'.$radioName.'" value="'.$key.'" ></label>';

      endif;
      endforeach;
    }

       function tasarimYonetim($vt){//Tasarım Yönetim
      echo '<div class="row text-center">
      <div class="col-lg-12 border-bottom "><h3 class="mt-3 text-info">TASARIM YÖNETİM</h3></div> '; 
      $kayitbilgial=self::sorgum($vt,"SELECT * FROM tasarim",1);
      if(!$_POST):
      echo '<div class="col-lg-6 mx-auto">
      <div class="row card-bordered p-1 m-1 bg-light">
        <div class="col-lg-6 pt-3 border-right text-danger">      
      Hizmet Tercih
      </div>
       <div class="col-lg-6 p-2">
       <form action="" method="POST">';
       self::tasarimGetir($kayitbilgial["hiztercih"],"hiztercih");
      echo'</div></div>
       <div class="row card-bordered p-1 m-1 bg-light">
        <div class="col-lg-6 pt-3 border-right text-danger ">   
      Refrans Tercih
      </div>
       <div class="col-lg-6 p-2">';
        self::tasarimGetir($kayitbilgial["reftercih"],"reftercih");
      echo'</div></div>


      <div class="row card-bordered p-1 m-1 bg-light">
        <div class="col-lg-6 pt-3 border-right text-danger ">   
      Video Tercih
      </div>
       <div class="col-lg-6 p-2">';
       self::tasarimGetir($kayitbilgial["videotercih"],"videotercih");
      echo'</div></div>



      <div class="row card-bordered p-1 m-1 bg-light">
        <div class="col-lg-6 pt-3 border-right text-danger ">   
      Bulten Tercih
      </div>
       <div class="col-lg-6 p-2">';
       self::tasarimGetir($kayitbilgial["bultentercih"],"bultentercih");
      echo'</div></div>





       <div class="row card-bordered p-1 m-1 bg-light">
        <div class="col-lg-6 pt-3 border-right text-danger ">  
      Yorum Tercih
      </div>
       <div class="col-lg-6 p-2">';
       self::tasarimGetir($kayitbilgial["yorumtercih"],"yorumtercih");
      echo'</div></div>


      <div class="col-lg-12 border-top p-2 border-right text-danger border-bottom">
      <input type="hidden" name="id" value="'.$kayitbilgial["id"].'">
      <input type="submit" name="buton" value="TASARIM GÜNCELLE" class="btn btn-primary">
      </form>
      </div>  
      </div>
      </div>';
    else:
      $hiztercih=$_POST["hiztercih"];
      $reftercih=$_POST["reftercih"];
      $yorumtercih=$_POST["yorumtercih"];
      $videotercih=$_POST["videotercih"];
      $bultentercih=$_POST["bultentercih"];
      @$id=$_POST["id"];      
      self::sorgum($vt,"UPDATE tasarim SET hiztercih='$hiztercih',reftercih='$reftercih',yorumtercih='$yorumtercih',videotercih=$videotercih,bultentercih=$bultentercih where id=$id",0);
       echo '<div class="alert alert-success mt-5 mx-auto">TASARIM GÜNCELLEME BAŞARILI</div>
         </div>';
      header("refresh:2,url=control.php?sayfa=tasarim");
      endif;
      echo '</div>';
     }

     function bakim($db){

      echo '<div class="row text-center">
      <div class="col-lg-12 text-center">';
      if($_POST):
        //varolan tablolar yazılırsa eğer tablo ekleme ve silmede hata çıkar
       $tablolar=self::sorgum($db,"SHOW TABLES",2);
      while($tabloson=$tablolar->fetch(PDO::FETCH_ASSOC)):
        $db->query("REPAIR TABLE ".$tabloson["Tables_in_kurumsal"]);
        $db->query("OPTIMIZE TABLE ".$tabloson["Tables_in_kurumsal"]);
        echo '<div class="alert alert-success mt-1 col-lg-3 mx-auto">'.$tabloson["Tables_in_kurumsal"]." Toblosuna İşlem Yapıldı.</div>";


      
      endwhile;
echo '</div>';
$zaman=date('d/m/Y - H:i');
       $tablolar=self::sorgum($db,"UPDATE ayarlar SET bakimzaman='$zaman'",0);

      else:
        ?>

        <div class="col-lg-4 mx-auto mt-2">
          <div class="card card-bordered">
            <div class="card-body">
              <h5 class="title border-bottom">VERİTABANI BAKIM</h5>
              <form action="" method="POST">
                <input type="submit" name="buton" value="BAKIMI BAŞLAT" class="btn btn-primary mb-1"/>
              </form>
              <?php
              $zamanbak=self::sorgum($db,"SELECT bakimzaman FROM ayarlar",1);
            
               echo '<div class="alert alert-warning mt-1  mx-auto">En son bakım:'.$zamanbak["bakimzaman"]." </div>";


               ?>


            </div>
          </div>
        </div>
        <?php 
endif;
echo '</div></div>';

      

     }

     //----------------LİNK AYAR------------------------

      function linkayar($vt){//linkleri getirmek için
         echo '<div class="row text-center">
      <div class="col-lg-12"><h4 class="float-left mt-3 text-dark mb-2">
      <a href="control.php?sayfa=linkekle" class="ti-plus bg-dark p-1 text-white mr-2 mt-3"></a>
      LİNKLERİMİZ</h4></div>';
      $introbilgiler=self::sorgum($vt,"SELECT * FROM linkler",2);
      //veritabanı sorgu ve tercih yer alır
      while ($sonbilgi=$introbilgiler->fetch(PDO::FETCH_ASSOC)) ://gelen veri aktarılır
      echo '<div class="col-lg-6">
      <div class="row card-bordered p-1 m-1 bg-light">
      <div class="col-lg-10 pt-1 pb-1">
     <h5><kbd class="float-left">Sira:'.$sonbilgi["siralama"].'</kbd>'.$sonbilgi["ad_tr"].' - '.$sonbilgi["ad_en"].'</h5>
      </div>
      <div class="col-lg-2 text-right">
      <a href="control.php?sayfa=linkguncelle&id='.$sonbilgi["id"].'" class="ti-reload text-success" style="font-size:20px;"></a>
       <a href="control.php?sayfa=linksil&id='.$sonbilgi["id"].'" class="ti-trash text-danger pl-2" style="font-size:20px;"></a>
      </div>
      <div class="col-lg-12 border-top text-secondary text-left bg-white">'.$sonbilgi["etiket"].'
      </div> 
      </div>
      </div>';
      endwhile;
      
     }


     function linkekle($vt){//hizmet ekleme işlemi için

       $introbilgiler=self::sorgum($vt,"SELECT * FROM linkler ORDER BY siralama desc LIMIT 1",2);
      //veritabanı sorgu ve tercih yer alır
   $sonbilgi=$introbilgiler->fetch(PDO::FETCH_ASSOC);//gelen veri aktarılır

   $sayi=$sonbilgi["siralama"]+1;

      echo '<div class="row text-center">
      <div class="col-lg-12 border-bottom "><h3 class="mt-3 text-info">LİNK EKLE</h3></div> ';
      if(!$_POST):
      echo '<div class="col-lg-6 mx-auto">
      <div class="row card-bordered p-1 m-1 bg-light">
        <div class="col-lg-2 pt-3">
      <form action="" method="POST">
      Link Ad <span class="text-success"> - TR</span>
      </div>
       <div class="col-lg-10 p-2">
      <input type="text" name="ad_tr" class="form-control">
      </div> 
       <div class="col-lg-2 pt-3">
     Link Ad <span class="text-danger"> - EN</span>
      </div>
       <div class="col-lg-10 p-2">
      <input type="text" name="ad_en" class="form-control">
      </div>   
      <div class="col-lg-12 border-top p-2">
      Etiket 
      </div>
       <div class="col-lg-12 border-top p-2">
      <textarea name="etiket" rows="5" class="form-control"></textarea>
      </div>
       <div class="col-lg-12 border-top p-2">
      Link Sırası 
      </div>

       <select name="sira" class="form-control">
       <option value="'.$sayi.'">'.$sayi.'</option>
       </select>
     
      <div class="col-lg-12 border-top p-2">
      <input type="submit" name="buton" value="LİNK EKLE" class="btn btn-primary">
      </form>
      </div>    
      </div>
      </div>';

    else:
      $ad_tr=htmlspecialchars($_POST["ad_tr"]);
      $ad_en=htmlspecialchars($_POST["ad_en"]);
      $etiket=htmlspecialchars($_POST["etiket"]);
      $sira=htmlspecialchars($_POST["sira"]);


      if($ad_tr=="" && $ad_en=="" && $etiket==""):
        echo '<div class="alert alert-danger mt-5">VERİLER BOŞ OLAMAZ</div>
         </div>';

     
      header("refresh:2,url=control.php?sayfa=linkayar");
    else:
      self::sorgum($vt,"INSERT INTO linkler (ad_tr,ad_en,etiket,siralama) values ('$ad_tr','$ad_en','$etiket',$sira)",0);
       echo '<div class="alert alert-success mt-5 mx-auto">EKLEME BAŞARILI</div>
         </div>';

     
      header("refresh:2,url=control.php?sayfa=linkayar");
      endif;

       endif;
 
      echo '</div>';

     }
      function linkguncelleme($vt){//hizmet ekleme işlemi için
         $linklerebak=self::sorgum($vt,"SELECT * FROM linkler",2);
      //veritabanı sorgu ve tercih yer alır

      echo '<div class="row text-center">
      <div class="col-lg-12 border-bottom "><h3 class="mt-3 text-info">LİNK GÜNCELLE</h3></div> ';
      $kayitid=$_GET["id"];
      $kayitbilgial=self::sorgum($vt,"SELECT * FROM linkler where id=$kayitid",1);
      if(!$_POST):
      echo '<div class="col-lg-7 mx-auto">
      <div class="row card-bordered p-1 m-1 bg-light">
      <div class="col-lg-2 pt-3">    
      Link Ad <span class="text-success"> TR</span>
      </div>
       <div class="col-lg-10 p-2">
       <form action="" method="POST">
      <input type="text" name="ad_tr" class="form-control" value="'.$kayitbilgial["ad_tr"].'">
      </div>
      <div class="col-lg-2 pt-3">      
      Link Ad <span class="text-danger"> EN</span>
      </div>
       <div class="col-lg-10 p-2">  
      <input type="text" name="ad_en" class="form-control" value="'.$kayitbilgial["ad_en"].'">
      </div>    
      <div class="col-lg-2 pt-3">
      Etiket
      </div>
      <div class="col-lg-10 p-2">
      <textarea name="etiket" rows="2" class="form-control">'.$kayitbilgial["etiket"].'</textarea>
      </div>

       <div class="col-lg-2 pt-3">
      Link Sırası:<b>'.$kayitbilgial["siralama"].'</b>
      </div>
       <div class="col-lg-10 p-2">
       <select name="gideceksira" class="form-control">';
      while ($sonbilgi=$linklerebak->fetch(PDO::FETCH_ASSOC)) ://gelen veri aktarılır
      if($sonbilgi["siralama"]!=$kayitbilgial["siralama"]):
        echo '<option value="'.$sonbilgi["siralama"].'">'.$sonbilgi["siralama"].'-'.$sonbilgi["ad_tr"].'</option>';


      endif;
    endwhile;

       echo '</select></div>
      <div class="col-lg-12 border-top p-2">
      <input type="hidden" name="kayitidsi" value="'.$kayitid.'">
      <input type="hidden" name="mevcutsira" value="'.$kayitbilgial["siralama"].'">
      <input type="submit" name="buton" value="LİNK GÜNCELLE" class="btn btn-primary">
      </form>
      </div>  
      </div>
     
     ';
    else:
      $ad_tr=htmlspecialchars($_POST["ad_tr"]);
      $ad_en=htmlspecialchars($_POST["ad_en"]);
      $etiket=htmlspecialchars($_POST["etiket"]);
      $gideceksira=htmlspecialchars($_POST["gideceksira"]);
      $mevcutsira=htmlspecialchars($_POST["mevcutsira"]);
      $kayitidsi=htmlspecialchars($_POST["kayitidsi"]);


      if($ad_tr=="" && $ad_en=="" && $etiket==""):
        echo '<div class="alert alert-danger mt-5">VERİLER BOŞ OLAMAZ</div>
         </div>';

     
      header("refresh:2,url=control.php?sayfa=linkayar");
    else:

      self::sorgum($vt,"UPDATE linkler SET siralama='$mevcutsira' where siralama='$gideceksira'",0);
      

self::sorgum($vt,"UPDATE linkler SET ad_tr='$ad_tr',ad_en='$ad_en',etiket='$etiket',siralama='$gideceksira' where id='$kayitidsi'",0);
       echo '<div class="alert alert-success mt-5 mx-auto">GÜNCELLEME BAŞARILI</div>
         </div>';

     
      header("refresh:2,url=control.php?sayfa=linkayar");
      endif;

       endif;
 
      echo '</div>';

     }
     function linksil($vt){

      $kayitid=$_GET['id'];
      

      echo '<div class="row text-center"><div class="col-lg-12">';

      //veritabanı veri silme işlemi
      self::sorgum($vt,"DELETE FROM linkler where id=$kayitid",0);

      
      echo '<div class="alert alert-success mt-5 mx-auto">SİLME BAŞARILI"</div>';

      echo '</div></div>';
      header("refresh:2,url=control.php?sayfa=linkayar");
   


     }



    
}

 ?>