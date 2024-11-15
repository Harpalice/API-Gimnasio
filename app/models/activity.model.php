<?php

class ActivityModel{
    private $db;
    // Abre la conexión a la base de datos
    public function __construct(){
        $this->db = new PDO('mysql:host=localhost;dbname=gimnasio_tandil;charset=utf8', 'root', '');
        
    }

    // Obtiene y devuleve de mi base de datos todas las actividades.
    function getActivities($orderBy = false){
        $sql = 'SELECT * FROM actividades';

        if($orderBy) {
            switch($orderBy) {
                case 'nombre':
                    $sql .= ' ORDER BY name_activity';
                    break;
                case 'entrenador':
                    $sql .= ' ORDER BY id_Trainer';
                    break;
            }
        }

        // 2. Ejecuto la consulta
        $query = $this->db->prepare($sql);
        $query->execute(); 

        // Obtengo los datos en un arreglo de objetos
        $activities = $query->fetchAll(PDO::FETCH_OBJ);

        return $activities;
    }
    public function getActivity($id) {    
        $query = $this->db->prepare('SELECT * FROM actividades WHERE id_Activity = ?');
        $query->execute([$id]);   
    
        $activity = $query->fetch(PDO::FETCH_OBJ);
    
        return $activity;
    }


    // Inserta la actividad en la base de datos
    function insertActivity($nameActivity, $duration, $capacityMax, $id_Trainer){
        // 2. Enviar la consulta (2 sub-pasos) prepare y execute
        $query = $this->db->prepare('INSERT INTO actividades (name_activity, duration, capacity_max, id_Trainer) VALUES(?,?,?,?)');
        $query->execute([$nameActivity, $duration, $capacityMax, $id_Trainer]);

        // 3. Obtengo y devuelvo el último id que se insertó
        $id = $this->db->lastInsertId();
        return $id;
    }

  
    function deleteActivity($id_Activity) {

        $query = $this->db->prepare('DELETE FROM actividades WHERE id_Activity = ?');
        $query->execute([$id_Activity]);
    }

    // Actualiza a la tarea
    function updateActivity($id, $nombre, $duracion, $capacidadMaxima, $id_trainer){
        $query = $this->db->prepare('UPDATE actividades SET name_Activity = ?, duration = ?, capacity_max = ?, id_Trainer = ? WHERE id_Activity = ?'); //Ésto me define qué tarea quiero modificar
        $query->execute([$nombre, $duracion, $capacidadMaxima, $id_trainer,$id]);
}
}