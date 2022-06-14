<?php
    require '../../../vendor/autoload.php';
    use Classes\Db\Database;

    if($_SERVER['REQUEST_METHOD'] == 'POST') { 
        $obExcluir = new Excluir($_POST['tabela'], $_POST['valor'], $_GET['id'], $_POST['key']);
        $obExcluir->excluir();
    }

    class Excluir {
        private $tabela;
        private $valor;
        private $iddb;
        private $key;

        function __construct($tabela, $valor, $iddb, $key){
            $this->tabela = $tabela;
            $this->valor = $valor;
            $this->iddb = $iddb;
            $this->key = $key;
        }

        public function excluir() {
            $objDatabase = new Database($this->tabela, $this->iddb);
            $objDatabase->delete($this->valor, $this->key);
        }
    }
?>