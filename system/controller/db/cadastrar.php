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
            $obCompromissoDia = new Compromisso();
            $obCompromissoDia->setIddb($_GET['id']);
            if($obCompromissoDia->buscar("id", "data = '".$_POST['data']." 00:00:00' OR '".$_POST['data']."' BETWEEN datainicio AND datafim") == null){
                $obCompromisso = new Compromisso(
                    $_POST['idautoridade'],
                    $_POST['autoridade'],
                    $_POST['local'],
                    $_POST['data'],
                    nl2br($_POST['detalhe']),
                    'Sim'
                );
                $obCompromisso->setIddb($_GET['id']);
                echo $obCompromisso->cadastrar();
            }
            else{
                echo 'Já existem compromissos para esse dia!';
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
            if((strtotime($_POST['datafim']) >= strtotime($_POST['datainicio'])) && (strtotime($_POST['horafim']) > strtotime($_POST['horainicio']))){
                $obCompromissoDia = new Compromisso();
                $obCompromissoDia->setIddb($_GET['id']);
                if($obCompromissoDia->buscar("id", "data = '".$_POST['datainicio']." 00:00:00' AND data IS NOT NULL") == null){
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
                    echo $obCompromisso->cadastrar();
                }
                else{
                    echo 'Já existe um compromisso de dia inteiro para esse dia!';
                }
            }
            else{
                echo 'A data do fim do compromisso não deve ser menor que a data do início e o horário de início não deve ser menor nem igual ao horário de fim!';
            }
        }
        else{
            echo 'Por favor preencha todos os campos!';
        }
    }

    //USUARIO
    if($_GET['tp'] == 'usuario'){
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
            echo $obUsuario->cadastrar();
        }
        else{
            echo 'Por favor preencha todos os campos!';
        }
    }
?>