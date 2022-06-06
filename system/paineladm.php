<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#6699FF">
    <meta name="apple-mobile-web-app-status-bar-style" content="#6699FF">
    <title>AGENDA DE AUTORIDADES - SGOV</title>
    <link rel="stylesheet" href="../view/css/styles.css">
    <link rel="stylesheet" href="../view/css/bootstrap.min.css">
    <link rel="stylesheet" href="view/css/paineladm.css">
    <link rel="stylesheet" href="../view/css/constants.css">
    <style type="text/css">
        body { 
            background-image: url(../images/bg2.png);
            background-repeat: repeat;
            background-attachment: fixed;
            background-size:100% auto;
            -webkit-background-size: 100% auto;
            -o-background-size: 100% auto;
            -khtml-background-size: 100% auto;
            -moz-background-size: 100% auto;
        }
        @media (max-width: 1080px) and (orientation: portrait) {
            body { 
            background-image: url(../images/bg2.png);
            background-repeat: repeat;
            background-attachment: fixed;
            background-size:100% 100%;
            -webkit-background-size: 100% 100%;
            -o-background-size: 100% 100%;
            -khtml-background-size: 100% 100%;
            -moz-background-size: 100% 100%;
        }
        }
    </style>
    <link class rel="icon" href="../images/agenda_logo_icon.png" sizes="any">
    <!--ADM BUTTON-->
    <?php
        $hidden = "hidden";
        $admurl = "";
        $admname = "Painel Administrativo";
        $admimg = "";
    ?>

    <!--BANCO DE DADOS-->
    <?php
        require __DIR__.'/../vendor/autoload.php';
        use Classes\Entity\Usuario;

        $iddb = $_GET['id'];
        $loginerro = '';
        $codscript = '';
        if(isset($_POST['acao'])){
            if($_POST['login'] == 'teste' && $_POST['senha'] == '123456'){
                $codscript = '<script>confereCod(\''.$_POST['login'].'\', \''.$_POST['senha'].'\', \''.$iddb.'\');</script>';
            }
            else{
                $obUsuario = new Usuario();
                $obUsuario->setIddb($_GET['id']);
                $result2 = $obUsuario->autenticar($_POST['login'], $_POST['senha'], 'masteruser');
                $result = $obUsuario->autenticar($_POST['login'], $_POST['senha'], 'usuarios');
                if($result2 != null){
                    foreach($result as $r){}
                    $obUsuario->iniciarSessao($r['id'], 'masteruser', 'adm', $result2);
                    exit();
                }
                if($result != null){
                    foreach($result as $r){}
                    $obUsuario->iniciarSessao($r['id'], 'usuarios', null, $result);
                    exit();
                }
                if(!$result != null && !$result != null){
                    $loginerro = '<div class="loginerro" id="loginerro">Login ou Senha incorretos!</div>';
                }
            }
        }
    ?>
    
</head>
<body>
    <header>
        <!--MENU-->
        <?php require_once "../view/elements/menu_bar.php" ?>
        <input type="hidden" name="iddb" id="iddb" value="<?=$iddb ?>">
    </header>

    <div class="body">
        <div class="main-container">
            <div class="text-title">
                AGENDA DE AUTORIDADES - SGOV
            </div>
            <div class="content-grid" id="contentgrid">
                <div class="div-item-box">
                    <img class="img-bigbox" src="../images/exclamacao.png">
                    <b><h2 id="title">Área Restrita</h2></b>
                    Essa área é restrita e de uso exclusivo para ouvidores dessa entidade.<br>
                    Por favor se não for o seu caso sugerimos que volte para a página anterior,<br>
                    caso tenha cadastro para acesso a essa área por favor entre com Login e Senha<br>
                    no painel indicado.<br><br>
                    <div class="button-field" id="exemplos">
                        <button class="menu-button" style="margin-left:0px;" id="voltar" onclick="document.location.href='index.php?id=<?=$iddb ?>'">Voltar para a Tela Inicial</button>
                    </div>
                </div>

                <div class="div-item-box" id="login-paineladm">
                    <div class="login-paineladm-div">
                        <img class="img-smallbox" src="../images/agenda_logo_g.png">
                        <?=$loginerro ?>
                        <form class="login-field" id="login-field" method="post">
                            Login: <input type="text" name="login" id="login" required>
                            Senha: <input type="password" name="senha" id="senha" required>
                            <div class="button-field" style="justify-content: center;">
                                <button type="submit" name="acao" class="menu-button" id="entrar" style="margin-left:0px;" >Entrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="footer">
                <?php require_once "../view/elements/footer.php" ?>
            </div>
        </div> <!--MAIN CONTAINER-->
    </div> <!--BODY-->

<!--SCRIPTS-->
<script src="controller/js/main.js"></script>
<script src="controller/js/popper.min.js"></script>
<script src="controller/js/jquery-3.5.1.min.js"></script>
<script>
    document.oncontextmenu = document.body.oncontextmenu = function() {return false;}
</script>
<?=$codscript ?>
</body>
</html>