<?php
/**
 * Created by PhpStorm.
 * User: hugo
 * Date: 26/05/16
 * Time: 10:13
 */


/**AQUI FAZ SELECT NAS TABELAS CLIENTE, ENDERECO, CIDADE, PAIS*/
try {
    require_once 'pdo.php';

    $itens_por_pagina = 20;

    /**AQUI FAZ A CONTAGEM PARA A PAGINAÇÃO*/

    $sql = "SELECT COUNT(*) as quant FROM cliente";
    $prepare_conn = $pdo->prepare($sql);
    $prepare_conn->execute();
    $num_paginas = ceil($prepare_conn->fetch(PDO::FETCH_ASSOC)['quant'] / $itens_por_pagina);

    /**AQUI FAZ A BUSCA DE CLIENTES CADASTRADOS*/
    $pagina = isset($_GET['pagina']) ? abs($_GET['pagina']) : 1; //Verifica se existe a página e transforma em número positivo
    $pagina = $pagina >= $num_paginas ? $num_paginas - 1 : $pagina; //Verificar se a página solicitada é maior que o limite de página
    $pagina = ($pagina - 1) * $itens_por_pagina; //Realiza o calculo de limite para  paginação

    $sql = "SELECT
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
            ORDER BY c.cliente_id ASC
            LIMIT {$pagina}, {$itens_por_pagina}";

    $prepare_conn = $pdo->prepare($sql);
    $prepare_conn->execute();
    $listar = $prepare_conn->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    $num_paginas = 0;
    $listar = array();
    echo "Ocorreu um erro ao conectar com o banco de dados. Erro: {$e->getMessage()}" . PHP_EOL;
}
