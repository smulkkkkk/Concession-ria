<?php
// Array de SUVs disponíveis (normalmente, você pegaria esses dados de um banco de dados)
$suvs = [
    [
        'modelo' => 'Toyota RAV4',
        'imagem' => 'https://app.empresasmaggi.com.br/dashboard/galeria/versoes/48bbebc4c1fc677170c4ec843bad3eaf.webp',
        'preco' => 175000,
        'descricao' => 'Um SUV confiável e espaçoso, ideal para famílias.'
    ],
    [
        'modelo' => 'Honda CR-V',
        'imagem' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTQMfyGxQjEh4nd3Kpc-NjowoP4uiWV9I-lOw&s',
        'preco' => 190000,
        'descricao' => 'Conforto e tecnologia em um só lugar.'
    ],
    [
        'modelo' => 'BMW X6 2024',
        'imagem' => 'https://grandbrasil.com.br/wp-content/uploads/2023/10/bmw-x6-m.webp',
        'preco' =>  820950,
        'descricao' => 'SUV de luxo robusto e elegante.'
    ],
    [
        'modelo' => 'Chevrolet Tracker',
        'imagem' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcThHnHoV8CExPJIkTaeljneYG7kU_c1BCtXzg&s',
        'preco' => 150000,
        'descricao' => 'Design moderno e eficiente.'
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
        <h1>SUVs</h1>
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
    <p>&copy; 2024 AutoPerfect. Todos os direitos reservados.</p>    </footer>
</body>
</html>
