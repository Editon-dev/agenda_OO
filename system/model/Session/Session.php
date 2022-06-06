<?php
    namespace Classes\Session;

    require __DIR__.'/../../../vendor/autoload.php';
    use Classes\Db\Database;
    use PDO;

    class Session {
        static function init() {
            if(session_status() !== PHP_SESSION_ACTIVE)
                session_start();
        }

        static function login($id, $tipo = null, $dados) {
            self::init();
            foreach($dados as $d){}
            $_SESSION['usuario'] = ['id' => $d['id'], 'nome' => $d['nome']];
            if($tipo == 'adm')
                header('Location: dashboardadm.php?id='.$id);
            else
                header('Location: dashboard.php?id='.$id);
            exit();
        }

        static function isLogged() {
            self::init();
            if(isset($_SESSION['usuario']['id']))
                return true;
            else
                header('Location: ../index.php');
            exit();
        }

        static function requiredLogin() {
            self::init();
            if(self::isLogged())
                return $_SESSION['usuario'];
            exit();
        }

        static function logout($id) {
            self::init();
            if(self::requiredLogin() != null){
                unset($_SESSION['usuario']);
                header('Location: ../../paineladm.php?id='.$id);
                exit();
            }
        }
    }

?>