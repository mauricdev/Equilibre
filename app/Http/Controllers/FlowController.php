<?php

namespace equilibre\Http\Controllers;

use Illuminate\Http\Request;

use equilibre\Http\Requests;

use equilibre\Flow;

use equilibre\Cart;

use equilibre\Persona;

use Session;

use equilibre\Ventas;
use Illuminate\Support\Facades\Redirect;
use equilibre\Http\Requests\ventasFormRequest;
use DB;
use equilibre\detalle_venta;
use Response;

class FlowController extends Controller
{
    public function pago(Request $request)
    {
        
        $carro = Session::get('cart');
        
        if ($carro==null || $request->rut==null){
            return view('almacen.tienda.carro-compra');
        }
        $rut = $request->rut;
        $email = "";
        $nombre = "";
        $apellido = "";
        $direccion = "";
        $pais = "";
        $ciudad = "";
        $telefono = "";
        
        $p = Persona::find($rut);
        if($p!=null){
            $email = $p->correo;
            $nombre = $p->nombre;
            $apellido = $p->apellidos;
            $direccion = $p->direccion;
            $ciudad = $p->ciudad;
            $telefono = $p->telefono;
        }

        $carro = new Cart($carro);
        $pago = [
            'rut' => $rut,
            'email' => $email,
            'nombre' => $nombre,
            'apellido' => $apellido,
            'direccion' => $direccion,
            'pais' => $pais,
            'ciudad' => $ciudad,
            'telefono' => $telefono,
            'carro' => $carro->items,
        ];

        //dd($pago);
        
        return view('pago')->with(['pago'=>$pago]);
    }





    /**
     * Creando una nueva Orden
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function orden(Request $request)
    {
       
        $carro = Session::get('cart');
        
        $idventa = Ventas::latest('idventa')->first();
        $idventa = $idventa->idventa;
        $idventa++;
        
        //dd($carro->preciototal);
        if ($carro==null){
            return view('almacen.tienda.carro-compra');
        }
        $optional = array(
            "rut" => $request->rut,
            'email' => $request->pagador,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'direccion' => $request->direccion,
            'pais' => $request->pais,
            'ciudad' => $request->ciudad,
            'telefono' => $request->telefono,
            //"otroDato" => "otroDato"
        );
        
        $optional = json_encode($optional);
        $orden = [
            //SEGUIR EL ORDEN Y NOMBRE DE CLAVES COMO SE MUESTRA A CONTINUACION
            'commerceOrder'  => $idventa,
            'subject'      => 'Venta Online Equilibre N°'.$idventa,
            'amount'         => $carro->preciototal,
            'email' => $request->pagador,
            //'optional' => $optional
            // Opcional: El medio de pago correspondera al ubicado en la configuracion
        ];
        //dd($optional);
        // Genera una nueva Orden de Pago, Flow la firma y retorna un paquete de datos firmados
        $orden_generada = Flow::GenerateFlowOrder($orden,$optional);

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
        $carro = Session::get('cart');
        $carro = new Cart($carro);
        if($carro == null || $response == null ){
            return view('flow.sinacceso');
        }
        $carro = $carro->items;
        //dd($response);
        //dd($carro);
       
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
            $persona = Persona::find($response->optional->rut);
            //dd($persona);
            if($persona != null){
                $Persona=Persona::findOrFail($response->optional->rut);
                $Persona->nombre=$response->optional->nombre;
                $Persona->apellidos=$response->optional->apellido;
                $Persona->correo=$response->payer;  
                $Persona->direccion=$response->optional->direccion;
                $Persona->ciudad=$response->optional->ciudad;  
                $Persona->telefono=$response->optional->telefono;
                $Persona->update();
            }else {
                $Persona=new Persona;
                $Persona->rut=$response->optional->rut;
                $Persona->nombre=$response->optional->nombre;
                $Persona->apellidos=$response->optional->apellido;
                $Persona->correo=$response->payer;  
                $Persona->direccion=$response->optional->direccion;
                $Persona->ciudad=$response->optional->ciudad;  
                $Persona->telefono=$response->optional->telefono;
                $Persona->save();
            }

            //dd($orden);
            
            $venta= new Ventas;
            $venta->idventa=$response->commerceOrder;
            $venta->total_venta=$response->amount;
            $venta->fechaHora=$response->paymentData->date;
            $venta->estado= 1;
            $venta->persona_rut1=$response->optional->rut;
            $venta->n_orden= $response->flowOrder;
            $venta->token=$request->token;
            $venta->save();
            //dd($venta);
            //$a = array(new detalle_venta);
            foreach($carro as $producto){
                $detalle_venta = new detalle_venta;
                $detalle_venta->producto_idproducto=$producto['item']['idproducto'];
                
                $detalle_venta->cantidad=$producto['qty'];
                $detalle_venta->precio_unitario=$producto['precio_unitario'];
                $detalle_venta->precio_total=$producto['precio'];
                $detalle_venta->venta_idventa=$response->commerceOrder;
                $detalle_venta->venta_persona_rut=$response->optional->rut;
                
                $detalle_venta->save();
                //array_push($a,$detalle_venta);
            }
            //dd($a);
            //dd($detalle_venta);
            DB::commit();
            Session::forget('cart');
            return view('flow.exito')->with(["FlowOrder" =>$response->flowOrder]);
        }
        //dd($response->status);
    }
}
