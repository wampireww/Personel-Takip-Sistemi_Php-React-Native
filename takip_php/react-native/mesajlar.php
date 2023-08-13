<?php


require_once '../baglanti.php';
$mesajlar=[];
$sorgu=$connect->prepare('SELECT * FROM mesajlar');
$sorgu->execute();

    while($esassorgu=$sorgu->fetch(PDO::FETCH_ASSOC)){
        $mesajlar[]=$esassorgu;
    }

    echo json_encode($mesajlar);
 ?>


 