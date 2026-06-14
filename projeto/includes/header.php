<?php
/**
 * includes/header.php
 * ------------------------------------------------------------------
 * Cabeçalho HTML reutilizável.
 *
 * Contém:
 *  - A abertura do HTML (<!DOCTYPE>, <head>, etc.)
 *  - O link do Bootstrap 5 via CDN
 *  - O CSS personalizado do projeto
 *
 * A variável $titulo pode ser definida ANTES de incluir este arquivo
 * para mudar o título da aba do navegador. Ex.: $titulo = "Clientes";
 *
 * A variável $base é usada para ajustar os caminhos quando estamos
 * dentro de subpastas (clientes/ e produtos/).
 * ------------------------------------------------------------------
 */

// Se o título não foi definido, usa um padrão
if (!isset($titulo)) {
    $titulo = "Mini Sistema Web";
}

// Detecta se estamos dentro de uma subpasta para ajustar os caminhos
if (!isset($base)) {
    $base = (strpos($_SERVER['PHP_SELF'], '/clientes/') !== false
          || strpos($_SERVER['PHP_SELF'], '/produtos/') !== false) ? "../" : "";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <!-- Meta viewport: essencial para a responsividade (celular/tablet) -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= htmlspecialchars($titulo) ?></title>

    <!-- Bootstrap 5 via CDN (CSS) -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <!-- Ícones do Bootstrap (opcional, deixa o sistema mais bonito) -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        rel="stylesheet">

    <!-- CSS personalizado do projeto -->
    <link rel="stylesheet" href="<?= $base ?>assets/css/style.css">
</head>
<body>
