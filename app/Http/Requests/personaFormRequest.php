<?php

namespace equilibre\Http\Requests;

use equilibre\Http\Requests\Request;

class personaFormRequest extends Request
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
            'rut' => 'max:50',
            'nombre' => 'required|max:50',
            'apellidos' => 'required|max:50',
            'correo' => 'required|max:50',
            'direccion' => 'required|max:50',
            'ciudad' => 'required|max:50',
            'telefono' => 'required|max:50',
        ];
    }
}
