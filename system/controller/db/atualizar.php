<?php
    require '../../../vendor/autoload.php';
    use Classes\Entity\Compromisso;
    use Classes\Entity\Compromissonormal;
    use Classes\Entity\Usuario;

    if($_SERVER['REQUEST_METHOD'] == 'POST') { 
        $obAtualizar= new Atualizar($_POST);
        $obAtualizar->altera();
    }

    class Atualizar {
        private $dados;

        function __construct($dados) {
            $this->dados = $dados;
        }

        public function altera() {
            $pass = 'ok';
            foreach($_POST as $key=>$value){
                if($value == ''){
                    $pass = 'none';
                }
            }
            if($pass != 'none'){
                //COMPROMISSO DIA INTEIRO
                if($_GET['tp'] == 'diainteiro'){
                    $obCompromisso = new Compromisso(
                        $this->dados['idautoridade'],
                        $this->dados['autoridade'],
                        $this->dados['local'],
                        $this->dados['data'],
                        nl2br($this->dados['detalhe']),
                        'Sim'
                    );
                    $obCompromisso->setIddb($_GET['id']);
                    if($obCompromisso->atualizar($this->dados['id'])){
                        echo "true";
                    }
                }

                //COMPROMISSO NORMAL
                if($_GET['tp'] == 'compromissonormal'){
                    $obCompromisso = new Compromissonormal(
                        $this->dados['idautoridade'],
                        $this->dados['autoridade'],
                        $this->dados['local'],
                        NULL,
                        nl2br($this->dados['detalhe']),
                        'Não',
                        $this->dados['datainicio'],
                        $this->dados['horainicio'],
                        $this->dados['datafim'],
                        $this->dados['horafim'],
                        nl2br($this->dados['participante'])
                    );
                    $obCompromisso->setIddb($_GET['id']);
                    if($obCompromisso->atualizar($this->dados['id'])){
                        echo "true";
                    }
                }

                //USUARIO
                if($_GET['tp'] == 'usuario'){
                    if($this->dados['codigousuarioinput'] != ""){
                        $obUsuario = new Usuario(
                            $this->dados['nome'],
                            md5($this->dados['login']),
                            md5($this->dados['senha']),
                            md5($this->dados['codigousuarioinput'])
                        );
                        $obUsuario->setIddb($_GET['id']);
                        if($obUsuario->atualizar($this->dados['id'])){
                            echo "true";
                        }
                    }
                    else{
                        echo 'Por favor gere o código do primeiro acesso e envie para o mesmo antes de resetar!';
                    }
                }

                //RESET
                if($_GET['tp'] == 'reset'){
                    if($this->dados['codigousuarioinput'] != ""){
                        $obUsuario = new Usuario(
                            $this->dados['nome'],
                            md5('teste'),
                            md5('123456'),
                            md5($this->dados['codigousuarioinput'])
                        );
                        $obUsuario->setIddb($_GET['id']);
                        if($obUsuario->atualizar($this->dados['id'])){
                            echo "true";
                        }
                    }
                    else{
                        echo 'Por favor gere o código do primeiro acesso e envie para o mesmo antes de resetar!';
                    }
                }
            }
            else{
                echo 'Por favor preencha todos os campos!';
            }
        }
    }
?>