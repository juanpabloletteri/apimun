<?php

class turno {

    private $_id_turno;
    private $_id_mascota;
    private $_fecha;
    private $_observaciones;


    //AGREGAR Turno
    public static function agregarTurno($id_mascota,$fecha,$observaciones)
    {
        $rta = false;
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into  
        turnos (id_mascota,fecha,observaciones)
        values(:id_mascota,:fecha,:observaciones)");

        $consulta->bindValue(':id_mascota',$id_mascota);
        $consulta->bindValue(':fecha', $fecha);
        $consulta->bindValue(':observaciones',$observaciones);
        
        if($consulta->execute()){
            $rta = $objetoAccesoDato->RetornarUltimoIdInsertado();
        }
        return $rta; 
    }    

    //TRAER TODOS LOS turnos
    public static function traerTodosLosTurnos()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * 
        FROM turnos AS t, mascotas AS m
        WHERE t.id_mascota=m.id_mascota
        ");
        $consulta->execute();
        $consulta = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($consulta);
    }

    //TRAER Turno POR ID
    public static function traerTurnoPorIdDuenio($id)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * 
        FROM turnos AS t, mascotas AS m
        WHERE t.id_mascota=m.id_mascota
        AND m.id_duenio=:id
        ");
        $consulta->bindValue(":id",$id);
        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($datos);     
    }

    //TRAER Turnos POR MASCOTA
    public static function traerTurnosPorMascota($id)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM turnos WHERE id_mascota=:id");
        $consulta->bindValue(":id",$id);
        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($datos);     
    }

    //TRAER Turnos POR MASCOTA
    public static function traerTurnosPorTipoDeMascota($tipo)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * 
        FROM turnos AS t, mascotas AS m 
        WHERE m.tipo = :tipo
        AND m.id_mascota = t.id_mascota");


        $consulta->bindValue(":tipo",$tipo);
        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($datos);     
    }

   //MODIFICAR Turno
    public static function modificarTurno($id,$id_mascota,$fecha,$observaciones){
        $rta = false;
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE `turnos` 
        SET `id_mascota`= :id_mascota,
        `fecha`= :fecha,
        `observaciones`= :observaciones
        WHERE id_turno = :id");

        $consulta->bindValue(':id',$id);
        $consulta->bindValue(':id_mascota',$id_mascota);
        $consulta->bindValue(':fecha', $fecha);
        $consulta->bindValue(':observaciones',$observaciones);

        if ($consulta->execute()){
            $rta = true;
        }
        return $rta;
    }

    //BORRAR Turno
    public static function borrarTurno($id){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("DELETE FROM turnos WHERE id_turno=:id");
        $consulta->bindValue(":id",$id);
        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($datos);     
    }
 
}
?>