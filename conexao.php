<?php
$host = "localhost";
$db = MY_DATABASE;
$user = MY_USER;
$pass = MY_PASSWORD;

$conexao_banco_dados = mysqli_connect($host, $user, $pass, $db);

if(mysqli_connect_errno()){
    die("Falha na conexao: " . mysqli_connect_error());
}