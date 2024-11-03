<?php
session_start();
include_once('../config.php');

// Verifica se o usuário está logado e é um administrador
if (!isset($_SESSION['email'])) {
    header("Location: ../login.php"); // Redireciona para a página de login se não estiver logado
    exit();
}

$email = $_SESSION['email'];
$sql = "SELECT * FROM usuarios WHERE email = '$email'";
$result = $conexao->query($sql);

if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc();

    // Verifica se o usuário é administrador
    if ($user['e_admin'] != 1) {
        header("Location: ../dashboard/dashboard.php"); // Redireciona para o dashboard se não for admin
        exit();
    }
} else {
    echo "<p style='color:red;'>Erro ao verificar o usuário.</p>";
    exit();
}

// Nova consulta para buscar todos os usuários
$sql_users = "SELECT * FROM usuarios"; 
$result_users = $conexao->query($sql_users);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>ADM</title>
    <style>
        body {
            background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSnQqkwI6eh2AJX0xMF2RlvsFVM3phmNkB7vg&s');
            background-size: cover;
            background-repeat: no-repeat;
            height: 100vh;
            color: white;
            text-align: center;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 50px;
            background-color: rgba(0, 0, 0, 0.7);
        }
        .navbar img {
            height: 40px;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-size: 14px;
            font-weight: bold;
        }
        .navbar a:hover {
            text-decoration: underline;
        }
        .hero {
            position: relative;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .hero h1 {
            font-size: 50px;
            margin: 10px 0;
        }
        .hero p {
            font-size: 14px;
            margin: 10px 0;
        }
        .hero .discover {
            display: flex;
            align-items: center;
            font-size: 12px;
            margin-top: 20px;
        }
        .hero .discover i {
            margin-left: 10px;
        }
        .dots {
            position: absolute;
            bottom: 20px;
            display: flex;
            justify-content: center;
            width: 100%;
        }
        .dots span {
            height: 10px;
            width: 10px;
            background-color: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            margin: 0 5px;
            display: inline-block;
        }
        .dots .active {
            background-color: red;
        }
        .table-bg {
            background: rgba(128, 128, 128, 0.8);
            border-radius: 15px 15px 0 0;
        }
        .box-search {
            display: flex;
            justify-content: center;
            gap: .1%;
        }
        .logout-container {
            display: flex;          
            justify-content: flex-start; 
            margin-left: 20px;     
        }
        .logout-button {
            background-color: red; 
            color: white;          
            border: none;          
            padding: 10px 20px;    
            border-radius: 5px;    
            cursor: pointer;       
            font-size: 16px;      
        }
        .logout-button:hover {
            background-color: darkred; 
        }
        .dashboard-button {
            margin: 20px auto; /* Centraliza o botão */
            display: block; /* Faz o botão ser um bloco para permitir o margin auto */
            width: 200px; /* Largura fixa do botão */
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand">ADM</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <!-- Botões de navegação -->
        <a href="../dashboard/dashboard.php" class="btn btn-warning dashboard-button">Ir para dashboard</a>
        <a href="gerenciar_adm.php" class="btn btn-success dashboard-button">Cadastrar um Administrador</a>
        <a href="../produtos/lista.php" class="btn btn-success dashboard-button">Cadastrar VEÍCULOS</a>
        <a href="../produtos/msg.php" class="btn btn-success dashboard-button">
            <img src="https://images.vexels.com/media/users/3/136397/isolated/preview/375e0e784a1623517b75ea61bc1db555-icone-de-mensagem-basico.png" alt="Novas Mensagens" class="message-icon">
        </a>
        <div class="logout-container">
            <form method="POST" action="../paginadm/logoutadm.php">
                <button type="submit" name="logout" class="logout-button">Sair</button>
            </form>
        </div>
    </nav>

    <?php
        echo "<h1>Bem vindo, administrador <u>{$user['nome']}</u></h1>";
    ?>
    <br>
    <div class="box-search">
        <input type="search" class="form-control w-25" placeholder="Pesquisar" id="pesquisar">
        <button onclick="searchData()" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
        </button>
    </div>
    <div class="m-5">
        <table class="table text-white table-bg">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Senha</th>
                    <th scope="col">Email</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Data de Nascimento</th>
                    <th scope="col">Cidade</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Endereço</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Preenchendo a tabela com todos os usuários
                    while ($user_data = mysqli_fetch_assoc($result_users)) {
                        echo "<tr>";
                        echo "<td>".$user_data['id']."</td>";
                        echo "<td>".$user_data['nome']."</td>";
                        echo "<td>".$user_data['senha']."</td>";
                        echo "<td>".$user_data['email']."</td>";
                        echo "<td>".$user_data['telefone']."</td>";
                        echo "<td>".$user_data['data_nascimento']."</td>";
                        echo "<td>".$user_data['cidade']."</td>";
                        echo "<td>".$user_data['estado']."</td>";
                        echo "<td>".$user_data['endereco']."</td>";
                        echo "<td>
                                <a href='editar.php?id=".$user_data['id']."' class='btn btn-warning'>Editar</a>
                                <a href='deletar.php?id=".$user_data['id']."' class='btn btn-danger'>Deletar</a>
                              </td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>s

    <script>
        function searchData() {
            let searchValue = document.getElementById('pesquisar').value;
            window.location = 'admin.php?search=' + searchValue;
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybU00x4p8guyhYh6tqH23DnkC5dZ0Aq8bB3gVWoN18hWPMm/1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
</body>
</html>
