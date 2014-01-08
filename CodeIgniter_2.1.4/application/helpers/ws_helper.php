<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
if (!function_exists('wsLogear')) {

    function wsLogear($rut, $contrasena) {
        $resultado = false;

        try {

            // Creacion de un arreglo con los parámetros de entrada.
            $parametros = array();
            $parametros['rut'] = $rut;
            $parametros['password'] = $contrasena;

            // usuario de webService
            $autenticacion = array('login' => 'sesparza',
                'password' => '54d6b211811cf8a22a735d3d071299ad94419900');

            $cliente = new SoapClient("http://informatica.utem.cl:8011/dirdoc-auth/ws/auth?wsdl", $autenticacion);
        $objeto = $cliente->autenticar($parametros);
            $codigo = (int) $objeto->return->codigo;
            $descripcion = (string) trim($objeto->return->descripcion);
          
                // echo $resultado->return->apellidoMaterno;
            if ($codigo > 0) {
                $resultado = true;
            } else {
                error_log("Servicio WEB respondió: $descripcion ($codigo)");
            }
        } catch (Exception $e) {
            $resultado = false;
            error_log("Error en autenticacion: {$e->getMessage()}");
        }
        return $resultado;
    }

}
if (!function_exists('wsSession')) {

    function wsSession($rut) {
        //$resultado = false;

       

            // Creacion de un arreglo con los parámetros de entrada.
            $parametros = array();
            $parametros['rut'] = $rut;

            // usuario de webService
            $autenticacion = array('login' => 'sesparza',
                'password' => '54d6b211811cf8a22a735d3d071299ad94419900');

            $cliente = new SoapClient("http://informatica.utem.cl:8011/dirdoc-auth/ws/auth?wsdl", $autenticacion);
         //$objeto = $cliente->consultarDocente($parametros);
                    $objeto = $cliente->consultarEstudiante($parametros);//cambiar a Docente-------------->4

                 $tipo=(string) trim($objeto->return->tipo);   
                // echo $resultado->return->apellidoMaterno; 
                if($tipo=="ALUM") //cambiar PROF -->1
                //   $resultado = (string) trim($objeto->return->alias);//cambiar $objeto->return->alias --->2
                 $resultado = (string) trim($objeto->return->nombres);//borrar esta linea -->3
                 else
                    $resultado = false;//si entra a false quiere decir que es alumno
                    

        return $resultado;
    }

}
