<?php
session_start();

if (!isset($_SESSION["conected"]) || $_SESSION["conected"] != true) {
    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STATUS</title>
</head>

<body>
    <a href="../connections/exit.php">
        <input type="button" value="Sair" event="../connections/exit.php" />
    </a>
</body>

</html>