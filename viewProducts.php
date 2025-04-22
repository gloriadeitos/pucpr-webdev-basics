<?php
session_start();
include('db.php');

// Verificar se o usuário está logado e se tem produtos cadastrados
if (!isset($_SESSION['user'])) {
    header('Location: login.php'); // Redireciona para login se não estiver autenticado
    exit();
}

// Buscar os produtos cadastrados no banco
$sql = "SELECT * FROM produtos";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$produtos = $stmt->fetchAll();
?>

<?php include 'header.php'; // Inclui o cabeçalho padrão ?>

<h1>Produtos Cadastrados</h1>

<section id="card2">

<?php if (empty($produtos)): ?>
    <p>Não há produtos cadastrados.</p>
<?php else: ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Estoque</th>
                    <th>Categoria</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produtos as $produto): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($produto['nome']); ?></td>
                        <td><?php echo htmlspecialchars($produto['descricao']); ?></td>
                        <td><?php echo htmlspecialchars($produto['preco']); ?></td>
                        <td><?php echo htmlspecialchars($produto['quantidade']); ?></td>
                        <td><?php echo htmlspecialchars($produto['categoria']); ?></td>
                        <td>
                            <form action="deleteProduct.php" method="POST" onsubmit="return confirm('Tem certeza de que deseja deletar este produto?');">
                                <input type="hidden" name="product_id" value="<?php echo $produto['id']; ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Deletar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>
</section>

<?php include 'footer.php'; // Inclui o rodapé padrão ?>
