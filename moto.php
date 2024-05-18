<?php
class Moto{
    private $codigo;
    private $costo;
    private $anioFabricacion;
    private $descripcion;
    private $porcentajeAnual;
    private $activa;
    private $tipo;
    
    public function __construct($cod,$cost,$anio,$desc,$porc,$act,$tip){
        $this->codigo = $cod;
        $this->costo = $cost;
        $this->anioFabricacion = $anio;
        $this->descripcion = $desc;
        $this->porcentajeAnual = $porc;
        $this->activa = $act;
        $this->tipo = $tip;
    }
   
    public function getCodigo(){
        return $this->codigo;
    }

    public function getCosto(){
        return $this->costo;
    }

    public function getAnioFabricacion(){
        return $this->anioFabricacion;
    }

    public function getDescripcion(){
        return $this->descripcion;
    }

    public function getPorcentajeAnual(){
        return $this->porcentajeAnual;
    }

    public function getActiva(){
        return $this->activa;
    }
    public function setActiva($act){
        $this->activa=$act;
    }
    public function getTipo(){
        return $this->tipo;
    }
    public function __toString(){
        return "Codigo de Moto: ".$this->getCodigo()."\nCosto: ".$this->getCosto()."\nAño de fabricacion: ".$this->getAnioFabricacion().
        "\nDescripcion: ".$this->getDescripcion()."\nPorcentaje Anual: ".$this->getPorcentajeAnual()."\nActiva: ".$this->getActiva();
    }
    public function darPrecioVenta(){
        if($this->getActiva()){
            $anio = 2024 - $this->getAnioFabricacion();
            $venta = $this->getCosto() + ($this->getCosto()*($anio*$this->getPorcentajeAnual()));
            $this->setActiva(false);
        }else{
            $venta = -1;
        }
        return $venta;
    }
}