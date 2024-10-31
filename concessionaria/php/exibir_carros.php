<?php
// Conexão com o banco de dados
$servername = "localhost"; // Altere se necessário
$username = "root"; // Seu usuário do MySQL
$password = ""; // Sua senha do MySQL
$dbname = "concessionaria"; // Nome do seu banco de dados

// Criação da conexão
$conexao = mysqli_connect($servername, $username, $password, $dbname);

// Verificação da conexão
if (!$conexao) {
    die("Conexão falhou: " . mysqli_connect_error());
}

// Consulta para obter todos os carros
$sql = "SELECT * FROM carros";
$result = mysqli_query($conexao, $sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Carros</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        
        .container {
            width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        
        h1 {
            text-align: center;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ccc;
        }
        
        th {
            background-color: #f8f8f8;
        }
        
        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Lista de Carros Cadastrados</h1>
        <table>
            <thead>
                <tr>
                    <th>Modelo</th>
                    <th>Marca</th>
                    <th>Ano</th>
                    <th>Preço</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Verifica se há resultados e exibe na tabela
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td>{$row['modelo']}</td>
                                <td>{$row['marca']}</td>
                                <td>{$row['ano']}</td>
                                <td>R$ " . number_format($row['preco'], 2, ',', '.') . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Nenhum carro cadastrado.</td></tr>";
                }

                // Fechando a conexão
                mysqli_close($conexao);
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
