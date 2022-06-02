<?php
    require __DIR__.'/../../../vendor/autoload.php';
    use Classes\Entity\Usuario;

    $autStatus = 0;
    if($_GET['id'] != "teste"){
        /*CONFERE STATUS*/
        $sujeito = $_GET['id'];
        $idBanco = str_replace('agenda_', '', $sujeito);
        $queryAuts = "select id_status from `sgov`.`status_produto` WHERE id_cliente = (SELECT id_cliente FROM `sgov`.`clientes` WHERE id_agenda_cliente = '".$idBanco."');";
        $sqlAuts = $conn->prepare($queryAuts);
        $sqlAuts->execute();
        if($sqlAuts->rowCount()>0){
            $aut = $sqlAuts->fetchALL(PDO::FETCH_ASSOC);
            foreach($aut as $at){}
            $autStatus = $at['id_status'];
        }
        else{
            $autStatus = 0;
        }
    }

    if($autStatus == 1 || $_GET['id'] == "teste"){
        try{
            $id = $_POST['id'];
            $tipo = $_POST['tipo'];
            $upper = implode('', range('A', 'Z'));
            $lower = implode('', range('a', 'z'));
            $nums = implode('', range(0, 9));
            $alphaNumeric = $upper.$lower.$nums;
            $string = '';
            $len = 10;
            for($i = 0; $i < $len; $i++) {
                $string .= $alphaNumeric[rand(0, strlen($alphaNumeric) - 1)];
            }
            $token = strval($string);

            $obUsuario = new Usuario();
            $obUsuario->setIddb($_GET['id']);
            echo $obUsuario->login($id, $token, $tipo);
        }
        catch(Exception $e){
            die("0");
        }
    }
    else{
        echo 'Cliente desativado para esse sietema!';
    }
?>