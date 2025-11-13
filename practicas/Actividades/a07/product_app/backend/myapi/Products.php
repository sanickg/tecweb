<?php
namespace TECWEB\MYAPI;

require_once __DIR__ . '/DataBase.php';

class Products extends DataBase {
    private $response;

    public function __construct($db, $user='root', $pass='12345678a') {
        $this->response = array();
        parent::__construct($db, $user, $pass);
    }

    public function list() {
        if ($result = $this->conexion->query("SELECT * FROM productos WHERE eliminado = 0")) {
            $rows = $result->fetch_all(MYSQLI_ASSOC);

            if(!is_null($rows)) {
                foreach($rows as $num => $row) {
                    foreach($row as $key => $value) {
                        $this->response[$num][$key] = utf8_encode($value);
                    }
                }
            }
            $result->free();
        } else {
            die('Query Error: '.mysqli_error($this->conexion));
        }
    }

    public function search($search) {
        if (isset($search)) {
            $sql = "SELECT * FROM productos WHERE (id = '{$search}' OR nombre LIKE '%{$search}%' OR marca LIKE '%{$search}%' OR detalles LIKE '%{$search}%') AND eliminado = 0";
            
            if ($result = $this->conexion->query($sql)) {
                $rows = $result->fetch_all(MYSQLI_ASSOC);

                if(!is_null($rows)) {
                    foreach($rows as $num => $row) {
                        foreach($row as $key => $value) {
                            $this->response[$num][$key] = utf8_encode($value);
                        }
                    }
                }
                $result->free();
            } else {
                die('Query Error: '.mysqli_error($this->conexion));
            }
        }
    }

    public function single($id) {
        if (isset($id)) {
            $sql = "SELECT * FROM productos WHERE id = {$id}";
            
            if ($result = $this->conexion->query($sql)) {
                $row = $result->fetch_assoc();
                
                if(!is_null($row)) {
                    foreach($row as $key => $value) {
                        $this->response[$key] = utf8_encode($value);
                    }
                }
                $result->free();
            } else {
                die('Query Error: '.mysqli_error($this->conexion));
            }
        }
    }

    public function singleByName($name, $id = null) {
        $this->response = array(
            'exists' => false,
            'message' => 'Nombre disponible'
        );

        if(isset($name)) {
            if($id && $id > 0) {
                $sql = "SELECT * FROM productos WHERE nombre = '{$name}' AND id != {$id} AND eliminado = 0";
            } else {
                $sql = "SELECT * FROM productos WHERE nombre = '{$name}' AND eliminado = 0";
            }
            
            $result = $this->conexion->query($sql);
            
            if($result->num_rows > 0) {
                $this->response['exists'] = true;
                $this->response['message'] = 'Este nombre ya existe en la base de datos';
            }
            
            $result->free();
        }
    }

    public function add($jsonOBJ) {
        $this->response = array(
            'status'  => 'error',
            'message' => 'Ya existe un producto con ese nombre'
        );

        if(isset($jsonOBJ->nombre)) {
            $sql = "SELECT * FROM productos WHERE nombre = '{$jsonOBJ->nombre}' AND eliminado = 0";
            $result = $this->conexion->query($sql);
            
            if ($result->num_rows == 0) {
                $this->conexion->set_charset("utf8");
                $sql = "INSERT INTO productos VALUES (null, '{$jsonOBJ->nombre}', '{$jsonOBJ->marca}', '{$jsonOBJ->modelo}', {$jsonOBJ->precio}, '{$jsonOBJ->detalles}', {$jsonOBJ->unidades}, '{$jsonOBJ->imagen}', 0)";
                
                if($this->conexion->query($sql)){
                    $this->response['status'] = "success";
                    $this->response['message'] = "Producto agregado";
                } else {
                    $this->response['message'] = "ERROR: No se ejecutó $sql. " . mysqli_error($this->conexion);
                }
            }
            $result->free();
        }
    }

    public function delete($id) {
        $this->response = array(
            'status'  => 'error',
            'message' => 'La consulta falló'
        );

        if(isset($id)) {
            $sql = "UPDATE productos SET eliminado=1 WHERE id = {$id}";
            
            if ($this->conexion->query($sql)) {
                $this->response['status'] = "success";
                $this->response['message'] = "Producto eliminado";
            } else {
                $this->response['message'] = "ERROR: No se ejecutó $sql. " . mysqli_error($this->conexion);
            }
        }
    }

    public function edit($jsonOBJ) {
        $this->response = array(
            'status'  => 'error',
            'message' => 'Ya existe un producto con ese nombre'
        );
        
        if(isset($jsonOBJ->id)) {
            $sql = "SELECT * FROM productos WHERE nombre = '{$jsonOBJ->nombre}' AND id != {$jsonOBJ->id} AND eliminado = 0";
            $result = $this->conexion->query($sql);
            
            if ($result->num_rows == 0) {
                $this->conexion->set_charset("utf8");
                $sql = "UPDATE productos SET 
                        nombre = '{$jsonOBJ->nombre}',
                        marca = '{$jsonOBJ->marca}',
                        modelo = '{$jsonOBJ->modelo}',
                        precio = {$jsonOBJ->precio},
                        detalles = '{$jsonOBJ->detalles}',
                        unidades = {$jsonOBJ->unidades},
                        imagen = '{$jsonOBJ->imagen}'
                        WHERE id = {$jsonOBJ->id}";
                
                if($this->conexion->query($sql)){
                    $this->response['status'] = "success";
                    $this->response['message'] = "Producto actualizado";
                } else {
                    $this->response['message'] = "ERROR: No se ejecutó $sql. " . mysqli_error($this->conexion);
                }
            }
            $result->free();
        }
    }

    public function getData() {
        return json_encode($this->response, JSON_PRETTY_PRINT);
    }
}
?>