<?php
/**
 * index.php  (DASHBOARD)
 * ------------------------------------------------------------------
 * Página inicial após o login.
 *
 * Mostra, em cards do Bootstrap:
 *  - Total de Clientes cadastrados
 *  - Total de Produtos cadastrados
 *  - Usuário logado
 *  - Data atual
 * ------------------------------------------------------------------
 */

// Protege a página: só acessa quem está logado
require "includes/verificar_login.php";

// Conexão com o banco
require "config/conexao.php";

// Conta o total de clientes usando PDO
$totalClientes = $pdo->query("SELECT COUNT(*) FROM clientes")->fetchColumn();

// Conta o total de produtos usando PDO
$totalProdutos = $pdo->query("SELECT COUNT(*) FROM produtos")->fetchColumn();

// Define o título e inclui cabeçalho + menu
$titulo = "Dashboard - Mini Sistema";
require "includes/header.php";
require "includes/menu.php";
?>

<div class="container my-4">

    <!-- Saudação -->
    <h2 class="mb-1">
        <i class="bi bi-speedometer2 text-primary"></i> Dashboard
    </h2>
    <p class="text-muted">
        Bem-vindo(a), <strong><?= htmlspecialchars($_SESSION['usuario_nome']) ?></strong>!
    </p>

    <!-- Cards responsivos -->
    <div class="row g-4 mt-1">

        <!-- Card: Total de Clientes -->
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card text-white bg-primary shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-1">Total de Clientes</h6>
                            <h2 class="mb-0"><?= $totalClientes ?></h2>
                        </div>
                        <i class="bi bi-people" style="font-size: 2.5rem; opacity:.6;"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card: Total de Produtos -->
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card text-white bg-success shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-1">Total de Produtos</h6>
                            <h2 class="mb-0"><?= $totalProdutos ?></h2>
                        </div>
                        <i class="bi bi-bag" style="font-size: 2.5rem; opacity:.6;"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card: Usuário Logado -->
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card text-white bg-info shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-1">Usuário Logado</h6>
                            <h5 class="mb-0"><?= htmlspecialchars($_SESSION['usuario_nome']) ?></h5>
                        </div>
                        <i class="bi bi-person-circle" style="font-size: 2.5rem; opacity:.6;"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card: Data Atual -->
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card text-white bg-dark shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-1">Data Atual</h6>
                            <!-- date() formata a data no padrão dia/mês/ano -->
                            <h5 class="mb-0"><?= date("d/m/Y") ?></h5>
                        </div>
                        <i class="bi bi-calendar3" style="font-size: 2.5rem; opacity:.6;"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Atalhos rápidos -->
    <div class="row g-4 mt-2">
        <div class="col-12 col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="bi bi-people text-primary" style="font-size: 2.5rem;"></i>
                    <h5 class="mt-2">Gerenciar Clientes</h5>
                    <p class="text-muted">Cadastre, edite e pesquise clientes.</p>
                    <a href="clientes/listar.php" class="btn btn-outline-primary">
                        Acessar Clientes
                    </a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="bi bi-bag text-success" style="font-size: 2.5rem;"></i>
                    <h5 class="mt-2">Gerenciar Produtos</h5>
                    <p class="text-muted">Cadastre, edite e pesquise produtos.</p>
                    <a href="produtos/listar.php" class="btn btn-outline-success">
                        Acessar Produtos
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>

<?php require "includes/footer.php"; ?>
