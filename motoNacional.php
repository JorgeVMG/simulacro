<?php
include_once "moto.php";
class MotoNacional extends Moto{
    private $porcentajeDescuento;
    public function __construct($cod,$cost,$anio,$desc,$porc,$act,$porcDesc){
        parent:: __construct($cod,$cost,$anio,$desc,$porc,$act);
        $this->porcentajeDescuento = $porcDesc ?? 15;
    }
    public function getPorcentajeDescuento(){
        return $this->porcentajeDescuento;
    }
    public function setPorcentajeDescuento($porcDesc){
        $this->porcentajeDescuento = $porcDesc;
    }
    public function __toString(){
        $cad = parent:: __toString();
        $cad .= "\nPorcentaje de Descuento: ".$this->getPorcentajeDescuento()."%\n";
        return $cad;
    }
    public function darPrecioVenta(){
        $precio = parent:: darPrecioVenta();
        if ($precio != -1){
            $precio = $precio - (($precio*$this->getPorcentajeDescuento())/100);
        }
        return $precio;
    }
}