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
        header("Location: paginainicial.html");
        exit;
    } else {
        $error = "Login e/ou senha incorretos!";
    }
}

// Verifica se o formulário de registro foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
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
            header("Location: register.php");
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
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="popup" id="register-popup">
        <h2>Registrar</h2>
        <form action="register.php" method="POST">
            <label for="username">Usuário:</label>
            <input type="text" id="username" name="username" required><br><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>
            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required><br><br>
            <label for="confirm-password">Confirmar Senha:</label>
            <input type="password" id="confirm-password" name="confirm-password" required><br><br>
            <button type="submit" name="register">Registrar</button>
        </form>
        <?php if (isset($error)) : ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <?php if (isset($success)) : ?>
            <p style="color: green;"><?php echo $success; ?></p>
        <?php endif; ?>
    </div>

    <script src="script.js"></script>
</body>
</html>
