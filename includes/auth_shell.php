<?php

$basePath = $basePath ?? '.';
?>
<main class="min-vh-100 row g-0" style="background-color: var(--bb-auth-bg);">
  <!-- Panel izquierdo oscuro en escritorio -->
  <section class="col-lg-5 bb-auth-left d-none d-lg-flex flex-column justify-content-between p-5">
    <div class="position-relative z-1">
      <a href="<?= $basePath ?>/client.php" class="d-inline-flex align-items-center gap-3 text-decoration-none">
        <span class="d-inline-flex align-items-center justify-content-center rounded-3 bg-white text-dark" style="width:40px;height:40px;">
          <i class="bi bi-bank fs-5"></i>
        </span>
        <span class="fw-bolder text-white fs-5" style="letter-spacing:-0.04em;">
          ByteBank<span style="color:#47b878;">.</span>
        </span>
      </a>
    </div>

    <div class="position-relative z-1 my-auto" style="max-width:460px;">
      <p class="text-uppercase fw-bolder mb-3" style="font-size:0.6875rem;letter-spacing:0.22em;color:#9edab9;">
        Tu banco, a tu ritmo
      </p>
      <h1 class="fw-bold display-5 lh-1" style="letter-spacing:-0.05em;">
        Finanzas claras.<br>
        Decisiones simples.
      </h1>
      <p class="mt-4 text-white-50 lh-lg">
        Consulta, transfiere y administra tu dinero desde un solo lugar, con la seguridad que necesitas.
      </p>
      <div class="mt-4 d-flex align-items-center gap-3 small text-white-75">
        <span class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width:36px;height:36px;background:rgba(255,255,255,0.1);color:var(--bb-lime);">
          <i class="bi bi-shield-check"></i>
        </span>
        Protección avanzada en cada operación
      </div>
    </div>

    <div class="position-relative z-1 small text-white-50">
      © 2025 ByteBank Banco Digital
    </div>

    <!-- Decoración  -->
    <div class="position-absolute rounded-circle" style="width:420px;height:420px;right:-120px;bottom:-130px;border:75px solid rgba(71,184,120,0.12);pointer-events:none;"></div>
    <div class="position-absolute rounded-circle" style="width:76px;height:76px;right:96px;bottom:110px;background:rgba(216,243,106,0.9);pointer-events:none;"></div>
  </section>

  <!-- Columna del formulario -->
  <section class="col-lg-7 d-flex align-items-center justify-content-center px-4 py-5 px-sm-5">
    <div class="w-100" style="max-width:440px;">
      <!-- Logo visible en móvil/tablet -->
      <div class="d-lg-none mb-4">
        <a href="<?= $basePath ?>/client.php" class="d-inline-flex align-items-center gap-3 text-decoration-none">
          <span class="d-inline-flex align-items-center justify-content-center rounded-3 text-white" style="width:40px;height:40px;background-color:var(--bb-dark);">
            <i class="bi bi-bank fs-5"></i>
          </span>
          <span class="fw-bolder fs-5" style="letter-spacing:-0.04em;color:var(--bb-ink);">
            ByteBank<span style="color:#47b878;">.</span>
          </span>
        </a>
      </div>

      <?= $authContent ?? '' ?>

      <p class="mt-4 text-center text-secondary" style="font-size:0.6875rem;line-height:1.5;">
        Al continuar aceptas nuestros
        <a href="#" class="fw-bold text-secondary text-decoration-underline">Términos</a>
        y
        <a href="#" class="fw-bold text-secondary text-decoration-underline">Aviso de privacidad</a>.
      </p>
    </div>
  </section>
</main>