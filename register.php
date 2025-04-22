<?php
// Iniciar a sessão para armazenar mensagens
session_start();

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificar se todos os campos foram preenchidos
    if (empty($_POST['nome']) || empty($_POST['email']) || empty($_POST['senha'])) {
        $_SESSION['error_message'] = "Por favor, preencha todos os campos.";
    } else {
        // Conectar ao banco de dados
        include('db.php');

        // Preparar a consulta de inserção
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);  // Criptografando a senha

        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nome, $email, $senha]);

        // Mensagem de sucesso
        $_SESSION['success_message'] = "Usuário cadastrado com sucesso!";
    }
}

// Incluir o cabeçalho padrão
include 'header.php'; 
?>

<main>
    <h1>Cadastro de Usuário</h1>
    
    <!-- Formulário de cadastro -->
    <form action="register.php" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" required><br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br>
        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" required><br>
        <button type="submit">Cadastrar</button>
    </form>

    <!-- Exibir mensagens de erro ou sucesso -->
    <?php
    // Mostrar mensagem de erro caso algum campo esteja vazio
    if (isset($_SESSION['error_message'])) {
        echo "<p class='error'>{$_SESSION['error_message']}</p>";
        unset($_SESSION['error_message']);
    }

    // Mostrar mensagem de sucesso caso o cadastro tenha sido realizado com sucesso
    if (isset($_SESSION['success_message'])) {
        echo "<p class='success'>{$_SESSION['success_message']}</p>";
        unset($_SESSION['success_message']);
    }
    ?>
</main>

<?php include 'footer.php'; ?>
