<?php
    namespace Classes\Db;
    require __DIR__.'/../../../vendor/autoload.php';
    use PDO;
    use PDOxception;

    class Database {
        public function __construct($table = null, $iddb){
            $this->table = $table;
            $this->iddb = $iddb;
            $this->setConnetcion($this->iddb);
        }

        public function setConnetcion($iddb){
            try{
                $username = 'root';
                $pwd = '';
                $host = 'localhost';
                $db = 'agenda_'.$iddb;

                /*$username = 'admin';
                $pwd = '3t3rn001';
                $host = 'stg-db.c4xhxsxl9nsa.us-east-2.rds.amazonaws.com';
                $db = 'ouvidoria_ipmbrasilpm';*/

                $this->conn = new PDO('mysql:host='.$host.';dbname='.$db,$username, $pwd);
                $this->conn->exec('SET CHARACTER SET utf8');
            }
            catch(PDOException $e){
                echo 'Error:'. $e->getMessage();
            }
        }

        private function execute($query, $params = null) {
            try{
                $stm = $this->conn->prepare($query);
                $stm->execute($params);
                return $stm;
            }
            catch(PDOException $e){
                die($e->getMessage());
            }
        }

        public function autenticaDB($token) {
            try{
                $queryAuts = "select c.nome as nomeu, c.token, c.id from ".$this->table." c WHERE c.token = '".md5($token)."'";
                $result = $this->execute($queryAuts);
                return $result;
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        public function autenticaSGOV($dominio, $produto) {
            try{
                $queryAuts = "select id_status from `".$this->table."`.`status_produto` WHERE id_cliente = (SELECT id_cliente FROM `".$this->table."`.`clientes` WHERE id_".$produto."_cliente = '".$dominio."');";
                $result = $this->execute($queryAuts);
                return $result;
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        public function insert($arrayvalues) {
            try{
                $keys = array_keys($arrayvalues);
                $values = array_pad([], count($keys), '?');

                $query = "INSERT INTO ".$this->table." (".implode(',',$keys).") VALUES (".implode(',',$values).");";
                $this->execute($query, array_values($arrayvalues));
                
                return $this->conn->lastInsertId();
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        public function update($arrayvalues, $where) {
            try{
                $keys = array_keys($arrayvalues);

                $query = "UPDATE ".$this->table." SET ".implode('=?,', $keys)."=? WHERE ".$where.";";
                $this->execute($query, array_values($arrayvalues));
                
                return TRUE;
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        public function delete($id, $key = null) {
            try{
                $query = "DELETE FROM ".$this->table." WHERE id".$key." = ".$id.";";
                $this->execute($query);
                
                echo 1;
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        public function select($keys = null, $where = null, $order = null, $limit = null, $distinct = null) {
            $keys = strlen($keys) ? $keys : '*';
            $where = strlen($where) ? 'WHERE '.$where : '';
            $order = strlen($order) ? 'ORDER BY '.$order : '';
            $limit = strlen($limit) ? 'LIMIT '.$limit : '';
            $distinct = strlen($distinct) ? 'DISTINCT ' : '';

            try{
                $query = "SELECT ".$distinct.$keys." FROM ".$this->table." ".$where." ".$order."  ".$limit.";";
                $result = $this->execute($query);
                
                return $result;
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }
    }
?>