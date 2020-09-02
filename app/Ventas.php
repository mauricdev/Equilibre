<?php

namespace equilibre;

use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    protected $table='venta';

    protected $primaryKey='idventa';
 
    public $timestamps=false;
    
    protected $hidden = ['token','Estado','fechaHora'];
 
    protected $fillable =[
        'idventa',
        'total_venta',
        'persona_rut1', 
    ];
    protected $dateFormat = 'Y-m-d';
    protected $guarded =[
 
    ];
    protected $casts = [
        'fechaHora' => 'date:Y-m-d',
    ];
}
