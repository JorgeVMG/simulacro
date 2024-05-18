<?php
include_once "moto.php";
class MotoNacionales extends Moto{
    private $porcentajeDescuento;
    public function __construct($cod,$cost,$anio,$desc,$porc,$act,$tip,$porcDesc){
        parent:: __construct($cod,$cost,$anio,$desc,$porc,$act,$tip);
        $this->porcentajeDescuento = $porcDesc;
    }
    public function getPorcentajeDescuento(){
        return $this->porcentajeDescuento;
    }
    public function setPorcentajeDescuento($porcDesc){
        $this->porcentajeDescuento = $porcDesc;
    }
    public function __toString(){
        $cad = parent:: __toString();
        $cad .= "Porcentaje de Descuento: ".$this->getPorcentajeDescuento()."%\n";
        return $cad;
    }
    public function darPrecioVenta(){
        $precioFinal = parent:: darPrecioVenta();
        if ($precioFinal != -1){
            $precioFinal = $precioFinal - (($precioFinal*$this->getPorcentajeDescuento())/100);
        }
        return $precioFinal;
    }
}