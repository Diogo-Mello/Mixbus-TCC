-- EMPRESA

INSERT INTO empresa (nome, cnpj, telefone, email, senha, ativo, logo) 
VALUES ('Rápido Luxo Campinas', '45992724002493', '1534598050', 'rapidoluxocampinas@mixbus.com', '$2y$10$R64idrDGI6u/XTj/xtO7LeGWwkokbQfN910KBSeqzV8pD1S9FVnLq', 1, 'https://burhstorage.blob.core.windows.net/burhcontainer/app/company/logo/dvwqXpoREXvafDsQFKh1ODJk6kx11tspcBAn60WoYJW6LaoUybme/200/8d372e633561190874a330d1c95f82d8.png');

-- MOTORISTA

INSERT INTO motorista (matricula, nome, cpf, senha, fkEmpresa) VALUES 
('00101', 'Diogo Mello da Crus', '12345678901', '$2y$10$8r9yX5VWg6UltoJNZpwZxeXPwEtNQedgQcjYAwdG22UEn6CvuNWkC', 1),
('00102', 'Kevin de Melo Rezende', '12345678902', '$2y$10$Rku1vGNhgMHZp46iQzwOYeTfpjP0CIaYAOTntucf/Acf7UNEqbqhO', 1),
('00103', 'Nicolas Eduardo Sandri da Silva', '12345678903', '$2y$10$8LqmPIpgoxgPN3acSO9MMebEMfu8JNdL7g81wxXhpAYSCu57V4Xve', 1);

-- ESTADO

INSERT INTO estado (nome, sigla) VALUES 
('São Paulo', 'SP'),
('Rio de Janeiro', 'RJ'),
('Minas Gerais', 'MG'),
('Bahia', 'BA'),
('Paraná', 'PR'),
('Santa Catarina', 'SC'),
('Rio Grande do Sul', 'RS'),
('Pernambuco', 'PE'),
('Ceará', 'CE'),
('Pará', 'PA');

-- CIDADE

INSERT INTO cidade (nome, fkEstado) VALUES 
('Iperó', 1),
('Boituva', 1),
('Sorocaba', 1),
('Tatuí', 1);

-- LINHA

INSERT INTO linha (linha, preco, fkcidadeIda, fkCidadeVolta, fkEmpresa) VALUES
-- Boituva 
(6322, 3.90, 1, 2, 1),
-- Sorocaba
(6325, 6.65, 1, 3, 1),
-- Tatuí
(6323, 4.90, 1, 4, 1);

-- LOCALIZACAO

INSERT INTO localizacao (latitude, longitude, fkLinha) VALUES 
-- Boituva
('-23.321238', '-47.682452', 1),

-- Sorocaba
('-23.396181', '-47.594719', 2),

-- Tatuí
('-23.3652391', '-47.7550781', 3);

-- UPDATE localizacao SET latitude = '-23.3652391', longitude = '-47.7550781' WHERE id = 3;

-- USUARIO

-- Com linhas favoritas
INSERT INTO usuario (nome, email, senha, dataNascimento, telefone) VALUES 
('Diogo Mello', 'diogomello@mixbus.com', '$2y$10$8r9yX5VWg6UltoJNZpwZxeXPwEtNQedgQcjYAwdG22UEn6CvuNWkC', '2003-08-11', '01123456789'),
('Kevin Rezende', 'kevinrezende@mixbus.com', '$2y$10$Rku1vGNhgMHZp46iQzwOYeTfpjP0CIaYAOTntucf/Acf7UNEqbqhO', '2005-02-15', '02123456789');

-- Sem linha favorita
INSERT INTO usuario (nome, email, senha, dataNascimento, telefone) VALUES 
('Nicolas Eduardo', 'nicolaseduardo@mixbus.com', '$2y$10$8LqmPIpgoxgPN3acSO9MMebEMfu8JNdL7g81wxXhpAYSCu57V4Xve', '2005-04-21', '03123456789');

-- SUPORTE

INSERT INTO suporte (descricao, resposta, resolvido, fkUsuario) VALUES 
("Dúvida sobre o serviço", "", 0, 1),
("Dificuldade para realizar login", "Verifique se todos os dados foram preenchidos corretamente", 1, 1),
("Reclamação sobre o atendimento", "", 0, 2),
("Sugestão para melhorias", "", 0, 3);

-- HORARIOS

INSERT INTO observacao (descricao, fkEmpresa) VALUES
('Corre via Vila do Depósito', 1),
('Corre via Distrito Industrial de Iperó, chegando até o Conjunto Habitacional e corre via Vila do Depósito', 1),
('Corre via Distrito Industrial de Iperó, chegando até Conjunto Habitacional', 1),
('Corre via Distrito Industrial de Iperó, chegando até Conjunto Habitacional e Nova Bacaetava', 1),
('Corre via Nova Bacaetava', 1),
('Corre via Conjunto Habitacional', 1),
('Corre via Presídio de Iperó e não passa no conjunto habitacional', 1),
('Corre via Distrito Industrial de Iperó', 1),
('Corre via Presídio de Iperó', 1),
('Não entra em Bacaetava', 1);


-- Boituva
INSERT INTO horario (diaSemanal, horarioIda, fkObsIda, horarioVolta, fkObsVolta, fkLinha) VALUES 
('DIAS UTEIS', '05:00:00', 1, '05:30:00', 2, 1),
('DIAS UTEIS', '05:40:00', 1, '06:20:00', 3, 1),
('DIAS UTEIS', '06:10:00', 1, '06:40:00', 4, 1),
('DIAS UTEIS', '06:10:00', 5, '07:00:00', 6, 1),
('DIAS UTEIS', '07:00:00', 6, '07:30:00', 3, 1),
('DIAS UTEIS', '07:30:00', 6, '08:00:00', 6, 1),
('DIAS UTEIS', '08:00:00', 1, '08:30:00', 6, 1),
('DIAS UTEIS', '08:30:00', 6, '09:00:00', 6, 1),
('DIAS UTEIS', '09:15:00', 5, '10:00:00', 6, 1),
('DIAS UTEIS', '10:40:00', 6, '11:20:00', 6, 1),
('DIAS UTEIS', '12:00:00', 6, '12:30:00', 6, 1),
('DIAS UTEIS', '13:00:00', 6, '13:30:00', 5, 1),
('DIAS UTEIS', '14:15:00', 4, '15:00:00', 8, 1),
('DIAS UTEIS', '15:30:00', 6, '16:00:00', 6, 1),
('DIAS UTEIS', '16:30:00', 6, '17:00:00', 5, 1),
('DIAS UTEIS', '17:05:00', 7, '17:40:00', 1, 1),
('DIAS UTEIS', '17:50:00', 3, '18:20:00', 1, 1),
('DIAS UTEIS', '19:00:00', 1, '19:30:00', 5, 1),
('DIAS UTEIS', '20:30:00', 6, '21:00:00', 6, 1),
('DIAS UTEIS', '22:10:00', 6, '22:50:00', 6, 1),
('SÁBADOS', '05:20:00', 1, '06:00:00', 3, 1),
('SÁBADOS', '07:00:00', 6, '07:30:00', 6, 1),
('SÁBADOS', '08:00:00', 1, '08:30:00', 6, 1),
('SÁBADOS', '09:00:00', 6, '09:30:00', 6, 1),
('SÁBADOS', '10:00:00', 6, '10:30:00', 6, 1),
('SÁBADOS', '11:00:00', 6, '11:30:00', 1, 1),
('SÁBADOS', '12:30:00', 1, '13:15:00', 3, 1),
('SÁBADOS', '14:15:00', 3, '15:00:00', 6, 1),
('SÁBADOS', '15:30:00', 6, '16:00:00', 6, 1),
('SÁBADOS', '16:30:00', 6, '17:00:00', 6, 1),
('SÁBADOS', '18:00:00', 6, '19:00:00', 6, 1),
('SÁBADOS', '19:30:00', 6, '20:30:00', 6, 1),
('DOMINGOS E FERIADOS', '06:00:00', 6, '06:30:00', 6, 1),
('DOMINGOS E FERIADOS', '08:00:00', 6, '08:30:00', 6, 1),
('DOMINGOS E FERIADOS', '11:00:00', 6, '12:00:00', 6, 1),
('DOMINGOS E FERIADOS', '14:00:00', 6, '15:00:00', 6, 1),
('DOMINGOS E FERIADOS', '17:00:00', 6, '18:00:00', 6, 1),
('DOMINGOS E FERIADOS', '19:00:00', 6, '20:00:00', 6, 1);

-- Sorocaba
INSERT INTO horario (diaSemanal, horarioIda, fkObsIda, horarioVolta, fkObsVolta, fkLinha) 
VALUES ('DIAS UTEIS', '04:30:00', 10, '05:35:00', 8, 2);

INSERT INTO horario (diaSemanal, horarioIda, horarioVolta, fkObsVolta, fkLinha) 
VALUES ('DIAS UTEIS', '05:20:00', '06:30:00', 9, 2);

INSERT INTO horario (diaSemanal, horarioIda, horarioVolta, fkLinha) VALUES
('DIAS UTEIS', '07:00:00', '06:50:00', 2),
('DIAS UTEIS', '09:00:00', '08:30:00', 2),
('DIAS UTEIS', '11:00:00', '10:30:00', 2),
('DIAS UTEIS', '12:00:00', '12:30:00', 2),
('DIAS UTEIS', '14:00:00', '13:30:00', 2),
('DIAS UTEIS', '15:00:00', '15:30:00', 2),
('DIAS UTEIS', '16:00:00', '16:30:00', 2),
('DIAS UTEIS', '16:40:00', '17:45:00', 2);

INSERT INTO horario (diaSemanal, horarioIda, fkObsIda, horarioVolta, fkLinha) 
VALUES ('DIAS UTEIS', '17:00:00', 9, '18:30:00', 2);

INSERT INTO horario (diaSemanal, horarioIda, horarioVolta, fkLinha) VALUES
('DIAS UTEIS', '18:00:00', '19:30:00', 2),
('DIAS UTEIS', '22:00:00', '23:00:00', 2),
('SÁBADOS', '05:20:00', '06:30:00', 2),
('SÁBADOS', '07:00:00', '08:30:00', 2),
('SÁBADOS', '09:00:00', '10:30:00', 2),
('SÁBADOS', '11:00:00', '12:30:00', 2),
('SÁBADOS', '13:00:00', '14:30:00', 2),
('SÁBADOS', '17:00:00', '18:30:00', 2),
('SÁBADOS', '19:00:00', '20:30:00', 2),
('DOMINGOS E FERIADOS', '08:00:00', '09:30:00', 2),
('DOMINGOS E FERIADOS', '13:00:00', '14:30:00', 2),
('DOMINGOS E FERIADOS', '17:30:00', '19:00:00', 2);

-- Tatuí
INSERT INTO horario (diaSemanal, horarioIda, horarioVolta, fkLinha) VALUES
('DIAS UTEIS', '04:20:00', '05:00:00', 3),
('DIAS UTEIS', '05:35:00', '06:10:00', 3),
('DIAS UTEIS', '06:50:00', '07:25:00', 3),
('DIAS UTEIS', '08:30:00', '09:30:00', 3),
('DIAS UTEIS', '12:00:00', '13:00:00', 3),
('DIAS UTEIS', '14:10:00', '15:00:00', 3),
('DIAS UTEIS', '17:15:00', '18:00:00', 3),
('DIAS UTEIS', '18:10:00', '19:00:00', 3),
('DIAS UTEIS', '22:10:00', '23:00:00', 3),
('SÁBADOS', '08:30:00', '09:30:00', 3),
('SÁBADOS', '12:00:00', '13:00:00', 3),
('DOMINGOS E FERIADOS', '08:30:00', '09:30:00', 3),
('DOMINGOS E FERIADOS', '12:00:00', '13:00:00', 3);