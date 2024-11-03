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
    $email = $conn->real_escape_string($_POST['email']);
    $telefone = $conn->real_escape_string($_POST['telefone']);
    $modelo = $conn->real_escape_string($_POST['modelo']);
    $ano = $conn->real_escape_string($_POST['ano']);
    $observacoes = $conn->real_escape_string($_POST['observacoes']);

    // Insere os dados na tabela `solicitacoes`
    $sql = "INSERT INTO solicitacoes (nome, email, telefone, modelo, ano, observacoes) 
            VALUES ('$nome', '$email', '$telefone', '$modelo', '$ano', '$observacoes')";

    if ($conn->query($sql) === TRUE) {
        // Redireciona para a dashboard em caso de sucesso
        header("Location: dashboard.php");
        exit(); // Encerra o script após o redirecionamento
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
    <title>Solicitar Cotação de Carro - AutoPerfect</title>
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
        input[type="number"],
        textarea,
        select {
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

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Processa o formulário quando enviado
    $nome = htmlspecialchars($_POST['nome']);
    $email = htmlspecialchars($_POST['email']);
    $telefone = htmlspecialchars($_POST['telefone']);
    $modelo = htmlspecialchars($_POST['modelo']);
    $ano = htmlspecialchars($_POST['ano']);
    $observacoes = htmlspecialchars($_POST['observacoes']);

    // Exemplo de mensagem (você pode enviar um email, salvar no banco de dados, etc.)
    echo "<div class='mensagem-sucesso'>Obrigado, $nome! Sua solicitação de cotação para o modelo $modelo foi enviada com sucesso.</div>";
}
?>

<div class="container">
    <h1>Solicite uma Cotação de Carro</h1>
    <form action="cotacao.php" method="POST">
        <label for="nome">Nome Completo:</label>
        <input type="text" id="nome" name="nome" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="telefone">Telefone:</label>
        <input type="tel" id="telefone" name="telefone" required>

        <label for="modelo">Modelo do Carro:</label>
        <select id="modelo" name="modelo" required>
            <option value="">Selecione um modelo</option>
            <option value="BMW 320i 2024">BMW 320i 2024</option>
            <option value="Porsche 911 Turbo S">Porsche 911 Turbo S</option>
            <option value="BMW X6 2024">BMW X6 2024</option>
            <option value="Toyota Hilux SRX Plus 2024">Toyota Hilux SRX Plus 2024</option>
            <!-- Adicione outros modelos conforme necessário -->
        </select>

        <label for="ano">Ano do Modelo:</label>
        <input type="number" id="ano" name="ano" required min="1900" max="<?php echo date("Y"); ?>">

        <label for="observacoes">Observações Adicionais:</label>
        <textarea id="observacoes" name="observacoes" rows="4"></textarea>

        <button type="submit">Enviar Solicitação</button>
    </form>
</div>

</body>
</html>
