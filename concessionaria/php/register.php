<?php
session_start();

// Conecta ao banco de dados
$conexao = mysqli_connect('localhost', 'root', '', 'concessionaria');

// Verifica se a conexão foi bem-sucedida
if (!$conexao) {
    die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
}

// Inicializa variáveis de erro e sucesso
$error = '';
$success = '';

// Verifica se o formulário de login foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    // Prepara a consulta SQL
    $sql = "SELECT * FROM usuarios WHERE login = ? AND senha = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $login, $senha);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Verifica se o usuário existe
    if (mysqli_num_rows($result) > 0) {
        $res = mysqli_fetch_array($result);
        $_SESSION['nome'] = $res['nome'];
        $_SESSION['id'] = $res['id'];
        $_SESSION['adm'] = $res['adm'];
        $_SESSION['login'] = $login;

        // Redireciona para a página principal
        header("Location: paginainicial.php");
        exit;
    } else {
        $error = "Login e/ou senha incorretos!";
    }
}

// Verifica se o formulário de registro foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $username = $_POST['register-username'];
    $email = $_POST['register-email'];
    $password = $_POST['register-password'];
    $confirm_password = $_POST['confirm-password'];

    // Valida se as senhas correspondem
    if ($password !== $confirm_password) {
        $error = "As senhas não correspondem!";
    } else {
        // Insere o novo usuário no banco de dados
        $sql = "INSERT INTO usuarios (login, senha, email) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($stmt, "sss", $username, password_hash($password, PASSWORD_DEFAULT), $email); // Hash da senha

        if (mysqli_stmt_execute($stmt)) {
            $success = "Usuário registrado com sucesso!";
            header("Location: login.php"); // Redireciona para a página de login
            exit;
        } else {
            $error = "Erro ao registrar usuário: " . mysqli_error($conexao);
        }
    }
}

// Fecha a conexão com o banco de dados
mysqli_close($conexao);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
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
            <div id="register-form" style="display: block;">
                <h2>Registrar</h2>
                <p>Crie uma nova conta usando seu e-mail e senha.</p>
                <form action="register.php" method="POST">
                    <div class="form-group">
                        <label for="register-username">Usuário</label>
                        <input type="text" name="register-username" placeholder="Usuário" required>
                        <br><br>
                    </div>
                    <div class="form-group">
                        <label for="register-email">Email</label>
                        <input type="email" name="register-email" placeholder="Email" required>
                        <br><br>
                    </div>
                    <div class="form-group">
                        <label for="register-password">Senha</label>
                        <input type="password" name="register-password" placeholder="Senha" required>
                        <br><br>
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">Confirmar Senha</label>
                        <input type="password" name="confirm-password" placeholder="Confirmar Senha" required>
                        <br><br>
                        <input class="input" type="submit" name="register" value="Registrar">
                    </div>
                </form>
                <a class="toggle-link" href="login.php">Já tem uma conta? Entre</a>
            </div>
        </div>
    </div>
</body>
</html>
