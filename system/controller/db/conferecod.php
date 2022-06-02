<?php
     require __DIR__.'/../../../vendor/autoload.php';
     use Classes\Entity\Usuario;
 
     $login = md5($_POST['login']);
     $senha = md5($_POST['senha']);
     $cod = md5($_POST['cod']);

     $obUsuario = new Usuario();
     $obUsuario->setIddb($_GET['id']);
     $confere = $obUsuario->buscar("id", "codigo = '".$cod."'");

     if($confere != null){
        $usuario = $obUsuario->buscar("id", "login = '".$login."' and senha = '".$senha."' and codigo = '".$cod."'");
        if($usuario != null){
            foreach($usuario as $at){}
        }

        echo $at['id'];
    }
    else{
        echo 'O código não confere!';
    }
?>