<?php

namespace equilibre;

use Illuminate\Database\Eloquent\Model;

class detalle_ingeso extends Model
{
    protected $table='detalle_ingreso';

    protected $primaryKey='ingreso_idingreso';
 
    public $timestamps=false;
 
 
    protected $fillable =[
       'cantidad', 
       'precio_compra',
    ];
 
    protected $guarded =[
 
    ];
}
