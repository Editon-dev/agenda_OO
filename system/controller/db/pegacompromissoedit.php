<?php
    require __DIR__.'/../../../vendor/autoload.php';
    use Classes\Entity\Compromisso;

    $idcompromisso = $_POST['idcompromisso'];

    $obCompromisso = new Compromisso();
    $obCompromisso->setIddb($_GET['id']);
    $idautoridade = $_POST['idautoridade'];
    $result = $obCompromisso->buscar('*, DATE_FORMAT(data, \'%Y-%m-%d\') as datacompromisso', 'id = '.$idcompromisso);
    if($result != null){
        foreach($result as $comp){}
    }

    if(isset($result)){
        if($comp['datacompromisso'] != NULL){
            $tipo = "diainteiro";
        }
        else{
            $tipo = "naodiainteiro";
        }
        if($tipo == "diainteiro"){
            $detalhecompropmisso = str_replace('<br />', '', $comp['detalhe']);
            echo '<b><h2 id="tutorial">ALTERAR COMPROMISSO DE DIA INTEIRO</h2></b><hr>';
            echo '<form class="form-div" id="diainteiro">';
            echo '<div class="form-row">';
            echo '<div class="form-column">';
            echo '<input type="hidden" name="idautoridade" id="idautoridade" value="'.$idautoridade.'">';
            echo '    Nome da Autoridade: <input type="text" name="autoridade" id="autoridade" value="'.$comp['autoridade'].'" readonly="">';
            echo ' </div>';
            echo '<div class="form-column">';
            echo '    Local do Compromisso: <input type="text" name="local" id="local" value="'.$comp['local'].'">';
            echo ' </div>';
            echo '</div>';
            echo '<div class="form-row">';
            echo ' <div class="form-column" style="width: 25%">';
            echo '    Data do Compromisso: <input type="date" name="data" id="data" value="'.$comp['datacompromisso'].'">';
            echo ' </div>';
            echo '</div>';
            echo '<div class="form-row">';
            echo ' <div class="form-column" style="width: 100%">';
            echo '    Detalhes do Compromisso:';
            echo '    <textarea name="detalhe" id="detalhe" maxlenght="5000" placeholder="Digite os detalhes aqui.">'.$detalhecompropmisso.'</textarea>';
            echo ' </div>';
            echo '</div>';
            echo '</form>';
            echo '<div class="button-field">';
            echo '  <button class="menu-button" id="cancelar" style="margin-left:0px;" onclick="document.location.reload(true)">Cancelar</button>';
            echo ' <button class="menu-button" id="excluir" style="margin-left:0px;" onclick="excluir(\'compromisso\', \'compromissos2\')">Excluir</button>';
            echo ' <button class="menu-button" style="margin-left:0px;" onclick="atualizar(\'diainteiro\', \''.$comp['id'].'\')">Alterar</button>';
            echo '</div>';
        }
        else{
            $detalhecompropmisso = str_replace('<br />', '', $comp['detalhe']);
            $participantecompromisso = str_replace('<br />', '', $comp['participante']);
            echo '<b><h2 id="tutorial">ALTERAR COMPROMISSO</h2></b><hr>';
            echo '<form class="form-div" id="compromissonormal">';
            echo ' <div class="form-row">';
            echo '   <div class="form-column">';
            echo '<input type="hidden" name="idautoridade" id="idautoridade" value="'.$idautoridade.'">';
            echo '       Nome da Autoridade: <input type="text" name="autoridade" id="autoridade" value="'.$comp['autoridade'].'" readonly="">';
            echo '   </div>';
            echo '   <div class="form-column">';
            echo '       Local do Compromisso: <input type="text" name="local" id="local" value="'.$comp['local'].'">';
            echo '   </div>';
            echo ' </div>';
            echo ' <div class="form-row">';
            echo '    <div class="form-column" style="width: 25%">';
            echo '       Data do Início do Compromisso: <input type="date" name="datainicio" id="datainicio" value="'.$comp['datainicio'].'">';
            echo '   </div>';
            echo '   <div class="form-column" style="width: 25%">';
            echo '       Hora do Início do Compromisso: <input type="text" name="horainicio" id="horainicio" placeholder="__:__" value="'.$comp['horainicio'].'">';
            echo '   </div>';
            echo ' </div>';
            echo ' <div class="form-row">';
            echo '    <div class="form-column" style="width: 25%">';
            echo '       Data do Fim do Compromisso: <input type="date" name="datafim" id="datafim" value="'.$comp['datafim'].'">';
            echo '   </div>';
            echo '   <div class="form-column" style="width: 25%">';
            echo '       Hora do Fim do Compromisso: <input type="text" name="horafim" id="horafim" placeholder="__:__" value="'.$comp['horafim'].'">';
            echo '   </div>';
            echo ' </div>';
            echo '<div class="form-row">';
            echo '   <div class="form-column" style="width: 100%">';
            echo '       Outros Participantes:';
            echo '       <textarea name="participante" id="participante" maxlenght="3000" placeholder="Digite os participantes aqui.">'.$participantecompromisso.'</textarea>';
            echo '   </div>';
            echo ' </div>';
            echo ' <div class="form-row">';
            echo '    <div class="form-column" style="width: 100%">';
            echo '       Detalhes do Compromisso:';
            echo '       <textarea name="detalhe" id="detalhe" maxlenght="5000" placeholder="Digite os detalhes aqui.">'.$detalhecompropmisso.'</textarea>';
            echo '   </div>';
            echo ' </div>';
            echo '</form>';
            echo ' <div class="button-field">';
            echo '  <button class="menu-button" id="cancelar" style="margin-left:0px;" onclick="document.location.reload(true)">Cancelar</button>';
            echo '  <button class="menu-button" id="excluir" style="margin-left:0px;" onclick="excluir(\'compromisso\', \'compromissos2\')">Excluir</button>';
            echo '  <button class="menu-button" style="margin-left:0px;" onclick="atualizar(\'compromissonormal\', \''.$comp['id'].'\')">Alterar</button>';
            echo ' </div>';
        }
    }
    else{
        echo 'Não existe compromissos nessa data!';
        echo '   <button class="menu-button" id="cancelar" style="margin-left:0px;" onclick="document.location.reload(true)">Voltar</button>';
    }
?>