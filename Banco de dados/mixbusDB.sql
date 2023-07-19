CREATE DATABASE mixbus;

USE mixbus;

CREATE TABLE empresa (
	id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL,
    cnpj CHAR(14) NOT NULL,
    telefone VARCHAR(11) NOT NULL,
    email VARCHAR(256) NOT NULL,
    senha CHAR(60) NOT NULL,
    ativo BOOLEAN,
    logo VARCHAR(500)
)engine=InnoDB;

CREATE TABLE motorista (
	id INT PRIMARY KEY AUTO_INCREMENT,
    matricula CHAR(6) NOT NULL,
    nome VARCHAR(60) NOT NULL,
    cpf CHAR(11) NOT NULL,
    senha CHAR(60) NOT NULL,
    fkEmpresa INT NOT NULL,
    FOREIGN KEY (fkEmpresa) REFERENCES empresa (id)
)engine=InnoDB;

CREATE TABLE estado (
	id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(20) NOT NULL,
    sigla CHAR(2) NOT NULL
)engine=InnoDB;

CREATE TABLE cidade (
	id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(25) NOT NULL,
    fkEstado INT NOT NULL,
    FOREIGN KEY (fkEstado) REFERENCES estado (id)
)engine=InnoDB;

CREATE TABLE linha (
	id INT PRIMARY KEY AUTO_INCREMENT,
    linha NUMERIC(10) NOT NULL,
    preco DECIMAL(6,2) NOT NULL,
    fkcidadeIda INT NOT NULL,
    fkCidadeVolta INT NOT NULL,
    fkEmpresa INT NOT NULL,
    FOREIGN KEY (fkCidadeIda) REFERENCES cidade (id),
    FOREIGN KEY (fkCidadeVolta) REFERENCES cidade (id),
    FOREIGN KEY (fkEmpresa) REFERENCES empresa (id)
)engine=InnoDB;

CREATE TABLE observacao (
	id INT PRIMARY KEY AUTO_INCREMENT,
    descricao VARCHAR(500) NOT NULL,
    fkEmpresa INT NOT NULL,
    FOREIGN KEY (fkEmpresa) REFERENCES empresa (id)
)engine=InnoDB;

CREATE TABLE localizacao (
	id INT PRIMARY KEY AUTO_INCREMENT,
    latitude VARCHAR(20),
    longitude VARCHAR(20),
    fkLinha INT NOT NULL,
    FOREIGN KEY (fkLinha) REFERENCES linha (id) ON DELETE CASCADE
)engine=InnoDB;

CREATE TABLE horario (
	id INT PRIMARY KEY AUTO_INCREMENT,
    diaSemanal VARCHAR(20) NOT NULL,
    horarioIda TIME,
    fkObsIda INT,
    FOREIGN KEY (fkObsIda) REFERENCES observacao (id),
    horarioVolta TIME,
    fkObsVolta INT,
    FOREIGN KEY (fkObsVolta) REFERENCES observacao (id),
    fkLinha INT NOT NULL,
    FOREIGN KEY (fkLinha) REFERENCES linha (id) ON DELETE CASCADE
)engine=InnoDB;

CREATE TABLE usuario (
	id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(256) NOT NULL,
    senha CHAR(60) NOT NULL,
    dataNascimento DATE NULL,
    telefone VARCHAR(11) NULL
)engine=InnoDB;

CREATE TABLE suporte (
	id INT PRIMARY KEY AUTO_INCREMENT,
    descricao VARCHAR(500),
    resposta VARCHAR(500),
    resolvido BOOLEAN NOT NULL,
    fkUsuario INT NOT NULL,
	FOREIGN KEY (fkUsuario) REFERENCES usuario (id) ON DELETE CASCADE
)engine=InnoDB;


