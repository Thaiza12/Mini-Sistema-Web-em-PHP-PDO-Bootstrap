<?php
/**
 * produtos/cadastrar.php
 * ------------------------------------------------------------------
 * Cadastra um novo produto no banco de dados (PDO + Prepared Statement).
 * ------------------------------------------------------------------
 */

require "../includes/verificar_login.php";
require "../config/conexao.php";

$erro = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome       = trim($_POST['nome'] ?? '');
    $categoria  = trim($_POST['categoria'] ?? '');
    $quantidade = (int)($_POST['quantidade'] ?? 0);
    // str_replace troca vírgula por ponto, pois o banco usa ponto decimal
    $preco      = (float)str_replace(',', '.', $_POST['preco'] ?? '0');

    if ($nome === '') {
        $erro = "O campo Nome do Produto é obrigatório.";
    } else {
        $sql = "INSERT INTO produtos (nome, categoria, quantidade, preco, data_cadastro)
                VALUES (:nome, :categoria, :quantidade, :preco, NOW())";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':categoria', $categoria);
        $stmt->bindParam(':quantidade', $quantidade, PDO::PARAM_INT);
        $stmt->bindParam(':preco', $preco);
        $stmt->execute();

        header("Location: listar.php?msg=Produto cadastrado com sucesso!");
        exit;
    }
}

$titulo = "Cadastrar Produto";
require "../includes/header.php";
require "../includes/menu.php";
?>

<div class="container my-4">

    <h2 class="mb-3"><i class="bi bi-bag-plus text-success"></i> Cadastrar Produto</h2>

    <?php if ($erro !== ""): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="cadastrar.php">
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label class="form-label">Nome do Produto *</label>
                        <input type="text" name="nome" class="form-control" required>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Categoria</label>
                        <input type="text" name="categoria" class="form-control">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Quantidade</label>
                        <input type="number" name="quantidade" class="form-control"
                               value="0" min="0">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Preço (R$)</label>
                        <input type="text" name="preco" class="form-control"
                               placeholder="0,00">
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle"></i> Salvar
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
