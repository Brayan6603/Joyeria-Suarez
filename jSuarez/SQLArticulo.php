<?php 
    include_once 'MysqlConnector.php';
    include_once 'Articulo.php';
    class SQLArticulo{
        private $mysql;

        public function __construct(){
            $this->mysql = new MysqlConnector();
        }

        public function addArticulo(Articulo $articulo){
            $this->mysql->Connect();
            $query = "INSERT INTO articulos (idLinea, descripcion, caracteristicas, precio, img, estado) VALUES ('".$articulo->getLinea()."', '".$articulo->getDescripcion()."', '".$articulo->getCaracteristicas()."', '".$articulo->getPrecio()."', '".$articulo->getImagen()."', '".$articulo->getEstado()."')";
            $result = $this->mysql->ExecuteQuery($query);
            $this->mysql->CloseConnection();
            return $result;
        }

        public function getAllArticulos(){
            $this->mysql->Connect();
            $query = "SELECT * FROM articulos";
            $result = $this->mysql->ExecuteQuery($query);
            $this->mysql->CloseConnection();
            return $result;
        }

        public function getArticuloById($id){
            $this->mysql->Connect();
            $query = "SELECT * FROM articulos WHERE idArticulo = ".$id;
            $result = $this->mysql->ExecuteQuery($query);
            $this->mysql->CloseConnection();
            return $result;
        }

        public function getEstadoArticulo($id){
            $this->mysql->Connect();
            $query = "SELECT estado FROM articulos WHERE idArticulo = ".$id;
            $result = $this->mysql->ExecuteQuery($query);
            $this->mysql->CloseConnection();
            if($result){
                $row = mysqli_fetch_assoc($result);
                return $row['estado'];
            }
            //return $result;
        }

      

        public function updateArticulo(Articulo $articulo){
            $this->mysql->Connect();
            $query = "UPDATE articulos SET idLinea = '".$articulo->getLinea()."', descripcion = '".$articulo->getDescripcion()."', caracteristicas = '".$articulo->getCaracteristicas()."', precio = '".$articulo->getPrecio()."', img = '".$articulo->getImagen()."' WHERE idArticulo = ".$articulo->getId();
            $result = $this->mysql->ExecuteQuery($query);
            $this->mysql->CloseConnection();
            return $result;
        }

        public function deleteArticulo($id){
            $this->mysql->Connect();
            $query = "DELETE FROM articulos WHERE idArticulo = ".$id;
            $result = $this->mysql->ExecuteQuery($query);
            $this->mysql->CloseConnection();
            return $result;
        }

        public function disableArticulo($id){
            $this->mysql->Connect();
            $query = "UPDATE articulos SET estado = 0 WHERE idArticulo = ".$id;
            $result = $this->mysql->ExecuteQuery($query);
            $this->mysql->CloseConnection();
            return $result;
        }
        public function enableArticulo($id){
            $this->mysql->Connect();
            $query = "UPDATE articulos SET estado = 1 WHERE idArticulo = ".$id;
            $result = $this->mysql->ExecuteQuery($query);
            $this->mysql->CloseConnection();
            return $result;
        }
        public function getArticulosByLinea($idLinea){
            $this->mysql->Connect();
            $query = "SELECT * FROM articulos WHERE idLinea = ".$idLinea;
            $result = $this->mysql->ExecuteQuery($query);
            $this->mysql->CloseConnection();
            return $result;
        }

        public function getArticulosByLineaAndEnable($idLinea){
            $this->mysql->Connect();
            $query = "SELECT * FROM articulos WHERE estado = 1 and idLinea = ".$idLinea;
            $result = $this->mysql->ExecuteQuery($query);
            $this->mysql->CloseConnection();
            return $result;
        }
    }
?>