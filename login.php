<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_data";

// Criar conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    // Hash da senha antes de armazenar
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Inserir dados no banco de dados
    $sql = "INSERT INTO users (email, password) VALUES ('$email', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        echo "Novo registro criado com sucesso";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }

    // Redirecionar para uma página de confirmação
    header("Location: confirmation.html");
    exit();
}

$conn->close();
?>
