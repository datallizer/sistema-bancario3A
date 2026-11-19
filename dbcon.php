<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$esLocal = in_array($_SERVER['SERVER_NAME'] ?? 'localhost', ['localhost', '127.0.0.1']);

if ($esLocal) {
    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "BD_NAME";
} else {
    $db_host = "datallizer.com";
    $db_user = "datallize_user";
    $db_pass = "IWY_]HGVKKBJJLEi";
    $db_name = "datallizer";
}

try {
    $con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    mysqli_set_charset($con, "utf8mb4");
} catch (mysqli_sql_exception $e) {
    error_log("Error de conexión BD: " . $e->getMessage());
    http_response_code(500);
    die("Error interno del servidor. No fue posible conectar con la base de datos.");
}
