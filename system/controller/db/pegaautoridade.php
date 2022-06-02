<?php
    require __DIR__.'/../../../vendor/autoload.php';
    use Classes\Entity\Usuario;

    $obUsuario = new Usuario();
    $obUsuario->setIddb($_GET['id']);
    $usuario = $obUsuario->buscar(null, "id = ".$_POST['id'], "nome");
    if($usuario != null){
        foreach($usuario as $u){}
    }

    if(isset($u)){
        echo '<b><h2 id="tutorial">GERENCIAR AUTORIDADE/USUÁRIO</h2></b><hr>';
        echo '<form class="form-div" id="form">';
        echo ' <div class="form-row">';
        echo '  <div class="form-column" id="nome">';
        echo '      Nome da Autoridade: <input type="text" name="nome" id="nome" value="'.$u['nome'].'" style="pointer-events:none;" readonly>';
        echo '  </div>';
        echo ' </div>';
        echo ' <div class="form-row">';
        echo '  <div class="form-column" style="width: 50%">';
        echo '      Login da Autoridade: <input type="password" name="login" placeholder="Confidencial" id="login" value="'.$u['login'].'" style="pointer-events:none;" readonly>';
        echo '  </div>';
        echo '  <div class="form-column" style="width: 50%">';
        echo '      Senha da Autoridade: <input type="password" name="senha" id="senha" placeholder="Confidencial" value="'.$u['senha'].'" style="pointer-events:none;" readonly>';
        echo '  </div>';
        echo ' </div>';
        echo ' <div class="form-row">';
        echo ' <div class="form-column" style="width: 50%; font-weight:bold; text-align:right; padding-right:3%;">';
        echo '   Código:';
        echo '  </div>';
        echo ' <div class="form-column" style="width: 50%; font-weight:bold; text-align:left; padding-left:3%;">';
        echo '   <div id="codigousuario"></div>';
        echo '    <input type="hidden" name="codigousuarioinput" id="codigousuarioinput">';
        echo ' </div>';
        echo ' </div>';
        echo '</form>';
        echo '<div class="form-row" style="justify-content: center; margin-bottom: 20px;">';
        echo ' <div class="form-column" style="width: 30%; display:flex; flex-direction:row; justify-content: space-between;">';
        echo '   <button class="menu-button" onclick=geraCodigoUsuario()>Gerar Código</button>';
        echo '   <button class="menu-button" onclick=limpaCodigoUsuario() style="margin-left:2%;background-color:red;">Limpar Código</button>';
        echo '</div>';
        echo '</div>';
        echo ' <div class="button-field">';
        echo '  <button class="menu-button" id="cancelar" style="margin-left:0px;" onclick="document.location.reload(true)">Cancelar</button>';
        echo '  <button class="menu-button" id="excluir" style="margin-left:0px;" onclick="excluir(\'autoridade\', \'usuarios\')">Excluir</button>';
        echo '  <button class="menu-button" style="margin-left:0px; background-color:forestgreen;" onclick="atualizar(\'reset\',\''.$u['id'].'\')">Resetar</button>';
        echo '  <button class="menu-button" style="margin-left:0px;" onclick="atualizar(\'usuario\',\''.$u['id'].'\')">Alterar</button>';
        echo ' </div>';
    }
    else{
        echo '<b><h2 id="tutorial">USUÁRIO NÃO ENCONTRADO OU HOUVE UM ERRO!</h2></b><hr>';
    }
?>