<?php

$pageTitle = 'Nueva transferencia — ByteBank';
$headerTitle = 'Nueva transferencia';
$headerSubtitle = 'Envía dinero de forma rápida y segura';
$userName = 'Mariana Torres';
$userInitials = 'MT';

// Datos de prueba de cuenta origen
$originAccountMask = '•••• 7653';
$availableBalance = 18420.50;
$phoneEnding = '48';

$formattedBalance = '$' . number_format($availableBalance, 2, '.', ',');

ob_start();
?>
<div class="container-xxl py-4 px-3 px-sm-4 px-lg-5" style="max-width:1040px;">
  <div class="row g-4">
    <!-- Columna principal del formulario -->
    <div class="col-md-8">
      <section class="bb-panel p-4 p-sm-5">
        <div class="d-flex align-items-center gap-3 pb-4 mb-4 border-bottom">
          <span class="d-inline-flex align-items-center justify-content-center rounded-3" style="width:42px;height:42px;background-color:#e5f5ea;color:#287c51;">
            <i class="bi bi-arrow-left-right fs-5"></i>
          </span>
          <div>
            <h2 class="fw-bolder fs-6 mb-0" style="color:#263a32;">Datos de la transferencia</h2>
            <p class="text-secondary small mb-0" style="font-size:0.75rem;">Completa la información solicitada</p>
          </div>
        </div>

        <form method="POST" action="#" class="d-flex flex-column gap-3">
          <div>
            <label for="dest-account" class="bb-label">Cuenta o cliente destinatario</label>
            <div class="input-group">
              <input
                type="text"
                id="dest-account"
                name="destination_account"
                placeholder="Ingresa los 10 dígitos de la cuenta o usuario"
                class="form-control bb-input border-end-0"
                required
              >
              <span class="input-group-text bg-white border-start-0 rounded-end-3 text-secondary" style="border-color:#dce4df;">
                <i class="bi bi-person"></i>
              </span>
            </div>
          </div>

          <div>
            <label for="transfer-amount" class="bb-label">Cantidad</label>
            <div class="input-group">
              <span class="input-group-text bg-white fw-bold fs-5 rounded-start-3 text-secondary" style="border-color:#dce4df;">$</span>
              <input
                type="number"
                step="0.01"
                min="1"
                id="transfer-amount"
                name="amount"
                placeholder="0.00"
                class="form-control bb-input fw-black fs-5 border-start-0 border-end-0"
                required
              >
              <span class="input-group-text bg-white fw-bold text-secondary rounded-end-3" style="border-color:#dce4df;font-size:0.75rem;">MXN</span>
            </div>
          </div>

          <div>
            <label for="transfer-concept" class="bb-label">Concepto (opcional)</label>
            <input
              type="text"
              id="transfer-concept"
              name="concept"
              placeholder="Ej. Pago de servicios"
              class="form-control bb-input"
            >
          </div>

          <!-- Código de verificación por SMS -->
          <div class="p-3 p-sm-4 rounded-4 border mt-1" style="background-color:#f3f8f5;border-color:#dce8e0!important;">
            <div class="d-flex gap-3">
              <i class="bi bi-shield-check fs-5 flex-shrink-0" style="color:#337e56;"></i>
              <div>
                <div class="fw-bolder small" style="color:#2b463a;">Código de seguridad</div>
                <p class="text-secondary mb-0" style="font-size:0.75rem;">
                  Enviamos un código de 6 dígitos al teléfono terminado en •• <?= htmlspecialchars($phoneEnding, ENT_QUOTES, 'UTF-8') ?>.
                </p>
              </div>
            </div>
            <input
              type="text"
              name="verification_code"
              inputmode="numeric"
              pattern="[0-9]{6}"
              maxlength="6"
              placeholder="—  —  —  —  —  —"
              class="form-control bg-white text-center fw-black fs-5 mt-3 rounded-3"
              style="height:46px;letter-spacing:0.35em;border-color:#d6e1da;"
              required
            >
          </div>

          <button type="submit" class="btn-bytebank w-100 mt-2">
            <span>Confirmar transferencia</span>
            <i class="bi bi-arrow-right"></i>
          </button>
        </form>
      </section>
    </div>

    <!-- Columna lateral de cuenta origen y seguridad -->
    <div class="col-md-4 d-flex flex-column gap-4">
      <div class="rounded-4 p-4 text-white" style="background-color:var(--bb-dark);">
        <div class="text-uppercase fw-bold text-white-50" style="font-size:0.6875rem;letter-spacing:0.14em;">
          Cuenta de origen
        </div>
        <div class="small text-white-50 mt-4">Cuenta ByteBank</div>
        <div class="fw-bolder small mt-1"><?= htmlspecialchars($originAccountMask, ENT_QUOTES, 'UTF-8') ?></div>
        <hr class="border-white border-opacity-10 my-4">
        <div class="small text-white-50" style="font-size:0.75rem;">Saldo disponible</div>
        <div class="fw-black fs-4 mt-1"><?= htmlspecialchars($formattedBalance, ENT_QUOTES, 'UTF-8') ?></div>
      </div>

      <div class="bb-panel p-4">
        <i class="bi bi-shield-check fs-4" style="color:#31815a;"></i>
        <h3 class="fw-bolder small mt-2 mb-1" style="color:#2a4037;">Operación protegida</h3>
        <p class="text-secondary mb-0" style="font-size:0.75rem;line-height:1.5;">
          Nunca compartas tu código. ByteBank no te lo solicitará por llamada o mensaje.
        </p>
      </div>
    </div>
  </div>
</div>
<?php
$appContent = ob_get_clean();
$currentScreen = 'transfer';
$isAdmin = false;

require __DIR__ . '/includes/head.php';
require __DIR__ . '/includes/app_shell.php';
require __DIR__ . '/includes/scripts.php';
?>