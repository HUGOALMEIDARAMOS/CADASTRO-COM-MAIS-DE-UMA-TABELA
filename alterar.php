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

    //Query para atualizar pais
    $query = "UPDATE
                cliente as c,
                endereco as e
              SET
                c.primeiro_nome = :primeiro_nome,
                c.ultimo_nome = :ultimo_nome,
                e.telefone = :telefone,
                c.email = :email,
                e.endereco = :endereco,
                e.cep = :cep,
                e.bairro = :bairro,
                e.cidade_id = :cidade_id,
                c.ultima_atualizacao = :ultima_atualizacao,
                e.ultima_atualizacao = :ultima_atualizacao
              WHERE
                c.cliente_id = :cliente_id AND
                e.endereco_id = c.endereco_id";

    //Preparar a query com PDO
    $p_sql = $pdo->prepare($query);

    //Verificação para evitar SQL Injection
    $p_sql->bindValue(":primeiro_nome", $_POST['primeiro_nome']);
    $p_sql->bindValue(":ultimo_nome", $_POST['ultimo_nome']);
    $p_sql->bindValue(":telefone", $_POST['telefone']);
    $p_sql->bindValue(":email", $_POST['email']);
    $p_sql->bindValue(":endereco", $_POST['endereco']);
    $p_sql->bindValue(":cep", $_POST['cep']);
    $p_sql->bindValue(":bairro", $_POST['bairro']);
    $p_sql->bindValue(":cidade_id", $_POST['cidade_id']);
    $p_sql->bindValue(":ultima_atualizacao", date('Y-m-d H:i:s'));
    $p_sql->bindValue(":cliente_id", $_POST['cliente_id']);

    //Realizar atualização do pais
    $p_sql->execute();

    //Redirecionar para a página principal
    header("Location: index.php");

} catch (Exception $e){
    //Mostrar mensagem de erro caso existir
    echo $e->getMessage();
}

exit();