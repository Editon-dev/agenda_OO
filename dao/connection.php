<?php
    $username = 'root';
    $pwd = '';
    $host = 'localhost';
    $db = 'agenda';

    try{
        $conn = new PDO('mysql:host='.$host.';dbname='.$db,$username, $pwd);
        $conn->exec('SET CHARACTER SET utf8');
    }catch(PDOException $e){
        echo 'Error:'. $e->getMessage();
    }
?>
