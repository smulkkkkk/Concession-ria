<?php
include_once('../config.php'); // Inclua sua configuração do banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = htmlspecialchars($_POST['nome']);
    $email = htmlspecialchars($_POST['email']);
    $mensagem = htmlspecialchars($_POST['mensagem']);
    
    // Preparar a consulta para inserir os dados no banco
    $sql = "INSERT INTO mensagens (nome, email, mensagem) VALUES (?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("sss", $nome, $email, $mensagem);
    
    // Executa a consulta e verifica se foi bem-sucedida
    if ($stmt->execute()) {
        echo "<script>alert('Mensagem enviada com sucesso!'); window.location.href = 'dashboard.php';</script>";
    } else {
        echo "<script>alert('Erro ao enviar a mensagem. Tente novamente.');</script>";
    }

    $stmt->close(); // Fecha a declaração
    $conexao->close(); // Fecha a conexão
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Contato - Atendimento ao Cliente</title>
    <link rel="stylesheet" href="../styles/contato.css">
    <style>
        footer {
    background-color: #121212; /* Cor de fundo escura para o modo escuro */
    color: #ffffff;
    padding: 20px 0;
    text-align: center;
}

.footer-container {
    max-width: 800px;
    margin: 0 auto;
}

.footer-links {
    margin-bottom: 10px;
}

.footer-links a {
    color: #f0ad4e; /* Cor dos links */
    text-decoration: none;
    margin: 0 15px;
}

.footer-links a:hover {
    text-decoration: underline; /* Sublinha ao passar o mouse */
}

.footer-info {
    font-size: 0.9rem; /* Tamanho da fonte */
}

    </style>
</head>
<body>
    <div class="container">
        <h2>Atendimento ao Cliente</h2>
        <form action="contato.php" method="POST">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="mensagem">Mensagem:</label>
            <textarea id="mensagem" name="mensagem" rows="5" required></textarea>

            <button type="submit">Enviar Mensagem</button>
        </form>
    </div>
    <footer>
    <div class="footer-container">
        <div class="footer-links">
            <a href="sobre-nos.php">Sobre Nós</a>
            <a href="contato.php">Contato</a>
            <a href="politica-privacidade.php">Política de Privacidade</a>
            <a href="termos-servico.php">Termos de Serviço</a>
        </div>
        <div class="footer-info">
            <p>&copy; 2024 AutoPerfect. Todos os direitos reservados.</p>
        </div>
    </div>
</footer>
</body>
</html>
