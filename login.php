<?php

$pageTitle = 'Iniciar sesión — ByteBank';

ob_start();
?>
<p class="text-uppercase fw-bolder mb-2" style="font-size:0.75rem;letter-spacing:0.18em;color:var(--bb-green);">
  Bienvenido de nuevo
</p>
<h2 class="fw-bold display-6 mb-2" style="letter-spacing:-0.045em;color:var(--bb-ink);">
  Inicia sesión
</h2>
<p class="text-secondary small mb-4">
  Ingresa tus datos para acceder a tu cuenta.
</p>

<form method="POST" action="#" class="d-flex flex-column gap-3">
  <div>
    <label for="login-username" class="bb-label">Usuario</label>
    <input
      type="text"
      id="login-username"
      name="username"
      placeholder="Ej. mariana.t"
      class="form-control bb-input"
      required
    >
  </div>

  <div>
    <label for="login-password" class="bb-label">Contraseña</label>
    <div class="input-group">
      <input
        type="password"
        id="login-password"
        name="password"
        placeholder="Ingresa tu contraseña"
        class="form-control bb-input border-end-0"
        required
      >
      <button
        type="button"
        class="btn btn-outline-secondary bg-white border-start-0 rounded-end-3"
        style="border-color:#dce4df;"
        data-toggle-password="login-password"
        aria-label="Mostrar u ocultar contraseña"
      >
        <i class="bi bi-eye"></i>
      </button>
    </div>
  </div>

  <div class="d-flex align-items-center justify-content-between small mt-1">
    <div class="form-check mb-0">
      <input class="form-check-input" type="checkbox" id="remember-me" name="remember">
      <label class="form-check-label fw-semibold text-secondary" for="remember-me">
        Recordarme
      </label>
    </div>
    <a href="register.php" class="fw-bold text-decoration-none" style="color:#26794f;">
      ¿Olvidaste tu contraseña?
    </a>
  </div>

  <button type="submit" class="btn-bytebank w-100 mt-2">
    <span>Entrar a mi cuenta</span>
    <i class="bi bi-arrow-right"></i>
  </button>
</form>

<div class="d-flex align-items-center gap-3 my-4 text-secondary text-uppercase fw-bold" style="font-size:0.625rem;letter-spacing:0.15em;">
  <hr class="flex-grow-1 my-0">
  <span>o</span>
  <hr class="flex-grow-1 my-0">
</div>

<p class="text-center small text-secondary mb-0">
  ¿Aún no tienes cuenta?
  <a href="register.php" class="fw-bolder text-decoration-none" style="color:#26794f;">
    Regístrate aquí
  </a>
</p>
<?php
$authContent = ob_get_clean();

require __DIR__ . '/includes/head.php';
require __DIR__ . '/includes/auth_shell.php';
require __DIR__ . '/includes/scripts.php';
?>