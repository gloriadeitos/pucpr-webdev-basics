<?php 
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php'); // Redireciona para login se não estiver autenticado
    exit();
}

$title = "Cadastro de Produto";
include 'header.php'; 
?>

<h1>Cadastro de Produto</h1>

<!-- Exibir mensagem de sucesso, se existir -->
<?php
if (isset($_SESSION['success_message'])) {
    echo "<p class='success'>{$_SESSION['success_message']}</p>";
    unset($_SESSION['success_message']); // Limpar a mensagem após exibição
}
?>

<section id="card">
    <form action="productAction.php" method="POST">
        <label for="productName">Nome do Produto:</label>
        <input type="text" id="productName" name="product_name" required>
        <br>
        <label for="price">Preço:</label>
        <input type="number" id="price" name="price" step="0.01" min="0" required>
        <br>
        <label for="stock">Estoque:</label>
        <input type="number" id="stock" name="stock" min="0" required>
        <br>
        <label for="category">Categoria:</label>
        <input type="text" id="category" name="category">
        <br><br>
        <label for="productDescription">Descrição:</label>
        <textarea id="productDescription" name="product_description" required></textarea>
        <br><br>
        <button type="submit">Cadastrar Produto</button>
    </form>
</section>

<?php include 'footer.php'; ?>
