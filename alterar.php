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
    if(!isset($_POST['nome_pais']))
        throw new Exception("Nenhum nome de cliente foi enviado!");

    //Query para atualizar pais
    $query = "UPDATE cliente SET pais = :pais, ultima_atualizacao = :ultima_atualizacao WHERE pais_id = :pais_id";

    //Preparar a query com PDO
    $p_sql = $pdo->prepare($query);

    //Verificação para evitar SQL Injection
    $p_sql->bindValue(":pais", $_POST['nome_pais']);
    $p_sql->bindValue(":ultima_atualizacao", date('Y-m-d H:i:s'));
    $p_sql->bindValue(":pais_id", $_POST['pais_id']);

    //Realizar atualização do pais
    $p_sql->execute();

    //Redirecionar para a página principal
    header("Location: index.php");

} catch (Exception $e){
    //Mostrar mensagem de erro caso existir
    echo $e->getMessage();
}

exit();