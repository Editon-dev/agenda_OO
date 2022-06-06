<?php
    require '../../../vendor/autoload.php';
    use Classes\Entity\Compromisso;
    use Classes\Entity\Compromissonormal;
    use Classes\Entity\Usuario;

    /* $valor = null;
    foreach ($_POST as $key=>$value) {
        $valor .= '\''.$value.'\',';
    }
    $valor = trim($valor, ","); */
    
    $pass = 'ok';
    //COMPROMISSO DIA INTEIRO
    if($_GET['tp'] == 'diainteiro'){
        foreach($_POST as $key=>$value){
            if($value == ''){
                $pass = 'none';
            }
        }
        if($pass != 'none'){
            $obCompromisso = new Compromisso(
                $_POST['idautoridade'],
                $_POST['autoridade'],
                $_POST['local'],
                $_POST['data'],
                nl2br($_POST['detalhe']),
                'Sim'
            );
            $obCompromisso->setIddb($_GET['id']);
            if($obCompromisso->atualizar($_POST['id'])){
                echo "true";
            }
        }
        else{
            echo 'Por favor preencha todos os campos!';
        }
    }

    //COMPROMISSO NORMAL
    if($_GET['tp'] == 'compromissonormal'){
        foreach($_POST as $key=>$value){
            if($value == ''){
                $pass = 'none';
            }
        }
        if($pass != 'none'){
            $obCompromisso = new Compromissonormal(
                $_POST['idautoridade'],
                $_POST['autoridade'],
                $_POST['local'],
                NULL,
                nl2br($_POST['detalhe']),
                'Não',
                $_POST['datainicio'],
                $_POST['horainicio'],
                $_POST['datafim'],
                $_POST['horafim'],
                nl2br($_POST['participante'])
            );
            $obCompromisso->setIddb($_GET['id']);
            if($obCompromisso->atualizar($_POST['id'])){
                echo "true";
            }
        }
        else{
            echo 'Por favor preencha todos os campos!';
        }
    }

    //USUARIO
    if($_GET['tp'] == 'usuario'){
        if($_POST['codigousuarioinput'] != ""){
            foreach($_POST as $key=>$value){
                if($value == ''){
                    $pass = 'none';
                }
            }
            if($pass != 'none'){
                $obUsuario = new Usuario(
                    $_POST['nome'],
                    md5($_POST['login']),
                    md5($_POST['senha']),
                    md5($_POST['codigousuarioinput'])
                );
                $obUsuario->setIddb($_GET['id']);
                if($obUsuario->atualizar($_POST['id'])){
                    echo "true";
                }
            }
            else{
                echo 'Por favor preencha todos os campos!';
            }
        }
        else{
            echo 'Por favor gere o código do primeiro acesso e envie para o mesmo antes de resetar!';
        }
    }

    //RESET
    if($_GET['tp'] == 'reset'){
        if($_POST['codigousuarioinput'] != ""){
            foreach($_POST as $key=>$value){
                if($value == ''){
                    $pass = 'none';
                }
            }
            if($pass != 'none'){
                $obUsuario = new Usuario(
                    $_POST['nome'],
                    md5('teste'),
                    md5('123456'),
                    md5($_POST['codigousuarioinput'])
                );
                $obUsuario->setIddb($_GET['id']);
                if($obUsuario->atualizar($_POST['id'])){
                    echo "true";
                }
            }
            else{
                echo 'Por favor preencha todos os campos!';
            }
        }
        else{
            echo 'Por favor gere o código do primeiro acesso e envie para o mesmo antes de resetar!';
        }
    }
?>