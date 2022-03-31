<?php
//controlador alumno / acción sería index, show...
//controlador es el objeto, entidad, es la clase
//acción es el método
if (isset($_SESSION['rol']) && $_SESSION['rol'] == 1) {
    $controllers=array(
        'alumno'=>['index','show','save','update','delete','error', 'register', 'existe', 'logout', 'showI'],
        'redirect' => ['login']
    );
}else {
    if (isset($_SESSION['rol']) && $_SESSION['rol'] == 0) {
        $controllers=array(
            'alumno'=>['index','save','update','delete','error', 'register', 'existe', 'logout', 'showI'],
            'redirect' => ['login', 'show']
    );
}else{
    echo '<p class="position-absolute top-500 start-50 translate-middle" id="sesion" style="top: 400px">Inicia sesión para acceder a todas las funciones !</p>';
    $controllers=array(
        'alumno'=>['index','save','delete','error', 'register', 'existe', 'logout', 'login'],
        'redirect' => ['show', 'showI', 'update']
    );
}
}

// $controllers=array(
//     'alumno'=>['index','show','save','update','delete','error', 'register', 'login', 'existe', 'logout']
// );

if (array_key_exists($controller,$controllers)) {
    # code...
    if (in_array($action,$controllers[$controller])) {
        call($controller,$action);
    }
    else {
        if (in_array($action,$controllers['redirect'])) {
            call($controller,'redirect');
        }else{
            call($controller,'error');
        }
        
    }
}
else  {
    call($controller,'error');
}

function call($controller,$action){
    require_once('Controllers/'.$controller.'Controller.php');
    switch ($controller) {
        case 'alumno':
            # code...
            // echo "<h3>estoy en alumno</h3>";
            require_once('Model/Alumno.php');
            $controller = new AlumnoController();
            break;
    }
    $controller->{$action}();
}

