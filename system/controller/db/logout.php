<?php
    require __DIR__.'/../../../vendor/autoload.php';

    use Classes\Session\Session;

    Session::logout($_GET['id']);
?>