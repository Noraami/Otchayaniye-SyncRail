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

    // Busca o usuário pelo email
    $stmt = $conn->prepare("SELECT pk_user, user_name, user_password FROM usuario WHERE user_mail = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $dados = $resultado->fetch_assoc();

        // Verifica se a senha está correta usando password_verify
        if (password_verify($password, $dados["user_password"])) {
            $_SESSION["user_name"] = $dados["user_name"];
            $_SESSION["user_id"] = $dados["pk_user"];
            $_SESSION["conected"] = true;
            header("Location: pages/status.php");
            exit;
        } else {
            $error = "E-mail ou senha inválidos.";
        }
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
    <link rel="stylesheet" href="css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <title>Login</title>
</head>

<body class="backgroundf">
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="d-flex flex-column align-items-center gap-3 p-4 rounded shadow bgform">
            <h2>Login</h2>
            <form method="post">
                <div class="d-flex flex-column align-items-center gap-3 fontc">
                    <input type="email" id="email" name="email" placeholder="Email" class="form-control fontc text-center" required>
                    <input type="password" id="password" name="password" placeholder="Senha" class="form-control fontc text-center" required>
                    <a class="link" href="pages/register_user.php">Criar conta</a>
                    <button type="submit" name="login" class="btf">Entrar</button>
                    <?php if ($error): ?>
                        <div class="error"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>