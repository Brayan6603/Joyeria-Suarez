<?php

    class Linea{
        private $idLinea;
        private $nombreLinea;
        private $activo;

        public function __construct(){
            $this->idLinea = 0;
            $this->nombreLinea = "";
            $this->activo = 0;
        }

        public function getIdLinea(){
            return $this->idLinea;
        }
        public function setIdLinea($idLinea){
            $this->idLinea = $idLinea;
        }
        public function getNombreLinea(){
            return $this->nombreLinea;
        }
        public function setNombreLinea($nombreLinea){
            $this->nombreLinea = $nombreLinea;
        }
        public function getActivo(){
            return $this->activo;
        }
        public function setActivo($activo){
            $this->activo = $activo;
        }
    }

?>