<?php
/**
 * logout.php
 * ------------------------------------------------------------------
 * Encerra a sessão do usuário (logout).
 *
 * 1. Inicia a sessão (para poder acessá-la).
 * 2. Apaga todos os dados da sessão.
 * 3. Destroi a sessão.
 * 4. Redireciona para a tela de login.
 * ------------------------------------------------------------------
 */

session_start();   // Inicia a sessão atual
$_SESSION = [];    // Limpa todas as variáveis da sessão
session_destroy(); // Destroi a sessão por completo

// Volta para a tela de login
header("Location: login.php");
exit;
