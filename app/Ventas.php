<?php

namespace equilibre;

use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    protected $table='venta';

    protected $primaryKey='idventa';
 
    public $timestamps=false;
 
 
    protected $fillable =[
       'total_venta',
       'fecha',
       'Persona_rut', 
    ];
 
    protected $guarded =[
 
    ];
}
