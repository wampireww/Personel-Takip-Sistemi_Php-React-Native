<?php


require_once '../baglanti.php';
$gelenmesaj=file_get_contents("php://input");
$gelenesasmesaj=json_decode($gelenmesaj);
$idgelen=$gelenesasmesaj->gonderenid;
$adsoyad=$gelenesasmesaj->isim;
$yetki=$gelenesasmesaj->gonderenyetki;
$mesaj=$gelenesasmesaj->mesaj;
$durum2=$gelenesasmesaj->durum2;
date_default_timezone_set("Europe/Istanbul");
$tarih=date("d/m/y - H:i",time());

 $mesajekle=$connect->prepare("INSERT INTO mesajlar set

    alici=:alici,
    alici_id=:alici_id,
    gonderen=:gonderen,
    gonderen_id=:gonderen_id,
    mesaj=:mesaj,
    tarih=:tarih

    ");

 $mesajesasekle=$mesajekle->execute(array(

    'alici'=>"Admin",
    'alici_id'=>$idgelen,
    'gonderen'=>$adsoyad,
    'gonderen_id'=>$yetki,
    'mesaj'=>$mesaj,
    'tarih'=>$tarih
 ));

 $update=$connect->prepare("UPDATE users SET durum2=:durum2 WHERE id={$idgelen}");
 $updateesas=$update->execute(array(
        'durum2'=>"geldi"
 ));



 ?>


 