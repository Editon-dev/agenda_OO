function abreAgenda() {
    var entidade = document.getElementById("entidade").value;
    var estado = document.getElementById("estado").value;
    var municipio = document.getElementById("municipio").value;

    link = entidade+""
            +estado+""
            +municipio;

    var linkLower = link.toLowerCase(link);
    var linkCorrigido = linkLower.normalize('NFD').replace(/[\u0300-\u036f]/g, "");
    linkFinal = linkCorrigido.replace(/\s/g, '');

    $.ajax({
        url: 'controller/db/buscadominio.php',
        data: {linkFinal:linkFinal},
        type: 'POST',
        success: function(data){
            if(data!="0"){
                window.location.href = "system_"+entidade+"/index.php?id=ouvidoria_"+data;
            }else
                alert ("Desculpe, mas não temos sistema registrado nessa localidade!");
        }
    });
    
}

function pegaMunicipio() {
    var idEstado = document.getElementById("estado").value;
    $.ajax({
        url: 'controller/db/municipios.php',
        type: 'POST',
        data: {id:idEstado},
        beforeSend: function(){
            $("#municipio").css({'pointer-events':'unset'});
            $("#municipio").css({'display':'block'});
            $("#municipio").html("Carregando...");
        },
        success: function(data){
            $("#municipio").css({'display':'block'});
            $("#municipio").html(data);
        },
        error: function(data){
            $("#municipio").css({'display':'block'});
            $("#municipio").html("Erro!");
        },
    })
}