<?php
session_start();
include('db.php'); // Conectar ao banco de dados

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recupera o email e senha enviados
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verificar se o usuário existe
    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $usuario = $stmt->fetch();

    if ($usuario && password_verify($senha, $usuario['senha'])) {
        // Definir a sessão para o usuário logado
        $_SESSION['user'] = $usuario['nome']; // Armazena o nome do usuário logado
        $_SESSION['user_id'] = $usuario['id']; // Armazena o ID do usuário
        header('Location: index.php'); // Redireciona para a página principal
        exit();
    } else {
        // Mensagem de erro se as credenciais forem inválidas
        $_SESSION['error_message'] = "Credenciais inválidas.";
    }
}
?>

<?php include 'header.php'; // Inclui o header padrão ?>

<main>
    <h1>Login</h1>
    
    <!-- Formulário de login -->
    <form action="login.php" method="POST">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br>
        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" required><br>
        <button type="submit">Entrar</button>
    </form>

    <!-- Exibir mensagem de erro -->
    <?php
    if (isset($_SESSION['error_message'])) {
        echo "<p class='error'>{$_SESSION['error_message']}</p>";
        unset($_SESSION['error_message']);
    }
    ?>
</main>

<?php include 'footer.php'; // Inclui o footer padrão ?>
