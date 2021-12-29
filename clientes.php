<?php
    include('conexao.php');
    
    $sql_consulta = "
        SELECT * FROM usuarios;
    ";

    $query_clientes = $conexao_banco_dados -> query($sql_consulta) or die($conexao_banco_dados -> error);

    $numero_clientes = $query_clientes -> num_rows;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar cliente</title>

    <style>
        html{
            height: 100vh;
            width: 100vw;
            font-family: sans-serif;
        }
        body{
            background: #eff3f4;
            padding: 1rem;
            height: 100%;
        }
        h1,h2,h3,h4,h5,h6,p,strong, input, button{
            font-size: 1.2rem;
            color: #494949;
        }
        input{
            border: none;
            border-bottom: 1px solid black;
            background: transparent;
            width: 100%;
            padding: .5rem;
        }
        button[type="submit"]{
            width: 100%;
            height: 3rem;
            background: #88e0a6;
            border: none;
            cursor: pointer;
            border-radius: .5rem;
            padding: .5rem;
        }
        button[type="submit"]:hover{
            background: #8cd197;
        }
        .erro{
            color:red;
        }
        .sucesso{
            color: lime;
        }

        th{
            padding: .5rem;
        }
        thead{
            background: #cce3fc;
        }
        .lista-clientes{
            display:grid;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }
        tbody tr{
            background: white;
        }
        tbody tr:nth-child(even){
            background: #ededed;
        }
        tbody td{
            padding: .5rem;
        }
    </style>
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
                </thead>
                <tbody>
                    <?php if($numero_clientes == 0){ ?>
                        <tr>
                            <td colspan="5">Sem clientes no momento</td>
                        </tr>
                    <?php } else{ 
                            while($cliente = $query_clientes -> fetch_assoc()){
                        ?>
                        <tr>
                            <td><?php echo $cliente['nome'];  ?></td>
                            <td><?php echo $cliente['dataNascimento'];  ?></td>
                            <td><?php echo $cliente['telefone'];  ?></td>
                            <td><?php echo $cliente['email'];  ?></td>
                            <td><?php echo $cliente['dataCriacao'];  ?></td>
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