<?php
include_once __DIR__. "/../config/conexionDB.php";
class Users{
    private static $users=[
        ["id"=>1,"name"=>'Daniel Rodriguez','email'=>"daniel@gmail.com"],
        ["id"=>2,"name"=>'Maria Lopez','email'=>"maria@gmail.com"],
        ["id"=>3,"name"=>'Carlos Daniel','Ruiz'=>"carlos@gmail.com"],
        // ["id"=>4,"name"=>'','email'=>"daniel@gmail.com"],


    ];
    public static function all() {
        $sql="SELECT * FROM USUARIOS";
        return ConexionPDO::query($sql);//self::$users;
    }
}