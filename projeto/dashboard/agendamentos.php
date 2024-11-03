<?php
// Configuração do banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projeto";

// Conexão ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificação de conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe e sanitiza os dados do formulário
    $nome = $conn->real_escape_string($_POST['nome']);
    $cpf = $conn->real_escape_string($_POST['cpf']);
    $email = $conn->real_escape_string($_POST['email']);
    $telefone = $conn->real_escape_string($_POST['telefone']);
    $tipo_agendamento = $conn->real_escape_string($_POST['tipo_agendamento']);
    $modelo_carro = $conn->real_escape_string($_POST['modelo_carro']);
    $data_agendamento = $conn->real_escape_string($_POST['data_agendamento']);
    $hora_agendamento = $conn->real_escape_string($_POST['hora_agendamento']);
    $observacoes = $conn->real_escape_string($_POST['observacoes']);

    // Insere os dados na tabela `agendamentos`
    $sql = "INSERT INTO agendamentos (nome, cpf, email, telefone, tipo_agendamento, modelo_carro, data_agendamento, hora_agendamento, observacoes) 
            VALUES ('$nome', '$cpf', '$email', '$telefone', '$tipo_agendamento', '$modelo_carro', '$data_agendamento', '$hora_agendamento', '$observacoes')";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='mensagem-sucesso'>Obrigado, $nome! Seu agendamento de $tipo_agendamento para o modelo $modelo_carro foi realizado com sucesso.</div>";
        echo "<script>setTimeout(function(){ window.location.href = 'dashboard.php'; }, 3000);</script>";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}

// Fecha a conexão
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamento - AutoPerfect</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        body {
            background-color: #f4f4f9;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 20px 30px;
            width: 100%;
            max-width: 500px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        h1 {
            color: #007bff;
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }
        label {
            font-weight: bold;
            margin-top: 15px;
            display: block;
        }
        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="date"],
        input[type="time"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }
        .mensagem-sucesso {
            text-align: center;
            color: #4caf50;
            font-size: 18px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Agende uma Visita ou Test Drive</h1>
    <form action="agendamentos.php" method="POST">
        <label for="nome">Nome Completo:</label>
        <input type="text" id="nome" name="nome" required>

        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" title="Formato: 000.000.000-00" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="telefone">Telefone:</label>
        <input type="tel" id="telefone" name="telefone" required>

        <label for="tipo_agendamento">Tipo de Agendamento:</label>
        <select id="tipo_agendamento" name="tipo_agendamento" required>
            <option value="">Selecione o tipo de agendamento</option>
            <option value="Compra">Compra</option>
            <option value="Test Drive">Test Drive</option>
        </select>

        <label for="modelo_carro">Modelo do Carro:</label>
        <input type="text" id="modelo_carro" name="modelo_carro" required>

        <label for="data_agendamento">Data do Agendamento:</label>
        <input type="date" id="data_agendamento" name="data_agendamento" required>

        <label for="hora_agendamento">Hora do Agendamento:</label>
        <input type="time" id="hora_agendamento" name="hora_agendamento" required>

        <label for="observacoes">Observações Adicionais:</label>
        <textarea id="observacoes" name="observacoes" rows="4"></textarea>

        <button type="submit">Enviar Agendamento</button>
    </form>
</div>

</body>
</html>
