<?php
session_start();
include '../config.php';

if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

// Adicionando um item ao carrinho
if (isset($_GET['acao']) && $_GET['acao'] == 'add' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    if (isset($_SESSION['carrinho'][$id])) {
        $_SESSION['carrinho'][$id]++;
    } else {
        $_SESSION['carrinho'][$id] = 1;
    }
    // Redireciona para evitar duplicação na adição
    header("Location: carrinho.php");
    exit();
}

// Removendo um item do carrinho
if (isset($_GET['acao']) && $_GET['acao'] == 'remove' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    unset($_SESSION['carrinho'][$id]);
}

// Incrementando a quantidade
if (isset($_GET['acao']) && $_GET['acao'] == 'increment' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    if (isset($_SESSION['carrinho'][$id])) {
        $_SESSION['carrinho'][$id]++;
    }
}

// Decrementando a quantidade
if (isset($_GET['acao']) && $_GET['acao'] == 'decrement' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    if (isset($_SESSION['carrinho'][$id]) && $_SESSION['carrinho'][$id] > 1) {
        $_SESSION['carrinho'][$id]--;
    } elseif (isset($_SESSION['carrinho'][$id]) && $_SESSION['carrinho'][$id] == 1) {
        unset($_SESSION['carrinho'][$id]);
    }
}

function exibirCarrinho() {
    global $conexao;
    
    if (empty($_SESSION['carrinho'])) {
        echo "<p>Seu carrinho está vazio.</p>";
        return;
    }

    echo "<h2>Produtos no Carrinho:</h2>";
    $total = 0;

    foreach ($_SESSION['carrinho'] as $id => $quantidade) {
        $query = "SELECT * FROM produtos WHERE id = $id";
        $resultado = $conexao->query($query);
        
        // Verificando se a consulta retornou um resultado
        if ($resultado && $resultado->num_rows > 0) {
            $produto = $resultado->fetch_assoc();
            $subtotal = $produto['preco'] * $quantidade;
            $total += $subtotal;

            echo "<div>";
            echo "<h3>" . htmlspecialchars($produto['nome']) . "</h3>";
            echo "<img src='" . htmlspecialchars($produto['imagem']) . "' alt='" . htmlspecialchars($produto['nome']) . "' style='width:100px;height:auto;'><br>";
            echo "<p>Preço: R$ " . number_format($produto['preco'], 2, ',', '.') . "</p>";
            echo "<p>Quantidade: " . $quantidade . "</p>";
            echo "<p>Subtotal: R$ " . number_format($subtotal, 2, ',', '.') . "</p>";
            echo "<a href='carrinho.php?acao=remove&id=" . $id . "'>Remover</a> | ";
            echo "<a href='carrinho.php?acao=increment&id=" . $id . "'>Aumentar</a> | ";
            echo "<a href='carrinho.php?acao=decrement&id=" . $id . "'>Diminuir</a>";
            echo "</div>";
        } else {
            echo "<p>Produto com ID $id não encontrado.</p>";
        }
    }

    echo "<h3>Total: R$ " . number_format($total, 2, ',', '.') . "</h3>";
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho de Compras</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 20px;
    }

    header {
        text-align: center;
        margin-bottom: 20px;
    }

    main {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1, h2, h3 {
        color: #333;
    }

    div {
        margin-bottom: 15px;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #fafafa;
    }

    a {
        color: #007BFF;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }

    footer {
        text-align: center;
        margin-top: 20px;
        color: #777;
    }
</style>

</head>
<body>

    <header>
        <h1>Meu Carrinho de Compras</h1>
    </header>

    <main>
        <?php exibirCarrinho(); ?>

        <a href="../dashboard/dashboard.php">Voltar à Loja</a>
    </main>

    <footer>
        <p>&copy; 2023 Loja Exemplo. Todos os direitos reservados.</p>
    </footer>
</body>
</html>