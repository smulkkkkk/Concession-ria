<?php
session_start();
include_once('../config.php');

// Verifica se o usuário está logado e é um administrador
if (!isset($_SESSION['email']) || !isset($_SESSION['senha'])) {
    echo "<p style='color:red;'>Você precisa estar logado para acessar esta página.</p>";
    exit;
}

$email = $_SESSION['email'];
$sql = "SELECT * FROM usuarios WHERE email = '$email'";
$result = $conexao->query($sql);
$user = $result->fetch_assoc();

// Verifica se o usuário logado é um administrador
if ($user['e_admin'] != 1) {
    echo "<p style='color:red;'>Acesso negado: apenas administradores podem acessar esta página.</p>";
    exit;
}

// Processa o formulário para adicionar um novo administrador
if (isset($_POST['adicionar_adm'])) {
    $novo_adm_email = $_POST['novo_adm_email'];

    // Verifica se o email existe no sistema
    $sqlCheck = "SELECT * FROM usuarios WHERE email = '$novo_adm_email'";
    $resultCheck = $conexao->query($sqlCheck);

    if ($resultCheck && $resultCheck->num_rows > 0) {
        // Define o usuário como administrador
        $sqlUpdate = "UPDATE usuarios SET e_admin = 1 WHERE email = '$novo_adm_email'";
        if ($conexao->query($sqlUpdate) === TRUE) {
            echo "<p style='color:green;'>O usuário com o email $novo_adm_email foi promovido a administrador com sucesso.</p>";
        } else {
            echo "<p style='color:red;'>Erro ao promover o usuário.</p>";
        }
    } else {
        echo "<p style='color:red;'>Email não encontrado.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Administradores</title>
    <style>
    body {
            background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSnQqkwI6eh2AJX0xMF2RlvsFVM3phmNkB7vg&s');
            background-size: cover;
            background-repeat: no-repeat;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .container {
            background-color: rgba(0, 0, 0, 0.8);
            padding: 30px;
            border-radius: 10px;
            width: 100%;
            max-width: 400px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .container h1 {
            font-size: 24px;
            color: #ffcc00;
            margin-bottom: 20px;
        }

        .container label {
            font-size: 16px;
            color: #e0e0e0;
            margin-bottom: 10px;
            display: block;
            text-align: center;
            width: 100%;
        }

        .container input[type="email"] {
            padding: 10px;
            width: calc(100% - 22px); /* Adjust width to account for padding */
            margin-bottom: 15px;
            border: 1px solid #b0bec5;
            border-radius: 5px;
            font-size: 14px;
            background-color: #ffffff;
            color: #333333;
            box-sizing: border-box;
        }

        .container button {
            background-color: #4db6ac;
            color: #ffffff;
            border: none;
            padding: 10px 0;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
            width: 100%;
            margin-top: 10px;
        }

        .container button:hover {
            background-color: #388e7b;
        }

        .message {
            padding: 10px;
            width: calc(100% - 20px); /* Adjust width to account for padding */
            margin: 15px auto;
            border-radius: 5px;
            font-size: 14px;
            text-align: center;
            box-sizing: border-box;
        }

        .error {
            background-color: #ffebee;
            color: #d32f2f;
        }

        .success {
            background-color: #e8f5e9;
            color: #388e3c;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Gerenciar Administradores</h1>
        <form method="POST" action="">
            <label for="novo_adm_email">Email do novo administrador:</label>
            <input type="email" name="novo_adm_email" id="novo_adm_email" required>
            <button type="submit" name="adicionar_adm">Adicionar Administrador</button>
        </form>
        <a href="ADM.php" style="text-decoration: none;">
           <button>Voltar a página de ADM</button>
            </a>
    </div>
</body>
</html>
