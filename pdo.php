<?php
/**
 * Created by PhpStorm.
 * User: hugo
 * Date: 26/05/16
 * Time: 10:11
 */

try{
    $host = "localhost";
    $db = "cadastros";
    $usuarioDb = "root";
    $senhaDb = "hugo2010";
    $pdo = new PDO("mysql:host={$host};dbname={$db}", $usuarioDb, $senhaDb, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
} catch (PDOException $e){
    throw $e;
}
