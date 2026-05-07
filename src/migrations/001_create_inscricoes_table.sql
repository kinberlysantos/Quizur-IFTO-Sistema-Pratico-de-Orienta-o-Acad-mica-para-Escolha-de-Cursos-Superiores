-- Migration 001: Criação da tabela de inscrições
CREATE TABLE IF NOT EXISTS inscricoes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nome TEXT NOT NULL,
    email TEXT NOT NULL,
    curso TEXT,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP
);
