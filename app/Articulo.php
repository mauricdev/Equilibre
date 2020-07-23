<?php

namespace equilibre;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $table='producto';

    protected $primaryKey='idproducto';
 
    public $timestamps=false;
 
 
    protected $fillable =[
       'idproducto',
       'nombre',
       'unidad_medida',
       'precio_compra',
       'precio_venta',
       'stock',
       'stock_critico',
       'imagen',
    ];
 
    protected $guarded =[
 
    ];
}
