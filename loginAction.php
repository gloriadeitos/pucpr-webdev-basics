<?php
session_start();
include 'dbn.php'; // Conexão com o banco

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Verificar usuário no banco de dados
    $query = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
    $query->execute([$email]);
    $user = $query->fetch();

    if ($user && password_verify($password, $user['senha'])) {
        $_SESSION['user'] = $user;
        header('Location: index.php'); // Redireciona após login
    } else {
        echo "Credenciais inválidas!";
    }
}
?>
