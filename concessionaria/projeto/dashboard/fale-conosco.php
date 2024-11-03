<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoPerfect</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
            color: #333;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #fff;
            border-bottom: 1px solid #ddd;
        }
        .header img {
            height: 40px;
        }
        .header nav {
            display: flex;
            gap: 20px;
            position: relative; /* Adicionando posição relativa ao nav */
        }
        .header nav a {
            text-decoration: none;
            color: #333;
            font-size: 14px;
            cursor: pointer; /* Mudar o cursor para indicar que é clicável */
        }
        .main {
            position: relative;
            text-align: center;
            color: white;
        }
        .main img {
            width: 100%;
            height: auto;
        }
        .main .text {
            position: absolute;
            top: 10px; /* Ajuste para o canto superior */
            left: 10px; /* Ajuste para o canto esquerdo */
            transform: translateY(0); /* Remove o efeito de centralização */
            font-size: 36px;
            font-weight: bold;
            color: #fff; /* Ajuste de cor para o texto */
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 20px;
        }
        .card {
            width: 30%;
            padding: 20px;
            box-sizing: border-box;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-align: center;
            transition: transform 0.3s;
        }
        .card:hover {
            transform: scale(1.05); /* Efeito de hover */
        }
        .card i {
            font-size: 40px;
            margin-bottom: 10px;
        }
        .card h3 {
            font-size: 18px;
            margin: 10px 0;
            text-transform: uppercase;
        }
        .card p {
            font-size: 14px;
            line-height: 1.5;
            margin: 10px 0;
        }
        .card a {
            display: block;
            margin: 10px 0;
            color: #007bff;
            text-decoration: none;
            font-size: 14px;
        }
        .card a:hover {
            text-decoration: underline;
        }
        .whatsapp i {
            color: #25D366;
        }
        .email i, .recalls i, .financial i, .roadservice i {
            color: #D4AF37;
        }
        .phone i {
            color: #D4AF37;
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
        /* Estilo para o pop-up */
        .popup {
            display: none; /* Inicialmente escondido */
            position: fixed; /* Para centralizar na tela */
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%); /* Centraliza o pop-up */
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            z-index: 1000; /* Fica acima de outros elementos */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .popup a {
            display: block;
            color: #007bff;
            text-decoration: none;
            margin: 5px 0;
        }
        .popup a:hover {
            text-decoration: underline; /* Sublinha ao passar o mouse */
        }
        .close-popup {
            cursor: pointer;
            font-size: 16px;
            color: #f00; /* Cor do botão de fechar */
            float: right; /* Posiciona o botão no canto superior direito */
        }
    </style>
</head>
<body>

<div class="header">
    <nav>
        <a href="#" id="services-link">Serviços <i class="fas fa-caret-down"></i></a>
        <a href="dashboard.php">HOME</a>
    </nav>
</div>

<div class="main">
    <img src="https://img.freepik.com/fotos-premium/supercarro-elegante_81048-14317.jpg" alt="Carro Elegante">
    <div class="text">CENTRAL DE RELACIONAMENTO</div>
</div>

<!-- Seção de Agendamento -->
<div class="container">
    <div class="card whatsapp">
        <i class="fab fa-whatsapp"></i>
        <h3>Whatsapp AutoPerfect</h3>
        <p>Fale com a gente através do Atendimento AutoPerfect no WhatsApp e tire suas dúvidas</p>
        <a href="https://wa.me/554201589933"><i class="fas fa-external-link-alt"></i> Falar com atendimento AutoPerfect</a>
    </div>
    <div class="card email">
        <i class="fas fa-envelope"></i>
        <h3>Escreva pra gente</h3>
        <p>Tem alguma dúvida ou não encontrou o que procurava em nosso site? Entre em contato com a gente, que teremos o maior prazer em ajudar.</p>
        <a href="contato.php"><i class="fas fa-external-link-alt"></i> E-mail AutoPerfect</a>
    </div>
    <div class="card phone">
        <i class="fas fa-phone"></i>
        <h3>Telefone</h3>
        <p>Fale com a nossa central de atendimento, ligue 0800 000 0000 de segunda a sexta, das 08h às 18h (exceto feriados nacionais)</p>
    </div>
</div>

<!-- Pop-up para agendamento -->
<div class="popup" id="popup">
    <span class="close-popup" id="close-popup">&times;</span> <!-- Botão para fechar -->
    <h3>Agendar Horário</h3>
    <a href="agendamento.php" id="schedule-link">Clique aqui para Agendar</a> <!-- Link para a página de agendamento -->
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

<script>
    // Script para mostrar/ocultar o pop-up de agendamento
    const servicesLink = document.getElementById('services-link');
    const popup = document.getElementById('popup');
    const closePopup = document.getElementById('close-popup');

    // Exibir pop-up ao clicar no link "Serviços"
    servicesLink.addEventListener('click', function(event) {
        event.preventDefault(); // Impede o comportamento padrão do link
        popup.style.display = 'block'; // Mostra o pop-up
    });

    // Fechar o pop-up ao clicar no botão de fechar
    closePopup.addEventListener('click', function() {
        popup.style.display = 'none'; // Esconde o pop-up
    });

    // Fechar o pop-up ao clicar fora dele
    window.addEventListener('click', function(event) {
        if (event.target === popup) {
            popup.style.display = 'none'; // Esconde o pop-up
        }
    });
</script>

</body>
</html>
