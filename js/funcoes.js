/**
 * Created by hugo on 29/05/16.
 */



window.onload = function() {
    document.getElementById("nome").focus();
};


function valida(){
    if(document.form.nome.value==""){
        alert("Preencha o campo nome");
        document.form.nome.focus();
        return false;
    }
    if  (document.form.nome.value.length<5){
        alert("Digitar nome completo");
        document.form.nome.focus();
        return false;
    }
    if(document.form.sobrenome.value==""){
        alert("Preencha o campo sobrenome.");
        document.form.sobrenome.focus();
        return false;
    }
    if(document.form.telefone.value==""){
        alert("Preencha o campo telefone");
        document.form.telefone.focus();
        return false;
    }
    if(document.form.telefone.value<11  || document.form.telefone.value>13 ){
        alert("Verificar número. EX: (xx) xxxxx-xxxx");
        document.form.telefone.focus();
        return false;
    }

    if(document.form.email.value==""){
        alert("Preencha o campo email");
        document.form.email.focus();
        return false;
    }
    if( document.forms[0].email.value=="" || document.forms[0].email.value.indexOf('@')==-1
        || document.forms[0].email.value.indexOf('.')==-1 )
    {
        alert( "Por favor, informe um E-MAIL válido!" );
        return false;
    }

    if(document.form.endereco.value==""){
        alert("Preencha o campo endereco");
        document.form.endereco.focus();
        return false;
    }
    if(document.form.cep.value==""){
        alert("Preencha o campo cep");
        document.form.cep.focus();
        return false;
    }
    if(document.form.bairro.value==""){
        alert("Preencha o campo bairro");
        document.form.bairro.focus();
        return false;
    }

    return true;
}


function SomenteNumero(e){
    var tecla=(window.event)?event.keyCode:e.which;
    if((tecla>47 && tecla<58)) return true;
    else{
        if (tecla==8 || tecla==0) return true;
        else  return false;
    }
}

