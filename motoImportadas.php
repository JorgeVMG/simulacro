<?php 
include_once "moto.php";
class MotoImportada extends Moto{
    private $pais;
    private $impueto;
    
    public function __construct($cod,$cost,$anio,$desc,$porc,$act,$pai,$impues){
        parent:: __construct($cod,$cost,$anio,$desc,$porc,$act);
        $this->pais = $pai;
        $this->impueto = $impues;
    }
    public function getPais(){
        return $this->pais;
    }
    public function setPais($pai){
        $this->pais = $pai;
    }
    public function getImpuesto(){
        return $this->impueto;
    }
    public function setImpuesto($impues){
        $this->impueto = $impues;
    }
    public function __toString(){
        $cad = parent::__toString();
        $cad.= "\nPais de Importacion: ".$this->getPais()."\nImpuesto Pais: ".$this->getImpuesto();
        return $cad;
    }
    public function darPrecioVenta(){
        $precio = parent:: darPrecioVenta();
        if ($precio != -1){
            $precio = $precio + $this->getImpuesto();
        }
        return $precio;
    }
    
}