<?php
/**
 * login.php
 * ------------------------------------------------------------------
 * Tela de Login do sistema.
 *
 * Funcionalidades:
 *  - Mostra o formulário de login (e-mail e senha)
 *  - Valida o usuário no banco usando PDO + Prepared Statements
 *  - Compara a senha digitada com a senha criptografada (password_verify)
 *  - Cria a sessão do usuário caso o login seja válido
 * ------------------------------------------------------------------
 */

// Inicia a sessão (necessário para guardar o usuário logado)
session_start();

// Inclui o arquivo de conexão com o banco
require "config/conexao.php";

// Se o usuário JÁ estiver logado, manda direto para o dashboard
if (isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit;
}

// Variável para guardar mensagens de erro
$erro = "";

// Verifica se o formulário foi enviado (método POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Pega os dados enviados pelo formulário
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    // Valida se os campos foram preenchidos
    if ($email === '' || $senha === '') {
        $erro = "Preencha o e-mail e a senha.";
    } else {
        // Busca o usuário no banco pelo e-mail (Prepared Statement = seguro)
        $sql = "SELECT * FROM usuarios WHERE email = :email LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Pega o resultado da consulta
        $usuario = $stmt->fetch();

        // Verifica se o usuário existe E se a senha confere
        // password_verify compara a senha digitada com o hash do banco
        if ($usuario && password_verify($senha, $usuario['senha'])) {

            // Login válido! Guarda os dados na sessão
            $_SESSION['usuario_id']   = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            $_SESSION['usuario_email']= $usuario['email'];

            // Redireciona para o dashboard
            header("Location: index.php");
            exit;
        } else {
            // Login inválido
            $erro = "E-mail ou senha incorretos.";
        }
    }
}

// Define o título da página e inclui o cabeçalho
$titulo = "Login - Mini Sistema";
require "includes/header.php";
?>

<!-- Tela de login centralizada e responsiva -->
<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-12 col-sm-10 col-md-6 col-lg-4">

            <div class="card shadow-lg border-0">
                <div class="card-body p-4">

                    <!-- Título -->
                    <div class="text-center mb-4">
                        <i class="bi bi-box-seam text-primary" style="font-size: 3rem;"></i>
                        <h3 class="mt-2">Mini Sistema</h3>
                        <p class="text-muted">Faça login para continuar</p>
                    </div>

                    <!-- Mensagem de erro (se houver) -->
                    <?php if ($erro !== ""): ?>
                        <div class="alert alert-danger">
                            <i class="bi bi-exclamation-triangle"></i> <?= htmlspecialchars($erro) ?>
                        </div>
                    <?php endif; ?>

                    <!-- Formulário de login -->
                    <form method="POST" action="login.php">
                        <div class="mb-3">
                            <label class="form-label">E-mail</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input type="email" name="email" class="form-control"
                                       placeholder="admin@admin.com" required autofocus>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Senha</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input type="password" name="senha" class="form-control"
                                       placeholder="Digite sua senha" required>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-box-arrow-in-right"></i> Entrar
                            </button>
                        </div>
                    </form>

                    <!-- Dica de login padrão (apenas para o trabalho acadêmico) -->
                    <div class="alert alert-info mt-4 mb-0 small">
                        <strong>Login padrão:</strong><br>
                        E-mail: admin@admin.com<br>
                        Senha: 123456
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<?php require "includes/footer.php"; ?>
