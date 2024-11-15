<?php
require_once './app/models/activity.model.php';
require_once './app/views/json.view.php';
require_once './libs/request.php';

class ApiActivityController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new ActivityModel();
        $this->view = new JSONView();
    }

    // /api/actividades
    public function obtenerActividades($req, $res) {
        $orderBy = false;
        if(isset($req->query->orderBy))
            $orderBy = $req->query->orderBy;


        // Obtengo las actividades de la DB
        $activities = $this->model->getActivities($orderBy);
        
        // Mando las actividades a la vista
        return $this->view->response($activities);
    }

    // /api/actividades/:id
    public function obtenerActividad($req, $res) {
        // obtengo el id de la acctividad desde la ruta
        $id = $req->params->id;

        // obtengo la actividad de la DB
        $activity = $this->model->getActivity($id);

        // Tirar error 404 en caso de que no exista la actividad
        if(!$activity) {
            return $this->view->response("La actividad con el id=$id no existe", 404);
        }

        // mando la actividad a la vista
        return $this->view->response($activity);
    }

    // api/tareas/:id (DELETE)
    /*public function delete($req, $res) {
        $id = $req->params->id;

        $task = $this->model->getTask($id);

        if (!$task) {
            return $this->view->response("La tarea con el id=$id no existe", 404);
        }

        $this->model->eraseTask($id);
        $this->view->response("La tarea con el id=$id se eliminó con éxito");
    }*/

    // api/actividades (POST)
    public function crearActividad($req, $res) {
        
        // valido los datos
        if (empty($req->body->name_activity) || empty($req->body->duration) || empty($req->body->capacity_max) || empty($req->body->id_Trainer)) {
            return $this->view->response('Faltan completar datos', 400);
        }  

        // obtengo los datos
        $nombre = $req->body->name_activity;       
        $duracion = $req->body->duration;       
        $capacidadMaxima = $req->body->capacity_max;
        $id_trainer = $req->body->id_Trainer; 

        // inserto los datos
        $id = $this->model->insertActivity($nombre, $duracion, $capacidadMaxima, $id_trainer);

        if (!$id) {
            return $this->view->response("Error al insertar actividad", 500);
        }
        // Devuelve el recurso insertado
        $activity = $this->model->getActivity($id);
        return $this->view->response($activity, 201);
    }

    // api/actividades/:id (PUT)
    public function actualizarActividad($req, $res) {
        $id = $req->params->id;

        // verifico que exista
        $activity = $this->model->getActivity($id);
        if (!$activity) {
            return $this->view->response("La tarea con el id=$id no existe", 404);
        }

         // valido los datos
         if (empty($req->body->name_activity) || empty($req->body->duration) || empty($req->body->capacity_max) || empty($req->body->id_Trainer)) {
            return $this->view->response('Faltan completar datos', 400);
        }

        // obtengo los datos
        $nombre = $req->body->name_activity;       
        $duracion = $req->body->duration;       
        $capacidadMaxima = $req->body->capacity_max;
        $id_trainer = $req->body->id_Trainer;

        // actualiza la actividad
        $this->model->updateActivity($id, $nombre, $duracion, $capacidadMaxima, $id_trainer);

        // obtengo la actividad modificada y la devuelvo en la respuesta
        $activity = $this->model->getActivity($id);
        $this->view->response($activity, 200);
    }

}
