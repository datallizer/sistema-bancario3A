<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['user_id'])) {
    $_SESSION['alert'] = [
        'title'   => 'SESIÓN NO INICIADA',
        'message' => 'Para acceder debes iniciar sesión primero',
        'icon'    => 'info'
    ];
    header('Location: index.php');
    exit();
}
