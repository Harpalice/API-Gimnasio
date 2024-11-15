# Gimnasio_web2

## Integrantes:

* Cantero Gomez, Pablo Eduardo.
* Flores Depietri, Victoria.

## Descripción

El sistema es una API REST diseñada para la gestión de actividades en un entorno basado en el patrón MVC (Modelo-Vista-Controlador). Proporcionando endpoints bien definidos para interactuar con los datos.

### Endpoints

---

- **GET** `/api/actividades`
    Devuelve todos los boletos disponibles en la base de datos, permitiendo opcionalmente aplicar ordenamiento a los resultados.

    - **Ordenamiento**:  
      - `orderBy`: Campo por el que se desea ordenar los resultados. Los campos válidos pueden incluir:
        - `nombre`: Ordena las actividades por nombre.
        - `entrenadores`: Ordena las actividades por el id de entrenadores.

        **Ejemplo de Ordenamiento**:  
      Para obtener todos las actiidades ordenados por nombre en orden alfabético:
      ```http
      GET api/actividades?orderBy=nombre
      ```

---

- **GET** `/api/actividades/:id`  
  Devuelve la actividad correspondiente al `id` solicitado.

---

- **POST** `/api/actividades`  
  Inserta una nueva actividad con la información proporcionada en el cuerpo de la solicitud (en formato JSON).

  - **Campos requeridos**:  
    - `name_activity`: Nombre de la actividad.  
    - `duration`:  Duracion de la actividad.  
    - `capacity_max`: Capacidad maxima de la actividad.  
    - `id_Trainer`: Id del entrenador que imparte la clase.

  > **Nota**: El campo `id` se genera automáticamente y no debe incluirse en el JSON.

---

- **PUT** `/api/actividades/:id`  
  Modifica la actividad correspondiente al `id` solicitado. La información a modificar se envía en el cuerpo de la solicitud (en formato JSON).

  - **Campos modificables**:  
    - `name_activity`  
    - `duration`  
    - `capacity_max`  
    - `id_Trainer`

---

## DER
![DER](./DER.png)
