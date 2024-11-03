<?php
session_start();
if (isset($_POST['submit'])) {
    include_once('../config.php');
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $descricao = $_POST['descricao'];
    $imagem = $_POST['imagem'];

    // Corrigido: Removida a vírgula extra
    $query = "INSERT INTO produtos (nome, preco, descricao, imagem) VALUES ('$nome', '$preco', '$descricao', '$imagem')";
    $result = mysqli_query($conexao, $query);

    // Verifica se a inserção foi bem-sucedida
    if ($result) {
        header('Location: lista.php');
    } else {
        echo "Erro ao cadastrar produto: " . mysqli_error($conexao);
    }
}
?>
