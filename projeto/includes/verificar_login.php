<?php
/**
 * includes/verificar_login.php
 * ------------------------------------------------------------------
 * Este arquivo protege as páginas internas do sistema.
 *
 * Ele deve ser incluído (require) no TOPO de toda página que só pode
 * ser acessada por um usuário logado (ex.: dashboard, clientes, produtos).
 *
 * Como funciona?
 *  1. Inicia a sessão do PHP.
 *  2. Verifica se existe um usuário guardado na sessão.
 *  3. Se NÃO existir, redireciona para a tela de login.
 * ------------------------------------------------------------------
 */

// Inicia a sessão (necessário para ler os dados guardados no login)
// O if evita o aviso "session already started" caso já tenha sido iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Se a variável de sessão "usuario_id" não existir, o usuário NÃO está logado
if (!isset($_SESSION['usuario_id'])) {
    // Redireciona para a página de login
    // Usamos caminho relativo para funcionar dentro das subpastas também
    $base = (strpos($_SERVER['PHP_SELF'], '/clientes/') !== false
          || strpos($_SERVER['PHP_SELF'], '/produtos/') !== false) ? "../" : "";

    header("Location: " . $base . "login.php");
    exit; // Para a execução do script imediatamente após o redirecionamento
}
