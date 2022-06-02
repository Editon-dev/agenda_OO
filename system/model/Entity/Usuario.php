<?php
    namespace Classes\Entity;
    require __DIR__.'/../../../vendor/autoload.php';
    use Classes\Db\Database;
    use PDO;

    class Usuario {
        private $nome;
        private $login;
        private $senha;
        private $token;
        private $codigo;

        public function __construct($nome = null, $login = null, $senha = null, $token = null, $codigo = null){
            $this->nome = $nome;
            $this->login = $login;
            $this->senha = $senha;
            $this->token = $token;
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

        public function getToken(){
            return $this->token;
        }

        public function setToken($token){
            $this->token = $token;
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
                'token' => $this->token,
                'codigo' => $this->codigo
            ]);
        }

        public function atualizar($id){
            $obDatabase = new Database('usuarios', $this->iddb);
            if($obDatabase->update([
                'nome' => $this->nome,
                'login' => $this->login,
                'senha' => $this->senha,
                'token' => $this->token,
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

        public function autenticar($login, $senha, $tipo) {
            $obDatabase = new Database($tipo, $this->iddb);
            $result = $obDatabase->select("id", "login = '".md5($login)."' AND senha = '".md5($senha)."'")->fetchALL(PDO::FETCH_ASSOC);
            return $result;
        }

        public function login($id, $token, $tipo) {
            $obDatabase = new Database($tipo, $this->iddb);
            if($obDatabase->update(['token' => md5($token)], 'id = \''.$id.'\'')){
                return $token;
            }
        }

        public function logout($id, $tipo) {
            $obDatabase = new Database($tipo, $this->iddb);
            if($obDatabase->update(['token' => 'NULL'], 'token = \''.md5($id).'\'')){
                return 'true';
            }
        }
    }

?>