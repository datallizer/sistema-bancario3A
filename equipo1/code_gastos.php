<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../dbcon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // ==========================================
    // 1. GUARDAR
    // ==========================================
    if (isset($_POST['save'])) {
        $conceptos = $_POST['concepto'] ?? [];
        $montos    = $_POST['monto'] ?? [];
        $fechas    = $_POST['fecha'] ?? [];

        if (
            !is_array($conceptos) || !is_array($montos) || !is_array($fechas) ||
            count($conceptos) === 0 ||
            count($conceptos) !== count($montos) ||
            count($conceptos) !== count($fechas)
        ) {
            $_SESSION['alert'] = [
                'title'   => 'DATOS INCOMPLETOS',
                'message' => 'Verifica que todos los campos estén llenos correctamente.',
                'icon'    => 'warning'
            ];
            header('Location: ../gastos.php');
            exit();
        }

        try {
            mysqli_begin_transaction($con);
            $stmt = mysqli_prepare($con, "INSERT INTO gastos (concepto, monto, fecha) VALUES (?, ?, ?)");
            $guardados = 0;

            for ($i = 0; $i < count($conceptos); $i++) {
                $concepto = trim($conceptos[$i]);
                $monto    = filter_var($montos[$i], FILTER_VALIDATE_FLOAT);
                $fecha    = trim($fechas[$i]);

                if ($concepto === '' || $monto === false || $monto <= 0 || !$fecha) {
                    throw new Exception("Fila #" . ($i + 1) . " contiene datos inválidos o monto menor/igual a 0.");
                }

                $fechaObj = DateTime::createFromFormat('Y-m-d', $fecha);
                if (!$fechaObj || $fechaObj->format('Y-m-d') !== $fecha) {
                    throw new Exception("Formato de fecha inválido en la fila #" . ($i + 1) . ".");
                }

                mysqli_stmt_bind_param($stmt, "sds", $concepto, $monto, $fecha);
                mysqli_stmt_execute($stmt);
                $guardados++;
            }

            mysqli_stmt_close($stmt);
            mysqli_commit($con);

            $_SESSION['alert'] = [
                'title'   => $guardados === 1 ? 'GASTO REGISTRADO' : "$guardados GASTOS REGISTRADOS",
                'message' => 'Los egresos se guardaron exitosamente.',
                'icon'    => 'success'
            ];
        } catch (Throwable $e) {
            mysqli_rollback($con);
            error_log("Error al guardar gastos: " . $e->getMessage());

            $_SESSION['alert'] = [
                'title'   => 'ERROR AL GUARDAR',
                'message' => $e instanceof mysqli_sql_exception
                    ? 'Ocurrió un error en la base de datos. Contacte a soporte.'
                    : $e->getMessage(),
                'icon'    => 'error'
            ];
        }

        header('Location: ../gastos.php');
        exit();
    }

    // ==========================================
    // ACTUALIZAR
    // ==========================================
    if (isset($_POST['update'])) {
        $id       = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT);
        $concepto = trim($_POST['concepto'] ?? '');
        $monto    = filter_var($_POST['monto'] ?? null, FILTER_VALIDATE_FLOAT);
        $fecha    = trim($_POST['fecha'] ?? '');

        if ($id === false || $id <= 0) {
            $_SESSION['alert'] = [
                'title'   => 'ID INVÁLIDO',
                'message' => 'No se pudo identificar el registro a actualizar.',
                'icon'    => 'error'
            ];
            header('Location: ../gastos.php');
            exit();
        }


        $fechaObj = DateTime::createFromFormat('Y-m-d', $fecha);
        if ($concepto === '' || $monto === false || $monto <= 0 || !$fechaObj || $fechaObj->format('Y-m-d') !== $fecha) {
            $_SESSION['alert'] = [
                'title'   => 'DATOS INVÁLIDOS',
                'message' => 'Verifica que el concepto, monto mayor a 0 y fecha sean válidos.',
                'icon'    => 'warning'
            ];
            header("Location: ../editargasto.php?id=$id");
            exit();
        }

        try {
            $stmt = mysqli_prepare($con, "UPDATE gastos SET concepto = ?, monto = ?, fecha = ? WHERE id = ? LIMIT 1");
            mysqli_stmt_bind_param($stmt, "sdsi", $concepto, $monto, $fecha, $id);
            mysqli_stmt_execute($stmt);
            $filasAfectadas = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);

            if ($filasAfectadas > 0) {
                $_SESSION['alert'] = [
                    'title'   => 'ACTUALIZADO EXITOSAMENTE',
                    'message' => 'Los cambios del egreso se guardaron correctamente.',
                    'icon'    => 'success'
                ];
            } else {
                $_SESSION['alert'] = [
                    'title'   => 'SIN CAMBIOS',
                    'message' => 'No se realizaron modificaciones en el registro.',
                    'icon'    => 'info'
                ];
            }
        } catch (mysqli_sql_exception $e) {
            error_log("Error al actualizar gasto ID $id: " . $e->getMessage());
            $_SESSION['alert'] = [
                'title'   => 'ERROR AL ACTUALIZAR',
                'message' => 'No se pudo actualizar el registro. Contacte a soporte.',
                'icon'    => 'error'
            ];
        }

        header('Location: ../gastos.php');
        exit();
    }
}

header('Location: ../gastos.php');
exit();
