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
       'persona_rut1', 
    ];
 
    protected $guarded =[
 
    ];
}
