<?php 
    
    include 'header.php';
     $usersorgu=$connect->prepare("SELECT * FROM users WHERE yetki=1 ");
    $usersorgu->execute();


   
?>

            <div id="yan" class="main-content">
                <div class="section__content section__content--p20">
                    <div class="container-fluid">
                        <div style="margin-top:-30px;" class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h4><i style="border-radius:20px;margin-right:7px" class="fas fa-comment"></i> Mesaj İşlemleri</h4>
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <hr>
                     
                <div style="margin-top:-15px" class="row">
                            <div class="col-lg-12">
                                     <div id="sayfag" style="background-color:#E8F5E9; border-radius: 20px;margin-top:10px;" class="">
                                    <div style="padding-right:30px;padding-left:30px;margin-top:10px;overflow-x: auto;max-height: 200px;padding-bottom:10px;" class="table-responsive">
                                        <table  style="font-size: 16px;background-color:#E8F5E9;border-collapse: collapse;width: 100%;padding: 10px;" class="table table-condensed table text-center">
    <thead style="position: sticky;top:0; background: #1E88E5;">  
      <tr>
        <th style="color: black;font-size:15px;padding: 5px 5px;top: 0;border-bottom-left-radius: 40px;border-top-left-radius: 40px;"><i style="border-radius:20px;margin-right:7px;padding: 5px 5px;top: 0;" class="fa fa-user"></i>Personel</th>
        <th style="padding:5px 5px;top: 0;"></th>
        <th style="border-bottom-right-radius: 40px;border-top-right-radius: 40px;padding: 5px 5px;top: 0;font-size: 15px;color: black;"><i style="border-radius:20px;margin-right:7px;padding: 5px 5px;top: 0;" class="fa fa-bell"></i>Mesaj Durumu</th>
      </tr> 
    </thead>
    <tbody>
        <?php while ($usercek=$usersorgu->fetch(PDO::FETCH_ASSOC)) { ?>
      <tr>
        <td style="padding: 4px 1px;color: black;"><?php echo $usercek['adsoyad'] ?></td>
        <td style="padding: 4px 1px;"><form action="" method="get" id="formjs"><button style="margin-right: 3px;border-radius: 40px; font-size: 13px;" type="button" value="<?php echo $usercek['id'] ?>" id="mesajgonder1" class="btn btn-primary btn-sm">
                                            <i class="fa fa-comments"></i> Mesaj Gönder
                                        </button></form></td>
                  <?php if($usercek['durum2']=="geldi"){  ?>
        <td id="td1" style="padding: 4px 1px;color: black;font-size: 14px;"><form action="" method="get" id="formjs"><button style="margin-right: 3px;border-radius: 40px; font-size: 13px;" type="button" value="<?php echo $usercek['id'] ?>" id="mesajoku" class="btn btn-success btn-sm">
                                            <i class="fa fa-eye"></i> Mesajınız var !
                                        </button></form></td>
                                    <?php } else { ?>
                                        <td id="td2" style="padding: 4px 1px;color: black;font-size: 14px;"></td>
                                    <?php } ?>
      </tr>
  <?php } ?>
    </tbody>

  </table>
                                    </div>
                                </div>
                            </div>
                           
            </div>  


            <div class="row">
                 <div style="height:800px"  class="col-lg-12">
                     <?php 
               if(isset($_GET['veri'])){
   
   

                $usersorgu2=$connect->prepare("SELECT * FROM users WHERE id=:id ");
                $usersorgu2->execute(array(

                'id'=>$_GET['veri']

                ));
                $useresasgetir=$usersorgu2->fetch(PDO::FETCH_ASSOC);

                    
                ?>
                <div style="margin-top:50px;" id="mesaj">
                    <div style="border-radius: 15px;font-size: 14px;background-color:#E8F5E9;border-collapse: collapse;width: 100%;margin-top:5px;padding: 6px;position: relative;align-items: center;justify-content: center;" class="card-header">
                                        <strong style="font-size: 15px;align-items: center;justify-content: center;color: #36454F;" class="card-title">Mesaj : <?php echo @$useresasgetir['adsoyad'] ?>
                                        </strong>
                                         <strong style="font-size: 14px;position: absolute;right:0;margin-right:50px;justify-content: center;color: #36454F;" class="card-title">Mesaj geçmişini sil
                                        </strong>
                                         <button style="position:absolute;right:0;border-radius:20px;margin-right:10px;margin-top: -3px;
                                         " type="button" value="<?php echo $useresasgetir['id'] ?>" id="temizlebuton" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#smallmodal1" >
                                           <i style="font-size:14px" class="fa fa-trash"></i>
                                            </button>
                                        
                                        
                                    </div>
                                        <div class="modal fade" id="smallmodal1" z-index="-1" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
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
                                Mesaj geçmişini silmek istediğinizden emin misiniz ? 
                            </p>
                        </div>
                      
                        <div class="modal-footer">
                            <a style="margin-left: 3px;color: white;" data-dismiss="modal" class="btn btn-danger btn-sm">Hayır</a>
                             <a style="margin-left: 3px;" id="msil" data-toogle="modal" class="btn btn-success btn-sm" href="islem.php?id=">Evet</a>
                        </div>
                    </div>
                   
                </div>
            </div>  
                     <div id="scroll" style="margin-top:2px;max-height:630px;overflow-x: auto;border-radius: 20px;" class="card shadow">
                         
                                    <div  style="margin-top: 20px;" class="card-body">

                                          <div id="cardg" class="col-md-3">
                             <?php
                              $mesajcek=$connect->prepare("SELECT * FROM mesajlar WHERE 

                                alici_id=:alici_id
                                
                                ");
                              $mesajcek->execute(array(
                                    'alici_id'=>$_GET['veri']
                              ));

                              while ($mesajesascek=$mesajcek->fetch(PDO::FETCH_ASSOC)) {  ?>
                                <?php if($mesajesascek['gonderen_id']==0){  ?>
                                <div id="gel" style="border-radius: 35px;background-color: #E8F5E9;" class="card shadow">
                                    <div class="card-header">
                                        <strong style="font-size: 13px;color: black; font-weight: 600;" class="card-title"><?php echo $mesajesascek['gonderen'] ?>
                                            <small style="font-size:15px">
                                                <span style="border-radius: 15px;padding: 5px;" class="badge badge-primary float-right mt-1">Tarih: <?php echo $mesajesascek['tarih'] ?></span>
                                            </small>
                                        </strong>
                                    </div>
                                    <div class="card-body">
                                        <p style="font-size:13px;color:black" class="card-text"><?php echo $mesajesascek['mesaj'] ?>
                                        </p>
                                    </div>
                                </div>

                                 <?php } else { ?>  <div id="gel" style="border-radius: 35px;background-color: #ECEFF1;" class="card shadow">
                                    <div class="card-header">
                                        <strong style="font-size: 13px;color: black; font-weight: 600;" class="card-title"><?php echo $mesajesascek['gonderen'] ?>
                                            <small style="font-size:15px">
                                                <span style="border-radius: 15px;padding: 5px;" class="badge badge-primary float-right mt-1">Tarih: <?php echo $mesajesascek['tarih'] ?></span>
                                            </small>
                                        </strong>
                                    </div>
                                    <div class="card-body">
                                        <p style="font-size:13px;color:black;" class="card-text"><?php echo $mesajesascek['mesaj'] ?>
                                        </p>
                                    </div>
                                </div>
                            <?php } } ?>
                                </div>

                                <div style="margin-bottom: 30px;" class="col-md-12">
                                    <hr>
                                <div class="card-body">
                                <form method="post" id="mesajform">
                                    <input type="hidden" name="hidden" value="0">
                                 
                                    <input type="hidden" name="alici_id" value="<?php echo $useresasgetir['id'] ?>">
                                    <input type="hidden" name="alici" value="<?php echo $useresasgetir['adsoyad'] ?>">
                                    <textarea style="border-radius:30px;background-color:#E8F5E9;font-size: 14px;" name="textarea-input" id="textarea-input" rows="6" placeholder="Lütfen bir mesaj giriniz." class="form-control"></textarea>
                                    <button style="position:absolute;right: 50;margin-top: 5px;margin-bottom:20px;border-radius: 20px;" type="button" name="personelekle" id="gonderbuton" class="btn btn-primary btn-sm">
                                            <i class="fa fa-reply"></i> Gönder
                                        </button>
                                </form>
                                </div>
                                </div>
                                    </div>
                                </div>
                                </div>
                </div>
                  <?php } ?>
                 
            </div>
      

        </div>
    </div>
</div>
       <?php 
    include 'footer.php';
       ?>