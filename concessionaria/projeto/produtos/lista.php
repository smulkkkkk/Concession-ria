<?php
session_start();
include_once('../config.php');

// Verifica se a conexão foi bem-sucedida
if (!$conexao) {
    die("Conexão falhou: " . mysqli_connect_error());
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém e sanitiza os dados
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $preco = mysqli_real_escape_string($conexao, $_POST['preco']);
    $descricao = mysqli_real_escape_string($conexao, $_POST['descricao']);
    $imagem = mysqli_real_escape_string($conexao, $_POST['imagem']);
    $categoria = mysqli_real_escape_string($conexao, $_POST['categoria']); // Captura o valor da categoria

    // Inserção do produto no banco de dados
    $sql = "INSERT INTO produtos (nome, preco, descricao, imagem, categoria) VALUES ('$nome', '$preco', '$descricao', '$imagem', '$categoria')";
    if (mysqli_query($conexao, $sql)) {
        $_SESSION['mensagem'] = "Produto adicionado com sucesso!";
    } else {
        $_SESSION['mensagem'] = "Erro ao adicionar o produto: " . mysqli_error($conexao);
    }

    // Redireciona para a mesma página para evitar reenvio do formulário
    header("Location: produtos.php");
    exit();
}

// Consulta para obter todos os produtos
$result = mysqli_query($conexao, "SELECT * FROM produtos");
if (!$result) {
    die("Erro na consulta: " . mysqli_error($conexao)); // Adiciona tratamento de erro
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Produtos</title>
    <link rel="stylesheet" href="../styles/listaprodutos.css">
</head>
<body>
    <h1>Lista de Produtos</h1>

    <!-- Formulário para adicionar um novo produto -->
    <h2>Adicionar Produto</h2>
    <form action="produtos.php" method="POST"> 
        <input type="text" name="nome" placeholder="Nome do Produto" required>
        <input type="text" name="preco" placeholder="Preço" required>
        <input type="text" name="descricao" placeholder="Descrição" required>
        <input type="text" name="imagem" placeholder="URL da Imagem" required>
        <input type="text" name="categoria" placeholder="Categoria" required> <!-- Corrigido para "categoria" -->
        <button type="submit" name="submit" class="button add-button">Adicionar</button>
    </form>

    <!-- Popup e overlay para exibir mensagens -->
    <div class="overlay" id="overlay" style="display: none;"></div>
    <?php if (isset($_SESSION['mensagem'])): ?>
        <div class="popup" id="popup" style="display: block;">
            <p><?php echo $_SESSION['mensagem']; ?></p>
            <button class="close-button" onclick="closePopup()">Fechar</button>
        </div>
        <script>
            // Exibe o popup e o overlay automaticamente quando há uma mensagem
            document.getElementById('popup').style.display = 'block';
            document.getElementById('overlay').style.display = 'block';
        </script>
        <?php unset($_SESSION['mensagem']); ?>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Descrição</th>
                <th>Imagem</th>
                <th>Ações</th>
                <th>Categoria</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Exibe cada produto
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
                echo "<td>R$ " . number_format($row['preco'], 2, ',', '.') . "</td>";
                echo "<td>" . htmlspecialchars($row['descricao']) . "</td>";
                echo "<td><img src='" . htmlspecialchars($row['imagem']) . "' alt='" . htmlspecialchars($row['nome']) . "' width='100'></td>";
                echo "<td>";
                echo "<form action='editar.php' method='POST' style='display:inline;'>";
                echo "<input type='hidden' name='id' value='" . htmlspecialchars($row['id']) . "'>";
                echo "<button type='submit' class='button edit-button'>Editar</button>";
                echo "</form>";
                echo "<form action='excluir.php' method='POST' style='display:inline;'>";
                echo "<input type='hidden' name='id' value='" . htmlspecialchars($row['id']) . "'>";
                echo "<button type='submit' class='button delete-button'>Excluir</button>";
                echo "</form>";
                echo "</td>";
                echo "<td>" . htmlspecialchars($row['categoria']) . "</td>"; // Adiciona a exibição da categoria
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <script>
        function closePopup() {
            document.getElementById('popup').style.display = 'none';
            document.getElementById('overlay').style.display = 'none';
        }
    </script>
</body>
</html>
