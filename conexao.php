<?php
$host = "localhost";
$db = "teste";
$user = "root";
$pass = "admin@admin";

$conexao_mysql = mysqli_connect($host, $user, $pass, $db);

if(mysqli_connect_errno()){
    die("Falha na conexao: " . mysqli_connect_error());
}

function formatar_telefone($telefone){
    $telefone_ddd = substr($telefone,0, 2);
    $telefone_parte1 = substr($telefone,2, 5);
    $telefone_parte2 = substr($telefone,7);

    return "($telefone_ddd) $telefone_parte1 - $telefone_parte2";
}

function formatar_data($data){
    return implode('/',array_reverse(explode('-', $data)));
}