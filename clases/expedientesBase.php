<?php

class expedientesBase {

    private $_id_mascota;
    private $_id_duenio;
    private $_nombre;
    private $_raza;
    private $_color;
    private $_edad;
    private $_tipo;

    
    //AGREGAR mascota
    public static function agregarExpediente($tipo,$numero,$anio,$iniciador,$caratula)
    {
        $rta = false;
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into  
        exp (tipo,numero,anio,iniciador,caratula)
        values(:tipo,:numero,:anio,:iniciador,:caratula)");

        $consulta->bindValue(':tipo',$tipo);
        $consulta->bindValue(':numero',$numero);
        $consulta->bindValue(':anio', $anio);
        $consulta->bindValue(':iniciador', $iniciador);
        $consulta->bindValue(':caratula', $caratula);
        
        if($consulta->execute()){
            $rta = $objetoAccesoDato->RetornarUltimoIdInsertado();
        }
        return $rta; 
    }    

    //TRAER TODOS LOS mascotas
    public static function traerTodosLosExpedientes()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM exp");
        $consulta->execute();
        $consulta = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($consulta);
    }

    //TRAER mascota POR ID
    public static function traerExpedientePorId($id)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM exp WHERE id_exp=:id");
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