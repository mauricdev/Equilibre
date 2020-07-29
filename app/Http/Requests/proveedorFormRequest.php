<?php

namespace equilibre\Http\Requests;

use equilibre\Http\Requests\Request;

class proveedorFormRequest extends Request
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
            'idproveedor' => 'required|max:50',
            'razonsocial' => 'required|max:50',
            'direccion' => 'required|max:50',
            'ciudad' => 'required|max:50',
            'pais' => 'required|max:50',
            'telefono' => 'required|max:50',
            'correo' => 'required|max:50',
            'descripcion' => 'required|max:200',
        ];
    }
}
