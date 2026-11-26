<?php
$pageTitle = 'Gestión de clientes — ByteBank';
$headerTitle = 'Gestión de clientes';
$headerSubtitle = 'Administra las cuentas registradas';
$userName = 'Administrador';
$userInitials = 'AD';

$kpis = [
    [
        'label' => 'Clientes activos',
        'value' => '1,284',
        'note' => '+8.4% este mes',
        'icon' => 'bi-people',
    ],
    [
        'label' => 'Saldo administrado',
        'value' => '$2.8 M',
        'note' => '+12.1% este mes',
        'icon' => 'bi-credit-card',
    ],
    [
        'label' => 'Operaciones hoy',
        'value' => '348',
        'note' => 'Última hace 2 min',
        'icon' => 'bi-arrow-left-right',
    ],
];

$clients = [
    [
        'id' => 1,
        'name' => 'Mariana Torres',
        'user' => 'mariana.t',
        'account' => '•••• 2841',
        'balance' => 18420.50,
        'initials' => 'MT',
        'bg' => '#dff3e7',
        'status' => 'Activo',
    ],
    [
        'id' => 2,
        'name' => 'Daniel Hernández',
        'user' => 'daniel.h',
        'account' => '•••• 7190',
        'balance' => 0.00,
        'initials' => 'DH',
        'bg' => '#e7e4fa',
        'status' => 'Activo',
    ],
    [
        'id' => 3,
        'name' => 'Sofía Ramírez',
        'user' => 'sofia.r',
        'account' => '•••• 4632',
        'balance' => 8250.00,
        'initials' => 'SR',
        'bg' => '#f9e6d9',
        'status' => 'Activo',
    ],
    [
        'id' => 4,
        'name' => 'Carlos Mendoza',
        'user' => 'carlos.m',
        'account' => '•••• 9014',
        'balance' => 32108.75,
        'initials' => 'CM',
        'bg' => '#dcebf6',
        'status' => 'Activo',
    ],
];

ob_start();
?>
<div class="container-xxl py-4 px-3 px-sm-4 px-lg-5">
  <div class="row g-3 mb-4">
    <?php foreach ($kpis as $kpi): ?>
      <div class="col-sm-4">
        <div class="bb-panel p-4 d-flex align-items-center gap-3 h-100">
          <span class="d-inline-flex align-items-center justify-content-center rounded-3 flex-shrink-0" style="width:44px;height:44px;background-color:#e6f5eb;color:#267a50;">
            <i class="bi <?= htmlspecialchars($kpi['icon'], ENT_QUOTES, 'UTF-8') ?> fs-5"></i>
          </span>
          <div class="min-w-0">
            <div class="text-secondary fw-bold" style="font-size:0.6875rem;">
              <?= htmlspecialchars($kpi['label'], ENT_QUOTES, 'UTF-8') ?>
            </div>
            <div class="fw-black fs-4 mt-0" style="letter-spacing:-0.04em;color:#1d3028;">
              <?= htmlspecialchars($kpi['value'], ENT_QUOTES, 'UTF-8') ?>
            </div>
            <div class="fw-semibold" style="font-size:0.625rem;color:#459269;">
              <?= htmlspecialchars($kpi['note'], ENT_QUOTES, 'UTF-8') ?>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <!-- Tabla de clientes registrados -->
  <section class="bb-panel">
    <div class="p-4 p-sm-5 border-bottom d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3">
      <div>
        <h2 class="fw-bolder fs-6 mb-1" style="color:#263830;">Clientes registrados</h2>
        <p class="text-secondary small mb-0" style="font-size:0.75rem;">
          Consulta y administra la información de cada cliente
        </p>
      </div>

      <form method="GET" action="admin.php" class="d-flex align-items-center gap-2">
        <div class="input-group" style="max-width:260px;">
          <span class="input-group-text bg-light border-end-0 rounded-start-3 text-secondary" style="border-color:#dfe6e2;">
            <i class="bi bi-search small"></i>
          </span>
          <input
            type="search"
            name="q"
            placeholder="Buscar cliente..."
            class="form-control form-control-sm bg-light border-start-0 rounded-end-3"
            style="min-height:38px;border-color:#dfe6e2;font-size:0.75rem;"
          >
        </div>
      </form>
    </div>

    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0" style="min-width:680px;">
        <thead style="background-color:#f8faf8;">
          <tr class="text-uppercase text-secondary" style="font-size:0.625rem;letter-spacing:0.12em;">
            <th class="px-4 py-3 fw-bolder border-0">Cliente</th>
            <th class="px-3 py-3 fw-bolder border-0">Cuenta</th>
            <th class="px-3 py-3 fw-bolder border-0">Saldo</th>
            <th class="px-3 py-3 fw-bolder border-0">Estado</th>
            <th class="px-4 py-3 fw-bolder border-0 text-end">Acciones</th>
          </tr>
        </thead>
        <tbody class="border-top">
          <?php foreach ($clients as $client): ?>
            <?php $formattedClientBalance = '$' . number_format((float) $client['balance'], 2, '.', ','); ?>
            <tr class="small">
              <td class="px-4 py-3">
                <div class="d-flex align-items-center gap-3">
                  <span
                    class="d-inline-flex align-items-center justify-content-center rounded-circle fw-black flex-shrink-0"
                    style="width:36px;height:36px;font-size:0.6875rem;background-color:<?= htmlspecialchars($client['bg'], ENT_QUOTES, 'UTF-8') ?>;color:#30463d;"
                  >
                    <?= htmlspecialchars($client['initials'], ENT_QUOTES, 'UTF-8') ?>
                  </span>
                  <div class="min-w-0">
                    <div class="fw-bolder text-truncate" style="color:#2b3c35;">
                      <?= htmlspecialchars($client['name'], ENT_QUOTES, 'UTF-8') ?>
                    </div>
                    <div class="text-secondary" style="font-size:0.6875rem;">
                      @<?= htmlspecialchars($client['user'], ENT_QUOTES, 'UTF-8') ?>
                    </div>
                  </div>
                </div>
              </td>
              <td class="px-3 py-3 fw-semibold text-secondary">
                <?= htmlspecialchars($client['account'], ENT_QUOTES, 'UTF-8') ?>
              </td>
              <td class="px-3 py-3 fw-bolder" style="color:#2b3c35;">
                <?= htmlspecialchars($formattedClientBalance, ENT_QUOTES, 'UTF-8') ?>
              </td>
              <td class="px-3 py-3">
                <span class="bb-badge-active">
                  <?= htmlspecialchars($client['status'], ENT_QUOTES, 'UTF-8') ?>
                </span>
              </td>
              <td class="px-4 py-3 text-end text-nowrap">
                <a
                  href="detail.php?id=<?= urlencode((string) $client['id']) ?>"
                  class="fw-bolder text-decoration-none me-2"
                  style="color:#267a50;font-size:0.75rem;"
                >
                  Ver detalle
                </a>
                <button
                  type="button"
                  class="btn btn-link btn-sm p-0 text-secondary text-decoration-none"
                  aria-label="Más opciones"
                >
                  <i class="bi bi-three-dots"></i>
                </button>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <div class="px-4 py-3 border-top d-flex flex-column flex-sm-row align-items-center justify-content-between gap-2 text-secondary" style="font-size:0.6875rem;">
      <div>
        Mostrando <?= count($clients) ?> de 1,284 clientes
      </div>
      <div class="d-flex gap-1">
        <button type="button" class="btn btn-sm btn-outline-secondary rounded-2 py-1 px-2" style="font-size:0.6875rem;">Anterior</button>
        <button type="button" class="btn btn-sm rounded-2 py-1 px-2 text-white fw-bold" style="background-color:var(--bb-dark);font-size:0.6875rem;">1</button>
        <button type="button" class="btn btn-sm btn-outline-secondary rounded-2 py-1 px-2" style="font-size:0.6875rem;">2</button>
        <button type="button" class="btn btn-sm btn-outline-secondary rounded-2 py-1 px-2" style="font-size:0.6875rem;">Siguiente</button>
      </div>
    </div>
  </section>
</div>
<?php
$appContent = ob_get_clean();
$currentScreen = 'admin';
$isAdmin = true;

require __DIR__ . '/includes/head.php';
require __DIR__ . '/includes/app_shell.php';
require __DIR__ . '/includes/scripts.php';
?>