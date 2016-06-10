<?php
/**
 * Created by PhpStorm.
 * User: hugo
 * Date: 26/05/16
 * Time: 10:13
 */


/**AQUI FAZ SELECT NAS TABELAS CLIENTE, ENDERECO, CIDADE, PAIS*/
try{
    require_once 'pdo.php';



    $itens_por_pagina=20;
    $pagina=intval($_GET['pagina']);


    $sql = "SELECT  c.cliente_id,  c.primeiro_nome, c.ultimo_nome, c.email, e.telefone,
 e.cep, e.endereco, e.bairro, d.cidade, p.pais FROM cliente c INNER JOIN endereco e ON c.endereco_id=e.endereco_id
INNER JOIN cidade d ON e.cidade_id=d.cidade_id  INNER JOIN pais p ON d.pais_id=p.pais_id ORDER BY c.cliente_id DESC LIMIT $pagina, $itens_por_pagina";
    $prepare_conn = $pdo->prepare($sql);
    $prepare_conn->execute();
    $listar = $prepare_conn->fetchAll(PDO::FETCH_ASSOC);
} catch ( PDOException $e){
    $listar = array();
    echo "Ocorreu um erro ao conectar com o banco de ddos. Erro: {$e->getMessage()}".PHP_EOL;
}

/**AQUI FAZ SELECT NA TABELA PAIS PARA PREENCHER O SELECT*/

try{
    require_once 'pdo.php';

    $sql = "SELECT pais_id, pais FROM pais ORDER BY pais";
    $prepare_conn = $pdo->prepare($sql);
    $prepare_conn->execute();
    $paises = $prepare_conn->fetchAll(PDO::FETCH_ASSOC);
} catch ( PDOException $e){
    $paises = array();
    echo "Ocorreu um erro ao conectar com o banco de ddos. Erro: {$e->getMessage()}".PHP_EOL;
}


/**AQUI FAZ SELECT NA TABELA CIDADE PARA PREENCHER O SELECT*/

try{
require_once 'pdo.php';

$sql = "SELECT cidade_id, cidade FROM cidade ORDER BY cidade";
$prepare_conn = $pdo->prepare($sql);
$prepare_conn->execute();
$cidades = $prepare_conn->fetchAll(PDO::FETCH_ASSOC);
} catch ( PDOException $e){
$cidades = array();
echo "Ocorreu um erro ao conectar com o banco de ddos. Erro: {$e->getMessage()}".PHP_EOL;
}
?>
