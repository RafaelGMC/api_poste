CREATE DATABASE IF NOT EXISTS controle_poste;

USE controle_poste;

CREATE TABLE IF NOT EXISTS Usuarios (
  id INT PRIMARY KEY AUTO_INCREMENT,
  login VARCHAR(255) NOT NULL,
  senha VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS Postes (
  id INT PRIMARY KEY AUTO_INCREMENT,
  localizacao VARCHAR(255) NOT NULL,
  status ENUM('funcionando', 'com_defeito', 'em_manutencao') NOT NULL,
  ultima_manutencao DATE,
  distrito VARCHAR(255),
  zona VARCHAR(255)
);

INSERT INTO Postes (localizacao, status, ultima_manutencao, distrito, zona)
VALUES ('Rua da Luz, 123', 'funcionando', '2024-05-29', 'apura' , 'Sul');

INSERT INTO Usuarios (login, senha)
VALUES ('etecia123', 'etecia123');
