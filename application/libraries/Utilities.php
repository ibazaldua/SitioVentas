<?php

/**
 * Created by PhpStorm.
 * User: bazalduai
 * Date: 18/02/2016
 * Time: 11:53 AM
 */
class Utilities
{
    /**
     * @param $view
     * @return array
     */
    function get_data($view, $params = null)
    {
        $data = array(
            'view' => $view
        );
        if ($params && is_array($params)) {
            $data = array_merge($data, $params);
        }
        return $data;
    }

    /**
     * @param $array
     * @return array
     */
    function array_multi_to_uni($array)
    {
        $result = array();

        foreach ($array as $value) {
            $result[$value['id']] = $value['descripcion'];
        }
        return $result;
    }

    /**
     * @param $resultJson Arreglo con los resultados JSON
     * @param $output Output a donde se manda la informacion
     */
    function json_result($resultJson, $output)
    {
        $output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($resultJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    }

    /**
     * @param $success
     * @param $message
     * @param $data
     * @return mixed
     */
    function get_json_data($success, $message, $data)
    {
        $resultJson["success"] = $success;
        $resultJson["data"] = $data;
        $resultJson["messaje"] = $message;

        return $resultJson;
    }

    /**
     * Realiza un llamado post a una direccion URL
     * @param $url
     * @param $params
     * @return mixed|string
     */
    function request_post($url, $params)
    {
        $request = curl_init();
        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_POST => TRUE,
            CURLOPT_POSTFIELDS => http_build_query($params),
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HEADER => FALSE,
            // CURLOPT_SSL_VERIFYPEER => TRUE,
            // CURLOPT_CAINFO => 'cacert.pem',
        );

        // Set request options
        curl_setopt_array($request, $options);

        // Realizar la solicitud y obtener la respuesta
        // y el código de status
        $response = curl_exec($request);

        if ($response === FALSE) {
            $response = curl_error($request);
        }
        $status = curl_getinfo($request, CURLINFO_HTTP_CODE);
        // Cerrar la conexión
        curl_close($request);
        return $response;
    }
}