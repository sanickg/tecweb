// Variable para rastrear si el nombre es válido
let nombreValido = true;
let validacionesActivas = {
    nombre: false,
    marca: false,
    modelo: false,
    precio: false,
    unidades: false
};

// JQUERY: Se ejecuta cuando el documento está listo
$(document).ready(function() {
    
    // Inicializar valores por defecto
    $('#modelo').val('XX-000');
    $('#marca').val('NA');
    $('#precio').val('99.99');
    $('#unidades').val('1');
    $('#detalles').val('NA');
    $('#imagen').val('img/default.png');
    
    // Cargar todos los productos al iniciar
    listarProductos();

    // VALIDACIONES EN TIEMPO REAL
    
    // Validación del nombre (con verificación en BD)
    $('#name').on('blur keyup', function() {
        let nombre = $(this).val().trim();
        let productId = $('#productId').val();
        
        if(nombre.length === 0) {
            mostrarEstado('name', false, 'El nombre es requerido');
            nombreValido = false;
            validacionesActivas.nombre = false;
            return;
        }
        
        if(nombre.length > 100) {
            mostrarEstado('name', false, 'El nombre no debe exceder 100 caracteres');
            nombreValido = false;
            validacionesActivas.nombre = false;
            return;
        }
        
        // Validar en BD solo cuando se teclea (keyup)
        if(nombre.length > 0) {
            let url = './backend/product-validate-name.php?nombre=' + encodeURIComponent(nombre);
            if(productId) {
                url += '&id=' + productId;
            }
            
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    let data = JSON.parse(response);
                    if(data.exists) {
                        mostrarEstado('name', false, data.message);
                        nombreValido = false;
                        validacionesActivas.nombre = false;
                    } else {
                        mostrarEstado('name', true, data.message);
                        nombreValido = true;
                        validacionesActivas.nombre = true;
                    }
                }
            });
        }
    });

    // Validación de la marca
    $('#marca').on('blur', function() {
        let marca = $(this).val().trim();
        
        if(marca.length === 0) {
            mostrarEstado('marca', false, 'La marca es requerida');
            validacionesActivas.marca = false;
        } else if(marca.length > 25) {
            mostrarEstado('marca', false, 'La marca no debe exceder 25 caracteres');
            validacionesActivas.marca = false;
        } else {
            mostrarEstado('marca', true, 'Marca válida');
            validacionesActivas.marca = true;
        }
    });

    // Validación del modelo
    $('#modelo').on('blur', function() {
        let modelo = $(this).val().trim();
        let regex = /^[a-zA-Z0-9]+$/;
        
        if(modelo.length === 0) {
            mostrarEstado('modelo', false, 'El modelo es requerido');
            validacionesActivas.modelo = false;
        } else if(modelo.length > 25) {
            mostrarEstado('modelo', false, 'El modelo no debe exceder 25 caracteres');
            validacionesActivas.modelo = false;
        } else if(!regex.test(modelo)) {
            mostrarEstado('modelo', false, 'El modelo solo debe contener letras y números');
            validacionesActivas.modelo = false;
        } else {
            mostrarEstado('modelo', true, 'Modelo válido');
            validacionesActivas.modelo = true;
        }
    });

    // Validación del precio
    $('#precio').on('blur', function() {
        let precio = parseFloat($(this).val());
        
        if(isNaN(precio)) {
            mostrarEstado('precio', false, 'El precio es requerido');
            validacionesActivas.precio = false;
        } else if(precio < 99.99) {
            mostrarEstado('precio', false, 'El precio debe ser mayor a 99.99');
            validacionesActivas.precio = false;
        } else {
            mostrarEstado('precio', true, 'Precio válido');
            validacionesActivas.precio = true;
        }
    });

    // Validación de las unidades
    $('#unidades').on('blur', function() {
        let unidades = parseInt($(this).val());
        
        if(isNaN(unidades)) {
            mostrarEstado('unidades', false, 'Las unidades son requeridas');
            validacionesActivas.unidades = false;
        } else if(unidades < 0) {
            mostrarEstado('unidades', false, 'Las unidades deben ser mayor o igual a 0');
            validacionesActivas.unidades = false;
        } else {
            mostrarEstado('unidades', true, 'Unidades válidas');
            validacionesActivas.unidades = true;
        }
    });

    // Validación de los detalles
    $('#detalles').on('blur', function() {
        let detalles = $(this).val().trim();
        
        if(detalles.length > 250) {
            mostrarEstado('detalles', false, 'Los detalles no deben exceder 250 caracteres');
        } else if(detalles.length > 0) {
            mostrarEstado('detalles', true, 'Detalles válidos');
        } else {
            $('#detalles-status').hide();
        }
    });

    // Validación de la imagen
    $('#imagen').on('blur', function() {
        let imagen = $(this).val().trim();
        
        if(imagen.length > 0 && imagen.length <= 100) {
            mostrarEstado('imagen', true, 'Ruta de imagen válida');
        } else if(imagen.length > 100) {
            mostrarEstado('imagen', false, 'La ruta de imagen no debe exceder 100 caracteres');
        } else {
            $('#imagen-status').hide();
        }
    });

    // BÚSQUEDA: Se ejecuta al teclear en el campo de búsqueda
    $('#search').keyup(function() {
        let search = $('#search').val();
        
        if(search) {
            $.ajax({
                url: './backend/product-search.php',
                type: 'GET',
                data: { search },
                success: function(response) {
                    let productos = JSON.parse(response);
                    
                    if(Object.keys(productos).length > 0) {
                        let template = '';
                        let template_bar = '';
                        
                        productos.forEach(producto => {
                            let descripcion = '';
                            descripcion += '<li>precio: '+producto.precio+'</li>';
                            descripcion += '<li>unidades: '+producto.unidades+'</li>';
                            descripcion += '<li>modelo: '+producto.modelo+'</li>';
                            descripcion += '<li>marca: '+producto.marca+'</li>';
                            descripcion += '<li>detalles: '+producto.detalles+'</li>';
                            
                            template += `
                                <tr productId="${producto.id}">
                                    <td>${producto.id}</td>
                                    <td>${producto.nombre}</td>
                                    <td><ul>${descripcion}</ul></td>
                                    <td>
                                        <button class="product-edit btn btn-warning">
                                            Editar
                                        </button>
                                        <button class="product-delete btn btn-danger">
                                            Eliminar
                                        </button>
                                    </td>
                                </tr>
                            `;
                            
                            template_bar += `<li>${producto.nombre}</li>`;
                        });
                        
                        $('#product-result').removeClass('d-none').addClass('d-block');
                        $('#container').html(template_bar);
                        $('#products').html(template);
                    }
                }
            });
        } else {
            listarProductos();
            $('#product-result').removeClass('d-block').addClass('d-none');
        }
    });

    // AGREGAR O EDITAR PRODUCTO: Se ejecuta al enviar el formulario
    $('#product-form').submit(function(e) {
        e.preventDefault();
        
        // Validar que todos los campos requeridos no estén vacíos
        let nombre = $('#name').val().trim();
        let marca = $('#marca').val().trim();
        let modelo = $('#modelo').val().trim();
        let precio = $('#precio').val();
        let unidades = $('#unidades').val();
        let detalles = $('#detalles').val().trim() || 'NA';
        let imagen = $('#imagen').val().trim() || 'img/default.png';
        
        // Verificar campos vacíos
        if(!nombre || !marca || !modelo || !precio || !unidades) {
            alert('Por favor completa todos los campos requeridos');
            return;
        }
        
        // Verificar que el nombre sea válido (no exista en BD)
        if(!nombreValido) {
            alert('El nombre del producto ya existe o no es válido');
            return;
        }
        
        // Construir el JSON del producto
        let finalJSON = {
            nombre: nombre,
            marca: marca,
            modelo: modelo,
            precio: parseFloat(precio),
            detalles: detalles,
            unidades: parseInt(unidades),
            imagen: imagen
        };
        
        let id = $('#productId').val();
        if(id) {
            finalJSON['id'] = id;
        }
        
        let productoJsonString = JSON.stringify(finalJSON, null, 2);
        let url = id ? './backend/product-edit.php' : './backend/product-add.php';
        
        $.ajax({
            url: url,
            type: 'POST',
            contentType: 'application/json',
            data: productoJsonString,
            success: function(response) {
                let respuesta = JSON.parse(response);
                let template_bar = `
                    <li style="list-style: none;">status: ${respuesta.status}</li>
                    <li style="list-style: none;">message: ${respuesta.message}</li>
                `;
                
                $('#product-result').removeClass('d-none').addClass('d-block');
                $('#container').html(template_bar);
                
                listarProductos();
                $('#product-form').trigger('reset');
                
                // Restaurar valores por defecto
                $('#modelo').val('XX-000');
                $('#marca').val('NA');
                $('#precio').val('99.99');
                $('#unidades').val('1');
                $('#detalles').val('NA');
                $('#imagen').val('img/default.png');
                $('#productId').val('');
                
                // Ocultar todas las barras de estado
                $('.status-bar').hide();
                
                // Resetear validaciones
                nombreValido = true;
                validacionesActivas = {
                    nombre: false,
                    marca: false,
                    modelo: false,
                    precio: false,
                    unidades: false
                };
            }
        });
    });

    // ELIMINAR PRODUCTO: Se ejecuta al hacer click en botón eliminar
    $(document).on('click', '.product-delete', function() {
        if(confirm('¿De verdad deseas eliminar el Producto?')) {
            let element = $(this)[0].parentElement.parentElement;
            let id = $(element).attr('productId');
            
            $.ajax({
                url: './backend/product-delete.php',
                type: 'GET',
                data: { id },
                success: function(response) {
                    let respuesta = JSON.parse(response);
                    let template_bar = `
                        <li style="list-style: none;">status: ${respuesta.status}</li>
                        <li style="list-style: none;">message: ${respuesta.message}</li>
                    `;
                    
                    $('#product-result').removeClass('d-none').addClass('d-block');
                    $('#container').html(template_bar);
                    
                    listarProductos();
                }
            });
        }
    });

    // EDITAR PRODUCTO: Cargar datos en el formulario
    $(document).on('click', '.product-edit', function() {
        let element = $(this)[0].parentElement.parentElement;
        let id = $(element).attr('productId');
        
        $.ajax({
            url: './backend/product-single.php',
            type: 'GET',
            data: { id },
            success: function(response) {
                let producto = JSON.parse(response);
                
                $('#name').val(producto.nombre);
                $('#marca').val(producto.marca);
                $('#modelo').val(producto.modelo);
                $('#precio').val(producto.precio);
                $('#unidades').val(producto.unidades);
                $('#detalles').val(producto.detalles);
                $('#imagen').val(producto.imagen);
                $('#productId').val(producto.id);
                
                // Cambiar el texto del botón
                $('#submit-btn').text('Actualizar Producto');
                
                // Ocultar barras de estado
                $('.status-bar').hide();
            }
        });
    });
});

// FUNCIÓN PARA MOSTRAR ESTADO DE VALIDACIÓN
function mostrarEstado(campo, valido, mensaje) {
    let statusBar = $('#' + campo + '-status');
    statusBar.removeClass('status-success status-error');
    
    if(valido) {
        statusBar.addClass('status-success');
    } else {
        statusBar.addClass('status-error');
    }
    
    statusBar.text(mensaje);
    statusBar.show();
    
    // Ocultar después de 3 segundos
    setTimeout(function() {
        statusBar.fadeOut();
    }, 3000);
}

// FUNCIÓN PARA LISTAR TODOS LOS PRODUCTOS
function listarProductos() {
    $.ajax({
        url: './backend/product-list.php',
        type: 'GET',
        success: function(response) {
            let productos = JSON.parse(response);
            
            if(Object.keys(productos).length > 0) {
                let template = '';
                
                productos.forEach(producto => {
                    let descripcion = '';
                    descripcion += '<li>precio: '+producto.precio+'</li>';
                    descripcion += '<li>unidades: '+producto.unidades+'</li>';
                    descripcion += '<li>modelo: '+producto.modelo+'</li>';
                    descripcion += '<li>marca: '+producto.marca+'</li>';
                    descripcion += '<li>detalles: '+producto.detalles+'</li>';
                    
                    template += `
                        <tr productId="${producto.id}">
                            <td>${producto.id}</td>
                            <td>${producto.nombre}</td>
                            <td><ul>${descripcion}</ul></td>
                            <td>
                                <button class="product-edit btn btn-warning">
                                    Editar
                                </button>
                                <button class="product-delete btn btn-danger">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    `;
                });
                
                $('#products').html(template);
            }
        }
    });
}