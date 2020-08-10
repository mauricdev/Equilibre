<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Ingrese aquí la URL de su página de éxito
    |--------------------------------------------------------------------------
    |
    | Valores posibles:
    | 'http://www.comercio.cl/kpf/exito.php',
    | ['url' => 'flow/exito'],
    | ['route' => 'flow.exito'],
    | ['action' => 'FlowController@exito'],
    |
    */

    'url_exito' => ['route' => 'flow.exito'],

    /*
    |--------------------------------------------------------------------------
    | Ingrese aquí la URL de su página de fracaso
    |--------------------------------------------------------------------------
    |
    | Valores posibles:
    | 'http://www.comercio.cl/kpf/fracaso.php',
    | ['url' => 'flow/fracaso'],
    | ['route' => 'flow.fracaso'],
    | ['action' => 'FlowController@fracaso'],
    |
    */

    'url_fracaso' => ['route' => 'flow.fracaso'],

    /*
    |--------------------------------------------------------------------------
    | Ingrese aquí la URL de su página de confirmación
    |--------------------------------------------------------------------------
    |
    | Valores posibles:
    | 'http://www.comercio.cl/kpf/confirmacion.php',
    | ['url' => 'flow/confirmacion'],
    | ['route' => 'flow.confirmacion'],
    | ['action' => 'FlowController@confirmacion'],
    |
    */

    'url_confirmacion' => ['route' => 'flow.confirmacion'],

    /*
    |--------------------------------------------------------------------------
    | Ingrese aquí la URL de su página de retorno
    |--------------------------------------------------------------------------
    |
    | Valores posibles:
    | 'http://www.comercio.cl',
    | ['url' => 'flow/retorno'],
    | ['route' => 'flow.retorno'],
    | ['action' => 'FlowController@retorno'],
    |
    */

    'url_retorno' => ['url' => '/flow/retorno'],

    /*
    |--------------------------------------------------------------------------
    | Ingrese aquí la página API a usar
    |--------------------------------------------------------------------------
    |
    | Ejemplo:
    | Sitio de pruebas = https://sandbox.flow.cl/api
    | Sitio de producción = https://flow.cl/api
    |
    */

    'url_api' => env('FLOW_URL_API', 'https://sandbox.flow.cl/api'),

    /*
    |--------------------------------------------------------------------------
    | Ingrese aquí la página de pago de Flow
    |--------------------------------------------------------------------------
    |
    | Ejemplo:
    | Sitio de pruebas = https://sandbox.flow.cl/app/web/pay.php
    | Sitio de producción = https://flow.cl/app/web/pay.php
    |
    */

    'url_pago' => env('FLOW_URL_PAGO', 'https://sandbox.flow.cl/app/web/pay.php'),

    /*
    |--------------------------------------------------------------------------
    | Ingrese aquí sus llaves otorgadas por FLOW
    |--------------------------------------------------------------------------
    */

    'api_key' => env('FLOW_API_KEY', ''),
    'secret_key' => env('FLOW_SECRET_KEY', ''),

    /*
    |--------------------------------------------------------------------------
    | Ingrese aquí la ruta (path) de su sitio en donde estarán los archivos de logs
    |--------------------------------------------------------------------------
    */

    'logPath' => storage_path('logs'),

    /*
    |--------------------------------------------------------------------------
    | Ingrese aquí el email con el que está registrado en Flow
    |--------------------------------------------------------------------------
    */

    'comercio' => env('FLOW_COMERCIO', 'contacto@ukader.net'),

    /*
    |--------------------------------------------------------------------------
    | Ingrese aquí el medio de pago
    |--------------------------------------------------------------------------
    |
    | Valores posibles:
    | Solo Webpay = 1
    | Solo Servipag = 2
    | Solo Multicaja = 3
    | Todos los medios de pago = 9
    |
    */

    'medioPago' => '9',

    /*
    |--------------------------------------------------------------------------
    | Ingrese aquí el modo de acceso
    |--------------------------------------------------------------------------
    |
    | Valores posibles:
    | Mostrar pasarela Flow = f
    | Ingresar directamente al medio de pago = d
    |
    */

    'tipo_integracion' => 'f',

];

