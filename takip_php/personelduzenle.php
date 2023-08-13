<?php 
    include 'header.php';
    $usergetir=$connect->prepare("SELECT * FROM users WHERE id=:id");
    $usergetir->execute(array(

        'id'=>$_GET['id']

    ));
    $personel="Personel";
    $admin="Admin";
    $usercek=$usergetir->fetch(PDO::FETCH_ASSOC);
    if($usercek['yetki']=="1"){$usercek['yetki']=$personel;}
    if($usercek['yetki']=="0"){$usercek['yetki']=$admin;}
?>

            <div class="main-content">
                <div class="section__content section__content--p25">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="overview-wrap">
                                    <a style="margin-bottom:10px;margin-top: -25px;border-radius:25px;background-color: #1e88e5"; class="btn btn-primary btn-sm" href="personel.php"><i class="fa fa-arrow-left"></i>&nbsp;Geri Dön</a>
                                    <br>
                                    

                                </div>
                            </div>
                        </div>
                          
                <div style="justify-content: center;" class="row">
                            <div class="col-lg-11">
                                <div style="border-radius:15px" class="card">
                                    <div style="color:black;background-color:#1e88e5;border-top-right-radius: 15px;border-top-left-radius: 15px;" class="card-header">
                                        <strong>Personel Bilgileri Güncelleme İşlemi</strong> 
                                    </div>
                                    <div class="card-body card-block">
                                        <form action="islem.php" method="post" enctype="multipart/form-data" class="form-horizontal">
                                            <div class="row form-group">
                                                <div class="col col-md-2">
                                                    <label style="color:black;" for="text-input" class=" form-control-label">Ad Soyad</label>
                                                </div>
                                                <div class="col-12 col-md-10">
                                                    <input required type="text" id="text-input" name="adsoyad" value="<?php echo $usercek['adsoyad'] ?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-2">
                                                    <label style="color:black;" class=" form-control-label">E-Mail</label>
                                                </div>
                                                <div class="col-12 col-md-10">
                                                    <input required type="text" name="email" value="<?php echo $usercek['mail'] ?>" class="form-control">
                                                 
                                                </div>
                                            </div>
                                             <div class="row form-group">
                                                <div class="col col-md-2">
                                                    <label style="color:black;" class=" form-control-label">Telefon</label>
                                                </div>
                                                <div class="col-12 col-md-10">
                                                    <input required type="text" name="telefon" value="<?php echo $usercek['telefon'] ?>" class="form-control">
                                                </div>
                                            </div>
                                             <div class="row form-group">
                                                <div class="col col-md-2">
                                                    <label style="color:black;" class=" form-control-label">Kullanıcı Adı</label>
                                                </div>
                                                <div class="col-12 col-md-10">
                                                    <input required type="text" name="username" value="<?php echo $usercek['username'] ?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-2">
                                                    <label style="color:black;" class=" form-control-label">Şifre</label>
                                                </div>
                                                <div class="col-12 col-md-10">
                                                    <input required type="text" name="password" value="<?php echo $usercek['sifre'] ?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-2">
                                                    <label style="color:black;" for="select" class=" form-control-label">Yetki</label>
                                                </div>
                                                <div class="col-12 col-md-10">
                                                    <select required name="secim" id="select" class="form-control">
                                                        <option hidden value=""><?php echo $usercek['yetki'] ?></option>
                                                        <option value="0">Admin</option>
                                                        <option value="1">Personel</option>
                                                    </select>
                                                    <small class="help-block form-text">Yetki tipi <strong>Personel</strong> olarak seçilen hesaplar yanlızca mobil uygulamaya giriş yapabileceklerdir.Web sitesine giriş yapamazlar !</small>
                                                </div>
                                            </div>
                                            <input type="hidden" name="id" value="<?php echo $usercek['id'] ?>">
                                             <div style="margin-left:-20px;" class="card-footer">
                                        <button style="border-radius:25px" type="submit" name="personelduzenle" class="btn btn-success btn-sm">
                                            <i class="fa fa-gear"></i> Bilgileri Güncelle
                                        </button>

                                    </div>
                                        
                                        </form>
                            </div>
                           
            </div>
                
            </div>
        </div>
    </div>
       <?php 
    include 'footer.php';
       ?>