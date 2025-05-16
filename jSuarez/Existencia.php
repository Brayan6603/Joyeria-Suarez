<?php
    class Existencia {
        private $idArticulo;
        private $idTienda;
        private $cantidad;
        private $nombreArticulo;
        private $nombreTienda;

        public function __construct() {
            $this->idArticulo = 0;
            $this->idTienda = 0;
            $this->cantidad = 0;
            $this->nombreArticulo = "";
            $this->nombreTienda = "";
        }

        public function setIdArticulo($idArticulo) {
            $this->idArticulo = $idArticulo;
        }
        public function setIdTienda($idTienda) {
            $this->idTienda = $idTienda;
        }
        public function setCantidad($cantidad) {
            $this->cantidad = $cantidad;
        }
        public function getIdArticulo() {
            return $this->idArticulo;
        }
        public function getIdTienda() {
            return $this->idTienda;
        }
        public function getCantidad() {
            return $this->cantidad;
        }
        public function setNombreArticulo($nombreArticulo) {
            $this->nombreArticulo = $nombreArticulo;
        }
        public function setNombreTienda($nombreTienda) {
            $this->nombreTienda = $nombreTienda;
        }
        public function getNombreArticulo() {
            return $this->nombreArticulo;
        }
        public function getNombreTienda() {
            return $this->nombreTienda;
        }
    }


?>