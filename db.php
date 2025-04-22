<?php
// Configuração do banco de dados
$host = 'localhost';      // Host do MySQL
$user = 'root';           // Usuário do MySQL
$password = '';           // Senha do MySQL (geralmente é vazia no XAMPP)
$database = 'somativa2-fundamentosweb';  // Nome do seu banco de dados

// Conexão com o banco de dados usando PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $user, $password);
    // Defina o modo de erro do PDO para exceções
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Falha na conexão: " . $e->getMessage());
}
?>
