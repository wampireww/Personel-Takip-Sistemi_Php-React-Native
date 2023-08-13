<?php

try {

$connect =new PDO("mysql:host=xxxxx; dbname=xxxx" ,'xxxxx', 'xxxxxx');
    
} catch (PDOException $e) {
    echo $e->getMessage();
}



?>
