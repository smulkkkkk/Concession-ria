CREATE TABLE solicitacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefone VARCHAR(20) NOT NULL,
    modelo VARCHAR(50) NOT NULL,
    ano INT NOT NULL,
    observacoes TEXT,
    data_solicitacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
