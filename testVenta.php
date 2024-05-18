<?php
include_once "empresa.php";
include_once "cliente.php";
include_once "venta.php";
include_once "moto.php";


$objCliente1 = new Cliente("Juan","Castillo",true,"DNI",232425);
$objCliente2 = new Cliente("Maria","Salas",true,"DNI",353675);
$objMoto1= new MotoNacionales(11,2230000,2022,"Benelli Imperiale 400",85,true,"nacional",10);
$objMoto2= new MotoImportada(12,584000,2021,"Zanella Zr 150 Ohe",70,true,"importado","Francia",2347247);
$objMoto3= new MotoNacionales(13,999900,2023,"Zanella Patagonia Eagle 250",55,false,"nacional",2);
$num = 2;
$fech = 1;
$precFin = 2;
$colecionClientes=[$objCliente1,$objCliente2];
$coleccionMotos = [$objMoto1,$objMoto2,$objMoto3];
$objVenta = new Venta($num, $fech,$colecionClientes,$coleccionMotos,$precFin);
$ventaMotosNacionales = $objVenta->retornarTotalVentaNacional();
print_r($ventaMotosNacionales);