<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado Ejercicio 6</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .resultado { border: 1px solid #ddd; padding: 15px; margin: 10px 0; background-color: #f9f9f9; }
        table { border-collapse: collapse; width: 100%; margin: 10px 0; }
        table, th, td { border: 1px solid #ddd; }
        th, td { padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .vehiculo { border: 1px solid #bbb; padding: 10px; margin: 10px 0; background-color: #fff; }
        .error { color: red; }
        .print-r { background-color: #f4f4f4; padding: 10px; font-family: monospace; white-space: pre-wrap; }
    </style>
</head>
<body>
    <?php include 'src/funciones.php'; ?>
    
    <h1>Resultado de Consulta - Ejercicio 6</h1>
    
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['consulta'])) {
            $consulta = $_POST['consulta'];
            $parqueVehicular = crearParqueVehicular();
            
            switch ($consulta) {
                case 'matricula':
                    if (isset($_POST['matricula']) && !empty($_POST['matricula'])) {
                        $matricula = strtoupper(trim($_POST['matricula']));
                        $vehiculo = buscarVehiculoPorMatricula($parqueVehicular, $matricula);
                        
                        echo "<div class='resultado'>";
                        if ($vehiculo !== null) {
                            echo "<h3>Vehículo encontrado - Matrícula: $matricula</h3>";
                            echo "<div class='vehiculo'>";
                            echo "<h4>Información del Auto:</h4>";
                            echo "<ul>";
                            echo "<li><strong>Marca:</strong> {$vehiculo['Auto']['marca']}</li>";
                            echo "<li><strong>Modelo:</strong> {$vehiculo['Auto']['modelo']}</li>";
                            echo "<li><strong>Tipo:</strong> {$vehiculo['Auto']['tipo']}</li>";
                            echo "</ul>";
                            
                            echo "<h4>Información del Propietario:</h4>";
                            echo "<ul>";
                            echo "<li><strong>Nombre:</strong> {$vehiculo['Propietario']['nombre']}</li>";
                            echo "<li><strong>Ciudad:</strong> {$vehiculo['Propietario']['ciudad']}</li>";
                            echo "<li><strong>Dirección:</strong> {$vehiculo['Propietario']['direccion']}</li>";
                            echo "</ul>";
                            echo "</div>";
                        } else {
                            echo "<p class='error'><strong>No se encontró ningún vehículo con la matrícula: $matricula</strong></p>";
                            echo "<p>Matrículas disponibles: " . implode(', ', array_keys($parqueVehicular)) . "</p>";
                        }
                        echo "</div>";
                    } else {
                        echo "<div class='resultado'>";
                        echo "<p class='error'><strong>Error: Debe ingresar una matrícula.</strong></p>";
                        echo "</div>";
                    }
                    break;
                    
                case 'todos':
                    echo "<div class='resultado'>";
                    echo "<h3>Todos los vehículos registrados (" . count($parqueVehicular) . " vehículos)</h3>";
                    
                    echo "<table>";
                    echo "<tr>";
                    echo "<th>Matrícula</th>";
                    echo "<th>Marca</th>";
                    echo "<th>Modelo</th>";
                    echo "<th>Tipo</th>";
                    echo "<th>Propietario</th>";
                    echo "<th>Ciudad</th>";
                    echo "<th>Dirección</th>";
                    echo "</tr>";
                    
                    foreach ($parqueVehicular as $matricula => $datos) {
                        echo "<tr>";
                        echo "<td><strong>$matricula</strong></td>";
                        echo "<td>{$datos['Auto']['marca']}</td>";
                        echo "<td>{$datos['Auto']['modelo']}</td>";
                        echo "<td>{$datos['Auto']['tipo']}</td>";
                        echo "<td>{$datos['Propietario']['nombre']}</td>";
                        echo "<td>{$datos['Propietario']['ciudad']}</td>";
                        echo "<td>{$datos['Propietario']['direccion']}</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    
                    echo "<h4>Estructura del arreglo (print_r):</h4>";
                    echo "<div class='print-r'>";
                    echo htmlspecialchars(print_r($parqueVehicular, true));
                    echo "</div>";
                    echo "</div>";
                    break;
                    
                default:
                    echo "<div class='resultado'>";
                    echo "<p class='error'><strong>Error: Tipo de consulta no válido.</strong></p>";
                    echo "</div>";
                    break;
            }
        } else {
            echo "<div class='resultado'>";
            echo "<p class='error'><strong>Error: No se recibió tipo de consulta.</strong></p>";
            echo "</div>";
        }
    } else {
        echo "<div class='resultado'>";
        echo "<p class='error'><strong>Error: Acceso directo no permitido. Use el formulario.</strong></p>";
        echo "</div>";
    }
    ?>
    
    <p><a href="index.php">← Volver al formulario</a></p>
</body>
</html>
