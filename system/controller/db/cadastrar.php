<?php
    require '../../../vendor/autoload.php';
    use Classes\Entity\Compromisso;
    use Classes\Entity\Compromissonormal;
    use Classes\Entity\Usuario;

    if($_SERVER['REQUEST_METHOD'] == 'POST') { 
        $cadastrar= new Cadastrar($_POST, $_GET['tp']);
        $cadastrar->insere();
    }

    class Cadastrar {
        private $dados;
        private $tipo;

        function __construct($dados, $tipo) {
            $this->dados = $dados;
            $this->tipo = $tipo;
        }

        public function insere() {
            $pass = 'ok';
            foreach($this->dados as $key=>$value){
                if($value == ''){
                    $pass = 'none';
                }
            }
            if($pass != 'none'){
                //COMPROMISSO DIA INTEIRO
                if($this->tipo == 'diainteiro'){
                    if($pass != 'none'){
                        $obCompromissoDia = new Compromisso();
                        $obCompromissoDia->setIddb($_GET['id']);
                        if($obCompromissoDia->buscar("id", "data = '".$this->dados['data']." 00:00:00' OR '".$this->dados['data']."' BETWEEN datainicio AND datafim") == null){
                            $obCompromisso = new Compromisso(
                                $this->dados['idautoridade'],
                                $this->dados['autoridade'],
                                $this->dados['local'],
                                $this->dados['data'],
                                nl2br($this->dados['detalhe']),
                                'Sim'
                            );
                            $obCompromisso->setIddb($_GET['id']);
                            echo $obCompromisso->cadastrar();
                        }
                        else{
                            echo 'Já existem compromissos para esse dia!';
                        }
                    }
                }

                //COMPROMISSO NORMAL
                if($this->tipo == 'compromissonormal'){
                    if($pass != 'none'){
                        if((strtotime($this->dados['datafim']) >= strtotime($this->dados['datainicio'])) && (strtotime($this->dados['horafim']) > strtotime($this->dados['horainicio']))){
                            $obCompromissoDia = new Compromisso();
                            $obCompromissoDia->setIddb($_GET['id']);
                            if($obCompromissoDia->buscar("id", "data = '".$this->dados['datainicio']." 00:00:00' AND data IS NOT NULL") == null){
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
                }

                //USUARIO
                if($this->tipo == 'usuario'){
                    if($pass != 'none'){
                        $obUsuario = new Usuario(
                            $this->dados['nome'],
                            md5($this->dados['login']),
                            md5($this->dados['senha']),
                            md5($this->dados['codigousuarioinput'])
                        );
                        $obUsuario->setIddb($_GET['id']);
                        echo $obUsuario->cadastrar();
                    }
                }
            }
            else{
                echo 'Por favor preencha todos os campos!';
            }
        }
    }
?>