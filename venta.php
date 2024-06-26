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
        $colMotos = $this->getReferenciaColcMotos();
            foreach($colMotos as $objMoto){
                if($objMoto instanceof MotoNacional){
                    $precioColecMotosNacional += $objMoto->darPrecioVenta();
                }
            }
        return $precioColecMotosNacional;
    }
    public function retornarTotalVentaImportadas(){
        $colecMotosImportadas = [];
        $colMotos = $this->getReferenciaColcMotos();
            foreach( $colMotos as $objMoto){
                if($objMoto instanceof MotoImportada){
                   array_push($colecMotosImportadas, $objMoto);
                }
            }
        return $colecMotosImportadas;
    }
    public function incorporarMoto($objMoto){
        $venta = $objMoto->darPrecioVenta();
        $nuevaCol = $this->getReferenciaColcMotos();
        if($venta!=-1){
            $i = count($this->getReferenciaColcMotos());
            $nuevaCol[$i]= $objMoto;
            $precioF = $venta + $this->getPrecioFinal();
            $this->setReferenciaColcMotos($nuevaCol);
            $this->setPrecioFinal($precioF);
            $resp = $venta;
        }else{
            $resp = -1;
        }
        return $resp;
    }
}