<?php
    namespace Classes\Entity;
    require __DIR__.'/../../../vendor/autoload.php';
    use Classes\Db\Database;
    use PDO;

    class Compromisso {
        protected $idautoridade;
        protected $autoridade;
        protected $local;
        protected $data;
        protected $detalhe;
        protected $diainteiro;
        protected $iddb;

        public function __construct($idautoridade = null, $autoridade = null, $local = null, $data = null, $detalhe = null, $diainteiro = null){
            $this->idautoridade = $idautoridade;
            $this->autoridade = $autoridade;
            $this->local = $local;
            $this->data = $data;
            $this->detalhe = $detalhe;
            $this->diainteiro = $diainteiro;
        }

        public function getIdautoridade(){
            return $this->idautoridade;
        }

        public function setIdautoridade($idautoridade){
            $this->idautoridade = $idautoridade;
            return $this;
        }

        public function getAutoridade(){
            return $this->autoridade;
        }

        public function setAutoridade($autoridade){
            $this->autoridade = $autoridade;
            return $this;
        }

        public function getLocal(){
            return $this->local;
        }

        public function setLocal($local){
            $this->local = $local;
            return $this;
        }

        public function getData(){
            return $this->data;
        }

        public function setData($data){
            $this->data = $data;
            return $this;
        }

        public function getParticipante(){
            return $this->participante;
        }

        public function setParticipante($participante){
            $this->participante = $participante;
            return $this;
        }

        public function getDetalhe(){
            return $this->detalhe;
        }

        public function setDetalhe($detalhe){
            $this->detalhe = $detalhe;
            return $this;
        }

        public function getDiainteiro(){
            return $this->diainteiro;
        }

        public function setDiainteiro($diainteiro){
            $this->diainteiro = $diainteiro;
            return $this;
        }

        public function getDatainicio(){
            return $this->datainicio;
        }

        public function setDatainicio($datainicio){
            $this->datainicio = $datainicio;
            return $this;
        }

        public function getHorainicio(){
            return $this->horainicio;
        }

        public function setHorainicio($horainicio){
            $this->horainicio = $horainicio;
            return $this;
        }

        public function getDatafim(){
            return $this->datafim;
        }

        public function setDatafim($datafim){
            $this->datafim = $datafim;
            return $this;
        }

        public function getHorafim(){
            return $this->horafim;
        }

        public function setHorafim($horafim){
            $this->horafim = $horafim;
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
            $obDatabase = new Database('compromissos2', $this->iddb);
            return $obDatabase->insert([
                'idautoridade' => $this->idautoridade,
                'autoridade' => $this->autoridade,
                'local' => $this->local,
                'data' => $this->data,
                'detalhe' => $this->detalhe,
                'diainteiro' => $this->diainteiro
            ]);
        }

        public function atualizar($id){
            $obDatabase = new Database('compromissos2', $this->iddb);
            if($obDatabase->update([
                'idautoridade' => $this->idautoridade,
                'autoridade' => $this->autoridade,
                'local' => $this->local,
                'data' => $this->data,
                'detalhe' => $this->detalhe,
                'diainteiro' => $this->diainteiro
            ],'id = '.$id)){
                return true;
            }
        }

        public function buscar($keys = null, $where = null, $order = null, $limit = null, $distinct = null) {
            $obDatabase = new Database('compromissos2', $this->iddb);
            $result = $obDatabase->select($keys, $where, $order, $limit, $distinct)->fetchALL(PDO::FETCH_ASSOC)/* ->fetchALL(PDO::FETCH_CLASS, self::class) */;
            return $result;
        }
    }

?>