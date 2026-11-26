<?php

$pageTitle = 'Registro — ByteBank';

ob_start();
?>
<a href="login.php" class="d-inline-flex align-items-center gap-1 small fw-bold text-secondary text-decoration-none mb-3">
  <i class="bi bi-chevron-left"></i>
  <span>Volver al inicio</span>
</a>

<p class="text-uppercase fw-bolder mb-2" style="font-size:0.75rem;letter-spacing:0.18em;color:var(--bb-green);">
  Crea tu acceso
</p>
<h2 class="fw-bold display-6 mb-2" style="letter-spacing:-0.045em;color:var(--bb-ink);">
  Abre tu cuenta
</h2>
<p class="text-secondary small mb-4">
  Solo tomará un par de minutos.
</p>

<form method="POST" action="#" class="d-flex flex-column gap-3">
  <div>
    <span class="bb-label">Tipo de usuario</span>
    <div class="row g-2 p-1 rounded-3" style="background-color:#e9eeea;">
      <div class="col-6">
        <input
          type="radio"
          class="btn-check"
          name="role"
          id="role-client"
          value="client"
          checked
          autocomplete="off"
        >
        <label
          class="btn w-100 py-2 small fw-bolder rounded-3 border-0 bg-white text-dark shadow-sm"
          for="role-client"
          data-role-label="client"
        >
          Cliente
        </label>
      </div>
      <div class="col-6">
        <input
          type="radio"
          class="btn-check"
          name="role"
          id="role-admin"
          value="admin"
          autocomplete="off"
        >
        <label
          class="btn w-100 py-2 small fw-bolder rounded-3 border-0 text-secondary"
          for="role-admin"
          data-role-label="admin"
        >
          Administrador
        </label>
      </div>
    </div>
  </div>

  <div>
    <label for="reg-username" class="bb-label">Nombre de usuario</label>
    <input
      type="text"
      id="reg-username"
      name="username"
      placeholder="Elige un nombre único"
      class="form-control bb-input"
      required
    >
  </div>

  <div>
    <label for="reg-phone" class="bb-label">Número telefónico</label>
    <input
      type="tel"
      id="reg-phone"
      name="phone"
      placeholder="10 dígitos"
      pattern="[0-9]{10}"
      class="form-control bb-input"
      required
    >
  </div>

  <div>
    <label for="reg-password" class="bb-label">Contraseña</label>
    <div class="input-group">
      <input
        type="password"
        id="reg-password"
        name="password"
        minlength="8"
        placeholder="Mínimo 8 caracteres"
        class="form-control bb-input border-end-0"
        required
      >
      <button
        type="button"
        class="btn btn-outline-secondary bg-white border-start-0 rounded-end-3"
        style="border-color:#dce4df;"
        data-toggle-password="reg-password"
        aria-label="Mostrar u ocultar contraseña"
      >
        <i class="bi bi-eye"></i>
      </button>
    </div>
  </div>

  <div id="admin-code-box" class="d-none">
    <label for="reg-admin-code" class="bb-label">Código de acceso</label>
    <div class="input-group">
      <input
        type="password"
        id="reg-admin-code"
        name="admin_code"
        placeholder="Código de administrador"
        class="form-control bb-input border-end-0"
      >
      <span class="input-group-text bg-white border-start-0 rounded-end-3 text-secondary" style="border-color:#dce4df;">
        <i class="bi bi-shield-lock"></i>
      </span>
    </div>
  </div>

  <button type="submit" class="btn-bytebank w-100 mt-2">
    <span>Crear mi cuenta</span>
    <i class="bi bi-arrow-right"></i>
  </button>
</form>

<p class="text-center small text-secondary mt-4 mb-0">
  ¿Ya tienes una cuenta?
  <a href="login.php" class="fw-bolder text-decoration-none" style="color:#26794f;">
    Inicia sesión
  </a>
</p>

<script>
  // Muestra/oculta el campo de código de acceso según el rol elegido
  (function () {
    const clientRadio = document.getElementById('role-client');
    const adminRadio = document.getElementById('role-admin');
    const adminBox = document.getElementById('admin-code-box');
    const adminInput = document.getElementById('reg-admin-code');
    const labels = document.querySelectorAll('[data-role-label]');

    function syncRoleUI() {
      const isAdmin = adminRadio && adminRadio.checked;
      if (adminBox) {
        adminBox.classList.toggle('d-none', !isAdmin);
      }
      if (adminInput) {
        adminInput.required = isAdmin;
        if (!isAdmin) adminInput.value = '';
      }
      labels.forEach((lbl) => {
        const active = lbl.getAttribute('data-role-label') === (isAdmin ? 'admin' : 'client');
        lbl.classList.toggle('bg-white', active);
        lbl.classList.toggle('text-dark', active);
        lbl.classList.toggle('shadow-sm', active);
        lbl.classList.toggle('text-secondary', !active);
      });
    }

    clientRadio?.addEventListener('change', syncRoleUI);
    adminRadio?.addEventListener('change', syncRoleUI);
  })();
</script>
<?php
$authContent = ob_get_clean();

require __DIR__ . '/includes/head.php';
require __DIR__ . '/includes/auth_shell.php';
require __DIR__ . '/includes/scripts.php';
?>