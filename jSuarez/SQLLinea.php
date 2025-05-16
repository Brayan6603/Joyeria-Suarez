<?php 
    include_once 'MysqlConnector.php';
    include_once 'Linea.php';
    class SQLLinea{
        private $mysql;

        public function __construct(){
            $this->mysql = new MysqlConnector();
        }
        public function getLineas(){
            $this->mysql->Connect();
            $query = "SELECT * FROM linea_articulos";
            $result = $this->mysql->ExecuteQuery($query);
            $this->mysql->CloseConnection();
            return $result;
        }
        public function addLinea($linea){
            $this->mysql->Connect();
            $query = "INSERT INTO linea_articulos (descripcion, activo) VALUES ('".$linea->getNombreLinea()."', '".$linea->getActivo()."')";
            $result = $this->mysql->ExecuteQuery($query);
            $this->mysql->CloseConnection();
            return $result;
        }
        public function updateLinea($linea){
            $this->mysql->Connect();
            $query = "UPDATE linea_articulos SET descripcion='".$linea->getNombreLinea()."', activo='".$linea->getActivo()."' WHERE idLinea='".$linea->getIdLinea()."'";
            $result = $this->mysql->ExecuteQuery($query);
            $this->mysql->CloseConnection();
            return $result;
        }
        public function getLineaById($id){
            $this->mysql->Connect();
            $query = "SELECT * FROM linea_articulos WHERE idLinea='".$id."'";
            $result = $this->mysql->ExecuteQuery($query);
            $this->mysql->CloseConnection();
            return $result;
        }
    }