<?php
include_once "cliente.php";
include_once "motoNacional.php";
include_once "motoImportadas.php";
class Venta{
    private $numero;
    private $fecha;
    private $referenciaCliente;
    private $referenciaColcMotos;
    private $precioFinal;
    
    public function __construct($num, $fech,$refeClien,$refeColecMot,$precFin){
        $this->numero = $num;
        $this->fecha = $fech;
        $this->referenciaCliente = $refeClien;
        $this->referenciaColcMotos = $refeColecMot;
        $this->precioFinal = $precFin;
    }
    public function getNumero(){
        return $this->numero;
    }

    public function getFecha(){
        return $this->fecha;
    }

    public function getReferenciaCliente(){
        return $this->referenciaCliente;
    }

    public function getReferenciaColcMotos(){
        return $this->referenciaColcMotos;
    }
    public function setReferenciaColcMotos($refeColecMot){
        $this->referenciaColcMotos = $refeColecMot;
    }

    public function getPrecioFinal(){
        return $this->precioFinal;
    }
    public function setPrecioFinal($precFin){
        $this->precioFinal = $precFin;
    }
    public function __toString(){
        $inf="Numero de Venta: ".$this->getNumero()."\nFecha: ".$this->getFecha()."\nCliente: ".$this->getReferenciaCliente().
        "\nColeccion de Motos: \n";
        for($i=0;$i<count($this->getReferenciaColcMotos());$i++){
            $inf.= "Moto ".($i+1).":\n".$this->getReferenciaColcMotos()[$i].
            "\n**************************************************\n";
        } 
        $inf .= "Presio Final: ".$this->getPrecioFinal();
        return $inf;
    }
    public function retornarTotalVentaNacional(){
        $precioColecMotosNacional =0;
        if(count($this->getReferenciaColcMotos())>0){
            foreach($this->getReferenciaColcMotos() as $objMoto){
                if($objMoto->getTipo()=="nacional"){
                    $impor = $objMoto->darPrecioVenta();
                    if($impor != -1){
                        $precioColecMotosNacional += $impor;
                    }
                }
            }
        }
        return $precioColecMotosNacional;
    }
    public function retornarTotalVentaImportadas(){
        $colecMotosImportadas = [];
        if(count($this->getReferenciaColcMotos())>0){
            foreach($this->getReferenciaColcMotos() as $objMoto){
                if($objMoto->getTipo()=="Importada"){
                    if($objMoto->darPrecioVenta() != -1){
                        $i = count($colecMotosImportadas);
                        $colecMotosImportadas[$i]=$objMoto;
                    }
                }
            }
        }
        return $colecMotosImportadas;
    }
    public function incorporarMoto($objMoto){
        $venta = $objMoto->darPrecioVenta();
        $nuevaCol = $this->getReferenciaColcMotos();
        if($venta!=-1){
            $np = count($this->getReferenciaColcMotos());
            $nuevaCol[$np]= $objMoto;
            $this->setReferenciaColcMotos($nuevaCol);
            $this->setPrecioFinal($venta);
            $resp = true;
        }else{
            $resp = false;
        }
        return $resp;
    }
}