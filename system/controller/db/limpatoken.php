<?php
    require __DIR__.'/../../../vendor/autoload.php';
    use Classes\Entity\Usuario;

    $obUsuario = new Usuario();
    $obUsuario->setIddb($_GET['id']);
    echo $obUsuario->logout($_POST['id'], $_POST['tipo']);

?>