<?php

$pageTitle = 'Inicio cliente — ByteBank';
$headerTitle = 'Buenos días, Mariana';
$headerSubtitle = 'Este es el resumen de tu cuenta';
$userName = 'Mariana Torres';
$userInitials = 'MT';

$balance = 18420.50;
$accountNumber = '0192 8401 7653';
$clabe = '019 284 017653 992 1';

$movements = [
    [
        'title' => 'Transferencia recibida',
        'detail' => 'De Sofía Ramírez',
        'date' => 'Hoy, 10:42',
        'amount' => 1250.00,
        'type' => 'in',
    ],
    [
        'title' => 'Transferencia enviada',
        'detail' => 'A Daniel Hernández',
        'date' => 'Ayer, 16:20',
        'amount' => -480.00,
        'type' => 'out',
    ],
    [
        'title' => 'Depósito a cuenta',
        'detail' => 'Ventanilla digital',
        'date' => '12 Jun, 09:15',
        'amount' => 3000.00,
        'type' => 'in',
    ],
    [
        'title' => 'Transferencia enviada',
        'detail' => 'A Carlos Mendoza',
        'date' => '10 Jun, 13:08',
        'amount' => -875.50,
        'type' => 'out',
    ],
];

$formattedBalance = '$' . number_format($balance, 2, '.', ',');

ob_start();
?>
<div class="container-xxl py-4 px-3 px-sm-4 px-lg-5">
  <!-- Tarjeta principal de saldo y cuenta -->
  <section class="position-relative overflow-hidden text-white p-4 p-sm-5 mb-4" style="background-color:var(--bb-dark);border-radius:28px;">
    <div class="position-relative z-1">
      <div class="d-inline-flex align-items-center gap-2 small text-white-50 fw-semibold">
        <span>Saldo disponible</span>
        <button
          type="button"
          id="toggle-balance-btn"
          class="btn btn-link p-0 text-white-50 text-decoration-none"
          aria-label="Mostrar u ocultar saldo"
        >
          <i class="bi bi-eye"></i>
        </button>
      </div>

      <p id="balance-value" data-real-balance="<?= htmlspecialchars($formattedBalance, ENT_QUOTES, 'UTF-8') ?>" class="fw-bold mt-2 mb-1" style="font-size:clamp(2rem,4.5vw,3rem);letter-spacing:-0.05em;">
        <?= htmlspecialchars($formattedBalance, ENT_QUOTES, 'UTF-8') ?>
      </p>

      <p class="small text-white-50 mb-4">
        Cuenta ByteBank • <?= htmlspecialchars($accountNumber, ENT_QUOTES, 'UTF-8') ?>
      </p>

      <div class="d-flex flex-wrap gap-3">
        <a href="transfer.php" class="btn-bytebank btn-bytebank-lime">
          <i class="bi bi-arrow-left-right"></i>
          <span>Transferir</span>
        </a>
        <a href="deposit.php" class="btn-bytebank" style="background-color:rgba(255,255,255,0.12);">
          <i class="bi bi-box-arrow-in-down"></i>
          <span>Depositar</span>
        </a>
      </div>
    </div>

    <!-- Decoración y CLABE en escritorio -->
    <div class="position-absolute rounded-circle d-none d-sm-block" style="width:280px;height:280px;right:-50px;top:-70px;border:50px solid rgba(255,255,255,0.035);pointer-events:none;"></div>
    <div class="position-absolute bottom-0 end-0 p-4 p-sm-5 text-end d-none d-md-block">
      <div class="text-uppercase text-white-50" style="font-size:0.625rem;letter-spacing:0.15em;">
        CLABE interbancaria
      </div>
      <div class="fw-semibold small text-white-75 mt-1">
        <?= htmlspecialchars($clabe, ENT_QUOTES, 'UTF-8') ?>
      </div>
    </div>
  </section>

  <!-- Grid inferior: últimos movimientos + acciones rápidas -->
  <div class="row g-4">
    <div class="col-xl-8">
      <section class="bb-panel h-100">
        <div class="bb-panel-heading">
          <div>
            <h2>Últimos movimientos</h2>
            <p>Actividad reciente de tu cuenta</p>
          </div>
          <a href="movements.php" class="small fw-bolder text-decoration-none d-inline-flex align-items-center gap-1" style="color:#287b50;font-size:0.75rem;">
            <span>Ver todos</span>
            <i class="bi bi-arrow-right"></i>
          </a>
        </div>
        <?php require __DIR__ . '/includes/movement_list.php'; ?>
      </section>
    </div>

    <div class="col-xl-4">
      <section class="bb-panel p-4 h-100">
        <div class="mb-3">
          <h2 class="fw-bolder mb-1" style="font-size:0.9375rem;color:#263830;">Acciones rápidas</h2>
          <p class="small text-secondary mb-0" style="font-size:0.75rem;">Lo que más utilizas</p>
        </div>

        <div class="row g-3">
          <div class="col-6">
            <a href="transfer.php" class="d-block p-3 rounded-4 border text-decoration-none h-100" style="border-color:#e4e9e6;">
              <span class="d-inline-flex align-items-center justify-content-center rounded-3 mb-3" style="width:36px;height:36px;background-color:#e6f5eb;color:#22764c;">
                <i class="bi bi-arrow-left-right"></i>
              </span>
              <span class="d-block fw-bolder small" style="color:#293b34;">Transferir</span>
            </a>
          </div>

          <div class="col-6">
            <a href="deposit.php" class="d-block p-3 rounded-4 border text-decoration-none h-100" style="border-color:#e4e9e6;">
              <span class="d-inline-flex align-items-center justify-content-center rounded-3 mb-3" style="width:36px;height:36px;background-color:#e6f5eb;color:#22764c;">
                <i class="bi bi-box-arrow-in-down"></i>
              </span>
              <span class="d-block fw-bolder small" style="color:#293b34;">Depositar</span>
            </a>
          </div>

          <div class="col-6">
            <a href="movements.php" class="d-block p-3 rounded-4 border text-decoration-none h-100" style="border-color:#e4e9e6;">
              <span class="d-inline-flex align-items-center justify-content-center rounded-3 mb-3" style="width:36px;height:36px;background-color:#e6f5eb;color:#22764c;">
                <i class="bi bi-clock-history"></i>
              </span>
              <span class="d-block fw-bolder small" style="color:#293b34;">Historial</span>
            </a>
          </div>

          <div class="col-6">
            <a href="client.php" class="d-block p-3 rounded-4 border text-decoration-none h-100" style="border-color:#e4e9e6;">
              <span class="d-inline-flex align-items-center justify-content-center rounded-3 mb-3" style="width:36px;height:36px;background-color:#e6f5eb;color:#22764c;">
                <i class="bi bi-credit-card"></i>
              </span>
              <span class="d-block fw-bolder small" style="color:#293b34;">Mi cuenta</span>
            </a>
          </div>
        </div>
      </section>
    </div>
  </div>
</div>

<script>
  // Ocultar o mostrar saldo con el ícono del ojo
  (function () {
    const btn = document.getElementById('toggle-balance-btn');
    const el = document.getElementById('balance-value');
    if (!btn || !el) return;

    const realValue = el.getAttribute('data-real-balance') || '$0.00';
    let hidden = false;

    btn.addEventListener('click', () => {
      hidden = !hidden;
      el.textContent = hidden ? '••••••••' : realValue;
      const icon = btn.querySelector('i');
      if (icon) {
        icon.classList.toggle('bi-eye', !hidden);
        icon.classList.toggle('bi-eye-slash', hidden);
      }
    });
  })();
</script>
<?php
$appContent = ob_get_clean();
$currentScreen = 'client';
$isAdmin = false;

require __DIR__ . '/includes/head.php';
require __DIR__ . '/includes/app_shell.php';
require __DIR__ . '/includes/scripts.php';
?>