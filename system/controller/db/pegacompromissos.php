<?php
    require '../../../vendor/autoload.php';
    use Classes\Entity\Compromisso;
    
    $autoridade = $_POST['autoridade'];
    $datacompromisso = $_POST['datacompromisso'];

    $obCompromisso = new Compromisso();
    $obCompromisso->setIddb($_GET['id']);
    $result = $obCompromisso->buscar("*,
    DATE_FORMAT(data, '%d/%m/%Y') as datacompromisso,
    DATE_FORMAT(datainicio, '%d/%m/%Y') as datainiciocompromisso,
    DATE_FORMAT(datafim, '%d/%m/%Y') as datafimcompromisso,
    DATE_FORMAT(horafim, '%H:%i') as horafimcomp,
    DATE_FORMAT(horainicio, '%H:%i') as horainiciocomp",
    "idautoridade = ".$autoridade." AND (data LIKE '%".$datacompromisso."%' OR datainicio = '".$datacompromisso."')",
    "datacompromisso DESC, datainiciocompromisso DESC");
    if($result != null){
        foreach($result as $com2){}
    }

    if(isset($com2)){
        $count = 1;
        $datatitle = "";
        if($com2['datacompromisso'] != NULL){
            $datatitle = $com2['datacompromisso'];
        }
        if($com2['datainiciocompromisso'] != NULL){
            $datatitle = $com2['datainiciocompromisso'];
        }
        echo '<b><h2 id="titulo-detalhe">DETALHES DOS COMPROMISSOS! - '.$datatitle.'</h2></b><hr><br><br>';
        foreach($result as $com){
            if($com['data'] != NULL){
                $detalhecompropmisso = str_replace('<br />', '', $com['detalhe']);
                echo '<h3>Compromisso '.$count.'</h3><hr>';
                echo '<h2>'.strtoupper($com['autoridade']).'</h2>';
                echo '<br>';
                echo '<h3>'.$com['local'].'</h3>';
                echo '<br>';
                echo 'Data do compromisso: '.$com['datacompromisso'].'';
                echo '<br>';
                echo 'Compromisso de dia inteiro';
                echo '<br><br><hr>';
                echo '<h3>'.$detalhecompropmisso.'</h3>';
                echo '<br><br><br><hr><hr><br><br>';
                $count ++;
            }
            else{
                $detalhecompropmisso = str_replace('<br />', '', $com['detalhe']);
                $participantecompromisso = str_replace('<br />', '', $com['participante']);
                $participante = "";
                if($com['participante'] != NULL){
                    $participante = "<br>Outros participantes:<br>";
                }
                echo '<h3>Compromisso '.$count.'</h3><hr>';
                echo '<h2>'.strtoupper($com['autoridade']).'</h2>';
                echo '<br>';
                echo '<h3>'.$com['local'].'</h3>';
                echo '<br>';
                echo 'Início do compromisso: '.$com['datainiciocompromisso'].' ás '.$com['horainiciocomp'].'h';
                echo '<br>';
                echo 'Final do compromisso: '.$com['datafimcompromisso'].' ás '.$com['horafimcomp'].'h';
                echo $participante;
                echo  $participantecompromisso.'<br>';
                echo '<br><br><hr>';
                echo '<h3>'.$detalhecompropmisso.'</h3>';
                echo '<br><br><br><hr><hr><br><br>';
                $count ++;
            }
        }
    }
    else{
        echo 'Não existem compromissos para o dia escolhido. Por favor confira a lista de compromissos no texo abaixo do nome da autoridade.';
    }
?>