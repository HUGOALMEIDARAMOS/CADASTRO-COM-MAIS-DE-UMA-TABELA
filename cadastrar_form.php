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

    //Query para criar endereço
    $query = "INSERT INTO endereco (
                telefone,
                endereco,
                cep,
                bairro,
                cidade_id,
                ultima_atualizacao
              ) VALUES (
                :telefone,
                :endereco,
                :cep,
                :bairro,
                :cidade_id,
                :ultima_atualizacao
              );";

    $pdo->beginTransaction();

    //Preparar a query com PDO
    $conexao = $pdo->prepare($query);

    //Verificação para evitar SQL Injection
    $conexao->bindValue(":telefone", $_POST['telefone']);
    $conexao->bindValue(":endereco", $_POST['endereco']);
    $conexao->bindValue(":cep", $_POST['cep']);
    $conexao->bindValue(":bairro", $_POST['bairro']);
    $conexao->bindValue(":cidade_id", $_POST['cidade_id']);
    $conexao->bindValue(":ultima_atualizacao", date('Y-m-d H:i:s'));

    //Realizar atualização do pais
    $conexao->execute();

    $endereco_id = $pdo->lastInsertId();

    //Query para atualizar pais
    $query = "INSERT INTO cliente (
                primeiro_nome,
                ultimo_nome,
                email,
                endereco_id,
                data_criacao
              ) VALUES (
                :primeiro_nome,
                :ultimo_nome,
                :email,
                :endereco_id,
                :data_criacao
              )";

    //Preparar a query com PDO
    $conexao = $pdo->prepare($query);

    //Verificação para evitar SQL Injection
    $conexao->bindValue(":primeiro_nome", $_POST['primeiro_nome']);
    $conexao->bindValue(":ultimo_nome", $_POST['ultimo_nome']);
    $conexao->bindValue(":email", $_POST['email']);
    $conexao->bindValue(":endereco_id", $endereco_id);
    $conexao->bindValue(":data_criacao", date('Y-m-d H:i:s'));

    //Realizar atualização do pais
    $conexao->execute();

    $pdo->commit();

    //Redirecionar para a página principal
    header("Location: index.php");

} catch (Exception $e){
    //Mostrar mensagem de erro caso existir
    echo $e->getMessage();

    $pdo->rollBack();
}

exit();