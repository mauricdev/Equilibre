<?php

namespace equilibre\Http\Requests;

use equilibre\Http\Requests\Request;

class ingresoFormRequest extends Request
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
            'fechaHora' => 'required|max:100',
            'tipoComprobante' => 'required|max:100',
            'numeroComprobante' => 'required|max:100',
        ];
    }
}
