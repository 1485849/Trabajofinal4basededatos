<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retorna todos los alumnos en formato JSON
        return Alumno::all();
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

        // Crea un nuevo alumno con los datos recibidos
        $alumno = Alumno::create($request->all());

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
        // Busca un alumno por su ID y lo retorna
        return Alumno::findOrFail($id);
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

        // Encuentra el alumno por su ID y actualiza sus datos con los recibidos en la solicitud
        $alumno = Alumno::findOrFail($id);
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
        // Busca y elimina un alumno por su ID
        Alumno::destroy($id);

        // Retorna una respuesta JSON vacía con el código de estado HTTP 204 (No Content)
        return response()->json(null, 204);
    }
}
