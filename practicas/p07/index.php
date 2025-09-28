<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 7 - PHP</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .ejercicio { border: 1px solid #ccc; padding: 15px; margin: 10px 0; }
        table { border-collapse: collapse; width: 100%; }
        table, th, td { border: 1px solid #ddd; }
        th, td { padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <?php include 'src/funciones.php'; ?>
    
    <h1>Práctica 7 - Uso de funciones y variables GET y POST en PHP</h1>
    
    <div class="ejercicio">
        <h2>Ejercicio 1: Múltiplo de 5 y 7</h2>
        <p>Comprobar si un número es múltiplo de 5 y 7</p>
        <p><strong>URL de ejemplo:</strong> index.php?numero=35</p>
        
        <?php
        if (isset($_GET['numero'])) {
            $numero = $_GET['numero'];
            if (is_numeric($numero)) {
                if (esMultiplo5y7($numero)) {
                    echo "<h3>R= El número $numero SÍ es múltiplo de 5 y 7.</h3>";
                } else {
                    echo "<h3>R= El número $numero NO es múltiplo de 5 y 7.</h3>";
                }
            } else {
                echo "<h3>Error: Debe ingresar un número válido.</h3>";
            }
        }
        ?>
    </div>
    
    <div class="ejercicio">
        <h2>Ejercicio 2: Secuencia Impar, Par, Impar</h2>
        <p>Generar números aleatorios hasta obtener secuencia: impar, par, impar</p>
        
        <?php
        if (isset($_GET['generar'])) {
            $resultado = generarSecuenciaImparParImpar();
            $matriz = $resultado['matriz'];
            $iteraciones = $resultado['iteraciones'];
            $totalNumeros = $resultado['totalNumeros'];
            
            echo "<h3>Números generados:</h3>";
            echo "<table>";
            echo "<tr><th>Iteración</th><th>Número 1</th><th>Número 2</th><th>Número 3</th><th>Estado</th></tr>";
            
            for ($i = 0; $i < count($matriz); $i++) {
                $num1 = $matriz[$i][0];
                $num2 = $matriz[$i][1];
                $num3 = $matriz[$i][2];
                
                $estado1 = ($num1 % 2 == 0) ? 'par' : 'impar';
                $estado2 = ($num2 % 2 == 0) ? 'par' : 'impar';
                $estado3 = ($num3 % 2 == 0) ? 'par' : 'impar';
                
                $estadoCompleto = "$estado1, $estado2, $estado3";
                
                if ($i == count($matriz) - 1) {
                    $estadoCompleto .= " ✓";
                }
                
                echo "<tr>";
                echo "<td>" . ($i + 1) . "</td>";
                echo "<td>$num1</td>";
                echo "<td>$num2</td>";
                echo "<td>$num3</td>";
                echo "<td>$estadoCompleto</td>";
                echo "</tr>";
            }
            echo "</table>";
            
            echo "<p><strong>$totalNumeros números obtenidos en $iteraciones iteraciones</strong></p>";
        }
        ?>
        
        <p><a href="index.php?generar=1">Generar secuencia</a></p>
    </div>
    
    <div class="ejercicio">
        <h2>Ejercicio 3: Múltiplo aleatorio con WHILE</h2>
        <p>Encontrar primer número aleatorio múltiplo de un número dado</p>
        <p><strong>URL de ejemplo:</strong> index.php?multiplo=5</p>
        
        <?php
        if (isset($_GET['multiplo'])) {
            $numeroDado = $_GET['multiplo'];
            if (is_numeric($numeroDado) && $numeroDado > 0) {
                $resultadoWhile = encontrarMultiploWhile($numeroDado);
                $resultadoDoWhile = encontrarMultiploDoWhile($numeroDado);
                
                echo "<h4>Método WHILE:</h4>";
                echo "<p>Número encontrado: <strong>{$resultadoWhile['numero']}</strong></p>";
                echo "<p>Intentos realizados: <strong>{$resultadoWhile['intentos']}</strong></p>";
                echo "<p>Verificación: {$resultadoWhile['numero']} ÷ $numeroDado = " . 
                     ($resultadoWhile['numero'] / $numeroDado) . "</p>";
                
                echo "<h4>Método DO-WHILE:</h4>";
                echo "<p>Número encontrado: <strong>{$resultadoDoWhile['numero']}</strong></p>";
                echo "<p>Intentos realizados: <strong>{$resultadoDoWhile['intentos']}</strong></p>";
                echo "<p>Verificación: {$resultadoDoWhile['numero']} ÷ $numeroDado = " . 
                     ($resultadoDoWhile['numero'] / $numeroDado) . "</p>";
            } else {
                echo "<h3>Error: Debe ingresar un número válido mayor a 0.</h3>";
            }
        }
        ?>
    </div>
    
    <div class="ejercicio">
        <h2>Ejercicio 4: Arreglo ASCII (a-z)</h2>
        <p>Crear arreglo con índices 97-122 y valores de 'a' a 'z'</p>
        
        <?php
        if (isset($_GET['ascii'])) {
            $arregloAscii = crearArregloAscii();
            
            echo "<h3>Arreglo ASCII generado:</h3>";
            echo "<table>";
            echo "<tr><th>Índice (Código ASCII)</th><th>Carácter</th></tr>";
            
            foreach ($arregloAscii as $codigo => $caracter) {
                echo "<tr>";
                echo "<td>$codigo</td>";
                echo "<td><strong>$caracter</strong></td>";
                echo "</tr>";
            }
            echo "</table>";
        }
        ?>
        
        <p><a href="index.php?ascii=1">Generar tabla ASCII</a></p>
    </div>
    
<div class="ejercicio">
        <h2>Ejercicio 5: Validación de Edad y Sexo</h2>
        <p>Verificar si una persona es de sexo femenino y tiene entre 18 y 35 años</p>
        
        <form action="respuestaEj5.php" method="post">
            <table>
                <tr>
                    <td><label for="edad">Edad:</label></td>
                    <td><input type="number" id="edad" name="edad" min="1" max="120" required></td>
                </tr>
                <tr>
                    <td><label for="sexo">Sexo:</label></td>
                    <td>
                        <select id="sexo" name="sexo" required>
                            <option value="">Seleccione...</option>
                            <option value="femenino">Femenino</option>
                            <option value="masculino">Masculino</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" value="Validar"></td>
                </tr>
            </table>
        </form>
    </div>
    
    <div class="ejercicio">
        <h2>Ejercicio 6: Consulta Parque Vehicular</h2>
        <p>Consultar información de vehículos registrados</p>
        
        <form action="respuestaEj6.php" method="post">
            <table>
                <tr>
                    <td><label for="consulta">Tipo de consulta:</label></td>
                    <td>
                        <select id="consulta" name="consulta" required onchange="toggleMatricula()">
                            <option value="">Seleccione...</option>
                            <option value="matricula">Buscar por matrícula</option>
                            <option value="todos">Mostrar todos los vehículos</option>
                        </select>
                    </td>
                </tr>
                <tr id="matricula-row" style="display: none;">
                    <td><label for="matricula">Matrícula:</label></td>
                    <td>
                        <input type="text" id="matricula" name="matricula" placeholder="Ej: UBN6338">
                        <br><small>Formato: LLLNNNN (3 letras + 4 números)</small>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" value="Consultar"></td>
                </tr>
            </table>
        </form>
        
        <script>
            function toggleMatricula() {
                var consulta = document.getElementById('consulta').value;
                var matriculaRow = document.getElementById('matricula-row');
                var matriculaInput = document.getElementById('matricula');
                
                if (consulta === 'matricula') {
                    matriculaRow.style.display = '';
                    matriculaInput.setAttribute('required', '');
                } else {
                    matriculaRow.style.display = 'none';
                    matriculaInput.removeAttribute('required');
                }
            }
        </script>
    </div>
</body>
</html>