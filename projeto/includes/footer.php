<?php
/**
 * includes/footer.php
 * ------------------------------------------------------------------
 * Rodapé HTML reutilizável.
 *
 * Contém:
 *  - O rodapé visual do sistema
 *  - O JavaScript do Bootstrap 5 (necessário para navbar, modais, etc.)
 *  - O JS personalizado do projeto
 *  - O fechamento das tags <body> e <html>
 * ------------------------------------------------------------------
 */

// Ajusta o caminho base (para funcionar dentro das subpastas)
if (!isset($base)) {
    $base = (strpos($_SERVER['PHP_SELF'], '/clientes/') !== false
          || strpos($_SERVER['PHP_SELF'], '/produtos/') !== false) ? "../" : "";
}
?>
    <!-- Rodapé -->
    <footer class="text-center text-muted py-4 mt-5 border-top">
        <small>
            Mini Sistema Web &copy; <?= date("Y") ?> —
            Trabalho Acadêmico de Desenvolvimento Web
        </small>
    </footer>

    <!-- Bootstrap 5 via CDN (JavaScript - inclui Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JS personalizado do projeto -->
    <script src="<?= $base ?>assets/js/script.js"></script>
</body>
</html>
