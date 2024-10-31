<?php
session_start();

if(isset($_POST['logout'])) {
    session_destroy();
    header('Location: register.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Você saiu de sua conta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
        }
        h1 {
            color: #333;
        }
        a {
            text-decoration: none;
            color: #007BFF;
            margin: 10px 0;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Você saiu de sua conta.</h1>
    <p>Gostaria de ir para a página inicial ou registrar-se?</p>
    <a href="paginainicial.php">Página Inicial</a>
    <a href="register.php">Registrar-se</a>
</body>
</html>