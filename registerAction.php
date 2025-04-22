<?php
// Incluir a conexão com o banco de dados
include('db.php');

// Verifique se o formulário foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Imprimir os dados recebidos para depuração
    echo '<pre>';
    print_r($_POST); // Verifique o conteúdo de $_POST
    echo '</pre>';

    // Verifique se os campos necessários foram preenchidos
    if (isset($_POST['username'], $_POST['email'], $_POST['password'])) {
        // Receber dados do formulário
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash da senha (criptografada)

        // Preparar e executar a consulta para inserir os dados
        try {
            $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (:username, :email, :password)");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->execute();

            echo "Usuário cadastrado com sucesso!";
        } catch (PDOException $e) {
            echo "Erro ao cadastrar: " . $e->getMessage();
        }
    } else {
        echo "Por favor, preencha todos os campos.";
    }
} else {
    echo "Método de requisição inválido.";
}
?>
