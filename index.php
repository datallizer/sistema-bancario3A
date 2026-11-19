<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
require_once 'dbcon.php';

if (!empty($_SESSION['user_id'])) {
  header('Location: dashboard.php');
  exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'], $_POST['password'])) {
  $email    = trim($_POST['email']);
  $password = $_POST['password'];

  $stmt = mysqli_prepare($con, "SELECT id, nombre, apellidop, password, rol FROM usuarios WHERE email = ? LIMIT 1");
  mysqli_stmt_bind_param($stmt, "s", $email);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $row    = mysqli_fetch_assoc($result);
  mysqli_stmt_close($stmt);

  if ($row && password_verify($password, $row['password'])) {
    session_regenerate_id(true);

    $_SESSION['user_id'] = $row['id'];
    $_SESSION['email']   = $email;
    $_SESSION['rol']     = $row['rol'];

    $nombre    = mb_strtoupper($row['nombre'], 'UTF-8');

    $_SESSION['alert'] = [
      'title'   => "BIENVENIDO $nombre",
      'message' => 'Sesión iniciada correctamente',
      'icon'    => 'success'
    ];
    header("Location: dashboard.php");
    exit();
  } else {
    $_SESSION['alert'] = [
      'title'   => 'CREDENCIALES INCORRECTAS',
      'message' => 'El correo o la contraseña no son válidos, intenta nuevamente.',
      'icon'    => 'error'
    ];
    header("Location: index.php");
    exit();
  }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="shortcut icon" type="image/x-icon" href="images/ics.ico" />
  <title>Ingresar | PERIBAN</title>
</head>

<body class="loginBody d-flex flex-column min-vh-100">
  <?php include 'menu.php'; ?>

  <main class="container-fluid flex-grow-1 d-flex align-items-center justify-content-center py-5">
    <div class="col-11 col-sm-8 col-md-5 col-lg-4 text-center bg-light p-4 p-md-5 shadow-sm rounded-3">
      <h3 class="fw-bold mb-1">INGRESAR</h3>
      <p class="text-muted mb-4">Escribe tus credenciales</p>

      <form action="index.php" method="POST">
        <div class="form-floating mb-3 text-start">
          <input type="email" class="form-control" id="emailInput" name="email" placeholder="Correo electrónico" required autofocus>
          <label for="emailInput">Correo</label>
        </div>

        <div class="input-group mb-4">
          <div class="form-floating text-start">
            <input type="password" class="form-control" id="passwordInput" name="password" placeholder="Contraseña" required>
            <label for="passwordInput">Contraseña</label>
          </div>
          <button class="btn btn-outline-secondary" type="button" id="togglePassword" title="Mostrar/Ocultar contraseña">
            <i class="bi bi-eye" id="toggleIcon"></i>
          </button>
        </div>

        <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">Ingresar</button>
      </form>
    </div>
  </main>

  <?php include 'footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    document.getElementById('togglePassword').addEventListener('click', function() {
      const passwordInput = document.getElementById('passwordInput');
      const toggleIcon = document.getElementById('toggleIcon');
      const isPassword = passwordInput.type === 'password';

      passwordInput.type = isPassword ? 'text' : 'password';
      toggleIcon.classList.toggle('bi-eye', !isPassword);
      toggleIcon.classList.toggle('bi-eye-slash', isPassword);
    });
  </script>
  <?php include 'includes/alerts.php'; ?>
</body>

</html>