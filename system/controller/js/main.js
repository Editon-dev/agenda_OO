function closeModal() {
    document.location.reload(true);
}

function valida(dado){
    if (dado.value=="" || dado=="")
        return false;
    else
        return true;
}

function valida2(dado){	
    if (dado.value==""){
        alert (changeName(dado));
        return 0;
    }
    else
        return 1;
}

function validaEmail (dado) {
    var str = dado.value;
    var result = str.indexOf("@");
    if (parseInt(result) < 0){
        alert ("Por favor digite um "+changeName(dado)+" válido!");
        return 0;
    }
    else
        return 1;
}

function validaNum(dado){
var teste = /^[0-9]+$/;
    if (dado.value.match(teste)){
    return 1;
    }
    else{
        alert("O campo "+dado.name+" precisa ser numérico!");
        return 0;	
    }
}

function validaNumSenha(){
    dado = document.getElementById("senha");
    var teste = /^[0-9]+$/;
    if (dado.value.match(teste)){
    return 1;
    }
    else{
        alert("O campo "+dado.name+" precisa ser numérico!");
        return 0;	
    }
}

function pegaCompromissos(dia, mes, ano, autoridade) {
    iddb = document.getElementById("iddb").value;
    datacompromisso = ano+'-'+mes+'-'+dia;
    $.ajax({
        url: 'controller/db/pegacompromissos.php?id='+iddb,
        data: {autoridade:autoridade,
            datacompromisso:datacompromisso},
        type: 'POST',
        success: function(data){
            $("#compromissoresult").html(data);
        }
    });
}

function pegaCompromissos2(datacompromisso, autoridade) {
    iddb = document.getElementById("iddb").value;
    $.ajax({
        url: 'controller/db/pegacompromissos.php?id='+iddb,
        data: {autoridade:autoridade,
            datacompromisso:datacompromisso},
        type: 'POST',
        success: function(data){
            $("#compromissoresult").html(data);
        }
    });
}

function pegaCompromissosSelect(dia, mes, ano, autoridade) {
    iddb = document.getElementById("iddb").value;
    datacompromisso = ano+'-'+mes+'-'+dia;
    $.ajax({
        url: 'controller/db/pegacompromissoselect.php?id='+iddb,
        data: {autoridade:autoridade,
            datacompromisso:datacompromisso},
        type: 'POST',
        success: function(data){
            if(data != ""){
                $("#compromisso").html(data);
                document.getElementById("compromisso").removeAttribute("disabled");
            }
            else{
                data = "<option value=\"\">Selecione o compromisso</option>";
                $("#compromisso").html(data);
                document.getElementById("compromisso").setAttribute("disabled", "disabled");
            }
        }
    });
}

function pegaCompromissoEdit(compromisso, idautoridade) {
    iddb = document.getElementById("iddb").value;
    idcompromisso = compromisso.value;
    $.ajax({
        url: 'controller/db/pegacompromissoedit.php?id='+iddb,
        data: {idcompromisso:idcompromisso, idautoridade:idautoridade},
        type: 'POST',
        success: function(data){
            $("#compromissoresult").html(data);
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
        }
    });
}

function confereCod(login, senha, iddb) {
    cod = prompt("Esse deve ser seu primeiro acesso. Por favor informe o código informado a você pelos administradores do sistema!");
    if(cod != "" && cod != null){
        $.ajax({
            url: 'controller/db/conferecod.php?id='+iddb,
            data: {login:login,
                    senha:senha,
                    cod:cod},
            type: 'POST',
            success: function(data){
                if(data>0){
                    alert ("Código verificado!");
                    nome = prompt("Digite seu nome completo!");
                    login = prompt("Digite um novo login!");
                    senha = prompt("Digite uma nova senha com até 6 números e APENAS números!","(apenas números)");
                    if(nome != "" && nome != null && login != "" && login != null && senha != "" && senha != null){
                        id = data;
                        $.ajax({
                            url: 'controller/db/criaprimeiroacesso.php?id='+iddb,
                            data: {login:login,
                                    senha:senha,
                                    nome:nome,
                                    id:id},
                            type: 'POST',
                            success: function(data){
                                if(data == 1){
                                    alert("Novo login e senha cadastrados! Por favor tente realizar o login novamente com seus novos dados!\nLogin: "+login+"\nSenha: "+senha);
                                    page = document.location.href;
                                    document.location.href = page;
                                }
                                else{
                                    alert("Erro ao criar!\n"+data);
                                }
                            },
                        });
                    }
                }
                else{
                    alert (data);
                }
            }
        });
    }
}

function pegaautoridade(select) {
    id = document.getElementById(select).value;
    iddb = document.getElementById("iddb").value;
    $.ajax({
        url: 'controller/db/pegaautoridade.php?id='+iddb,
        data: {id:id},
        type: 'POST',
        success: function(data){
            $("#compromissoresult").html(data);
            $("#senhaautoridade").mask('999999');
        }
    });
}

function totalCompromissosText(dado) {
    id = dado.value;
    iddb = document.getElementById("iddb").value;
    $.ajax({
        url: 'controller/db/totalcompromissostext.php?id='+iddb,
        data: {id:id},
        type: 'POST',
        success: function(data){
            $("#totalcompromissosresult").html(data);
            ativaCalendar();
        }
    });
}

function pegaCompromissoAll(dado) {
    autoridade = document.getElementById("autoridade").value;
    if(autoridade != ""){
        id = dado;
        iddb = document.getElementById("iddb").value;
        $.ajax({
            url: 'controller/db/pegacompromisso_all.php?id='+iddb,
            data: {id:id},
            type: 'POST',
            success: function(data){
                $("#obj-calendar").html(data);
            }
        });
    }
    else{
        alert("Por favor escolha a autoridade!");
    }
}

function registrar(tipo) {
    confirmacao = confirm("Deseja realmente realizar esse registro?");
    if(confirmacao == true){
        var iddb = document.getElementById("iddb").value;
        if(typeof form !== "undefined"){
            var fd = new FormData(form);
        }
        if(/* typeof tipo !== "undefined" &&  */tipo != null && tipo == "diainteiro"){
            var fd = new FormData(diainteiro);
        }
        if(/* typeof tipo !== "undefined" &&  */tipo != null && tipo == "compromissonormal"){
            var fd = new FormData(compromissonormal);
        }
        $.ajax({
            url: 'controller/db/cadastrar.php?id='+iddb+'&tp='+tipo,
            data: fd,
            type: 'POST',
            processData: false,
            contentType: false,
            success: function (data) {
                if(!isNaN(data)){
                    alert("Registrado com sucesso!");
                    document.location.reload(true);
                }
                else{
                    alert(data);
                }
            },
        });
    }
}

function atualizar(tipo, id) {
    confirmacao = confirm("Deseja realmente atualizar esse registro?");
    if(confirmacao == true){
        var iddb = document.getElementById("iddb").value;
        if(typeof form !== "undefined"){
            var fd = new FormData(form);
        }
        if(/* typeof tipo !== "undefined" &&  */tipo != null && tipo == "diainteiro"){
            var fd = new FormData(diainteiro);
        }
        if(/* typeof tipo !== "undefined" &&  */tipo != null && tipo == "compromissonormal"){
            var fd = new FormData(compromissonormal);
        }
        fd.append('id',id);
        $.ajax({
            url: 'controller/db/atualizar.php?id='+iddb+'&tp='+tipo,
            data: fd,
            type: 'POST',
            processData: false,
            contentType: false,
            success: function (data) {
                if(data == "true"){
                    if(tipo == "reset"){
                        alert("Login e senha resetados com sucesso!");
                    }
                    else{
                        alert("Atualizado com sucesso!");
                    }
                    document.location.reload(true);
                }
                else{
                    alert(data);
                }
            },
        });
    }
}

function excluir(dado, tabela, key) {
    if(key != null && key != ""){
        key = "_"+key;
    }
    else{
        key = null;
    }
    var valor = $("#"+dado).val();
    if(valida(valor) == 1){
        confirmacao = confirm("Deseja realmente exluir o(a) "+dado+"?");
        var iddb = document.getElementById("iddb").value;
        if(confirmacao == true){
            $.ajax({
                url: 'controller/db/excluir.php?id='+iddb,
                type: 'POST',
                data: {valor:valor, tabela:tabela, key:key},
                success: function(data){
                if(data == 1){
                    alert("Remoção de "+dado+" realizada com sucesso!");
                    document.location.reload(true);
                }
                else
                    alert("Erro ao remover "+id+"!\n"+data);
                },
            });
        }
    }
    else{
        alert("Por favor escolha qual "+id+" deve remover!");
    }
}

function buscar(keys = null, where = null, order = null, limit = null) {
    id = 'algo';
    valor = 'asdad';
    if(valida(valor) == 1){
        confirmacao = confirm("Deseja realmente buscar o dado "+id+"?");
        if(confirmacao == true){
            var iddb = document.getElementById("iddb").value;
            $.ajax({
                url: 'controller/db/buscar.php?id='+iddb,
                type: 'POST',
                data: {keys:keys,
                        where:where,
                        order:order,
                        limit:limit},
                success: function(data){
                    alert(data);
                },
            });
        }
    }
    else{
        alert("Por favor escolha qual "+id+" deve remover!");
    }
}

function geraCodigoUsuario() {
    none = "";
    $.ajax({
        url: 'controller/db/geracodigousuario.php',
        type: 'POST',
        data: {none:none},
        success: function(data){
            document.getElementById("codigousuario").innerHTML = data;
            document.getElementById("codigousuarioinput").value = data;
        },
    })
}

function limpaCodigoUsuario() {
    target = document.getElementById("codigousuario");
    target.innerHTML = "";
}