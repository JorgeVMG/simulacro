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

    public function __toString(){
        $inf="Nombre de la Empres: ".$this->getDenominacion()."\nDireccion: ".$this->getDireccion().
        "\n**************************************************\nClientes:\n";
        for($i=0;$i<count($this->getColeccionClientes());$i++){
            $inf.= "Cliente ".($i+1).":\n".$this->getColeccionClientes()[$i].
            "\n**************************************************\n";
        }
        $inf .= "Motos: \n";
        for($j=0;$j<count($this->getColeccionMotos());$j++){
            $inf.= "Moto ".($j+1).":\n".$this->getColeccionMotos()[$j].
            "\n**************************************************\n";
        }
        $inf .= "Ventas: \n";
        for($k=0;$k<count($this->getColeccionVentasRealizadas());$k++){
            $inf.= "Venta".($k+1)."\n".$this->getColeccionVentasRealizadas()[$k].
            "\n**************************************************\n";
        }
        return $inf;
    }
    /**Implementar el método retornarMoto($codigoMoto) que recorre la colección de motos de la Empresa y
     * retorna la referencia al objeto moto cuyo código coincide con el recibido por parámetro. */
    public function retornarMoto($codigoMoto){
        $colcMotos=$this->getColeccionMotos();
        $encontrado = false;
        $i=0;
        while ($i < count($colcMotos) && !$encontrado) {
            $j = $colcMotos[$i]->getCodigo();
            if ($j == $codigoMoto) {
                $encontrado = $colcMotos[$i];
            } else {
                $i++;
            }
        }
        return $encontrado;
    }
    /**6. Implementar el método registrarVenta($colCodigosMoto, $objCliente) método que recibe por
     * parámetro una colección de códigos de motos, la cual es recorrida, y por cada elemento de la colección
     * se busca el objeto moto correspondiente al código y se incorpora a la colección de motos de la instancia
     * Venta que debe ser creada. Recordar que no todos los clientes ni todas las motos, están disponibles
     * para registrar una venta en un momento determinado.
     * El método debe setear los variables instancias de venta que corresponda y retornar el importe final de la venta. */
    public function registrarVenta($colCodigosMoto, $objCliente){
        $importeFinal=0;
        $colecVen = $this->getColeccionVentasRealizadas();
        $colecMoto = [];
        $numV = 1;
        $fech = "23-05-24";
        $precF = 0;
        if (is_array($colCodigosMoto)){
            // Verificar si el cliente está habilitado para realizar la compra
            if ($objCliente->getEstado() == true) {
                foreach ($colCodigosMoto as $codigo) {
                    $encon = $this->retornarMoto($codigo);
                    $venta = new Venta($numV, $fech, $objCliente, $colecMoto, $precF);
                    if ($encon != false) {
                        if($venta->incorporarMoto($encon)){
                            $numV ++;
                            $colecVen[count($colecVen)]=$venta;
                            $importeFinal += $venta->getPrecioFinal();
                        }
                    }
                }
            }
        }else{
            if ($objCliente->getEstado() == true) {
                    $encon = $this->retornarMoto($colCodigosMoto);
                    $venta = new Venta($numV, $fech, $objCliente, $colecMoto, $precF);
                    if ($encon != false) {
                        if($venta->incorporarMoto($encon)){
                            $colecVen[count($colecVen)]=$venta;
                            $importeFinal += $venta->getPrecioFinal();
                        }
                    }
            }
        }
        $this->setColeccionVentasRealizadas($colecVen);
        return $importeFinal;
    }
    /**7. Implementar el método retornarVentasXCliente($tipo,$numDoc) que recibe por parámetro el tipo y
     * número de documento de un Cliente y retorna una colección con las ventas realizadas al cliente.*/
    public function retornarVentasXCliente($tipo,$numDoc){
        $colcVenCln=[];
        $ventReal=$this->getColeccionVentasRealizadas();
        foreach($ventReal as $venta){
            $cliente=$venta->getReferenciaCliente();
            if($cliente->getTipo()==$tipo&&$cliente->getNumeroDocumento()==$numDoc){
                $colcVenCln[count($colcVenCln)]=$venta;
            }
        }
        return $colcVenCln;
    }
}