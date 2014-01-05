<?php

$config = array(
    
    'formualario' => array(
      array(
          'field' => 'nombre',
          'label' => 'Nombre',
          'rules' => 'required|alpha|trim',
      ),
     array(
         'field' => 'email',
         'label' => 'Email',
         'rules' => 'valid_email|trim|xss_clean',
     ),   
    )
);