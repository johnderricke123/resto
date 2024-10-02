<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Commissionsetting extends MX_Controller {
 	
 	public function __construct()
 	{
 		parent::__construct();
		$this->db->query('SET SESSION sql_mode = ""');
		
 		$this->load->model(array(
 			'Setting_model'  
 		));
 		
		if (! $this->session->userdata('isAdmin'))
          if(!$this->session->userdata('user_level_id') == 5)
			redirect('login');
 	}
 
	# Payroll for waiter 
    # Payroll setting

    public function payroll_commission($id = null)
    {
            $data['title']       = display('update');
        $this->form_validation->set_rules('rate', display('rate')  ,'required');
         $this->form_validation->set_rules('position', display('position')  ,'required');
         if ($this->form_validation->run()) {
            $postData = [
             'rate'     => $this->input->post('rate',true),
             'pos_id'       => $this->input->post('position',true), 
               ];
        
        if($id ==null){
                $this->db->insert('payroll_commission_setting',$postData);
        }
        else{
            $this->db->where('id',$id);
            $this->db->update('payroll_commission_setting',$postData);
        }
        echo "insert";exit;
         }
         else{
            $data['module']      = "setting";
            $data['commissions']  = $this->Setting_model->showcommsionlist();
            $data['page']        = "add_commision";   
            echo Modules::run('template/layout', $data); 
        }
    }
    public function edit_commission($id =null)
    {
        if($id ==null){
            $data['edit'] = $id;
        $data['poslist'] = $this->Setting_model->poslist();
        }
        else{
            $data['edit'] =$id;
        $data['poslist'] = $this->Setting_model->editcomm($id);
        }
        $this->load->view('edit_com',$data);
    }
       public function delete($id){
    
        $this->db->where('id',$id)->delete('payroll_commission_setting');
         redirect(base_url('setting/commissionsetting/payroll_commission'));
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
      	return redirect('setting/Commissionsetting/cancel_orders_pincodes');
    }
    
    else{
     	$this->Setting_model->insert_pincodes();
    	redirect('setting/Commissionsetting/cancel_orders_pincodes'); 
    }
    
    $this->Setting_model->insert_pincodes();
    redirect('setting/Commissionsetting/cancel_orders_pincodes');
  }
  
  public function update_pin(){
    //var_dump("test"); die();
     $this->Setting_model->update_pincodes();
    redirect('setting/Commissionsetting/cancel_orders_pincodes');
  }
  
  public function del_pin($id){
    //var_dump($id."test"); die();
    $this->Setting_model->del_pincodes($id);
    redirect('setting/Commissionsetting/cancel_orders_pincodes');
  }

}
