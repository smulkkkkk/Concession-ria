<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header("Location: login.php");
    exit;
}

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "concessionaria"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$horario_atendimento = [
    "segunda" => ["09:00", "18:00"],
    "terca" => ["09:00", "18:00"],
    "quarta" => ["09:00", "18:00"],
    "quinta" => ["09:00", "18:00"],
    "sexta" => ["09:00", "18:00"],
    "sabado" => ["09:00", "14:00"],
    "domingo" => ["fechado", "fechado"]
];

function exibir_horario_atendimento($horario_atendimento) {
    echo "<h2>Horário de Atendimento da Concessionária:</h2>";
    echo "<table>";
    echo "<tr><th>Dia da Semana</th><th>Horário de Atendimento</th></tr>";
    foreach ($horario_atendimento as $dia => $horario) {
        echo "<tr><td>" . ucfirst($dia) . "</td><td>" . $horario[0] . " - " . $horario[1] . "</td></tr>";
    }
    echo "</table>";
}

function visualizar_agenda($horario_atendimento) {
    $hoje = new DateTime();
    echo "<h2>Agenda para a Semana:</h2>";
    echo "<ul>";
    for ($i = 0; $i < 7; $i++) {
        $dia_atual = clone $hoje;
        $dia_atual->modify("+$i day");
        $dia_nome = strtolower($dia_atual->format("l"));
        $horario = $horario_atendimento[$dia_nome];
        echo "<li>" . $dia_atual->format("d/m/Y") . " - " . ucfirst($dia_nome) . ": " . $horario[0] . " - " . $horario[1] . "</li>";
    }
    echo "</ul>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $data = $_POST['data'];
    $hora = $_POST['hora'];
    $veiculo = $_POST['veiculo'];

    $stmt = $conn->prepare("INSERT INTO agendamentos (nome, email, telefone, data, hora, veiculo) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $nome, $email, $telefone, $data, $hora, $veiculo);

    if ($stmt->execute()) {
        echo "<script>alert('Agendamento realizado com sucesso!');</script>";
    } else {
        echo "<script>alert('Erro: " . $stmt->error . "');</script>";
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamento de Test Drive</title>
    <link rel="stylesheet" href="../css/agendar.css">
</head>
<body>
    <header>
        <h1>Agende seu Test Drive</h1>
    </header>
    
    <main>
        <?php
        exibir_horario_atendimento($horario_atendimento);
        visualizar_agenda($horario_atendimento);
        ?>
        
        <form id="agendamento-form" method="post">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required>

            <label for="telefone">Telefone:</label>
            <input type="tel" id="telefone" name="telefone" required>

            <label for="data">Data do Test Drive:</label>
            <input type="date" id="data" name="data" required>

            <label for="hora">Hora do Test Drive:</label>
            <input type="time" id="hora" name="hora" required>

            <label for="veiculo">Veículo de Interesse:</label>
            <select id="veiculo" name="veiculo" required>
                <option value="">Selecione um veículo</option>
                <option value="Corolla">Corolla</option>
                <option value="Masserati">Masserati</option>
                <option value="Bmw">Bmw</option>
            </select>

            <button type="submit">Agendar Test Drive</button>
            <a class="toggle-link" href="paginainicial.php">Voltar</a>
        </form>
    </main>

    <footer>
        <p>&copy; 2024 Concessionária de Veículos</p>
    </footer>

    <script>
        // Alert already shown in PHP after form submission
        document.getElementById('agendamento-form').addEventListener('submit', function(event) {
            // No need to prevent default, since PHP handles form submission
        });
    </script>
</body>
</html>
