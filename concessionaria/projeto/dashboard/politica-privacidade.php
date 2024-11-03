<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Política de Privacidade - AutoPerfect</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f7f7f7;
            color: #333;
            transition: background-color 0.3s, color 0.3s;
        }

        .header {
            background-color: #007bff; /* Cor de fundo do cabeçalho */
            color: white;
            padding: 10px 20px;
            text-align: center;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header nav {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .header nav a {
            color: white;
            text-decoration: none;
        }

        h1, h2, h3 {
            color: #007bff; /* Cor dos títulos */
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        h2 {
            font-size: 20px;
            margin-top: 30px;
        }

        h3 {
            font-size: 18px;
            margin-top: 20px;
        }

        p {
            font-size: 16px;
            line-height: 1.5;
            margin: 10px 0;
        }

        ul {
            margin: 10px 0;
            padding-left: 20px;
        }

        footer {
            background-color: #121212; /* Cor de fundo escura para o rodapé */
            color: #ffffff;
            padding: 20px 0;
            text-align: center;
            margin-top: 20px;
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

        /* Estilos para o modo escuro */
        .dark-mode {
            background-color: #121212;
            color: #ffffff;
        }

        .dark-mode .header {
            background-color: #007bff; /* Mantém o cabeçalho em azul */
        }

        .dark-mode .footer {
            background-color: #1a1a1a; /* Um pouco mais claro para o rodapé */
        }
    </style>
</head>
<body>
    <div class="header">
        <nav>
            <a href="#" id="services-link">Serviços <i class="fas fa-caret-down"></i></a>
            <a href="dashboard.php">HOME</a>
        </nav>
        <button class="mode-button" id="mode-button" onclick="toggleMode()">
            <i class="fas fa-moon"></i>
            <span id="mode-text">MODO ESCURO</span>
        </button>
    </div>

    <h1>Política de Privacidade da AutoPerfect</h1>

    <p>A sua privacidade é importante para nós. Esta política de privacidade explica como coletamos, usamos, divulgamos e protegemos as suas informações pessoais quando você utiliza nossos serviços.</p>

    <h2>Informações que Coletamos</h2>
    <p>Coletamos diferentes tipos de informações, incluindo:</p>
    <ul>
        <li><strong>Informações Pessoais:</strong> Nome, endereço de e-mail, telefone e outras informações que você nos fornece.</li>
        <li><strong>Dados de Uso:</strong> Informações sobre como você utiliza nossos serviços e interage com nosso site.</li>
        <li><strong>Cookies:</strong> Dados que são enviados para o seu navegador a partir de nossos servidores e armazenados no seu dispositivo.</li>
    </ul>

    <h2>Como Usamos suas Informações</h2>
    <p>Utilizamos suas informações para:</p>
    <ul>
        <li>Fornecer, manter e melhorar nossos serviços;</li>
        <li>Compreender e analisar o uso dos nossos serviços;</li>
        <li>Comunicar-se com você sobre produtos, serviços, ofertas e promoções;</li>
        <li>Atender suas solicitações e perguntas;</li>
        <li>Proteger os direitos e a segurança da AutoPerfect e de nossos usuários.</li>
    </ul>

    <h2>Compartilhamento de Informações</h2>
    <p>Não vendemos suas informações pessoais a terceiros. Podemos compartilhar suas informações em algumas circunstâncias, como:</p>
    <ul>
        <li>Com prestadores de serviços que trabalham em nosso nome;</li>
        <li>Para cumprir leis ou regulamentações aplicáveis;</li>
        <li>Para proteger os direitos e a segurança da AutoPerfect e de nossos usuários.</li>
    </ul>

    <h2>Segurança das Informações</h2>
    <p>Implementamos medidas de segurança apropriadas para proteger suas informações pessoais contra acesso não autorizado, alteração, divulgação ou destruição. No entanto, nenhum método de transmissão pela Internet ou método de armazenamento eletrônico é 100% seguro.</p>

    <h2>Seus Direitos</h2>
    <p>Você tem o direito de acessar, corrigir ou excluir suas informações pessoais. Para exercer esses direitos, entre em contato conosco através dos meios disponíveis em nosso site.</p>

    <h2>Alterações a Esta Política de Privacidade</h2>
    <p>Podemos atualizar nossa política de privacidade ocasionalmente. Notificaremos você sobre mudanças significativas na forma como tratamos suas informações pessoais, através do nosso site ou por outros meios de comunicação.</p>

    <h2>Contato</h2>
    <p>Se você tiver alguma dúvida sobre esta Política de Privacidade, entre em contato conosco:</p>
    <ul>
        <li>Email: contato@autoperfectconcessionaria@gmail.com.br</li>
        <li>Telefone: 0800 000 0000</li>
    </ul>

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
            const currentTheme = themeCookie ? themeCookie.split('=')[1] : 'light-mode';
            if (currentTheme === 'dark-mode') toggleMode();
        };
    </script>

    <footer>
        <div class="footer-links">
            <a href="sobre-nos.php">Sobre Nós</a>
            <a href="fale-conosco.php">Contato</a>
            <a href="politica-privacidade.php">Política de Privacidade</a>
            <a href="termos-servico.php">Termos de Serviço</a>
        </div>
        <div>
            <p>&copy; 2024 AutoPerfect. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>
