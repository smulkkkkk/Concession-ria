<?php
session_start();
include_once('../config.php');

// Verifica se o usuário está logado
if (!isset($_SESSION['email'], $_SESSION['senha'])) {
    unset($_SESSION['email'], $_SESSION['senha']);
}

// Consulta para obter todos os produtos
$sql = "SELECT * FROM produtos ORDER BY id DESC";
$result = $conexao->query($sql);

// Define o modo padrão com base no cookie
$theme = $_COOKIE['theme'] ?? 'dark-mode';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoPerfect</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="../styles/dash.css">
    <style>
        /* Estilos gerais */
        body.dark-mode {
            background-color: #121212;
            color: #ffffff;
        }
        .show {
            display: block;
        }
        .departments-button, .cart-button, .support-button {
            padding: 10px 20px;
            border-radius: 25px;
            background-color: #f0ad4e;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .departments-button:hover, .cart-button:hover, .support-button:hover {
            background-color: #d89b2e;
        }
        .search-bar {
            padding: 10px;
            border-radius: 25px;
            border: 1px solid #ccc;
            width: 300px;
            transition: border-color 0.3s;
        }
        .search-bar:focus {
            border-color: #f0ad4e;
            outline: none;
        }
        /* Seção Hero */
        .hero {
            background-image: url('sua-imagem-de-fundo.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 60px 0;
            text-align: center;
        }
        .hero .container {
            max-width: 800px;
            margin: 0 auto;
        }
        .hero h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }
        .hero p {
            font-size: 1.2rem;
        }
        /* Seção Sobre Nós */
        section {
            padding: 40px 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        h2 {
            font-size: 2rem;
            margin-bottom: 15px;
            color: white;
            text-align: center;
        }
        p {
            font-size: 1rem;
            color: white;
            line-height: 1.5;
        }
        /* Estilos de Resposta (Opcional) */
        @media (max-width: 768px) {
            .hero h2 {
                font-size: 2rem;
            }
            .hero p {
                font-size: 1rem;
            }
            h2 {
                font-size: 1.5rem;
            }
        }
        /* Novo CSS para a animação do carro giratório */
        .car-container {
    display: flex; /* Usar flexbox para centralização */
    justify-content: center; 
    align-items: center; 
    height: 80vh; 
    margin: 0 auto; 
    perspective: 10000px; 
}

.car {
    width: 600px; /* Aumentado de 400px para 600px */
    animation: spin 4s linear infinite; 
    transform-style: preserve-3d; 
}
        @keyframes spin {
            0% { transform: rotateY(0deg); }
            50% { transform: rotateY(180deg); }
            100% { transform: rotateY(360deg); }
        }
footer {
    background-color: #121212; /* Cor de fundo escura para o modo escuro */
    color: #ffffff;
    padding: 20px 0;
    text-align: center;
}

.footer-container {
    max-width: 800px;
    margin: 0 auto;
}

.footer-links {
    margin-bottom: 10px;
}

.footer-links a {
    color: #f0ad4e; /* Cor dos links */
    text-decoration: none;
    margin: 0 15px;
}

.footer-links a:hover {
    text-decoration: underline; /* Sublinha ao passar o mouse */
}

.footer-info {
    font-size: 0.9rem; /* Tamanho da fonte */
}

    </style>
</head>
<body class="<?php echo htmlspecialchars($theme); ?>">

<header class="header">
    <div class="dropdown" style="display: flex; align-items: center; justify-content: space-between; width: 100%;">
        <input type="text" class="search-bar" placeholder="Digite o modelo que procura..." style="margin-right: 10px;">
        <button class="cart-button" onclick="window.location.href='../dashboard/pagina-veiculo.php'">
            <i class="fa-solid fa-car-side"></i> Acesse Todos os Modelos
        </button>

        <!-- Verificação se o usuário está logado antes de exibir o botão de agendamento -->
        <?php if (isset($_SESSION['email'])): ?>
            <button class="cart-button" style="margin-left: 10px;" onclick="window.location.href='../dashboard/agendamentos.php'">
                FAÇA SEU AGENDAMENTO
            </button>
        <?php endif; ?>

        <nav class="menu" style="margin-left: auto;">
            <div class="menu-buttons" style="display: flex; align-items: center; gap: 15px;">
                <a href="contato.php" class="support-button"><i class="fas fa-headset"></i> MANDE UMA MENSAGEM</a>
                <button class="mode-button" id="mode-button" onclick="toggleMode()">
                    <i class="fas fa-moon"></i>
                    <span id="mode-text">MODO ESCURO</span>
                </button>
                <div class="user-menu-container">
                    <button class="menu-button"><i class="fas fa-user"></i></button>
                    <div class="dropdown-menu">
                        <?php if (!isset($_SESSION['email'])): ?>
                            <button onclick="window.location.href='../login/login.php'">Login</button>
                            <button onclick="window.location.href='../login/cadastro.php'">Cadastro</button>
                        <?php else: ?>
                            <form method="POST" action="../login/logout.php">
                                <button type="submit" name="logout">Sair</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>


<div class="container2">
    <div class="header2">
        <h1>VEÍCULOS EM DESTAQUE</h1>
    </div>
    <button class="nav-button left" onclick="scrollLeft()">
        <i class="fas fa-chevron-left"></i>
    </button>
    <div class="product-grid" id="product-grid">
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <a class="product" href="pagina-veiculo.php?id=<?php echo htmlspecialchars($row['id']); ?>">
                    <img alt="<?php echo htmlspecialchars($row['nome']); ?>" src="<?php echo htmlspecialchars($row['imagem']); ?>"/>
                    <h2><?php echo htmlspecialchars($row['nome']); ?></h2>
                    <div class="price">R$ <?php echo number_format($row['preco'], 2, ',', '.'); ?></div>
                    <div class="discount">à vista com 10% desconto</div>
                    <div class="installments">em até 36x de R$ <?php echo number_format($row['preco'] / 36, 2, ',', '.'); ?> sem juros no cartão</div>
                </a>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Nenhum veículo encontrado.</p>
        <?php endif; ?>
    </div>
    <button class="nav-button right" onclick="scrollRight()">
        <i class="fas fa-chevron-right"></i>
    </button>
</div>

<script>
    function scrollLeft() {
        document.getElementById('product-grid').scrollBy({ left: -200, behavior: 'smooth' });
    }

    function scrollRight() {
        document.getElementById('product-grid').scrollBy({ left: 200, behavior: 'smooth' });
    }

    function toggleMode() {
        const body = document.body;
        const modeText = document.getElementById('mode-text');
        const icon = document.getElementById('mode-button').querySelector('i');
        
        body.classList.toggle('dark-mode');
        const isDarkMode = body.classList.contains('dark-mode');

        modeText.textContent = isDarkMode ? 'MODO CLARO' : 'MODO ESCURO';
        icon.classList.toggle('fa-moon', !isDarkMode);
        icon.classList.toggle('fa-sun', isDarkMode);

        document.cookie = `theme=${isDarkMode ? 'dark-mode' : 'light-mode'}; path=/; max-age=${365 * 24 * 60 * 60}`;
    }

    window.onload = function() {
        const themeCookie = document.cookie.split('; ').find(row => row.startsWith('theme='));
        const currentTheme = themeCookie ? themeCookie.split('=')[1] : 'dark-mode';
        if (currentTheme === 'light-mode') toggleMode();
    };
</script>

<section id="home" class="hero">
    <div class="container">
        <h2>Encontre o Carro dos Seus Sonhos</h2>
        <p>Explore nossa vasta seleção de carros novos, com garantia e qualidade.</p>
    </div>
</section>

<section>
    <div class="container">
        <h2>Sobre Nós</h2>
        <p>Na AutoPerfect, estamos dedicados a oferecer a melhor experiência de compra de carros. Com uma vasta gama de veículos e um atendimento ao cliente excepcional, garantimos que você encontrará o carro perfeito para suas necessidades.</p>
    </div>
</section>

<!-- Nova seção para o carro giratório -->
<div class="car-container">
    <img src="https://files.porsche.com/filestore/image/multimedia/none/992-tus-modelexplorer-01/normal/308346f4-b15c-11ea-80ca-005056bbdc38;sS;twebp/porsche-normal.webp" alt="Carro Giratório" class="car" />
</div>

<div class="dots">
    <span class="active" onclick="currentSlide(0)"></span>
    <span onclick="currentSlide(1)"></span>
    <span onclick="currentSlide(2)"></span>
</div>
<footer>
    <div class="footer-container">
        <div class="footer-links">
            <a href="sobre-nos.php">Sobre Nós</a>
            <a href="fale-conosco.php">Contato</a>
            <a href="politica-privacidade.php">Política de Privacidade</a>
            <a href="termos-servico.php">Termos de Serviço</a>
        </div>
        <div class="footer-info">
            <p>&copy; 2024 AutoPerfect. Todos os direitos reservados.</p>
        </div>
    </div>
</footer>
</body>
</html>
