-- Arquivo de Views para o Banco de Dados SISGEA
-- Este arquivo contém views úteis para consultas frequentes

USE `sisgea_db` ;

-- -----------------------------------------------------
-- View 1: EVENTOS_COM_ORGANIZADOR
-- Mostra eventos com informações do organizador
-- -----------------------------------------------------
DROP VIEW IF EXISTS `EVENTOS_COM_ORGANIZADOR`;

CREATE VIEW `EVENTOS_COM_ORGANIZADOR` AS
SELECT 
    e.id,
    e.titulo,
    e.descricao,
    e.data,
    e.hora,
    e.local,
    e.limite_vagas,
    e.created_at,
    e.updated_at,
    u.id AS organizador_id,
    u.nome AS organizador_nome,
    u.email AS organizador_email
FROM 
    EVENTOS e
    INNER JOIN USUARIOS u ON e.usuario_id = u.id;

-- -----------------------------------------------------
-- View 2: EVENTOS_COM_INSCRITOS
-- Mostra eventos com contagem de inscritos e vagas disponíveis
-- -----------------------------------------------------
DROP VIEW IF EXISTS `EVENTOS_COM_INSCRITOS`;

CREATE VIEW `EVENTOS_COM_INSCRITOS` AS
SELECT 
    e.id,
    e.titulo,
    e.descricao,
    e.data,
    e.hora,
    e.local,
    e.limite_vagas,
    COALESCE(COUNT(i.id), 0) AS total_inscritos,
    CASE 
        WHEN e.limite_vagas = 0 THEN 'Ilimitado'
        ELSE (e.limite_vagas - COALESCE(COUNT(i.id), 0))
    END AS vagas_disponiveis,
        CASE 
        WHEN e.limite_vagas = 0 THEN 'NAO'
        WHEN COALESCE(COUNT(i.id), 0) >= e.limite_vagas THEN 'SIM'
        ELSE 'NAO'
    END AS evento_lotado,
    u.nome AS organizador_nome
FROM 
    EVENTOS e
    LEFT JOIN INSCRICOES i ON e.id = i.evento_id
    INNER JOIN USUARIOS u ON e.usuario_id = u.id
GROUP BY 
    e.id, e.titulo, e.descricao, e.data, e.hora, e.local, e.limite_vagas, u.nome;

-- -----------------------------------------------------
-- View 3: INSCRICOES_DETALHADAS
-- Mostra inscrições com informações completas de usuário e evento
-- -----------------------------------------------------
DROP VIEW IF EXISTS `INSCRICOES_DETALHADAS`;

CREATE VIEW `INSCRICOES_DETALHADAS` AS
SELECT 
    i.id AS inscricao_id,
    i.created_at AS data_inscricao,
    u.id AS usuario_id,
    u.nome AS usuario_nome,
    u.email AS usuario_email,
    u.perfil AS usuario_perfil,
    e.id AS evento_id,
    e.titulo AS evento_titulo,
    e.descricao AS evento_descricao,
    e.data AS evento_data,
    e.hora AS evento_hora,
    e.local AS evento_local,
    org.nome AS organizador_nome
FROM 
    INSCRICOES i
    INNER JOIN USUARIOS u ON i.usuario_id = u.id
    INNER JOIN EVENTOS e ON i.evento_id = e.id
    INNER JOIN USUARIOS org ON e.usuario_id = org.id
ORDER BY 
    e.data, e.hora, u.nome;

-- -----------------------------------------------------
-- View 4: EVENTOS_FUTUROS
-- Mostra apenas eventos que ainda não aconteceram
-- -----------------------------------------------------
DROP VIEW IF EXISTS `EVENTOS_FUTUROS`;

CREATE VIEW `EVENTOS_FUTUROS` AS
SELECT 
    e.*,
    u.nome AS organizador_nome,
    COALESCE(COUNT(i.id), 0) AS total_inscritos,
    CASE 
        WHEN e.limite_vagas = 0 THEN 'Ilimitado'
        ELSE (e.limite_vagas - COALESCE(COUNT(i.id), 0))
    END AS vagas_disponiveis
FROM 
    EVENTOS e
    INNER JOIN USUARIOS u ON e.usuario_id = u.id
    LEFT JOIN INSCRICOES i ON e.id = i.evento_id
WHERE 
    e.data >= CURDATE()
GROUP BY 
    e.id
ORDER BY 
    e.data ASC, e.hora ASC;

-- -----------------------------------------------------
-- View 5: EVENTOS_PASSADOS
-- Mostra apenas eventos que já aconteceram
-- -----------------------------------------------------
DROP VIEW IF EXISTS `EVENTOS_PASSADOS`;

CREATE VIEW `EVENTOS_PASSADOS` AS
SELECT 
    e.*,
    u.nome AS organizador_nome,
    COALESCE(COUNT(i.id), 0) AS total_inscritos
FROM 
    EVENTOS e
    INNER JOIN USUARIOS u ON e.usuario_id = u.id
    LEFT JOIN INSCRICOES i ON e.id = i.evento_id
WHERE 
    e.data < CURDATE()
GROUP BY 
    e.id
ORDER BY 
    e.data DESC, e.hora DESC;

-- -----------------------------------------------------
-- View 6: ORGANIZADORES_COM_EVENTOS
-- Mostra organizadores com contagem de eventos criados
-- -----------------------------------------------------
DROP VIEW IF EXISTS `ORGANIZADORES_COM_EVENTOS`;

CREATE VIEW `ORGANIZADORES_COM_EVENTOS` AS
SELECT 
    u.id,
    u.nome,
    u.email,
    u.created_at,
    COUNT(e.id) AS total_eventos_criados,
    COUNT(CASE WHEN e.data >= CURDATE() THEN 1 END) AS eventos_futuros,
    COUNT(CASE WHEN e.data < CURDATE() THEN 1 END) AS eventos_passados
FROM 
    USUARIOS u
    LEFT JOIN EVENTOS e ON u.id = e.usuario_id
WHERE 
    u.perfil = 'organizador'
GROUP BY 
    u.id, u.nome, u.email, u.created_at
ORDER BY 
    total_eventos_criados DESC;

-- -----------------------------------------------------
-- View 7: PARTICIPANTES_COM_INSCRICOES
-- Mostra participantes com contagem de eventos inscritos
-- -----------------------------------------------------
DROP VIEW IF EXISTS `PARTICIPANTES_COM_INSCRICOES`;

CREATE VIEW `PARTICIPANTES_COM_INSCRICOES` AS
SELECT 
    u.id,
    u.nome,
    u.email,
    u.created_at,
    COUNT(i.id) AS total_inscricoes,
    COUNT(CASE WHEN e.data >= CURDATE() THEN 1 END) AS eventos_futuros_inscritos,
    COUNT(CASE WHEN e.data < CURDATE() THEN 1 END) AS eventos_passados_inscritos
FROM 
    USUARIOS u
    LEFT JOIN INSCRICOES i ON u.id = i.usuario_id
    LEFT JOIN EVENTOS e ON i.evento_id = e.id
WHERE 
    u.perfil = 'participante'
GROUP BY 
    u.id, u.nome, u.email, u.created_at
ORDER BY 
    total_inscricoes DESC;

-- -----------------------------------------------------
-- View 8: EVENTOS_MAIS_POPULARES
-- Mostra eventos ordenados por número de inscritos
-- -----------------------------------------------------
DROP VIEW IF EXISTS `EVENTOS_MAIS_POPULARES`;

CREATE VIEW `EVENTOS_MAIS_POPULARES` AS
SELECT 
    e.id,
    e.titulo,
    e.data,
    e.hora,
    e.local,
    e.limite_vagas,
    u.nome AS organizador_nome,
    COUNT(i.id) AS total_inscritos,
    CASE 
        WHEN e.data >= CURDATE() THEN 'Futuro'
        ELSE 'Passado'
    END AS status_evento
FROM 
    EVENTOS e
    INNER JOIN USUARIOS u ON e.usuario_id = u.id
    LEFT JOIN INSCRICOES i ON e.id = i.evento_id
GROUP BY 
    e.id, e.titulo, e.data, e.hora, e.local, e.limite_vagas, u.nome
ORDER BY 
    total_inscritos DESC, e.data DESC;

-- -----------------------------------------------------
-- View 9: EVENTOS_COM_VAGAS
-- Mostra eventos futuros que ainda têm vagas disponíveis
-- -----------------------------------------------------
DROP VIEW IF EXISTS `EVENTOS_COM_VAGAS`;

CREATE VIEW `EVENTOS_COM_VAGAS` AS
SELECT 
    e.id,
    e.titulo,
    e.descricao,
    e.data,
    e.hora,
    e.local,
    e.limite_vagas,
    u.nome AS organizador_nome,
    COALESCE(COUNT(i.id), 0) AS total_inscritos,
    CASE 
        WHEN e.limite_vagas = 0 THEN 999999
        ELSE (e.limite_vagas - COALESCE(COUNT(i.id), 0))
    END AS vagas_disponiveis
FROM 
    EVENTOS e
    INNER JOIN USUARIOS u ON e.usuario_id = u.id
    LEFT JOIN INSCRICOES i ON e.id = i.evento_id
WHERE 
    e.data >= CURDATE()
    AND (e.limite_vagas = 0 OR COALESCE(COUNT(i.id), 0) < e.limite_vagas)
GROUP BY 
    e.id, e.titulo, e.descricao, e.data, e.hora, e.local, e.limite_vagas, u.nome
HAVING 
    vagas_disponiveis > 0 OR e.limite_vagas = 0
ORDER BY 
    e.data ASC, e.hora ASC;

-- -----------------------------------------------------
-- View 10: EVENTOS_LOTADOS
-- Mostra eventos que atingiram o limite de vagas
-- -----------------------------------------------------
DROP VIEW IF EXISTS `EVENTOS_LOTADOS`;

CREATE VIEW `EVENTOS_LOTADOS` AS
SELECT 
    e.id,
    e.titulo,
    e.descricao,
    e.data,
    e.hora,
    e.local,
    e.limite_vagas,
    u.nome AS organizador_nome,
    COUNT(i.id) AS total_inscritos
FROM 
    EVENTOS e
    INNER JOIN USUARIOS u ON e.usuario_id = u.id
    LEFT JOIN INSCRICOES i ON e.id = i.evento_id
WHERE 
    e.limite_vagas > 0
GROUP BY 
    e.id, e.titulo, e.descricao, e.data, e.hora, e.local, e.limite_vagas, u.nome
HAVING 
    COUNT(i.id) >= e.limite_vagas
ORDER BY 
    e.data ASC;

-- -----------------------------------------------------
-- View 11: USUARIO_EVENTOS_INSCRITOS
-- Mostra todos os eventos em que um usuário está inscrito
-- Útil para ver o histórico de participação de um usuário
-- -----------------------------------------------------
DROP VIEW IF EXISTS `USUARIO_EVENTOS_INSCRITOS`;

CREATE VIEW `USUARIO_EVENTOS_INSCRITOS` AS
SELECT 
    u.id AS usuario_id,
    u.nome AS usuario_nome,
    u.email AS usuario_email,
    e.id AS evento_id,
    e.titulo AS evento_titulo,
    e.data AS evento_data,
    e.hora AS evento_hora,
    e.local AS evento_local,
    i.created_at AS data_inscricao,
    CASE 
        WHEN e.data >= CURDATE() THEN 'Futuro'
        ELSE 'Passado'
    END AS status_evento,
    org.nome AS organizador_nome
FROM 
    USUARIOS u
    INNER JOIN INSCRICOES i ON u.id = i.usuario_id
    INNER JOIN EVENTOS e ON i.evento_id = e.id
    INNER JOIN USUARIOS org ON e.usuario_id = org.id
ORDER BY 
    u.nome, e.data DESC;

-- -----------------------------------------------------
-- View 12: ESTATISTICAS_GERAIS
-- Mostra estatísticas gerais do sistema
-- -----------------------------------------------------
DROP VIEW IF EXISTS `ESTATISTICAS_GERAIS`;

CREATE VIEW `ESTATISTICAS_GERAIS` AS
SELECT 
    (SELECT COUNT(*) FROM USUARIOS) AS total_usuarios,
    (SELECT COUNT(*) FROM USUARIOS WHERE perfil = 'organizador') AS total_organizadores,
    (SELECT COUNT(*) FROM USUARIOS WHERE perfil = 'participante') AS total_participantes,
    (SELECT COUNT(*) FROM EVENTOS) AS total_eventos,
    (SELECT COUNT(*) FROM EVENTOS WHERE data >= CURDATE()) AS eventos_futuros,
    (SELECT COUNT(*) FROM EVENTOS WHERE data < CURDATE()) AS eventos_passados,
    (SELECT COUNT(*) FROM INSCRICOES) AS total_inscricoes,
    (SELECT AVG(total) FROM (
        SELECT COUNT(*) AS total 
        FROM INSCRICOES 
        GROUP BY evento_id
    ) AS sub) AS media_inscritos_por_evento,
    (SELECT COUNT(DISTINCT usuario_id) FROM INSCRICOES) AS usuarios_com_inscricoes;

-- -----------------------------------------------------
-- Testando as Views - Exibindo resultados de cada view
-- -----------------------------------------------------

-- View 1: EVENTOS_COM_ORGANIZADOR
SELECT '=== VIEW 1: EVENTOS_COM_ORGANIZADOR ===' AS '';
SELECT * FROM EVENTOS_COM_ORGANIZADOR;
SELECT '' AS '';

-- View 2: EVENTOS_COM_INSCRITOS
SELECT '=== VIEW 2: EVENTOS_COM_INSCRITOS ===' AS '';
SELECT * FROM EVENTOS_COM_INSCRITOS;
SELECT '' AS '';

-- View 3: INSCRICOES_DETALHADAS
SELECT '=== VIEW 3: INSCRICOES_DETALHADAS ===' AS '';
SELECT * FROM INSCRICOES_DETALHADAS;
SELECT '' AS '';

-- View 4: EVENTOS_FUTUROS
SELECT '=== VIEW 4: EVENTOS_FUTUROS ===' AS '';
SELECT * FROM EVENTOS_FUTUROS;
SELECT '' AS '';

-- View 5: EVENTOS_PASSADOS
SELECT '=== VIEW 5: EVENTOS_PASSADOS ===' AS '';
SELECT * FROM EVENTOS_PASSADOS;
SELECT '' AS '';

-- View 6: ORGANIZADORES_COM_EVENTOS
SELECT '=== VIEW 6: ORGANIZADORES_COM_EVENTOS ===' AS '';
SELECT * FROM ORGANIZADORES_COM_EVENTOS;
SELECT '' AS '';

-- View 7: PARTICIPANTES_COM_INSCRICOES
SELECT '=== VIEW 7: PARTICIPANTES_COM_INSCRICOES ===' AS '';
SELECT * FROM PARTICIPANTES_COM_INSCRICOES;
SELECT '' AS '';

-- View 8: EVENTOS_MAIS_POPULARES
SELECT '=== VIEW 8: EVENTOS_MAIS_POPULARES ===' AS '';
SELECT * FROM EVENTOS_MAIS_POPULARES;
SELECT '' AS '';

-- View 9: EVENTOS_COM_VAGAS
SELECT '=== VIEW 9: EVENTOS_COM_VAGAS ===' AS '';
SELECT * FROM EVENTOS_COM_VAGAS;
SELECT '' AS '';

-- View 10: EVENTOS_LOTADOS
SELECT '=== VIEW 10: EVENTOS_LOTADOS ===' AS '';
SELECT * FROM EVENTOS_LOTADOS;
SELECT '' AS '';

-- View 11: USUARIO_EVENTOS_INSCRITOS
SELECT '=== VIEW 11: USUARIO_EVENTOS_INSCRITOS ===' AS '';
SELECT * FROM USUARIO_EVENTOS_INSCRITOS;
SELECT '' AS '';

-- View 12: ESTATISTICAS_GERAIS
SELECT '=== VIEW 12: ESTATISTICAS_GERAIS ===' AS '';
SELECT * FROM ESTATISTICAS_GERAIS;
SELECT '' AS '';

SELECT '=== TODAS AS VIEWS FORAM CRIADAS E TESTADAS COM SUCESSO! ===' AS '';

