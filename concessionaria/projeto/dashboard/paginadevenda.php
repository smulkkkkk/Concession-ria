<?php
// Incluir o arquivo de conexão
include_once '../produtos/config.php';

// Imprimir a URL completa
echo 'URL: ' . htmlspecialchars($_SERVER['REQUEST_URI']) . '<br>';

// Verifica se o ID do produto foi passado na URL
if (isset($_GET['id'])) {
    $id = (int)$_GET['id']; // Obtém o ID do produto da URL
    var_dump($id); // Debug: Verifica qual ID está sendo recebido

    // Consulta para buscar o produto pelo ID
    $stmt = $conexao->prepare('SELECT * FROM produtos WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $produto = $resultado->fetch_assoc();

    // Verifica se o produto foi encontrado
    if (!$produto) {
        echo "Produto não encontrado.";
        exit;
    }
} else {
    echo "ID do produto não especificado.";
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($produto['nome']); ?></title>
    <link rel="stylesheet" href="styles.css"> <!-- Link para o CSS -->
</head>
<body>
    <header>
        <h1>Loja Exemplo</h1>
    </header>

    <main>
        <div class="produto">
            <div class="imagem-produto">
                <img src="<?php echo htmlspecialchars($produto['imagem']); ?>" alt="<?php echo htmlspecialchars($produto['nome']); ?>">
            </div>
            <div class="detalhes-produto">
                <h2><?php echo htmlspecialchars($produto['nome']); ?></h2>
                <p class="preco">R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></p>
                <p class="descricao"><?php echo nl2br(htmlspecialchars($produto['descricao'])); ?></p>
            </div>
        </div>
    </main>
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