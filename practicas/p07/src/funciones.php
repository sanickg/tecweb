<?php
// Ejercicio 1: verificar si un número es múltiplo de 5 y 7
function esMultiplo5y7($numero) {
    return ($numero % 5 == 0 && $numero % 7 == 0);
}

// Ejercicio 2: números hasta obtener secuencia impar, par, impar
function generarSecuenciaImparParImpar() {
    $matriz = array();
    $iteraciones = 0;
    $totalNumeros = 0;
    
    do {
        $num1 = rand(100, 999);
        $num2 = rand(100, 999);
        $num3 = rand(100, 999);
        
        $iteraciones++;
        $totalNumeros += 3;
        
        if ($num1 % 2 != 0 && $num2 % 2 == 0 && $num3 % 2 != 0) {
            $matriz[] = array($num1, $num2, $num3);
            break;
        }
        
        $matriz[] = array($num1, $num2, $num3);
        
    } while (true);
    
    return array(
        'matriz' => $matriz,
        'iteraciones' => $iteraciones,
        'totalNumeros' => $totalNumeros
    );
}

// Ejercicio 3: Encontrar primer número aleatorio múltiplo de un número dado (while)
function encontrarMultiploWhile($numeroDado) {
    $numeroGenerado = 0;
    $intentos = 0;
    
    while (true) {
        $numeroGenerado = rand(1, 1000);
        $intentos++;
        
        if ($numeroGenerado % $numeroDado == 0) {
            break;
        }
    }
    
    return array(
        'numero' => $numeroGenerado,
        'intentos' => $intentos
    );
}

// Ejercicio 3 variante pero con do-while
function encontrarMultiploDoWhile($numeroDado) {
    $numeroGenerado = 0;
    $intentos = 0;
    
    do {
        $numeroGenerado = rand(1, 1000);
        $intentos++;
    } while ($numeroGenerado % $numeroDado != 0);
    
    return array(
        'numero' => $numeroGenerado,
        'intentos' => $intentos
    );
}

// Ejercicio 4: crear arreglo con códigos ASCII de 'a' a 'z'
function crearArregloAscii() {
    $arreglo = array();
    
    for ($i = 97; $i <= 122; $i++) {
        $arreglo[$i] = chr($i);
    }
    
    return $arreglo;
}

// Ejercicio 5: validar edad y sexo
function validarEdadSexo($edad, $sexo) {
    if ($sexo === 'femenino' && $edad >= 18 && $edad <= 35) {
        return 'Bienvenida, usted está en el rango de edad permitido.';
    } else {
        return 'Error: No cumple con los criterios requeridos.';
    }
}

// Ejercicio 6: parque vehicular
function crearParqueVehicular() {
    return array(
        'UBN6338' => array(
            'Auto' => array(
                'marca' => 'HONDA',
                'modelo' => 2020,
                'tipo' => 'camioneta'
            ),
            'Propietario' => array(
                'nombre' => 'Alfonzo Esparza',
                'ciudad' => 'Puebla, Pue.',
                'direccion' => 'C.U., Jardines de San Manuel'
            )
        ),
        'UBN6339' => array(
            'Auto' => array(
                'marca' => 'MAZDA',
                'modelo' => 2019,
                'tipo' => 'sedan'
            ),
            'Propietario' => array(
                'nombre' => 'Ma. del Consuelo Molina',
                'ciudad' => 'Puebla, Pue.',
                'direccion' => '97 oriente'
            )
        ),
        'ABC1234' => array(
            'Auto' => array(
                'marca' => 'TOYOTA',
                'modelo' => 2021,
                'tipo' => 'hatchback'
            ),
            'Propietario' => array(
                'nombre' => 'Carlos Mendoza',
                'ciudad' => 'Puebla, Pue.',
                'direccion' => 'Col. Centro'
            )
        ),
        'DEF5678' => array(
            'Auto' => array(
                'marca' => 'NISSAN',
                'modelo' => 2018,
                'tipo' => 'sedan'
            ),
            'Propietario' => array(
                'nombre' => 'Ana García',
                'ciudad' => 'Puebla, Pue.',
                'direccion' => 'Av. Juárez 123'
            )
        ),
        'GHI9012' => array(
            'Auto' => array(
                'marca' => 'CHEVROLET',
                'modelo' => 2022,
                'tipo' => 'camioneta'
            ),
            'Propietario' => array(
                'nombre' => 'Luis Hernández',
                'ciudad' => 'Puebla, Pue.',
                'direccion' => 'Col. La Paz'
            )
        ),
        'JKL3456' => array(
            'Auto' => array(
                'marca' => 'FORD',
                'modelo' => 2020,
                'tipo' => 'hatchback'
            ),
            'Propietario' => array(
                'nombre' => 'María López',
                'ciudad' => 'Puebla, Pue.',
                'direccion' => 'Blvd. 5 de Mayo'
            )
        ),
        'MNO7890' => array(
            'Auto' => array(
                'marca' => 'VOLKSWAGEN',
                'modelo' => 2017,
                'tipo' => 'sedan'
            ),
            'Propietario' => array(
                'nombre' => 'Pedro Martínez',
                'ciudad' => 'Puebla, Pue.',
                'direccion' => 'Col. Doctores'
            )
        ),
        'PQR1234' => array(
            'Auto' => array(
                'marca' => 'HYUNDAI',
                'modelo' => 2023,
                'tipo' => 'camioneta'
            ),
            'Propietario' => array(
                'nombre' => 'Sofia Ruiz',
                'ciudad' => 'Puebla, Pue.',
                'direccion' => 'Fracc. Las Flores'
            )
        ),
        'STU5678' => array(
            'Auto' => array(
                'marca' => 'KIA',
                'modelo' => 2019,
                'tipo' => 'hatchback'
            ),
            'Propietario' => array(
                'nombre' => 'Roberto Díaz',
                'ciudad' => 'Puebla, Pue.',
                'direccion' => 'Col. Reforma'
            )
        ),
        'VWX9012' => array(
            'Auto' => array(
                'marca' => 'MITSUBISHI',
                'modelo' => 2021,
                'tipo' => 'sedan'
            ),
            'Propietario' => array(
                'nombre' => 'Carmen Flores',
                'ciudad' => 'Puebla, Pue.',
                'direccion' => 'Av. Universidad'
            )
        ),
        'YZA3456' => array(
            'Auto' => array(
                'marca' => 'SUZUKI',
                'modelo' => 2018,
                'tipo' => 'camioneta'
            ),
            'Propietario' => array(
                'nombre' => 'Alejandro Vega',
                'ciudad' => 'Puebla, Pue.',
                'direccion' => 'Col. San José'
            )
        ),
        'BCD7890' => array(
            'Auto' => array(
                'marca' => 'SUBARU',
                'modelo' => 2022,
                'tipo' => 'hatchback'
            ),
            'Propietario' => array(
                'nombre' => 'Patricia Morales',
                'ciudad' => 'Puebla, Pue.',
                'direccion' => 'Col. Estrella'
            )
        ),
        'EFG1234' => array(
            'Auto' => array(
                'marca' => 'MAZDA',
                'modelo' => 2020,
                'tipo' => 'sedan'
            ),
            'Propietario' => array(
                'nombre' => 'Jorge Castillo',
                'ciudad' => 'Puebla, Pue.',
                'direccion' => 'Col. Industrial'
            )
        ),
        'HIJ5678' => array(
            'Auto' => array(
                'marca' => 'ACURA',
                'modelo' => 2023,
                'tipo' => 'camioneta'
            ),
            'Propietario' => array(
                'nombre' => 'Beatriz Jiménez',
                'ciudad' => 'Puebla, Pue.',
                'direccion' => 'Fracc. Angelópolis'
            )
        ),
        'KLM9012' => array(
            'Auto' => array(
                'marca' => 'INFINITI',
                'modelo' => 2019,
                'tipo' => 'hatchback'
            ),
            'Propietario' => array(
                'nombre' => 'Fernando Torres',
                'ciudad' => 'Puebla, Pue.',
                'direccion' => 'Col. Maravillas'
            )
        )
    );
}

// buscar vehículo por matrícula
function buscarVehiculoPorMatricula($parqueVehicular, $matricula) {
    $matricula = strtoupper($matricula);
    
    if (isset($parqueVehicular[$matricula])) {
        return $parqueVehicular[$matricula];
    }
    
    return null;
}
?>