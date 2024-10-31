<?php
// Conexão com o banco de dados
$servername = "localhost"; // Altere se necessário
$username = "root"; // Seu usuário do MySQL
$password = ""; // Sua senha do MySQL
$dbname = "concessionária"; // Nome do seu banco de dados

// Criação da conexão
$conexao = mysqli_connect($servername, $username, $password, $dbname);

// Verificação da conexão
if (!$conexao) {
    die("Conexão falhou: " . mysqli_connect_error());
}

// Recebendo os dados do formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $modelo = $_POST['modelo'];
    $marca = $_POST['marca'];
    $ano = $_POST['ano'];
    $preco = $_POST['preco'];

    // Preparação da SQL para inserção
    $sql = "INSERT INTO carros (modelo, marca, ano, preco) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "ssds", $modelo, $marca, $ano, $preco);

    if (mysqli_stmt_execute($stmt)) {
        echo "Carro cadastrado com sucesso!";
                header("Location: paginainicial.php"); // Altera para a nova página
    } else {
        echo "Erro ao cadastrar carro: " . mysqli_error($conexao);
    }

    // Fechando o statement
    mysqli_stmt_close($stmt);
}

// Fechando a conexão
mysqli_close($conexao);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Carros</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        
        .container {
            width: 300px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        
        h1 {
            text-align: center;
        }
        
        label {
            display: block;
            margin: 10px 0 5px;
        }
        
        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        
        button {
            width: 100%;
            padding: 10px;
            background: #5cb85c;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        
        button:hover {
            background: #4cae4c;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Cadastrar Carro</h1>
        <form action="cadastrar.php" method="post">
            <label for="modelo">Modelo:</label>
            <input type="text" id="modelo" name="modelo" required>

            <label for="marca">Marca:</label>
            <input type="text" id="marca" name="marca" required>

            <label for="ano">Ano:</label>
            <input type="number" id="ano" name="ano" required>

            <label for="preco">Preço:</label>
            <input type="text" id="preco" name="preco" required>

            <button type="submit">Cadastrar</button>
        </form>
    </div>
</body>
</html>
