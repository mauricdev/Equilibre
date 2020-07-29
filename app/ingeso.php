<?php

namespace equilibre;

use Illuminate\Database\Eloquent\Model;

class ingeso extends Model
{
    protected $table='ingreso';

    protected $primaryKey='idingreso';
 
    public $timestamps=false;
 
 
    protected $fillable =[
       'fechaHora', 
       'tipoComprobante',
       'numeroComprobante', 
    ];
 
    protected $guarded =[
 
    ];
}
