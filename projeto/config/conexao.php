<?php
/**
 * config/conexao.php
 * ------------------------------------------------------------------
 * Arquivo responsável por criar a conexão com o banco de dados MySQL
 * utilizando PDO (PHP Data Objects).
 *
 * Por que PDO?
 *  - É seguro (suporta Prepared Statements, evitando SQL Injection).
 *  - Funciona com vários bancos de dados.
 *  - É a forma recomendada e moderna de acessar bancos no PHP.
 *
 * IMPORTANTE: ajuste as variáveis abaixo de acordo com o seu ambiente.
 * No XAMPP, normalmente:
 *   - host:    localhost
 *   - usuário: root
 *   - senha:   (vazia)
 * ------------------------------------------------------------------
 */

// Dados de configuração do banco
$host   = "localhost";        // Endereço do servidor MySQL
$dbname = "sistema_web";      // Nome do banco de dados (criado pelo banco.sql)
$user   = "root";             // Usuário do MySQL (padrão do XAMPP é "root")
$senha  = "";                 // Senha do MySQL (padrão do XAMPP é vazia)

// Tentamos criar a conexão dentro de um try/catch para tratar erros
try {
    // Cria o objeto PDO com a string de conexão (DSN)
    // O charset utf8mb4 garante o suporte a acentos e emojis
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $user,
        $senha
    );

    // Configura o PDO para lançar exceções em caso de erro (ajuda a depurar)
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Define que os resultados venham como array associativo por padrão
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // Se a conexão falhar, mostra a mensagem de erro e interrompe o sistema
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}
