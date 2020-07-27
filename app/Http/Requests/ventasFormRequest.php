<?php

namespace equilibre\Http\Requests;

use equilibre\Http\Requests\Request;

class ventasFormRequest extends Request
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
            'total_venta' => 'required',
            'fecha' => 'required',
            'Persona_rut' => 'required',
        ];
    }
}
