<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

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
        .left, .right {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .left {
            background-color: #4db6ac;
            color: white;
            text-align: center;
        }
        .left h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }
        .left p {
            font-size: 14px;
            margin-bottom: 20px;
        }
        .left .left-panel {
            text-align: center;
        }
        .left .left-panel h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .left .left-panel button {
            background-color: white;
            color: #4db6ac;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 14px;
        }
        .right {
            background-color: white;
        }
        .right h2 {
            font-size: 24px;
            color: #4db6ac;
            margin-bottom: 20px;
        }
        .right p {
            font-size: 14px;
            color: #b0bec5;
            margin-bottom: 20px;
        }
        .form-group {
            width: 100%;
            margin-bottom: 15px;
            position: relative;
            display: flex;
            align-items: center;
        }
        .form-group input {
            width: 100%;
            padding: 10px 10px 10px 30px;
            border: 1px solid #b0bec5;
            border-radius: 5px;
            font-size: 14px;
        }
        .form-group label {
            margin-right: 10px;
            color: #b0bec5;
        }
        .right .input {
            background-color: #4db6ac;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 14px;
            display: block;
            margin: 0 auto;
        }
        .error {
            color: red;
            font-size: 12px;
        }
        .logo-site {
            width: 100px;
            height: auto;
            margin-bottom: 20px;
        }
    </style>
    <script>
        function validateEmail() {
            const emailField = document.getElementById("email");
            const errorText = document.getElementById("emailError");
            const emailValue = emailField.value;

            if (!emailValue.endsWith("@gmail.com")) {
                errorText.textContent = "O email deve ser do domínio @gmail.com";
                emailField.setCustomValidity("O email deve ser do domínio @gmail.com");
            } else {
                errorText.textContent = "";
                emailField.setCustomValidity(""); // Limpa a mensagem de erro
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="left">
            <div class="left-content">
                <h1>AutoPerfect</h1>

                <div class="left-panel">
                    <h2>Não tem uma conta?</h2>
                    <a href="cadastro.php" style="text-decoration: none;">
                        <button>CADASTRE-SE</button>
                    </a>
                </div>
            </div>
        </div>
        <div class="right">
            <h2>Entrar</h2>
            <p>Acesse o painel usando seu e-mail e senha.</p>
            <form action="../login/testlogin.php" method="POST">
                <div class="form-group">
                    <label for="email">Login</label>
                    <input type="text" name="email" id="email" placeholder="Email" required oninput="validateEmail()">
                    <span id="emailError" class="error"></span>
                </div>
                <div class="form-group">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" placeholder="Senha" required>
                </div>
                <input class="input" type="submit" name="submit" value="Enviar">
            </form>
        </div>
    </div>
</body>
</html>
