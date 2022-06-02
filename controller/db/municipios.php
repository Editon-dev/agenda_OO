<?php
    require_once ('../../dao/connection.php');

    $municipios = $conn->prepare("select * from municipio where Uf='".$_POST['id']."'");
    $municipios->execute();

    $fetchAll = $municipios->fetchAll();

    foreach ($fetchAll as $municipio){
        echo '<option value="'.$municipio['Nome'].'">'.$municipio['Nome'].'</option>';
    }
?>