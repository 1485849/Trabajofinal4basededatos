<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class AlumnoMongo extends Eloquent
{
    protected $connection = 'mongodb'; // Nombre de la conexión definida en config/database.php
    protected $collection = 'alumnos'; // Nombre de la colección en MongoDB
    protected $fillable = ['nombre', 'apellido', 'email'];
}
