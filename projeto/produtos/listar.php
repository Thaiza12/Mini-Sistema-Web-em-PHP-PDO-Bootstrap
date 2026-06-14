<?php
/**
 * produtos/listar.php
 * ------------------------------------------------------------------
 * Lista todos os produtos em uma tabela responsiva.
 *
 * Funcionalidades:
 *  - Listar todos os produtos
 *  - Pesquisar por nome ou categoria
 *  - Botões para Editar e Excluir
 *  - Botão para Cadastrar novo produto
 * ------------------------------------------------------------------
 */

require "../includes/verificar_login.php";
require "../config/conexao.php";

// Termo de pesquisa
$busca = trim($_GET['busca'] ?? '');

if ($busca !== '') {
    $sql = "SELECT * FROM produtos
            WHERE nome LIKE :busca
               OR categoria LIKE :busca
            ORDER BY id DESC";
    $stmt = $pdo->prepare($sql);
    $termo = "%$busca%";
    $stmt->bindParam(':busca', $termo);
    $stmt->execute();
} else {
    $stmt = $pdo->query("SELECT * FROM produtos ORDER BY id DESC");
}

$produtos = $stmt->fetchAll();

$titulo = "Produtos - Mini Sistema";
require "../includes/header.php";
require "../includes/menu.php";
?>

<div class="container my-4">

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
        <h2 class="mb-0"><i class="bi bi-bag text-success"></i> Produtos</h2>
        <a href="cadastrar.php" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Novo Produto
        </a>
    </div>

    <?php if (isset($_GET['msg'])): ?>
        <div class="alert alert-success">
            <i class="bi bi-check-circle"></i> <?= htmlspecialchars($_GET['msg']) ?>
        </div>
    <?php endif; ?>

    <!-- Pesquisa -->
    <form method="GET" action="listar.php" class="row g-2 mb-3">
        <div class="col-12 col-md-9">
            <input type="text" name="busca" class="form-control"
                   placeholder="Pesquisar por nome ou categoria..."
                   value="<?= htmlspecialchars($busca) ?>">
        </div>
        <div class="col-6 col-md-2 d-grid">
            <button type="submit" class="btn btn-outline-success">
                <i class="bi bi-search"></i> Buscar
            </button>
        </div>
        <div class="col-6 col-md-1 d-grid">
            <a href="listar.php" class="btn btn-outline-secondary">Limpar</a>
        </div>
    </form>

    <!-- Tabela responsiva -->
    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Produto</th>
                        <th>Categoria</th>
                        <th>Qtd.</th>
                        <th>Preço</th>
                        <th>Cadastro</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($produtos) === 0): ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                Nenhum produto encontrado.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($produtos as $p): ?>
                            <tr>
                                <td><?= $p['id'] ?></td>
                                <td><?= htmlspecialchars($p['nome']) ?></td>
                                <td><?= htmlspecialchars($p['categoria']) ?></td>
                                <td><?= (int)$p['quantidade'] ?></td>
                                <!-- number_format formata o preço no padrão brasileiro -->
                                <td>R$ <?= number_format($p['preco'], 2, ',', '.') ?></td>
                                <td><?= date("d/m/Y", strtotime($p['data_cadastro'])) ?></td>
                                <td class="text-end text-nowrap">
                                    <a href="editar.php?id=<?= $p['id'] ?>"
                                       class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="excluir.php?id=<?= $p['id'] ?>"
                                       class="btn btn-sm btn-danger btn-excluir">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?php require "../includes/footer.php"; ?>
