<?php
$movements = $movements ?? [];

$formatMoney = $currencyFormatter ?? static function (float $amount): string {
    $sign = $amount > 0 ? '+' : ($amount < 0 ? '-' : '');
    return $sign . '$' . number_format(abs($amount), 2, '.', ',');
};
?>
<?php if (empty($movements)): ?>
  <div class="p-4 text-center text-secondary small">
    No hay movimientos registrados para mostrar.
  </div>
<?php else: ?>
  <div class="list-group list-group-flush px-3 px-sm-4">
    <?php foreach ($movements as $mov): ?>
      <?php
        $type = $mov['type'] ?? 'in';
        $amount = (float) ($mov['amount'] ?? 0);
        $isPositive = $type === 'in' || $amount > 0;
        $iconClass = $isPositive ? 'bi-box-arrow-in-down bb-icon-in' : 'bi-arrow-left-right bb-icon-out';
        $amountColor = $isPositive ? 'text-success' : 'text-dark';
      ?>
      <div class="list-group-item px-0 py-3 d-flex align-items-center gap-3 border-light">
        <span class="d-inline-flex align-items-center justify-content-center rounded-3 flex-shrink-0 <?= $iconClass ?>" style="width:40px;height:40px;">
          <i class="bi <?= $isPositive ? 'bi-box-arrow-in-down' : 'bi-arrow-left-right' ?>"></i>
        </span>

        <div class="flex-grow-1 min-w-0">
          <div class="fw-bold small text-truncate" style="color:#2c3e37;">
            <?= htmlspecialchars($mov['title'] ?? 'Movimiento', ENT_QUOTES, 'UTF-8') ?>
          </div>
          <div class="text-secondary text-truncate" style="font-size:0.6875rem;">
            <?= htmlspecialchars($mov['detail'] ?? '', ENT_QUOTES, 'UTF-8') ?>
            <?php if (!empty($mov['date'])): ?>
              · <?= htmlspecialchars($mov['date'], ENT_QUOTES, 'UTF-8') ?>
            <?php endif; ?>
          </div>
        </div>

        <div class="fw-bolder small text-nowrap <?= $amountColor ?>">
          <?= htmlspecialchars($formatMoney($amount), ENT_QUOTES, 'UTF-8') ?>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>