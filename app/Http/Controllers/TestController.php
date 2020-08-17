<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{

    public function __construct()
    {
    }

    /**
     * formulario Prueba logica 1
     * @return float
     **/
    public function getMetodo1(Request $request)
    {
        $datos = $request->only('numero');
        $resultado = $this->metodo1($datos["numero"]);

        return $this->index(["metodo1" => $resultado,"numero" => $datos["numero"]]);
    }

    /**
     * formulario Prueba logica 3
     * @return float
     **/
    public function getMetodo2(Request $request)
    {
        $datos = $request->only('cadena');
        $resultado = $this->metodo2($datos["cadena"]);

        return $this->index(["metodo2" => $resultado,"cadena2" => $datos["cadena"]]);
    }
    
    /**
     * formulario Prueba logica 3
     * @return float
     **/
    public function getMetodo3(Request $request)
    {
        $datos = $request->only('cadena');
        $resultado = $this->metodo3($datos["cadena"]);

        return $this->index(["metodo3" => $resultado,"cadena3" => $datos["cadena"]]);
    }

    /**
     * Prueba logica 1
     * @return float
     **/
    public function metodo1($numero)
    {
        $multiplos = [];
        for ($i = ($numero - 1); $i > 0; $i--) {
            if ($i % 3 == 0 || $i % 5 == 0) {
                $multiplos[$i] = $i;
            }
        }

        return array_sum($multiplos);
    }

    /**
     * Prueba logica 2
     * @return float
     **/
    public function metodo2($cadena)
    {
        $array = explode(" ", $cadena);
        $nuevo = [];
        foreach ($array as $value) {
            if (strpos($value, "-") > -1) {
                $array1 = explode("-", $value);
                foreach ($array1 as $value1){
                    if (strpos($value1, "_") > -1) {
                        $array2 = explode("_", $value1);
                        foreach ($array2 as $value2){
                            $nuevo[] = ucfirst($value2);
                        }
                    }else{
                        $nuevo[] = ucfirst($value1);
                    }
                }
            }else{
                $nuevo[] = ucfirst($value);
            }
        }
        return implode("", $nuevo);
    }

    /**
     * Prueba logica 3
     * @return float
     **/
    public function metodo3($cadena)
    {
        $array = explode(" ", $cadena);
        $nuevoArray = [];
        foreach ($array as $key => $value) {
            if (strlen($value) > 5) {
                $nuevoArray[] = strrev($value);
            }else{
                $nuevoArray[] = $value;
            }
        }
        return implode(" ",$nuevoArray);
    }

    /**
     * Devuelve la vista inicial
     * @return object
     **/
    public function index($results = [])
    {
        $this->metodo2("Bienvenido a_Treda-solutions");
        return view('test.index', compact("results"));
    }
}
