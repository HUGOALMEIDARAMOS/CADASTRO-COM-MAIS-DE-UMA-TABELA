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


    $query = "SELECT
                c.cliente_id,
                c.primeiro_nome,
                c.ultimo_nome,
                c.email,
                e.telefone,
                e.cep,
                e.endereco,
                e.bairro,
                d.cidade,
                p.pais
             FROM cliente as c
             INNER JOIN endereco as e ON c.endereco_id = e.endereco_id
             INNER JOIN cidade as d ON e.cidade_id = d.cidade_id
             INNER JOIN pais as p ON d.pais_id = p.pais_id
             WHERE c.cliente_id = :cliente_id";

    //Preparar a query com PDO
    $p_sql = $pdo->prepare($query);

    //Verificação para evitar SQL Injection
    $p_sql->bindValue(":cliente_id", $_GET['cliente_id']);

    //Realizar busca dos países
    $p_sql->execute();

    //Trazer lista de países num array
    $pessoa = $p_sql->fetch(PDO::FETCH_ASSOC);

    /**AQUI FAZ SELECT NA TABELA PAIS PARA PREENCHER O SELECT*/

    $sql = "SELECT pais_id, pais FROM pais ORDER BY pais";
    $prepare_conn = $pdo->prepare($sql);
    $prepare_conn->execute();
    $paises = $prepare_conn->fetchAll(PDO::FETCH_ASSOC);

    /**AQUI FAZ SELECT NA TABELA CIDADE PARA PREENCHER O SELECT*/

    $sql = "SELECT cidade_id, cidade FROM cidade ORDER BY cidade";
    $prepare_conn = $pdo->prepare($sql);
    $prepare_conn->execute();
    $cidades = $prepare_conn->fetchAll(PDO::FETCH_ASSOC);

} catch (Exception $e){
    //Tornar lista de países vazia
    $pessoa = array();
    $paises = array();
    $cidades = array();
    //Guardar mensagem de erro numa variavel
    $error = $e->getMessage();
}