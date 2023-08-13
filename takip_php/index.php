<?php 
    
    include 'header.php';
     $usersorgu=$connect->prepare("SELECT * FROM users WHERE yetki=1 ");
    $usersorgu->execute();
    

?>

            <div class="main-content">
                <div class="section__content section__content--p29">
                    <div class="container-fluid">
                        <div style="margin-top:-30px;" class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h4><i style="border-radius:20px;margin-right:7px" class="fas fa-location-arrow"></i>Genel Harita</h4>
                                    <br>
                                    <a style="margin-right: 3px;border-radius: 50px;" class="btn btn-success btn-sm shadow-lg" href="index.php"><i style="border-radius:20px" class="fa fa-refresh"></i>&nbsp;Haritayı Yenile</a>
                                   

                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div id="googleMap" style="width:100%;height:500px;margin-top: 5px;"></div>
                        </div>
                            

<script>
function myMap() {
    
    const uluru = { lat:41.0041459, lng:28.7548751 };
var mapProp= {
  center:new google.maps.LatLng(41.0041459,28.7548751),
  zoom:10,
  clickableIcons:true,
  mapTypeId: 'roadmap',

};
var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);

<?php  $usergeosorgu=$connect->prepare("SELECT * FROM users WHERE yetki=1 ");
    $usergeosorgu->execute();

    while ($esasgeosorgu=$usergeosorgu->fetch(PDO::FETCH_ASSOC)) { ?>

 new google.maps.Marker({
   <?php if($esasgeosorgu['xkord']=="" && $esasgeosorgu['ykord']=="") { ?>
        position:{ lat:0.000, lng:0.000 },
<?php } else { ?>
        position:{ lat:<?php echo $esasgeosorgu['xkord'] ?>, lng:<?php echo $esasgeosorgu['ykord'] ?> },
<?php } ?>
    map:map,
     label: {
    text:"<?php echo $esasgeosorgu['adsoyad'] ?>",
    // Add in the custom label here
    fontFamily: 'Roboto, Arial, sans-serif, custom-label-',
    fontSize:"20px",
    color:"black",
    className:"marker",
    fontWeight:"bold"
  },
  }

  );

<?php } ?>

}


</script>

 <script src=" // api key // "></script>
          
                <div class="row">
                    
                            <div style="margin-top:-5px;border-radius: 20px;" class="col-lg-12">
                                     <div style="background-color:#ECEFF1; border-radius: 20px;margin-top: 5px;" class="shadow">
                                    <div style="padding-right: 30px;padding-left: 30px;margin-top:10px;overflow-x: auto;max-height:400px;" class="table-responsive">
                                        <table style="font-size: 14px;background-color:#ECEFF1 ;width: 100%;" class="table table-sm text-center">
    <thead style="position: sticky;top:0;background-color: #B0BEC5;">
      <tr>
        <th style="color: black;font-size:15px;padding-left: 100px;border-top-left-radius: 40px;border-bottom-left-radius: 40px;"><i style="border-radius:20px;margin-right:10px;padding: 1px 1px;" class="fa fa-user"></i>Personel</th>
        <th style="color: black;font-size:15px;padding-right: 100px;border-top-right-radius: 40px;border-bottom-right-radius: 40px;"><i style="border-radius:20px;margin-right:10px;padding: 1px 1px;" class="fa fa-dot-circle-o"></i>Son Konum Güncelleme</th>
       
      </tr>
    </thead>
    <tbody>
         <?php while ($usercek=$usersorgu->fetch(PDO::FETCH_ASSOC)) { ?>
      <tr>
        <td style="color: black;font-size:14px;padding-left: 100px;"><?php echo $usercek['adsoyad'] ?></td>
        <?php if($usercek['xkord']=="" && $usercek['ykord']=="") { ?>
        <td style="color: black;font-size:14px;padding-right: 100px;">Konum Bilgisi alınamıyor.</td>
    <?php } else { ?>
        <td style="color: black;font-size:14px;padding-right: 100px;"><?php echo $usercek['sontarih'] ?></td>
      </tr>
  <?php }} ?>
    </tbody>
  </table>
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
