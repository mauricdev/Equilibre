<?php

namespace equilibre;

use Illuminate\Database\Eloquent\Model;

class detalle_venta extends Model
{
    protected $table='detalle_venta';

    protected $primaryKey='venta_idventa';
 
    public $timestamps=false;
 
 
    protected $fillable =[
       'cantidad', 
       'precio_unitario',
       'precio_total', 
    ];
 
    protected $guarded =[
 
    ];
}
