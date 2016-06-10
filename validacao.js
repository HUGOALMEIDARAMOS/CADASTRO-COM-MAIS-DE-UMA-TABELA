/**
 * Created by hugo on 29/05/16.
 */

function validacao() {

    if (document.dados.nome.value == "" || document.dados.nome.value.length < 8) {

          
                $("#myModal").modal();
            

        document.dados.nome.focus();
        return false;
    }

    if (document.dados.sobrenome.value=="")
    {

        $(document).ready(function(){
            $("#myBtn").click(function(){
                $("#myModal2").modal();
            });
        });
        document.dados.sobrenome.focus();
        return false;
    }

    if (document.dados.telefone.value.length < 50 )
    {
        $(document).ready(function(){
            $("#myBtn").click(function(){
                $("#myModal").modal();
            });
        });
        document.dados.telefone.focus();
        return false;
    }


return true;



}


