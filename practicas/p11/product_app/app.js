// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
};

// FUNCIÓN CALLBACK DE BOTÓN "Buscar Producto"
function buscarProducto(e) {
    e.preventDefault();

    // SE OBTIENE EL TÉRMINO DE BÚSQUEDA
    var search = document.getElementById('search').value;

    // SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
    var client = getXMLHttpRequest();
    client.open('POST', './backend/read.php', true);
    client.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    client.onreadystatechange = function () {
        // SE VERIFICA SI LA RESPUESTA ESTÁ LISTA Y FUE SATISFACTORIA
        if (client.readyState == 4 && client.status == 200) {
            console.log('[CLIENTE]\n'+client.responseText);
            
            // SE OBTIENE EL ARRAY DE PRODUCTOS A PARTIR DE UN STRING JSON
            let productos = JSON.parse(client.responseText);
            
            // SE VERIFICA SI HAY PRODUCTOS EN EL ARRAY
            if(productos.length > 0) {
                // SE CREA LA PLANTILLA PARA TODAS LAS FILAS
                let template = '';
                
                // SE RECORRE CADA PRODUCTO Y SE CREA SU FILA
                productos.forEach(producto => {
                    // SE CREA LA DESCRIPCIÓN DEL PRODUCTO
                    let descripcion = '';
                    descripcion += '<li>precio: '+producto.precio+'</li>';
                    descripcion += '<li>unidades: '+producto.unidades+'</li>';
                    descripcion += '<li>modelo: '+producto.modelo+'</li>';
                    descripcion += '<li>marca: '+producto.marca+'</li>';
                    descripcion += '<li>detalles: '+producto.detalles+'</li>';
                    
                    // SE AGREGA LA FILA A LA PLANTILLA
                    template += `
                        <tr>
                            <td>${producto.id}</td>
                            <td>${producto.nombre}</td>
                            <td><ul>${descripcion}</ul></td>
                        </tr>
                    `;
                });

                // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                document.getElementById("productos").innerHTML = template;
            } else {
                // NO SE ENCONTRARON PRODUCTOS
                document.getElementById("productos").innerHTML = `
                    <tr>
                        <td colspan="3">No se encontraron productos</td>
                    </tr>
                `;
            }
        }
    };
    client.send("search="+search);
}

// FUNCIÓN CALLBACK DE BOTÓN "Agregar Producto"
function agregarProducto(e) {
    e.preventDefault();

    // SE OBTIENE DESDE EL FORMULARIO EL JSON A ENVIAR
    var productoJsonString = document.getElementById('description').value;
    var finalJSON;
    
    // VALIDAR QUE EL JSON SEA VÁLIDO
    try {
        finalJSON = JSON.parse(productoJsonString);
    } catch(error) {
        window.alert('Error: El JSON no es válido');
        return;
    }
    
    // SE AGREGA AL JSON EL NOMBRE DEL PRODUCTO
    var nombre = document.getElementById('name').value.trim();
    
    // VALIDACIONES
    if(nombre.length === 0 || nombre.length > 100) {
        window.alert('Error: El nombre es requerido y debe tener máximo 100 caracteres');
        return;
    }
    
    if(finalJSON.precio <= 0 || finalJSON.precio > 99.99) {
        window.alert('Error: El precio debe ser mayor a 0 y menor o igual a 99.99');
        return;
    }
    
    if(finalJSON.unidades < 0 || !Number.isInteger(finalJSON.unidades)) {
        window.alert('Error: Las unidades deben ser un número entero mayor o igual a 0');
        return;
    }
    
    if(!finalJSON.modelo || finalJSON.modelo.trim().length === 0 || 
       !/^[a-zA-Z0-9]+$/.test(finalJSON.modelo.trim()) || 
       finalJSON.modelo.trim().length > 25) {
        window.alert('Error: El modelo es requerido, debe ser alfanumérico y tener máximo 25 caracteres');
        return;
    }
    
    if(!finalJSON.marca || finalJSON.marca.trim().length === 0 || finalJSON.marca.trim().length > 25) {
        window.alert('Error: La marca es requerida y debe tener máximo 25 caracteres');
        return;
    }
    
    if(finalJSON.detalles && finalJSON.detalles.length > 250) {
        window.alert('Error: Los detalles deben tener máximo 250 caracteres');
        return;
    }
    
    if(!finalJSON.imagen || finalJSON.imagen.trim().length === 0) {
        finalJSON.imagen = 'img/default.png';
    }
    
    // SE AGREGA EL NOMBRE AL JSON
    finalJSON['nombre'] = nombre;
    
    // SE OBTIENE EL STRING DEL JSON FINAL
    productoJsonString = JSON.stringify(finalJSON, null, 2);

    // SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
    var client = getXMLHttpRequest();
    client.open('POST', './backend/create.php', true);
    client.setRequestHeader('Content-Type', "application/json;charset=UTF-8");
    client.onreadystatechange = function () {
        // SE VERIFICA SI LA RESPUESTA ESTÁ LISTA Y FUE SATISFACTORIA
        if (client.readyState == 4 && client.status == 200) {
            console.log(client.responseText);
            window.alert(client.responseText);
        }
    };
    client.send(productoJsonString);
}

// SE CREA EL OBJETO DE CONEXIÓN COMPATIBLE CON EL NAVEGADOR
function getXMLHttpRequest() {
    var objetoAjax;

    try{
        objetoAjax = new XMLHttpRequest();
    }catch(err1){
        try{
            // IE7 y IE8
            objetoAjax = new ActiveXObject("Msxml2.XMLHTTP");
        }catch(err2){
            try{
                // IE5 y IE6
                objetoAjax = new ActiveXObject("Microsoft.XMLHTTP");
            }catch(err3){
                objetoAjax = false;
            }
        }
    }
    return objetoAjax;
}

function init() {
    var JsonString = JSON.stringify(baseJSON, null, 2);
    document.getElementById("description").value = JsonString;
}