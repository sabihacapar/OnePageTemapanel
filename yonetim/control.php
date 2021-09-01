<?php include_once('assets/fonksiyon.php');
include_once('assets/fonksiyon2.php');
$yonetim=new yonetim;
$yonetim2=new yonetim2;
$yonetim->kontrolet("cot");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8">  
    <title>Yönetim Paneli</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">    
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">   
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>
<body>
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <a href="control.php"><img src="assets/images/logo/panel.png" alt="logo"></a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
                                                      
                            <li><a href="control.php?sayfa=introayar"><i class="ti-image"></i> <span>İntro Ayarları</span></a></li>
                            <li><a href="control.php?sayfa=hakkimiz"><i class="ti-flag"></i> <span>Hakkımızda Ayarları</span></a></li>
                            <li><a href="control.php?sayfa=hizmetler"><i class="ti-medall"></i> <span>Hizmetlerimiz Ayarları</span></a></li>
                            <li><a href="control.php?sayfa=referans"><i class="ti-eye"></i> <span>Referanslar Ayarları</span></a></li>
                             <li><a href="control.php?sayfa=tasarim"><i class="ti-eye"></i> <span>Tasarım Ayarları</span></a></li>
                        <li><a href="control.php?sayfa=aracfilo"><i class="ti-car"></i> <span>Araç Filosu</span></a></li>
                        <li><a href="control.php?sayfa=videolar"><i class="ti-image"></i> <span>Video Yönetim</span></a></li>
                            
                            <li><a href="control.php?sayfa=yorumlar"><i class="ti-comment-alt"></i> <span>Müşteri Yorumları</span></a></li>
                             <li><a href="control.php?sayfa=gelenmesaj"><i class="fa fa-envelope"></i> <span>Gelen Mesajlar</span></a></li>
                              <li><a href="control.php?sayfa=bakim"><i class="ti-server"></i> <span>Veritabanı Bakım</span></a></li>


                               <li><a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-cog"></i> <span>Ayarlar</span></a>
                                <!-- Birden fazla menünün aynı kısımda toplanması için -->


                                <ul class="collapse">

                                    <li><a href="control.php?sayfa=siteayar"><i class="ti-pencil"></i> <span>Site Ayarları</span></a></li>
                                    <li><a href="control.php?sayfa=mailayar"><i class="fa fa-envelope"></i> <span>Mail Ayarları</span></a></li>
                                    <li><a href="control.php?sayfa=linkayar"><i class="fa fa-envelope"></i> <span>Link Ayarları</span></a></li>

                                    

                                </ul>




                               </li><!-- aria-expanded toggle mantığı ile çalışıp çalışmamasını sağlar -->
                            
             
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center " style="max-height: 50px;">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                      
                    </div>
                    <!-- profile info & task notification -->
                     <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                            <img class="avatar user-thumb" src="assets/images/author/avatar.png" alt="avatar">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?php echo $yonetim->kuladial($baglanti);?> <i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">
                               
                                <a class="dropdown-item" href="control.php?sayfa=ayarlar">Ayarlar</a>
                                 <a class="dropdown-item" href="control.php?sayfa=kulayar">Kullanıcı Ayarları</a>
                                  <a class="dropdown-item" href="control.php?sayfa=cikis">Çıkış</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- header area end -->
            <!-- page title area start -->

            <!-- page title area end -->
            <div class="main-content-inner">
                <!-- sales report area start -->
               <div class="row">
                    <div class="col-lg-12 mt-2 bg-white text-center" style="min-height:500px;">
                      <?php
                      @$sayfa=$_GET['sayfa'];

                      switch ($sayfa) :

                        case "siteayar":
                        $yonetim->siteayar($baglanti);
                        break;

                        case "cikis":
                        $yonetim->cikis($baglanti);
                        break;
                        //--------------------------------
                        case "introayar":
                        $yonetim->introayar($baglanti);
                        break;
                        case "introresimguncelle":
                        $yonetim->introresimguncelleme($baglanti);
                        break;
                        case "introresimsil":
                        $yonetim->introsil($baglanti);
                        break;
                         case "introresimekle":
                        $yonetim->introresimekleme($baglanti);
                        break;
                         //--------------------------------------------------------------
                        case "aracfilo":
                          $yonetim->aracfilo($baglanti);
                        break;
                        case "aracfiloguncelle":
                        $yonetim->aracfiloguncelleme($baglanti);
                        break;
                        case "aracfilosil":
                        $yonetim->aracfilosil($baglanti);
                        break;
                         case "aracfiloekle":
                        $yonetim->aracfiloekleme($baglanti);
                        break;
                         //--------------------------------------------------------------
                        case "hakkimiz":
                         $yonetim2->hakkimizda($baglanti);
                        break;
                         //--------------------------------------------------------------
                        case 'hizmetler':
                        $yonetim2->hizmetlerhepsi($baglanti);
                        break;
                        case "hizmetguncelle":
                        $yonetim2->hizmetguncelleme($baglanti);
                        break;
                        case "hizmetsil":
                        $yonetim2->hizmetsil($baglanti);
                        break;
                         case "hizmetekle":
                        $yonetim2->hizmetekle($baglanti);
                        break;
                         //--------------------------------------------------------------
                        case 'referans':
                        $yonetim2->referanslarhepsi($baglanti);
                        break;
                        case "refsil":
                        $yonetim2->refsil($baglanti);
                        break;
                         case "refekle":
                        $yonetim2->refekleme($baglanti);
                        break;
                        //--------------------------------------------------------------
                        case 'yorumlar':
                        $yonetim2->yorumlarhepsi($baglanti);
                        break;
                        case "yorumguncelle":
                        $yonetim2->yorumguncelleme($baglanti);
                        break;
                        case "yorumsil":
                        $yonetim2->yorumsil($baglanti);
                        break;
                        case "yorumekle":
                        $yonetim2->yorumekle($baglanti);
                        break;
                        //---------------------------------------------------------
                        case "gelenmesaj":
                        $yonetim->gelenmesaj($baglanti);
                        break;
                        case "mailayar":
                        $yonetim2->mailayar($baglanti);
                        break;
                        case "mesajoku":
                        $yonetim->mesajdetay($baglanti,$_GET['id']);
                        break;
                        case "mesajarsivle":
                        $yonetim->mesajarsiv($baglanti,$_GET['id']);
                        break;
                        case "mesajsil":
                        $yonetim->mesajsil($baglanti,$_GET['id']);
                        break;
                        //----------------------------------------------------
                         case "mailayar":
                        $yonetim2->mailayar($baglanti);
                        break;
                        //----------------------------------------------------
                         case "ayarlar":
                        $yonetim2->ayarlar($baglanti);
                        break;
                        //----------------------------------------------------
                         case "kulayar":
                        $yonetim2->kullistele($baglanti);
                        break;
                         //----------------------------------------------------
                         case "yonsil":
                        $yonetim2->yonsil($baglanti,$_GET["id"]);
                        break;
                        //----------------------------------------------------
                         case "yonekle":
                        $yonetim2->yonekle($baglanti);
                        break;
                        //----------------------------------------------------
                         case "tasarim":
                        $yonetim2->tasarimYonetim($baglanti);
                        break;
                        //----------------------------------------------------
                         case "bakim":
                        $yonetim2->bakim($baglanti);
                        break;
                        //---------------------------------------------------
                        default:
                        $yonetim->introayar($baglanti);
                        break;
                        //----------------------------------------------------
                        case 'linkayar':
                        $yonetim2->linkayar($baglanti);
                        break;
                        case "linkguncelle":
                        $yonetim2->linkguncelleme($baglanti);
                        break;
                        case "linksil":
                        $yonetim2->linksil($baglanti);
                        break;
                         case "linkekle":
                        $yonetim2->linkekle($baglanti);
                        break;
                         //----------------------------------------------------
                        case 'videolar':
                        $yonetim->videolar($baglanti);
                        break;
                        case "videoguncelle":
                        $yonetim->videoguncelleme($baglanti);
                        break;
                        case "videosil":
                        $yonetim->videosil($baglanti);
                        break;
                         case "videoekle":
                        $yonetim->videoekle($baglanti);
                        break;

                         //-------------------------------------------------------------
                      endswitch;
                       ?>
                </div>
            </div>
            </div>
        </div>
        <!-- main content area end -->
    </div>
    <!-- page container area end -->
    
   
    <!-- jquery latest version -->
    <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>  

    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>
</body>

</html>f
