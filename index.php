<?php
require_once 'listar.php';

$result = $pdo->prepare("SELECT COUNT(*) as quant FROM cliente");
$result->execute();
$num_paginas = ceil($result->fetch(PDO::FETCH_ASSOC)['quant'] / $itens_por_pagina);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Listagem de Cadastro</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="js/jquery.maskedinput.js" type="text/javascript"></script>
    <script src="js/funcoes.js"></script>
    <link rel="stylesheet" href="css/esilo.css">
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


<div id="main" class="container-fluid">
<hr/>

    <div id="top" class="row pesquisa">

        <div class="col-md-3">
            <h2>Listagem</h2>
        </div>

        <div class="col-md-6">
            <div class="input-group h2">
                <input name="data[search]" class="form-control" id="search" type="text" placeholder="Pesquisar Itens">
            <span class="input-group-btn">
                <button class="btn btn-primary" type="submit">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
            </div>
        </div>

        <div class="col-md-3">
            <a href="cadastro.php" class="btn btn-primary pull-right  btn-lg  glyphicon glyphicon-plus btn-topo"></a>
        </div>


    </div> <!-- /#top -->

    <hr />
    <div id="list" class="row">


        <div class="table-responsive col-md-12">
            <table class="table table-striped table-bordered table-hover table-condensed" cellspacing="0" cellpadding="0" id="dados_mysql">
                <thead>
                <tr class="bg-primary text-default">

                     <th>Id</th>
                     <th>Nome</th>
                    <th>Sobrenome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Cep</th>
                    <th>Endereço</th>
                    <th>Bairro</th>
                    <th>Cidade</th>
                    <th>País</th>

                    <th class="actions">Ações</th>
                </tr>
                </thead>
                <tbody >

                <?php foreach($listar as $pessoa): ?>
                <tr class="btn-default">

                    <td><?= $pessoa['cliente_id']?></td>
                    <td><?= $pessoa['primeiro_nome'];?></td>
                    <td><?= $pessoa['ultimo_nome'];?></td>
                    <td><?= $pessoa['email'];?></td>
                    <td><?= $pessoa['telefone'];?></td>
                    <td><?= $pessoa['cep'];?></td>
                    <td><?= $pessoa['endereco'];?></td>
                    <td><?= $pessoa['bairro'];?></td>
                    <td><?= $pessoa['cidade'];?></td>
                    <td><?= $pessoa['pais'];?></td>
              
                    <td class="actions">
                        <div class="input-group-btn">
                        <a  href="editar.php?cliente_id=<?=$pessoa['cliente_id']?>" class="btn btn-warning btn-xs btn-afast">Editar</a>
                        <a href="apagar.php?cliente_id=<?=$pessoa['cliente_id']?>"  class="btn btn-danger btn-xs"   data-toggle="modal" data-target="#delete-modal">Excluir</a>
                     </div>
                    </td>

                    <?php endforeach;?>
                </tbody>
            </table>



        </div> <!-- /#list -->

    <div id="bottom" class="row">

        <nav class="col-md-10 col-md-offset-1">
            <ul class="pagination">

                <li>
                    <a href="index.php?pagina=0" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                <?php for($i=0;$i<$num_paginas;$i++) : ?>

                    <li class="<?= $pagina == $i ? "active" : "";?>">
                        <a href="index.php?pagina=<?= $i; ?>">
                            <?= $i+1;?>
                        </a>
                    </li>

                <?php endfor; ?>

                <li>
                    <a href="index.php?pagina=<?= $num_paginas-1;?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>


        </nav>


    </div> <!-- /#bottom -->

</div>


    <script>
        $(function(){

            $('#search').keydown(function(){
                var encontrou = false;
                var termo = $(this).val().toLowerCase();
                $('table#dados_mysql > tbody > tr').each(function(){
                    $(this).find('td').each(function(){
                        if($(this).text().toLowerCase().indexOf(termo) > -1)
                            encontrou = true;
                    });
                    if(!encontrou)
                        $(this).hide();
                    else
                        $(this).show();
                    encontrou = false;
                });
            });

        });



    </script>





    <script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
