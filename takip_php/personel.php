<?php 
    include 'header.php';

    $usersorgu=$connect->prepare("SELECT * FROM users ");
    $usersorgu->execute();
    $admin="Admin";
    $personel="Personel";
    
?>
            <div style="margin-top: -40px;" class="main-content">
                <div class="section__content section__content--p25">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                  <?php if(@$_GET['islem']=="basarisiz"){ ?> 
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                            <span class="badge badge-pill badge-danger">!</span>
                                            Personel Ekleme İşlemi Başarısız !
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php } if(@$_GET['islem']=="basarili") { ?>
                                        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                                            <span class="badge badge-pill badge-success"> + </span>
                                            Tebrikler Personel Başarıyla Eklendi !
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php } ?>
                                     <?php if(@$_GET['gislem']=="basarisiz"){ ?> 
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                            <span class="badge badge-pill badge-danger">!</span>
                                            Personel Güncelleme İşlemi Başarısız !
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php } if(@$_GET['gislem']=="basarili") { ?>
                                        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                                            <span class="badge badge-pill badge-success"> + </span>
                                            Tebrikler Personel Başarıyla Güncellendi !
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php } ?>
                                     <?php if(@$_GET['silme']=="basarisiz"){ ?> 
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                            <span class="badge badge-pill badge-danger">!</span>
                                            Personel Silme İşlemi Başarısız !
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php } if(@$_GET['silme']=="basarili") { ?>
                                        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                                            <span class="badge badge-pill badge-success"> + </span>
                                            Tebrikler Personel Silme İşlemi Başarılı !
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php } ?>
                                <div style="margin-bottom: 5px;margin-top:10px;align-items: center;" class="overview-wrap">
                                    <h4><i style="border-radius:20px;margin-right:7px" class="fa fa-users"></i>Personel İşlemleri</h4>
                                    <br>
                                    
                                        <a style="margin-right: 3px;border-radius: 50px" class="btn btn-primary btn-sm" href="personelekle.php"><i class="fa fa-plus-circle"></i>&nbsp;Yeni Personel Ekle</a>
                                    

                                </div>
                            </div>
                        </div>
                 <hr>
                          
                <div style="margin-top: -10px;" class="row">
                            <div class="col-lg-12">
                                <div style="border-radius:40px;"  class="table-responsive table--no-card m-b-30 shadow">
                                    <table style="border-radius:px;" class="table table-striped mt-2">
                                    
                                        <thead style="background-color:#1e88e5;font-weight: 500;">
                                            <tr style="color: black;">
                                                <th style="font-size:15px">Ad Soyad</th>
                                                <th style="font-size:15px">Telefon</th>
                                                <th class="text-center" style="font-size:15px">E-mail</th>
                                                <th class="text-right" style="font-size:15px">Yetki</th>
                                                <th class="text-right"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($usercek=$usersorgu->fetch(PDO::FETCH_ASSOC)) {
                                                if($usercek['yetki']=="1"){$usercek['yetki']=$personel;}
                                                 if($usercek['yetki']=="0"){$usercek['yetki']=$admin;}

                                              ?>
                                            <tr>
                                                <td style="color:black;font-size: 15px;"><?php echo $usercek['adsoyad']?></td>
                                                <td style="color:black;font-size: 15px;"><?php echo $usercek['telefon']?></td>
                                                <td style="color:black;font-size: 15px;" class="text-center"><?php echo $usercek['mail']?></td>
                                                <td style="color:black;font-size: 15px;" class="text-right"><?php echo $usercek['yetki'] ?></td>
                                                <td class="text-right"><a style="border-radius: 30px;" class="btn btn-success btn-sm" href="personeldetay.php?id=<?php echo $usercek['id']?>">Personel Detay</a><a style="margin-left: 6px;border-radius: 30px;" class="btn btn-warning btn-sm" href="personelduzenle.php?id=<?php echo $usercek['id']?>">Bilgileri Güncelle</a><button value="<?php echo $usercek['id'] ?>" style="margin-left:6px;border-radius:30px" id="idgit" type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#smallmodal">Personeli Sil</button>
                                </td>

                                            </tr>
                                        </tbody>
                                    <?php } ?>
                                    </table>

                                    
                                </div>
                            </div>
                               <div class="modal fade" id="smallmodal" z-index="-1" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="smallmodalLabel">UYARI !</h4>
                            <br>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p style="color: black;font-weight: 400;font-size: 17px;">
                                Personeli silmek isteğinizden gerçekten emin misiniz ?
                            </p>
                        </div>
                      
                        <div class="modal-footer">
                            <a style="margin-left: 3px;color: white;" data-dismiss="modal" class="btn btn-danger btn-sm">Hayır</a>
                             <a style="margin-left: 3px;" id="sil" data-toogle="modal" class="btn btn-success btn-sm" href="islem.php?id=">Evet</a>
                        </div>
                    </div>
                   
                </div>
            </div>  
                           
            </div>
                
            </div>
        </div>
    </div>
      
       <?php 
    include 'footer.php';

       ?>