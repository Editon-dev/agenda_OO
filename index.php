<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#6699FF">
    <meta name="apple-mobile-web-app-status-bar-style" content="#6699FF">
    <title>AGENDA DE AUTORIDADES - SGOV</title>
    <link rel="stylesheet" href="view/css/styles.css">
    <link rel="stylesheet" href="view/css/bootstrap.min.css">
    <link rel="stylesheet" href="view/css/select2.min.css">
    <link rel="stylesheet" href="view/css/constants.css">
    <style type="text/css">
        body { 
            background-image: url(images/bg2.png);
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
            background-image: url(images/bg2.png);
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
    <link class rel="icon" href="images/agenda_logo_icon.png" sizes="any">
    <!--ADM BUTTON-->
    <?php
        $hidden = "hidden";
        $admurl = "";
        $admname = "Painel Administrativo";
        $admimg = "";
    ?>

    <!--BANCO DE DADOS-->
    <?php
        require_once ('dao/connection.php');
        require __DIR__.'/vendor/autoload.php';

        $selectestados = $conn->prepare("SELECT * FROM estados ORDER BY Nome");
        $selectestados->execute();
        if($selectestados->rowCount()>0){
            $estados = $selectestados->fetchALL();
        }
    ?>
    
</head>
<body>
    <header>
        <!--MENU-->
        <?php require_once "view/elements/menu_bar.php" ?>
    </header>

    <div class="body">
        <div class="main-container">
            <div class="text-title">
                AGENDA DE AUTORIDADES - SGOV
            </div>
            <div class="content-grid" id="contentgrid">
                <div class="div-item-box">
                    <img class="img-bigbox" src="images/agenda_vetor.png">
                    <b><h2 id="tutorial">Bem vindo(a) a Agenda de Autoridades!</h2></b>
                    Nesse sistema você pode gerenciar seus compromissos e publicá-los com rapidez e facilidade. Crie, publique, visualize, altere
                    ou exclua seus compromisso sempre que quiser e aonde quiser.<br>
                    Se quiser saber mais como funciona a nossa
                    agenda de forma prática por favor acesse a nossa agenda de exemplo clicando no botão abaixo.<br><br>
                    <div class="button-field" id="exemplos">
                        <button class="menu-button" style="margin-left:0px;" onclick="document.location.href='system/index.php?id=teste'">Acessar Agenda de Exemplo</button>
                    </div>
                </div>

                <div class="div-item-box" id="select-itens">
                    <img class="img-smallbox" src="images/agenda_logo_g.png">
                    <div class="item-box-text">
                        <b><h2 id="tutorial">Acesso à Agenda!</h2></b>
                        Acesse por aqui a sua Ouvidoria Digital selecionando a
                        sua entidade e localidade.<br>
                    </div>
                    <div class="select-itens">
                        <select name="entidade" id="entidade">
                            <option value="">Selecione a entidade</option>
                            <option value="aq">Autarquias</option>
                            <option value="cm">Câmara</option>
                            <option value="fd">Fundos</option>
                            <option value="pm">Prefeitura</option>
                        </select>
                        <select name="estado" id="estado" onchange=pegaMunicipio()>
                            <option value="">Selecione o estado</option>
                            <?php
                                foreach ($estados as $est){
                                    echo ('<option value="'.$est['Uf'].'">'.$est['Nome'].'</option>');
                                }
                            ?>
                        </select>
                        <select name="municipio" id="municipio">
                            <option value="">Selecione o município</option>
                        </select>
                        <button class="menu-button" onclick="abreAgenda()">Acessar</button>
                    </div>
                </div>
            </div>

            <div class="footer">
                <?php require_once "view/elements/footer.php" ?>
            </div>
        </div> <!--MAIN CONTAINER-->
    </div> <!--BODY-->

<!--SCRIPTS-->
<script src="controller/js/main.js"></script>
<script src="controller/js/popper.min.js"></script>
<script src="controller/js/jquery-3.5.1.min.js"></script>
<script src="controller/js/bootstrap.min.js"></script>
<script src="controller/js/select2.min.js"></script>
<script>
    $(document).ready(function(){
        $('#entidade').select2();
        $('#estado').select2();
        $('#municipio').select2();
    })
</script>
</body>
</html>