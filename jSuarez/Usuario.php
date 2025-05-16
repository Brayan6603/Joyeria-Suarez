<?php
    class Usuario{
        private $id;
        private $nombre;
        private $apellidos;
        private $email;
        private $direccion;
        private $colonia;
        private $ciudad;
        private $estado;
        private $pais;
        private $cp;
        private $nombre_usuario;
        private $password;
        private $rol;

        
        public function __construct($r = null){
            $this->id = 0;
            $this->nombre = "";
            $this->apellidos = "";
            $this->email = "";
            $this->direccion = "";
            $this->colonia = "";
            $this->ciudad = "";
            $this->estado = "";
            $this->pais = "";
            $this->cp = "";
            $this->nombre_usuario = "";
            $this->password = "";
            $this->rol = $r;
        }
        public function setId($id){
            $this->id = $id;
        }
        public function getId(){
            return $this->id;
        }
        public function setNombre($nombre){
            $this->nombre = $nombre;
        }
        public function getNombre(){
            return $this->nombre;
        }
        public function setApellidos($apellidos){
            $this->apellidos = $apellidos;
        }
        public function getApellidos(){
            return $this->apellidos;
        }
        public function setEmail($email){
            $this->email = $email;
        }
        public function getEmail(){
            return $this->email;
        }
        public function setDireccion($direccion){
            $this->direccion = $direccion;
        }
        public function getDireccion(){
            return $this->direccion;
        }
        public function setColonia($colonia){
            $this->colonia = $colonia;
        }
        public function getColonia(){
            return $this->colonia;
        }
        public function setCiudad($ciudad){
            $this->ciudad = $ciudad;
        }
        public function getCiudad(){
            return $this->ciudad;
        }
        public function setEstado($estado){
            $this->estado = $estado;
        }
        public function getEstado(){
            return $this->estado;
        }
        public function setPais($pais){
            $this->pais = $pais;
        }
        public function getPais(){
            return $this->pais;
        }
        public function setCp($cp){
            $this->cp = $cp;
        }
        public function getCp(){
            return $this->cp;
        }
        public function setNombreUsuario($nombre_usuario){
            $this->nombre_usuario = $nombre_usuario;
        }
        public function getNombreUsuario(){
            return $this->nombre_usuario;
        }
        public function setPassword($password){
            $this->password = $password;
        }
        public function getPassword(){
            return $this->password;
        }
        public function setRol($rol){
            $this->rol = $rol;
        }
        public function getRol(){
            return $this->rol;
        }

    }

?>