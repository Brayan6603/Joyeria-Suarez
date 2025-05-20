<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumenes y Estados</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php
        include "Front.php";
        $front = new Front();
        $front->header();
        $front->navOpen();
    ?>
        <a href="index.php" class="navegacion__enlace">Inicio</a>
        <a href="nuestrahistoria.php" class="navegacion__enlace">Nuestra Historia</a>
        <a href="nuestrastiendas.php" class="navegacion__enlace">Nuestras Tiendas</a>
        <a href="nuestrosproductos.php" class="navegacion__enlace">Nuestros Productos</a>
        <a href="gestionar-usuarios.php" class="navegacion__enlace">Gestionar Usuarios</a>
        <a href="resumenes-estados.php" class="navegacion__enlace enlace-activo">Resumenes y Estados</a>
    <?php
        $front->navClose();
        session_start();
        $username = $_SESSION['username'];
        $rol = $_SESSION['rol'];
        if($rol == 0){
            $rol = "root";
        }
        if(isset($username)){
    ?>
    <script type="text/javascript" src="js/scripts.js"></script>
    <script>
        mostrarUsername("<?php echo $username; ?>", "<?php echo $rol; ?>");
        mostrarBotonLogOut();
        //mostrarSVGUsuario();
    </script>
    <?php
        } 
    ?>
    <main>
    <h2>Estado de Cuenta</h2>
    <div class="div-form-estado">
    <form action="estadoCuenta.php" method="POST">
        <div>
            <label for="fecha_inicio">Fecha Inicio:</label>
            <input type="date" id="fecha_inicio" name="fecha_inicio" required>
            <label for="fecha_fin">Fecha Fin:</label>
            <input type="date" id="fecha_fin" name="fecha_fin" required>
        </div>
        <div>
        <button type="submit" name="consultar_estado" class="boton">Consultar Estado</button>
        <button type="submit" name="consultar_tiendas" class="boton">Consultar Estado por Tienda</button>
        </div>
    </form>
    </div>

    <?php
if (isset($_POST['consultar_estado']) && isset($username) && $rol == "root") {
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];

    include_once 'SQLVenta.php';
    include_once 'Venta.php';
    $sqlVenta = new SQLVenta();

    // Consulta de estado de cuenta entre dos fechas
    $estadoCuenta = $sqlVenta->getEstadoCuentaByFecha($fecha_inicio, $fecha_fin);

    // Mostrar resultados
    if (!empty($estadoCuenta)) {
        echo '<div id="printableArea">';
        echo '<h3>Resumen de Estado de Cuenta</h3>';
        echo '<p class="parrafos-estadocuenta">Desde: ' . $fecha_inicio . ' --- Hasta: ' . $fecha_fin . '</p>';
        echo '<p class="parrafos-estadocuenta">Registros encontrados: ' . count(mysqli_fetch_all($estadoCuenta)) . '</p>';
        echo '<div class="table-container">';
        echo '<table class="tablaExistencias" id="miTabla">';
        echo '<tr><th>Folio Venta</th><th>Fecha</th><th>Monto</th></tr>';
        $total = 0;
        foreach ($estadoCuenta as $registro) {
            $v = new Venta();
            $v->setFolio($registro['folio']);
            $v->setFecha($registro['fecha']);
            $v->setTotal($registro['total']);
            echo '<tr>';
            echo '<td>' . $v->getFolio() . '</td>';
            // echo '<td>' . $registro['idArticulo'] . '</td>';
            echo '<td>' . $v->getFecha() . '</td>';
            echo '<td>$' . $v->getTotal() . '</td>';
            echo '</tr>';
            $total += $v->getTotal();
        }
         echo '<tr>';
        echo '<td colspan="2" style="font-weight:bold;">Total</td>';
        echo '<td style="font-weight:bold;">$' . $total . '</td>';
        echo '</tr>';
        echo '</table>';
        // echo 'total: $'.$total;
        echo '</div>';
        echo '</div>';
        echo '<div class="div-boton-imprimir">';
        echo '<button onclick="window.print()" class="boton" >Imprimir tabla</button>';
        echo '<button onclick="exportarXcel()" id="exportar" class="boton">Exportar a Excel</button>';
        echo '</div>';
    } else {
        echo '<p>No se encontraron registros en el rango de fechas seleccionado.</p>';
    }
} elseif (isset($_POST['consultar_tiendas']) && isset($username) && $rol == "root") {
    
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];

    include_once 'SQLVenta.php';
    //include_once 'Venta.php';
    $sqlVenta = new SQLVenta();

    $ventasPorTienda = $sqlVenta->getVentasPorTienda($fecha_inicio, $fecha_fin);

    if (!empty($ventasPorTienda)) {
        echo '<div id="printableArea">';
        echo '<h3>Resumen de Ventas por Tienda</h3>';
        echo '<p class="parrafos-estadocuenta">Desde: ' . $fecha_inicio . ' --- Hasta: ' . $fecha_fin . '</p>';
        echo '<p class="parrafos-estadocuenta">Registros encontrados: ' . count(mysqli_fetch_all($ventasPorTienda)) . '</p>';
        echo '<div class="table-container">';
        echo '<table class="tablaExistencias" id="miTabla">';
        echo '<tr><th>ID Tienda</th><th>Tienda</th><th>Cantidad</th><th>Total</th></tr>';
        $total = 0;
        $cant_total = 0;
        foreach ($ventasPorTienda as $venta) {
            echo '<tr>';
            echo '<td>' . $venta['idTienda'] . '</td>';
            echo '<td>' . $venta['descripcion'] . '</td>';
            echo '<td>' . $venta['cantidad_ventas'] . '</td>';
            echo '<td>$' . $venta['total_ventas'] . '</td>';
            echo '</tr>';
            $total += $venta['total_ventas'];
            $cant_total += $venta['cantidad_ventas'];
        }
        echo '<tr>';
        echo '<td colspan="2" style="font-weight:bold;">Total</td>';
        echo '<td style="font-weight:bold;">' . $cant_total . '</td>';
        echo '<td style="font-weight:bold;">$' . $total . '</td>';
        echo '</tr>';
        echo '</table>';
        echo '</div>';
        echo '</div>';
        echo '<div class="div-boton-imprimir">';
        echo '<button onclick="window.print()" class="boton" >Imprimir tabla</button>';
        echo '<button onclick="exportarXcel()" id="exportar" class="boton">Exportar a Excel</button>';
        echo '</div>';
    } else {
        echo '<p>No se encontraron ventas registradas.</p>';
    }
}
?>
</main>
    <?php
        $front->footer();
    ?>
    <script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>
    <script type="text/javascript" src="js/scripts.js"></script>
</body>
</html>