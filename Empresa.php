<?php
include_once "moto.php";
include_once "cliente.php";
include_once "venta.php";
class Empresa{
    private $denominacion;
    private $direccion;
    private $colecClientes;
    private $colecMotos;
    private $colecVentasRealizadas;

    public function __construct($den, $dire, $colcClien,$colcMot,$colcVent){
        $this->denominacion = $den;
        $this->direccion = $dire;
        $this->colecClientes = $colcClien;
        $this->colecMotos = $colcMot;
        $this->colecVentasRealizadas = $colcVent;
    }

    public function getDenominacion(){
        return $this->denominacion;
    }

    public function getDireccion(){
        return $this->direccion;
    }

    public function getColeccionClientes(){
        return $this->colecClientes;
    }

    public function getColeccionMotos(){
        return $this->colecMotos;
    }

    public function getColeccionVentasRealizadas(){
        return $this->colecVentasRealizadas;
    }
    public function setColeccionVentasRealizadas($colcVent){
        $this->colecVentasRealizadas=$colcVent;
    }
    public function retornarClientes(){
        $inf = "";
        foreach($this->getColeccionClientes() as $i => $cliente){
            $inf.= "Cliente ".($i+1).":\n". $cliente.
            "\n**************************************************\n";
        }
        return $inf;
    }
    public function retornarMotos(){
        $inf = "";
        foreach($this->getColeccionMotos() as $i => $moto){
            $inf.= "Moto ".($i+1).":\n".$moto.
            "\n**************************************************\n";
        }
        return $inf;
    }
    public function retornarVentas(){
        $inf = "";
        foreach($this->getColeccionVentasRealizadas() as $i => $ventaRealiza){
            $inf.= "Venta ".($i+1)."\n".$ventaRealiza.
            "\n**************************************************\n";
        }
        return $inf;
    }
    public function __toString(){
        $cad="**************************************************\n";
        $cad .="Nombre de la Empres: ".$this->getDenominacion()."\nDireccion: ".$this->getDireccion().
        "\n**************************************************\nClientes:\n".$this->retornarClientes().
        "Motos: \n".$this->retornarMotos()."Ventas Realizadas: \n".$this->retornarVentas();
        return $cad;
    }
    /**Implementar el método retornarMoto($codigoMoto) que recorre la colección de motos de la Empresa y
     * retorna la referencia al objeto moto cuyo código coincide con el recibido por parámetro. */
    public function retornarMoto($codigoMoto){
        $colcMotos=$this->getColeccionMotos();
        $encontrado = null;
        $i=0;
        while ($i < count($colcMotos) && $encontrado==null) {
            $j = $colcMotos[$i]->getCodigo();
            if ($j == $codigoMoto) {
                $encontrado = $colcMotos[$i];
            }
            $i++;
        }
        return $encontrado;
    }    
    public function registrarVenta($colCodigosMoto, $objCliente){
        $colecVen = $this->getColeccionVentasRealizadas();
        $importeFinal = 0;
        $colcMotos = [];
        $numV = count($this->getColeccionVentasRealizadas())+1;
        $fech = "23-05-24";
        $precF = 0;
        $respuesta = false;
        $objVenta = new Venta($numV, $fech, $objCliente, $colcMotos, $precF);
            if (count($colCodigosMoto)>0){
                if ($objCliente->getEstado()==true){ 
                    foreach($colCodigosMoto as $codigoMoto){
                        $encontrado = $this->retornarMoto($codigoMoto);
                        if($encontrado!=null){
                            $moto = $objVenta->incorporarMoto($encontrado);
                            if($moto>0){
                                $respuesta = true;
                                $importeFinal += $moto;
                            }
                        }
                }
                if($respuesta == true){
                    $i = count($colecVen);
                    $colecVen[$i] = $objVenta;
                    $this->setColeccionVentasRealizadas($colecVen);
                    $objVenta->setPrecioFinal($importeFinal);
                }
                
            }
        }
        return $importeFinal;
    }
    public function  informarSumaVentasNacionales(){
        $precioVentasRealizadas=0;
        foreach($this->getColeccionVentasRealizadas() as $venta){
            $precioVentasRealizadas += $venta->retornarTotalVentaNacional();
        }
        return $precioVentasRealizadas;
    }
    public function retornarMotosImportadas(){
        $colecMotosImportadas = [];
        foreach ($this->getColeccionVentasRealizadas() as $venta){
            if(count($venta->retornarTotalVentaImportadas())>0){
                $i = count($colecMotosImportadas);
                $colecMotosImportadas[$i] = $venta->retornarTotalVentaImportadas();
            }
        }
        return $colecMotosImportadas;
    }
}