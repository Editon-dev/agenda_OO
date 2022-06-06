<?php
    require __DIR__.'/../../../vendor/autoload.php';
    use Classes\Entity\Usuario;

    $nome = $_POST['nome'];
    $login = md5($_POST['login']);
    $senha = md5($_POST['senha']);
    $id = $_POST['id'];

    try{
        $obUsuario = new Usuario($nome, $login, $senha, null);
        $obUsuario->setIddb($_GET['id']);
        if($obUsuario->atualizar($id)){
            echo 1;
        }
    }
    catch(Exception $e){
        //echo 'Erro ao criar cliente.';
        echo 'Erro: '.$e->getMessage();
    }

?>