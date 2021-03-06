<?php
    namespace Classes\Entity;
    require __DIR__.'/../../../vendor/autoload.php';
    use Classes\Db\Database;
    use Classes\Session\Session;
    use PDO;

    class Usuario {
        private $nome;
        private $login;
        private $senha;
        private $codigo;

        public function __construct($nome = null, $login = null, $senha = null, $codigo = null){
            $this->nome = $nome;
            $this->login = $login;
            $this->senha = $senha;
            $this->codigo = $codigo;
        }

        public function getNome(){
            return $this->nome;
        }

        public function setNome($nome){
            $this->nome = $nome;
            return $this;
        }

        public function getLogin(){
            return $this->login;
        }

        public function setLogin($login){
            $this->login = $login;
            return $this;
        }

        public function getSenha(){
            return $this->senha;
        }

        public function setSenha($senha){
            $this->senha = $senha;
            return $this;
        }

        public function getCodigo(){
            return $this->codigo;
        }

        public function setCodigo($codigo){
            $this->codigo = $codigo;
            return $this;
        }

        public function getIddb(){
            return $this->iddb;
        }

        public function setIddb($iddb){
            $this->iddb = $iddb;
            return $this;
        }

        public function cadastrar(){
            $obDatabase = new Database('usuarios', $this->iddb);
            return $obDatabase->insert([
                'nome' => $this->nome,
                'login' => $this->login,
                'senha' => $this->senha,
                'codigo' => $this->codigo
            ]);
        }

        public function atualizar($id){
            $obDatabase = new Database('usuarios', $this->iddb);
            if($obDatabase->update([
                'nome' => $this->nome,
                'login' => $this->login,
                'senha' => $this->senha,
                'codigo' => $this->codigo
            ],'id = '.$id)){
                return true;
            }
        }

        public function buscar($keys = null, $where = null, $order = null, $limit = null, $distinct = null) {
            $obDatabase = new Database('usuarios', $this->iddb);
            $result = $obDatabase->select($keys, $where, $order, $limit, $distinct)->fetchALL(PDO::FETCH_ASSOC)/* ->fetchALL(PDO::FETCH_CLASS, self::class) */;
            return $result;
        }

        public function autenticar($login, $senha, $table) {
            $obDatabase = new Database($table, $this->iddb);
            $result = $obDatabase->select("id, nome", "login = '".md5($login)."' AND senha = '".md5($senha)."'")->fetchALL(PDO::FETCH_ASSOC);
            return $result;
        }

        public function iniciarSessao($id, $table, $tipo = null, $dados) {
            Session::login($this->iddb, $tipo, $dados);
        }
    }

?>