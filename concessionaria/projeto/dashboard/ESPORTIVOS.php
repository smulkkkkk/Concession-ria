<?php
// Array de SUVs disponíveis (normalmente, você pegaria esses dados de um banco de dados)
$suvs = [
    [
        'modelo' => 'BMW 320i 2024',
        'imagem' => 'https://grandbrasil.com.br/wp-content/uploads/2019/08/fa104-https-production.autoforce.com-uploads-version-profile_image-3672-model_main_comprar-320i-m-sport_25f1ac911dv2.webp',
        'preco' => 363950,
        'descricao' => 'Uma experiência de condução esportiva e sofisticada'
    ],
    [
        'modelo' => 'porsche 911 turbo s',
        'imagem' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT9Bb940Bget6l7gpP5McGkQUATANea56JFNg&s',
        'preco' => 1845000,
        'descricao' => 'Extremamente esportivo e, ao mesmo tempo, confortável e irrestritamente apto para o uso diário..'
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
        <h1>Esportivos</h1>
        <nav>
            <a href="dashboard.php">Home</a>
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
        <p>&copy; 2024 AutoPerfect. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
