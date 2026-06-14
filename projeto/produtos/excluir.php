<?php
/**
 * produtos/excluir.php
 * ------------------------------------------------------------------
 * Exclui um produto do banco de dados (DELETE com PDO).
 * ------------------------------------------------------------------
 */

require "../includes/verificar_login.php";
require "../config/conexao.php";

$id = (int)($_GET['id'] ?? 0);

if ($id > 0) {
    $sql = "DELETE FROM produtos WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
}

header("Location: listar.php?msg=Produto excluído com sucesso!");
exit;
