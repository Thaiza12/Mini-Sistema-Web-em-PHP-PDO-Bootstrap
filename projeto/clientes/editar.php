<?php
/**
 * clientes/editar.php
 * ------------------------------------------------------------------
 * Edita os dados de um cliente existente.
 *
 * 1. Recebe o ID do cliente pela URL (?id=...).
 * 2. Busca os dados atuais para preencher o formulário.
 * 3. Ao enviar, atualiza (UPDATE) os dados no banco.
 * ------------------------------------------------------------------
 */

require "../includes/verificar_login.php";
require "../config/conexao.php";

// Pega o ID enviado pela URL e converte para inteiro (segurança)
$id = (int)($_GET['id'] ?? 0);

// Se o ID for inválido, volta para a listagem
if ($id <= 0) {
    header("Location: listar.php");
    exit;
}

$erro = "";

// Se o formulário foi enviado (salvar alterações)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome     = trim($_POST['nome'] ?? '');
    $cpf      = trim($_POST['cpf'] ?? '');
    $telefone = trim($_POST['telefone'] ?? '');
    $email    = trim($_POST['email'] ?? '');

    if ($nome === '') {
        $erro = "O campo Nome é obrigatório.";
    } else {
        // UPDATE usando Prepared Statement
        $sql = "UPDATE clientes
                SET nome = :nome, cpf = :cpf, telefone = :telefone, email = :email
                WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        header("Location: listar.php?msg=Cliente atualizado com sucesso!");
        exit;
    }
}

// Busca os dados atuais do cliente para mostrar no formulário
$stmt = $pdo->prepare("SELECT * FROM clientes WHERE id = :id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$cliente = $stmt->fetch();

// Se não encontrou o cliente, volta para a listagem
if (!$cliente) {
    header("Location: listar.php");
    exit;
}

$titulo = "Editar Cliente";
require "../includes/header.php";
require "../includes/menu.php";
?>

<div class="container my-4">

    <h2 class="mb-3"><i class="bi bi-pencil-square text-warning"></i> Editar Cliente</h2>

    <?php if ($erro !== ""): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="editar.php?id=<?= $cliente['id'] ?>">
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label class="form-label">Nome *</label>
                        <input type="text" name="nome" class="form-control" required
                               value="<?= htmlspecialchars($cliente['nome']) ?>">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">CPF</label>
                        <input type="text" name="cpf" class="form-control"
                               value="<?= htmlspecialchars($cliente['cpf']) ?>">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Telefone</label>
                        <input type="text" name="telefone" class="form-control"
                               value="<?= htmlspecialchars($cliente['telefone']) ?>">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">E-mail</label>
                        <input type="email" name="email" class="form-control"
                               value="<?= htmlspecialchars($cliente['email']) ?>">
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
