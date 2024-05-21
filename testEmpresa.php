<?php
include_once "empresa.php";
include_once "cliente.php";
include_once "venta.php";
include_once "moto.php";
$objCliente1 = new Cliente("Juan","Castillo",true,"DNI",232425);
$objCliente2 = new Cliente("Maria","Salas",true,"DNI",353675);
$objMoto1= new MotoNacionales(11,2230000,2022,"Benelli Imperiale 400",85,true,"nacional",10);
$objMoto2= new MotoNacionales(12,584000,2021,"Zanella Zr 150 Ohe",70,true,"nacional",10);
$objMoto3= new MotoNacionales(13,999900,2023,"Zanella Patagonia Eagle 250",55,false,"nacional",15);
$objMoto4= new MotoImportada(14,12499900,2020,"Pitbike Enduro Motocross Apollo Aii 190cc Plr",100,true,"Importada","Francia",6244400);
$ventasRealizadas = [];
$coleccionClientes = [$objCliente1,$objCliente2];
$coleccionMotos = [$objMoto1,$objMoto2,$objMoto3,$objMoto4];
$objEmpresa = new Empresa("Alta Gama","AV. Argentina 123",$coleccionClientes,$coleccionMotos,$ventasRealizadas);
$colCodigosMoto = [11,12,13,14];
$res=$objEmpresa->registrarVenta($colCodigosMoto,$objCliente2);

if ($res>0){
    echo "las ventas fueron realizadas, precio final:".$res."\n";
}else{
    echo "las ventas no fueron realizadas, porque ya la moto fue comprada o el cliente esta dado de baja\n";
}
$colCodigosMoto = [13,14];
$res=$objEmpresa->registrarVenta($colCodigosMoto,$objCliente2);
if ($res>0){
    echo "las ventas fueron realizadasprecio final:".$res."\n";
}else{
    echo "las ventas no fueron realizadas, porque ya la moto fue comprada o el cliente esta dado de baja\n";
}
$colCodigosMoto = [14,2];
$res=$objEmpresa->registrarVenta($colCodigosMoto,$objCliente2);
if ($res>0){
    echo "las ventas fueron realizadasprecio final:".$res."\n";
}else{
    echo "las ventas no fueron realizadas, porque ya la moto fue comprada o el cliente esta dado de baja\n";
}
if(count($objEmpresa->retornarMotosImportadas())>0){
    echo "Hay ventas con 1 o mas motos importadas\n";
}else{
    echo "no hay ventas con motos importadas\n";
}
if($objEmpresa->informarSumaVentasNacionales()>0){
    echo "La suma de todas las motos nacionales vendidas es de :".$objEmpresa->informarSumaVentasNacionales()."\n";
}else{
    echo "no se vendio ninguna moto nacional\n";
}
echo $objEmpresa;