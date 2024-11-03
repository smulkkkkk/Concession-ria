<?php
session_start();

$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'projeto'; // Remover o caractere '-'

// Criar a conexão
$conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Verificar se houve erro na conexão
if ($conexao->connect_errno) {
    echo "Erro: " . $conexao->connect_error; // Exibe o erro de conexão
} else {
    // echo "Conexão efetuada com sucesso"; // Esta linha pode ser utilizada para testes
}
?>
