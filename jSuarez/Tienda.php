<?php 
class Tienda {
    private $id;
    private $descripcion;
    private $ciudad;
    private $direccion;
    private $cp;
    private $horario;
    private $url;
    //private $activo;

    public function __construct() {
        $this->id = 0;
        $this->descripcion = "";
        $this->ciudad = "";
        $this->direccion = "";
        $this->cp = "";
        $this->horario = "";
        $this->url = "";
    }

    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }
    public function getDescripcion() {
        return $this->descripcion;
    }
    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }
    public function getCiudad() {
        return $this->ciudad;
    }
    public function setCiudad($ciudad) {
        $this->ciudad = $ciudad;
    }
    public function getDireccion() {
        return $this->direccion;
    }
    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }
    public function getCp() {
        return $this->cp;
    }
    public function setCp($cp) {
        $this->cp = $cp;
    }
    public function getHorario() {
        return $this->horario;
    }
    public function setHorario($horario) {
        $this->horario = $horario;
    }
    public function getUrl() {
        return $this->url;
    }
    public function setUrl($url) {
        $this->url = $url;
    }
}



?>