<?php
/**
 * Created by PhpStorm.
 * User: hugo
 * Date: 09/06/16
 * Time: 18:20
 */

try{
    //Carregar conexão com o banco de dados
    require_once 'pdo.php';

    //Verificar se existe o id do pais no post
    if(!isset($_POST['cliente_id']))
        throw new Exception("Nenhum id de cliente foi enviado!");

    //Verificar se existe o nome do pais no post
    if(!isset($_POST['primeiro_nome']))
        throw new Exception("Nenhum primeiro_nome foi enviado!");

    //Verificar se existe o nome do pais no post
    if(!isset($_POST['ultimo_nome']))
        throw new Exception("Nenhum ultimo_nome foi enviado!");

    //Verificar se existe o nome do pais no post
    if(!isset($_POST['telefone']))
        throw new Exception("Nenhum telefone foi enviado!");

    //Verificar se existe o nome do pais no post
    if(!isset($_POST['email']))
        throw new Exception("Nenhum email foi enviado!");

    //Verificar se existe o nome do pais no post
    if(!isset($_POST['endereco']))
        throw new Exception("Nenhum endereco foi enviado!");

    //Verificar se existe o nome do pais no post
    if(!isset($_POST['cep']))
        throw new Exception("Nenhum cep foi enviado!");

    //Verificar se existe o nome do pais no post
    if(!isset($_POST['bairro']))
        throw new Exception("Nenhum bairro foi enviado!");

    //Verificar se existe o nome do pais no post
    if(!isset($_POST['pais_id']))
        throw new Exception("Nenhum pais_id foi enviado!");

    //Verificar se existe o nome do pais no post
    if(!isset($_POST['cidade_id']))
        throw new Exception("Nenhum cidade_id foi enviado!");

    //Query para atualizar cliente
    $query = "UPDATE
                cliente as c
              SET
                c.primeiro_nome = :primeiro_nome,
                c.ultimo_nome = :ultimo_nome,
                c.email = :email,
                c.ultima_atualizacao = :ultima_atualizacao
              WHERE
                c.cliente_id = :cliente_id";

    //Preparar a query com PDO
    $conexao = $pdo->prepare($query);

    //Verificação para evitar SQL Injection
    $conexao->bindValue(":primeiro_nome", $_POST['primeiro_nome']);
    $conexao->bindValue(":ultimo_nome", $_POST['ultimo_nome']);
    $conexao->bindValue(":email", $_POST['email']);
    $conexao->bindValue(":ultima_atualizacao", date('Y-m-d H:i:s'));
    $conexao->bindValue(":cliente_id", $_POST['cliente_id']);

    //Realizar atualização do cliente
    $conexao->execute();

    //obter endereco_id desse cliente
    $sql = "SELECT endereco_id FROM cliente WHERE cliente_id = :cliente_id";
    $conexao = $pdo->prepare($sql);
    $conexao->bindValue(":cliente_id", $_POST['cliente_id']);
    $conexao->execute();
    $endereco_id = $conexao->fetch(PDO::FETCH_ASSOC)['endereco_id'];


    //Query para atualizar endereço
    $query = "UPDATE
                endereco as e
              SET
                e.telefone = :telefone,
                e.endereco = :endereco,
                e.cep = :cep,
                e.bairro = :bairro,
                e.cidade_id = :cidade_id,
                e.ultima_atualizacao = :ultima_atualizacao
              WHERE
                e.endereco_id = :endereco_id";

    //Preparar a query com PDO
    $conexao = $pdo->prepare($query);

    //Verificação para evitar SQL Injection
    $conexao->bindValue(":telefone", $_POST['telefone']);
    $conexao->bindValue(":endereco", $_POST['endereco']);
    $conexao->bindValue(":cep", $_POST['cep']);
    $conexao->bindValue(":bairro", $_POST['bairro']);
    $conexao->bindValue(":cidade_id", $_POST['cidade_id']);
    $conexao->bindValue(":ultima_atualizacao", date('Y-m-d H:i:s'));
    $conexao->bindValue(":endereco_id", $endereco_id);

    $conexao->execute();

    //Redirecionar para a página principal
    header("Location: index.php");

} catch (Exception $e){
    //Mostrar mensagem de erro caso existir
    echo $e->getMessage();
}

exit();