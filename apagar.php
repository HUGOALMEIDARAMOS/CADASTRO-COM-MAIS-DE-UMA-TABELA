<?php
/**
 * Created by PhpStorm.
 * User: hugo
 * Date: 09/06/16
 * Time: 16:55
 */

try{
    //Carregar conexão com o banco de dados
    require_once 'pdo.php';

  
    if(!isset($_GET['cliente_id']))
        throw new Exception("Nenhum id de país foi enviado!");

    //Query para apagar pais
    $query = "DELETE FROM cliente WHERE cliente_id = :cliente_id";

    //Preparar a query com PDO
    $p_sql = $pdo->prepare($query);

    //Verificação para evitar SQL Injection
    $p_sql->bindValue(":cliente_id", $_GET['cliente_id']);

    //Realizar exclusão do pais
    $p_sql->execute();

    //Redirecionar para a página principal
    header("Location: index.php");

} catch (Exception $e){
    //Mostrar mensagem de erro caso existir
    echo $e->getMessage();
}

exit();