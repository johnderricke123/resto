<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase extends MX_Controller {
    
    public function __construct()
    {
        parent::__construct();
		$this->db->query('SET SESSION sql_mode = ""');
		$this->load->model(array(
			'purchase_model',
			'logs_model'
		));	
		 $this->load->library('cart');
    }
 
    public function index($id = null)
    {
        
		$this->permission->method('purchase','read')->redirect();
        $data['title']    = display('purchase_list'); 
        #-------------------------------#       
        #
        #pagination starts
        #
        $config["base_url"] = base_url('purchase/purchase/index');
        $config["total_rows"]  = $this->purchase_model->countlist();
        $config["per_page"]    = 25;
        $config["uri_segment"] = 4;
        $config["last_link"] = "Last"; 
        $config["first_link"] = "First"; 
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Prev';  
        $config['full_tag_open'] = "<ul class='pagination col-xs pull-right'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tag_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        /* ends of bootstrap */
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data["purchaselist"] = $this->purchase_model->read($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
		$data['pagenum']=$page;
		$data['items']   = $this->purchase_model->ingrediant_dropdown();
		$data['supplier']   = $this->purchase_model->supplier_dropdown();
		$settinginfo=$this->purchase_model->settinginfo();
		$data['currency']=$this->purchase_model->currencysetting($settinginfo->currency);
		
		if(!empty($id)) {
			$data['title'] = display('purchase_edit');
			$data['intinfo']   = $this->purchase_model->findById($id);
	   }
        #
        #pagination ends
        #   
        $data['module'] = "purchase";
        $data['page']   = "purchaselist";   
        echo Modules::run('template/layout', $data); 
    }
	
	
    public function create($id = null)
    {
      
	  $data['title'] = display('purchase_add');
	  #-------------------------------#
	   $saveid=$this->session->userdata('supid');
	  	$data['intinfo']="";
	 
	   $data['supplier']   = $this->purchase_model->supplier_dropdown();
		
	   $data['module'] = "purchase";
	   $data['page']   = "addpurchase";   
	   echo Modules::run('template/layout', $data); 
    }
	public function purchase_entry(){
		$this->form_validation->set_rules('invoice_no','Invoice Number','required|max_length[50]');
		$this->form_validation->set_rules('purchase_date','Purchase Date'  ,'required');
	    $saveid=$this->session->userdata('id'); 
		
	   if ($this->form_validation->run()) { 
		$this->permission->method('purchase','create')->redirect();
		 $logData = array(
		   'action_page'         => "Add Purchase",
		   'action_done'     	 => "Insert Data", 
		   'remarks'             => "Item Purchase Created",
		   'user_name'           => $this->session->userdata('fullname'),
		   'entry_date'          => date('Y-m-d H:i:s'),
		  );
         
         
         
         
		if ($this->purchase_model->create()) { 
          $total_price = $this->input->post('grand_total_price');
          $invoice_no = $this->input->post('invoice_no');
         
                 $order_date = date("Y-m-d H:i:s");
            		$db_ledger_id = '317';
					$cr_ledger_id = '316';
                    $number = $this->purchase_model->nextNumber(1);

                    $entry = null; // create entry data array to insert in [entries] table - DB1
                    $entry['Entry']['number'] = $number; // set entry number in entry data array
                    $entry['Entry']['entrytype_id'] = 1; // set entrytype_id in entry data array
                    $entry['Entry']['dr_total'] = $total_price;
                    $entry['Entry']['cr_total'] = $total_price;
                    $entry['Entry']['date'] = $order_date;
                    $entry['Entry']['notes'] = 'Purchase:AR/OR/Invoice #: '.$invoice_no.'<br/><br/>Prepared by: ' . $this->session->userdata('fullname');
                    //$entry['Entry']['prepared_by'] = $this->input->post('username');

                    
            		$entry_id = $this->purchase_model->add_entry($entry['Entry']);

                    $entry_item = array();
                    

                    $entry_item[] = array(
                        'Entryitem' => array(
                            'dc' => 'D',
                            'entry_id' =>  $entry_id,
                            'ledger_id' =>  $db_ledger_id,  // COH - FO1, FO2, FO3
                            'amount' =>   $total_price
                        ));                  

                    $entry_item[] = array(
                        'Entryitem'=> array(
                            'dc' => 'C',
                            'entry_id' =>  $entry_id,
                            'ledger_id' =>  $cr_ledger_id,   
                            'amount' =>   $total_price
                        ));
                    
                    foreach($entry_item as $key => $row){
                        $this->purchase_model->add_entry_items($row['Entryitem']);
                    }
                

          
          
          
          
          
          
		 $this->logs_model->log_recorded($logData);
		 $this->session->set_flashdata('message', display('save_successfully'));
		 redirect('purchase/purchase/create');
		} else {
		 $this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("purchase/purchase/create"); 
	  } else { 
	  redirect("purchase/purchase/create"); 
	   }   
		}
	public function banklist(){
		$allbank=$this->db->select("*")->from('tbl_bank')->get()->result();
		echo json_encode($allbank);
		}
	public function purchaseitem(){
		   $csrf_token=$this->security->get_csrf_hash();
		   $product_name 	= $this->input->post('product_name',true);
           $product_info 	= $this->purchase_model->finditem($product_name);
		   //$json_product=array('csrf_token'=>$csrf_token);
		   $list[''] = '';
		foreach ($product_info as $value) {
			$json_product[] = array('label'=>$value['ingredient_name'], 'unit_size'=>$value['qty_unit'], 'unit'=>$value['unit_code'], 'value'=>$value['id']);
		} 
        echo json_encode($json_product);
		 //echo json_encode($data);
		  
		//$data['module'] = "purchase";  
        //$data['page']   = "ajaxiems";
		//$this->load->view('purchase/ajaxitems', $data);
		}
	public function purchasequantity(){
      //echo json_encode($this->input->post('product_id'));die();    
		$product_id = $this->input->post('product_id');
		$product_info =  $this->purchase_model->get_total_product($product_id);
		echo json_encode($product_info);
		}
	
   public function updateintfrm($id){
     
		$this->permission->method('purchase','update')->redirect();
		$data['title'] = display('purchase_edit');
	    $data['supplier']   = $this->purchase_model->supplier_dropdown();
		$data['purchaseinfo']   = $this->purchase_model->findById($id);
		$data['iteminfo']       = $this->purchase_model->iteminfo($id);
		$allbank= $this->db->select("*")->from('tbl_bank')->get()->result();
		$data['banklist']       =$allbank;
        $data['module'] = "purchase";  
	    $data['page']   = "purchaseedit";
     
	    echo Modules::run('template/layout', $data);  
       //echo Modules::run('units/unitmeasurement/updateunitfrm', $data); 
	   }
	public function purchaseinvoice($id){
		$this->permission->method('purchase','update')->redirect();
		$data['title'] = display('purchase_edit');
		$settinginfo=$this->purchase_model->settinginfo();
		$data['setting']=$settinginfo;
		$data['currency']=$this->purchase_model->currencysetting($settinginfo->currency);
		$data['purchaseinfo']   = $this->purchase_model->findById($id);
		$supid=$data['purchaseinfo']->suplierID;
		$data['supplierinfo']   = $this->purchase_model->suplierinfo($supid);
		$data['iteminfo']       = $this->purchase_model->iteminfo($id);
        $data['module'] = "purchase";  
	    $data['page']   = "purchaseinvoice";   
	    echo Modules::run('template/layout', $data);  
       //echo Modules::run('units/unitmeasurement/updateunitfrm', $data); 
	   }
 	public function update_entry(){
		$this->form_validation->set_rules('invoice_no','Invoice Number','required|max_length[50]');
		$this->form_validation->set_rules('purchase_date','Purchase Date'  ,'required');
	    $saveid=$this->session->userdata('id'); 
		if ($this->form_validation->run()) { 
		
		 $this->permission->method('purchase','update')->redirect();
		 $logData = array(
		   'action_page'         => "Update Purchase",
		   'action_done'     	 => "Update Data", 
		   'remarks'             => "Item Purchase Updated",
		   'user_name'           => $this->session->userdata('fullname'),
		   'entry_date'          => date('Y-m-d H:i:s'),
		  );
		if ($this->purchase_model->update()) { 
		 $this->logs_model->log_recorded($logData);
		 $this->session->set_flashdata('message', display('update_successfully'));
		 redirect('purchase/purchase/index');
		} else {
		 $this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("purchase/purchase/index");
	  } else { 
	  redirect("purchase/purchase/index"); 
	   }  
		
	   }
 public function getlist($id){
	 	 $suplierinfo=$this->purchase_model->suplierinfo($id);
		 echo json_encode($suplierinfo);
	 }
    public function delete($id = null)
    {
        $this->permission->module('purchase','delete')->redirect();
		$logData = array(
	   'action_page'         => "Purchase List",
	   'action_done'     	 => "Delete Data", 
	   'remarks'             => "Purchase Deleted",
	   'user_name'           => $this->session->userdata('fullname'),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  );
		if ($this->purchase_model->delete($id)) {
			#Store data to log table.
			 $this->logs_model->log_recorded($logData);
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect('purchase/purchase/index');
    }
	 public function addproduction($id = null)
    {
	  $data['title'] = display('purchase_add');
	  #-------------------------------#
	   $saveid=$this->session->userdata('supid');
	  $data['intinfo']="";
	 
	   $data['item']   = $this->purchase_model->item_dropdown();
		
	   $data['module'] = "purchase";
	   $data['page']   = "addproduction";   
	   echo Modules::run('template/layout', $data); 
    }
	
	public function production_entry(){
		$this->form_validation->set_rules('foodid','Food Name','required');
		$this->form_validation->set_rules('purchase_date','Purchase Date'  ,'required');
		$this->form_validation->set_rules('pro_qty','Production Quantity'  ,'required');
	    $saveid=$this->session->userdata('id'); 
		
	   if ($this->form_validation->run()) { 
		$this->permission->method('purchase','create')->redirect();
		 $logData =array(
		   'action_page'         => "Add Production",
		   'action_done'     	 => "Insert Data", 
		   'remarks'             => "Item Production Created",
		   'user_name'           => $this->session->userdata('fullname'),
		   'entry_date'          => date('Y-m-d H:i:s'),
		  );
		if ($this->purchase_model->makeproduction()) { 
		 $this->logs_model->log_recorded($logData);
		 $this->session->set_flashdata('message', display('save_successfully'));
		 redirect('purchase/purchase/addproduction');
		} else {
		 $this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("purchase/purchase/addproduction"); 
	  } else { 
	  redirect("purchase/purchase/addproduction"); 
	   }  
		}
	public function return_form(){
		$data['title'] = display('purchase_return');
		$data['supplier']   = $this->purchase_model->supplier_dropdown();
		$data['module'] = "purchase";
	    $data['page']   = "purchasereturn";   
	    echo Modules::run('template/layout', $data); 
		}
	public function getinvoice(){
		 $suplier 	= $this->input->post('id');
		 $invoiceinfo=$this->purchase_model->invoicebysupplier($suplier);
		 $option='';
		 if(!empty($invoiceinfo)){
		 foreach($invoiceinfo as $invoice){
		 $option.='<option value="'.$invoice->invoiceid.'">'.$invoice->invoiceid.'</option>';
		 }
		 }
		  echo  '<select name="invoice" id="invoice" class="form-control">
                                	<option value=""  selected="selected">Select Option</option>
									'.$option.'
									</select>';
		}
	public function returnlist(){
		$data['title'] = display('purchase_return');
		$invoice 	= $this->input->post('invoice');
		$invoiceinfo=$this->purchase_model->getinvoice($invoice);
		$purchaseid=$invoiceinfo->purID;
		//$data['returnitem']=$this->purchase_model->getinvoice($purchaseid);
		
		$settinginfo=$this->purchase_model->settinginfo();
		$data['setting']=$settinginfo;
		$data['currency']=$this->purchase_model->currencysetting($settinginfo->currency);
		$supid=$invoiceinfo->suplierID;
		$data['supplierinfo']     = $this->purchase_model->suplierinfo($supid);
		$data['returnitem']       = $this->purchase_model->iteminfo($purchaseid);
		//print_r($data['returnitem']);
		$data['module'] = "purchase";
	    $data['page']   = "purchasereturnform";  
		$this->load->view('purchase/purchasereturnform', $data); 
		
		}
	public function purchase_return_entry(){
		$data['title'] = display('purchase_return');
		if ($this->purchase_model->pur_return_insert()) { 
			$this->session->set_flashdata('message', display('save_successfully'));
			redirect('purchase/purchase/return_form/');
		}else{
			$this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("purchase/purchase/return_form");
		}
  public function return_invoice(){
	  	$this->permission->method('purchase','read')->redirect();
        $data['title']    = display('purchase_list'); 
        #-------------------------------#       
        #
        #pagination starts
        #
        $config["base_url"] = base_url('purchase/purchase/return_invoice');
        $config["total_rows"]  = $this->purchase_model->countreturnlist();
        $config["per_page"]    = 25;
        $config["uri_segment"] = 4;
        $config["last_link"] = "Last"; 
        $config["first_link"] = "First"; 
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Prev';  
        $config['full_tag_open'] = "<ul class='pagination col-xs pull-right'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tag_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        /* ends of bootstrap */
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data["invoicelist"] = $this->purchase_model->readinvoice($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
		$data['pagenum']=$page;
		$settinginfo=$this->purchase_model->settinginfo();
		$data['currency']=$this->purchase_model->currencysetting($settinginfo->currency);
        #
        #pagination ends
        #   
        $data['module'] = "purchase";
        $data['page']   = "invoicelist";   
        echo Modules::run('template/layout', $data); 
	  }
	public function returnview($id){
		$this->permission->method('purchase','read')->redirect();
		$data['title'] = display('invoice_view');
		$data['purchaseinfo']   = $this->purchase_model->findByreturnId($id);
		$data['iteminfo']       = $this->purchase_model->returniteminfo($id);
        $data['module'] = "purchase";  
	    $data['page']   = "purchasereturnview";   
	    echo Modules::run('template/layout', $data);  
	   }
	public function stock_out_ingredients()
   {

     $this->permission->method('purchase','read')->redirect();
	 $this->load->model('purchase_model');
     $data['title'] = display('stock_out_ingredients');
      
      
      $qreslt = $this->db->query("SELECT A.*, A.id, A.ingredient_name, A.stock_qty FROM ingredients A WHERE EXISTS (SELECT B.id FROM ingredients B WHERE B.id = A.id AND B.ingredient_name = A.ingredient_name AND B.stock_qty < A.min_stock)");
      
      //var_dump($qreslt->result());die();

//$this->db->from('ingredients');
//$this->db->join('purchase_details', 'purchase_details.indredientid = ingredients.id');
      
      //$this->db->join('unit_of_measurement', 'unit_of_measurement.id = ingredients.uom_id');
//$this->db->join('purchaseitem', 'purchaseitem.purID = purchase_details.purchaseid');
//$this->db->join('supplier', 'supplier.supid = purchaseitem.suplierID');
//$qreslt = $this->db->get();

//var_dump($qreslt->result());die();      
      

//$this->db->from('ingredients');
//$this->db->where('stock_qty < min_stock');
//$this->db->join('purchase_details', 'purchase_details.indredientid = ingredients.id');
//$this->db->join('purchaseitem', 'purchaseitem.purID = purchase_details.purchaseid');
//$this->db->join('supplier', 'supplier.supid = purchaseitem.suplierID');
//$qreslt = $this->db->get();


      
//var_dump($qreslt->result());die();
      

      $data['units'] = $this->purchase_model->get_units();

      
      $settinginfo=$this->purchase_model->settinginfo();

      
      $data['setting']=$settinginfo;
      $data['module'] = "purchase";  
      $data['page']   = "outstock"; 
      $data['outstock'] =  $qreslt->result();
	  //$data['purchase_details'] =  $this->db->get('purchase_details')->result();
      $data['purchaseitem'] =  $this->db->get('purchaseitem')->result();
      echo Modules::run('template/layout', $data); 
     

   }
  public function ingredients()
   {
	
     $this->permission->method('purchase','read')->redirect();
	 $this->load->model('purchase_model');
     $data['title'] = display('ingedients');

$this->db->select('*');
//$this->db->where('A.stock_qty < B.min_stock');
$this->db->from('currency');
$this->db->from('ingredients A');
$this->db->join('ingredients B', 'A.ingredient_name = B.ingredient_name', 'inner'); // Join condition
$this->db->join('purchase_details', 'purchase_details.indredientid = A.id');
$this->db->join('unit_of_measurement', 'unit_of_measurement.id = A.uom_id');
$this->db->join('purchaseitem', 'purchaseitem.purID = purchase_details.purchaseid');
$this->db->join('supplier', 'supplier.supid = purchaseitem.suplierID');

$qreslt = $this->db->get();
    //var_dump($qreslt->result());die();
//var_dump($qreslt->result());die();
//var_dump($qreslt->result());die();


      

      $data['units'] = $this->purchase_model->get_units();

      
      $settinginfo=$this->purchase_model->settinginfo();

    //var_dump($qreslt->result());die();
      
    
    
    
    
   //test

 
   //test
    
    
    
    
    
    
    
    
      $data['setting']=$settinginfo;
      $data['module'] = "purchase";  
      $data['page']   = "ingredients"; 
      $data['ingredients'] =  $qreslt->result();
	  //$data['purchase_details'] =  $this->db->get('purchase_details')->result();
      $data['purchaseitem'] =  $this->db->get('purchaseitem')->result();
      echo Modules::run('template/layout', $data); 
     

   }

}
