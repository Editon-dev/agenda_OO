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
    <link rel="stylesheet" href="view/css/dashboard.css">
    <link rel="stylesheet" href="view/css/dashboardadm.css">
    <link rel="stylesheet" href="../view/css/bootstrap.min.css">
    <link rel="stylesheet" href="../view/css/select2.min.css">
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
        $hidden = "";
        $admurl = "controller/db/logout.php?id=".$_GET['id'];
        $admname = "Sair";
        $admimg = "sair_icon.png";
    ?>

    <!--BANCO DE DADOS-->
    <?php
        require __DIR__.'/../vendor/autoload.php';
        use Classes\Entity\Usuario;
        use Classes\Session\Session;

        $iddb = $_GET['id'];

        /*AUTENTICAÇÃO*/
        $ud = Session::requiredLogin();

        $obUsuario = new Usuario();
        $obUsuario->setIddb($iddb);
        $usuarios = $obUsuario->buscar(null, null, 'nome');
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
                AGENDA DE AUTORIDADES
            </div>
            <div class="div-item-box" id="topo">
                <h1 align=center>Olá <?=$ud['nome'] ?>,</h1>
                <h4 align=center>Esse é o painel administrativo master, onde por aqui você pode adicionar, alterar ou remover
                    autoridade/usuário do seu sistema.</h4>
            </div>
            <div class="content-grid" id="contentgrid">
                <div class="div-item-box" id="large" style="max-height: 655px; overflow: auto;">
                    <div id="compromissoresult">
                        <b><h2 id="tutorial">REGISTRAR NOVA AUTORIDADE/USUÁRIO</h2></b><hr>
                        <form class="form-div" id="form">
                            <div class="form-row">
                                <div class="form-column" id="nome">
                                    Nome da Autoridade: <input type="text" name="nome" id="nome" value="Novo Usuario" style="pointer-events:none;" readonly>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-column" style="width: 50%">
                                    Login da Autoridade: <input type="text" name="login" id="login" value="teste" style="pointer-events:none;" readonly>
                                </div>
                                <div class="form-column" style="width: 50%">
                                    Senha da Autoridade: <input type="text" name="senha" id="senha"  value="123456" style="pointer-events:none;" readonly>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-column" style="width: 50%; font-weight:bold; text-align:right; padding-right:3%;">
                                    Código:
                                </div>
                                <div class="form-column" style="width: 50%; font-weight:bold; text-align:left; padding-left:3%;">
                                    <div id="codigousuario"></div>
                                    <input type="hidden" name="codigousuarioinput" id="codigousuarioinput">
                                </div>
                            </div>
                        </form>
                        <div class="form-row" style="justify-content: center; margin-bottom: 20px;">
                            <div class="form-column" style="width: 30%; display:flex; flex-direction:row; justify-content: space-between;">
                                <button class="menu-button" onclick=geraCodigoUsuario()>Gerar Código</button>
                                <button class="menu-button" onclick=limpaCodigoUsuario() style="margin-left:2%;background-color:red;">Limpar Código</button>
                            </div>
                        </div>
                        <div class="button-field">
                            <button class="menu-button" id="cancelar" style="margin-left:0px;" onclick="document.location.reload(true)">Cancelar</button>
                            <button class="menu-button" style="margin-left:0px;" onclick="registrar('usuario')">Registrar</button>
                        </div>
                    </div>
                </div>
                
                <div class="div-item-box" id="small-calendar">
                    <b><h2 id="tutorial">GERENCIAR AUTORIDADES</h2></b><hr>
                    Confira por aqui a lista de autoridades cadastradas, altere seus dados ou exclua seus registros.
                    <div class="calendar-row">
                        <div class="item-box-text" id="select-calendar">
                            Escolha a autoridade que deseja gerenciar.
                            <br><br>
                            <b>Autoridade:</b>
                            <select name="autoridade" id="autoridade" onchange="pegaautoridade('autoridade')">
                                <option value="">Selecione a autoridade</option>
                                <?php
                                    if($usuarios != null){
                                        foreach($usuarios as $usu){
                                            echo '<option value="'.$usu['id'].'">'.$usu['nome'].'</option>';
                                        }
                                    }
                                ?>
                            </select>
                            <br>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer">
                <?php require_once "../view/elements/footer.php" ?>
            </div>
        </div> <!--MAIN CONTAINER-->
    </div> <!--BODY-->
    <!--ERRO DE CELULAR-->
    <div class="erro-celular">
        <div>
        <img class="logo-login" src="../images/agenda_logo_g.png">
        ESSE SISTEMA NÃO PODE SER ABERTO APARTIR DE CELULARES!
        <button class="menu-button" id="login" onclick="exitDashboardAdm('<?=$_GET['tk'] ?>')">Voltar para a Tela Inicial</button>
        </div>
    </div>

<!--SCRIPTS-->
<script src="controller/js/main.js"></script>
<script src="../controller/js/popper.min.js"></script>
<script src="../controller/js/jquery-3.5.1.min.js"></script>
<script src="controller/js/jquery.mask.min.js"></script>
<script src="../controller/js/bootstrap.min.js"></script>
<script src="../controller/js/select2.min.js"></script>
<script>
    $(document).ready(function(){
        $('#autoridade').select2();
    })
</script>
<script type="text/javascript">
    $("#senhaautoridade").mask('999999');
</script>
<script>
    const inputEle = document.getElementById('form');
    inputEle.addEventListener('keyup', function(e){
    var key = e.which || e.keyCode;
    if (key == 13) {
        registrar('usuario');
    }
    });
</script>
<script>
    document.oncontextmenu = document.body.oncontextmenu = function() {return false;}
</script>
</body>
</html>