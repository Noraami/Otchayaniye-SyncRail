<?php
require "connections/db.php";
session_start();

if (isset($_SESSION["user_name"])) {
    header("Location: pages/status.php");
    exit;
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"] ?? "");
    $password = trim($_POST["password"] ?? "");

    $stmt = $conn->prepare("SELECT pk_user, user_name, user_password FROM usuario WHERE user_mail = ? AND user_password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $dados = $resultado->fetch_assoc();
        $_SESSION["user_name"] = $dados["user_name"];
        $_SESSION["user_id"] = $dados["pk_user"];
        $_SESSION["conected"] = true;
        header("Location: pages/status.php");
        exit;
    } else {
        $error = "E-mail ou senha inválidos.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login_cad.css">
    <title>Login</title>
</head>

<body class="background">
    <div class="container">
        <div class="log">
            <h2>Login</h2>
            <form method="post">
                <input type="email" id="email" name="email" placeholder="Email" class="box" required><br><br>
                <input type="password" id="password" name="password" placeholder="Senha" class="box" required><br>
                <a class="regislink" href="pages/register_user.php">Criar conta</a><br>
                <button type="submit" name="login" class="btn">Entrar</button>
                <?php if ($error): ?>
                    <div class="error"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>
            </form>
        </div>
    </div>
</body>

</html>