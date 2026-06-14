<?php
/**
 * clientes/excluir.php
 * ------------------------------------------------------------------
 * Exclui um cliente do banco de dados.
 *
 * Recebe o ID pela URL (?id=...) e executa o DELETE com
 * Prepared Statement.
 * ------------------------------------------------------------------
 */

require "../includes/verificar_login.php";
require "../config/conexao.php";

// Pega o ID e converte para inteiro (segurança)
$id = (int)($_GET['id'] ?? 0);

// Se o ID for válido, executa a exclusão
if ($id > 0) {
    $sql = "DELETE FROM clientes WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
}

// Volta para a listagem com mensagem
header("Location: listar.php?msg=Cliente excluído com sucesso!");
exit;
