<?php

namespace equilibre\Http\Controllers;

use Illuminate\Http\Request;

use equilibre\Http\Requests;

use equilibre\Flow;

class FlowController extends Controller
{
    public function pago()
    {
        //$idventa = Ventas::latest('idventa')->first();
        //$idventa++;
        //return view('pago.index',['idventa' => $idventa]);
        return view('pago');
    }





    /**
     * Creando una nueva Orden
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function orden(Request $request)
    {
        /*$optional = [
            "rut" => "19677005-4",
        ];*/
        
        $orden = [
            //SEGUIR EL ORDEN Y NOMBRE DE CLAVES COMO SE MUESTRA A CONTINUACION
            'commerceOrder'  => $request->orden,
            'subject'      => $request->concepto,
            'amount'         => $request->monto,
            'email' => $request->pagador,
            //'optional' => $optional
            // Opcional: El medio de pago correspondera al ubicado en la configuracion
        ];

        // Genera una nueva Orden de Pago, Flow la firma y retorna un paquete de datos firmados
        $orden_generada = Flow::GenerateFlowOrder($orden);

        // Si desea enviar el medio de pago usar la siguiente línea
        //$orden['flow_pack'] = Flow::new_order($orden['orden_compra'], $orden['monto'], $orden['concepto'], $orden['email_pagador'], $orden['medio_pago']);
        //dd( $orden_generada);
        return view('orden')->with(['order'=>$orden_generada]);
    }



    /**
     * Página de éxito del Comercio
     *
     * Esta página será invocada por Flow cuando la transacción resulte exitosa
     * y el usuario presione el botón para retornar al comercio desde Flow.
     *
     * @return \Illuminate\View\View
     */
    public function exito(Request $request)
    {
        // Lee los datos enviados por Flow
        $GetFlowOrder = \Flow::getStatus($request->token);

        // Recupera los datos enviados por Flow
        // Lista completa del retorno de datos: https://www.flow.cl/docs/api.html#tag/payment/paths/~1payment~1getStatus/get
        $orden = [
            'flowOrder'     => $GetFlowOrder->flowOrder,
            'commerceOrder' => $GetFlowOrder->commerceOrder,
            'subject'       => $GetFlowOrder->subject,
            'payer'         => $GetFlowOrder->payer,
        ];

        return view('flow.exito')->with(["FlowOrder" => $orden]);
    }
    

    /**
     * Página de fracaso del Comercio
     *
     * Esta página será invocada por Flow cuando la transacción no se logre pagar
     * y el usuario presione el botón para retornar al comercio desde Flow.
     *
     * @return \Illuminate\View\View
     */
    public function fracaso()
    {
        // Lee los datos enviados por Flow
        Flow::read_result();

        // Recupera los datos enviados por Flow
        $orden = [
            'orden_compra'  => Flow::getOrderNumber(),
            'monto'         => Flow::getAmount(),
            'concepto'      => Flow::getConcept(),
            'email_pagador' => Flow::getPayer(),
            'flow_orden'    => Flow::getFlowNumber(),
        ];

        return view('flow.fracaso', $orden);
    }


     /**
     * Página de confirmación del Comercio
     *
     * @return void
     */
    public function confirmacion()
    {
        try {
            // Lee los datos enviados por Flow
            Flow::read_confirm();
        } catch (Exception $e) {
            // Si hay un error responde false
            echo Flow::build_response(false);
            return;
        }

        // Recupera los valores de la Orden
        $flow_status  = Flow::getStatus();      // El resultado de la transacción (EXITO o FRACASO)
        $orden_numero = Flow::getOrderNumber(); // N° de Orden del Comercio
        $monto        = Flow::getAmount();      // Monto de la transacción
        $orden_flow   = Flow::getFlowNumber();  // Si $flow_status = 'EXITO' el N° de Orden de Flow
        $pagador      = Flow::getPayer();       // El email del pagador

        /**
         * Aquí puede validar la Orden
         *
         * Si acepta la Orden responder Flow::build_response(true)
         * Si rechaza la Orden responder Flow::build_response(false)
         */
        if ($flow_status == 'EXITO') {
            // La transacción fue aceptada por Flow
            // Aquí puede actualizar su información con los datos recibidos por Flow
            echo Flow::build_response(true); // Comercio acepta la transacción
        } else {
            // La transacción fue rechazada por Flow
            // Aquí puede actualizar su información con los datos recibidos por Flow
            echo Flow::build_response(false); // Comercio rechaza la transacción
        }
    }


    

    public function retorno(Request $request){
        $response = Flow::getStatus($request->token);
        //dd($response);
        if($response->status!=2){
            $orden = [
                'orden_compra'  => $response->flowOrder,
                'monto'         => $response->amount,
                'concepto'      => $response->subject,
                'email_pagador' => $response->payer,
                'flow_orden'    => $response->flowOrder,
                'estado'        => $response->status,
            ];
            return view('flow.fracaso', $orden);
        }else{
            $orden = [
                'flowOrder'     => $response->flowOrder,
                'commerceOrder' => $response->commerceOrder,
                'amount'        => $response->amount,
                'subject'       => $response->subject,
                'payer'         => $response->payer,
            ];
            return view('flow.exito')->with(["FlowOrder" => $orden]);
        }
        dd($response->status);
    }
}
