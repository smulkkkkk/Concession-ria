<?php
session_start();
include_once('../config.php');

// Consulta para obter os produtos de cada categoria
$sql_caminhonetes = "SELECT * FROM produtos WHERE categoria='Caminhonete' LIMIT 3";
$sql_suvs = "SELECT * FROM produtos WHERE categoria='SUV' LIMIT 3";
$sql_esportivos = "SELECT * FROM produtos WHERE categoria='Esportivo' LIMIT 3";

$result_caminhonetes = $conexao->query($sql_caminhonetes);
$result_suvs = $conexao->query($sql_suvs);
$result_esportivos = $conexao->query($sql_esportivos);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoPerfect - Veículos</title>
    <link rel="stylesheet" href="../styles/modelos.css">
    <style>
        /* Estilo básico */
        body {
            transition: background-color 0.3s, color 0.3s;
            background-color: #ffffff; /* Cor de fundo claro padrão */
            color: #333; /* Cor de texto padrão */
        }

        .container { padding: 20px; }
        .category-section { margin-bottom: 50px; }
        .category-section h2 { font-size: 24px; margin-bottom: 15px; }
        .product-grid { display: flex; gap: 20px; }
        .product { text-align: center; border: 1px solid #ddd; padding: 10px; border-radius: 8px; width: 30%; }
        .product img { width: 100%; height: auto; border-radius: 8px; }
        .product h3 { font-size: 18px; margin: 10px 0; }
        .product .price { font-size: 16px; color: #333; margin-bottom: 10px; }
        .product a { color: #007bff; text-decoration: none; }
        nav { margin-bottom: 20px; }
        nav button { 
            margin: 0 10px; 
            padding: 10px 20px; 
            background-color: #007bff; 
            color: white; 
            border: none; 
            border-radius: 5px; 
            cursor: pointer; 
            font-size: 16px; 
        }
        nav button:hover { background-color: #0056b3; } /* Efeito de hover para os botões */

        /* Modo Escuro */
        body.dark-mode {
            background-color: #121212; /* Cor de fundo escuro */
            color: #ffffff; /* Cor de texto escuro */
        }

        body.dark-mode .category-section {
            background-color: #1e1e1e; /* Cor de fundo das seções em modo escuro */
        }

        body.dark-mode .product {
            border: 1px solid #444; /* Borda das caixas de produtos em modo escuro */
        }

        body.dark-mode .product a {
            color: #bb86fc; /* Cor dos links em modo escuro */
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
<body>

<nav>
    <button class="cart-button" onclick="window.location.href='../dashboard/dashboard.php'">
        <i class="fa-solid fa-car-side"></i> HOME
    </button>
    <button class="mode-button" id="mode-button" onclick="toggleMode()">
        <i class="fas fa-moon"></i>
        <span id="mode-text">MODO ESCURO</span>
    </button>
</nav>
<div class="container">

    <!-- Caminhonetes -->
    <section id="caminhonetes" class="category-section">
        <h2>Caminhonetes</h2>
        <div class="product-grid">
            <?php if ($result_caminhonetes->num_rows > 0): ?>
                <?php while ($row = $result_caminhonetes->fetch_assoc()): ?>
                    <div class="product">
                        <img src="<?php echo htmlspecialchars($row['imagem']); ?>" alt="<?php echo htmlspecialchars($row['nome']); ?>">
                        <h3><?php echo htmlspecialchars($row['nome']); ?></h3>
                        <div class="price">R$ <?php echo number_format($row['preco'], 2, ',', '.'); ?></div>
                        <a href="CAMINHONETES.php?id=<?php echo htmlspecialchars($row['id']); ?>"></a>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>Nenhuma caminhonete disponível.</p>
            <?php endif; ?>
        </div>
    </section>

    <!-- SUVs -->
    <section id="suvs" class="category-section">
        <h2>SUVs</h2>
        <div class="product-grid">
            <?php if ($result_suvs->num_rows > 0): ?>
                <?php while ($row = $result_suvs->fetch_assoc()): ?>
                    <div class="product">
                        <img src="<?php echo htmlspecialchars($row['imagem']); ?>" alt="<?php echo htmlspecialchars($row['nome']); ?>">
                        <h3><?php echo htmlspecialchars($row['nome']); ?></h3>
                        <div class="price">R$ <?php echo number_format($row['preco'], 2, ',', '.'); ?></div>
                        <a href="SUVS.php?id=<?php echo htmlspecialchars($row['id']); ?>"></a>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>Nenhum SUV disponível.</p>
            <?php endif; ?>
        </div>
    </section>

    <!-- Esportivos -->
    <section id="esportivos" class="category-section">
        <h2>Esportivos</h2>
        <div class="product-grid">
            <?php if ($result_esportivos->num_rows > 0): ?>
                <?php while ($row = $result_esportivos->fetch_assoc()): ?>
                    <div class="product">
                        <img src="<?php echo htmlspecialchars($row['imagem']); ?>" alt="<?php echo htmlspecialchars($row['nome']); ?>">
                        <h3><?php echo htmlspecialchars($row['nome']); ?></h3>
                        <div class="price">R$ <?php echo number_format($row['preco'], 2, ',', '.'); ?></div>
                        <a href="ESPORTIVOSs.php?id=<?php echo htmlspecialchars($row['id']); ?>">Ver Detalhes</a>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>Nenhum esportivo disponível.</p>
            <?php endif; ?>
        </div>
    </section>

</div>

<script>
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
        const currentTheme = themeCookie ? themeCookie.split('=')[1] : 'light-mode'; // Default para modo claro
        if (currentTheme === 'dark-mode') toggleMode();
    };

</script>
<footer>
    <div class="footer-container">
        <div class="footer-links">
            <a href="sobre-nos.php">Sobre Nós</a>
            <a href="contato.php">Contato</a>
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
