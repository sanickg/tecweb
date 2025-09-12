<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Práctica 5</title>
</head>
<body>
    <h2>Ejercicio 1</h2>
    <p>Determina cuál de las siguientes variables son válidas y explica por qué:</p>
    <p>$_myvar,  $_7var,  myvar,  $myvar,  $var7,  $_element1, $house*5</p>
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
        echo '$a = ' . $a . '<br>';
        echo '$b = ' . $b . '<br>';
        echo '$c = ' . $c . '<br>';
        
        // Segundo bloque de asignaciones
        $a = "PHP server";
        $b = &$a;
        
        echo '<h4>c. Contenido de cada variable (segundo bloque):</h4>';
        echo '$a = ' . $a . '<br>';
        echo '$b = ' . $b . '<br>';
        echo '$c = ' . $c . '<br>';
        
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
        echo '1. $a = "PHP5" → $a = ' . $a . ' (tipo: ' . gettype($a) . ')<br>';
        
        $z[] = &$a;
        echo '2. $z[] = &$a → ';
        print_r($z);
        echo ' (tipo de $z: ' . gettype($z) . ')<br>';
        
        $b = "5a version de PHP";
        echo '3. $b = "5a version de PHP" → $b = ' . $b . ' (tipo: ' . gettype($b) . ')<br>';
        
        $c = $b * 10;
        echo '4. $c = $b * 10 → $c = ' . $c . ' (tipo: ' . gettype($c) . ')<br>';
        
        $a .= $b;
        echo '5. $a .= $b → $a = ' . $a . ' (tipo: ' . gettype($a) . ')<br>';
        echo '   $z[0] también cambió porque está referenciado: ' . $z[0] . '<br>';
        
        $b *= $c;
        echo '6. $b *= $c → $b = ' . $b . ' (tipo: ' . gettype($b) . ')<br>';
        
        $z[0] = "MySQL";
        echo '7. $z[0] = "MySQL" → $z[0] = ' . $z[0] . ', $a = ' . $a . '<br>';
        echo '   $a cambió porque $z[0] está referenciado a $a<br>';
        
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
            echo '$a = ' . $a . '<br>';
            echo '$b = ' . $b . '<br>';
            echo '$c = ' . $c . '<br>';
            echo '$z[0] = ' . $z[0] . '<br>';
        }
        
        function mostrarVariablesGLOBALS() {
            echo '<h4>Usando matriz $GLOBALS:</h4>';
            echo '$a = ' . $GLOBALS['a'] . '<br>';
            echo '$b = ' . $GLOBALS['b'] . '<br>';
            echo '$c = ' . $GLOBALS['c'] . '<br>';
            echo '$z[0] = ' . $GLOBALS['z'][0] . '<br>';
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
        echo '$a = ' . $a . ' (tipo: ' . gettype($a) . ')<br>';
        echo '$b = ' . $b . ' (tipo: ' . gettype($b) . ')<br>';
        echo '$c = ' . $c . ' (tipo: ' . gettype($c) . ')<br>';
        
        echo '<h4>Explicación:</h4>';
        echo '<p>$a inicialmente era "7 personas", $b toma el valor entero 7.<br>';
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
        echo '$a = "0": ';
        var_dump((bool)$a);
        echo '<br>$b = "TRUE": ';
        var_dump((bool)$b);
        echo '<br>$c = FALSE: ';
        var_dump($c);
        echo '<br>$d = ($a OR $b): ';
        var_dump($d);
        echo '<br>$e = ($a AND $c): ';
        var_dump($e);
        echo '<br>$f = ($a XOR $b): ';
        var_dump($f);
        
        echo '<h4>Función para mostrar booleanos con echo:</h4>';
        echo '<p>La función var_export() permite mostrar booleanos de forma legible:</p>';
        echo '$c como string: ' . var_export($c, true) . '<br>';
        echo '$e como string: ' . var_export($e, true) . '<br>';
        
        // Investigación de la función que transforma
        function boolToString($bool) {
            return $bool ? 'TRUE' : 'FALSE';
        }
        
        echo '<p>Usando función personalizada:</p>';
        echo '$c = ' . boolToString($c) . '<br>';
        echo '$e = ' . boolToString($e) . '<br>';
        
        // Liberar variables del ejercicio 6
        unset($a, $b, $c, $d, $e, $f);
    ?>

</body>
</html>