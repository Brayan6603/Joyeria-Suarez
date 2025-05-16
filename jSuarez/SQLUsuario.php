<?php
    include_once 'MysqlConnector.php';
    include_once 'Usuario.php';

    class SQLUsuario{
        private $mysql;

        public function __construct(){
            $this->mysql = new MysqlConnector();
        }

        public function signUp(Usuario $usuario){
            $this->mysql->Connect();
            $md5Password = md5($usuario->getPassword());
            $query = "INSERT INTO cliente (nombre, apellidos, correo, direccionPostal, colonia, ciudad, estado, pais, cp, usuario, clave,rol) VALUES (
                '".$usuario->getNombre()."',
                '".$usuario->getApellidos()."',
                '".$usuario->getEmail()."',
                '".$usuario->getDireccion()."',
                '".$usuario->getColonia()."',
                '".$usuario->getCiudad()."',
                '".$usuario->getEstado()."',
                '".$usuario->getPais()."',
                '".$usuario->getCp()."',
                '".$usuario->getNombreUsuario()."',
                '".$md5Password."',
                '".$usuario->getRol()."'
            )";
            $result = $this->mysql->ExecuteQuery($query);
            $this->mysql->CloseConnection();
            return $result;
            
        }

        public function signIn(Usuario $usuario){
            $findit = false;
            $this->mysql->Connect();
            $md5Password = md5($usuario->getPassword());
            $query = "SELECT * FROM cliente WHERE usuario = '".$usuario->getNombreUsuario()."' AND clave = '".$md5Password."'";
            $result = $this->mysql->ExecuteQuery($query);
            $this->mysql->CloseConnection();
            if(mysqli_num_rows($result) > 0){
                $findit = true;
            }
            return $findit;
        }
        public function getIdByUsername($username){
            $this->mysql->Connect();
            $query = "SELECT idCliente FROM cliente WHERE usuario = '".$username."'";
            $result = $this->mysql->ExecuteQuery($query);
            $this->mysql->CloseConnection();
            return $result;
        }
        public function getUserById($id){
            $this->mysql->Connect();
            $query = "SELECT * FROM cliente WHERE idCliente = '".$id."'";
            $result = $this->mysql->ExecuteQuery($query);
            $this->mysql->CloseConnection();
            return $result;
        }
        public function updateUser(Usuario $usuario){
            $this->mysql->Connect();
            $query = "UPDATE cliente SET nombre = '".$usuario->getNombre()."',
                apellidos = '".$usuario->getApellidos()."',
                correo = '".$usuario->getEmail()."',
                direccionPostal = '".$usuario->getDireccion()."',
                colonia = '".$usuario->getColonia()."',
                ciudad = '".$usuario->getCiudad()."',
                estado = '".$usuario->getEstado()."',
                pais = '".$usuario->getPais()."',
                cp = '".$usuario->getCp()."',
                usuario = '".$usuario->getNombreUsuario()."'
                WHERE idCliente = ".$usuario->getId();
            $result = $this->mysql->ExecuteQuery($query);
            $this->mysql->CloseConnection();
            return $result;
        }
        public function updatePassword(Usuario $usuario){
            $this->mysql->Connect();
            $md5Password = md5($usuario->getPassword());
            $query = "UPDATE cliente SET clave = '".$md5Password."' WHERE idCliente = ".$usuario->getId();
            $result = $this->mysql->ExecuteQuery($query);
            $this->mysql->CloseConnection();
            return $result;
        }
        public function getRolbyId($id){
            $this->mysql->Connect();
            $query = "SELECT rol FROM cliente WHERE idCliente = '".$id."'";
            $result = $this->mysql->ExecuteQuery($query);
            $this->mysql->CloseConnection();
            return $result;
        }

        public function getAllUsers(){
            $this->mysql->Connect();
            $query = "SELECT * FROM cliente";
            $result = $this->mysql->ExecuteQuery($query);
            $this->mysql->CloseConnection();
            return $result;
        }
    }


?>