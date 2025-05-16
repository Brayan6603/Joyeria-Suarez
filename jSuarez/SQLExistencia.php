<?php 
include_once 'Existencia.php';
include_once 'MysqlConnector.php';
class SQLExistencia{
    private $mysql;

    public function __construct() {
        $this->mysql = new MysqlConnector();
    }
    public function getAllExistencias() {
        $this->mysql->Connect();
        $query = "SELECT * FROM existencias";
        $result = $this->mysql->ExecuteQuery($query);
        $this->mysql->CloseConnection();
        return $result;
    }

    public function getNombreArticuloById($idArticulo) {
        $this->mysql->Connect();
        $query = "SELECT descripcion FROM articulos WHERE idArticulo =".$idArticulo;
        $result = $this->mysql->ExecuteQuery($query);
        $this->mysql->CloseConnection();
        if($result) {
            $row = mysqli_fetch_array($result);
            return $row['descripcion'];
        }
    }
    public function getNombreTiendaById($idTienda) {
        $this->mysql->Connect();
        $query = "SELECT descripcion FROM tiendas WHERE idTienda =".$idTienda;
        $result = $this->mysql->ExecuteQuery($query);
        $this->mysql->CloseConnection();
        if($result) {
            $row = mysqli_fetch_array($result);
            return $row['descripcion'];
        }
        //return $result;
    }
    public function getExistenciasByArticulo(Existencia $exi) {
        $this->mysql->Connect();
        $query = "SELECT idTienda, cantidad FROM existencias WHERE idArticulo =" . $exi->getIdArticulo() . " ORDER BY cantidad DESC";
        $result = $this->mysql->ExecuteQuery($query);
        $this->mysql->CloseConnection();
        return $result;
    }

    public function updateExistencia(Existencia $exi) {
        $this->mysql->Connect();
        $query = "UPDATE existencias SET cantidad =".$exi->getCantidad()." WHERE idArticulo =".$exi->getIdArticulo()." AND idTienda =".$exi->getIdTienda();
        $result = $this->mysql->ExecuteQuery($query);
        $this->mysql->CloseConnection();
        return $result;
    }
    public function addExistencia(Existencia $exi) {
        $this->mysql->Connect();
        $query = "INSERT INTO existencias (idArticulo, idTienda, cantidad) VALUES (".$exi->getIdArticulo().", ".$exi->getIdTienda().", ".$exi->getCantidad().")";
        $result = $this->mysql->ExecuteQuery($query);
        $this->mysql->CloseConnection();
        return $result;
    }
    public function substractExistencia(Existencia $exi) {
        $this->mysql->Connect();
        $query = "UPDATE existencias SET cantidad = cantidad - ".$exi->getCantidad()." WHERE idArticulo =".$exi->getIdArticulo()." AND idTienda =".$exi->getIdTienda();
        $result = $this->mysql->ExecuteQuery($query);
        $this->mysql->CloseConnection();
        return $result;
    }

    public function getExistenciasFiltered($idArticulo = null, $idTienda = null) {
        $this->mysql->Connect();
        $query = "
            SELECT 
                e.idArticulo,
                a.descripcion AS articulo,
                e.idTienda,
                t.descripcion AS tienda,
                e.cantidad
            FROM existencias e
            INNER JOIN articulos a ON e.idArticulo = a.idArticulo
            INNER JOIN tiendas t   ON e.idTienda   = t.idTienda
            WHERE 1=1";
        
        if ($idArticulo !== null) {
            $query .= " AND e.idArticulo = " . $idArticulo;
        }
        if ($idTienda !== null) {
            $query .= " AND e.idTienda = " . $idTienda;
        }
    
        $result = $this->mysql->ExecuteQuery($query);
        $this->mysql->CloseConnection();
        return $result;
    }

}
?>