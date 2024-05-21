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
        $cad .= "\nPorcentaje de Descuento: ".$this->getPorcentajeDescuento()."%\n";
        return $cad;
    }
    public function darPrecioVenta(){
        $precio = parent:: darPrecioVenta();
        $precioVenta = 0;
        if ($precio != -1){
            $precioVenta = $precio - (($precio*$this->getPorcentajeDescuento())/100);
        }else{
            $precioVenta = $precio;
        }
        return $precioVenta;
    }
}