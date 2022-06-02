<?php
    require '../../../vendor/autoload.php';
    use Classes\Entity\Compromisso;

    $autoridade = $_POST['autoridade'];
    $datacompromisso = $_POST['datacompromisso'];

    $obCompromisso = new Compromisso();
    $obCompromisso->setIddb($_GET['id']);
    $result = $obCompromisso->buscar("id, local", "idautoridade = ".$autoridade." AND (data LIKE '%".$datacompromisso."%' OR datainicio = '".$datacompromisso."')", 'id DESC');
    
    if($result != null){
        echo '<option value="">Selecione o compromisso</option>';
        foreach($result as $com){
            echo '<option value="'.$com['id'].'">'.$com['local'].'</option>';
        }
    }
?>