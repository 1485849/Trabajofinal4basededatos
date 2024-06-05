<?php

namespace App\Http\Controllers;

use App\Models\AlumnoMongo;
use Illuminate\Http\Request;

class AlumnoMongoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retorna todos los alumnos almacenados en MongoDB en formato JSON
        return AlumnoMongo::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Valida los datos recibidos en la solicitud
        $request->validate([
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'email' => 'required|email|unique:alumnos,email',
        ]);

        // Crea un nuevo alumno en MongoDB con los datos recibidos
        $alumno = AlumnoMongo::create($request->all());

        // Retorna una respuesta JSON con el alumno creado y el código de estado HTTP 201 (Created)
        return response()->json($alumno, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Busca un alumno en MongoDB por su ID y lo retorna en formato JSON
        return AlumnoMongo::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Valida los datos recibidos en la solicitud
        $request->validate([
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'email' => 'required|email|unique:alumnos,email,'.$id,
        ]);

        // Encuentra un alumno en MongoDB por su ID y actualiza sus datos con los recibidos en la solicitud
        $alumno = AlumnoMongo::findOrFail($id);
        $alumno->update($request->all());

        // Retorna una respuesta JSON con el alumno actualizado y el código de estado HTTP 200 (OK)
        return response()->json($alumno, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Elimina un alumno de MongoDB por su ID
        AlumnoMongo::destroy($id);

        // Retorna una respuesta JSON vacía con el código de estado HTTP 204 (No Content)
        return response()->json(null, 204);
    }
}

