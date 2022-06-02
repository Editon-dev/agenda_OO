<?php
    require_once ('chamapdo.php');

        /*ESTADOS*/
        $queryEstados = "select * from estados order by Nome";
        $sqlEstados = $conn->prepare($queryEstados);
        $sqlEstados->execute();
        if($sqlEstados->rowCount()>0){
            $estado = $sqlEstados->fetchALL(PDO::FETCH_ASSOC);
        }
?>