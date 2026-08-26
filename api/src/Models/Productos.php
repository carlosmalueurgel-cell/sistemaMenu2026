<?php
include_once __DIR__. "/../Config/conexionDB.php";
class Productos
{
    //Mostrar Producto
    public static function all() 
    {
        $sql="SELECT * FROM productos";
        return ConexionPDO::query($sql);
    }
    //Actualizar producto
    public static function update($id,$data) 
    {
        if(isset($data['id']))
        {
           unset($data['id']);
        }
        $campos=[];
        $valores=[];
        //construir datos
        foreach($data as $columna=>$valor)
            {
                $campos[]="$columna=:$columna";
                $valores[":$columna"]=$valor;
            }
        $stringCampos=implode(",",$campos);
        //preparamos la consulta
        $sql="UPDATE productos SET $stringCampos WHERE id=:id";
        $valores[':id']=$id;
        $result = ConexionPDO::execute($sql, $valores,false);
        //$sql = "SELECT * FROM productos";
        return $sql;//ConexionPDO::query($sql);
    }
    public static function add($data) 
    {
        $campos=[];
        $valores=[];
        $parametros=[];
        //construir datos
        foreach($data as $columna=>$valor)
            {
                $campos[]=$columna;
                $parametros[]=":$columna";
                $valores[":$columna"]=$valor;
            }
        $stringCampos=implode(",",$campos);
        $stringParametros=implode(",",$parametros);
        //preparamos la consulta
        $sql="INSERT INTO productos($stringCampos) VALUES ($stringParametros)";
        $result = ConexionPDO::execute($sql, $valores,true);
        return $result;
    }
    public static function validarAdd($data) 
    {
        $errores=[];

        if(!is_array($data))
        {
            $errores[]="Los datos enviados no son validos";
            return $errores;
        }

        if(!isset($data['codBarras']) || trim($data['codBarras'])=="")
        {
            $errores[]="El campo codigo de barras es obligatorio";
        }

        if(!isset($data['descripcion']) || trim($data['descripcion'])=="")
        {
            $errores[]="El campo descripcion es obligatorio";
        }

        if(!isset($data['stock']) || trim($data['stock'])=="")
        {
            $errores[]="El campo stock es obligatorio";
        }
        elseif(!is_numeric($data['stock']) || $data['stock']<0)
        {
            $errores[]="El campo stock debe ser un numero mayor o igual a 0";
        }

        if(!isset($data['precio_unitario']) || trim($data['precio_unitario'])=="")
        {
            $errores[]="El campo precio_unitario es obligatorio";
        }
        elseif(!is_numeric($data['precio_unitario']) || $data['precio_unitario']<0)
        {
            $errores[]="El campo precio_unitario debe ser un numero mayor o igual a 0";
        }

        return $errores;
    }
    public static function delete($id) 
    {
        $sql="DELETE FROM productos WHERE id=:id";
        $valores=[
            ":id"=>$id
        ];
        $result = ConexionPDO::execute($sql, $valores,false);
        return $result;
    }
}
    
