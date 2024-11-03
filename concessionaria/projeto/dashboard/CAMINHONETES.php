<?php
// Array de SUVs disponíveis (normalmente, você pegaria esses dados de um banco de dados)
$suvs = [
    [
        'modelo' => ' Chevrolet s10 2025',
        'imagem' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSLjCeDzi2ZN8NbtGBHjyDRgRt_JUZ8boJ1gQ&s',
        'preco' => 236690,
        'descricao' => 'ela traz tudo para as suas viagens em família. '
    ],
    [
        'modelo' => 'Toyota Hilux SRX Plus 2024',
        'imagem' => 'https://production.autoforce.com/uploads/version/profile_image/9645/model_main_webp_comprar-srx-4x4-plus-automatico_2954f50b2c.png.webp',
        'preco' => 334890,
        'descricao' => 'Acerto de suspensão próprio'
    ],

];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style.css">
<style>
 body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

header {
    background-color: #35424a;
    color: white;
    padding: 15px 0;
    text-align: center;
}

header nav {
    margin-top: 10px;
}

header nav a {
    color: white;
    text-decoration: none;
    margin: 0 15px;
}

header nav a:hover {
    text-decoration: underline;
}

main {
    padding: 20px;
}

.suv-list {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}

.suv-card {
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    margin: 10px;
    padding: 15px;
    width: 200px;
    text-align: center;
}

.suv-card img {
    width: 100%;
    border-radius: 10px;
}

.suv-card h3 {
    font-size: 18px;
    margin: 10px 0;
}

.suv-card p {
    font-size: 14px;
    color: #666;
}

.btn {
    background-color: #35424a;
    color: white;
    padding: 10px 15px;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.btn:hover {
    background-color: #2c3e50;
}

footer {
    text-align: center;
    padding: 10px 0;
    background-color: #35424a;
    color: white;
    position: relative;
    bottom: 0;
    width: 100%;
}
</style>
</head>
<body>
    <header>
        <h1>CAMINHONETES</h1>
        <nav>
        <a href="cotacao.php">solicitar cotação</a>
        </nav>
    </header>

    <main>
        <section id="suvs">
            <h2>Modelos Disponíveis</h2>
            <div class="suv-list">
                <?php foreach ($suvs as $suv): ?>
                    <div class="suv-card">
                        <img src="<?php echo $suv['imagem']; ?>" alt="<?php echo $suv['modelo']; ?>">
                        <h3><?php echo $suv['modelo']; ?></h3>
                        <p>Preço: R$ <?php echo number_format($suv['preco'], 2, ',', '.'); ?></p>
                        <p><?php echo $suv['descricao']; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>

    <footer>
    <p>&copy; 2024 AutoPerfect. Todos os direitos reservados.</p>    </footer>
</body>
</html>
