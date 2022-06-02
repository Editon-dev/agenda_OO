<?php
    require '../../../vendor/autoload.php';
    use Classes\Db\Database;

    $objDatabase = new Database($_POST['tabela'], $_GET['id']);
    $objDatabase->delete($_POST['valor'], $_POST['key']);
?>