<?php
/**
 * produtos/editar.php
 * ------------------------------------------------------------------
 * Edita os dados de um produto existente (UPDATE com PDO).
 * ------------------------------------------------------------------
 */

require "../includes/verificar_login.php";
require "../config/conexao.php";

$id = (int)($_GET['id'] ?? 0);

if ($id <= 0) {
    header("Location: listar.php");
    exit;
}

$erro = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome       = trim($_POST['nome'] ?? '');
    $categoria  = trim($_POST['categoria'] ?? '');
    $quantidade = (int)($_POST['quantidade'] ?? 0);
    $preco      = (float)str_replace(',', '.', $_POST['preco'] ?? '0');

    if ($nome === '') {
        $erro = "O campo Nome do Produto é obrigatório.";
    } else {
        $sql = "UPDATE produtos
                SET nome = :nome, categoria = :categoria,
                    quantidade = :quantidade, preco = :preco
                WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':categoria', $categoria);
        $stmt->bindParam(':quantidade', $quantidade, PDO::PARAM_INT);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        header("Location: listar.php?msg=Produto atualizado com sucesso!");
        exit;
    }
}

// Busca os dados atuais do produto
$stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = :id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$produto = $stmt->fetch();

if (!$produto) {
    header("Location: listar.php");
    exit;
}

$titulo = "Editar Produto";
require "../includes/header.php";
require "../includes/menu.php";
?>

<div class="container my-4">

    <h2 class="mb-3"><i class="bi bi-pencil-square text-warning"></i> Editar Produto</h2>

    <?php if ($erro !== ""): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="editar.php?id=<?= $produto['id'] ?>">
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label class="form-label">Nome do Produto *</label>
                        <input type="text" name="nome" class="form-control" required
                               value="<?= htmlspecialchars($produto['nome']) ?>">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Categoria</label>
                        <input type="text" name="categoria" class="form-control"
                               value="<?= htmlspecialchars($produto['categoria']) ?>">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Quantidade</label>
                        <input type="number" name="quantidade" class="form-control" min="0"
                               value="<?= (int)$produto['quantidade'] ?>">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Preço (R$)</label>
                        <input type="text" name="preco" class="form-control"
                               value="<?= number_format($produto['preco'], 2, ',', '.') ?>">
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-check-circle"></i> Atualizar
                    </button>
                    <a href="listar.php" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>

</div>

<?php require "../includes/footer.php"; ?>
