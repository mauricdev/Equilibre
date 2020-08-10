<?php

/*
 *  
 */

namespace equilibre;

use Exception;

class Flow {

    static protected $params = [];

    //Método constructor de compatibilidad
    function flowAPI() {;
        $this->__construct();
    }

    //Constructor de la clase
    function __construct() {
        //global $flow_medioPago;
        $this->params = [];
    }

    public static function GenerateFlowOrder($params)
    {
        //return self::flow_validate_array($params);
        try{
            $url = config('flow.url_api')."/payment/create";
            $params = self::flow_validate_order($params);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);

            $response = curl_exec($ch);

            if($response === false) {
              $error = curl_error($ch);
              throw new Exception($error, 1);
            }

            $info = curl_getinfo($ch);
            if(!in_array($info['http_code'], array('200', '400', '401'))) {
                throw new Exception('Unexpected error occurred. HTTP_CODE: '.$info['http_code'] , $info['http_code']);
            }

            $resp = ["response" => json_decode($response)];
            $params = $params + $resp;

            return  $params;

            self::flow_log("Response Success: ".$response,"flow_pack");
        }catch(Exception $ex)
        {
            self::flow_log("Response Error: ".$ex->getCode()." - ".$ex->getMessage(),"flow_pack");
        }
    }

    public static function flow_validate_order($params)
    {
        $key = ["apiKey" => urlencode(config('flow.api_key'))];
        $method = ["paymentMethod" => config('flow.medioPago')];
        $confirm = ["urlConfirmation" => self::generarUrl(config('flow.url_confirmacion'))];
        $return = ["urlReturn" => self::generarUrl(config('flow.url_retorno'))];

        $params = $key + $params + $method + $confirm + $return;


        $signature = self::flow_sign($params);
        $params["s"] = $signature;

        self::flow_log("Orden firmada...","flow_pack");
        self::$params = $params;
        return $params;
    }

    public static function flow_validate_token($token)
    {
        $params = ["token" => $token];

        $key = ["apiKey" => urlencode(config('flow.api_key'))];
        $params = $key + $params;

        $signature = self::flow_sign($params);
        $params["s"] = $signature;

        self::flow_log("Token firmado...","flow_pack");
        return $params;
    }

    private static function flow_sign($data) {
        $priv_key_id = urlencode(config('flow.secret_key'));

        $keys = array_keys($data);
        sort($keys);

        $toSign = "";
        foreach ($keys as $key) {
            $toSign .= $key.$data[$key];
        }

        $signature = hash_hmac('sha256', $toSign, $priv_key_id);

        return $signature;
    }

    // Metodos GET


    /**
     * Get el estado de la Orden del Comercio
     *
     * @return string el estado de la Orden del comercio
     */
    public static function getStatus($token) {
        try{
            $url = config('flow.url_api')."/payment/getStatus";

            $url = $url."?".http_build_query(self::flow_validate_token($token));
            //return $url;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
             $response = curl_exec($ch);
            if($response === false) {
              $error = curl_error($ch);
              throw new Exception($error, 1);
            }

            $info = curl_getinfo($ch);
            if(!in_array($info['http_code'], array('200', '400', '401'))) {
              throw new Exception('Unexpected error occurred. HTTP_CODE: '.$info['http_code'] , $info['http_code']);
            }


            $resp = ["response" => json_decode($response)];
            self::flow_log("Response Success: ".$response,"flow_pack");

            return $resp['response'];

        }catch(Exception $ex)
        {
            self::flow_log("Response Error: ".$ex->getCode()." - ".$ex->getMessage(),"flow_pack");
        }
    }


    /**
     * Registra en el Log de Flow
     *
     * @param string $message El mensaje a ser escrito en el log
     * @param string $type Identificador del mensaje
     *
     */
    public static function flow_log($message, $type) {
        //global $flow_logPath;
        $file = fopen(config('flow.logPath') . "/flowLog_" . date("Y-m-d") .".txt" , "a+");
        fwrite($file, "[".date("Y-m-d H:i:s.u")." ".getenv('REMOTE_ADDR')." ".getenv('HTTP_X_FORWARDED_FOR')." - $type ] ".$message . PHP_EOL);
        fclose($file);
    }

    /**
     * Genera una URL utilizando las funciones de Laravel
     *
     * @param  mixed  $url
     * @return string
     */
    private static function generarUrl($url)
    {
        if (is_array($url)) {
            if (array_key_exists('url', $url))
                return url($url['url']);

            if (array_key_exists('route', $url))
                return route($url['route']);

            if (array_key_exists('action', $url))
                return action($url['action']);

            return '';
        } else {
            return $url;
        }
    }
}
