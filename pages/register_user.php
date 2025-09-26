<?php
require "../connections/db.php";
if (isset($_SESSION["user_name"])) {
    header("Location: pages/status.php");
    exit;
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $email = trim($_POST["email"] ?? "");
    if (preg_match('/^.{6,26}$/', (trim($_POST["password"] ?? "")))) {
        $password = password_hash(trim($_POST["password"] ?? ""), PASSWORD_BCRYPT);

        $checkEmailStmt = $conn->prepare("SELECT user_mail FROM usuario WHERE user_mail = ?");
        $checkEmailStmt->bind_param("s", $email);
        $checkEmailStmt->execute();
        $checkEmailStmt->store_result();

        if ($checkEmailStmt->num_rows > 0) {
            $error = "E-mail já cadastrado.";
        } else {
            $stmt = $conn->prepare("INSERT INTO usuario(user_name, user_mail, user_password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $email, $password);
            if ($stmt->execute()) {
                header("Location: ../index.php");
                exit;
            } else {
                $error = "Erro ao cadastrar usuário.";
            }
        }
    } else {
        $error = "A senha deve conter entre 6 e 26 caracteres alfabéticos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <title>Cadastro</title>
</head>

<body class="backgroundf">
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="d-flex flex-column align-items-center gap-3 p-4 rounded shadow bgform">
            <h2 class="">Cadastro</h2>
            <form method="post">
                <div class="d-flex flex-column align-items-center gap-3 fontc">
                    <input type="text" id="username" name="username" placeholder="Nome de Usuário" class="form-control fontc text-center" autocomplete="off" required>
                    <input type="email" id="email" name="email" placeholder="Email" class="form-control fontc text-center" autocomplete="off" required>
                    <input type="password" id="password" name="password" placeholder="Senha" class="form-control fontc text-center" autocomplete="off" required>
                    <a class="link" href="../index.php">Fazer Login</a>
                    <button type="submit" class="btf">Registrar</button>
                    <?php if ($error): ?>
                        <div class="error w-75"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>