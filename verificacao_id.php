<?php
/**
 * Created by PhpStorm.
 * User: hugo
 * Date: 09/06/16
 * Time: 16:59
 */

try{
    //Carregar conexão com o banco de dados
    require_once 'pdo.php';


    if(!isset($_GET['cliente_id']))
        throw new Exception("Nenhum id de nome foi enviado!");


    $query = "SELECT  c.cliente_id,  c.primeiro_nome, c.ultimo_nome, c.email, e.telefone,
 e.cep, e.endereco, e.bairro, d.cidade, p.pais FROM cliente c INNER JOIN endereco e ON c.endereco_id=e.endereco_id
INNER JOIN cidade d ON e.cidade_id=d.cidade_id  INNER JOIN pais p ON d.pais_id=p.pais_id";



    //Preparar a query com PDO
    $p_sql = $pdo->prepare($query);

    //Verificação para evitar SQL Injection
    $p_sql->bindValue(":cliente_id", $_GET['cliente_id']);


    //Realizar busca dos países
    $p_sql->execute();

    //Trazer lista de países num array
    $pessoa = $p_sql->fetch(PDO::FETCH_ASSOC);

} catch (Exception $e){
    //Tornar lista de países vazia
    $pessoa = array();
    //Guardar mensagem de erro numa variavel
    $error = $e->getMessage();
}