<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start(); 
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'Minha Aplicação'; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./css/styles.css">
    <script>
        // Função para exibir aviso ao tentar acessar página restrita
        function showLoginAlert() {
            alert("Você precisa fazer login para acessar esta funcionalidade.");
        }
    </script>
</head>

<body>
<header>
    <nav>
        <ul>
            <li><a href="index.php">Início</a></li>
            
            <?php if (isset($_SESSION['user'])): ?>
                <!-- Link para cadastrar produto, visível apenas se o usuário estiver logado -->
                <li><a href="productForm.php">Cadastrar Produto</a></li>

                <!-- Link para ver os produtos cadastrados, visível somente se o usuário logado cadastrou algum produto -->
                <li><a href="viewProducts.php">Ver Produtos</a></li>

                <!-- Exibir o link de logout -->
                <li><a href="logout.php">Logout</a></li>
            <?php else: ?>
                <!-- Link desativado com aviso para usuários não logados -->
                <li><a href="#" onclick="showLoginAlert()" style="color: grey;">Cadastrar Produto</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Cadastro de Usuário</a></li>
            <?php endif; ?>

            <li><a href="about.php">Sobre</a></li>
        </ul>
    </nav>
</header>
<main>
