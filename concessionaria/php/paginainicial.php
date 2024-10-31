<?php
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['contact_submit'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $mensagem = $_POST['mensagem'];

    $to = "autoperfectconcessionaria@gmail.com"; // E-mail da concessionária
    $subject = "Mensagem de Contato de $nome";
    $body = "Nome: $nome\nE-mail: $email\nMensagem: $mensagem";
    $headers = "From: $email";

    // Envia o e-mail
    if (mail($to, $subject, $body, $headers)) {
        echo "<script>alert('Mensagem enviada com sucesso!');</script>";
    } else {
        echo "<script>alert('Erro ao enviar a mensagem. Tente novamente mais tarde.');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Car Dealership</title>
    <link rel="stylesheet" href="../css/styleinicialpage.css">
    <style>
        /* Estilos para a popup */
        .icon-container {
            width: 50px;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 1px solid #000;
            border-radius: 50%;
            cursor: pointer;
            position: relative;
        }
        .icon {
            font-size: 24px;
        }
        .popup {
            display: none;
            position: absolute;
            top: 60px;
            right: 0;
            width: 200px;
            border: 1px solid #000;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            z-index: 1000;
        }
        .popup a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #000;
            border-bottom: 1px solid #ddd;
        }
        .popup a:last-child {
            border-bottom: none;
        }
        .popup a:hover {
            background-color: #f0f0f0;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>AutoPerfect</h1>
            <nav>
                <ul>
                    <li><a href="#home">Início</a></li>
                    <li><a href="#about">Sobre Nós</a></li>
                    <li><a href="exibir_carros.php">Nossos Carros</a></li>
                    <li><a href="#contact">Contato</a></li>
                    <?php if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']): ?>
                        <li><a href="../php/register.php">Agendar horário</a></li>
                    <?php endif; ?>
                    <li>
                        <div class="icon-container" onclick="togglePopup()">
                            <i class="fas fa-user icon"></i>
                            <div class="popup" id="popup">
                                <form method="POST" action="logout.php">
                                    <button type="submit">Sair da conta</button>
                                </form>
                            </div>
                        </div>                    
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    
    <section id="home" class="hero">
        <div class="container">
            <h2>Encontre o Carro dos Seus Sonhos</h2>
            <p>Explore nossa vasta seleção de carros novos e usados, com garantia e qualidade.</p>
            <a href="#cars" class="btn-primary">Veja Nossos Carros</a>
        </div>
    </section>
    
    <section id="about" class="about">
        <div class="container">
            <h2>Sobre Nós</h2>
            <p>Na AutoPerfect, estamos dedicados a oferecer a melhor experiência de compra de carros. Com uma vasta gama de veículos e um atendimento ao cliente excepcional, garantimos que você encontrará o carro perfeito para suas necessidades.</p>
        </div>
    </section>
    
    <section id="cars" class="cars">
        <div class="container">
            <h2>Nossos Carros</h2>
            <div class="car-list">
                <div class="car">
                    <img src="../img/corolla.png" alt="Carro 1">
                    <h3>Corolla</h3>
                    <p>Preço: R$ 150.000</p>
                    <a href="../html/corolla.html" class="btn-secondary">Saiba Mais</a>
                </div>
                <div class="car">
                    <img src="../img/granturismo-sport-removebg-preview.png" alt="Carro 2">
                    <h3>Maserati Gran Turismo Sport</h3>
                    <p>Preço: R$ 720.899</p>
                    <a href="../html/Maserati.html" class="btn-secondary">Saiba Mais</a>
                </div>
                <div class="car">
                    <img src="../img/bmw_1_-removebg-preview.png" alt="Carro 3">
                    <h3>BMW 320i 2024</h3>
                    <p>Preço: R$ 187.000</p>
                    <a href="../html/bmw.html" class="btn-secondary">Saiba Mais</a>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <h2>Contato</h2>
            <p>Tem alguma dúvida ou deseja mais informações? Entre em contato conosco! +55 42 90001-0000</p>
            <form method="post">
                <input type="text" name="nome" placeholder="Seu Nome" required>
                <input type="email" name="email" placeholder="Seu Email" required>
                <textarea name="mensagem" placeholder="Sua Mensagem" required></textarea>
                <button type="submit" name="contact_submit" class="btn-primary">Enviar Mensagem</button>
            </form>
        </div>
    </footer>

    <script>
        function togglePopup() {
            var popup = document.getElementById('popup');
            popup.style.display = popup.style.display === 'block' ? 'none' : 'block';
        }

        window.onclick = function(event) {
            var popup = document.getElementById('popup');
            if (!event.target.closest('.icon-container')) {
                popup.style.display = 'none';
            }
        }
    </script>
</body>
</html>
