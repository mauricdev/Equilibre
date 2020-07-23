<?php

namespace equilibre\Http\Requests;

use equilibre\Http\Requests\Request;

class ArticuloFormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'idproducto' => 'required|max:50',
            'nombre' => 'required|max:50',
            'unidad_medida' => 'required|max:100',
            'precio_compra' => 'required|numeric',
            'precio_venta' => 'required|numeric',
            'stock' => 'required|numeric',
            'stock_critico' => 'required|numeric',
            'imagen' => 'mimes:jpeg,bmp,png',
            'categoria_idcategoria' => 'required',
            'Proveedor_idProveedor' => 'required',
        ];
    }
}
