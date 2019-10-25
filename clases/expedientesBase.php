<?php

class expedientesBase {

    private $_id_expediente;
    private $_tipo;
    private $_numero;
    private $_anio;
    private $_fecha;
    private $_tema;
    private $_fojas;
    private $_iniciador;
    private $_direccion;
    private $_caratula;
    private $_id_usuario;
    
    //AGREGAR mascota
    public static function agregarExpediente($tipo,$numero,$anio,$fecha,$tema,$fojas,$iniciador,$caratula,$id_usuario)
    {
        $rta = false;
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into  
        expedientesbase (tipo,numero,anio,fecha,tema,fojas,iniciador,caratula,id_usuario)
        values(:tipo,:numero,:anio,:fecha,:tema,:fojas,:iniciador,:caratula,:id_usuario)");

        $consulta->bindValue(':tipo',$tipo);
        $consulta->bindValue(':numero',$numero);
        $consulta->bindValue(':anio', $anio);
        $consulta->bindValue(':fecha', $fecha);
        $consulta->bindValue(':tema', $tema);
        $consulta->bindValue(':fojas', $fojas);
        $consulta->bindValue(':iniciador', $iniciador);
        $consulta->bindValue(':caratula', $caratula);
        $consulta->bindValue(':id_usuario', $id_usuario);
        
        if($consulta->execute()){
            $rta = $objetoAccesoDato->RetornarUltimoIdInsertado();
        }
        return $rta; 
    }    

    //TRAER TODOS LOS mascotas
    public static function traerTodosLosExpedientes()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM expedientesbase");
        $consulta->execute();
        $consulta = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($consulta);
    }

    //TRAER mascota POR ID
    public static function traerExpedientePorId($id)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM expedientesbase WHERE id_expediente=:id");
        $consulta->bindValue(":id",$id);
        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($datos);     
    }

    //TRAER mascota POR DUENIO
    public static function traerMascotasPorDuenio($id)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM mascotas WHERE id_duenio=:id");
        $consulta->bindValue(":id",$id);
        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($datos);     
    }

   //MODIFICAR mascota
    public static function modificarMascota($id,$id_duenio,$nombre,$raza,$color,$edad,$tipo){
        $rta = false;
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE `mascotas` 
        SET `id_duenio`= :id_duenio,
        `nombre`= :nombre,
        `raza`= :raza,
        `color`= :color,
        `edad`=:edad,
        `tipo`= :tipo
        WHERE id_mascota = :id");

        $consulta->bindValue(':id',$id);
        $consulta->bindValue(':id_duenio',$id_duenio);
        $consulta->bindValue(':nombre',$nombre);
        $consulta->bindValue(':raza', $raza);
        $consulta->bindValue(':color',$color);
        $consulta->bindValue(':edad', $edad);
        $consulta->bindValue(':tipo',$tipo);

        if ($consulta->execute()){
            $rta = true;
        }
        return $rta;
    }

    //BORRAR mascota
    public static function borrarMascota($id){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("DELETE FROM mascotas WHERE id_mascota=:id");
        $consulta->bindValue(":id",$id);
        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($datos);     
    }
 
}
?>