<?php

$config = array(
    
    'Contacto' => array(
                  array(
                  'field' => 'nombre',
                  'label' => 'Nombre',
                  'rules' => 'required|alpha|trim',
                  ),
                  array(
                  'field' => 'apellido',
                  'label' => 'Apellido',
                  'rules' => 'required|alpha|trim',
                  ),   
                  array(
                  'field' => 'correo',
                  'label' => 'Correo',
                  'rules' => 'required|valid_email|trim|xss_clean',
                  ),
                  array(
                  'field' => 'asunto',
                  'label' => 'Asunto',
                  'rules' => 'required|alpha|trim',
                  ),   
                  array(
                  'field' => 'comentario',
                  'label' => 'Comentario',
                  'rules' => 'required|alpha|trim',
                  ), 
    ),

    'Login' => array(
                  array(
                  'field' => 'rut',
                  'label' => 'R.U.T.',
                  'rules' => 'required|trim',
                  ),
                  array(
                  'field' => 'clave',
                  'label' => 'Clave',
                  'rules' => 'required',
                  ), 
      )
);

?>