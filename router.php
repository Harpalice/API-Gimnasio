<?php
    require_once 'libs/router.php';
    require_once './app/controllers/activity.api.controller.php';
    require_once './app/views/json.view.php';
    $router = new Router();

    //$router->addMiddleware(new JWTAuthMiddleware());

    #                 endpoint                        verbo      controller                  metodo
    $router->addRoute('actividades'      ,            'GET',     'ApiActivityController',   'obtenerActividades');
    $router->addRoute('actividades/:id'  ,            'GET',     'ApiActivityController',   'obtenerActividad'   );
    $router->addRoute('actividades'      ,            'POST',    'ApiActivityController',   'crearActividad');
    $router->addRoute('actividades/:id'  ,            'DELETE',  'ApiActivityController',   'eliminarActividad');
    $router->addRoute('actividades/:id'  ,            'PUT',     'ApiActivityController',   'actualizarActividad');

    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
