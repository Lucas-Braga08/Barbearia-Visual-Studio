-- Banco de dados da Barbearia Studio Visual
-- Crie o banco `barbearia_studio_visual` no phpMyAdmin antes de importar este arquivo.

CREATE TABLE IF NOT EXISTS servicos (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    slug VARCHAR(100) NOT NULL UNIQUE,
    nome VARCHAR(120) NOT NULL,
    descricao VARCHAR(255) NOT NULL,
    preco DECIMAL(10, 2) NOT NULL DEFAULT 0.00,
    duracao_minutos SMALLINT UNSIGNED NOT NULL DEFAULT 30,
    destaque TINYINT(1) NOT NULL DEFAULT 0,
    ativo TINYINT(1) NOT NULL DEFAULT 1,
    ordem SMALLINT UNSIGNED NOT NULL DEFAULT 0,
    criado_em TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO servicos (slug, nome, descricao, preco, duracao_minutos, destaque, ativo, ordem)
VALUES
    ('corte-classico', 'Corte clássico', 'Corte tradicional com acabamento cuidadoso e alinhado ao seu estilo.', 45.00, 40, 1, 1, 1),
    ('barba', 'Barba', 'Aparar, desenhar e finalizar a barba com atenção aos detalhes.', 35.00, 30, 1, 1, 2),
    ('corte-e-barba', 'Corte + barba', 'Uma combinação prática para renovar o visual por completo.', 70.00, 65, 1, 1, 3),
    ('acabamento', 'Acabamento', 'Manutenção de contornos e pequenos ajustes no visual.', 20.00, 20, 0, 1, 4)
ON DUPLICATE KEY UPDATE
    nome = VALUES(nome),
    descricao = VALUES(descricao),
    preco = VALUES(preco),
    duracao_minutos = VALUES(duracao_minutos),
    destaque = VALUES(destaque),
    ativo = VALUES(ativo),
    ordem = VALUES(ordem);
