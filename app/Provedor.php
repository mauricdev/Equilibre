<?php

namespace equilibre;

use Illuminate\Database\Eloquent\Model;

class Provedor extends Model
{
      protected $table='proveedor';

    protected $primaryKey='idProveedor';
 
    public $timestamps=false;
 
 
    protected $fillable =[
       'razonsocial',
       'direccion',
       'ciudad',
       'pais',
       'telefono',
       'correo',
       'descripcion',
       'Estado',
    ];
 
    protected $guarded =[
 
    ];
}
