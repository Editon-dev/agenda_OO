<?php
    require __DIR__.'/../../../vendor/autoload.php';
    use Classes\Entity\Compromisso;
    
    $idautoridade = $_POST['id'];

    $obCompromisso = new Compromisso();
    $obCompromisso->setIddb($_GET['id']);
    $resultcount = $obCompromisso->buscar('count(id) as count', 'idautoridade = '.$idautoridade.' AND (data > NOW() OR datainicio > NOW())');
    if($resultcount != null){
        foreach($resultcount as $countcompromissos){}
    }

    $result = $obCompromisso->buscar("DATE_FORMAT(data, '%d/%m') as datacompromisso, DATE_FORMAT(datainicio, '%d/%m') as datainiciocompromisso, data, datainicio", "idautoridade = ".$idautoridade." AND (data > NOW() OR datainicio > NOW())", "datainicio ASC, data ASC", "5", "DISTINCT");
    
    if(isset($result) && isset($resultcount)){
        echo 'Para esta autoridade foi encontrado um total de '.$countcompromissos['count'].' compromisso(s) futuros e o(s) próximo(s) compromisso(s) será(ão) no(s) dia(s) ';
        $virgula = ", ";
        $count = 1;
        foreach($result as $proxc){
            if($count == ($countcompromissos['count'] - 1)){
                $virgula = " e ";
            }
            if($count == $countcompromissos['count']){
                $virgula = ". ";
            }
            $proximoc = "";
            if($proxc['datacompromisso'] != "" || $proxc['datacompromisso'] != NULL){
                $proximoc = $proxc['datacompromisso'];
            }
            if($proxc['datainiciocompromisso'] != "" || $proxc['datainiciocompromisso'] != NULL){
                $proximoc = $proxc['datainiciocompromisso'];
            }
            echo $proximoc.$virgula;
            $count ++;
        }
        echo 'Para ver detalhes, por favor selecione o dia no calendário ao lado.<br><br>';
    }
    else{
        echo 'Ainda não temos compromissos futuros para a autoridade escolhida.<br><br>';
    }
?>