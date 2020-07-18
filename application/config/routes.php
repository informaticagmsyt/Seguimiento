<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'DashboardController/dashboard';
$route['get'] = 'SeguimientoController';
$route['graficas'] = 'DashboardController';
$route['getproductos'] = 'SeguimientoController/getProductos';
$route['productos'] = 'SeguimientoController/productos';
$route['productosall'] = 'SeguimientoController/productosall';
$route['productospromedio'] = 'SeguimientoController/productosPromedio';
$route['parroquias'] = 'SeguimientoController/parroquias';
$route['registrar'] = 'SeguimientoController/registrar';
$route['tasa'] = 'SeguimientoController/tasa';
$route['origen'] = 'SeguimientoController/origen';
$route['guardarProducto'] = 'SeguimientoController/guardarProducto';
$route['guardarTasa'] = 'SeguimientoController/guardarTasa';
$route['eje'] = 'SeguimientoController/getEje';
$route['tasaactual'] = 'SeguimientoController/tasaActual';

$route['listaseguimiento'] = 'DashboardController/listaSeguimiento';
$route['listaseguimiento/all'] = 'DashboardController/listaSeguimientoall';
$route['findseguimiento'] = 'DashboardController/findseguimiento';
$route['guardarEdicion'] = 'DashboardController/guardarEdicion';
$route['guardarEdicionUsuario'] = 'Login/guardarEdicionUsuario';


$route['eliminarSeguimiento'] = 'DashboardController/eliminarSeguimiento';


$route['construccion'] = 'DashboardController/lista';
$route['login'] = 'Login';
$route['verificar'] = 'Login/verificar';
$route['tipocambio'] = 'TipoCambioController';
$route['addUser'] = 'Login/addUser';


$route['fuentesall'] = 'FuentesController/all';
$route['registrarUsuario'] = 'Login/registrarUsuario';
$route['editarProducto'] = 'FuentesController/editarProducto';
$route['editarTasa'] = 'FuentesController/editarTasa';
$route['eliminarTasa'] = 'FuentesController/eliminarTasa';


$route['listaproductos'] = 'FuentesController/listaproductos';

$route['fuentes'] = 'FuentesController';
$route['fuentes/registrar'] = 'FuentesController/registrar';
$route['registrarFuente'] = 'FuentesController/add';
$route['getFuentes'] = 'FuentesController/get';



$route['logout'] = 'SeguimientoController/logout';
$route['registrarSeguimiento'] = 'SeguimientoController/registrarSeguimiento';



$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
