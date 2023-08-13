<?php

session_start();
require_once 'baglanti.php';

if(isset($_POST['giris'])){

$username=htmlspecialchars($_POST['username']);
$sifre=htmlspecialchars($_POST['sifre']);

$usersorgu=$connect->prepare("SELECT * FROM users WHERE username=:username and sifre=:sifre and yetki=:yetki");
$usersorgu->execute(array(

'username'=>$username,
'sifre'=>$sifre,
'yetki'=>0

));

$var=$usersorgu->rowCount();
if($var>0){
$useresassorgu=$usersorgu->fetch(PDO::FETCH_ASSOC);
$_SESSION['username']=$username;
$_SESSION['yetki']=0;
$_SESSION['adsoyad']=$useresassorgu['adsoyad'];
header("Location:index.php?giris=basarili");
}
else{
	header("Location:login.php?giris=basarisiz");
}

};

////////////////////////////////////// PERSONEL EKLEME İŞLEMİ

if(isset($_POST['personelekle'])){

$_adsoyad=htmlspecialchars($_POST['adsoyad']);
$_email=htmlspecialchars($_POST['email']);
$_telefon=htmlspecialchars($_POST['telefon']);
$_kuladi=htmlspecialchars($_POST['username']);
$_sifre=htmlspecialchars($_POST['password']);
$_yetki=htmlspecialchars($_POST['secim']);

$personelekle=$connect->prepare("INSERT INTO users set

	adsoyad=:adsoyad,
	mail=:mail,
	telefon=:telefon,
	username=:username,
	sifre=:sifre,
	xkord=:xkord,
	ykord=:ykord,
	yetki=:yetki
	");

$personelesasekle=$personelekle->execute(array(

	'adsoyad'=>$_adsoyad,
	'mail'=>$_email,
	'telefon'=>$_telefon,
	'username'=>$_kuladi,
	'sifre'=>$_sifre,
	'xkord'=>0.7575,
	'ykord'=>0.7575,
	'yetki'=>$_yetki

));
	
	if($personelesasekle){

		header("Location:personel.php?islem=basarili");
	}
	else{
		header("Location:personel.php?islem=basarisiz");
	}

}
////////////////////////////////// PERSONEL GUNCELLE ISLEMİ

if(isset($_POST['personelduzenle'])){

$_adsoyad=htmlspecialchars($_POST['adsoyad']);
$_email=htmlspecialchars($_POST['email']);
$_telefon=htmlspecialchars($_POST['telefon']);
$_kuladi=htmlspecialchars($_POST['username']);
$_sifre=htmlspecialchars($_POST['password']);
$_yetki=htmlspecialchars($_POST['secim']);

$personelduzenle=$connect->prepare("UPDATE users set

	adsoyad=:adsoyad,
	mail=:mail,
	telefon=:telefon,
	username=:username,
	sifre=:sifre,
	xkord=:xkord,
	ykord=:ykord,
	yetki=:yetki

	WHERE id={$_POST['id']}
	");

$personelesasduzenle=$personelduzenle->execute(array(

	'adsoyad'=>$_adsoyad,
	'mail'=>$_email,
	'telefon'=>$_telefon,
	'username'=>$_kuladi,
	'sifre'=>$_sifre,
	'xkord'=>0.7575,
	'ykord'=>0.7575,
	'yetki'=>$_yetki

));
	
	if($personelesasduzenle){

		header("Location:personel.php?gislem=basarili");
	}
	else{
		header("Location:personel.php?gislem=basarisiz");
	}

 }


 ///////////////////////// PERSONEL SİLME İŞLEMİ

if(isset($_GET['silid'])){

	$personelsil=$connect->prepare("DELETE FROM users WHERE id=:id");
	$personelsil->execute(array(

	'id'=>$_GET['silid']

	));

	if($personelsil){
		header("Location:personel.php?silme=basarili");
	}
	else{
		header("Location:personel.php?silme=basarisiz");
	}
}

//////////////////// MESAJ GONDERME VE BİLDİRİM

if(isset($_POST['hidden'])){

$_mesaj=htmlspecialchars($_POST['textarea-input']);
$_alici_id=htmlspecialchars($_POST['alici_id']);
$gonderen_yetki=0;
$_gonderen="Admin";	
$_alici=htmlspecialchars($_POST['alici']);
date_default_timezone_set('Europe/Istanbul');
$tarih=date("d/m/y - H:i",time());
$durum="geldi";
$mesaj_yetki="Admin";


$mesajekle=$connect->prepare("INSERT INTO mesajlar set

	gonderen=:gonderen,
	gonderen_id=:gonderen_id,
	mesaj=:mesaj,
	alici_id=:alici_id,
	alici=:alici,
	durum=:durum,
	tarih=:tarih

	");

$mesajesasekle=$mesajekle->execute(array(

	'gonderen'=>$_gonderen,
	'gonderen_id'=>$gonderen_yetki,
	'mesaj'=>$_mesaj,
	'alici_id'=>$_alici_id,
	'alici'=>$_alici,
	'durum'=>"geldi",
	'tarih'=>$tarih

));
/////////// bildirim kısmı

	if($gonderen_yetki==0) {

	$durumupdate=$connect->prepare("UPDATE users set

	durum=:durum,
	durum2=:durum2

	WHERE id={$_alici_id}
	");

$durumesasupdate=$durumupdate->execute(array(

	//durum bizim karşı tarafa gönderdiğimiz.mesajdır 
	//durum2 karşı tarafın bize gönderdiği mesajdır.
	
	'durum'=>$durum,
	'durum2'=>"okundu"
));
	
};

	if($durumesasupdate){

		header("Location:mesajislemleriajax.php?veri=".$_POST['alici_id']);
	}
	else{
		header("Location:mesajislemleriajax.php");
	}

}

////////////////////////// BİLDİRİM KAPATMA KODU 

if(isset($_POST['personelid'])){

$gelenid=$_POST['personelid'];
$okundu="okundu";

$bildirimupdate=$connect->prepare("UPDATE users set

	durum2=:durum2

	WHERE id={$gelenid}
	");

$bildirimesasupdate=$bildirimupdate->execute(array(

	
	'durum2'=>$okundu
	
));

	if($bildirimesasupdate){

		echo json_encode("basarili");
	}
	else{
		echo json_encode("basarisiz");
	}

};


///////////////// MESAJ GEÇMİŞİ SİL

if(isset($_GET['msilid'])){

$gelenid=$_GET['msilid'];

$mesajsil=$connect->prepare("DELETE FROM mesajlar WHERE alici_id=:alici_id");
	$mesajsil->execute(array(

	'alici_id'=>$gelenid

	));

	if($mesajsil){
		header("Location:mesajislemleri.php?silme=basarili&veri=".$gelenid);
	}
	else{
		header("Location:personel.php?silme=basarisiz");
	}

}


///////////////// Header Mesaj Bildirim sorgu

if(isset($_POST['head'])){

$head=$_POST['head'];
	


$headsorgu=$connect->prepare("SELECT * FROM users WHERE durum2=:durum2");
$headsorgu->execute(array(

'durum2'=>$head

));

$var=$headsorgu->rowCount();
if($var>0){
	
	echo json_encode($var);	
	
}
else{
	echo json_encode(0);
};



}

 ?>