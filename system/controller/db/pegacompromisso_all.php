<?php
    require __DIR__.'/../../../vendor/autoload.php';
    use Classes\Entity\Compromisso;

    $idautoridade = $_POST['id'];
    $obCompromisso = new Compromisso();
    $obCompromisso->setIddb($_GET['id']);
    $result = $obCompromisso->buscar("*,
    DATE_FORMAT(data, '%Y-%m-%d') as datacompromisso,
    DATE_FORMAT(data, '%d-%m-%Y') as datacompromisso2,
    DATE_FORMAT(datainicio, '%d-%m-%Y') as datainiciocompromisso", "idautoridade = ".$idautoridade."", "datainicio ASC, data ASC");

    if($result != null){
        echo '<div class="data-result">';
        $count = 0;
        foreach($result as $comp2){
            if($comp2['data'] != NULL){
                $data = $comp2['datacompromisso2'];
                echo '<div class="data-result-content" onclick="pegaCompromissos2(\''.$comp2['datacompromisso'].'\', \''.$idautoridade.'\')">|'.$data.'|</div>';
            }
            else{
                $data = $comp2['datainiciocompromisso'];
                echo '<div class="data-result-content" onclick="pegaCompromissos2(\''.$comp2['datainicio'].'\', \''.$idautoridade.'\')">|'.$data.'|</div>';
            }
            
            $count ++;
            if($count == 4){
                echo '</div>';
                echo '<div class="data-result">';
                $count = 0;
            }
        }
        echo '</div>';
        echo '<div class="button-field" style="justify-content: center;"><button class="menu-button" onclick="document.location.reload(true)">Voltar</button></div>';
    }
    else{
        echo 'Nenhum dado encontrado!';
        echo '<div class="button-field" style="justify-content: center;"><button class="menu-button" onclick="document.location.reload(true)">Voltar</button></div>';
    }
    
?>