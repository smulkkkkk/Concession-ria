<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Lógica de validação do login
    if ($email === "usuario@example.com" && $senha === "senha") { // Exemplo de validação
        $_SESSION['loggedin'] = true;
        header("Location: agenda.php"); // Redireciona para a página de agendar horário
        exit;
    } else {
        echo "<script>alert('Credenciais inválidas. Tente novamente.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/stylelogin.css">
</head>
<body>
    <div class="container">
        <div class="left">
            <div class="left-content">
                <h1>AutoPerfect</h1>
            </div>  
        </div>
        <div class="right">
            <h2>Entrar</h2>
            <p>Acesse o painel do usando seu e-mail e senha.</p>
            <form action="testlogin.php" method="POST">
    <div class="form-group">
        <label for="login">Login</label>
        <input type="text" name="email" placeholder="Email" required>
        <br><br>
    </div>
    <div class="form-group">
        <input type="password" name="senha" placeholder="Senha" required>
        <br><br>
        <input class="input" type="submit" name="submit" value="Enviar">
        <a class="toggle-link" href="register.php">Não possui uma conta? Registre-se</a>
    </div>
</form>
</body>
</html>