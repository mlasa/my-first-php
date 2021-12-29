<?php
$host = "localhost";
$db = "teste";
$user = "root";
$pass = "admin@admin";

$conexao_banco_dados = mysqli_connect($host, $user, $pass, $db);

if(mysqli_connect_errno()){
    die("Falha na conexao: " . mysqli_connect_error());
}