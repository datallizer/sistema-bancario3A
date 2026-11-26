<?php

$currentScreen = $currentScreen ?? 'client';
$isAdmin = $isAdmin ?? false;
$headerTitle = $headerTitle ?? 'ByteBank';
$headerSubtitle = $headerSubtitle ?? '';
$userName = $userName ?? ($isAdmin ? 'Administrador' : 'Mariana Torres');
$userInitials = $userInitials ?? ($isAdmin ? 'AD' : 'MT');
$basePath = $basePath ?? '.';

$menuItems = $isAdmin
    ? [
        ['id' => 'admin', 'label' => 'Clientes', 'icon' => 'bi-people', 'href' => $basePath . '/admin.php'],
        ['id' => 'movements', 'label' => 'Movimientos', 'icon' => 'bi-clock-history', 'href' => $basePath . '/movements.php'],
    ]
    : [
        ['id' => 'client', 'label' => 'Inicio', 'icon' => 'bi-house', 'href' => $basePath . '/client.php'],
        ['id' => 'transfer', 'label' => 'Transferir', 'icon' => 'bi-arrow-left-right', 'href' => $basePath . '/transfer.php'],
        ['id' => 'deposit', 'label' => 'Depositar', 'icon' => 'bi-box-arrow-in-down', 'href' => $basePath . '/deposit.php'],
        ['id' => 'movements', 'label' => 'Movimientos', 'icon' => 'bi-clock-history', 'href' => $basePath . '/movements.php'],
    ];

$renderNavLinks = static function () use ($menuItems, $currentScreen): void {
    foreach ($menuItems as $item) {
        $activeClass = ($currentScreen === $item['id']) ? 'active' : '';
        echo '<a href="' . htmlspecialchars($item['href'], ENT_QUOTES, 'UTF-8') . '" class="bb-nav-link ' . $activeClass . '">';
        echo '<i class="bi ' . htmlspecialchars($item['icon'], ENT_QUOTES, 'UTF-8') . ' fs-5"></i>';
        echo '<span>' . htmlspecialchars($item['label'], ENT_QUOTES, 'UTF-8') . '</span>';
        echo '</a>';
    }
};
?>
<div class="d-flex min-vh-100">
  <!-- Sidebar escritorio -->
  <aside class="bb-sidebar d-none d-lg-flex flex-column justify-content-between p-4">
    <div>
      <a href="<?= $basePath ?>/<?= $isAdmin ? 'admin.php' : 'client.php' ?>" class="d-inline-flex align-items-center gap-3 text-decoration-none px-2">
        <span class="d-inline-flex align-items-center justify-content-center rounded-3 text-white" style="width:40px;height:40px;background-color:var(--bb-dark);">
          <i class="bi bi-bank fs-5"></i>
        </span>
        <span class="fw-bolder fs-5" style="letter-spacing:-0.04em;color:var(--bb-ink);">
          ByteBank<span style="color:#47b878;">.</span>
        </span>
      </a>

      <nav class="mt-5 d-flex flex-column gap-1" aria-label="Menú principal">
        <p class="text-uppercase fw-bolder px-3 mb-2 text-secondary" style="font-size:0.625rem;letter-spacing:0.18em;">
          Menú principal
        </p>
        <?php $renderNavLinks(); ?>
      </nav>
    </div>

    <div>
      <div class="rounded-4 p-3 mb-3 text-white" style="background-color:var(--bb-dark);">
        <i class="bi bi-shield-check fs-5 d-block mb-2" style="color:var(--bb-lime);"></i>
        <p class="fw-bold small mb-1">Tu cuenta está protegida</p>
        <p class="mb-0 text-white-50" style="font-size:0.6875rem;">Sesión activa en ByteBank</p>
      </div>
      <a href="<?= $basePath ?>/login.php" class="bb-nav-link text-secondary">
        <i class="bi bi-box-arrow-right fs-5"></i>
        <span>Cerrar sesión</span>
      </a>
    </div>
  </aside>

  <!-- Offcanvas para móvil -->
  <div class="offcanvas offcanvas-start" tabindex="-1" id="mobileSidebar" aria-labelledby="mobileSidebarLabel" style="max-width:270px;">
    <div class="offcanvas-header border-bottom">
      <div class="d-flex align-items-center gap-2" id="mobileSidebarLabel">
        <span class="d-inline-flex align-items-center justify-content-center rounded-3 text-white" style="width:34px;height:34px;background-color:var(--bb-dark);">
          <i class="bi bi-bank"></i>
        </span>
        <span class="fw-bolder" style="letter-spacing:-0.04em;">ByteBank<span style="color:#47b878;">.</span></span>
      </div>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
    </div>
    <div class="offcanvas-body d-flex flex-column justify-content-between p-3">
      <nav class="d-flex flex-column gap-1" aria-label="Menú móvil">
        <?php $renderNavLinks(); ?>
      </nav>
      <div class="pt-3 border-top">
        <a href="<?= $basePath ?>/login.php" class="bb-nav-link text-secondary">
          <i class="bi bi-box-arrow-right fs-5"></i>
          <span>Cerrar sesión</span>
        </a>
      </div>
    </div>
  </div>

  <!-- Contenedor principal -->
  <div class="flex-grow-1 min-w-0 d-flex flex-column">
    <header class="bg-white border-bottom px-3 px-sm-4 px-lg-5 py-3 d-flex align-items-center justify-content-between gap-3">
      <div class="d-flex align-items-center gap-3 min-w-0">
        <button class="btn btn-outline-secondary d-lg-none rounded-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar" aria-controls="mobileSidebar" aria-label="Abrir menú">
          <i class="bi bi-list fs-5"></i>
        </button>
        <div class="min-w-0">
          <h1 class="fw-bolder fs-5 mb-0 text-truncate" style="letter-spacing:-0.025em;color:var(--bb-ink);">
            <?= htmlspecialchars($headerTitle, ENT_QUOTES, 'UTF-8') ?>
          </h1>
          <?php if ($headerSubtitle !== ''): ?>
            <p class="text-secondary small mb-0 d-none d-sm-block text-truncate">
              <?= htmlspecialchars($headerSubtitle, ENT_QUOTES, 'UTF-8') ?>
            </p>
          <?php endif; ?>
        </div>
      </div>

      <div class="d-flex align-items-center gap-3 flex-shrink-0">
        <button type="button" class="btn btn-light border rounded-circle d-inline-flex align-items-center justify-content-center position-relative" style="width:40px;height:40px;" aria-label="Notificaciones">
          <i class="bi bi-bell"></i>
          <span class="position-absolute top-0 end-0 mt-2 me-2 p-1 rounded-circle" style="background-color:#e36c50;"></span>
        </button>

        <div class="vr d-none d-sm-block" style="height:28px;"></div>

        <div class="d-flex align-items-center gap-2">
          <span class="d-inline-flex align-items-center justify-content-center rounded-circle fw-bolder small" style="width:40px;height:40px;background-color:#dff3e7;color:#17643e;">
            <?= htmlspecialchars($userInitials, ENT_QUOTES, 'UTF-8') ?>
          </span>
          <div class="d-none d-sm-block lh-sm">
            <div class="fw-bold small" style="color:#22352e;">
              <?= htmlspecialchars($userName, ENT_QUOTES, 'UTF-8') ?>
            </div>
            <div class="text-secondary" style="font-size:0.6875rem;">
              <?= $isAdmin ? 'Gestión bancaria' : 'Cliente ByteBank' ?>
            </div>
          </div>
        </div>
      </div>
    </header>

    <div class="flex-grow-1">
      <?= $appContent ?? '' ?>
    </div>
  </div>
</div>