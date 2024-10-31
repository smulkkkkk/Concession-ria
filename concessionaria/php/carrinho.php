<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "loja";

// Cria conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Função para exibir os produtos
function exibirProdutos($conn) {
    $sql = "SELECT * FROM produtos";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<div class='produto'>";
            echo "<h2>" . $row["nome"]. "</h2>";
            echo "<p>Preço: R$" . $row["preco"]. "</p>";
            echo "<a href='?pagina=carrinho&id=" . $row["id"]. "' class='botao'>Adicionar ao Carrinho</a>";
            echo "</div>";
        }
    } else {
        echo "<p>Nenhum produto encontrado.</p>";
    }
}

// Verifica a página atual
$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 'index';

// Exibe a página atual
if ($pagina == 'index') {
    echo "<h1>Produtos</h1>";
    exibirProdutos($conn);
} elseif ($pagina == 'carrinho') {
    // Aqui você pode incluir a lógica do carrinho, se necessário
} else {
    echo "<p>Página não encontrada.</p>";
}

$conn->close();
?>

<link rel="stylesheet" type="text/css" href="style.css">