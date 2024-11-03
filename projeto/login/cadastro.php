<?php
session_start();
if (isset($_POST['submit'])) {
    include_once('../config.php');
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Criptografa a senha
    $telefone = $_POST['telefone'];
    $data_nascimento = $_POST['data_nascimento'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $endereco = $_POST['endereco'];

    $query = "INSERT INTO usuarios (nome, senha, email, telefone, data_nascimento, cidade, estado, endereco)
              VALUES ('$nome', '$senha', '$email', '$telefone', '$data_nascimento', '$cidade', '$estado', '$endereco')";

    $result = mysqli_query($conexao, $query);

    if ($result) {
        header('Location: ../login/login.php');
        exit();
    } else {
        echo "Erro ao cadastrar usuário: " . mysqli_error($conexao);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Clientes</title>
    <style>
 body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #e0f2f1;
        }
        .container {
            width: 1000px;
            height: 600px;
            display: flex;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }
        .left-panel, .right-panel {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .left-panel {
            background-color: #4db6ac;
            color: white;
        }
        .left-panel h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }
        .left-panel p {
            font-size: 14px;
            margin-bottom: 20px;
        }
        .left-panel button {
            background-color: white;
            color: #4db6ac;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 14px;

        }
        .right-panel {
            background-color: white;
        }
        .right-panel h2 {
            font-size: 24px;
            color: #4db6ac;
            margin-bottom: 20px;
        }
        .right-panel p {
            font-size: 14px;
            color: #b0bec5;
            margin-bottom: 20px;
        }
        .input-group {
            width: 100%;
            margin-bottom: 15px;
            position: relative;
        }
        .input-group input {
            width: 100%;
            padding: 10px 10px 10px 30px;
            border: 1px solid #b0bec5;
            border-radius: 5px;
            font-size: 14px;
        }
        .input-group i {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #b0bec5;
        }
        .right-panel button {
            background-color: #4db6ac;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 14px;
            
        }
    </style>
    <script>
        function validateEmail() {
            const emailField = document.getElementById("email");
            const errorText = document.getElementById("emailError");
            const emailValue = emailField.value;

            if (!emailValue.endsWith("@gmail.com")) {
                errorText.textContent = "O email deve ser do domínio @gmail.com";
                emailField.style.borderBottom = "1px solid red";
                return false;
            } else {
                errorText.textContent = "";
                emailField.style.borderBottom = "1px solid white";
                return true;
            }
        }

        function validateForm() {
            return validateEmail();
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="left-panel">
            <h2>Bom te ver novamente!</h2>
            <a href="login.php" style="text-decoration: none;">
                 <button>LOGIN</button>
            </a>

        </div>
        <div class="right-panel">
            <h2>CRIE SUA CONTA</h2>

            <form action="" method="POST">
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="nome" placeholder="Nome" required>
                </div>
                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="senha" placeholder="Senha" required>
                </div>
                <div class="input-group">
                    <i class="fas fa-phone"></i>
                    <input type="tel" name="telefone" placeholder="Telefone" required>
                </div>
                <div class="input-group">
                    <i class="fas fa-calendar-alt"></i>
                    <input type="date" name="data_nascimento" required>
                </div>
                <div class="input-group">
                    <i class="fas fa-city"></i>
                    <input type="text" name="cidade" placeholder="Cidade" required>
                </div>
                <div class="input-group">
                    <i class="fas fa-map-marker-alt"></i>
                    <input type="text" name="estado" placeholder="Estado" required>
                </div>
                <div class="input-group">
                    <i class="fas fa-home"></i>
                    <input type="text" name="endereco" placeholder="Endereço" required>
                </div>
                <button type="submit" name="submit">CADASTRAR</button>
            </form>
        </div>
    </div>
</body>
</html>
