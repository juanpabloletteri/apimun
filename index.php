<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once './vendor/autoload.php';
require_once './clases/AccesoDatos.php';
require_once './clases/AutentificadorJWT.php';

//nuevos
require_once './clases/psicologo.php';

//viejos
require_once './clases/usuario.php';
require_once './clases/mascota.php';
require_once './clases/turno.php';

require_once './clases/expedientesBase.php';


$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

/*

¡La primera línea es la más importante! A su vez en el modo de 
desarrollo para obtener información sobre los errores
 (sin él, Slim por lo menos registrar los errores por lo que si está utilizando
  el construido en PHP webserver, entonces usted verá en la salida de la consola 
  que es útil).

  La segunda línea permite al servidor web establecer el encabezado Content-Length, 
  lo que hace que Slim se comporte de manera más predecible.
*/

$app = new \Slim\App(["settings" => $config]);


$app->get('[/]', function (Request $request, Response $response) {    
    $response->getBody()->write("GET => Bienvenido!!! ,a SlimFramework");
    return $response;

});

//************ LOGIN ************//
$app->post('/login', function (Request $request, Response $response) {
    $datos = $request->getParsedBody();
    $usuario = $datos["usuario"];
    $password = $datos["password"];
    $newResponse = $response->withJson(Usuario::Login($usuario,$password));
    //$response->write($pw);
    return $newResponse;
});

//************ AUTENTICACION ************//
$mdwAuth = function ( $request, $response, $next) {
    $token = $request->getHeader('token');
    if(AutentificadorJWT::verificarToken($token[0])){
        $response = $next($request,$response);
    }  
    return $response;
};

//************ TOKEN ************//
$app->post('/crearToken', function (Request $request, Response $response) {
    $datos = $request->getParsedBody();
    //$datos = array('usuario' => 'rogelio@agua.com','perfil' => 'profe', 'alias' => "PinkBoy");
    $token= AutentificadorJWT::CrearToken($datos); 
    $newResponse = $response->withJson($token, 200); 
    return $newResponse;
});


////revisar!
$app->post('/leerHeader', function (Request $request, Response $response) {
    $datos = $request->getParsedBody();
    $header = $request->getHeader('miHeader');
    $leido = AutentificadorJWT::ObtenerPayLoad($header);
    var_dump($leido);
    $newResponse = $response->withJson($header, 200); 
    return $newResponse;
});

$app->post('/traerPsicologo',function ($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $response->write(psicologo::traerPsicologo($id));
    return $response;
 }); //})->add($mdwAuth);






















//**************///////////////////////////////////////******************//

/////PARA EL PROFESOR
//TRAER USUARIO POR ID *************************/
$app->post('/traerUsuarioPorTipo',function ($request,$response){
    $datos = $request->getParsedBody();
    $tipo = $datos['tipo'];
    $response->write(usuario::traerUsuarioPorTipo($tipo));
    return $response;
});


///////////////////////////////////////////////////////////////////////
//************ EXPEDIENTES  ************//

//AGREGAR Mascota  *************************/
$app->post('/agregarExpediente',function($request,$response){
    $datos = $request->getParsedBody();
    $tipo = $datos['tipo'];
    $numero = $datos['numero'];
    $anio = $datos['anio'];
    $fecha = $datos['fecha'];
    $tema = $datos['tema'];
    $direccion = $datos['direccion'];
    $localidad = $datos['localidad'];
    $iniciador = $datos['iniciador'];
    $caratula = $datos['caratula'];
    $id_usuario = $datos['id_usuario'];
    $id_oficina = $datos['id_oficina'];
    $response->write(expedientesBase::agregarExpediente($tipo,$numero,$anio,$fecha,$tema,$direccion,$localidad,$iniciador,$caratula,$id_usuario,$id_oficina));
 }); //})->add($mdwAuth);

//TRAER TODOS LOS Expedientes *************************/
$app->get('/traerTodosLosExpedientes',function ($request,$response){
    $response->write(expedientesBase::traerTodosLosExpedientes());
    return $response;
});
// }); //})->add($mdwAuth);

//TRAER TODOS LOS Expedientes *************************/
$app->get('/traerTodosLosExpedientesConUsuario',function ($request,$response){
    $response->write(expedientesBase::traerTodosLosExpedientesConUsuario());
    return $response;
});
// }); //})->add($mdwAuth);

//TRAER Mascota POR ID *************************/
$app->post('/traerExpedientePorId',function ($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $response->write(expedientesBase::traerExpedientePorId($id));
    return $response;
 }); //})->add($mdwAuth);










///////////////////////////////////////////////////////////////////////
//************ USUARIOS ************//

//VERIFICAR MAIL  *************************/
$app->post('/verificarMail',function($request,$response){
    $datos = $request->getParsedBody();
    $mail = $datos['mail'];
    $response->write(usuario::verificarMail($mail));
});

//AGREGAR USUARIO  *************************/
$app->post('/agregarUsuario',function($request,$response){
    $datos = $request->getParsedBody();
    $mail = $datos['mail'];
    $password = $datos['password'];
    $nombre = $datos['nombre'];
    $apellido = $datos['apellido'];
    $tipo = $datos['tipo'];
    if(usuario::verificarMail($mail)){
        $response->write(usuario::agregarUsuario($mail,$password,$nombre,$apellido,$tipo));
    }
    else{
        $newResponse = $response->withJson('Mail en uso');
        return $newResponse;
    }
    
});

//TRAER TODOS LOS USUARIOS *************************/
$app->get('/traerTodosLosUsuarios',function ($request,$response){
    $response->write(usuario::traerTodosLosUsuarios());
    return $response;
 }); // }); //})->add($mdwAuth);

//TRAER USUARIO POR ID *************************/
$app->post('/traerUsuarioPorId',function ($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $response->write(usuario::traerUsuarioPorId($id));
    return $response;
 }); //})->add($mdwAuth);

//MODIFICAR USUARIO *************************/
$app->post('/modificarUsuario',function($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $mail = $datos['mail'];
    $password = $datos['password'];
    $nombre = $datos['nombre'];
    $apellido = $datos['apellido'];
    $tipo = $datos['tipo'];
    $response->write(usuario::modificarUsuario($id,$mail,$password,$nombre,$apellido,$tipo));

    return $response;
 }); //})->add($mdwAuth);

//BORRAR USUARIO *************************/
$app->post('/borrarUsuario',function ($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $response->write(usuario::borrarUsuario($id));
    return $response;
 }); //})->add($mdwAuth);

///////////////////////////////////////////////////////////////////////
//************ MASCOTAS ************//

//AGREGAR Mascota  *************************/
$app->post('/agregarMascota',function($request,$response){
    $datos = $request->getParsedBody();
    $id_duenio = $datos['id_duenio'];
    $nombre = $datos['nombre'];
    $raza = $datos['raza'];
    $color = $datos['color'];
    $edad = $datos['edad'];
    $tipo = $datos['tipo'];
    $response->write(mascota::agregarMascota($id_duenio,$nombre,$raza,$color,$edad,$tipo));
 }); //})->add($mdwAuth);

//TRAER TODOS LOS Mascotas *************************/
$app->get('/traerTodasLasMascotas',function ($request,$response){
    $response->write(mascota::traerTodasLasMascotas());
    return $response;
});
// }); //})->add($mdwAuth);

//TRAER Mascota POR ID *************************/
$app->post('/traerMascotaPorId',function ($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $response->write(mascota::traerMascotaPorId($id));
    return $response;
 }); //})->add($mdwAuth);

//TRAER Mascota POR DUENIO *************************/
$app->post('/traerMascotasPorDuenio',function ($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $response->write(mascota::traerMascotasPorDuenio($id));
    return $response;
 }); //})->add($mdwAuth);

//MODIFICAR Mascota *************************/
$app->post('/modificarMascota',function($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $nombre = $datos['nombre'];
    $raza = $datos['raza'];
    $color = $datos['color'];
    $edad = $datos['edad'];
    $tipo = $datos['tipo'];
    $response->write(mascota::modificarMascota($id,$nombre,$raza,$color,$edad,$tipo));

    return $response;
 }); //})->add($mdwAuth);

//BORRAR Mascota *************************/
$app->post('/borrarMascota',function ($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $response->write(mascota::borrarMascota($id));
    return $response;
 }); //})->add($mdwAuth);

//**********************************//

//************ Turnos ************//

//AGREGAR Turno  *************************/
$app->post('/agregarTurno',function($request,$response){
    $datos = $request->getParsedBody();
    $id_mascota = $datos['id_mascota'];
    $fecha = $datos['fecha'];
    $observaciones = $datos['observaciones'];
    $response->write(turno::agregarTurno($id_mascota,$fecha,$observaciones));
 }); //})->add($mdwAuth);

//TRAER TODOS LOS Turnos *************************/
$app->get('/traerTodosLosTurnos',function ($request,$response){
    $response->write(turno::traerTodosLosTurnos());
    return $response;
 }); //})->add($mdwAuth);

//TRAER Turno POR ID *************************/
$app->post('/traerTurnoPorIdDuenio',function ($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $response->write(turno::traerTurnoPorIdDuenio($id));
    return $response;
 }); //})->add($mdwAuth);

//TRAER Turno POR MASCOTA *************************/
$app->post('/traerTurnosPorMascota',function ($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $response->write(turno::traerTurnosPorMascota($id));
    return $response;
 }); //})->add($mdwAuth);

//TRAER Turno POR TIPO DE MASCOTA *************************/
$app->post('/traerTurnosPorTipoDeMascota',function ($request,$response){
    $datos = $request->getParsedBody();
    $tipo = $datos['tipo'];
    $response->write(turno::traerTurnosPorTipoDeMascota($tipo));
    return $response;
 }); //})->add($mdwAuth);

//MODIFICAR Turno *************************/
$app->post('/modificarTurno',function($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $id_mascota = $datos['id_mascota'];
    $fecha = $datos['fecha'];
    $observaciones = $datos['observaciones'];
    $response->write(turno::modificarTurno($id,$id_mascota,$fecha,$observaciones));

    return $response;
 }); //})->add($mdwAuth);

//BORRAR Turno *************************/
$app->post('/borrarTurno',function ($request,$response){
    $datos = $request->getParsedBody();
    $id = $datos['id'];
    $response->write(turno::borrarTurno($id));
    return $response;
 }); //})->add($mdwAuth);

//**********************************//

$app->run();
