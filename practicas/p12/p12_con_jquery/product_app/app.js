// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
};

function init() {
    var JsonString = JSON.stringify(baseJSON, null, 2);
    document.getElementById("description").value = JsonString;
}

// JQUERY: Se ejecuta cuando el documento está listo
$(document).ready(function() {
    
    // Cargar todos los productos al iniciar
    listarProductos();

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
            // Si el campo está vacío, cargar todos los productos
            listarProductos();
            $('#product-result').removeClass('d-block').addClass('d-none');
        }
    });

    // AGREGAR PRODUCTO: Se ejecuta al enviar el formulario
    $('#product-form').submit(function(e) {
        e.preventDefault();
        
        let productoJsonString = $('#description').val();
        let finalJSON = JSON.parse(productoJsonString);
        finalJSON['nombre'] = $('#name').val();
        productoJsonString = JSON.stringify(finalJSON, null, 2);
        
        $.ajax({
            url: './backend/product-add.php',
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
                init();
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
});

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