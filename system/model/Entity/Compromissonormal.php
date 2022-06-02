<?php
    namespace Classes\Entity;
    require __DIR__.'/../../../vendor/autoload.php';
    use Classes\Db\Database;
    use Classes\Entity\Compromisso;
    use PDO;

    class Compromissonormal extends Compromisso {
        private $datainicio;
        private $horainicio;
        private $datafim;
        private $horafim;
        private $participante;

        public function __construct($idautoridade, $autoridade, $local, $data, $detalhe, $diainteiro, $datainicio, $horainicio, $datafim, $horafim, $participante){
            parent::__construct($idautoridade, $autoridade, $local, $data, $detalhe, $diainteiro);
            $this->datainicio = $datainicio;
            $this->horainicio = $horainicio;
            $this->datafim = $datafim;
            $this->horafim = $horafim;
            $this->participante = $participante;
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

        public function getParticipante(){
            return $this->participante;
        }

        public function setParticipante($participante){
            $this->participante = $participante;
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
                'diainteiro' => $this->diainteiro,
                'datainicio' => $this->datainicio,
                'horainicio' => $this->horainicio,
                'datafim' => $this->datafim,
                'horafim' => $this->horafim,
                'participante' => $this->participante
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
                'datainicio' => $this->datainicio,
                'horainicio' => $this->horainicio,
                'datafim' => $this->datafim,
                'horafim' => $this->horafim,
                'participante' => $this->participante,
                'diainteiro' => $this->diainteiro
            ],'id = '.$id)){
                return true;
            }
        }
    }

?>