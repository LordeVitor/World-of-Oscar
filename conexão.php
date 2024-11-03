<?php
$host = 'localhost';      // Endereço do servidor MySQL (pode ser localhost)
$dbname = 'Teste'; // Nome do banco de dados
$user = 'root';         // Usuário do banco de dados
$password = '';       // Senha do banco de dados

try {
    // Criando uma nova conexão PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    // Configurando o PDO para lançar exceções em caso de erro
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexão realizada com sucesso!";
} catch (PDOException $e) {
    // Tratando possíveis erros de conexão
    echo "Erro na conexão: " . $e->getMessage();
}
?>
