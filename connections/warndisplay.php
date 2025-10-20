<?php
include_once("../connections/db.php");
$sql = "SELECT * FROM alertas ORDER BY alerta_data DESC";
$resultado = $conn->query($sql);
if ($resultado && $resultado->num_rows >= 1) {
    $alerta = $resultado->fetch_all(MYSQLI_ASSOC);
} else {
    echo "<div> Não há alertas! </div>";
}
$resultado->free();
$conn->close();
?>