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
</body>
</html>