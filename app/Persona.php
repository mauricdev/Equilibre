<?php

namespace equilibre;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table='persona';

    protected $primaryKey='rut';
 
    public $timestamps=false;
 
 
    protected $fillable =[
        'rut',
       'nombre',
       'apellidos',
       'correo',
       'direccion',
       'ciudad',
       'telefono', 
    ];
 
    protected $guarded =[
 
    ];
}
