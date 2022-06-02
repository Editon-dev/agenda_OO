<?php
    require '../../../vendor/autoload.php';
    use Classes\Entity\Compromisso;

    $keys = $_POST['keys'];
    $where = $_POST['where'];
    $order = $_POST['order'];
    $limit = $_POST['limit'];

    $obCompromisso = new Compromisso();
    $obCompromisso->setIddb($_GET['id']);
    $result = $obCompromisso->buscar($keys, $where, $order, $limit);

    return $result;
?>