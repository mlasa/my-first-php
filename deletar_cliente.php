<?php
    include('conexao.php');

    $id_cliente = intval($_GET['id']);
    $sql_consulta_cliente = "SELECT * FROM usuarios WHERE id=$id_cliente";
    $query_consulta_cliente = $conexao_mysql ->query($sql_consulta_cliente) or die($conexao_mysql->error);
    $cliente = $query_consulta_cliente -> fetch_assoc();

    $sql_deletar_cliente = "DELETE FROM usuarios WHERE id=$id_cliente";

    if(isset($_POST["deletar"])){
        $query_deletar_cliente = $conexao_mysql ->query($sql_deletar_cliente) or die($conexao_mysql->error);

        if(!$query_deletar_cliente){
            echo "
                <h4>Ocorreu um erro, tente novamente mais tarde.</h4>
                <a class='link-button' href='clientes.php'> Voltar para lista de clientes</a>
            ";
            die();
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
    <title>Excluir cliente</title>

</head>
<body>
    <form action="" method="POST">
        <div class="form-content">
            <h4>Tem certeza que deseja excluir <span class="highlight"><?php echo $cliente["nome"]?></span> da lista de clientes ?</h4>
            <p>Todos os dados deste cliente serão excluídos e não poderão mais ser consultados.</p>

            <button name="deletar" value="1">Sim</button>
            <button><a class="link-button" href="clientes.php">Não</a></button>
        </div>
    </form>
</body>
</html>