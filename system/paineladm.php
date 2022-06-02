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
        use Classes\Entity\Compromisso;
        use Classes\Db\Database;

        $iddb = $_GET['id'];

        /*AUTENTICAÇÃO*/
        if($iddb != "teste"){
            $obDatabase = new Database('sgov', $iddb);
            $atResult = $obDatabase->autenticaSGOV($iddb, 'agenda')->fetchALL(PDO::FETCH_ASSOC);
            if(!$atResult != null && !$atResult != ""){
                header('Location: ../index.php');
            }
            else{
                foreach($atResult as $at){}
                if($at['id_status'] != "1"){
                    header('Location: ../index.php');
                }
            }
        }
    ?>
    
</head>
<body>
    <header>
        <!--MENU-->
        <?php require_once "../view/elements/menu_bar.php" ?>
        <input type="hidden" name="iddb" id="iddb" value="<?php echo $iddb ?>">
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
                        <button class="menu-button" style="margin-left:0px;" id="voltar" onclick="document.location.href='index.php?id=<?php echo $iddb ?>'">Voltar para a Tela Inicial</button>
                    </div>
                </div>

                <div class="div-item-box" id="login-paineladm">
                    <div class="login-paineladm-div">
                        <img class="img-smallbox" src="../images/agenda_logo_g.png">
                        <div class="login-field" id="login-field">
                            Login: <input type="text" name="login" id="login">
                            Senha: <input type="password" name="senha" id="senha">
                            <div class="button-field" style="justify-content: center;">
                                <button class="menu-button" id="entrar" style="margin-left:0px;" onclick="autenticador()">Entrar</button>
                            </div>
                        </div>
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
    const inputEle = document.getElementById('login-field');
    inputEle.addEventListener('keyup', function(e){
    var key = e.which || e.keyCode;
    if (key == 13) {
        autenticador();
    }
    });
</script>
<script>
    document.oncontextmenu = document.body.oncontextmenu = function() {return false;}
</script>
</body>
</html>