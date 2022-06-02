<?php
     require __DIR__.'/../../../vendor/autoload.php';
     use Classes\Entity\Usuario;

        $login = $_POST['login'];
        $senha = $_POST['senha'];

        $obUsuario = new Usuario();
        $obUsuario->setIddb($_GET['id']);
        $resultadm = $obUsuario->autenticar($login, $senha, 'masteruser');
        if($resultadm != null){
            $adm = "adm";
        }

        if(!isset($adm)){
            $result = $obUsuario->autenticar($login, $senha, 'usuarios');
            if($result != null){
                foreach($result as $at){}
            }

            echo ($at['id']);
        }
        else{
            echo $adm;
        }
?>