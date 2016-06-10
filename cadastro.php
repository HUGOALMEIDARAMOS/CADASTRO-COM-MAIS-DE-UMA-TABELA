<?php
require_once 'listar.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="js/jquery.maskedinput.js" type="text/javascript"></script>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/funcoes.js"></script>


</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed " data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">HUGO ALMEIDA</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Hugo Desenvolvimentos</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="active-efeito"><a href="index.php">Início</a></li>
                <li class="dropdown active-efeito"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Opções<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#" class="active-efeito">Listar Cliente</a></li>
                        <li class="active"><a href="#" class="active-efeito">Cadastrar Cliente</a></li>
                        <li><a href="#" class="active-efeito">Excluir Cliente</a></li>
                        <li><a href="#" class="active-efeito">Editar Cliente</a></li>
                    </ul>
                </li>


                <li class="active-efeito"><a href="#">Perfil</a></li>
                <li class="active-efeito"><a href="#">Ajuda</a></li>
            </ul>
        </div>
    </div>
</nav>


<div id="main" class="container">
    <h3 class="page-header">Cadastro de Cliente</h3>

    <form action="index.html" class="borda_form" id="form" name="form" >



            <div class="row">

                <div class="form-group col-md-5">
                       <label for="nome">Nome</label>
                       <input type="text" class="form-control" id="nome" name="nome" placeholder="Primeiro Nome">

                </div>

                <div class="form-group col-md-5">
                        <label for="sobrenome">Sobrenome</label>
                        <input type="text" class="form-control" id="sobrenome" placeholder="Segundo Nome">
                </div>

                <div class="form-group col-md-2">
                       <label for="telefone">Telefone</label>
                       <input type="text" class="form-control" id="telefone"  placeholder="(xx)xxxxx-xxxx" maxlength="11"  onkeypress='return SomenteNumero(event);'>
                </div>
            </div>


        <div class="row">

            <div class="form-group col-md-5">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email">
            </div>

            <div class="form-group col-md-5">
                <label for="endereco">Endereço</label>
                <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Endereço">
            </div>

            <div class="form-group col-md-2">
                <label for="cep">Cep</label>
                <input type="text" class="form-control" id="cep" name="cep" placeholder="xxxxx-xxx" maxlength="8"  onkeypress='return SomenteNumero(event);' >
            </div>
        </div>



        <div class="row">

            <div class="form-group col-md-3">
                <label for="bairro">Bairro</label>
                <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Bairro">
            </div>


            <div class="form-group col-md-3">
                <label for="pais_input">Pais</label>
                <select name="pais_input" id="pais" class="form-control" id="pais" name="pais">
                    <?php foreach($paises as $pais):?>
                        <option value="<?=$pais['pais_id'];?>"><?=$pais['pais'];?></option>
                    <?php endforeach;?>
                </select>

            </div>

            <div class="form-group col-md-3">
                <label for="cidade_input">Cidade</label>
                <select name="pais_input" id="pais" class="form-control" id="cidade" name="cidade">
                    <?php foreach($cidades as $cidade):?>
                        <option  value="<?=$cidade['cidade_id'];?>"><?=$cidade['cidade'];?></option>
                    <?php endforeach;?>
                </select>

            </div>
        </div>

        <div id="actions" class="row botoes">
            <div class="col-md-12  col-xs-12  col-sm-12 col-lg-12">
                <button type="submit" class="btn btn-primary" onclick="return valida();">Salvar</button>
                <button type="reset" class="btn btn-danger btn-cancelar">Cancelar</button>
            </div>
        </div>
    </form>


</div>

</div>


</body>

<script>
    jQuery(function($){
        $("#telefone").mask("(99) 99999-9999");
        $("#cep").mask("99999-999");
       });
</script>


</html>