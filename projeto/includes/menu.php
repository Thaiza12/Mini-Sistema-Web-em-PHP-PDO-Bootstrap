<?php
/**
 * includes/menu.php
 * ------------------------------------------------------------------
 * Menu de navegação superior (Navbar do Bootstrap 5).
 *
 * É responsivo: em telas pequenas ele vira um botão "hambúrguer".
 * Mostra o nome do usuário logado e o botão de sair (logout).
 *
 * Este arquivo deve ser incluído nas páginas internas, depois do header.
 * ------------------------------------------------------------------
 */

// Garante que a sessão esteja iniciada para ler o nome do usuário
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Ajusta o caminho base (para funcionar dentro das subpastas)
if (!isset($base)) {
    $base = (strpos($_SERVER['PHP_SELF'], '/clientes/') !== false
          || strpos($_SERVER['PHP_SELF'], '/produtos/') !== false) ? "../" : "";
}
?>
<!-- Navbar responsiva do Bootstrap -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
        <!-- Logo / nome do sistema -->
        <a class="navbar-brand fw-bold" href="<?= $base ?>index.php">
            <i class="bi bi-box-seam"></i> Mini Sistema
        </a>

        <!-- Botão hambúrguer (aparece em telas pequenas) -->
        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse" data-bs-target="#menuPrincipal">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Itens do menu -->
        <div class="collapse navbar-collapse" id="menuPrincipal">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= $base ?>index.php">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $base ?>clientes/listar.php">
                        <i class="bi bi-people"></i> Clientes
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $base ?>produtos/listar.php">
                        <i class="bi bi-bag"></i> Produtos
                    </a>
                </li>
            </ul>

            <!-- Lado direito: usuário logado + sair -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <span class="nav-link text-white-50">
                        <i class="bi bi-person-circle"></i>
                        <?= htmlspecialchars($_SESSION['usuario_nome'] ?? 'Usuário') ?>
                    </span>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-warning" href="<?= $base ?>logout.php">
                        <i class="bi bi-box-arrow-right"></i> Sair
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
