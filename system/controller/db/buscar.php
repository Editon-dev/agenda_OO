<?php
    require '../../../vendor/autoload.php';
    use Classes\Entity\Compromisso;

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $obBuscar = new Buscar($_POST['keys'], $_POST['where'], $_POST['order'], $_POST['limit']);
        return $obBuscar->busca();
    }

    class Buscar {
        private $keys;
        private $where;
        private $order;
        private $limit;

        function __construct($keys = null, $where = null, $order = null, $limit = null){
            $this->keys = $keys;
            $this->where = $where;
            $this->order = $order;
            $this->limit = $limit;
        }

        function busca() {
            $obCompromisso = new Compromisso();
            $obCompromisso->setIddb($_GET['id']);
            $result = $obCompromisso->buscar($this->keys, $this->where, $this->order, $this->limit);

            return $result;
        }
    }
?>