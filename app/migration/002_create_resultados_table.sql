-- Migration 002: Criação da tabela de resultados
CREATE TABLE IF NOT EXISTS resultados (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    perfil INTEGER,
    titulo TEXT,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP
);
