<?php


require_once '../baglanti.php';
$gelengeo=file_get_contents("php://input");
$gelenesasgeo=json_decode($gelengeo);
$idgelen=$gelenesasgeo->id;
$latitude=$gelenesasgeo->Glatitude;
$longitude=$gelenesasgeo->Glongitude;
date_default_timezone_set("Europe/Istanbul");
$tarih=date("d/m/y - H:i",time());


 $updategeo=$connect->prepare("UPDATE users SET 

      xkord=:xkord,
      ykord=:ykord,
      sontarih=:sontarih

  WHERE id={$idgelen}");
 
 $updateesasgeo=$updategeo->execute(array(
         'xkord'=>$latitude,
         'ykord'=>$longitude,
         'sontarih'=>$tarih
 ));

   if($updateesasgeo){

      echo json_encode("Basarili");
   }


 ?>
