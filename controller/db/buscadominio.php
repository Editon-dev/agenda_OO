<?php
    require_once ('chamapdo.php');

    $dominio = $_POST['linkFinal'];

    try{
        /*AUTENTICA DOMINIO*/
        $queryDominios = "SELECT * FROM `sgov`.`status_produto` sgst, `sgov`.`clientes` sgc

        WHERE sgst.id_cliente =
        ( 
        SELECT id_cliente FROM `sgov`.`clientes`
        WHERE id_ouvidoria_cliente = '".$dominio."'
        )
        AND sgst.id_status = 1
        AND sgst.id_cliente = sgc.id_cliente;";
        $sqlDominios = $conn->prepare($queryDominios);
        $sqlDominios->execute();
        if($sqlDominios->rowCount()>0){
            $dominio = $sqlDominios->fetchALL(PDO::FETCH_ASSOC);
            foreach($dominio as $d){}
            echo $d['id_ouvidoria_cliente'];
        }
        else{
            echo 0;
        }
    }
    catch(Exception $e){
        $e->getMessage();
    }
?>