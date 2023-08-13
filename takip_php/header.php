<?php

require_once 'baglanti.php';
 session_start();
$kullanicisorgu=$connect->prepare("SELECT * FROM users WHERE username=:username and yetki=:yetki");
$kullanicisorgu->execute(array(

    'username'=>$_SESSION['username'],
    'yetki'=>$_SESSION['yetki']

));
$var=$kullanicisorgu->rowCount();
if($var==0){

    header("Location:login.php?giris=girisyapilmadi");

};


 ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Personel Takip Sistemi</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
    
  <script src=
"https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    </script>
    
   <style type="text/css">
    

       .marker{
    bottom: -28px;
    left: 0;
    position: relative;
}


    
.modal-backdrop {
  z-index: -1;
}
    
   </style>



    
    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body id="body">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo">
                               <img src="images/icon/PTS5.png" alt="CoolAdmin" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav style="margin-top:-20px" class="navbar-mobile">
                <div class="container-fluid">
                    <h4 style="font-size:15px;color:black;font-weight:500;align-items: center;justify-content: center;">Admin : <?php echo $_SESSION['adsoyad']?></h4>
                    <hr>
                    <ul class="navbar-mobile__list list-unstyled">
                       <li>
                            <a href="index.php">
                                <i class="fas fa-location-arrow"></i>Harita</a>
                        </li>
                         <li>
                            <a href="personel.php">
                                <i class="fas fa-users"></i>Personel İşlemleri</a>
                        </li>
                        <li>
                            <a href="mesajislemleri.php">
                                <i class="fas fa-comment"></i>Mesaj İşlemleri</a>
                        </li>
                         <li  style="margin-top:-7px">
                            <a href="mobiluyguluama.php">
                                <i style="margin-right: 10px;" class="fas fa-android"></i>Mobil Uygulama</a>
                        </li>
                        <li>
                            <a href="cikis.php">
                                <i class="fa fa-power-off"></i>Çıkış</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a>
                    <img src="images/icon/PTS5.png" alt="Cool Admin" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav style="margin-top:-20px;" class="navbar-sidebar">
                    <h4 style="font-size:15px;color:black;font-weight:500;align-items: center;justify-content: center;">Admin : <?php echo $_SESSION['adsoyad']?></h4>
                    <hr>
                    <div>
                    <ul style="margin-top:-20px;" class="list-unstyled navbar__list">
                        <li style="margin-top:-5px" >
                            <a style="text-align: left;margin-left: 3px;" href="index.php">
                                <i style="margin-right: 6px;" class="fas fa-location-arrow"></i>Harita</a>
                        </li>
                         <li style="margin-top:-5px">
                            <a style="text-align: left;"  href="personel.php">
                               <i style="margin-right: 5px;" class="fas fa-users"></i>Personel İşlemleri</a>
                        </li>
                        <li style="margin-top:-5px">
                            <a style="text-align: left;"  href="mesajislemleri.php">
                                <i style="margin-right: 7px;" id="headmesaj" class="fas fa-comment"></i>Mesaj İşlemleri         
                                 <span style="font-size:11px;margin-top: -1px;margin-left: 6px;display: none;" id="badge" class="badge badge-success p-1">Yeni Mesaj</span></a>     
                        </li>
                        <li style="margin-top:-5px">
                            <a style="text-align: left;margin-left: 3px;"  href="mobiluygulama.php">
                                <i style="margin-right: 9px;" class="fa fa-mobile-phone"></i>Mobil Uygulama</a>
                        </li>
                         
                        <li style="margin-top:-5px">
                            <a style="text-align: left;"  href="cikis.php">
                                <i style="margin-right: 5px;" class="fa fa-power-off"></i>Çıkış</a>
                        </li>

                    </ul>
                    </div>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                          <h3>PERSONEL TAKİP SİSTEMİ</h3>
                            <div><p style="font-size:16px;color:black;font-weight: 600;" id="saat"></p></div>
                        </div>
                    </div>

                </div>
            

            </header>

         <script src="https://momentjs.com/downloads/moment-with-locales.js"></script>
<script type="text/JavaScript">

let saatgetir=document.getElementById("saat");

let saat=()=>{


     moment.locale("tr");
    let zaman2=moment().format('LL');
    let zaman3=moment().format('LT');
    saatgetir.innerHTML=zaman2+" - "+zaman3;
            
  };
  saat();
  setInterval(saat,1000);

</script>
