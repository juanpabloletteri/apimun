<?php

class psicologo
{

    private $_id_psicologo;
    private $_id_usuario;
    private $_nombre;
    private $_apellido;
    private $_mail;
    private $_telefono1;
    private $_telefono2;


    //TRAER usuario POR ID
    public static function traerPsicologo($id)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM psicologos WHERE id_usuario=:id");
        $consulta->bindValue(":id", $id);
        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($datos);
    }


    //////////////////////////////////////////////////////////////////////////////
    //AGREGAR usuario
    public static function agregarUsuario($mail, $password, $nombre, $apellido, $tipo)
    {
        $rta = false;
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT into  
        usuarios (mail,password,nombre,apellido,tipo)
        values(:mail,:password,:nombre,:apellido,:tipo)");

        $consulta->bindValue(':mail', $mail);
        $consulta->bindValue(':password', $password);
        $consulta->bindValue(':nombre', $nombre);
        $consulta->bindValue(':apellido', $apellido);
        $consulta->bindValue(':tipo', $tipo);

        if ($consulta->execute()) {
            $rta = $objetoAccesoDato->RetornarUltimoIdInsertado();
        }
        return $rta;
    }

    //TRAER TODOS LOS usuarios
    public static function traerTodosLosUsuarios()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM usuarios");
        $consulta->execute();
        $consulta = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($consulta);
    }

    //TRAER usuario POR ID
    public static function traerUsuarioPorId($id)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM usuarios WHERE id_usuario=:id");
        $consulta->bindValue(":id", $id);
        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($datos);
    }

    //PARA EL PROFESOR
    //TRAER usuario POR TIPO
    public static function traerUsuarioPorTipo($tipo)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM usuarios WHERE tipo=:tipo");
        $consulta->bindValue(":tipo", $tipo);
        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($datos);
    }

    //MODIFICAR usuario
    public static function modificarUsuario($id, $mail, $password, $nombre, $apellido, $tipo)
    {
        $rta = false;
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE `usuarios` 
        SET `mail`= :mail,
        `password`= :password,
        `nombre`= :nombre,
        `apellido`=:apellido,
        `tipo`= :tipo
        WHERE id_usuario = :id");

        $consulta->bindValue(':id', $id);
        $consulta->bindValue(':mail', $mail);
        $consulta->bindValue(':password', $password);
        $consulta->bindValue(':nombre', $nombre);
        $consulta->bindValue(':apellido', $apellido);
        $consulta->bindValue(':tipo', $tipo);

        if ($consulta->execute()) {
            $rta = true;
        }
        return $rta;
    }

    //BORRAR usuario
    public static function borrarUsuario($id)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("DELETE FROM usuarios WHERE id_usuario=:id");
        $consulta->bindValue(":id", $id);
        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($datos);
    }
}
