<?php


require_once '../baglanti.php';
$users=[];
$sorgu=$connect->prepare('SELECT * FROM users');
$sorgu->execute();

    while($esassorgu=$sorgu->fetch(PDO::FETCH_ASSOC)){
        $users[]=$esassorgu;
    }

    echo json_encode($users);
 ?>


 