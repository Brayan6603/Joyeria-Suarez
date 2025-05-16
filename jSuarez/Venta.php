<?php
    class Venta{
        private $folio;
        private $idArticulo;
        private $idCliente;
        private $idTienda;
        private $fecha;
        private $cantidad;
        private $total;

        public function __construct(){
            $this->folio = 0;
            $this->idArticulo = 0;
            $this->idCliente = 0;
            $this->idTienda = 0;
            $this->fecha = "";
            $this->cantidad = 0;
            $this->total = 0;
        }

        public function setFolio($folio){
            $this->folio = $folio;
        }
        public function setIdArticulo($idArticulo){
            $this->idArticulo = $idArticulo;
        }
        public function setIdCliente($idCliente){
            $this->idCliente = $idCliente;
        }
        public function setIdTienda($idTienda){
            $this->idTienda = $idTienda;
        }
        public function setFecha($fecha){
            $this->fecha = $fecha;
        }
        public function setCantidad($cantidad){
            $this->cantidad = $cantidad;
        }
        public function setTotal($total){
            $this->total = $total;
        }
        public function getFolio(){
            return $this->folio;
        }
        public function getIdArticulo(){
            return $this->idArticulo;
        }
        public function getIdCliente(){
            return $this->idCliente;
        }
        public function getIdTienda(){
            return $this->idTienda;
        }
        public function getFecha(){
            return $this->fecha;
        }
        public function getCantidad(){
            return $this->cantidad;
        }
        public function getTotal(){
            return $this->total;
        }




    }



?>