CREATE TABLE produtos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  preco DECIMAL(10,2),
  descricao TEXT,
  imagem varchar(999) NOT NULL
); 