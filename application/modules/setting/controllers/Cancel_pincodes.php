<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cancel_pincodes extends MX_Controller {
    
    public function __construct()
    {
        parent::__construct();
		$this->db->query('SET SESSION sql_mode = ""');
		$this->load->model(array(
			'countrycity_model',
			'logs_model',
            'Setting_model'
		));	
    }
 
    public function index($id = null)
    {
        var_dump("test cancel pins");die();

    }

    public function cancel_orders_pincodes(){
        //var_dump("TEST");die();
        $data['pincode']  = $this->Setting_model->get_pincodes();
        //var_dump($data['pincode']); die();
        //$data['commissions']  = $this->Setting_model->showcommsionlist();
        $data['title']       = display('cancel');
        $data['module'] = "setting";  
        $data['page']   = "cancellation_pincodes";  
        echo Modules::run('template/layout', $data); 
      }

      public function reg_pin(){
        //var_dump($this->input->post());die();
        
        $this->load->library('session');
        $validation = $this->Setting_model->check_pincode();
        //var_dump($validation); die();
        
        if($validation){
           $this->session->set_flashdata('error', 'Pincode Exist!');
              return redirect('setting/Cancel_pincodes/cancel_orders_pincodes');
        }
        
        else{
             $this->Setting_model->insert_pincodes();
            redirect('setting/Cancel_pincodes/cancel_orders_pincodes'); 
        }
        
        $this->Setting_model->insert_pincodes();
        redirect('setting/Cancel_pincodes/cancel_orders_pincodes');
      }
    
 
}
