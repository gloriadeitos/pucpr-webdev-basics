<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['user'])) {
    header('Location: login.php'); // Redireciona para login se não estiver autenticado
    exit();
}

include 'db.php'; // Incluir a conexão com o banco de dados

// Verificar se os dados foram enviados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Pegar os dados do formulário
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $category = $_POST['category'];

    // Validar se todos os campos obrigatórios foram preenchidos
    if (empty($product_name) || empty($product_description) || empty($price) || empty($stock)) {
        echo "Por favor, preencha todos os campos obrigatórios.";
        exit();
    }

    // Inserir os dados na tabela de produtos
    $sql = "INSERT INTO produtos (nome, descricao, preco, quantidade, categoria) 
            VALUES (:nome, :descricao, :preco, :quantidade, :categoria)";

    $stmt = $pdo->prepare($sql);

    try {
        // Executar a query com os valores
        $stmt->execute([
            ':nome' => $product_name,
            ':descricao' => $product_description,
            ':preco' => $price,
            ':quantidade' => $stock,
            ':categoria' => $category
        ]);

        // Armazenar a mensagem de sucesso na sessão
        $_SESSION['success_message'] = "Produto cadastrado com sucesso!";
        
        // Redirecionar de volta para o formulário de cadastro de produto
        header('Location: productForm.php');
        exit();
    } catch (PDOException $e) {
        // Caso ocorra um erro, exibe uma mensagem
        echo "Erro ao cadastrar produto: " . $e->getMessage();
    }
}
?>
