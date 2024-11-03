<?php
session_start();
include_once('../config.php'); // Inclua sua configuração de conexão com o banco de dados

// Verifica se a conexão foi bem-sucedida
if (!$conexao) {
    die("Conexão falhou: " . mysqli_connect_error());
}

// Consulta para obter todas as mensagens
$sql = "SELECT * FROM mensagens ORDER BY data DESC"; // Ordena as mensagens pela data (do mais recente para o mais antigo)
$result = mysqli_query($conexao, $sql);

if (!$result) {
    die("Erro na consulta: " . mysqli_error($conexao));
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensagens Recebidas</title>
    <link rel="stylesheet" href="../styles/mensagens.css"> <!-- Inclua seu CSS aqui -->
    <style>
        /* Estilo básico para a tabela */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .dashboard-button {
            margin: 0 10px; /* Margem ao redor do botão */
            display: inline-block; /* Permite que o botão fique ao lado de outros elementos */
            width: 30px; /* Largura do botão */
            height: 30px; /* Altura do botão */
        }
        .message-icon {
            width: 100%; /* A imagem ocupará todo o espaço do botão */
            height: auto; /* Mantém a proporção da imagem */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>
            <a href="../paginadm/ADM.php" class="btn btn-success dashboard-button">
                <img src="https://cdn-icons-png.flaticon.com/512/5774/5774594.png" alt="Novas Mensagens" class="message-icon">
            </a>
            Mensagens Recebidas
        </h1>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Mensagem</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['nome']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo nl2br(htmlspecialchars($row['mensagem'])); ?></td>
                        <td><?php echo date('d/m/Y H:i:s', strtotime($row['data'])); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <?php
    // Fecha a conexão com o banco de dados
    mysqli_close($conexao);
    ?>
</body>
</html>
