<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado do Cadastro</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
        }
        .container {
            text-align: center;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            background-color: #fff;
        }
        h1 {
            color: #4CAF50;
            font-size: 24px;
            margin-bottom: 1rem;
        }
        p {
            font-size: 18px;
            color: #333;
        }
        .error {
            color: #FF0000;
        }
        .success {
            color: #4CAF50;
        }
    </style>
</head>
<body>

<div class="container">
    <?php
    // Verificando se os dados foram enviados pelo formulário
    if (isset($_POST['email']) && isset($_POST['name']) && isset($_POST['sobrenome']) && isset($_POST['Gender'])) {
        // Coletando dados do formulário
        $nome = htmlspecialchars($_POST['name']);
        $sobrenome = htmlspecialchars($_POST['sobrenome']);
        $email = htmlspecialchars($_POST['email']);
        $genero = htmlspecialchars($_POST['Gender']);
    
        // Exibindo a mensagem de sucesso
        echo "<h1 class='success'>Dados recebidos com sucesso!</h1>";
        echo "<p>Obrigado, $nome $sobrenome! Seus dados foram cadastrados com sucesso.</p>";
        echo "<p>Email: $email</p>";
        echo "<p>Gênero: $genero</p>";
    } else {
        echo "<h1 class='error'>Por favor, preencha todos os campos.</h1>";
    }
    
    ?>

<?php
// Configurações de conexão com o banco de dados
$host = 'localhost';
$dbname = 'Teste';
$user = 'root'; 
$password = ''; 

try {
    // Criando uma nova conexão PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    // Configurando o PDO para lançar exceções em caso de erro
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Verificando se os dados foram enviados pelo formulário
    if (isset($_POST['email'], $_POST['name'], $_POST['sobrenome'], $_POST['Gender'])) {
        // Coletando dados do formulário
        $nome = htmlspecialchars($_POST['name']);
        $sobrenome = htmlspecialchars($_POST['sobrenome']);
        $email = htmlspecialchars($_POST['email']);
        $genero = htmlspecialchars($_POST['Gender']);

        // Preparando a declaração SQL para inserção dos dados
        $sql = "INSERT INTO contatos (nome, sobrenome, email, genero) VALUES (:nome, :sobrenome, :email, :genero)";
        $stmt = $pdo->prepare($sql);

        // Vinculando parâmetros
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':sobrenome', $sobrenome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':genero', $genero);

        // Executando a declaração SQL
        if ($stmt->execute()) {
            echo "Dados inseridos com sucesso!";
        } else {
            echo "Erro ao inserir dados.";
        }
    } else {
        echo "Por favor, preencha todos os campos.";
    }
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}


?>
<br><br>
<button onclick="window.location.href='index.html'">Voltar</button>

</div>






</body>
</html>
