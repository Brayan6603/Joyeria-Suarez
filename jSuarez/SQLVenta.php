<?php
    include_once 'MysqlConnector.php';
    include_once 'Venta.php';
    class SQLVenta{
        private $mysql;

        public function __construct(){
            $this->mysql = new MysqlConnector();
        }

        public function insertVenta(Venta $venta){
            $this->mysql->Connect();
            $query = "INSERT INTO ventas (idArticulo, idCliente, idTienda, fecha, cantidad, total) VALUES ("
                . $venta->getIdArticulo() . ", "
                . $venta->getIdCliente() . ", "
                . $venta->getIdTienda() . ", '"
                . $venta->getFecha() . "', "
                . $venta->getCantidad() . ", "
                . $venta->getTotal() . ")";
            $result = $this->mysql->ExecuteQuery($query);
            if ($result) {
                $newFolio = $this->mysql->getLastInsertId();
            } else {
                $newFolio = false;
            }
        
            $this->mysql->CloseConnection();
            return $newFolio;
            
        }

        public function getVentasByIdCliente($idCliente){
            $this->mysql->Connect();
            $query = "SELECT * FROM ventas WHERE idCliente = " . $idCliente;
            $result = $this->mysql->ExecuteQuery($query);
            $this->mysql->CloseConnection();
            return $result;
        }

        public function getVentasByIdClienteAndOrderDesc($idCliente){
            $this->mysql->Connect();
            $query = "SELECT * FROM ventas WHERE idCliente = " . $idCliente." ORDER BY fecha DESC";
            $result = $this->mysql->ExecuteQuery($query);
            $this->mysql->CloseConnection();
            return $result;
        }

        // public function getVentasByFolio($folio){
        //     $this->mysql->Connect();
        //     $query = "SELECT * FROM ventas WHERE folio = " . $folio;
        //     $result = $this->mysql->ExecuteQuery($query);
        //     $this->mysql->CloseConnection();
        //     return $result;
        // }

        public function getEstadoCuentaByFecha($fechaInicio, $fechaFin) {
            $this->mysql->Connect();
            $query = "SELECT * FROM ventas WHERE fecha BETWEEN '$fechaInicio' AND '$fechaFin' ORDER BY fecha DESC";
            $result = $this->mysql->ExecuteQuery($query);
            $this->mysql->CloseConnection();
            return $result;
        }

        public function getVentasPorTienda($fechaInicio, $fechaFin) {
            $this->mysql->Connect();
            $query = "SELECT v.idTienda, t.descripcion, sum(v.cantidad) AS cantidad_ventas, SUM(v.total) AS total_ventas FROM ventas v INNER JOIN tiendas t on v.idTienda = t.idTienda WHERE v.fecha BETWEEN '$fechaInicio' AND '$fechaFin' GROUP BY v.idTienda,t.descripcion";
            $result = $this->mysql->ExecuteQuery($query);
            $this->mysql->CloseConnection();
            return $result;
        }

        public function getVentasPorArticulo($fechaInicio, $fechaFin, $habilitado) {
            $this->mysql->Connect();
            $query = "SELECT v.idArticulo, a.descripcion, sum(v.cantidad) AS cantidad_ventas, SUM(v.total) AS total_ventas FROM ventas v INNER JOIN articulos a on v.idArticulo = a.idArticulo WHERE (v.fecha BETWEEN '$fechaInicio' AND '$fechaFin') AND a.estado = '$habilitado' GROUP BY v.idArticulo,a.descripcion";
            $result = $this->mysql->ExecuteQuery($query);
            $this->mysql->CloseConnection();
            return $result;
        }
    }

?>