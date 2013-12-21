<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Consulta extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->model('docente_model');
		}
		public function index(){
					$this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');

                	$this->load->view('consulta/header_menu');
                	$this->load->view('consulta/fin_header_menu');
                
                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');
		}
		public function academico(){
				$this->load->view('general/headers');
                $this->load->view('general/menu_principal');
                $this->load->view('general/abre_bodypagina');
                	$academico=$this->docente_model->getAcademico();//va a llamara  aextraer a todos los academicos
                	$this->load->view('consulta/header_menu');
                		$this->load->view('consulta/consultar_academico',compact("academico"));//consulta academico
                	$this->load->view('consulta/fin_header_menu');

                $this->load->view('general/cierre_bodypagina');
                $this->load->view('general/cierre_footer');
		}
		public function res_academico(){
			$datos = array('pk' =>$this->input->post('docente'));
			//echo $datos->pk;
			$s=$this->docente_model->academicoSemana($datos);
			print_r($s);
		}
	}


 ?>