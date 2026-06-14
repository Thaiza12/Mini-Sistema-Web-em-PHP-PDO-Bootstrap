<?php
/**
 * clientes/listar.php
 * ------------------------------------------------------------------
 * Lista todos os clientes em uma tabela responsiva.
 *
 * Funcionalidades:
 *  - Listar todos os clientes
 *  - Pesquisar por nome, CPF ou e-mail
 *  - Botões para Editar e Excluir
 *  - Botão para Cadastrar novo cliente
 * ------------------------------------------------------------------
 */

// Protege a página e abre a conexão
require "../includes/verificar_login.php";
require "../config/conexao.php";

// Pega o termo de pesquisa enviado pela URL (se houver)
$busca = trim($_GET['busca'] ?? '');

// Monta a consulta. Se houver busca, filtra; senão, traz todos.
if ($busca !== '') {
    // Usamos LIKE para pesquisar parte do texto (Prepared Statement = seguro)
    $sql = "SELECT * FROM clientes
            WHERE nome LIKE :busca
               OR cpf LIKE :busca
               OR email LIKE :busca
            ORDER BY id DESC";
    $stmt = $pdo->prepare($sql);
    // O % antes e depois permite encontrar o termo em qualquer parte do texto
    $termo = "%$busca%";
    $stmt->bindParam(':busca', $termo);
    $stmt->execute();
} else {
    // Sem busca: traz todos os clientes ordenados do mais novo para o mais antigo
    $stmt = $pdo->query("SELECT * FROM clientes ORDER BY id DESC");
}

// Pega todos os resultados
$clientes = $stmt->fetchAll();

// Título, cabeçalho e menu
$titulo = "Clientes - Mini Sistema";
require "../includes/header.php";
require "../includes/menu.php";
?>

<div class="container my-4">

    <!-- Cabeçalho da página -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
        <h2 class="mb-0"><i class="bi bi-people text-primary"></i> Clientes</h2>
        <a href="cadastrar.php" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Novo Cliente
        </a>
    </div>

    <!-- Mensagem de sucesso (vinda de cadastro/edição/exclusão) -->
    <?php if (isset($_GET['msg'])): ?>
        <div class="alert alert-success">
            <i class="bi bi-check-circle"></i> <?= htmlspecialchars($_GET['msg']) ?>
        </div>
    <?php endif; ?>

    <!-- Formulário de pesquisa -->
    <form method="GET" action="listar.php" class="row g-2 mb-3">
        <div class="col-12 col-md-9">
            <input type="text" name="busca" class="form-control"
                   placeholder="Pesquisar por nome, CPF ou e-mail..."
                   value="<?= htmlspecialchars($busca) ?>">
        </div>
        <div class="col-6 col-md-2 d-grid">
            <button type="submit" class="btn btn-outline-primary">
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
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Telefone</th>
                        <th>E-mail</th>
                        <th>Cadastro</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($clientes) === 0): ?>
                        <!-- Caso não exista nenhum cliente -->
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                Nenhum cliente encontrado.
                            </td>
                        </tr>
                    <?php else: ?>
                        <!-- Percorre cada cliente e mostra na tabela -->
                        <?php foreach ($clientes as $c): ?>
                            <tr>
                                <td><?= $c['id'] ?></td>
                                <td><?= htmlspecialchars($c['nome']) ?></td>
                                <td><?= htmlspecialchars($c['cpf']) ?></td>
                                <td><?= htmlspecialchars($c['telefone']) ?></td>
                                <td><?= htmlspecialchars($c['email']) ?></td>
                                <td><?= date("d/m/Y", strtotime($c['data_cadastro'])) ?></td>
                                <td class="text-end text-nowrap">
                                    <!-- Botão Editar -->
                                    <a href="editar.php?id=<?= $c['id'] ?>"
                                       class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <!-- Botão Excluir (com confirmação via JS) -->
                                    <a href="excluir.php?id=<?= $c['id'] ?>"
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
