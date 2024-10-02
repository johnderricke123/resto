<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cancelogs extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->db->query('SET SESSION sql_mode = ""');
		$this->load->model(array(
			'setting_model'
		));

		if (!$this->session->userdata('isAdmin')) 
        if(!$this->session->userdata('user_level_id') == 5)
		redirect('login'); 
	}
 

	public function cancelog()
	{
      //$cancelogs = $this->Setting_model->get_cancelogs();    
      //var_dump($cancelogs); die();
      
          $this->db->select('*');
	$query = $this->db->get('tbl_cancelogs');
//var_dump($query->result());die();
       	$data['logs']  = $query->result();
      	$data['title']  = display('cancelogs');
        $data['module'] = "setting";  
        $data['page']   = "cancelogs";  
        echo Modules::run('template/layout', $data); 
		
	} 

  	


}
