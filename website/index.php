<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Site com Docker + MySQL</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(120deg, #89f7fe, #66a6ff);
            text-align: center;
            padding-top: 50px;
        }
        h1 {
            color: #2c3e50;
        }
        form {
            background: white;
            display: inline-block;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        input {
            padding: 10px;
            width: 200px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-right: 10px;
        }
        button {
            padding: 10px 15px;
            background: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background: #2980b9;
        }
    </style>
</head>
<body>
    <h1>💾 Salve seu nome no banco!</h1>
    <form method="POST">
        <input type="text" name="nome" placeholder="Digite seu nome" required>
        <button type="submit">Salvar</button>
    </form>

<?php
$servername = "mysql";
$username = "root";
$password = "root";
$dbname = "meubanco";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("<p style='color:red;'>Erro na conexão: " . $conn->connect_error . "</p>");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $sql = "INSERT INTO nomes (nome) VALUES ('$nome')";
    if ($conn->query($sql) === TRUE) {
        echo "<p style='color:green;'>Nome salvo com sucesso!</p>";
    } else {
        echo "<p style='color:red;'>Erro: " . $conn->error . "</p>";
    }
}

$result = $conn->query("SELECT * FROM nomes");
if ($result->num_rows > 0) {
    echo "<h2>Nomes cadastrados:</h2><ul>";
    while($row = $result->fetch_assoc()) {
        echo "<li>" . htmlspecialchars($row['nome']) . "</li>";
    }
    echo "</ul>";
}
$conn->close();
?>
</body>
</html>
