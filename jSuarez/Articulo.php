<?php
    class Articulo{
        private $id;
        private $linea;
        private $descripcion;
        private $caracteristicas;
        private $precio;
        private $imagen;
        private $estado;
        public function __construct(){
            $this->id = 0;
            $this->linea = 0;
            $this->descripcion = "";
            $this->caracteristicas = "";
            $this->precio = 0;
            $this->imagen = "";
            $this->estado = 1;
        }
        public function getId(){
            return $this->id;
        }
        public function setId($id){
            $this->id = $id;
        }
        public function getLinea(){
            return $this->linea;
        }
        public function setLinea($linea){
            $this->linea = $linea;
        }
        public function getDescripcion(){
            return $this->descripcion;
        }
        public function setDescripcion($descripcion){
            $this->descripcion = $descripcion;
        }
        public function getCaracteristicas(){
            return $this->caracteristicas;
        }
        public function setCaracteristicas($caracteristicas){
            $this->caracteristicas = $caracteristicas;
        }
        public function getPrecio(){
            return $this->precio;
        }
        public function setPrecio($precio){
            $this->precio = $precio;
        }
        public function getImagen(){
            return $this->imagen;
        }
        public function setImagen($imagen){
            $this->imagen = $imagen;
        }
        public function getEstado(){
            return $this->estado;
        }
        public function setEstado($estado){
            $this->estado = $estado;
        }
    }


?>