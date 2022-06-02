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
    <link rel="stylesheet" href="../view/css/bootstrap.min.css">
    <link rel="stylesheet" href="../view/css/select2.min.css">
    <link rel="stylesheet" href="../view/css/constants.css">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="view/elements/calendar/css/style.css">
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
        $admurl = "exitDashboard(this, 'usuarios')";
        $admname = "Sair";
        $admimg = "sair_icon.png";
    ?>

    <!--BANCO DE DADOS-->
    <?php
        require __DIR__.'/../vendor/autoload.php';
        use Classes\Entity\Compromisso;
        use Classes\Db\Database;

        $iddb = $_GET['id'];

        /*AUTENTICAÇÃO*/
        $obDatabase = new Database('usuarios', $iddb);
        $atResult = $obDatabase->autenticaDB($_GET['tk'])->fetchALL(PDO::FETCH_ASSOC);
        if(!$atResult != null && !$atResult != ""){
            header('Location: paineladm.php?id='.$iddb);
        }
        else{
            foreach($atResult as $at){}
        }

        $obCompromisso = new Compromisso();
        $obCompromisso->setIddb($iddb);
        $result = $obCompromisso->buscar("count(id) as count", "idautoridade = ".$at['id']." AND (data > NOW() OR datainicio > NOW())");
        foreach($result as $rs){}
        $resultprox = $obCompromisso->buscar("DATE_FORMAT(data, '%d/%m') as datacompromisso, DATE_FORMAT(datainicio, '%d/%m') as datainiciocompromisso, data, datainicio", "idautoridade = ".$at['id']." AND (data > NOW() OR datainicio > NOW())", "datainicio ASC, data ASC");
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
                AGENDA DE AUTORIDADES
            </div>
            <div class="div-item-box" id="topo">
                <h1 align=center>Olá <?php echo $at['nomeu'] ?>,</h1>
                <h4 align=center>Por favor use o painel lateral esquerdo para adicionar um novo compromisso ou o calendário no painel direito para conferir,<br>
                editar ou excluir um compromisso já criado.</h4>
            </div>
            <div class="content-grid" id="contentgrid">
                <div class="div-item-box" id="large" style="max-height: 884px; overflow: auto;">
                    <div id="compromissoresult">
                        <b><h2 id="tutorial">REGISTRAR NOVO COMPROMISSO DE DIA INTEIRO</h2></b><hr>
                        <form class="form-div" id="diainteiro">
                            <div class="form-row">
                                <div class="form-column">
                                    <input type="hidden" name="idautoridade" id="idautoridade" value="<?php echo $at['id'] ?>">
                                    Nome da Autoridade: <input type="text" name="autoridade" id="autoridade" value="<?php echo $at['nomeu'] ?>" readonly="">
                                </div>
                                <div class="form-column">
                                    Local do Compromisso: <input type="text" name="local" id="local">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-column" style="width: 25%">
                                    Data do Compromisso: <input type="date" name="data" id="data">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-column" style="width: 100%">
                                    Detalhes do Compromisso:
                                    <textarea name="detalhe" id="detalhe" maxlenght="5000" placeholder="Digite os detalhes aqui."></textarea>
                                </div>
                            </div>
                        </form>
                        <div class="button-field">
                            <button class="menu-button" id="cancelar" style="margin-left:0px;" onclick="document.location.reload(true)">Cancelar</button>
                            <button class="menu-button" style="margin-left:0px;" onclick="registrar('diainteiro')">Registrar</button>
                        </div>
                        <br><br><br><br>
                        <b><h2 id="tutorial">REGISTRAR NOVO COMPROMISSO</h2></b><hr>
                        <form class="form-div" id="compromissonormal">
                            <div class="form-row">
                                <div class="form-column">
                                    <input type="hidden" name="idautoridade" id="idautoridade" value="<?php echo $at['id'] ?>">
                                    Nome da Autoridade: <input type="text" name="autoridade" id="autoridade" value="<?php echo $at['nomeu'] ?>" readonly="">
                                </div>
                                <div class="form-column">
                                    Local do Compromisso: <input type="text" name="local" id="local">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-column" style="width: 25%">
                                    Data do Início do Compromisso: <input type="date" name="datainicio" id="datainicio">
                                </div>
                                <div class="form-column" style="width: 25%">
                                    Hora do Início do Compromisso: <input type="text" name="horainicio" id="horainicio" placeholder="__:__">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-column" style="width: 25%">
                                    Data do Fim do Compromisso: <input type="date" name="datafim" id="datafim">
                                </div>
                                <div class="form-column" style="width: 25%">
                                    Hora do Fim do Compromisso: <input type="text" name="horafim" id="horafim" placeholder="__:__">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-column" style="width: 100%">
                                    Outros Participantes:
                                    <textarea name="participante" id="participante" maxlenght="3000" placeholder="Digite os participantes aqui."></textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-column" style="width: 100%">
                                    Detalhes do Compromisso:
                                    <textarea name="detalhe" id="detalhe" maxlenght="5000" placeholder="Digite os detalhes aqui."></textarea>
                                </div>
                            </div>
                        </form>
                        <div class="button-field">
                            <button class="menu-button" id="cancelar" style="margin-left:0px;" onclick="document.location.reload(true)">Cancelar</button>
                            <button class="menu-button" style="margin-left:0px;" onclick="registrar('compromissonormal')">Registrar</button>
                        </div>
                    </div>
                </div>
                
                <div class="div-item-box" id="small-calendar">
                    <b><h2 id="tutorial">CALENDÁRIO DE COMPROMISSOS</h2></b><hr>
                    Use o calendário abaixo para ter acesso aos compromissos já criados.
                    Primeiro selecione no calendário a data que deseja acompanhar os compromissos e em
                    seguida o o compromisso para ter acesso aos detalhes.
                    Você pode acompanhar no texto abaixo os dias com compromissos vinculados a eles.<br>
                    <b>Você tem um total de <?php echo $rs['count']; ?> compromissos futuros<?php if(isset($resultprox)){ echo ' e seu(s) próximo(s) compromisso(s) será(ão) em '; } else{ echo '.'; } ?>
                    <?php
                        if(isset($resultprox)){
                            $virgula = ", ";
                            $count = 1;
                            foreach($resultprox as $proxc){
                                if($count == $rs['count']){
                                    $virgula = ". ";
                                }
                                if($count == ($rs['count'] - 1)){
                                    $virgula = " e ";
                                }
                                $proximoc = "";
                                if($proxc['datacompromisso'] != "" || $proxc['datacompromisso'] != NULL){
                                    $proximoc = $proxc['datacompromisso'];
                                }
                                if($proxc['datainiciocompromisso'] != "" || $proxc['datainiciocompromisso'] != NULL){
                                    $proximoc = $proxc['datainiciocompromisso'];
                                }
                                echo $proximoc.$virgula;
                                $count ++;
                            }
                        }
                    ?></b><br>
                    <div class="calendar-row" id="column">
                        <div class="item-box-text" id="obj-calendar">
                            <?php require_once 'view/elements/calendar/index2.php' ?>
                        </div>
                        <br><br>
                        <div class="item-box-text" id="select-calendar">
                            <b>Compromisso:</b>
                            <select name="compromisso" id="compromisso" onchange="pegaCompromissoEdit(this, '<?php echo $at['id']?>')" disabled="">
                                <option value="">Selecione o compromisso</option>
                            </select>
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
        <button class="menu-button" id="login" onclick="exitDashboard('<?php echo $_GET['tk'] ?>')">Voltar para a Tela Inicial</button>
        </div>
    </div>

<!--SCRIPTS-->
<script src="controller/js/main.js"></script>
<script src="../controller/js/popper.min.js"></script>
<script src="../controller/js/jquery-3.5.1.min.js"></script>
<script src="controller/js/jquery.mask.min.js"></script>
<script src="../controller/js/bootstrap.min.js"></script>
<script src="../controller/js/select2.min.js"></script>

<script src="view/elements/calendar/js/popper.js"></script>
<script src="view/elements/calendar/js/bootstrap.min.js"></script>
<script src="view/elements/calendar/js/main.js"></script>
<script>
    $(document).ready(function(){
        $('#mescompromisso').select2();
        $('#compromisso').select2();
    })
</script>
<script type="text/javascript">
    var mask = "Hh:MM",
    pattern = {
    'translation': {
        'H': {
            pattern: /[0-2]/
        },
        'h': {
            pattern: /[0-9]/
        },
        'M': {
            pattern: /[0-59]/
        }
    }
    };
    $("#horainicio, #horafim").mask(mask, pattern);
</script>
<script>
    const inputEle = document.getElementById('diainteiro');
    inputEle.addEventListener('keyup', function(e){
    var key = e.which || e.keyCode;
    if (key == 13) {
        registrar('diainteiro');
    }
    });
</script>
<script>
    const inputEle2 = document.getElementById('compromissonormal');
    inputEle2.addEventListener('keyup', function(e){
    var key = e.which || e.keyCode;
    if (key == 13) {
        registrar('compromissonormal');
    }
    });
</script>
<script>
    document.oncontextmenu = document.body.oncontextmenu = function() {return false;}
</script>
</body>
</html>