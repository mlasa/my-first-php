<?php

    $erro = false;

    function limpar_nao_numerico($str){ 
        return preg_replace("/[^0-9]/", "", $str); 
      }

    if(count($_POST) > 0){

        include('conexao.php');

        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $nascimento = $_POST['nascimento'];

        if(strlen($nome) < 2 && empty($nome)){
            $erro = "Preencha o campo nome";
        }

        
        if(empty($telefone)){
            $erro = "Preencha o campo telefone";
        }
        else{
            $telefone = limpar_nao_numerico($telefone);
            
            if(strlen($telefone) != 11){
                $erro = "Telefone deve possuir somente 11 dígitos";
            }

        }
       
        if(!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)){
            $erro = "E-mail inválido";
        }

        if(!empty($nascimento)){
            $pedacos = array_reverse(explode('/',$nascimento));

            if(count($pedacos) != 3){
                $erro = "Data de nascimento inválida, exemplo correto: 15/02/2021";
            }
            else{
                $nascimento = implode('-',$pedacos);
            }

        }
        else{
            $erro = "Preencha o campo de data de nascimento";
        }
        

        if($erro){
            echo 
            "<p class=\"erro\">
                <strong>Atenção:</strong>
            </br> 
            $erro 
            </p>";
        }
        else{
            $comando_sql = "
                INSERT INTO usuarios
                (nome, email, dataNascimento, telefone)
                VALUES ('$nome', '$email', '$nascimento', '$telefone');
            ";

            $operacao_banco = $conexao_banco_dados -> query($comando_sql) 
            or die($conexao_banco_dados -> error);

            if($operacao_banco){
                echo 
                "<strong class=\"sucesso\">
                    Cliente cadastrado com sucesso!
                </strong>";

                unset($_POST);
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar cliente</title>

    <style>
        body{
            display:grid;
            justify-content:center;
        }
        input{
            border: none;
            border-bottom: 1px solid black;
            background: transparent;
            width: 100%;
        }
        button[type="submit"]{
            width: 100%;
            height: 2rem;
            background: lime;
            border: none;
            cursor: pointer;
        }
        form{
            display:flex;
            flex-direction: column;
            justify-content: center;
            padding: 1rem;
        }
        .erro{
            color:red;
        }
        .sucesso{
            color: lime;
        }
    </style>
</head>
<body>
    <form action="cadastrar_cliente.php" method="POST">
        <h4>Novo cliente</h4>
        <p>
            <input value="<?php 
                if(isset($_POST['nome'])) echo $_POST['nome'];
            ?>" type="text" name="nome" id="nome" placeholder="Nome">
        </p>
        <p>
            <input value="<?php 
                if(isset($_POST['email'])) echo $_POST['email'];
            ?>" type="text" name="email" id="email" placeholder="E-mail">
        </p>
        <p>
            <input value="<?php 
                if(isset($_POST['telefone'])) echo $_POST['telefone'];
            ?>" type="text" name="telefone" id="telefone" placeholder="Telefone, ex:(11) 98888-8888">
        </p>
        <p>
            <input value="<?php 
                if(isset($_POST['nascimento'])) echo $_POST['nascimento'];
            ?>" type="text" name="nascimento" id="nascimento" placeholder="Data de nascimento">
        </p>
        <p>
            <button type="submit">Cadastrar</button>
        </p>
    </form>
</body>
</html>