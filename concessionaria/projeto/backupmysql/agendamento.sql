CREATE TABLE agendamentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefone VARCHAR(15) NOT NULL,
    tipo_agendamento ENUM('Compra', 'Test Drive') NOT NULL,
    modelo_carro VARCHAR(100) NOT NULL,
    data_agendamento DATE NOT NULL,
    hora_agendamento TIME NOT NULL,
    observacoes TEXT
);

ALTER TABLE agendamentos 
ADD COLUMN cpf VARCHAR(14) NOT NULL AFTER telefone;
