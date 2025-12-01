-- Arquivo de Seed para o Banco de Dados SISGEA
-- Este arquivo popula o banco com dados de exemplo

USE `sisgea_db` ;

-- Desabilitar verificações temporariamente para inserção mais rápida
SET FOREIGN_KEY_CHECKS=0;
SET UNIQUE_CHECKS=0;

-- Limpar dados existentes (opcional - descomente se quiser limpar antes de inserir)
-- DELETE FROM INSCRICOES;
-- DELETE FROM EVENTOS;
-- DELETE FROM USUARIOS;

-- -----------------------------------------------------
-- Inserção de USUÁRIOS (10 usuários)
-- -----------------------------------------------------

INSERT INTO `USUARIOS` (`nome`, `email`, `senha`, `perfil`) VALUES
('João Silva', 'joao.silva@gmail.com', '$2y$12$v33.33w9YzCOw.r2snyRCedpg1N7GagxfXw3U9Lha/TNFNQSchcwG', 'organizador'),
('Maria Santos', 'maria.santos@gmail.com', '$2y$12$v33.33w9YzCOw.r2snyRCedpg1N7GagxfXw3U9Lha/TNFNQSchcwG', 'organizador'),
('Pedro Oliveira', 'pedro.oliveira@gmail.com', '$2y$12$v33.33w9YzCOw.r2snyRCedpg1N7GagxfXw3U9Lha/TNFNQSchcwG', 'organizador'),
('Ana Costa', 'ana.costa@gmail.com', '$2y$12$v33.33w9YzCOw.r2snyRCedpg1N7GagxfXw3U9Lha/TNFNQSchcwG', 'participante'),
('Carlos Pereira', 'carlos.pereira@cefet.com', '$2y$12$v33.33w9YzCOw.r2snyRCedpg1N7GagxfXw3U9Lha/TNFNQSchcwG', 'participante'),
('Julia Ferreira', 'julia.ferreira@cefet.com', '$2y$12$v33.33w9YzCOw.r2snyRCedpg1N7GagxfXw3U9Lha/TNFNQSchcwG', 'participante'),
('Roberto Alves', 'roberto.alves@cefet.com', '$2y$12$v33.33w9YzCOw.r2snyRCedpg1N7GagxfXw3U9Lha/TNFNQSchcwG', 'participante'),
('Fernanda Lima', 'fernanda.lima@cefet.com', '$2y$12$v33.33w9YzCOw.r2snyRCedpg1N7GagxfXw3U9Lha/TNFNQSchcwG', 'participante'),
('Lucas Rodrigues', 'lucas.rodrigues@outlook.com', '$2y$12$v33.33w9YzCOw.r2snyRCedpg1N7GagxfXw3U9Lha/TNFNQSchcwG', 'participante'),
('Mariana Souza', 'mariana.souza@outlook.com', '$2y$12$v33.33w9YzCOw.r2snyRCedpg1N7GagxfXw3U9Lha/TNFNQSchcwG', 'participante');

-- Nota: As senhas acima são hashes de exemplo (hash de "password")
-- Em produção, gere hashes reais usando bcrypt ou similar

-- -----------------------------------------------------
-- Inserção de EVENTOS (5 eventos)
-- -----------------------------------------------------

INSERT INTO `EVENTOS` (`titulo`, `descricao`, `data`, `hora`, `local`, `limite_vagas`, `usuario_id`) VALUES
('Workshop de Desenvolvimento Web', 'Workshop completo sobre desenvolvimento web moderno com foco em React, Node.js e bancos de dados. Ideal para iniciantes e intermediários.', '2024-03-15', '14:00:00', 'Auditório Principal - Campus Universitário', 50, 1),
('Palestra sobre Inteligência Artificial', 'Palestra sobre as últimas tendências em IA, machine learning e suas aplicações práticas no mercado de trabalho.', '2024-03-20', '19:00:00', 'Sala de Conferências - Edifício Tech', 100, 2),
('Evento de Networking para Desenvolvedores', 'Evento de networking para desenvolvedores trocarem experiências, conhecerem novas tecnologias e expandirem sua rede profissional.', '2024-03-25', '18:30:00', 'Coworking Space Downtown', 30, 3),
('Curso de Python para Iniciantes', 'Curso prático de Python desde o básico até conceitos intermediários. Traga seu notebook e pratique durante o curso.', '2024-04-01', '09:00:00', 'Laboratório de Informática - Bloco B', 25, 1),
('Hackathon de Inovação', 'Hackathon de 24 horas para desenvolver soluções inovadoras. Premiação para os melhores projetos. Inscrições limitadas.', '2024-04-10', '08:00:00', 'Centro de Convenções - Sala Grand Ballroom', 80, 2);

-- -----------------------------------------------------
-- Inserção de INSCRIÇÕES
-- -----------------------------------------------------

-- Usuário 4 (Ana Costa) se inscreve em 3 eventos
INSERT INTO `INSCRICOES` (`usuario_id`, `evento_id`) VALUES
(4, 1),  -- Ana no Workshop de Desenvolvimento Web
(4, 2),  -- Ana na Palestra sobre IA
(4, 4);  -- Ana no Curso de Python

-- Usuário 5 (Carlos Pereira) se inscreve em 2 eventos
INSERT INTO `INSCRICOES` (`usuario_id`, `evento_id`) VALUES
(5, 1),  -- Carlos no Workshop de Desenvolvimento Web
(5, 3);  -- Carlos no Evento de Networking

-- Usuário 6 (Julia Ferreira) se inscreve em 4 eventos
INSERT INTO `INSCRICOES` (`usuario_id`, `evento_id`) VALUES
(6, 1),  -- Julia no Workshop de Desenvolvimento Web
(6, 2),  -- Julia na Palestra sobre IA
(6, 4),  -- Julia no Curso de Python
(6, 5);  -- Julia no Hackathon

-- Usuário 7 (Roberto Alves) se inscreve em 2 eventos
INSERT INTO `INSCRICOES` (`usuario_id`, `evento_id`) VALUES
(7, 2),  -- Roberto na Palestra sobre IA
(7, 5);  -- Roberto no Hackathon

-- Usuário 8 (Fernanda Lima) se inscreve em 3 eventos
INSERT INTO `INSCRICOES` (`usuario_id`, `evento_id`) VALUES
(8, 3),  -- Fernanda no Evento de Networking
(8, 4),  -- Fernanda no Curso de Python
(8, 5);  -- Fernanda no Hackathon

-- Usuário 9 (Lucas Rodrigues) se inscreve em 1 evento
INSERT INTO `INSCRICOES` (`usuario_id`, `evento_id`) VALUES
(9, 1);  -- Lucas no Workshop de Desenvolvimento Web

-- Usuário 10 (Mariana Souza) se inscreve em 2 eventos
INSERT INTO `INSCRICOES` (`usuario_id`, `evento_id`) VALUES
(10, 2), -- Mariana na Palestra sobre IA
(10, 3); -- Mariana no Evento de Networking

-- Restaurar verificações
SET FOREIGN_KEY_CHECKS=1;
SET UNIQUE_CHECKS=1;

-- Verificação dos dados inseridos
SELECT 'Usuários inseridos:' AS Status, COUNT(*) AS Quantidade FROM USUARIOS
UNION ALL
SELECT 'Eventos inseridos:', COUNT(*) FROM EVENTOS
UNION ALL
SELECT 'Inscrições inseridas:', COUNT(*) FROM INSCRICOES;

