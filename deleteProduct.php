<?php
session_start();
include('db.php');

// Verificar se o usuário está logado
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

// Verificar se o ID do produto foi enviado
if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    // Deletar o produto no banco de dados
    $sql = "DELETE FROM produtos WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$product_id]);

    // Mensagem de sucesso
    $_SESSION['success_message'] = "Produto deletado com sucesso!";
} else {
    // Mensagem de erro
    $_SESSION['error_message'] = "Erro ao tentar deletar o produto.";
}

header('Location: viewProducts.php'); // Redireciona de volta para a página de produtos
exit();
