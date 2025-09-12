<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Práctica 5</title>
</head>
<body>
    <h2>Ejercicio 1</h2>
    <p>Determina cuál de las siguientes variables son válidas y explica por qué:</p>
    <p>$_myvar, $_7var, myvar, $myvar, $var7, $_element1, $house*5</p>
    <?php
        //AQUI VA MI CÓDIGO PHP
        $_myvar;
        $_7var;
        //myvar;       // Inválida
        $myvar;
        $var7;
        $_element1;
        //$house*5;     // Invalida
        
        echo '<h4>Respuesta:</h4>';   
    
        echo '<ul>';
        echo '<li>$_myvar es válida porque inicia con guión bajo.</li>';
        echo '<li>$_7var es válida porque inicia con guión bajo.</li>';
        echo '<li>myvar es inválida porque no tiene el signo de dolar ($).</li>';
        echo '<li>$myvar es válida porque inicia con una letra.</li>';
        echo '<li>$var7 es válida porque inicia con una letra.</li>';
        echo '<li>$_element1 es válida porque inicia con guión bajo.</li>';
        echo '<li>$house*5 es inválida porque el símbolo * no está permitido.</li>';
        echo '</ul>';
        
        // Liberar variables del ejercicio 1
        unset($_myvar, $_7var, $myvar, $var7, $_element1);
    ?>

    <h2>Ejercicio 2</h2>
    <p>Proporcionar los valores de $a, $b, $c como sigue:</p>
    <?php
        // Primer bloque de asignaciones
        $a = "ManejadorSQL";
        $b = 'MySQL';
        $c = &$a;
        
        echo '<h4>a. Contenido de cada variable (primer bloque):</h4>';
        echo '<p>$a = ' . $a . '</p>';
        echo '<p>$b = ' . $b . '</p>';
        echo '<p>$c = ' . $c . '</p>';
        
        // Segundo bloque de asignaciones
        $a = "PHP server";
        $b = &$a;
        
        echo '<h4>c. Contenido de cada variable (segundo bloque):</h4>';
        echo '<p>$a = ' . $a . '</p>';
        echo '<p>$b = ' . $b . '</p>';
        echo '<p>$c = ' . $c . '</p>';
        
        echo '<h4>d. Explicación de lo que ocurrió:</h4>';
        echo '<p>En el primer bloque, $c se asignó por referencia a $a, por lo que ambas apuntan a la misma ubicación en memoria. ';
        echo 'En el segundo bloque, cuando $a cambió a "PHP server", $c también cambió porque están referenciadas. ';
        echo '$b también se asignó por referencia a $a, por lo que las tres variables ($a, $b, $c) ahora contienen "PHP server".</p>';
        
        // Liberar variables del ejercicio 2
        unset($a, $b, $c);
    ?>

    <h2>Ejercicio 3</h2>
    <p>Mostrar el contenido y tipo de cada variable después de cada asignación:</p>
    <?php
        echo '<h4>Evolución de las variables:</h4>';
        
        $a = "PHP5";
        echo '<p>1. $a = "PHP5" → $a = ' . $a . ' (tipo: ' . gettype($a) . ')</p>';
        
        $z[] = &$a;
        echo '<p>2. $z[] = &$a → ';
        print_r($z);
        echo ' (tipo de $z: ' . gettype($z) . ')</p>';
        
        $b = "5a version de PHP";
        echo '<p>3. $b = "5a version de PHP" → $b = ' . $b . ' (tipo: ' . gettype($b) . ')</p>';
        
        $c = $b * 10;
        echo '<p>4. $c = $b * 10 → $c = ' . $c . ' (tipo: ' . gettype($c) . ')</p>';
        
        $a .= $b;
        echo '<p>5. $a .= $b → $a = ' . $a . ' (tipo: ' . gettype($a) . ')</p>';
        echo '<p>   $z[0] también cambió porque está referenciado: ' . $z[0] . '</p>';
        
        $b *= $c;
        echo '<p>6. $b *= $c → $b = ' . $b . ' (tipo: ' . gettype($b) . ')</p>';
        
        $z[0] = "MySQL";
        echo '<p>7. $z[0] = "MySQL" → $z[0] = ' . $z[0] . ', $a = ' . $a . '</p>';
        echo '<p>   $a cambió porque $z[0] está referenciado a $a</p>';
        
        // Liberar variables del ejercicio 3
        unset($a, $b, $c, $z);
    ?>

    <h2>Ejercicio 4</h2>
    <p>Leer y mostrar los valores del ejercicio anterior usando $GLOBALS:</p>
    <?php
        // variables del ejercicio anterior
        $a = "PHP5";
        $z[] = &$a;
        $b = "5a version de PHP";
        $c = $b * 10;
        $a .= $b;
        $b *= $c;
        $z[0] = "MySQL";
        
        // Hice tanto global como globals
        function mostrarVariablesGlobales() {
            global $a, $b, $c, $z;
            echo '<h4>Usando modificador global:</h4>';
            echo '<p>$a = ' . $a . '</p>';
            echo '<p>$b = ' . $b . '</p>';
            echo '<p>$c = ' . $c . '</p>';
            echo '<p>$z[0] = ' . $z[0] . '</p>';
        }
        
        function mostrarVariablesGLOBALS() {
            echo '<h4>Usando matriz $GLOBALS:</h4>';
            echo '<p>$a = ' . $GLOBALS['a'] . '</p>';
            echo '<p>$b = ' . $GLOBALS['b'] . '</p>';
            echo '<p>$c = ' . $GLOBALS['c'] . '</p>';
            echo '<p>$z[0] = ' . $GLOBALS['z'][0] . '</p>';
        }
        
        mostrarVariablesGlobales();
        mostrarVariablesGLOBALS();
        
        // Liberar variables del ejercicio 4
        unset($a, $b, $c, $z);
    ?>

    <h2>Ejercicio 5</h2>
    <p>Dar el valor de las variables $a, $b, $c al final del siguiente script:</p>
    <?php
        $a = "7 personas";
        $b = (integer) $a;
        $a = "9E3";
        $c = (double) $a;
        
        echo '<h4>Valores finales:</h4>';
        echo '<p>$a = ' . $a . ' (tipo: ' . gettype($a) . ')</p>';
        echo '<p>$b = ' . $b . ' (tipo: ' . gettype($b) . ')</p>';
        echo '<p>$c = ' . $c . ' (tipo: ' . gettype($c) . ')</p>';
        
        echo '<h4>Explicación:</h4>';
        echo '<p>$a inicialmente era "7 personas", $b toma el valor entero 7.<br/>';
        echo '$a luego cambia a "9E3" (notación científica), $c toma el valor 9000.0</p>';
        
        // Liberar variables del ejercicio 5
        unset($a, $b, $c);
    ?>

    <h2>Ejercicio 6</h2>
    <p>Dar y comprobar el valor booleano de las variables:</p>
    <?php
        $a = "0";
        $b = "TRUE";
        $c = FALSE;
        $d = ($a OR $b);
        $e = ($a AND $c);
        $f = ($a XOR $b);
        
        echo '<h4>Valores booleanos con var_dump:</h4>';
        echo '<p>$a = "0": ';
        var_dump((bool)$a);
        echo '</p>';
        echo '<p>$b = "TRUE": ';
        var_dump((bool)$b);
        echo '</p>';
        echo '<p>$c = FALSE: ';
        var_dump($c);
        echo '</p>';
        echo '<p>$d = ($a OR $b): ';
        var_dump($d);
        echo '</p>';
        echo '<p>$e = ($a AND $c): ';
        var_dump($e);
        echo '</p>';
        echo '<p>$f = ($a XOR $b): ';
        var_dump($f);
        echo '</p>';
        
        echo '<h4>Función para mostrar booleanos con echo:</h4>';
        echo '<p>La función var_export() permite mostrar booleanos de forma legible:</p>';
        echo '<p>$c como string: ' . var_export($c, true) . '</p>';
        echo '<p>$e como string: ' . var_export($e, true) . '</p>';
        
        // Investigación de la función que transforma
        function boolToString($bool) {
            return $bool ? 'TRUE' : 'FALSE';
        }
        
        echo '<p>Usando función personalizada:</p>';
        echo '<p>$c = ' . boolToString($c) . '</p>';
        echo '<p>$e = ' . boolToString($e) . '</p>';
        
        // Liberar variables del ejercicio 6
        unset($a, $b, $c, $d, $e, $f);
    ?>

    <h2>Ejercicio 7</h2>
    <p>Usando la variable predefinida $_SERVER:</p>
    <?php
        echo '<h4>Información del servidor:</h4>';
        
        // a. La versión de Apache y PHP
        echo '<p><strong>a. Versión de Apache y PHP:</strong></p>';
        if (isset($_SERVER['SERVER_SOFTWARE'])) {
            echo '<p>Servidor: ' . $_SERVER['SERVER_SOFTWARE'] . '</p>';
        }
        echo '<p>Versión de PHP: ' . phpversion() . '</p>';
        
        // b. El nombre del sistema operativo (servidor)
        echo '<p><strong>b. Sistema operativo del servidor:</strong></p>';
        echo '<p>SO: ' . php_uname() . '</p>';
        
        // c. El idioma del navegador (cliente)
        echo '<p><strong>c. Idioma del navegador:</strong></p>';
        if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
            echo '<p>Idiomas aceptados: ' . $_SERVER['HTTP_ACCEPT_LANGUAGE'] . '</p>';
        } else {
            echo '<p>No disponible</p>';
        }
        
        echo '<h4>Información adicional de $_SERVER:</h4>';
        echo '<ul>';
        echo '<li>Nombre del servidor: ' . (isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : 'No disponible') . '</li>';
        echo '<li>Método de petición: ' . (isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'No disponible') . '</li>';
        echo '<li>URI solicitada: ' . (isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : 'No disponible') . '</li>';
        echo '<li>User Agent: ' . (isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'No disponible') . '</li>';
        echo '</ul>';
    ?>

</body>
</html>