<?php
    include('conexao.php');
    
    $sql_consulta = "
        SELECT * FROM usuarios;
    ";

    $query_clientes = $conexao_mysql -> query($sql_consulta) or die($conexao_mysql -> error);

    $numero_clientes = $query_clientes -> num_rows;

    function remover_cliente($id){
        //$sql_remover_cliente = "DELETE FROM usuarios WHERE id=$id";
        echo "Cliente removido: $id";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Cadastrar cliente</title>
</head>
<body>
    <div class="container">
        <a href="cadastrar_cliente.php">Cadastrar cliente</a>
        <div class="lista-clientes">
            <h1>Clientes</h1>
            <p>Esses são os seus clientes cadastrados no sistema.</p>
            <table celpadding="5" border=1>
                <thead>
                    <th>Nome</th>
                    <th>Data de nascimento</th>
                    <th>Telefone</th>
                    <th>E-mail</th>
                    <th>Cliente desde</th>
                    <th>...</th>
                </thead>
                <tbody>
                    <?php if($numero_clientes == 0){ ?>
                        <tr>
                            <td colspan="5">Sem clientes no momento</td>
                        </tr>
                    <?php } else{ 
                            while($cliente = $query_clientes -> fetch_assoc()){

                                $telefone = "Não informado";
                                
                                if(!empty($cliente["telefone"])){
                                    $telefone_ddd = substr($cliente["telefone"],0, 2);
                                    $telefone_parte1 = substr($cliente["telefone"],2, 5);
                                    $telefone_parte2 = substr($cliente["telefone"],7);

                                    $telefone = "($telefone_ddd) $telefone_parte1 - $telefone_parte2";
                                }

                                $nascimento = "Não informado";
                                
                                if(!empty($cliente["dataNascimento"])){
                                    $nascimento = formatar_data($cliente['dataNascimento']);
                                }

                                $cliente_desde = "Não informado";
                                
                                if(!empty($cliente["dataCriacao"])){
                                    $cliente_desde = formatar_data($cliente['dataCriacao']);
                                }
                        ?>
                        <tr>
                            <td><?php echo $cliente['nome'];  ?></td>
                            <td><?php echo $nascimento;  ?></td>
                            <td><?php echo $telefone;  ?></td>
                            <td><?php echo $cliente['email'];  ?></td>
                            <td><?php echo $cliente_desde;  ?></td>
                            <td>
                                <a href="editar_cliente.php?id=<?php echo $cliente['id'];  ?>">Editar</a>
                                <a href="deletar_cliente.php?id=<?php echo $cliente['id'];  ?>">Excluir</a>
                            </td>
                        </tr>
                    <?php
                           }
                        } 
                    ?>

                </tbody>
            </table>
        </div>
    </div>    
</body>
</html>