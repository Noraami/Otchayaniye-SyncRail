<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/login_cad.css">
    <title>Cadastro</title>
</head>

<body class="background">
    <div class="container">
        <div class="log">
            <h2>Cadastro de Usuário</h2>
            <form method="post" action="../actions/register.php">
                <input type="text" id="username" name="username" placeholder="Nome de Usuário" class="box" required><br>
                <input type="email" id="email" name="email" placeholder="Email" class="box" required><br>
                <input type="password" id="password" name="password" placeholder="Senha" class="box" required><br>
                <input type="password" id="password2" name="password2" placeholder="Confirmar Senha" class="box" required><br>
                <a class="regislink" href="../login.php">Login</a><br>
                <button type="submit" class="btn">Registrar</button>
            </form>
        </div>
    </div>
</body>

</html>