@extends('template')

@section('content')

<div class="content-page">
    <div class="row">
        <div class="col-12">
            <h1>Desarrollo de prueba t&eacute;cnica</h1>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <h2>Prueba te&oacute;rica de PHP</h2>
            <p>
                <ul style="list-style: decimal;">
                    <li>
                        La salida no es ninguna debido a que no se realiza la impresi&oacute;n de ninguna variable
                        declarada.
                        Sin embargo, al realizar la impresi&oacute;n de las variables, se puede determinar que la
                        variable $z es un “1”.
                        La variable $h, es un “1”, debido a que hace referencia a la primera variable.
                        La variable $h, se inicializa nuevamente, por lo tanto, su valor es de “21”, debido a que se le
                        concatena el valor de la variable en un estado anterior, el cual es “1”.
                    </li>
                    <li>
                        La salida se deriva en 4 partes, debido a las 4 impresiones que se realizan:
                        <ol>
                            <li>boolean(false), debido a que los números no son iguales y tienen el mismo tipo de dato.
                            </li>
                            <li>boolean(true), debido a que los números son de tipos diferentes, pero el valor numérico
                                es el mismo.</li>
                            <li>boolean(false), debido a que los tipos de datos son diferentes, y se está realizando una
                                comparaci&oacute;n l&oacute;gica tanto por valor, como por tipo de dato. Los datos no
                                coinciden.</li>
                            <li>boolean(false), debido a que los tipos de datos son diferentes, y se está realizando una
                                comparaci&oacute;n l&oacute;gica tanto por valor, como por tipo de dato. Los datos no
                                coinciden.</li>
                        </ol>
                    </li>
                    <li>
                        La salida no es ninguna debido a que no se realiza la impresi&oacute;n de ninguna variable.
                        Sin embargo, se tiene una cadena de 5 caracteres en la línea 2, y en la línea 3, al ser la
                        variable $text un string, se le define que en el carácter 10 se le defina la cadena “perez”,
                        pero a pesar de esto solo se define la letra p en esta posici&oacute;n de la cadena, debido a su
                        tipo de dato s&oacute;lo se puede tener un carácter en esa posici&oacute;n.
                    </li>
                    <li>
                        La salida sería un error, debido a que se está intentando realizar la suma de una cadena con un
                        valor numérico. Lo correcto sería utilizar el carácter “.” Para concatenar los datos, y la
                        salida sería “3j3mplo1”.
                    </li>
                </ul>
            </p>
        </div>
        <div class="line"></div>
        <div class="col-12">
            <h2>Prueba de l&oacute;gica de programaci&oacute;n</h2>
            <p>
                <ul style="list-style: decimal;">
                    <li>
                        Dado un numero n encontrar todos los múltiplos de 3 y 5 menores al número dado,
                        el método debe retornar la suma de los múltiplos encontrados. Ejemplo: si el numero
                        ingresado es 10, los múltiplos de 3 y 5 menores a 10 son: 3, 5, 6, 9, el resultado de
                        la función debe ser 23, debido a que es la suma de 3, 5, 6, 9.
<pre>
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
</pre>
                        <div class="row">
                            <div class="col-md-12">
                                {!! Form::open(["url" => 'test/metodo1']) !!}
                                    <input type="number" name="numero" min="0" value="{{isset($results["numero"]) ? $results["numero"] : ''}}" required>
                                    <input type="submit" value="Enviar">
                                {!! Form::close() !!}
                                <strong>Resultado: {{isset($results["metodo1"]) ? $results["metodo1"] : ''}}</strong>
                            </div>
                        </div>
                    </li>
                    <li>
                        Dado un string separado por espacios, guiones y guiones bajos. Se debe
                        implementar una función camel case que transforme la oración. Ejemplos
                        a. Dado “Bienvenido a_Treda-solutions” retornar “BienvenidoATredaSolutions”
                        b. Dado “bienvenido-a_Treda solutions” retornar “bienvenidoATredaSolutions”
<pre>
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
</pre>
                        <div class="row">
                            <div class="col-md-12">
                                {!! Form::open(["url" => 'test/metodo2']) !!}
                                    <input type="text" name="cadena" maxlength="255" value="{{isset($results["cadena2"]) ? $results["cadena2"] : ''}}" required>
                                    <input type="submit" value="Enviar">
                                {!! Form::close() !!}
                                <strong>Resultado: {{isset($results["metodo2"]) ? $results["metodo2"] : ''}}</strong>
                            </div>
                        </div>
                    </li>
                    <li>
                        Dada una frase, devolver la frase donde las palabras con mayor a 5 letras esten al
                        revés. Ejemplos
                        a. Dado “Bienvenido a Treda Solutions” retornar “odinevneiB a Treda snoituloS”
<pre>
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
</pre>
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::open(["url" => 'test/metodo3']) !!}
                                <input type="text" name="cadena" maxlength="255" value="{{isset($results["cadena3"]) ? $results["cadena3"] : ''}}" required>
                                <input type="submit" value="Enviar">
                            {!! Form::close() !!}
                            <strong>Resultado: {{isset($results["metodo3"]) ? $results["metodo3"] : ''}}</strong>
                        </div>
                    </div>
                    </li>
                </ul>
            </p>
        </div>
        <div class="line"></div>
        <div class="col-12">
            <h2>Prueba de SQL</h2>
            <h3>Reporte 1</h3>
            <p>
<pre>
    SELECT
    cliente.id AS cedula,
    CONCAT(primer_nombre, ' ', primer_apellido) AS nombre,
    dias_mora AS diasEnMora,
    IF(
        dias_mora >= 1
        and dias_mora <= 20,
        "Riesgo Bajo",
        IF(
            dias_mora >= 21
            and dias_mora <= 35,
            "Riesgo Medio",
            IF(dias_mora > 35, "Riesgo Alto", "")
        )
    ) AS riesgo,
    ciudad.Nombre AS ciudad
    FROM
        cliente
        INNER JOIN ciudad on ciudad.id = cliente.id_ciudad
    ORDER BY
        dias_mora ASC
</pre>
            </p>
            <h3>Reporte 2</h3>
            <p>
<pre>
    SELECT
    sucursal.Nombre AS sucursal,
    FORMAT (cotizacion.valorTotalPagado, 0) AS valorTotalPagado
    FROM
        sucursal
        INNER JOIN (
            SELECT
                SUM(cotizacion.valor_poliza_iva_incl) AS valorTotalPagado,
                id_sucursal
            FROM
                cotizacion
            GROUP BY
                id_sucursal
        ) AS cotizacion ON cotizacion.id_sucursal = sucursal.id
    ORDER BY
        cotizacion.valorTotalPagado ASC
</pre>
            </p>
            <h3>Reporte 3</h3>
            <p>
<pre>
    SELECT
    persona.CC,
    persona.Nombre,
    estudios.institucion,
    estudios.Fecha
    FROM
        persona
        INNER JOIN (
            SELECT
                MAX(Fecha) as Fecha,
                estudios.FKPersona,
                estudios.Institucion
            FROM
                estudios
            GROUP BY
                (FKPersona)
        ) estudios ON estudios.Fecha = estudios.Fecha
        AND estudios.FKPersona = persona.cc
</pre>
            </p>
            <h3>Reporte 4</h3>
            <p>
<pre>
    SELECT
    empleado.cc AS CC,
    empleado.nombre,
    empleado.cargo,
    empleado.area,
    jefe.nombre AS NombreJefe
    FROM
        empleados empleado
        INNER JOIN empleados jefe ON empleado.id_jefe = jefe.cc
</pre>
            </p>
        </div>
    </div>
</div>


@endsection