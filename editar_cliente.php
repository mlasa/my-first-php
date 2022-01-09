<?php
    include('conexao.php');

    $id_cliente = intval($_GET['id']);
    $sql_consulta_cliente = "SELECT * FROM usuarios WHERE id=$id_cliente";
    $query_consulta_cliente = $conexao_mysql ->query($sql_consulta_cliente) or die($conexao_mysql->error);
    $cliente = $query_consulta_cliente -> fetch_assoc();

    $erro = false;

    function limpar_nao_numerico($str){ 
        return preg_replace("/[^0-9]/", "", $str); 
      }

    if(count($_POST) > 0){

        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];

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
                UPDATE usuarios SET 
                    nome            = '$nome',
                    email           = '$email',
                    telefone        = '$telefone'
                WHERE id = $id_cliente
            ";

            $operacao_banco = $conexao_mysql -> query($comando_sql) 
            or die($conexao_mysql -> error);

            if($operacao_banco){
                echo
                "<strong class='sucesso'>
                    Dados do cliente atualizado!
                </strong>";

                echo "
                    <a class='link-button' href='clientes.php'> Voltar para lista de clientes</a>
                ";

                die();
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
    <link rel="stylesheet" href="styles.css">
    <title>Editar cliente</title>

</head>
<body>
    <div>
        <a href="clientes.php">Lista de clientes</a>
    </div>
    <form action="" method="POST">
        <div class="form-content">
            <h4>Editar dados do cliente</h4>
            <p>
                <input value="<?php 
                    echo $cliente["nome"];
                ?>" type="text" name="nome" id="nome" placeholder="Nome">
            </p>
            <p>
                <input value="<?php 
                    echo $cliente["email"];
                ?>" type="text" name="email" id="email" placeholder="E-mail">
            </p>
            <p>
                <input value="<?php 
                    if(!empty($cliente["telefone"])) echo formatar_telefone($cliente["telefone"]); else echo "Sem telefone";
                ?>" type="text" name="telefone" id="telefone" placeholder="Telefone, ex:(11) 98888-8888">
            </p>
            <p>
                <button type="submit">Salvar</button>
            </p>
        </div>
    </form>
</body>
</html>