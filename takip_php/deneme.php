                       <?php
               //           include 'header.php';
                       require_once 'baglanti.php';

                                        if(isset($_POST['deger'])){

                                $gelen=$_POST['deger'];
                               $mesajcek=$connect->prepare("SELECT * FROM mesajlar WHERE 

                                alici_id=:alici_id
                                
                                ");
                              $mesajcek->execute(array(
                                    'alici_id'=>$gelen
                              ));

                              };

                        ?>   
        
                                <div style="margin-top:50px;" id="mesaj">
                    <div style="border-radius: 15px;font-size: 14px;background-color:#E8F5E9;border-collapse: collapse;width: 100%;margin-top:5px;padding: 6px;position: relative;align-items: center;justify-content: center;" class="card-header">
                                        <strong style="font-size: 15px;align-items: center;justify-content: center;" class="card-title">Mesaj : <?php echo $useresasgetir['adsoyad'] ?>
                                        </strong>
                                    </div>
                     <div id="scroll" style="margin-top:2px;height:630px;overflow-x: auto;border-radius: 20px;" class="card shadow">
                         
                                    <div  style="margin-top: 20px;" class="card-body">

                                          <div id="cardg" class="col-md-3">
                             

                          <?php    while ($mesajesascek=$mesajcek->fetch(PDO::FETCH_ASSOC)) { 
                              if(@$mesajesascek['gonderen_id']==0){  ?>
                                <div style="border-radius: 35px;background-color:#E8F5E9;" class="card shadow">
                                    <div class="card-header">
                                        <strong style="font-size: 13px;color: black; font-weight: 600;" class="card-title"><?php echo $mesajesascek['gonderen'] ?>
                                            <small style="font-size:15px">
                                                <span style="border-radius:15px;padding:5px" class="badge badge-primary float-right mt-1">Tarih: <?php echo $mesajesascek['tarih'] ?></span>
                                            </small>
                                        </strong>
                                    </div>
                                    <div class="card-body">
                                        <p style="font-size:13px;color:black;" class="card-text"><?php echo $mesajesascek['mesaj'] ?>
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


    <!-- Main JS-->
   
                                  <?php 
 //    include 'footer.php';
       ?>