<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Seguimiento extends CI_Model
{

    function __construct()
    {

        parent::__construct();
        $this->load->database();
    }

    public function listar($id, $fecha, $parroquia, $eje, $moneda, $dia, $origen, $desde = 0, $hasta = 0)
    {



        if ($dia == 15 || $dia == 30 || $dia == "rango") {
            $this->db->select("productos.descripcion as producto,seguimiento.fecha,parroquia, productos.id as id,    AVG(precio) as promedio, AVG(tasa) as tasa,	to_char(fecha, 'DD-MM-YY') as fechad,parroquia_id");
        } else {
            $this->db->select("productos.descripcion as producto, productos.id as id, parroquia,   AVG(precio) as promedio, AVG(tasa) as tasa,	to_char(fecha, 'Day') as fechad");
        }
        $this->db->from('seguimiento');
        $this->db->join('productos', 'producto_id=productos.id', 'inner');

        $this->db->join('parroquias', 'id_parroquia=parroquia_id', 'inner');

        $this->db->where('seguimiento.id_origen >=', $origen);

        if ($fecha == "rango") {
            $this->db->where('seguimiento.fecha >=', $desde . " 00:00:00");
            $this->db->where('seguimiento.fecha <=', $hasta . " 23:59:00");
        } else {
            $this->db->where('seguimiento.fecha >=', $fecha . " 00:00:00");
        }

        //$this->db->where('seguimiento.fecha <=',$fecha_actual);


        $this->db->where('seguimiento.producto_id', $id);

        if ($parroquia != "todos" && $parroquia != "promediado") {
            $this->db->where('seguimiento.parroquia_id', $parroquia);
        }

        if ($eje != "todos") {
            $this->db->where('seguimiento.circuito_id', $eje);
        }
        $this->db->order_by('seguimiento.fecha', 'ASC');

        $this->db->group_by("producto,productos.id, parroquia_id,fechad,seguimiento.fecha,  parroquia", 'inner');


        $query = $this->db->get();
        $semana = [
            "Monday" => "Lunes",
            "Tuesday" => "Martes",
            "Wednesday" => "Miercoles",
            "Thursday" => "Jueves",
            "Friday" => "Viernes",
            "Saturday" => "Sabado",
            "Sunday" => "Domingo"
        ];
        $data = $query->result();
        $resultado = array();

        foreach ($data as $key => $value) {


            if ($moneda == "bs") {
                $resultado["data"][] = $value->promedio;
            } else {
                $resultado["data"][] = number_format($value->promedio / $value->tasa, 2, ",", ".");
            }

            $resultado["usd"][] = number_format($value->promedio / $value->tasa, 2, ",", ".");

            if ($dia == 15 || $dia == 30 || $dia == "rango") {
                $resultado["label"][] = $value->fechad;
            } else {
                $resultado["label"][] = $semana[trim($value->fechad)];
            }

            //$resultado["producto"]=$value->producto ;
        }

        return  $resultado;
    }


    public function guardarEdicion($id, $precio)
    {

        $this->db->where('id', $id);
        $this->db->set('precio', $precio);
        return $this->db->update('seguimiento');
    }

    public function eliminarSeguimiento($id)
    {


        return $this->db->delete('seguimiento', array('id' => $id));
    }

    public function guardarProducto($producto)
    {

        $this->db->insert('productos', $producto);
    }


    public function guardarTasa($tasa)
    {

        $this->db->insert('tasa_cambio', $tasa);
    }


    public function getProductos($fecha, $parroquia, $eje, $origen, $fuente)
    {


        //$this->db->select("productos.descripcion as producto, productos.id as id,    AVG(precio) as promedio, AVG(tasa) as tasa,	to_char(fecha, 'Day') as fechad");
        $this->db->select("productos.descripcion as producto, productos.id as id");

        $this->db->from('seguimiento');
        $this->db->join('productos', 'producto_id=productos.id', 'inner');

        $fecha_actual = date("Y-m-d", strtotime(date("Y-m-d") . "+1 days"));
        $sietedias = date("Y-m-d", strtotime($fecha_actual . "- 7 days"));

        $this->db->where('seguimiento.id_fuente', $fuente);
        //$this->db->where('seguimiento.fecha <=',$fecha_actual);
        $this->db->where('seguimiento.fecha >=', $fecha . " 00:00:00");

        if ($parroquia != "todos") {
            $this->db->where('seguimiento.parroquia_id', $parroquia);
        }
        if ($eje != "todos") {
            $this->db->where('seguimiento.circuito_id', $eje);
        }


        $this->db->where('seguimiento.id_origen >=', $origen);

        $this->db->group_by("producto,productos.id");

        $query = $this->db->get();

        $data = $query->result();



        return  $data;
    }


    public function getProducto($producto){

        $this->db->select("*");

        $this->db->from('productos');
        $this->db->where('descripcion',$producto);
        $query = $this->db->get();
        
        $data= $query->result();


   
   return  $data;
    }
    public function getProductosID($fecha, $parroquia, $origen, $id, $fuente, $desde, $hasta)
    {


        //$this->db->select("productos.descripcion as producto, productos.id as id,    AVG(precio) as promedio, AVG(tasa) as tasa,	to_char(fecha, 'Day') as fechad");
        if ($parroquia == "promediado") {

            $this->db->select("productos.descripcion as producto, productos.id as id, AVG(precio) as promedio, AVG(tasa) as tasa");
        } else {

            $this->db->select("productos.descripcion as producto, parroquia_id,productos.id as id,parroquia, AVG(precio) as promedio, AVG(tasa) as tasa");
        }


        $this->db->from('seguimiento');
        $this->db->join('productos', 'producto_id=productos.id', 'inner');
        $this->db->join('parroquias', 'id_parroquia=parroquia_id', 'inner');

        $fecha_actual = date("Y-m-d", strtotime(date("Y-m-d") . "+1 days"));
        $sietedias = date("Y-m-d", strtotime($fecha_actual . "- 7 days"));

        //$this->db->where('seguimiento.fecha <=',$fecha_actual);
        $this->db->where('seguimiento.id_fuente >=', $fuente);
        if ($fecha == "rango") {
            $this->db->where('seguimiento.fecha >=', $desde . " 00:00:00");
            $this->db->where('seguimiento.fecha <=', $hasta . " 23:59:00");
        } else {
            $this->db->where('seguimiento.fecha >=', $fecha . " 00:00:00");
        }
        $this->db->where('producto_id', $id);

        if ($parroquia != "todos" && $parroquia != "promediado") {
            $this->db->where('seguimiento.parroquia_id', $parroquia);
        }


        $this->db->where('seguimiento.id_origen >=', $origen);
        if ($parroquia == "promediado") {
            $this->db->group_by("producto,productos.id");
        } else {
            $this->db->group_by("producto,productos.id,parroquia,parroquia_id");
        }

        $query = $this->db->get();

        $data = $query->result();



        return  $data;
    }




    public function getProductosPromedio($fecha, $parroquia, $eje, $id, $fuente)
    {


        $this->db->select("productos.descripcion as producto, productos.id as id,    AVG(precio) as promedio, AVG(tasa) as tasa");

        $this->db->from('seguimiento');
        $this->db->join('productos', 'producto_id=productos.id', 'inner');
        $this->db->join('parroquias', 'id_parroquia=parroquia_id', 'inner');
        $fecha_actual = date("Y-m-d", strtotime(date("Y-m-d") . "+1 days"));
        $sietedias = date("Y-m-d", strtotime($fecha_actual . "- 7 days"));

        //$this->db->where('seguimiento.fecha <=',$fecha_actual);


        $this->db->where('seguimiento.fecha >=', $fecha . " 00:00:00");
        $this->db->where('productos.id', $id);
        $this->db->where('seguimiento.id_fuente', $fuente);
        if ($parroquia != "todos") {
            $this->db->where('seguimiento.parroquia_id', $parroquia);
        }
        if ($eje != "todos") {
            $this->db->where('seguimiento.circuito_id', $eje);
        }

        $this->db->group_by("producto,productos.id");

        $query = $this->db->get();

        $data = $query->result();



        return  $data;
    }



    public function getProductosPromedioALL($fecha)
    {


        $this->db->select("productos.descripcion as producto, productos.id as id,    AVG(precio) as promedio, AVG(tasa) as tasa");

        $this->db->from('seguimiento');
        $this->db->join('productos', 'producto_id=productos.id', 'inner');
        $this->db->join('parroquias', 'id_parroquia=parroquia_id', 'inner');

        $fechaA = date("Y-m-d", strtotime($fecha . "- 1 days"));

        //$this->db->where('seguimiento.fecha <=',$fecha_actual);


        $this->db->where('seguimiento.fecha >=', $fecha . " 00:00:00");


        $this->db->group_by("producto,productos.id");

        $query = $this->db->get();

        $data = $query->result();

        $resultado = array();
        foreach ($data as $key => $value) {

            $subio = false;
            $anterior = 0;
            $tasa = 0;
            $productos = $this->getProductoSeguimiento($fechaA, $value->id);
            if (!empty($productos)) {
                $anterior = $productos[0]->promedio;
                if ($value->promedio > $productos[0]->promedio) {
                    $subio = true;
                }

                $tasa = number_format(($value->promedio - $anterior) * (100 / $anterior), 2, ",", ".");
            }

            $resultado[] = array(
                "producto" => $value->producto,
                "promedio" => number_format($value->promedio , 2, ",", "."),
                "variacion" => $tasa,
                "tasa" => number_format($value->promedio / $value->tasa, 2, ",", "."),
                "subio" => $subio
            );



            # code...
        }


        return  $resultado;
    }


    public function getProductoSeguimiento($fecha, $id)
    {


        $this->db->select("productos.descripcion as producto, productos.id as id,    AVG(precio) as promedio, AVG(tasa) as tasa");

        $this->db->from('seguimiento');
        $this->db->join('productos', 'producto_id=productos.id', 'inner');
        $this->db->join('parroquias', 'id_parroquia=parroquia_id', 'inner');
        $fecha_actual = date("Y-m-d", strtotime(date("Y-m-d") . "+1 days"));
        $sietedias = date("Y-m-d", strtotime($fecha_actual . "- 7 days"));

        //$this->db->where('seguimiento.fecha <=',$fecha_actual);



        $this->db->where('seguimiento.fecha <=', $fecha . " 23:59:00");
        $this->db->where('seguimiento.fecha >=', $fecha . " 00:00:00");
        $this->db->where('producto_id', $id);
        $this->db->limit(1);
        $this->db->group_by("producto,productos.id");

        $query = $this->db->get();

        $data = $query->result();




        return  $data;
    }


    public function listarXparoquia($id)
    {

        $this->db->select("productos.descripcion as producto, productos.id as id,    precio as promedio, tasa as tasa,	to_char(fecha, 'Day') as fecha");
        $this->db->from('productos');
        $this->db->join('seguimiento', 'producto_id=productos.id', 'inner');
        $this->db->where('productos.id', $id);


        /* $this->db->select("productos.descripcion as producto, productos.id as id,    AVG(precio) as promedio, AVG(tasa) as tasa,	to_char(fecha, 'Day') as fecha");
            $this->db->from('productos');
            $this->db->join('seguimiento','producto_id=productos.id','inner');
            $this->db->where('productos.id',$id);*/

        //$this->db->group_by("producto,productos.id, fecha");
        $query = $this->db->get();
        $semana = [
            "Monday" => "Lunes",
            "Tuesday" => "Martes",
            " Wednesday" => "Miercoles",
            "Thursday" => "Jueves",
            "Friday" => "Viernes",
            " Saturday" => "Sabado",
            "Sunday" => "Domingo"
        ];
        $data = $query->result();
        $resultado = array();
        foreach ($data as $key => $value) {


            $resultado["label"][] = $semana[trim($value->fecha)];
            $resultado["data"][] = number_format($value->promedio);
            $resultado["producto"] = $value->producto;
            $resultado["usd"][] = number_format($value->promedio / $value->tasa, 2, ",", ".");
        }

        return  $resultado;
    }


    public function getEje($id)
    {
        $this->db->select("*");
        $this->db->from('circuitos');
        $this->db->where('parroquia_id', $id);
        $query = $this->db->get();
        $data = $query->result();

        return $data;
    }


    public function productosall()
    {
        $this->db->select("*");
        $this->db->from('productos');

        $query = $this->db->get();
        $data = $query->result();

        return $data;
    }

    public function getUser($usuario, $clave)
    {
        $this->db->select("*");
        $this->db->from('users');
        $this->db->where('usuario', $usuario);
        $this->db->where('clave', $clave);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = $query->result();
        } else {

            $data = array();
        }

        return $data;
    }
    public function productos()
    {
        $this->db->select("productos.descripcion as producto, productos.id as id,    AVG(precio) as promedio, AVG(tasa) as tasa");
        $this->db->from('productos');
        $this->db->join('seguimiento', 'producto_id=productos.id', 'inner');
        $this->db->group_by("producto,productos.id");
        $query = $this->db->get();
        $data = $query->result();
        $resultado = array();
        foreach ($data as $key => $value) {

            $resultado[] = array(
                "producto" => $value->producto,
                "id" => $value->id,
                "usd" => number_format($value->promedio / $value->tasa, 2, ",", "."),
                "promedio" => number_format($value->promedio, 0, ",", ".")
            );
        }
        return $resultado;
    }


    public function parroquias($id)
    {
        $this->db->select("distinct(id_parroquia), id_municipio, parroquia");
        $this->db->from('parroquias');
        if ($id != 1) {
            $this->db->join('fuentes', 'parroquia_id=id_parroquia', 'inner');
            $this->db->where('fuentes.id', $id);
            $this->db->limit(1);
        }

        $this->db->where('id_municipio', 462);

        $query = $this->db->get();
        $data = $query->result();


        return $data;
    }

    public function tasa($fecha)
    {
        $this->db->select("*");
        $this->db->from('tasa_cambio');
        $this->db->limit(1);
        $this->db->where('fecha ', $fecha );

        $query = $this->db->get();
        $data = $query->result();


        return $data;
    }

    public function origen()
    {
        $this->db->select("*");
        $this->db->from('origen');



        $query = $this->db->get();
        $data = $query->result();


        return $data;
    }
    public function registrar($persona_id)
    {
        $datos = array(
            'personas_id' => $persona_id,
            'perfil_id' => 3
        );
        $this->date     = time();
        $this->db->insert('persona_perfil', $datos);
        return $this->db->insert_id();
    }

    public function obtener($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('personas');
        return $query->result();
    }


    public function registrarSeguimiento($data)
    {



        $this->db->insert('seguimiento', $data);

        //retorna el id
        return $this->db->insert_id();
    }

    public function tasaActual($desde, $hasta,$fuente)
    {

        $this->db->select("tasa, to_char(fecha, 'dd-mm-yy') as fecha, fecha AS fecha2");

        $this->db->where('fecha >=', $desde );
        $this->db->where('fecha  <=', $hasta );
        $this->db->where('fuente', $fuente );
        $this->db->order_by('fecha2', 'ASC');
        $this->db->from('tasa_cambio');
        $query = $this->db->get();
        $data = $query->result();

        $resultado = array();
        foreach ($data as $key => $value) {


            $resultado["label"][] = trim($value->fecha);
            $resultado["data"][] = (int) $value->tasa;
   
        }

        $resultado["datos"][] =$this->tasaActualLista($desde, $hasta);
        return  $resultado;
    }

    public function tasaActualLista($desde, $hasta)
    {

        $this->db->select("id, tasa, to_char(fecha, 'dd-mm-yy') as fecha, fecha AS fecha2, fuente");

        $this->db->where('fecha >=', $desde  );
        $this->db->where('fecha  <=', $hasta);
        $this->db->order_by('fecha2', 'DESC');
        $this->db->from('tasa_cambio');
        $query = $this->db->get();
        $data = $query->result();

       

        return  $data;
    }


    public function getTasa($fecha)
    {

        $this->db->select("tasa");

        $this->db->from('tasa_cambio');
        $this->db->limit(1);
        $this->db->where('fuente', 'BCV');
        $this->db->where('fecha',$fecha);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();

        $data = $query->result();


        return  $data;
    }

    public function allSeguimiento($desde, $hasta)
    {

        $this->db->select("distinct(seguimiento.id), precio,productos.descripcion as producto,origen.descripcion as origen,parroquias.parroquia,fuentes.nombre as fuente, to_char(seguimiento.fecha, 'DD-MM-YY') as fecha,usuario");



        $this->db->from('seguimiento');
        $this->db->join('productos', 'producto_id=productos.id', 'inner');
        $this->db->join('parroquias', 'id_parroquia=parroquia_id', 'inner');
        $this->db->join('origen', 'origen.id=id_origen', 'inner');
        $this->db->join('fuentes', 'id_fuente=fuentes.id', 'inner');
        $this->db->join('users', 'users.id=user_id', 'inner');
        $this->db->where('seguimiento.fecha >=', $desde . " 00:00:00");

        $this->db->where('seguimiento.fecha <=', $hasta . " 23:59:00");
        if($_SESSION["perfil"]=="transcriptor"){ 
            $this->db->where('seguimiento.user_id', $_SESSION["user_id"]);
        }
        
        $query = $this->db->get();
        $data = $query->result();
        $resultado=array();
        foreach ($data  as $key => $value) {
 
            $resultado[]=array(      "id"=> $value->id,
            "precio"=>  number_format($value->precio, 2, ",", "."),
            "producto"=> $value->producto,
            "origen"=>  $value->origen,
            "parroquia"=> $value->parroquia,
            "fuente"=> $value->fuente,
            "fecha"=>  $value->fecha,
            "usuario"=>$value->usuario);

        }


        return   $resultado;
    }

    public function findseguimiento($id)
    {

        $this->db->select("distinct(seguimiento.id), id_parroquia, producto_id, id_fuente,id_origen,precio,productos.descripcion as producto,origen.descripcion as origen,parroquias.parroquia,fuentes.nombre as fuente, to_char(seguimiento.fecha, 'DD-MM-YY') as fecha");



        $this->db->from('seguimiento');
        $this->db->join('productos', 'producto_id=productos.id', 'inner');
        $this->db->join('parroquias', 'id_parroquia=parroquia_id', 'inner');
        $this->db->join('origen', 'origen.id=id_origen', 'inner');
        $this->db->join('fuentes', 'id_fuente=fuentes.id', 'inner');
        $this->db->where('seguimiento.id', $id);

        $query = $this->db->get();
        $data = $query->result();



        return  $data;
    }
}
