<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model {
	
	private $table = 'purchaseitem';
 
	public function create()
	{
		$saveid=$this->session->userdata('id');
		$p_id = $this->input->post('product_id');
		$purchase_date = str_replace('/','-',$this->input->post('purchase_date'));
		$newdate= date('Y-m-d' , strtotime($purchase_date));
		$data=array(
			'invoiceid'				=>	$this->input->post('invoice_no'),
			'suplierID'			    =>	$this->input->post('suplierid'),
			'total_price'	        =>	$this->input->post('grand_total_price'),
			'details'	            =>	$this->input->post('purchase_details'),
			'purchasedate'		    =>	$newdate,
			'savedby'			    =>	$saveid
		);
		 $this->db->insert($this->table,$data);
		$returnid = $this->db->insert_id();
		
		$rate = $this->input->post('product_rate');
		$quantity = $this->input->post('product_quantity');
		$t_price = $this->input->post('total_price');
		
		for ($i=0, $n=count($p_id); $i < $n; $i++) {
			$product_quantity = $quantity[$i];
			$product_rate = $rate[$i];
			$product_id = $p_id[$i];
			$total_price = $t_price[$i];
			
			$data1 = array(
				'purchaseid'		=>	$returnid,
				'indredientid'		=>	$product_id,
				'quantity'			=>	$product_quantity,
				'price'				=>	$product_rate,
				'totalprice'		=>	$total_price,
				'purchaseby'		=>	$saveid,
				'purchasedate'		=>	$newdate
			);

			if(!empty($quantity))
			{
				$this->db->insert('purchase_details',$data1);
			}
		}
		return true;
	
	}
	public function allfood(){
		$this->db->select('item_foods.*,variant.variantid,variant.variantName,variant.price');
        $this->db->from('item_foods');
		$this->db->join('variant','item_foods.ProductsID=variant.menuid','left');
		$this->db->where('ProductsIsActive',1);
		$query = $this->db->get();
		$itemlist=$query->result();
	    return $itemlist;
		}
	public function allfood2(){
		$this->db->select('*');
        $this->db->from('item_foods');
		$this->db->where('ProductsIsActive',1);
		$query = $this->db->get();
		$itemlist=$query->result();
		$output=array();
		if(!empty($itemlist)){
			$k=0;
			foreach($itemlist as $items){
				$varientinfo=$this->db->select("variant.*,count(menuid) as totalvarient")->from('variant')->where('menuid',$items->ProductsID)->get()->row();
				if(!empty($varientinfo)){
					$output[$k]['variantid']=$varientinfo->variantid;
					$output[$k]['totalvarient']=$varientinfo->totalvarient;
					$output[$k]['variantName']=$varientinfo->variantName;
					$output[$k]['price']=$varientinfo->price;
				}else{
					$output[$k]['variantid']='';
					$output[$k]['totalvarient']=0;
					$output[$k]['variantName']='';
					$output[$k]['price']='';
					}
				$output[$k]['ProductsID']=$items->ProductsID;
				$output[$k]['CategoryID']=$items->CategoryID;
				$output[$k]['ProductName']=$items->ProductName;
				$output[$k]['ProductImage']=$items->ProductImage;
				$output[$k]['bigthumb']=$items->bigthumb;
				$output[$k]['medium_thumb']=$items->medium_thumb;
				$output[$k]['small_thumb']=$items->small_thumb;
				$output[$k]['component']=$items->component;
				$output[$k]['descrip']=$items->descrip;
				$output[$k]['itemnotes']=$items->itemnotes;
				$output[$k]['menutype']=$items->menutype;
				$output[$k]['productvat']=$items->productvat;
				$output[$k]['special']=$items->special;
				$output[$k]['OffersRate']=$items->OffersRate;
				$output[$k]['offerIsavailable']=$items->offerIsavailable;
				$output[$k]['offerstartdate']=$items->offerstartdate;
				$output[$k]['offerendate']=$items->offerendate;
				$output[$k]['Position']=$items->Position;
				$output[$k]['kitchenid']=$items->kitchenid;
				$output[$k]['isgroup']=$items->isgroup;
				$output[$k]['is_customqty']=$items->is_customqty;
				$output[$k]['cookedtime']=$items->cookedtime;
				$output[$k]['ProductsIsActive']=$items->ProductsIsActive;
				$k++;	
				}
		}
	    return $output;
		}
	public function headcode(){
        $query=$this->db->query("SELECT MAX(HeadCode) as HeadCode FROM acc_coa WHERE HeadLevel='4' And HeadCode LIKE '102030%'");
        return $query->row();
    }
	public function insert_customer($data = array()){
		return $this->db->insert('customer_info', $data);
		}
	 public function create_coa($data = array())
    {
        $this->db->insert('acc_coa',$data);
        return true;
    }
	public function orderitem($orderid){
		
		$saveid=$this->session->userdata('id');
		//$bill=$this->input->post('bill_info');
		$cid=$this->input->post('customer_name');
		$purchase_date = str_replace('/','-',$this->input->post('order_date'));
		$newdate= date('Y-m-d' , strtotime($purchase_date));
		
		$lastid=$this->db->select("*")->from('customer_order')->where('order_id',$orderid)->order_by('order_id','desc')->get()->row();
		$sl=$lastid->order_id;
		if(empty($sl)){
		$sl = 1; 
		}
		else{
		$sl = $sl+1;  
		}

		$si_length = strlen((int)$sl); 
		
		$str = '0000';
		$str2 = '0000';
		$cutstr = substr($str, $si_length); 
		$sino = $lastid->saleinvoice;
		$orderid = $orderid;
		$pdiscount=0;
		if ($cart = $this->cart->contents()){
			foreach ($cart as $item){
				$iteminfo=$this->getiteminfo($item['pid']);
				if($iteminfo->OffersRate>0){
					$pdiscount=$pdiscount+($iteminfo->OffersRate*$item['price']/100);
				  }
				  else{
					  $pdiscount=$pdiscount+0;
					  }
					$total=$this->cart->total();
					//$calvat=$total*15/100;
					$itemprice= $item['price']*$item['qty'];
					$discount=0;
					if(!empty($item['addonsid'])){
						$nittotal=$total+$item['addontpr'];
						$itemprice=$itemprice+$item['addontpr'];
						}
					else{
						$nittotal=$total;
						}
					if($item['isgroup']==1){
						$groupinfo=$this->db->select('*')->from('tbl_groupitems')->where('gitemid',$item['pid'])->get()->result();
						foreach($groupinfo as $grouprow){
								$data3=array(
								'order_id'				=>	$orderid,
								'menu_id'		        =>	$grouprow->items,
								'notes'					=>  $item['itemnote'],
								'groupmid'		        =>	$item['pid'],
								'menuqty'	        	=>	$grouprow->item_qty*$item['qty'],
								'addonsuid'	        	=>	$item['addonsuid'],
								'add_on_id'	        	=>	$item['addonsid'],
								'addonsqty'	        	=>	$item['addonsqty'],
								'varientid'		    	=>	$grouprow->varientid,
								'groupvarient'		    =>	$item['sizeid'],
								'qroupqty'		    	=>	$item['qty'],
								'isgroup'		    	=>	1,
								);
								$this->db->insert('order_menu',$data3);
							}
						}
					else{
					$data3=array(
						'order_id'				=>	$orderid,
						'menu_id'		        =>	$item['pid'],
						'notes'					=>  $item['itemnote'],
						'menuqty'	        	=>	$item['qty'],
						'addonsuid'	        	=>	$item['addonsuid'],
						'add_on_id'	        	=>	$item['addonsid'],
						'addonsqty'	        	=>	$item['addonsqty'],
						'varientid'		    	=>	$item['sizeid'],
					);
					$this->db->insert('order_menu',$data3);
					}
					/***food habit module section***/
					$scan = scandir('application/modules/');
					$habitsys="";
					foreach($scan as $file) {
					   if($file=="testhabit"){
						   if (file_exists(APPPATH.'modules/'.$file.'/assets/data/env')){
							   if(!empty($item['itemnote'])){
						   		$habittest=array(
									'cusid'					=>	$cid,
									'itemid'		        =>	$item['pid'],
									'varient'		        =>	$item['sizeid'],
									'habit'	        		=>	$item['itemnote']
								);
								$this->db->insert('tbl_habittrack',$habittest);
							   }
						   }
						}
					}
					
					/*$newdate=date('Y-m-d');
					$exdate=date('Y-m-d');
					$data=array(
						'itemid'				  =>	$item['pid'],
						'itemquantity'			  =>	$item['qty'],
						'savedby'	     		  =>	$saveid,
						'saveddate'	              =>	$newdate,
						'productionexpiredate'	  =>	$exdate
					);
					 $this->db->insert('production',$data);*/
				}
			}
		
		$customerinfo=$this->read('*', 'customer_info', array('customer_id' => $cid));
		$mtype=$this->read('*', 'membership', array('id' => $customerinfo->membership_type));
		$ordergrandt=$this->input->post('grandtotal');
		 $scan = scandir('application/modules/');
			$getdiscount2=0;
			foreach($scan as $file) {
			   if($file=="loyalty"){
				   if (file_exists(APPPATH.'modules/'.$file.'/assets/data/env')){
				   $getdiscount2=$mtype->discount*$this->input->post('subtotal')/100;
				   }
				   }
			}
		
		//if($bill==1){
			$payment= $this->input->post('card_type');
			if(!empty($payment)){
				$settinginfo=$this->db->select("*")->from('setting')->get()->row();
				$discount=$this->input->post('invoice_discount');
				
				$scharge=$this->input->post('service_charge');
				$vat=$this->input->post('vat');
				if($vat==''){
					$vat=0;
					}
				if($discount==''){
					$discount=0;
					}
			  if($scharge==''){
					$scharge=0;
					}
				/*	
				if($settinginfo->discount_type==1){
					$subtotal=$this->input->post('subtotal');
					$discount=$subtotal*$discount/100;
				}*/
				if($settinginfo->service_chargeType==1){
					$subtotal=$this->input->post('subtotal');
					$scharge=$subtotal*$scharge/100;
				}
				
		$billstatus=0;			
					if($payment==5){
						$billstatus=0;
						}
					else if($payment==3){
						$billstatus=0;
						}
					else if($payment==2){
						$billstatus=0;
						}
				
		$billinfo=array(
			'customer_id'			=>	$cid,
			'order_id'		        =>	$orderid,
			'total_amount'	        =>	$this->input->post('subtotal'),
			'discount'	            =>	$discount+$getdiscount2,
			'service_charge'	    =>	$scharge,
			'VAT'		 	        =>  $this->input->post('vat'),
			'bill_amount'		    =>	$ordergrandt-$getdiscount2,
			'bill_date'		        =>	$newdate,
			'bill_time'		        =>	date('H:i:s'),
			'bill_status'		    =>	$billstatus,
			'payment_method_id'		=>	$this->input->post('card_type'),
			'create_by'		        =>	$saveid,
			'create_date'		    =>	date('Y-m-d')
		);
		//print_r($billinfo);
		$this->db->insert('bill',$billinfo);
		$billid = $this->db->insert_id();
		/*$cardinfo=array(
			'bill_id'			    =>	$billid,
			'card_no'		        =>	$this->input->post('card_no'),
			'issuer_name'	        =>	$this->input->post('card_holdername')
		);
		$this->db->insert('bill_card_payment',$cardinfo);
				$updatetData = array('order_status'     => 4);
		        $this->db->where('order_id',$orderid);
				$this->db->update('customer_order',$updatetData);*/
				
				// Find the acc COAID for the Transaction
				$cusifo = $this->db->select('*')->from('customer_info')->where('customer_id',$this->input->post('customer_name'))->get()->row();
				$headn = $cusifo->cuntomer_no.'-'.$cusifo->customer_name;
				$coainfo = $this->db->select('*')->from('acc_coa')->where('HeadName',$headn)->get()->row();
				$customer_headcode = $coainfo->HeadCode;
				
				//Customer debit for Product Value
				$invoice_no=$sino;
				 $cosdr = array(
				  'VNo'            =>  $invoice_no,
				  'Vtype'          =>  'CIV',
				  'VDate'          =>  $newdate,
				  'COAID'          =>  $customer_headcode,
				  'Narration'      =>  'Customer debit for Product Invoice#'.$invoice_no,
				  'Debit'          =>  $ordergrandt-$getdiscount2,
				  'Credit'         =>  0,
				  'StoreID'        =>  0,
				  'IsPosted'       => 1,
				  'CreateBy'       => $saveid,
				  'CreateDate'     => $newdate,
				  'IsAppove'       => 1
				); 
				 $this->db->insert('acc_transaction',$cosdr);
				 //Store credit for Product Value
				  $sc =array(
				  'VNo'            =>  $invoice_no,
				  'Vtype'          =>  'CIV',
				  'VDate'          =>  $newdate,
				  'COAID'          =>  10107,
				  'Narration'      =>  'Inventory Credit for Product Invoice#'.$invoice_no,
				  'Debit'          =>  0,
				  'Credit'         =>  $ordergrandt-$getdiscount2,
				  'StoreID'        =>  0,
				  'IsPosted'       => 1,
				  'CreateBy'       => $saveid,
				  'CreateDate'     => $newdate,
				  'IsAppove'       => 1
				);  
				 $this->db->insert('acc_transaction',$sc);
				 
				 // Customer Credit for paid amount.
				  $cc =array(
				  'VNo'            =>  $invoice_no,
				  'Vtype'          =>  'CIV',
				  'VDate'          =>  $newdate,
				  'COAID'          =>  $customer_headcode,
				  'Narration'      =>  'Customer Credit for Product Invoice#'.$invoice_no,
				  'Debit'          =>  0,
				  'Credit'         =>  $ordergrandt-$getdiscount2,
				  'StoreID'        =>  0,
				  'IsPosted'       => 1,
				  'CreateBy'       => $saveid,
				  'CreateDate'     => $newdate,
				  'IsAppove'       => 1
				);  
				 $this->db->insert('acc_transaction',$cc);
				
				 //Cash In hand Debit for paid value
				 $cdv = array(
				  'VNo'            =>  $invoice_no,
				  'Vtype'          =>  'CIV',
				  'VDate'          =>  $newdate,
				  'COAID'          =>  1020101,
				  'Narration'      =>  'Cash in hand Debit For Invoice#'.$invoice_no,
				  'Debit'          =>  $ordergrandt-$getdiscount2,
				  'Credit'         =>  0,
				  'StoreID'        =>  0,
				  'IsPosted'       =>  1,
				  'CreateBy'       => $saveid,
				  'CreateDate'     => $newdate,
				  'IsAppove'       => 1
				); 
				 $this->db->insert('acc_transaction',$cdv);
				}
			//}
		return $orderid;
		}
	public function payment_info($id = null){
			$this->db->select('*');
			$this->db->from('customer_order');
			$this->db->where('order_id',$id);
			$query = $this->db->get();
			$orderinfo=$query->row();
			
			$this->db->select('*');
			$this->db->from('bill');
			$this->db->where('order_id',$id);
			$query1 = $this->db->get();
			
			if ($query->num_rows() > 0) {
				$paymentinfo=$query1->row();
				$payment=$paymentinfo->payment_method_id;
				$discount=$this->input->post('invoice_discount');
				$scharge=$this->input->post('service_charge');
				$vat=$this->input->post('vat');
				if($vat==''){
					$vat=0;
					}
				if($discount==''){
					$discount=0;
					}
			  if($scharge==''){
					$scharge=0;
					}
			$billstatus=0;			
			if($payment==5){
				$billstatus=0;
				}
			else if($payment==3){
				$billstatus=0;
				}
			else if($payment==2){
				$billstatus=0;
				}
			$saveid=$this->session->userdata('id');	
			$settinginfo=$this->db->select("*")->from('setting')->get()->row();
			/*if($settinginfo->discount_type==1){
					$subtotal=$this->input->post('subtotal');
					$discount=$subtotal*$discount/100;
				}*/
			if($settinginfo->service_chargeType==1){
					$subtotal=$this->input->post('subtotal');
					$scharge=$subtotal*$scharge/100;
				}
			$billinfo=array(
			'total_amount'	        =>	$this->input->post('subtotal'),
			'discount'	            =>	$discount,
			'service_charge'	    =>	$scharge,
			'VAT'		 	        =>  $vat,
			'bill_amount'		    =>	$this->input->post('grandtotal'),
			'create_by'		        =>	$saveid
			);
			$this->db->where('order_id',$id);
			$this->db->update('bill',$billinfo);
			/*$billinfo=$this->db->select('*')->from('bill')->where('order_id',$id)->get()->row();
			$cardinfo=array(
			'card_no'		        =>	$this->input->post('card_no'),
			'issuer_name'	        =>	$this->input->post('card_holdername')
			);
			$this->db->where('bill_id',$billinfo->order_id);
			$this->db->update('bill_card_payment',$cardinfo);*/
			/*$updatetData = array('order_status'     => $this->input->post('status') );
			$this->db->where('order_id',$id);
			$this->db->update('customer_order',$updatetData);*/
			
			// Find the acc COAID for the Transaction
				$custmercode= $this->input->post('custmercode');
			    $custmername= $this->input->post('custmername');
				$invoice_no= $this->input->post('saleinvoice');
				$headn = $custmercode.'-'.$custmername;
				$coainfo = $this->db->select('*')->from('acc_coa')->where('HeadName',$headn)->get()->row();
				$customer_headcode = $coainfo->HeadCode;
				$invoice_no=$invoice_no;
				$saveid=$this->session->userdata('id');
			    $saveddate=date('Y-m-d H:i:s');	
				
		$crtransac = $this->db->select('*')->from('acc_transaction')->where('COAID',$customer_headcode)->where('VNo',$invoice_no)->where('Credit>',0)->get()->row();
		$detransac = $this->db->select('*')->from('acc_transaction')->where('COAID',$customer_headcode)->where('VNo',$invoice_no)->where('Debit>',0)->get()->row();
		$storetransac = $this->db->select('*')->from('acc_transaction')->where('COAID','10107')->where('VNo',$invoice_no)->get()->row();
		$cashtransac = $this->db->select('*')->from('acc_transaction')->where('COAID','1020101')->where('VNo',$invoice_no)->get()->row();
			//Customer debit for Product Value
				
				 $cosdr = array(
				  'Debit'          =>  $this->input->post('grandtotal'),
				  'CreateBy'       => $saveid,
				  'CreateDate'     => $saveddate
				); 
				$this->db->where('ID',$detransac->ID);
			    $this->db->update('acc_transaction',$cosdr);
				 //Store credit for Product Value
				  $sc =array(
				  'Credit'         =>  $this->input->post('grandtotal'),
				  'CreateBy'       => $saveid,
				  'CreateDate'     => $saveddate,
				);  
				$this->db->where('ID',$storetransac->ID);
			    $this->db->update('acc_transaction',$sc);
				 
				 // Customer Credit for paid amount.
				  $cc =array(
				  'Credit'         =>  $this->input->post('grandtotal'),
				  'CreateBy'       => $saveid,
				  'CreateDate'     => $saveddate
				);  
				$this->db->where('ID',$crtransac->ID);
			    $this->db->update('acc_transaction',$cc);
				
				 //Cash In hand Debit for paid value
				 $cdv = array(
				  'Debit'          =>  $this->input->post('grandtotal'),
				  'CreateBy'       => $saveid,
				  'CreateDate'     => $saveddate
				); 
				 $this->db->where('ID',$cashtransac->ID);
			    $this->db->update('acc_transaction',$cdv);
			
			//return false;	
			}
			else{
			//$payment= $this->input->post('card_type');
			$saveid=$this->session->userdata('id');
			$saveddate=date('Y-m-d H:i:s');
			if(!empty($payment)){
				$discount=$this->input->post('invoice_discount');
				$scharge=$this->input->post('service_charge');
				$vat=$this->input->post('vat');
				if($vat==''){
					$vat=0;
					}
				if($discount==''){
					$discount=0;
					}
			  if($scharge==''){
					$scharge=0;
					}
	/*	$billstatus=1;			
					if($payment==5){
						$billstatus=0;
						}
					else if($payment==3){
						$billstatus=0;
						}
					else if($payment==2){
						$billstatus=0;
						}*/	
				
			$billinfo=array(
			'customer_id'			=>	$orderinfo->customer_id,
			'order_id'		        =>	$id,
			'total_amount'	        =>	$this->input->post('subtotal'),
			'discount'	            =>	$discount,
			'service_charge'	    =>	$scharge,
			'VAT'		 	        =>  $vat,
			'bill_amount'		    =>	$this->input->post('grandtotal'),
			'bill_date'		        =>	date('Y-m-d'),
			'bill_time'		        =>	date('H:i:s'),
			'bill_status'		    =>	$this->input->post('bill_info'),
			'payment_method_id'		=>	$this->input->post('card_type'),
			'create_by'		        =>	$saveid,
			'create_date'		    =>	date('Y-m-d')
		);
		$this->db->insert('bill',$billinfo);
		$billid = $this->db->insert_id();
		/*$cardinfo=array(
			'bill_id'			    =>	$billid,
			'card_no'		        =>	$this->input->post('card_no'),
			'issuer_name'	        =>	$this->input->post('card_holdername')
		);
		$this->db->insert('bill_card_payment',$cardinfo);*/
				/*$updatetData =array('order_status'=> 4);
		        $this->db->where('order_id',$id);
				$this->db->update('customer_order',$updatetData);*/
				// Find the acc COAID for the Transaction
				$custmercode= $this->input->post('custmercode');
			    $custmername= $this->input->post('custmername');
				$invoice_no= $this->input->post('saleinvoice');
				$headn = $custmercode.'-'.$custmername;
				$coainfo = $this->db->select('*')->from('acc_coa')->where('HeadName',$headn)->get()->row();
				$customer_headcode = $coainfo->HeadCode;
				$trans_coa = $this->db->select('*')->from('acc_transaction')->where('VNo',$invoice_no)->where('COAID',$customer_headcode)->get()->row();
			    $updateid=$trans_coa->ID;
				$sell_coa= $this->db->select('*')->from('acc_transaction')->where('VNo',$invoice_no)->where('COAID','1020101')->get()->row();	
		        $updatesellid=$sell_coa->ID;
				$store_coa= $this->db->select('*')->from('acc_transaction')->where('VNo',$invoice_no)->where('COAID','10107')->get()->row();	
		        $updatestoreid=$store_coa->ID;
				
				
				//Customer debit for Product Value
				$invoice_no=$invoice_no;
				 $cosdr = array(
				  'VNo'            =>  $invoice_no,
				  'Vtype'          =>  'CIV',
				  'VDate'          =>  $saveddate,
				  'COAID'          =>  $customer_headcode,
				  'Narration'      =>  'Customer debit for Product Invoice#'.$invoice_no,
				  'Debit'          =>  $this->input->post('grandtotal'),
				  'Credit'         =>  0,
				  'StoreID'        =>  0,
				  'IsPosted'       => 1,
				  'CreateBy'       => $saveid,
				  'CreateDate'     => $saveddate,
				  'IsAppove'       => 1
				); 
				 $this->db->insert('acc_transaction',$cosdr);
				 //Store credit for Product Value
				  $sc =array(
				  'VNo'            =>  $invoice_no,
				  'Vtype'          =>  'CIV',
				  'VDate'          =>  $saveddate,
				  'COAID'          =>  10107,
				  'Narration'      =>  'Inventory Credit for Product Invoice#'.$invoice_no,
				  'Debit'          =>  0,
				  'Credit'         =>  $this->input->post('grandtotal'),
				  'StoreID'        =>  0,
				  'IsPosted'       => 1,
				  'CreateBy'       => $saveid,
				  'CreateDate'     => $saveddate,
				  'IsAppove'       => 1
				);  
				 $this->db->insert('acc_transaction',$sc);
				 
				 // Customer Credit for paid amount.
				  $cc =array(
				  'VNo'            =>  $invoice_no,
				  'Vtype'          =>  'CIV',
				  'VDate'          =>  $saveddate,
				  'COAID'          =>  $customer_headcode,
				  'Narration'      =>  'Customer Credit for Product Invoice#'.$invoice_no,
				  'Debit'          =>  0,
				  'Credit'         =>  $this->input->post('grandtotal'),
				  'StoreID'        =>  0,
				  'IsPosted'       => 1,
				  'CreateBy'       => $saveid,
				  'CreateDate'     => $saveddate,
				  'IsAppove'       => 1
				);  
				 $this->db->insert('acc_transaction',$cc);
				
				 //Cash In hand Debit for paid value
				 $cdv = array(
				  'VNo'            =>  $invoice_no,
				  'Vtype'          =>  'CIV',
				  'VDate'          =>  $saveddate,
				  'COAID'          =>  1020101,
				  'Narration'      =>  'Cash in hand Debit For Invoice#'.$invoice_no,
				  'Debit'          =>  $this->input->post('grandtotal'),
				  'Credit'         =>  0,
				  'StoreID'        =>  0,
				  'IsPosted'       =>  1,
				  'CreateBy'       => $saveid,
				  'CreateDate'     => $saveddate,
				  'IsAppove'       => 1
				); 
				 $this->db->insert('acc_transaction',$cdv);
				}	
			}
		    
			
		}
	public function payment_update($id = null){
			$this->db->select('*');
			$this->db->from('customer_order');
			$this->db->where('order_id',$id);
			$query = $this->db->get();
			$orderinfo=$query->row();
			
			$this->db->select('*');
			$this->db->from('bill');
			$this->db->where('order_id',$id);
			$query = $this->db->get();
			
			if ($query->num_rows() > 0) {
			return false;	
			}
			else{
			$saveid=$this->session->userdata('id');
			$saveddate=date('Y-m-d H:i:s');
			$billinfo=array(
			'customer_id'			=>	$orderinfo->customer_id,
			'order_id'		        =>	$id,
			'total_amount'	        =>	$this->input->post('subtotal'),
			'discount'	            =>	$this->input->post('discount'),
			'service_charge'	    =>	$this->input->post('scharge'),
			'VAT'		 	        =>  $this->input->post('tax'),
			'bill_amount'		    =>	$this->input->post('grandtotal'),
			'bill_date'		        =>	date('Y-m-d'),
			'bill_time'		        =>	date('H:i:s'),
			'bill_status'		    =>	1,
			'payment_method_id'		=>	$this->input->post('card_type'),
			'create_by'		        =>	$saveid,
			'create_date'		    =>	date('Y-m-d')
		);
		$this->db->insert('bill',$billinfo);
		$billid = $this->db->insert_id();
		$cardinfo=array(
			'bill_id'			    =>	$billid,
			'card_no'		        =>	$this->input->post('card_no'),
			'issuer_name'	        =>	$this->input->post('card_holdername')
		);
		$this->db->insert('bill_card_payment',$cardinfo);
				$updatetData = array(
				   'order_status'     => 4,
				  );
		        $this->db->where('order_id',$id);
				$this->db->update('customer_order',$updatetData);
				// Find the acc COAID for the Transaction
				$custmercode= $this->input->post('custmercode');
			    $custmername= $this->input->post('custmername');
				$invoice_no= $this->input->post('saleinvoice');
				$headn = $custmercode.'-'.$custmername;
				$coainfo = $this->db->select('*')->from('acc_coa')->where('HeadName',$headn)->get()->row();
				$customer_headcode = $coainfo->HeadCode;
				$trans_coa = $this->db->select('*')->from('acc_transaction')->where('VNo',$invoice_no)->where('COAID',$customer_headcode)->get()->row();
			    $updateid=$trans_coa->ID;
				$sell_coa= $this->db->select('*')->from('acc_transaction')->where('VNo',$invoice_no)->where('COAID','1020101')->get()->row();	
		        $updatesellid=$sell_coa->ID;
				//Customer debit for Product Value
				//$invoice_no=$sino;
				 $cosdr = array(
				  'Vtype'          =>  'CIV',
				  'VDate'          =>  $saveddate,
				  'Debit'          =>  $this->input->post('grandtotal'),
				  'UpdateBy'       => $saveid,
				  'UpdateDate'     => $saveddate
				); 
		    $this->db->where('ID',$updateid);
	        $this->db->update('acc_transaction',$cosdr);
				 
				 //Sell Credit for Cash In hand
				 $cdv = array(
				  'Vtype'          =>  'CIV',
				  'VDate'          =>  $saveddate,
				  'Credit'         =>  $this->input->post('grandtotal'),
				  'UpdateBy'       => $saveid,
				  'UpdateDate'     => $saveddate
				); 
				$this->db->where('ID',$updatesellid);
                $this->db->update('acc_transaction',$cdv);	
				
			}
		    
			
		}
	public function billinfo($id = null){
		$this->db->select('*');
        $this->db->from('bill');
		$this->db->where('order_id',$id);
		$query = $this->db->get();
		$billinfo=$query->row();
		return $billinfo;
		}
	public function shipinfo($id = null){
		$this->db->select('*');
        $this->db->from('tbl_shippingaddress');
		$this->db->where('orderid',$id);
		$query = $this->db->get();
		$billinfo=$query->row();
		return $billinfo;
		}
	public function customerinfo($id = null){
		$this->db->select('*');
        $this->db->from('customer_info');
		$this->db->where('customer_id',$id);
		$query = $this->db->get();
		$customer=$query->row();
		return $customer;
		}
	public function findById($id = null)
	{ 
		$this->db->select('item_foods.*,variant.variantid,variant.variantName,variant.price');
        $this->db->from('item_foods');
		$this->db->join('variant','item_foods.ProductsID=variant.menuid','left');
		$this->db->where('CategoryID',$id);
		$query = $this->db->get();
		$itemlist=$query->result();
	    return $itemlist;
	}
	public function findByvmenuId($id = null)
	{ 
		$this->db->select('item_foods.CategoryID,variant.variantid,variant.variantName,variant.price');
        $this->db->from('variant');
		$this->db->join('item_foods','item_foods.ProductsID=variant.menuid','left');
		$this->db->where('variant.menuid',$id);
		$query = $this->db->get();
		$itemlist=$query->result();
	    return $itemlist;
	}
	
	public function getiteminfo($id = null)
	{ 
		$this->db->select('*');
        $this->db->from('item_foods');
		$this->db->where('ProductsID',$id);
		$query = $this->db->get();
		$itemlist=$query->row();
	    return $itemlist;
	}
	
	public function searchprod($cid = null,$pname= null)
	{ 
		$this->db->select('*');
        $this->db->from('item_foods');
		if(!empty($cid)){
		$this->db->where('CategoryID',$cid);
		}
		$this->db->like('ProductName',$pname);
		$this->db->where('ProductsIsActive',1);
		$query = $this->db->get();
		$itemlist=$query->result();
		$output=array();
      	
		if(!empty($itemlist)){
			$k=0;
			foreach($itemlist as $items){
              	$output[$k]['totalvarient'] = 1;
				$varientinfo=$this->db->select("variant.*,count(menuid) as totalvarient")->from('variant')->where('menuid',$items->ProductsID)->get()->row();
				if(!empty($varientinfo)){
					$output[$k]['variantid']=$varientinfo->variantid;
					$output[$k]['totalvarient']=$varientinfo->totalvarient;
					$output[$k]['variantName']=$varientinfo->variantName;
					$output[$k]['price']=$varientinfo->price;
				}else{
					$output[$k]['variantid']='';
					$output[$k]['totalvarient']=0;
					$output[$k]['variantName']='';
					$output[$k]['price']='';
					}
				$output[$k]['ProductsID']=$items->ProductsID;
				$output[$k]['CategoryID']=$items->CategoryID;
				$output[$k]['ProductName']=$items->ProductName;
				$output[$k]['ProductImage']=$items->ProductImage;
				$output[$k]['bigthumb']=$items->bigthumb;
				$output[$k]['medium_thumb']=$items->medium_thumb;
				$output[$k]['small_thumb']=$items->small_thumb;
				$output[$k]['component']=$items->component;
				$output[$k]['descrip']=$items->descrip;
				$output[$k]['itemnotes']=$items->itemnotes;
				$output[$k]['menutype']=$items->menutype;
				$output[$k]['productvat']=$items->productvat;
				$output[$k]['special']=$items->special;
				$output[$k]['OffersRate']=$items->OffersRate;
				$output[$k]['offerIsavailable']=$items->offerIsavailable;
				$output[$k]['offerstartdate']=$items->offerstartdate;
				$output[$k]['offerendate']=$items->offerendate;
				$output[$k]['Position']=$items->Position;
				$output[$k]['kitchenid']=$items->kitchenid;
				$output[$k]['isgroup']=$items->isgroup;
				$output[$k]['is_customqty']=$items->is_customqty;
				$output[$k]['cookedtime']=$items->cookedtime;
				$output[$k]['ProductsIsActive']=$items->ProductsIsActive;
				$k++;	
				}
		}
	    return $output;
	}
	public function getuniqeproduct($pid= null, $vid = null)
	{ 
		$this->db->select('item_foods.*,variant.variantid,variant.variantName,variant.price');
        $this->db->from('item_foods');
		$this->db->join('variant','item_foods.ProductsID=variant.menuid','left');
		$this->db->where('ProductsID',$pid);
		$query = $this->db->get();
		$item=$query->row();
		//$varientinfo=$this->db->select("variant.*,count(menuid) as totalvarient")->from('variant')->where('menuid',$item->ProductsID)->get()->row();
	    //$item['totalvarient']=$varientinfo->totalvarient;
	    return $item;
	}
  
  public function getuniqevariant($vid = null)
	{ 
		$this->db->select('item_foods.*,variant.variantid,variant.variantName,variant.price');
        $this->db->from('item_foods');
		$this->db->join('variant','item_foods.ProductsID=variant.menuid','left');
		$this->db->where('variant.variantid',$vid);
		$query = $this->db->get();
		$item=$query->row();
		//$varientinfo=$this->db->select("variant.*,count(menuid) as totalvarient")->from('variant')->where('menuid',$item->ProductsID)->get()->row();
	    //$item['totalvarient']=$varientinfo->totalvarient;
	    return $item;
	}
  
  
	public function searchdropdown($pname= null){
		/*$this->db->select('item_foods.ProductsID as id,item_foods.ProductName as text, variant.price as price, variant.variantid as variantid, count(menuid) as totalvarient');
        $this->db->from('item_foods');*/
		$this->db->select('item_foods.ProductsID as id,item_foods.ProductName as text,variant.variantid,variant.variantName,variant.price, variant.menuid');
        $this->db->from('item_foods');
		$this->db->join('variant','item_foods.ProductsID=variant.menuid','left');
      	$this->db->like('item_foods.ProductName',$pname);
		$this->db->where('item_foods.ProductsIsActive',1);
		$query = $this->db->get();
		$itemlist=$query->result();
		//echo $this->db->last_query();
	    return $itemlist;

	}
	public function productinfo($id){
		$this->db->select('item_foods.*,variant.variantid,variant.variantName,variant.price');
        $this->db->from('item_foods');
		$this->db->join('variant','item_foods.ProductsID=variant.menuid','left');
		$this->db->where('ProductsID',$id);
		$query = $this->db->get();
		$itemlist=$query->row();
	    return $itemlist;
		}
	public function findid($id = null,$sid = null)
	{ 
		$this->db->select('item_foods.*,variant.variantid,variant.variantName,variant.price');
        $this->db->from('item_foods');
		$this->db->join('variant','item_foods.ProductsID=variant.menuid','left');
		$this->db->where('menuid',$id);
		$this->db->where('variantid',$sid);
		$query = $this->db->get();
		$itemlist=$query->row();
	    return $itemlist;
		
	}
	
 
 
   public function findaddons($id = null)
	{ 
		$this->db->select('add_ons.*');
        $this->db->from('menu_add_on');
		$this->db->join('add_ons','menu_add_on.add_on_id = add_ons.add_on_id','left');
		$this->db->where('menu_id',$id);
		$query = $this->db->get();
		$addons=$query->result();
	    return $addons;
	}
	 
	public function finditem($product_name)
		{ 
		$this->db->select('*');
		$this->db->from('ingredients');
		$this->db->where('is_active',1);
		$this->db->like('ingredient_name', $product_name);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
		}
	
//category Dropdown
 public function category_dropdown()
	{
		$data = $this->db->select("*")
			->from('item_category')
			->get()
			->result();

		$list[''] = 'Select Food Category';
		if (!empty($data)) {
			foreach($data as $value)
				$list[$value->CategoryID] = $value->Name;
			return $list;
		} else {
			return false; 
		}
	}
public function customer_dropdown()
	{
		$data = $this->db->select("*")
			->from('customer_info')
			->get()
			->result();

		$list[''] = 'Select Customer';
		if (!empty($data)) {
			foreach($data as $value)
				$list[$value->customer_id] = $value->customer_name;
			return $list;
		} else {
			return false; 
		}
	}

    public function hotel_customer_dropdown()
    {
        $hoteldb = $this->load->database('hmsdb', TRUE);

        $data = $hoteldb->where('O.status',4)
            //->where('O.status =',3)
            ->where('O.check_in <=',date('y-m-d'))
            ->where('O.check_out >=',date('y-m-d'))
            ->order_by('O.ordered_on','DESC')
            ->select('O.*,O.id as order_id, O.order_no as book_id,R.shortcode as room, N.*, G.firstname,G.lastname,G.id')
            ->join('room_types R', 'R.id = O.room_type_id', 'LEFT')
            ->join('rooms N', 'O.room_id = N.id', 'LEFT')
            ->join('guests G', 'G.id = O.guest_id', 'LEFT')
            ->get('orders O')
            ->result();

        $list[''] = 'Select Customer';
        if (!empty($data)) {
          $list[$guest->id] = '';
            foreach($data as $guest)
                $list[$guest->id] = $guest->firstname.' '.$guest->lastname.' |'. $guest->order_id .'| Rm.#'. $guest->room_no. '|'.$guest->room.'| PX: '. $guest->adults.'Adults '.$guest->kids.' Kids';
            
          
          return $list;
        } else {
            return false;
        }

    }

    function get_hotel_guest($id)
    {
        $hoteldb = $this->load->database('hmsdb', TRUE);
        $hoteldb->where('G.id', $id);
        $hoteldb->select('G.*,C.name country,S.name state,CT.name city');
        $hoteldb->join('countries C', 'C.id = G.country_id', 'LEFT');
        $hoteldb->join('cities CT', 'CT.id = G.city_id', 'LEFT');
        $hoteldb->join('states S', 'S.id = G.state_id', 'LEFT');
        $result =  $hoteldb->get('guests G');
      
        return $result->row();
    }

    public function ctype_dropdown()
	{
		$data = $this->db->select("*")
			->from('customer_type')
            ->order_by('ordering','asc')
			->get()
			->result();

		$list[''] = 'Select Customer Type';
		if (!empty($data)) {
			foreach($data as $value)
				$list[$value->customer_type_id] = $value->customer_type;
			return $list;
		} else {
			return false; 
		}
	}
  public function thirdparty_dropdown()
	{
		$data = $this->db->select("*")
			->from('tbl_thirdparty_customer')
			->get()
			->result();

		$list[''] = 'Select Delivery Company';
		if (!empty($data)) {
			foreach($data as $value)
				$list[$value->companyId] = $value->company_name;
			return $list;
		} else {
			return false;
		}
	}
	public function all_kitchen() {
        $data = $this->db->select("*")
            ->from('tbl_kitchen')
            ->order_by('kitchenid')
            ->get()
            ->result();
        return $data;
    }
  public function bank_dropdown()
	{
		$data = $this->db->select("*")
			->from('tbl_bank')
			->get()
			->result();

		$list[''] = 'Select Bank';
		if (!empty($data)) {
			foreach($data as $value)
				$list[$value->bankid] = $value->bank_name;
			return $list;
		} else {
			return false; 
		}
	}
 public function allterminal_dropdown()
	{
		$data = $this->db->select("*")
			->from('tbl_card_terminal')
			->get()
			->result();

		$list[''] = 'Select Card Terminal';
		if (!empty($data)) {
			foreach($data as $value)
				$list[$value->card_terminalid] = $value->terminal_name;
			return $list;
		} else {
			return false; 
		}
	}
 public function waiter_dropdown()
	{
		
			$shiftmangment = $this->db->where('directory','shiftmangment')->where('status',1)->get('module')->num_rows();
			if($shiftmangment == 1){
			$data = $this->shiftwisecustomer();
			}
			else{
				$data = $this->waiterwithshift();
			}

		$list[''] = 'Select Waiter';
		if (!empty($data)) {
			foreach($data as $value)
				$list[$value->emp_his_id] = $value->first_name." ".$value->last_name;
			return $list;
		} else {
			return false; 
		}
	}
 public function waiterwithshift(){
 	$data = $this->db->select("emp_his_id,first_name,last_name")
			->from('employee_history')
			->where('pos_id',6)
			->get()
			->result();
			return $data;
 }
 public function shiftwisecustomer()
    {
    	 $timezone = $this->db->select('timezone')->get('setting')->row();
         $tz_obj = new DateTimeZone($timezone->timezone);
		$today = new DateTime("now", $tz_obj);
		$today_formatted = $today->format('H:i:s');
		$where = "'$today_formatted' BETWEEN start_Time and end_Time";
		$current_shift= $this->db->select('*')
			->from('shifts')
			->where($where)
			->get()
			->row();
			$data= array();
			if(!empty($current_shift)){
			$this->db->select("emp.emp_his_id,emp.first_name,emp.last_name,emp.employee_id");
			$this->db->from('employee_history as emp');
			$this->db->join('shift_user as s','emp.employee_id=s.emp_id','left');
			$this->db->where('emp.pos_id',6);
			$this->db->where('s.shift_id',$current_shift->id);
			$data = $this->db->get()->result();
			}
			return $data;
    }
	public function table_dropdown()
	{
		$data = $this->db->select("*")
			->from('rest_table')
			->get()
			->result();

		$list[''] = 'Select Table';
		if (!empty($data)) {
			foreach($data as $value)
				$list[$value->tableid] = $value->tablename;
			return $list;
		} else {
			return false; 
		}
	}

    public function vacant_table_dropdown()
    {
        $cdate = date('Y-m-d');
        $data = $this->db->select("*")
            ->from('rest_table')
            ->get()
            ->result();

        $list[''] = 'Select Table';
        if (!empty($data)) {
            foreach($data as $value) {

                $data1 = $this->db->select("*")
                    ->from('table_details')
                    ->where('table_id', $value->tableid)
                    ->where('created_at', $cdate)
                    ->get()
                    ->result();
                if(empty($data1)) {
                    $list[$value->tableid] = $value->tablename;
                }
                $data1 = '';

            }
            return $list;
        } else {
            return false;
        }
    }

 public function pmethod_dropdown(){
	 	$data = $this->db->select("*")
			->from('payment_method')
			->where('is_active',1)
			->get()
			->result();

		$list[''] = 'Select Method';
		if (!empty($data)) {
			foreach($data as $value)
				$list[$value->payment_method_id] = $value->payment_method;
			return $list;
		} else {
			return false; 
		}
	 }
   //Pending Order
  public function insert_data($table, $data)
    {
        $this->db->insert($table, $data);
		//echo $this->db->last_query();
        return $this->db->insert_id();
    }
  public function read($select_items, $table, $where_array)
    {
	    $this->db->select($select_items);
        $this->db->from($table);
        foreach ($where_array as $field => $value) {
            $this->db->where($field, $value);
        }
        return $this->db->get()->row();
    }
	public function read_all($select_items, $table, $where_array, $order_by_name = NULL, $order_by = NULL)
    {
        $this->db->select($select_items);
        $this->db->from($table);
        foreach ($where_array as $field => $value) {
            $this->db->where($field, $value);
        }
        if ($order_by_name != NULL && $order_by != NULL)
        {
            $this->db->order_by($order_by_name, $order_by);
        }
        return $this->db->get()->result();
    }
	public function readupdate($select_items, $table, $where_array)
    {
	    $this->db->select($select_items);
        $this->db->from($table);
        foreach ($where_array as $field => $value) {
            $this->db->where($field, $value);
        }
        $this->db->order_by('updateid', 'DESC');
        $this->db->limit(1);
        //echo $this->db->last_query();
        return $this->db->get()->row();
    }
    public function read_allgroup($select_items, $table, $where_array)
    {
        $this->db->select($select_items);
        $this->db->from($table);
        foreach ($where_array as $field => $value) {
            $this->db->where($field, $value);
        }
        $this->db->order_by('ordid', 'Asc');
      
        return $this->db->get()->result();
    }
	
	public function orderlist($limit = null, $start = null){

//        $hoteldb = $this->load->database('hmsdb', TRUE);
//        $hoteldb->select('guests.*');
//        $hoteldb->from('guests');
//        $query =  $hoteldb->get();
//        $guests=$query->result();

   
			$this->db->select('customer_order.*,customer_order.customer_id AS cust_id,customer_info.customer_name,customer_type.customer_type_id,employee_history.first_name,employee_history.last_name,rest_table.tablename');
			$this->db->from('customer_order');
			$this->db->join('customer_info','customer_order.customer_id=customer_info.customer_id','left');
			$this->db->join('customer_type','customer_order.cutomertype=customer_type.customer_type_id','left');
			$this->db->join('employee_history','customer_order.waiter_id=employee_history.emp_his_id','left');
			$this->db->join('rest_table','customer_order.table_no=rest_table.tableid','left');
			$this->db->order_by('customer_order.order_id', 'DESC');
			//$this->db->group_by('customer_order.order_id');
			$this->db->limit($limit, $start);
			$query =  $this->db->get();
			$orderdetails=$query->result();
     
			return $orderdetails;
		}
	public function count_order()
	{
		$this->db->select('customer_order.*,customer_info.customer_name,customer_type.customer_type,employee_history.first_name,employee_history.last_name,rest_table.tablename');
		$this->db->from('customer_order');
		$this->db->join('customer_info','customer_order.customer_id=customer_info.customer_id','left');
		$this->db->join('customer_type','customer_order.cutomertype=customer_type.customer_type_id','left');
		$this->db->join('employee_history','customer_order.waiter_id=employee_history.emp_his_id','left');
		$this->db->join('rest_table','customer_order.table_no=rest_table.tableid','left');
        $query = $this->db->get();
      //var_dump($query->result());die();
        if ($query->num_rows() > 0) {
            return $query->num_rows();  
        }
        return false;
	}
    public function pendingorder($limit = null, $start = null, $status= null){
/*original code
		$sql="SELECT customer_order.*,customer_info.customer_name,customer_type.customer_type,employee_history.first_name,employee_history.last_name,rest_table.tablename FROM customer_order LEFT JOIN customer_info ON customer_info.customer_id=customer_order.customer_id LEFT JOIN customer_type ON customer_type.customer_type_id=customer_order.cutomertype LEFT JOIN employee_history ON employee_history.emp_his_id=customer_order.waiter_id LEFT JOIN rest_table ON rest_table.tableid=customer_order.table_no WHERE customer_order.order_status = $status ORDER BY customer_order.order_id DESC";
		$query=$this->db->query($sql);	
		$orderdetails=$query->result();
	    return $orderdetails;
original code*/

      /*$start_date = date('Y-m-d');
      $end_date = date('Y-m-d');
      echo $start_date." ".$end_date;die();*/
      
    
            //date_default_timezone_set('Asia/Manila');
            if($this->input->post('start_date')){
		      $start_date = $this->input->post('start_date');   
            }else{
                $start_date = date('Y-m-d');  
            }if($this->input->post('end_date')){
                $end_date = $this->input->post('end_date');  
            }else{
                $end_date = date('Y-m-d');  
            }

      
          //echo $start_date." ".$end_date;die();
      

      
      		$sql="SELECT customer_order.*,customer_info.customer_name,customer_type.customer_type,employee_history.first_name,employee_history.last_name,rest_table.tablename FROM customer_order LEFT JOIN customer_info ON customer_info.customer_id=customer_order.customer_id LEFT JOIN customer_type ON customer_type.customer_type_id=customer_order.cutomertype LEFT JOIN employee_history ON employee_history.emp_his_id=customer_order.waiter_id LEFT JOIN rest_table ON rest_table.tableid=customer_order.table_no WHERE customer_order.order_status = $status
            AND DATE(customer_order.order_date) BETWEEN '$start_date' AND '$end_date' ORDER BY customer_order.order_id DESC";

		$query=$this->db->query($sql);	
		$orderdetails=$query->result();
	    return $orderdetails;



      
	   }
	public function count_canorder($status= null)
	{
		$this->db->select('customer_order.*,customer_info.customer_name,customer_type.customer_type,employee_history.first_name,employee_history.last_name,rest_table.tablename');
        $this->db->from('customer_order');
		$this->db->join('customer_info','customer_order.customer_id=customer_info.customer_id','left');
		$this->db->join('customer_type','customer_order.cutomertype=customer_type.customer_type_id','left');
		$this->db->join('employee_history','customer_order.waiter_id=employee_history.emp_his_id','left');
		$this->db->join('rest_table','customer_order.table_no=rest_table.tableid','left');
		$this->db->where('customer_order.order_status',$status);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();  
        }
        return false;
	}
	public function completeorder($limit = null, $start = null, $status= null){
      //var_dump($this->input->post());die();
//newly added      
date_default_timezone_set('Asia/Manila');
      
      if($this->input->post('start_date')){
	      $start_date = $this->input->post('start_date');   
      }else{
	      $start_date = date('Y-m-d');  
      }if($this->input->post('end_date')){
	      $end_date = $this->input->post('end_date');  
      }else{
	      $end_date = date('Y-m-d');  
      }
      

//newly added
      	$sql = "SELECT customer_order.*, customer_order.customer_id AS cust_id, customer_info.customer_name, customer_type.customer_type, employee_history.first_name, employee_history.last_name, rest_table.tablename
        FROM customer_order
        LEFT JOIN customer_info ON customer_order.customer_id = customer_info.customer_id
        LEFT JOIN customer_type ON customer_order.cutomertype = customer_type.customer_type_id
        LEFT JOIN employee_history ON customer_order.waiter_id = employee_history.emp_his_id
        LEFT JOIN rest_table ON customer_order.table_no = rest_table.tableid
        LEFT JOIN bill ON customer_order.order_id = bill.order_id
        WHERE bill.bill_status = $status
          AND DATE(customer_order.order_date) BETWEEN '$start_date' AND '$end_date' ORDER BY customer_order.order_id DESC";

        $query=$this->db->query($sql);	
		$orderdetails=$query->result();
	    return $orderdetails;
//newly added
                                         
/* original code
		$sql="SELECT customer_order.*,customer_order.customer_id AS cust_id,customer_info.customer_name,customer_type.customer_type,employee_history.first_name,employee_history.last_name,rest_table.tablename FROM customer_order LEFT JOIN customer_info ON customer_order.customer_id=customer_info.customer_id LEFT JOIN customer_type ON customer_order.cutomertype=customer_type.customer_type_id LEFT JOIN employee_history ON customer_order.waiter_id=employee_history.emp_his_id LEFT JOIN rest_table ON customer_order.table_no=rest_table.tableid LEFT JOIN bill ON customer_order.order_id=bill.order_id WHERE bill.bill_status = $status";      

      $query=$this->db->query($sql);	
		$orderdetails=$query->result();
	    return $orderdetails;
original code */


	   }
	 public function count_comorder($status)
	{
		$this->db->select('customer_order.*,customer_info.customer_name,customer_type.customer_type,employee_history.first_name,employee_history.last_name,rest_table.tablename');
        $this->db->from('customer_order');
		$this->db->join('customer_info','customer_order.customer_id=customer_info.customer_id','left');
		$this->db->join('customer_type','customer_order.cutomertype=customer_type.customer_type_id','left');
		$this->db->join('employee_history','customer_order.waiter_id=employee_history.emp_his_id','left');
		$this->db->join('rest_table','customer_order.table_no=rest_table.tableid','left');
		$this->db->join('bill','customer_order.order_id=bill.order_id','left');
		$this->db->where('bill.bill_status',$status);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();  
        }
        return false;
	}  
	public function customerorder($id,$nststus=null){
		if(!empty($nststus)){
		    $where="order_menu.order_id = '".$id."' AND order_menu.isupdate='".$nststus."' ";
		}
		else{
			$where="order_menu.order_id = '".$id."' ";
			}
/*		$sql="SELECT order_menu.row_id,order_menu.order_id,order_menu.groupmid as menu_id,order_menu.notes,order_menu.add_on_id,order_menu.addonsqty,order_menu.groupvarient as varientid,order_menu.addonsuid,order_menu.qroupqty as menuqty,order_menu.isgroup,order_menu.food_status,order_menu.allfoodready,order_menu.isupdate, item_foods.ProductName,  item_foods.kitchenid, variant.variantid, variant.variantName, variant.price FROM order_menu LEFT JOIN item_foods ON order_menu.groupmid=item_foods.ProductsID LEFT JOIN variant ON order_menu.groupvarient=variant.variantid WHERE {$where} AND order_menu.isgroup=1 Group BY order_menu.groupmid UNION SELECT order_menu.row_id,order_menu.order_id,order_menu.menu_id as menu_id,order_menu.notes,order_menu.add_on_id,order_menu.addonsqty,order_menu.varientid as varientid,order_menu.addonsuid,order_menu.menuqty as menuqty,order_menu.isgroup,order_menu.food_status,order_menu.allfoodready,order_menu.isupdate, item_foods.ProductName, item_foods.kitchenid, variant.variantid, variant.variantName, variant.price FROM order_menu LEFT JOIN item_foods ON order_menu.menu_id=item_foods.ProductsID LEFT JOIN variant ON order_menu.varientid=variant.variantid WHERE {$where} AND order_menu.isgroup=0";
*/
      
      		$sql="SELECT order_menu.row_id,order_menu.order_id,order_menu.groupmid as menu_id,order_menu.notes,order_menu.add_on_id,order_menu.addonsqty,order_menu.groupvarient as varientid,order_menu.addonsuid,order_menu.qroupqty as menuqty,order_menu.isgroup,order_menu.food_status,order_menu.allfoodready,order_menu.isupdate, item_foods.ProductName,  item_foods.kitchenid, variant.variantid, variant.variantName, variant.price, customer_order.order_id, customer_order.note FROM order_menu LEFT JOIN item_foods ON order_menu.groupmid=item_foods.ProductsID LEFT JOIN customer_order ON order_menu.order_id=customer_order.order_id LEFT JOIN variant ON order_menu.groupvarient=variant.variantid WHERE {$where} AND order_menu.isgroup=1 Group BY order_menu.groupmid UNION SELECT order_menu.row_id,order_menu.order_id,order_menu.menu_id as menu_id,order_menu.notes,order_menu.add_on_id,order_menu.addonsqty,order_menu.varientid as varientid,order_menu.addonsuid,order_menu.menuqty as menuqty,order_menu.isgroup,order_menu.food_status,order_menu.allfoodready,order_menu.isupdate, item_foods.ProductName, item_foods.kitchenid, variant.variantid, variant.variantName, variant.price, customer_order.order_id, customer_order.note FROM order_menu LEFT JOIN item_foods ON order_menu.menu_id=item_foods.ProductsID LEFT JOIN customer_order ON order_menu.order_id=customer_order.order_id LEFT JOIN variant ON order_menu.varientid=variant.variantid WHERE {$where} AND order_menu.isgroup=0";

      
      /*
      $this->db->where('order_id', $id);
      $query = $this->db->get('customer_order');
      $customer_order = $query->result();*/
      //var_dump($customer_order);die();
      
      
      
      //LEFT JOIN variant ON order_menu.varientid=variant.variantid WHERE {$where} AND order_menu.isgroup=0
        
		$query=$this->db->query($sql);
		//echo $this->db->last_query();
        return $query->result();
		}
	public function findgrouporderid($id,$menuid,$vid)
	{ 
		$this->db->select('order_menu.*,item_foods.ProductName,variant.variantid,variant.variantName,variant.price');
        $this->db->from('order_menu');
		$this->db->join('item_foods','order_menu.menu_id=item_foods.ProductsID','left');
		$this->db->join('variant','order_menu.varientid=variant.variantid','left');
		$this->db->where('order_menu.order_id',$id);
		$this->db->where('order_menu.groupmid',$menuid);
		$this->db->where('order_menu.groupvarient',$vid);
		$query = $this->db->get();
		$orderinfo=$query->row();
	    return $orderinfo;
		
	}
	public function customerorderkitchen($id,$kitchen){
		$this->db->select('order_menu.*,item_foods.ProductName,item_foods.kitchenid,item_foods.cookedtime,variant.variantid,variant.variantName,variant.price');
        $this->db->from('order_menu');
		$this->db->join('item_foods','order_menu.menu_id=item_foods.ProductsID','left');
		$this->db->join('variant','order_menu.varientid=variant.variantid','left');
		$this->db->where('order_menu.order_id',$id);
		$this->db->where('item_foods.kitchenid',$kitchen);
		$query = $this->db->get();
		$orderinfo=$query->result();
		//echo $this->db->last_query();
	    return $orderinfo;
		}
	public function kitchen_ajaxorderinfoall($id){
		$this->db->select('customer_order.*,customer_info.customer_name,customer_type.customer_type,employee_history.first_name,employee_history.last_name,rest_table.tablename');
        $this->db->from('customer_order');
		$this->db->join('customer_info','customer_order.customer_id=customer_info.customer_id','left');
		$this->db->join('customer_type','customer_order.cutomertype=customer_type.customer_type_id','left');
		$this->db->join('employee_history','customer_order.waiter_id=employee_history.emp_his_id','left');
		$this->db->join('rest_table','customer_order.table_no=rest_table.tableid','left');
		$this->db->where('customer_order.order_id',$id);
		$this->db->group_by('customer_order.order_id');
		$query = $this->db->get();
		//echo $this->db->last_query();
		$orderdetails=$query->row();
	    return $orderdetails;
		
		}
	public function kitchen_ajaxorderinfo($id){
		$this->db->select('customer_order.*,customer_info.customer_name,customer_info.memberid,customer_type.customer_type,employee_history.first_name,employee_history.last_name,rest_table.tablename');
        $this->db->from('customer_order');
		$this->db->join('customer_info','customer_order.customer_id=customer_info.memberid','left');
		$this->db->join('customer_type','customer_order.cutomertype=customer_type.customer_type_id','left');
		$this->db->join('employee_history','customer_order.waiter_id=employee_history.emp_his_id','left');
		$this->db->join('rest_table','customer_order.table_no=rest_table.tableid','left');
		$this->db->where('customer_order.order_id',$id);
		$this->db->group_by('customer_order.order_id');
		$query = $this->db->get();
		//echo $this->db->last_query();
		$orderdetails=$query->result();
	    return $orderdetails;
		
		}
	public function update_order($data = array())
	{
		return $this->db->where('order_id',$data["order_id"])->update('customer_order', $data);
	}
	public function cartitem_delete($id = null,$orderid=null)
	{
		$this->db->where('row_id',$id)->delete('order_menu');

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 
	public function show_marge_payment($id){
		$customer_id = $this->db->select("customer_id")->from('customer_order')->where('order_id',$id)->get()->row();
		$where="(order_status = 1 OR order_status = 2 OR order_status = 3)";
		$marge=$this->db->select("*")->from('customer_order')->where('customer_id',$customer_id->customer_id)->where($where)->get();
		$orderdetails=$marge->result();
	    return $orderdetails;
		
	}
	public function uniqe_order_id($id){
		$this->db->select('*');
        $this->db->from('customer_order');
		$this->db->where('order_id',$id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row();	
		}
		return false;
		}
	public function margeview($id){
		$this->db->select('customer_order.*,order_menu.*,item_foods.ProductName,variant.variantid,variant.variantName,variant.price');
        $this->db->from('customer_order');		
		$this->db->join('order_menu','customer_order.order_id=order_menu.order_id','left');
		$this->db->join('item_foods','order_menu.menu_id=item_foods.ProductsID','Inner');
		$this->db->join('variant','order_menu.varientid=variant.variantid','Inner');
		$this->db->where('customer_order.marge_order_id',$id);
		$query = $this->db->get();
		//echo $this->db->last_query();
		if ($query->num_rows() > 0) {
			return $query->result();	
		}
		return false;
		}
	public function margebill($id){
		$this->db->select('customer_order.*,bill.total_amount,bill.bill_amount,bill.bill_status,bill.service_charge,bill.discount,bill.VAT');
        $this->db->from('customer_order');		
		$this->db->join('bill','customer_order.order_id=bill.order_id','left');
		$this->db->where('customer_order.marge_order_id',$id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();	
		}
		return false;
		}
	public function customerorderMarge($id,$nststus=null){
		$this->db->select('order_menu.*,item_foods.ProductName,variant.variantid,variant.variantName,variant.price');
        $this->db->from('order_menu');
		$this->db->join('item_foods','order_menu.menu_id=item_foods.ProductsID','left');
		$this->db->join('variant','order_menu.varientid=variant.variantid','left');
		$this->db->where_in('order_menu.order_id',$id);
		if($nststus==1){
		$this->db->where('order_menu.isupdate',$nststus);
		}
		$query = $this->db->get();
		$orderinfo=$query->result();
	    return $orderinfo;
		}
	
	public function check_order($orderid,$pid,$vid,$auid){
		$this->db->select('*');
        $this->db->from('order_menu');
		$this->db->where('order_id',$orderid);
		$this->db->where('menu_id',$pid);
		$this->db->where('varientid',$vid);
		$this->db->where('addonsuid',$auid);
      	$this->db->where('food_status', 0);
		$query = $this->db->get();
		//echo $this->db->last_query();
		if ($query->num_rows() > 0) {
			return $query->row();	
		}
		return false;
		}
   public function check_ordergroup($orderid,$pid,$vid,$auid){
		$this->db->select('*');
        $this->db->from('order_menu');
		$this->db->where('order_id',$orderid);
		$this->db->where('groupmid',$pid);
		$this->db->where('groupvarient',$vid);
		$this->db->where('addonsuid',$auid);
		$query = $this->db->get();
		//echo $this->db->last_query();
		if ($query->num_rows() > 0) {
			return $query->row();	
		}
		return false;
		}
   public function menucheck($orderid){
	   		$this->db->select('*');
			$this->db->where('order_id',$orderid);
			$query = $this->db->get();
			if ($query->num_rows() > 0) {
				return $query->result();	
			}
			return false;
	   }
   public function new_entry($data = array())
	{
		return $this->db->insert('order_menu', $data);
	} 
	public function update_info($table, $data, $field_name, $field_value)
    {
      
        $this->db->where($field_name, $field_value);
        $this->db->update($table, $data);
        
      	return $this->db->affected_rows();
    }
  
  public function update_order_info($id, $data)
    {    
       	$this->db->where('order_id', $id);
        $this->db->update('customer_order', $data);
        return $this->db->affected_rows();
    }
	public function settinginfo()
	{ 
		return $this->db->select("*")->from('setting')
			->get()
			->row();
	}
	public function currencysetting($id = null)
	{ 
		return $this->db->select("*")->from('currency')
			->where('currencyid',$id) 
			->get()
			->row();
	}
	public function get_ongoingorder(){
		$cdate=date('Y-m-d');
		$where="customer_order.order_date = '".$cdate."' AND ((customer_order.order_status = 1 OR customer_order.order_status = 2 OR customer_order.order_status = 3) AND ((customer_order.cutomertype = 100 AND customer_order.orderacceptreject = 1) || (customer_order.cutomertype = 99 AND customer_order.orderacceptreject = 1) || (customer_order.cutomertype = 3 || customer_order.orderacceptreject != 1) || (customer_order.cutomertype = 4 || customer_order.orderacceptreject != 1) || (customer_order.cutomertype = 1 || customer_order.orderacceptreject != 1)))";
		$this->db->select('customer_order.*,customer_order.customer_id AS cust_id,customer_info.customer_name,customer_type.customer_type,employee_history.first_name,employee_history.last_name,rest_table.tablename');
        $this->db->from('customer_order');
		$this->db->join('customer_info','customer_order.customer_id=customer_info.customer_id','left');
		$this->db->join('customer_type','customer_order.cutomertype=customer_type.customer_type_id','left');
		$this->db->join('employee_history','customer_order.waiter_id=employee_history.emp_his_id','left');
		$this->db->join('rest_table','customer_order.table_no=rest_table.tableid','left');
		$this->db->where($where);
		$this->db->order_by('customer_order.order_id','desc');
		$query = $this->db->get();
		//echo $this->db->last_query();
		$orderdetails=$query->result();
	    return $orderdetails;
		}
		public function get_unique_ongoingorder_id($id){
		$where="customer_order.order_id = '".$id."'";
		$this->db->select('customer_order.*,customer_order.customer_id AS cust_id,customer_info.customer_name,customer_type.customer_type,employee_history.first_name,employee_history.last_name,rest_table.tablename');
        $this->db->from('customer_order');
		$this->db->join('customer_info','customer_order.customer_id=customer_info.customer_id','left');
		$this->db->join('customer_type','customer_order.cutomertype=customer_type.customer_type_id','left');
		$this->db->join('employee_history','customer_order.waiter_id=employee_history.emp_his_id','left');
		$this->db->join('rest_table','customer_order.table_no=rest_table.tableid','left');
		$this->db->where($where);
		$this->db->order_by('customer_order.order_id','desc');
		$query = $this->db->get();
		//echo $this->db->last_query();
		$orderdetails=$query->result();
	    return $orderdetails;
		}
		public function get_unique_ongoingtable_id($id){
		$cdate=date('Y-m-d');
		$where="customer_order.table_no = '".$id."' AND customer_order.order_date = '".$cdate."' AND customer_order.cutomertype !=2 AND (customer_order.order_status = 1 OR customer_order.order_status = 2 OR customer_order.order_status = 3)";
		$this->db->select('customer_order.*,customer_order.customer_id AS cust_id,customer_info.customer_name,customer_type.customer_type,employee_history.first_name,employee_history.last_name,rest_table.tablename');
        $this->db->from('customer_order');
		$this->db->join('customer_info','customer_order.customer_id=customer_info.customer_id','left');
		$this->db->join('customer_type','customer_order.cutomertype=customer_type.customer_type_id','left');
		$this->db->join('employee_history','customer_order.waiter_id=employee_history.emp_his_id','left');
		$this->db->join('rest_table','customer_order.table_no=rest_table.tableid','left');
		$this->db->where($where);
		$this->db->order_by('customer_order.order_id','desc');
		$query = $this->db->get();
		//echo $this->db->last_query();
		$orderdetails=$query->result();
	    return $orderdetails;
		}
    	/****start All order **********/
	private function get_allorder_query()
	{
//die();
    //    $hoteldb = $this->load->database('hmsdb', TRUE);



			$column_order = array(null, 'customer_order.saleinvoice','customer_info.customer_id','customer_type.customer_type','CONCAT_WS(" ", employee_history.first_name,employee_history.last_name)','rest_table.tablename','customer_order.order_date','customer_order.totalamount'); //set column field database for datatable orderable
			$column_search = array('customer_order.saleinvoice','customer_info.customer_id','customer_type.customer_type','CONCAT_WS(" ", employee_history.first_name,employee_history.last_name)','rest_table.tablename','customer_order.order_date','customer_order.totalamount'); //set column field database for datatable searchable 
			$order = array('customer_order.order_id' => 'asc');
			$this->db->select('customer_order.*,customer_order.customer_name as hotel_customer,payment_method.payment_method,customer_order.customer_id AS cust_id,customer_info.customer_name,customer_info.customer_id,customer_type.customer_type,CONCAT_WS(" ", employee_history.first_name,employee_history.last_name) AS fullname,rest_table.tablename');
        //    $hoteldb->select('guests.firstname,guests.lastname,guests.id');
       //     $hoteldb->join('guests','guests.id=customer_order.customer_id','left');
			$this->db->from('customer_order');
//newly added
//4 means served
	//$this->db->where('order_status', 5);
      //$this->db->limit(10);
      //$this->db->where('order_date =', date('Y-m-d'));
//newly added
      
			$this->db->join('customer_info','customer_order.customer_id=customer_info.customer_id','left');
			$this->db->join('customer_type','customer_order.cutomertype=customer_type.customer_type_id','left');
      		$this->db->join('bill','bill.order_id=customer_order.order_id','left');
      		$this->db->join('payment_method','payment_method.payment_method_id=bill.payment_method_id','left');
			$this->db->join('employee_history','customer_order.waiter_id=employee_history.emp_his_id','left');
			$this->db->join('rest_table','customer_order.table_no=rest_table.tableid','left');
			$this->db->order_by('customer_order.order_id', 'DESC');
//$this->db->limit(10, 50);	
      //$this->db->limit(10);	
      
      
	$i = 0;
      /*original code*/
		foreach ($column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); 
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
      /*orignal code */
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($order))
		{
			$order = $order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}
	public function get_allorder()
	{
      //var_dump($_POST['length']);die();
      //echo json_encode($_POST['length']);
      //die();
		$this->get_allorder_query();
		if($_POST['length'] != -1)
//original code
		$this->db->limit($_POST['length'], $_POST['start']);
//original code
//newly added
       //$this->db->limit(10); 
//newly added
		$query = $this->db->get();

      //echo json_encode($query->result());
      //die();
      
		//echo $this->db->last_query();

		return $query->result();
	}
	public function count_filterallorder()
	{
		$this->get_allorder_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_allorder()
	{
		    $this->db->select('customer_order.*,customer_info.customer_name,customer_info.customer_id,customer_type.customer_type,CONCAT_WS(" ", employee_history.first_name,employee_history.last_name) AS fullname,rest_table.tablename');
			$this->db->from('customer_order');
			$this->db->join('customer_info','customer_order.customer_id=customer_info.customer_id','left');
			$this->db->join('customer_type','customer_order.cutomertype=customer_type.customer_type_id','left');
			$this->db->join('employee_history','customer_order.waiter_id=employee_history.emp_his_id','left');
			$this->db->join('rest_table','customer_order.table_no=rest_table.tableid','left');
		    return $this->db->count_all_results();
	}
	/**********endalorder*********/	
	public function get_unique_ongoingorder($name){
		$cdate=date('Y-m-d');
		$where="customer_order.order_date = '".$cdate."' AND customer_order.cutomertype !=2 AND (customer_order.order_status = 1 OR customer_order.order_status = 2 OR customer_order.order_status = 3)";
		$this->db->select('customer_order.order_id as id,customer_order.customer_id AS cust_id,CONCAT(rest_table.tablename, "(", customer_order.order_id,")") as text');
        $this->db->from('customer_order');
		$this->db->join('customer_info','customer_order.customer_id=customer_info.customer_id','left');
		$this->db->join('customer_type','customer_order.cutomertype=customer_type.customer_type_id','left');
		$this->db->join('employee_history','customer_order.waiter_id=employee_history.emp_his_id','left');
		$this->db->join('rest_table','customer_order.table_no=rest_table.tableid','left');
		$this->db->like('customer_order.order_id',$name);
		$this->db->where($where);
		$query = $this->db->get();
		//echo $this->db->last_query();
		$tablewiseorderdetails=$query->result();
	    return $tablewiseorderdetails;
	}
	public function get_unique_ongoingtable($name){
		$cdate=date('Y-m-d');
		$where="customer_order.order_date = '".$cdate."' AND customer_order.cutomertype !=2 AND (customer_order.order_status = 1 OR customer_order.order_status = 2 OR customer_order.order_status = 3)";
		$this->db->select('rest_table.tableid as id,rest_table.tablename as text');
        $this->db->from('customer_order');
		$this->db->join('customer_info','customer_order.customer_id=customer_info.customer_id','left');
		$this->db->join('customer_type','customer_order.cutomertype=customer_type.customer_type_id','left');
		$this->db->join('employee_history','customer_order.waiter_id=employee_history.emp_his_id','left');
		$this->db->join('rest_table','customer_order.table_no=rest_table.tableid','left');
		$this->db->like('rest_table.tablename',$name);
		$this->db->where($where);
		$this->db->group_by('rest_table.tablename');
		$query = $this->db->get();
		//echo $this->db->last_query();
		$tablewiseorderdetails=$query->result();
	    return $tablewiseorderdetails;
	}		

	public function kitchen_ongoingorder($id){
		$cdate=date('Y-m-d');
		$where="customer_order.order_date = '".$cdate."' AND order_menu.allfoodready IS NULL AND ((customer_order.order_status = 1 OR customer_order.order_status = 2) AND ((customer_order.cutomertype = 2 AND customer_order.orderacceptreject = 1) || (customer_order.cutomertype = 99 AND customer_order.orderacceptreject = 1) || (customer_order.cutomertype = 3 || customer_order.orderacceptreject != 1) || (customer_order.cutomertype = 4 || customer_order.orderacceptreject != 1) || (customer_order.cutomertype = 1 || customer_order.orderacceptreject != 1)))";
		$this->db->select('customer_order.*,customer_order.customer_id AS cust_id,item_foods.kitchenid,order_menu.menu_id,customer_info.customer_name,customer_type.customer_type,employee_history.first_name,employee_history.last_name,rest_table.tablename');
        $this->db->from('customer_order');
		$this->db->join('customer_info','customer_order.customer_id=customer_info.customer_id','left');
		$this->db->join('customer_type','customer_order.cutomertype=customer_type.customer_type_id','left');
		$this->db->join('employee_history','customer_order.waiter_id=employee_history.emp_his_id','left');
		$this->db->join('rest_table','customer_order.table_no=rest_table.tableid','left');
		$this->db->join('order_menu','order_menu.order_id=customer_order.order_id','left');
		$this->db->join('item_foods','item_foods.ProductsID=order_menu.menu_id','Inner');
		$this->db->where($where);
		$this->db->where('item_foods.kitchenid',$id);
		$this->db->group_by('customer_order.order_id');
		$query = $this->db->get();
		//echo $this->db->last_query();
		$orderdetails=$query->result();
	    return $orderdetails;
		}
	public function kitchen_ongoingorderall(){
		$cdate=date('Y-m-d');
		$where="customer_order.order_date = '".$cdate."' AND ((customer_order.order_status = 1 OR customer_order.order_status = 2) AND ((customer_order.cutomertype = 2 AND customer_order.orderacceptreject = 1) || (customer_order.cutomertype = 99 AND customer_order.orderacceptreject = 1) || (customer_order.cutomertype = 3 || customer_order.orderacceptreject != 1) || (customer_order.cutomertype = 4 || customer_order.orderacceptreject != 1) || (customer_order.cutomertype = 1 || customer_order.orderacceptreject != 1)))";
		$this->db->select('customer_order.*,customer_order.customer_id AS cust_id,customer_info.customer_name,customer_type.customer_type,employee_history.first_name,employee_history.last_name,rest_table.tablename');
        $this->db->from('customer_order');
		$this->db->join('customer_info','customer_order.customer_id=customer_info.customer_id','left');
		$this->db->join('customer_type','customer_order.cutomertype=customer_type.customer_type_id','left');
		$this->db->join('employee_history','customer_order.waiter_id=employee_history.emp_his_id','left');
		$this->db->join('rest_table','customer_order.table_no=rest_table.tableid','left');
		$this->db->where($where);
		$query = $this->db->get();
		$orderdetails=$query->result();
	    return $orderdetails;
		}
	public function counter_ongoingorder(){
		$cdate=date('Y-m-d');
		$where="customer_order.order_date = '".$cdate."' AND (customer_order.order_status = 1 OR customer_order.order_status = 2 OR customer_order.order_status = 3)";
		$this->db->select('customer_order.*,customer_order.customer_id AS cust_id,customer_info.customer_name,customer_type.customer_type,employee_history.first_name,employee_history.last_name,rest_table.tablename');
        $this->db->from('customer_order');
		$this->db->join('customer_info','customer_order.customer_id=customer_info.customer_id','left');
		$this->db->join('customer_type','customer_order.cutomertype=customer_type.customer_type_id','left');
		$this->db->join('employee_history','customer_order.waiter_id=employee_history.emp_his_id','left');
		$this->db->join('rest_table','customer_order.table_no=rest_table.tableid','left');
		$this->db->where($where);
		$query = $this->db->get();
		//echo $this->db->last_query();
		$orderdetails=$query->result();
	    return $orderdetails;
		}
	public function counter_ongoingorderlimit($limit=null,$start=null){
		$cdate=date('Y-m-d');
		$where="customer_order.order_date = '".$cdate."' AND (customer_order.order_status = 1 OR customer_order.order_status = 2 OR customer_order.order_status = 3)";
		$this->db->select('customer_order.*,customer_order.customer_id AS cust_id,customer_info.customer_name,customer_type.customer_type,employee_history.first_name,employee_history.last_name,rest_table.tablename');
        $this->db->from('customer_order');
		$this->db->join('customer_info','customer_order.customer_id=customer_info.customer_id','left');
		$this->db->join('customer_type','customer_order.cutomertype=customer_type.customer_type_id','left');
		$this->db->join('employee_history','customer_order.waiter_id=employee_history.emp_his_id','left');
		$this->db->join('rest_table','customer_order.table_no=rest_table.tableid','left');
		$this->db->where($where);
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		//echo $this->db->last_query();
		$orderdetails=$query->result();
	    return $orderdetails;
		}
	private function get_alltodayorder_query()
	{
			$column_order = array(null, 'customer_order.saleinvoice','customer_info.customer_name','customer_type.customer_type','employee_history.first_name','employee_history.last_name','rest_table.tablename','customer_order.order_date','customer_order.totalamount'); //set column field database for datatable orderable
			$column_search = array('customer_order.saleinvoice','customer_info.customer_name','customer_type.customer_type','employee_history.first_name','employee_history.last_name','rest_table.tablename','customer_order.order_date','customer_order.totalamount'); //set column field database for datatable searchable 
			$order = array('customer_order.order_id' => 'asc');
		
		$cdate=date('Y-m-d');
		$this->db->select('customer_order.*,customer_order.customer_id AS cust_id,customer_info.customer_name,customer_type.customer_type,employee_history.first_name,employee_history.last_name,rest_table.tablename,bill.bill_status');
        $this->db->from('customer_order');
		$this->db->join('customer_info','customer_order.customer_id=customer_info.customer_id','left');
		$this->db->join('customer_type','customer_order.cutomertype=customer_type.customer_type_id','left');
		$this->db->join('employee_history','customer_order.waiter_id=employee_history.emp_his_id','left');
		$this->db->join('rest_table','customer_order.table_no=rest_table.tableid','left');
		$this->db->join('bill','customer_order.order_id=bill.order_id','left');
		$this->db->where('customer_order.order_date',$cdate);
		$this->db->where('bill.bill_status',1);
		$this->db->order_by('customer_order.order_id','desc');
		$i = 0;
	
		foreach ($column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); 
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($order))
		{
			$order = $order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}
	public function get_completeorder()
	{
		$this->get_alltodayorder_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->result();
	}
	public function count_filtertorder()
	{
		$this->get_alltodayorder_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_alltodayorder()
	{
		$cdate=date('Y-m-d');
		$this->db->select('customer_order.*,customer_order.customer_id AS cust_id,customer_info.customer_name,customer_type.customer_type,employee_history.first_name,employee_history.last_name,rest_table.tablename,bill.bill_status');
        $this->db->from('customer_order');
		$this->db->join('customer_info','customer_order.customer_id=customer_info.customer_id','left');
		$this->db->join('customer_type','customer_order.cutomertype=customer_type.customer_type_id','left');
		$this->db->join('employee_history','customer_order.waiter_id=employee_history.emp_his_id','left');
		$this->db->join('rest_table','customer_order.table_no=rest_table.tableid','left');
		$this->db->join('bill','customer_order.order_id=bill.order_id','left');
		$this->db->where('customer_order.order_date',$cdate);
		$this->db->where('bill.bill_status',1);
		return $this->db->count_all_results();
	}
	
	private function get_completeonlineorder_query()
	{
			$column_order = array(null, 'customer_order.saleinvoice','customer_info.customer_name','customer_type.customer_type','employee_history.first_name','employee_history.last_name','rest_table.tablename','customer_order.order_date','customer_order.totalamount'); //set column field database for datatable orderable
			$column_search = array('customer_order.saleinvoice','customer_info.customer_name','customer_type.customer_type','employee_history.first_name','employee_history.last_name','rest_table.tablename','customer_order.order_date','customer_order.totalamount'); //set column field database for datatable searchable 
			$order = array('customer_order.order_id' => 'asc');
		
		$cdate=date('Y-m-d');
		$previousday = date('Y-m-d', strtotime($cdate. ' -2 days'));
		$condi = "customer_order.order_date BETWEEN '".$previousday."' AND '".$cdate."'";

		$this->db->select('customer_order.*,customer_order.customer_id AS cust_id, customer_info.customer_name,customer_type.customer_type,employee_history.first_name,employee_history.last_name,rest_table.tablename,bill.bill_status');
        $this->db->from('customer_order');
		$this->db->join('customer_info','customer_order.customer_id=customer_info.customer_id','left');
		$this->db->join('customer_type','customer_order.cutomertype=customer_type.customer_type_id','left');
		$this->db->join('employee_history','customer_order.waiter_id=employee_history.emp_his_id','left');
		$this->db->join('rest_table','customer_order.table_no=rest_table.tableid','left');
		$this->db->join('bill','customer_order.order_id=bill.order_id','left');
		$this->db->where($condi);
		$this->db->where('customer_order.cutomertype',2);
		$this->db->order_by('customer_order.order_id','desc');
		$i = 0;
	
		foreach ($column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); 
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($order))
		{
			$order = $order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}
	public function get_completeonlineorder()
	{
		$this->get_completeonlineorder_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->result();
	}
	public function count_filtertonlineorder()
	{
		$this->get_completeonlineorder_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_allonlineorder()
	{
		$cdate=date('Y-m-d');
		$previousday = date('Y-m-d', strtotime($cdate. ' -2 days'));
		$condi = "customer_order.order_date BETWEEN '".$previousday."' AND '".$cdate."'";
		$this->db->select('customer_order.*,customer_info.customer_name,customer_type.customer_type,employee_history.first_name,employee_history.last_name,rest_table.tablename,bill.bill_status');
        $this->db->from('customer_order');
		$this->db->join('customer_info','customer_order.customer_id=customer_info.customer_id','left');
		$this->db->join('customer_type','customer_order.cutomertype=customer_type.customer_type_id','left');
		$this->db->join('employee_history','customer_order.waiter_id=employee_history.emp_his_id','left');
		$this->db->join('rest_table','customer_order.table_no=rest_table.tableid','left');
		$this->db->join('bill','customer_order.order_id=bill.order_id','left');
		$this->db->where($condi);
		$this->db->where('customer_order.cutomertype',2);
		$this->db->where('bill.bill_status',1);
		return $this->db->count_all_results();
	}
private function get_qronlineorder_query()
	{
			$column_order = array(null, 'customer_order.saleinvoice','customer_info.customer_name','customer_type.customer_type','employee_history.first_name','employee_history.last_name','rest_table.tablename','customer_order.order_date','customer_order.totalamount'); //set column field database for datatable orderable
			$column_search = array('customer_order.saleinvoice','customer_info.customer_name','customer_type.customer_type','employee_history.first_name','employee_history.last_name','rest_table.tablename','customer_order.order_date','customer_order.totalamount'); //set column field database for datatable searchable 
			$order = array('customer_order.order_id' => 'asc');
		
		$cdate=date('Y-m-d');
		$previousday = date('Y-m-d', strtotime($cdate. ' -2 days'));
		$condi = "customer_order.order_date BETWEEN '".$previousday."' AND '".$cdate."'";
		$this->db->select('customer_order.*,customer_info.customer_name,customer_type.customer_type,employee_history.first_name,employee_history.last_name,rest_table.tablename,bill.bill_status');
        $this->db->from('customer_order');
		$this->db->join('customer_info','customer_order.customer_id=customer_info.customer_id','left');
		$this->db->join('customer_type','customer_order.cutomertype=customer_type.customer_type_id','left');
		$this->db->join('employee_history','customer_order.waiter_id=employee_history.emp_his_id','left');
		$this->db->join('rest_table','customer_order.table_no=rest_table.tableid','left');
		$this->db->join('bill','customer_order.order_id=bill.order_id','left');
		$this->db->where($condi);
		$this->db->where('customer_order.cutomertype',99);
		$this->db->order_by('customer_order.order_id','desc');
		$i = 0;
	
		foreach ($column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); 
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($order))
		{
			$order = $order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}
	public function get_qronlineorder()
	{
		$this->get_qronlineorder_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->result();
	}
	public function count_filtertqrorder()
	{
		$this->get_qronlineorder_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_allqrorder()
	{
		$cdate=date('Y-m-d');
		$previousday = date('Y-m-d', strtotime($cdate. ' -2 days'));
		$condi = "customer_order.order_date BETWEEN '".$previousday."' AND '".$cdate."'";
		$this->db->select('customer_order.*,customer_info.customer_name,customer_type.customer_type,employee_history.first_name,employee_history.last_name,rest_table.tablename,bill.bill_status');
        $this->db->from('customer_order');
		$this->db->join('customer_info','customer_order.customer_id=customer_info.customer_id','left');
		$this->db->join('customer_type','customer_order.cutomertype=customer_type.customer_type_id','left');
		$this->db->join('employee_history','customer_order.waiter_id=employee_history.emp_his_id','left');
		$this->db->join('rest_table','customer_order.table_no=rest_table.tableid','left');
		$this->db->join('bill','customer_order.order_id=bill.order_id','left');
		$this->db->where($condi);
		$this->db->where('customer_order.cutomertype',99);
		$this->db->where('bill.bill_status',1);
		return $this->db->count_all_results();
	}
public function selectmerge($orders){
		$cond="order_id IN($orders)";
		$this->db->select('*');
		$this->db->from('customer_order');
		$this->db->where($cond);
		$query = $this->db->get();
		return $query->result();
	}

 
public function settinginfolanguge($lang)
	{ 
		$values =  $this->db->select("phrase,$lang")->from('language')
			->get()->result();
			$strings =array();
			 foreach ($values as $file) {
          
            $strings[$file->phrase] = $file->$lang;
        }
			
			return $strings;
			
	}

	public function get_assigned_waiter ($id) {
        $this->db->select('*','firstname','lastname');
        $this->db->from('employee_history');
        $this->db->where('emp_his_id', $id);
        $query = $this->db->get();
        $result=$query->row();
        return $result;

    }
public function get_orderlist(){

    $hoteldb = $this->load->database('hmsdb', TRUE);
    $hoteldb->select('G.firstname as firstname,G.lastname,G.id');
    $hoteldb->from('guests as G');
 //   $hoteldb->join('guests G','G.id=customer_order.customer_id','left');
		$cdate=date('Y-m-d');
		$where="customer_order.order_date = '".$cdate."' AND ((customer_order.order_status = 1 OR customer_order.order_status = 2 OR customer_order.order_status = 3) AND ((customer_order.cutomertype = 2 AND customer_order.orderacceptreject = 1) || (customer_order.cutomertype = 99 AND customer_order.orderacceptreject = 1) || (customer_order.cutomertype = 3 || customer_order.orderacceptreject != 1) || (customer_order.cutomertype = 4 || customer_order.orderacceptreject != 1) || (customer_order.cutomertype = 1 || customer_order.orderacceptreject != 1)))";
		$this->db->select('customer_order.*,customer_order.customer_id AS cust_id,customer_info.customer_name,customer_type.customer_type,employee_history.first_name,employee_history.last_name,rest_table.tablename');
        $this->db->from('customer_order');
		$this->db->join('customer_info','customer_order.customer_id=customer_info.customer_id','left');
		$this->db->join('customer_type','customer_order.cutomertype=customer_type.customer_type_id','left');
		$this->db->join('employee_history','customer_order.waiter_id=employee_history.emp_his_id','left');
		$this->db->join('rest_table','customer_order.table_no=rest_table.tableid','left');
		$this->db->where($where);
		$this->db->group_by('customer_order.order_id');
		$this->db->order_by('customer_order.order_status','desc');
		$query = $this->db->get();
		//echo $this->db->last_query();
		$orderdetails=$query->result();
	    return $orderdetails;
		}
	public function get_itemlist($id){
			$this->db->select('order_menu.*,item_foods.ProductName,variant.variantid,variant.variantName,variant.price');
			$this->db->from('order_menu');
			$this->db->join('item_foods','order_menu.menu_id=item_foods.ProductsID','left');
			$this->db->join('variant','order_menu.varientid=variant.variantid','left');
			$this->db->where('order_menu.order_id',$id);
			$query = $this->db->get();
			$orderinfo=$query->result();
			//echo $this->db->last_query();
			return $orderinfo;
		}

	public function get_table_total_customer($id){
		$where = "table_id = '".$id."' AND delete_at = 0 AND created_at= '".date('Y-m-d')."'";
		$this->db->select('SUM(total_people) as total');
		$this->db->from('table_details');
		$this->db->where($where);
		$query = $this->db->get();
		$tablesum=$query->row();
		return $tablesum;
		}

	public function get_table_order($id){
	    $where = "table_id = '".$id."' AND delete_at = 0 AND created_at= '".date('Y-m-d')."'";
		$this->db->select('*');
		$this->db->from('table_details');
		$this->db->where($where);
		$query = $this->db->get();
		$result=$query->result();
		return $result;
	}

    public function get_person_no($id){
        $where = "order_id = '".$id."' AND delete_at = 0 AND created_at= '".date('Y-m-d')."'";
        $this->db->select('*');
        $this->db->from('table_details');
        $this->db->where($where);
        $query = $this->db->get();
        $result=$query->result();
        return $result;
    }

	public function tablefloor(){
		$this->db->select('*');
		$this->db->from('tbl_tablefloor');
		$query = $this->db->get();
		$table=$query->result();
		return $table;
		}

    public function get_table_total($floorid){
    	$where = "table_details.delete_at = 0 AND table_details.created_at= '".date('Y-m-d')."'";
    	$this->db->select('rest_table.*,tbl_tablefloor.*');
		$this->db->from('rest_table');
		$this->db->join('tbl_tablefloor','tbl_tablefloor.tbfloorid=rest_table.floor','left');
		$this->db->where('rest_table.floor',$floorid);
		$query = $this->db->get();
		$table=$query->result_array();
		$i=0;
			foreach ($table as $value) {
				$table[$i]['table_details'] = $this->get_table_order($value['tableid']);
				$sum = $this->get_table_total_customer($value['tableid']);
				$table[$i]['sum'] =  $sum->total;
				$i++;
			}
			
		return $table;
    }
	
	public function checkingredientstock($foodid,$vid,$foodqty){
		$checksetitem=$this->db->select('ProductsID,isgroup')->from('item_foods')->where('ProductsID',$foodid)->where('isgroup',1)->get()->row();
		$isavailable=true;
		if(!empty($checksetitem)){
			$groupitemlist=$this->db->select('items,varientid,item_qty')->from('tbl_groupitems')->where('gitemid',$checksetitem->ProductsID)->get()->result();
			foreach($groupitemlist as $groupitem){
				$this->db->select('*');
				$this->db->from('production_details');
				$this->db->where('foodid',$groupitem->items);
				$this->db->where('pvarientid',$groupitem->varientid);
				$productiondetails = $this->db->get()->result();
				 if(empty($productiondetails)){
					 $isavailable=false;
					 return 'Please set Ingredients!!first!!!'.$groupitem->items;
					 break;
					 }
				 else{
					 foreach($productiondetails as $productiondetail){
							$r_stock = $productiondetail->qty*($foodqty*$groupitem->item_qty);
							/*add stock in ingredients*/
							$this->db->select('*');
							$this->db->from('ingredients');
							$this->db->where('id', $productiondetail->ingredientid);
							$this->db->where('stock_qty >=',$r_stock);
							$stockcheck = $this->db->get()->num_rows();
							
							if($stockcheck == 0){
								return 'Please check Ingredients!!Some Ingredients are not Available!!!'.$groupitem->items;
							}
							/*end add ingredients*/
						}
					 }
				}
			return 1;
		}else{
			$this->db->select('*');
			$this->db->from('production_details');
			$this->db->where('foodid',$foodid);
			$this->db->where('pvarientid',$vid);
			$productiondetails = $this->db->get()->result();
			}
		if(!empty($productiondetails)){
		   foreach($productiondetails as $productiondetail){
			$r_stock = $productiondetail->qty*$foodqty;
			/*add stock in ingredients*/
				$this->db->select('*');
				$this->db->from('ingredients');
				$this->db->where('id', $productiondetail->ingredientid);
				$this->db->where('stock_qty >=',$r_stock);
				$stockcheck = $this->db->get()->num_rows();
				
				if($stockcheck == 0){
					return 'Please check Ingredients!!Some Ingredients are not Available!!!';
				}


				/*end add ingredients*/
		}
	}
	else{
		return 'Please Add Ingredients to Menu';
	}
		return 1;
	
	}

	#check productiondetails
	public function checkproductiondetails($foodid,$fvid,$foodqty)
	{
		$checksetitem=$this->db->select('ProductsID,isgroup')->from('item_foods')->where('ProductsID',$foodid)->where('isgroup',1)->get()->row();
		if(!empty($checksetitem)){
			$groupitemlist=$this->db->select('items,varientid,item_qty')->from('tbl_groupitems')->where('gitemid',$checksetitem->ProductsID)->get()->result();
			foreach($groupitemlist as $groupitem){
				$this->db->select('*');
				$this->db->from('production_details');
				$this->db->where('foodid',$groupitem->items);
				$this->db->where('pvarientid',$groupitem->varientid);
				$productiondetails = $this->db->get()->result();
					 foreach($productiondetails as $productiondetail){
							$r_stock = $productiondetail->qty*($foodqty*$groupitem->item_qty);
							/*add stock in ingredients*/
							$this->db->set('stock_qty', 'stock_qty-'.$r_stock, FALSE);
							$this->db->where('id', $productiondetail->ingredientid);
							$this->db->update('ingredients');
							/*end add ingredients*/
					 }
				}
		}else{
			$this->db->select('*');
				$this->db->from('production_details');
				$this->db->where('foodid',$foodid);
				$this->db->where('pvarientid',$fvid);
				$productiondetails = $this->db->get()->result();
				foreach($productiondetails as $productiondetail){
					$r_stock = $productiondetail->qty*$foodqty;
					/*add stock in ingredients*/
						$this->db->set('stock_qty', 'stock_qty-'.$r_stock, FALSE);
						$this->db->where('id', $productiondetail->ingredientid);
						$this->db->update('ingredients');
						/*end add ingredients*/
				}
			}


	}
	#insert prodouction 
	public function insert_product($foodid,$vid,$foodqty)
	{
		$saveid=$this->session->userdata('id');
		$p_id = $foodid;
		$newdate= date('Y-m-d');
		$exdate= date('Y-m-d');
		$data=array(
			'itemid'				  =>	$foodid,
			'itemvid'				  =>	$vid,
			'itemquantity'			  =>	$foodqty,
			'savedby'	     		  =>	$saveid,
			'saveddate'	              =>	$newdate,
			'productionexpiredate'	  =>	$exdate
		);
		$this->checkproductiondetails($foodid,$vid,$foodqty);
		 $this->db->insert('production',$data);

		$returnid = $this->db->insert_id();
		return true;
	
	}
	public function updateSuborderData($rowid){
		$this->db->select('order_menu.*,item_foods.ProductName,variant.variantid,variant.variantName,variant.price');
        $this->db->from('order_menu');
		$this->db->join('item_foods','order_menu.menu_id=item_foods.ProductsID','left');
		$this->db->join('variant','order_menu.varientid=variant.variantid','left');
		$this->db->where('order_menu.row_id',$rowid);
		
		$query = $this->db->get();
		$orderinfo=$query->row();
	    return $orderinfo;
	}
	public function updateSuborderDatalist($rowidarray){
		$this->db->select('order_menu.*,item_foods.*,variant.variantName,variant.price');
        $this->db->from('order_menu');
		$this->db->join('item_foods','order_menu.menu_id=item_foods.ProductsID','left');
		$this->db->join('variant','order_menu.varientid=variant.variantid','left');
		$this->db->where_in('order_menu.row_id',$rowidarray);
		
		$query = $this->db->get();
		$orderinfo=$query->result();
		//$this->db->last_query();
	    return $orderinfo;
	}
	public function showsplitorderlist($order){
		$this->db->select('sub_order.*,customer_info.customer_name');
        $this->db->from('sub_order');
		$this->db->join('customer_info','sub_order.customer_id=customer_info.customer_id','left');
		
		$this->db->where('sub_order.order_id',$order);
		
		$query = $this->db->get();
		$orderinfo=$query->result();
	    return $orderinfo;
	}
	public function createcounter($data = array())
	{	 
		return $this->db->insert('tbl_cashcounter',$data);
	}
	public function updatecounter($data = array()){
		 return $this->db->where('ccid',$data["ccid"])->update('tbl_cashcounter', $data);
		}
	public function deletecounter($id = null)
	{
		$this->db->where('ccid',$id)
			->delete('tbl_cashcounter');

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 
	public function addopeningcash($data = array())
	{	 
		return $this->db->insert('tbl_cashregister',$data);
	}
	public function closeresister($data = array()){
		 return $this->db->where('id',$data["id"])->update('tbl_cashregister', $data);
		}
	public function collectcash($id,$tdate){
		$crdate=date('Y-m-d H:i:s');
		$where="bill.create_at Between '$tdate' AND '$crdate'";
		$this->db->select('bill.*,multipay_bill.payment_type_id,SUM(multipay_bill.amount) as totalamount,payment_method.payment_method');
        $this->db->from('multipay_bill');
		$this->db->join('bill','bill.order_id=multipay_bill.order_id','left');
		$this->db->join('payment_method','payment_method.payment_method_id=multipay_bill.payment_type_id','left');
		$this->db->where('bill.create_by',$id);
		$this->db->where($where);
		$this->db->where('bill.bill_status',1);
		$this->db->group_by('multipay_bill.payment_type_id');
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $orderdetails=$query->result();
		}
  
   public function get_payment_method($id) {
    
     $this->db->select('*','payment_method');
        $this->db->from('payment_method');
        $this->db->where('payment_method_id', $id);
        $query = $this->db->get();
        $result= $query->row();
        return $result;
   
    
  }
  
  public function get_multipay_by_order($id){
        $this->db->select('*');
        $this->db->from('multipay_bill');
        $this->db->where('order_id', $id);
        $query = $this->db->get();
        $result= $query->result_array();
        return $result;
  }
  
   public function get_total_people_by_order($id) {
     
     $this->db->select('*','total_people');
        $this->db->from('table_details');
        $this->db->where('order_id', $id);
        $query = $this->db->get();
        $result= $query->row();
        return $result;
   
     
   }
  
  public function add_entry($entry)
  {
      $db = $this->load->database('acctg', TRUE);

      $db->insert('entries', $entry);

      $insertId = $db->insert_id();

      return  $insertId;


  }
    public function add_entry_items($entry)
    {
        $db = $this->load->database('acctg', TRUE);
        $db->insert('entryitems', $entry);
        return  true;


    }
  
  
  	public function nextNumber($id)	{

        $db = $this->load->database('acctg', TRUE);
        $db->where('entrytype_id', $id);

        $max = $db->select('MAX(number) AS max')->get('entries')->row_array();
        if (empty($max['max'])) {
            $maxNumber = 0;
        } else {
            $maxNumber = $max['max'];
        }
        return $maxNumber + 1;
    }
  


  
  public function today_active_guests()
  {

    $hoteldb = $this->load->database('hmsdb', TRUE);

        $data = $hoteldb->where('O.status',4)            
            ->where('O.check_in <=',date('y-m-d'))
            ->where('O.check_out >=',date('y-m-d'))
            ->order_by('O.ordered_on','DESC')
            ->select('O.*,O.id as order_id, O.order_no as book_id,R.shortcode as room, N.*, G.firstname,G.lastname,G.id')
            ->join('room_types R', 'R.id = O.room_type_id', 'LEFT')
            ->join('rooms N', 'O.room_id = N.id', 'LEFT')
            ->join('guests G', 'G.id = O.guest_id', 'LEFT')
            ->get('orders O')
            ->result();
    
    return $data;
		
  }
  
  public function get_cancelled_items($id){
    
    //var_dump($id);die();
    $this->db->select('*');
    $this->db->where('order_id', $id);
    $this->db->from('tbl_cancel_variant');
	$this->db->join('variant', 'variant.variantid = tbl_cancel_variant.variant_id');
    $this->db->join('item_foods', 'item_foods.ProductsID = tbl_cancel_variant.item_id');
    $query = $this->db->get();
    //var_dump($query->result());die();
    //$query = $this->db->get('tbl_cancel_variant');
    
    
    return $query->result();
    
    
  }
  
 

}
