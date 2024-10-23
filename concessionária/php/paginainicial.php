<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Dealership</title>
    <link rel="stylesheet" href="styleinicialpage.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>AutoPerfect</h1>
            <nav>
                <ul>
                    <li><a href="#home">Início</a></li>
                    <li><a href="#about">Sobre Nós</a></li>
                    <li><a href="#cars">Nossos Carros</a></li>
                    <li><a href="#contact">Contato</a></li>
                    <li><a href="register.php">Login</a></li>
                    <li><a href="carrinho_de_compras.html">Carrinho <img src="https://cdn-icons-png.flaticon.com/512/126/126510.png" alt="Ícone do Carrinho" class="nav-icon"></a></li>
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

    <?php if (isset($_SESSION['nome'])): ?>
        <section id="welcome" class="welcome">
            <div class="container">
                <h2>Bem-vindo, <?php echo $_SESSION['nome']; ?>!</h2>
                <p>Você está logado.</p>
            </div>
        </section>
    <?php endif; ?>

    <section id="about" class="about">
        <div class="container">
            <h2>Sobre Nós</h2>
            <p>Na AutoPerfect, estamos dedicados a oferecer a melhor experiência de compra de carros. Com uma vasta gama de veículos e um atendimento ao cliente excepcional, garantimos que você encontrará o carro perfeito para suas necessidades.</p>
        </div>
    </section>
    
    <section id="cars" class="cars">
        <div class="container">
            <h2>Nossos Carros</h2>
            <!-- Adicione aqui a lista de carros como você já fez -->
        </div>
    </section>
    
    <section id="contact" class="contact">
        <div class="container">
            <h2>Contato</h2>
            <p>Tem alguma dúvida ou deseja mais informações? Entre em contato conosco! 42 +55 90001-0000</p>
            <form>
                <input type="text" placeholder="Seu Nome" required>
                <input type="email" placeholder="Seu Email" required>
                <textarea placeholder="Sua Mensagem" required></textarea>
                <button type="submit" class="btn-primary">Enviar Mensagem</button>
            </form>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2024 AutoPerfect.</p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>
