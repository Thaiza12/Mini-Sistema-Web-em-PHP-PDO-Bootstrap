<?php
/**
 * clientes/cadastrar.php
 * ------------------------------------------------------------------
 * Cadastra um novo cliente no banco de dados.
 *
 * Mostra o formulário e, quando enviado, insere os dados usando
 * PDO + Prepared Statements (forma segura).
 * ------------------------------------------------------------------
 */

require "../includes/verificar_login.php";
require "../config/conexao.php";

$erro = "";

// Se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Captura e limpa os dados
    $nome     = trim($_POST['nome'] ?? '');
    $cpf      = trim($_POST['cpf'] ?? '');
    $telefone = trim($_POST['telefone'] ?? '');
    $email    = trim($_POST['email'] ?? '');

    // Validação simples: nome é obrigatório
    if ($nome === '') {
        $erro = "O campo Nome é obrigatório.";
    } else {
        // INSERT usando Prepared Statement (evita SQL Injection)
        $sql = "INSERT INTO clientes (nome, cpf, telefone, email, data_cadastro)
                VALUES (:nome, :cpf, :telefone, :email, NOW())";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Volta para a listagem com mensagem de sucesso
        header("Location: listar.php?msg=Cliente cadastrado com sucesso!");
        exit;
    }
}

$titulo = "Cadastrar Cliente";
require "../includes/header.php";
require "../includes/menu.php";
?>

<div class="container my-4">

    <h2 class="mb-3"><i class="bi bi-person-plus text-primary"></i> Cadastrar Cliente</h2>

    <?php if ($erro !== ""): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-body">
            <!-- Formulário responsivo -->
            <form method="POST" action="cadastrar.php">
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label class="form-label">Nome *</label>
                        <input type="text" name="nome" class="form-control" required>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">CPF</label>
                        <input type="text" name="cpf" class="form-control"
                               placeholder="000.000.000-00">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Telefone</label>
                        <input type="text" name="telefone" class="form-control"
                               placeholder="(00) 00000-0000">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">E-mail</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
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
