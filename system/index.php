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
    <link rel="stylesheet" href="view/css/index.css">
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

    <!--BANCO DE DADOS-->
    <?php
        require __DIR__.'/../vendor/autoload.php';
        use Classes\Entity\Usuario;
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

        $obUsuario = new Usuario();
        $obUsuario->setIddb($_GET['id']);
        $usuarios = $obUsuario->buscar(null, null, 'nome');
    ?>

    <!--ADM BUTTON-->
    <?php
        $hidden = "";
        $admurl = "document.location.href='paineladm.php?id=".$iddb."'";
        $admname = "Administrativo";
        $admimg = "adm_icon.png";
    ?>
    
</head>
<body>
    <header>
        <!--MENU-->
        <?php require_once "../view/elements/menu_bar.php" ?>
        <input type="hidden" name="iddb" id="iddb" value="<?php echo $iddb ?>">
        <input type="hidden" name="daycalendar" id="daycalendar" value="">
    </header>

    <div class="body">
        <div class="main-container">
            <div class="text-title">
                AGENDA DE AUTORIDADES
            </div>
            <div class="div-item-box" id="topo">
                <h2 align=center>Essa é a tela inicial da agenda.<br>
                Por aqui você pode visualizar os detalhes de compromissos existentes para as
                autoridades vinculadas a essa agenda.</h2>
            </div>
            <div class="content-grid" id="contentgrid">
                <div class="div-item-box" id="small-calendar">
                    <b><h2 id="tutorial">CALENDÁRIO DE COMPROMISSOS</h2></b><hr>
                    Use o calendário abaixo para ter acesso aos compromissos já criados.
                    Selecione primeiro a autoridade que deseja acompanhar os compromissos e em
                    seguida o mês desejado e depois o dia marcado no calendário para ter acesso aos detalhes.
                    Os dias destacados em Azul tem compromissos vinculados a ele.
                    <button id="todos">Clique aqui para ver todos os compromissos anteriores e futuros.</button>
                    <div class="calendar-row" id="column">
                        <div class="item-box-text" id="select-calendar">
                            <b>Autoridade:</b>
                            <select name="autoridade" id="autoridade" onchange="totalCompromissosText(this)">
                                <option value="">Selecione a autoridade</option>
                                <?php
                                    if($usuarios != null){
                                        foreach($usuarios as $usu){
                                            echo '<option value="'.$usu['id'].'">'.$usu['nome'].'</option>';
                                        }
                                    }
                                ?>
                            </select>
                            <div id="totalcompromissosresult">
                            </div>
                        </div>
                        <div class="item-box-text" id="obj-calendar" style="pointer-events:none; filter: opacity(30%)">
                            <?php require_once 'view/elements/calendar/index.php' ?>
                        </div>
                    </div>
                </div>

                <div class="div-item-box" id="large" style="max-height: 947px; overflow: auto;">
                    <div id="compromissoresult">
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
<script src="../controller/js/popper.min.js"></script>
<script src="../controller/js/jquery-3.5.1.min.js"></script>
<script src="../controller/js/bootstrap.min.js"></script>
<script src="../controller/js/select2.min.js"></script>

<script src="view/elements/calendar/js/popper.js"></script>
<script src="view/elements/calendar/js/bootstrap.min.js"></script>
<script src="view/elements/calendar/js/main.js"></script>
<script>
    $(document).ready(function(){
        $('#mescompromisso').select2();
        $('#autoridade').select2();
    })
</script>
<script>
    $("#todos").on('click', function(){
        id = document.getElementById('autoridade').value;
        pegaCompromissoAll(id);
    })
</script>
</body>
</html>