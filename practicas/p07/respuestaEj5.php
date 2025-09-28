<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado Ejercicio 5</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .resultado { border: 1px solid #ddd; padding: 15px; margin: 10px 0; background-color: #f9f9f9; }
        .error { color: red; }
        .success { color: green; }
    </style>
</head>
<body>
    <?php include 'src/funciones.php'; ?>
    
    <h1>Resultado de Validación - Ejercicio 5</h1>
    
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['edad']) && isset($_POST['sexo'])) {
            $edad = $_POST['edad'];
            $sexo = $_POST['sexo'];
            
            if (!empty($edad) && !empty($sexo)) {
                $mensaje = validarEdadSexo($edad, $sexo);
                
                $clase = ($sexo === 'femenino' && $edad >= 18 && $edad <= 35) ? 'success' : 'error';
                
                echo "<div class='resultado'>";
                echo "<h3>Resultado de la validación:</h3>";
                echo "<p class='$clase'><strong>$mensaje</strong></p>";
                echo "<p><strong>Datos ingresados:</strong></p>";
                echo "<ul>";
                echo "<li>Edad: $edad años</li>";
                echo "<li>Sexo: " . ucfirst($sexo) . "</li>";
                echo "</ul>";
                echo "</div>";
            } else {
                echo "<div class='resultado'>";
                echo "<p class='error'><strong>Error: Todos los campos son obligatorios.</strong></p>";
                echo "</div>";
            }
        } else {
            echo "<div class='resultado'>";
            echo "<p class='error'><strong>Error: No se recibieron datos del formulario.</strong></p>";
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