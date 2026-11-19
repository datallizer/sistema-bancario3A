<?php if (!empty($_SESSION['alert'])):
    $alert   = $_SESSION['alert'];
    $title   = json_encode($alert['title'] ?? 'Notificación', JSON_HEX_TAG | JSON_HEX_AMP);
    $message = !empty($alert['message']) ? json_encode($alert['message'], JSON_HEX_TAG | JSON_HEX_AMP) : null;
    $icon    = json_encode(strtolower($alert['icon'] ?? 'info'), JSON_HEX_TAG | JSON_HEX_AMP);
    unset($_SESSION['alert']);
?>
    <script>
        Swal.fire({
            title: <?= $title ?>,
            <?php if ($message !== null): ?>
                text: <?= $message ?>,
            <?php endif; ?>
            icon: <?= $icon ?>,
            confirmButtonText: 'OK'
        });
    </script>
<?php endif; ?>