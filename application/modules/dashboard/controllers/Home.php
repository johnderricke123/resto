<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MX_Controller {
 	
 	public function __construct()
 	{
 		parent::__construct();

 		$this->load->model(array(
 			'home_model' 
 		)); 
		$this->db->query('SET SESSION sql_mode = ""');
		if (! $this->session->userdata('isLogIn'))
			redirect('login');
 	}
	public function changeformat($num) {
			  if($num>1000) {
					$x = round($num);
					$x_number_format = number_format($x);
					$x_array = explode(',', $x_number_format);
					$x_parts = array('k', 'm', 'b', 't');
					$x_count_parts = count($x_array) - 1;
					$x_display = $x;
					$x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
					$x_display .= $x_parts[$x_count_parts - 1];
					return $x_display;
			  }
		  return $num;
		}
	public function index()
	{
      		        //if($this->session->userdata('isAdmin')) {
					$user_id = $this->session->userdata('id');
					//$user_id = "213";
					$this->db->select('A.fk_role_id');
					$this->db->where('fk_user_id', $user_id);
					$query = $this->db->get('sec_user_access_tbl A');
					$result = $query->row();

$newdata = array( 'user_level_id' => $result->fk_role_id);
$this->session->set_userdata($newdata);

      
      //var_dump("test");die();
      $qreslt = $this->db->query("SELECT A.*, A.id, A.ingredient_name, A.stock_qty FROM ingredients A WHERE EXISTS (SELECT B.id FROM ingredients B WHERE B.id = A.id AND B.ingredient_name = A.ingredient_name AND B.stock_qty < A.min_stock)");

      
      //testing
      //$qreslt = $this->db->query("SELECT A.*, A.id, A.ingredient_name, A.stock_qty FROM ingredients A WHERE EXISTS (SELECT B.id FROM ingredients B WHERE B.id = A.id AND B.ingredient_name = A.ingredient_name AND B.stock_qty < A.min_stock)");
      
      //var_dump($qreslt->result());die();

        //$this->db->from('ingredients');
        //$this->db->join('purchase_details', 'purchase_details.indredientid = ingredients.id');
        //$this->db->join('unit_of_measurement', 'unit_of_measurement.id = ingredients.uom_id');
        //$this->db->join('purchaseitem', 'purchaseitem.purID = purchase_details.purchaseid');
        //$this->db->join('supplier', 'supplier.supid = purchaseitem.suplierID');
        //$qreslt = $this->db->get();


    //var_dump($qreslt->result());die();      
    
//testing
      
      
       //var_dump("TEST");die();
      
      
      
	    $data['outstock'] =  $qreslt->result();
		$data['title']    = display('home');
		#page path 
		$data['module'] = "dashboard";  
		$data['page']   = "home/home";  
		$settinginfo = $this->db->select('currency')->from('setting')->get()->row();
	    $currencyinfo = $this->db->select('currencyname,curr_icon')->from('currency')->where('currencyid',$settinginfo->currency)->get()->result();
		$ordernum= $this->home_model->countorder();
		$data["totalorder"]  =$this->changeformat($ordernum);
		$todayorder=$this->home_model->todayorder();
		$data["todayorder"]  = $this->changeformat($todayorder);
		$todayorderprice=$this->home_model->todayamount();
		if($todayorderprice->amount<1000){
			if($todayorderprice->amount>0){
			$data["todayamount"]  = $todayorderprice->amount.$currencyinfo->curr_icon;				
			}
			else{
		$data["todayamount"]  = "0";				}
		}
		else{
			$data["todayamount"]  =  $this->changeformat($todayorderprice->amount);
			}
		$customer=$this->home_model->totalcustomer();
		$data["totalcustomer"]  = $this->changeformat($customer);
		$completeorder=$this->home_model->countcompleteorder();
		$data["completeord"]  = $this->changeformat($completeorder);
		$totalreservation=$this->home_model->totalreservation();
		$data["totalreservation"]  = $this->changeformat($totalreservation);
        $data["latestoreder"] = $this->home_model->latestoreder();
		$data["onlineorder"] =$this->home_model->latestonline();
		$data["latestreservation"] =$this->home_model->latestreservation();
		$data["latestpending"] =$this->home_model->latestpending();
		$months='';
		$salesamount='';
		$salesamountonline='';
		$totalorderonline='';
		$salesamountoffline='';
		$totalorderoffline='';
		$totalorder='';
		 $year=date('Y');
		 $numbery=date('y');
		 $prevyear=$numbery-1;
		 $prevyearformat=$year-1;
		 $syear='';
		 $syearformat='';
        $hotel_guest = '';
		for($k = 1; $k < 13; $k++){
		 $month=date('m', strtotime("+$k month")); 
		 $gety= date('y', strtotime("+$k month")); 
		 if($gety==$numbery){
			 $syear= $prevyear;
			 $syearformat= $prevyearformat;
			 }
		 else{
			  $syear=$numbery;
			  $syearformat= $year;
			 }
		 $monthly=$this->home_model->monthlysaleamount($syearformat,$month);
		 $odernum=$this->home_model->monthlysaleorder($syearformat,$month);
		 $monthlyonline=$this->home_model->onlinesaleamount($syearformat,$month);
		 $odernumonline=$this->home_model->onlinesaleorder($syearformat,$month);
		 $monthlyoffline=$this->home_model->offlinesaleamount($syearformat,$month);
		 $odernumoffline=$this->home_model->offlinesaleorder($syearformat,$month);
		 
		 $salesamount.=$monthly.', ';
		 $totalorder.=$odernum.', ';
		 
		 $salesamountonline.=$monthlyonline.', ';
		 $totalorderonline.=$odernumonline.', ';
		 $salesamountoffline.=$monthlyoffline.', ';
		 $totalorderoffline.=$odernumoffline.', ';
		 $months.=  '"'.date('F-'.$syear, strtotime("+$k month")).'", '; 
		}

        foreach($data["latestoreder"] as $latest) {
            if($latest->cutomertype == '99') {
                $data["hotel_guest"]= $this->home_model->get_hotel_guest($latest->cust_id);
            }
        }

		$data["monthlysaleamount"] =trim($salesamount,',');
		$data["monthlysaleorder"] =trim($totalorder,',');
		$data["onlinesaleamount"] =trim($salesamountonline,',');
		$data["onlinesaleorder"] =trim($totalorderonline,',');
		$data["offlinesaleamount"] =trim($salesamountoffline,',');
		$data["offlinesaleorder"] =trim($totalorderoffline,',');

		$data["monthname"]=trim($months,',');
		echo Modules::run('template/layout', $data); 
	}
	public function checkmonth(){
		$monyhyear=$this->input->post('monthyear');
		$getmonth=date('m', strtotime($monyhyear));
		$totalmonth=$getmonth+1;
		$year=date('Y', strtotime($monyhyear));
		$months='';
		$salesamount='';
		$totalorder='';
		 $numbery=date('y', strtotime($monyhyear));
		 $yformat=date('Y', strtotime($monyhyear));
		 $prevyear=$numbery-1;
		 $prevyearformat=$year-1;
		 $syear='';
		 $syearformat='';
		for($d = $totalmonth; $d < 13; $d++){
			 $month=date('m', strtotime("+$d month"));  
		$gety= date('y', strtotime("+$d month")); 
		 if($gety==$numbery){
			 $syear= $prevyear;
			 $syearformat= $prevyearformat;
			 }
		 else{
			  $syear=$prevyear;
			  $syearformat=$prevyearformat;
			 }
		 $monthly=$this->home_model->monthlysaleamount($year,$month);
		 $odernum=$this->home_model->monthlysaleorder($year,$month);
		 $salesamount.=$monthly.', ';
		 $totalorder.=$odernum.', ';
		 $months.=  '"'.date('F-'.$syear, strtotime("+$d month")).'", '; 
			}
		for($k = 1; $k < $totalmonth; $k++){
			$month=date('m', strtotime("+$k month"));
			$gety= date('y', strtotime("+$k month")); 
			 if($gety==$numbery){
				 $syear= $prevyear;
				 $syearformat= $prevyearformat;
				 }
			 else{
				  $syear=$numbery;
				  $syearformat=$yformat;
				 }  
		 $monthly=$this->home_model->monthlysaleamount($syearformat,$month);
		 $odernum=$this->home_model->monthlysaleorder($syearformat,$month);
		 $salesamount.=$monthly.', ';
		 $totalorder.=$odernum.', ';
		 $months.=  '"'.date('F-'.$syear, strtotime("+$k month")).'", '; 
			}
		$data["monthlysaleamount"] =trim($salesamount,',');
		$data["monthlysaleorder"] =trim($totalorder,',');
		$data["monthname"]=trim($months,',');
		
		$data['module'] = "dashboard";  
		$data['page']   = "home/searchchart";
		$this->load->view('dashboard/home/searchchart', $data); 
		}

	public function profile()
	{
		$data['title']  = "Profile";
		$data['module'] = "dashboard";  
		$data['page']   = "home/profile";  
		$id = $this->session->userdata('id');
		$data['user']   = $this->home_model->profile($id);
		echo Modules::run('template/layout', $data);  
	}

	public function setting()
	{ 
		$data['title']    = "Profile Setting";
		$id = $this->session->userdata('id');
		/*-----------------------------------*/
		$this->form_validation->set_rules('firstname', 'First Name','required|max_length[50]');
		$this->form_validation->set_rules('lastname', 'Last Name','required|max_length[50]');
		#------------------------#
       	$this->form_validation->set_rules('email', 'Email Address', "required|min_length[5]|max_length[100]");
       	/*---#callback fn not supported#---*/ 
       	// $this->form_validation->set_rules('email', 'Email Address', "required|valid_email|max_length[100]|callback_email_check[$id]|trim"); 
		#------------------------#
		$this->form_validation->set_rules('password', 'Password','required|max_length[32]|md5');
		$this->form_validation->set_rules('about', 'About','max_length[1000]');
		/*-----------------------------------*/
        $config['upload_path']          = './assets/img/user/';
        $config['allowed_types']        = 'gif|jpg|png'; 

        $this->load->library('upload', $config);
 
        if ($this->upload->do_upload('image')) {  
            $data = $this->upload->data();  
            $image = $config['upload_path'].$data['file_name']; 

			$config['image_library']  = 'gd2';
			$config['source_image']   = $image;
			$config['create_thumb']   = false;
			$config['maintain_ratio'] = TRUE;
			$config['width']          = 115;
			$config['height']         = 90;
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			$this->session->set_flashdata('message', "Image Upload Successfully!");
        }
		/*-----------------------------------*/
		$data['user'] = (object)$userData = array(
			'id' 		  => $this->input->post('id'),
			'firstname'   => $this->input->post('firstname',true),
			'lastname' 	  => $this->input->post('lastname',true),
			'email' 	  => $this->input->post('email',true),
			'password' 	  => md5($this->input->post('password')),
			'about' 	  => $this->input->post('about',true),
			'image'   	  => (!empty($image)?$image:$this->input->post('old_image')) 
		);

		/*-----------------------------------*/
		if ($this->form_validation->run()) {

	        if (empty($userData['image'])) {
				$this->session->set_flashdata('exception', $this->upload->display_errors()); 
	        }

			if ($this->home_model->setting($userData)) {

				$this->session->set_userdata(array(
					'fullname'   => $this->input->post('firstname',true). ' ' .$this->input->post('lastname'),
					'email' 	  => $this->input->post('email',true),
					'image'   	  => (!empty($image)?$image:$this->input->post('old_image'))
				));


				$this->session->set_flashdata('message', display('update_successfully'));
			} else {
				$this->session->set_flashdata('exception',  display('please_try_again'));
			}
			redirect("dashboard/home/setting");

		} else {
			$data['module'] = "dashboard";  
			$data['page']   = "home/profile_setting"; 
			if(!empty($id))
			$data['user']   = $this->home_model->profile($id);
			echo Modules::run('template/layout', $data);
		}
	}
  public function stock_out_ingredients()
   {

     $this->permission->method('purchase','read')->redirect();
	 $this->load->model('purchase_model');
     $data['title'] = display('stock_out_ingredients');
      

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

     // var_dump("TEST");die();
      $data['setting']=$settinginfo;
      $data['module'] = "purchase";  
      $data['page']   = "home"; 
      $data['home'] =  $qreslt->result();
	  //$data['purchase_details'] =  $this->db->get('purchase_details')->result();
      $data['purchaseitem'] =  $this->db->get('purchaseitem')->result();
      echo Modules::run('template/layout', $data); 
     

   }
	
}
