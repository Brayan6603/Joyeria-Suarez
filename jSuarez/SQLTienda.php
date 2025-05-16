<?php 
    include_once 'MysqlConnector.php';
    include_once 'Tienda.php';

    class SQLTienda{
        private $mysql;

        public function __construct(){
            $this->mysql = new MysqlConnector();
        }

        public function addTienda(Tienda $tienda){
            $this->mysql->Connect();
            $query = "INSERT INTO tiendas (descripcion, ciudad, direccion, cp, horario, imagen) VALUES ('".$tienda->getDescripcion()."', '".$tienda->getCiudad()."', '".$tienda->getDireccion()."', '".$tienda->getCp()."', '".$tienda->getHorario()."', '".$tienda->getUrl()."')";
            $result = $this->mysql->ExecuteQuery($query);
            $this->mysql->CloseConnection();
            return $result;
        }

        public function getAllTiendas(){
            $this->mysql->Connect();
            $query = "SELECT * FROM tiendas";
            $result = $this->mysql->ExecuteQuery($query);
            $this->mysql->CloseConnection();
            return $result;
        }

        public function getTiendaById($id){
            $this->mysql->Connect();
            $query = "SELECT * FROM tiendas WHERE idTienda = ".$id;
            $result = $this->mysql->ExecuteQuery($query);
            $this->mysql->CloseConnection();
            return $result;
        }

        public function updateTienda(Tienda $tienda){
            $this->mysql->Connect();
            $query = "UPDATE tiendas SET descripcion = '".$tienda->getDescripcion()."', ciudad = '".$tienda->getCiudad()."', direccion = '".$tienda->getDireccion()."', cp = '".$tienda->getCp()."', horario = '".$tienda->getHorario()."', imagen = '".$tienda->getUrl()."' WHERE idTienda = ".$tienda->getId();
            $result = $this->mysql->ExecuteQuery($query);
            $this->mysql->CloseConnection();
            return $result;
        }

        public function deleteTienda($id){
            $this->mysql->Connect();
            $query = "DELETE FROM tiendas WHERE idTienda = ".$id;
            $result = $this->mysql->ExecuteQuery($query);
            $this->mysql->CloseConnection();
            return $result;
        }

        public function disableTienda($id){
            $this->mysql->Connect();
            $query = "UPDATE tiendas SET activo = 0 WHERE idTienda = ".$id;
            $result = $this->mysql->ExecuteQuery($query);
            $this->mysql->CloseConnection();
            return $result;
        }

        public function enableTienda($id){
            $this->mysql->Connect();
            $query = "UPDATE tiendas SET activo = 1 WHERE idTienda = ".$id;
            $result = $this->mysql->ExecuteQuery($query);
            $this->mysql->CloseConnection();
            return $result;
        }
        public function getEnableTiendas(){
            $this->mysql->Connect();
            $query = "SELECT * FROM tiendas WHERE activo = 1";
            $result = $this->mysql->ExecuteQuery($query);
            $this->mysql->CloseConnection();
            return $result;
        }
        public function getIfTiendaEnable($id){
            $this->mysql->Connect();
            $query = "SELECT activo FROM tiendas WHERE idTienda = ".$id;
            $result = $this->mysql->ExecuteQuery($query);
            $this->mysql->CloseConnection();
            if($result){
                $row = mysqli_fetch_assoc($result);
                return $row['activo'];
            }
        }
    }

?>