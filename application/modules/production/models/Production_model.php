<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Production_model extends CI_Model {
	
	private $table = 'production_details';
 
	public function create()
	{
		$saveid=$this->session->userdata('id');
		$p_id = $this->input->post('product_id');
		$production_date = $this->input->post('production_date');
      
     // $purchase_date = date("Y-m-d", strtotime($production_date));  
      
      
		$newdate= date('Y-m-d' , strtotime($production_date));
      
      
		$expire_date = $this->input->post('expire_date');
      
		$exdate= date('Y-m-d' , strtotime($expire_date));
      
		$foodid = $this->input->post('foodid');
		$fvid=$this->input->post('foodvarientid');
		$foodqty = $this->input->post('pro_qty');
		$data=array(
			'itemid'				  =>	$this->input->post('foodid'),
			'itemvid'				  =>	$this->input->post('foodvarientid'),
			'itemquantity'			  =>	$this->input->post('pro_qty'),
			'savedby'	     		  =>	$saveid,
			'saveddate'	              =>	$newdate,
			'productionexpiredate'	  =>	$exdate,
          	'total_price'	  =>	$this->input->post('total_amount')
		);
		$this->checkproductiondetails($foodid,$fvid,$foodqty);
		
      $this->db->insert('production',$data);

		$returnid = $this->db->insert_id();
		return true;
	
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
	
	public function delete($id = null)
	{
		$this->db->where('purID',$id)
			->delete($this->table);

		$this->db->where('purchaseid',$id)
			->delete('purchase_details');

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 

    public function deleteitem($id = null,$qid=null)
	{
		$this->db->select('menu_id');
		$this->db->from('order_menu');
		$this->db->where('menu_id',$id);
		$query = $this->db->get();
		//echo $this->db->last_query();
		if ($query->num_rows() > 0) {
			return true;
		}
		else{
			
			    $this->db->where('pro_detailsid',$qid)->delete($this->table);
				if ($this->db->affected_rows()) {
					return true;
				} else {
					return false;
				}
			}
	} 
  
  public function delete_production($id,$qid=null)
	{	
    	
    	
    	$this->db->where('foodid',$id);
        $this->db->where('pvarientid',$qid);

    	$result = $this->db->delete('production_details');
				
    if ($result) {
		return true;
		} else {
	return false;
		}
			
	} 


	/*change it*/
	public function update()
	{
      
      
       //$test = $itemid=$this->input->post('unit_cost');
     
      
      
		$saveid=$this->session->userdata('id');
		$updateid =  $this->input->post('itemid');
		$p_id = $this->input->post('product_id');
		$itemid=$this->input->post('itemid');
		$itemvarient=$this->input->post('foodvarientid');
		$quantity = $this->input->post('product_quantity');
      	$unit = $this->input->post('product_unit_quantity');
      	$unit_name = $this->input->post('unitname');


		$newdate= date('Y-m-d');
     $total_price = $this->input->post('total_amount');
      //$total_price = $this->input->post('price');
      //$new_addition = $this->input->post('price');
      //var_dump($total_price); die();

      
      	$qty_purchase = $this->input->post('quantity_purchased');
      //var_dump($itemvarient); die();
		//print_r($this->input->post()); die();
      

		$this->db->where('foodid',$updateid)->where('pvarientid',$itemvarient)->delete('production_details');
		
		for ($i=0, $n=count($p_id); $i < $n; $i++) {
           //var_dump("test"); die();
          
			$product_quantity = $quantity[$i];
			$product_id = $p_id[$i];
          $price =$total_price[$i];
          $unitname= $unit_name[$i];
          $qty_unit=$qty_purchase[$i];
          
				$data1 = array(
				'foodid'		    =>	$itemid,
				'pvarientid'		=>	$itemvarient,
				'ingredientid'		=>	$product_id,
				'qty'				=>	$product_quantity,
				'createdby'			=>	$saveid,
				'created_date'		=>	$newdate,
                'unitname'		=>	$unitname,
                'total_price' => $price,
                 'qty_unit'	=> $qty_unit    
			);
          
         
			
				if(!empty($quantity))
				{
					$this->db->insert('production_details',$data1);
				}
			
		}
      if(empty($quantity))
			{
				return false;
			}
		return true;
		
	}
	
	
	public function makeproduction()
	{
		$saveid=$this->session->userdata('id');
		$p_id = $this->input->post('product_id');
		$itemid=$this->input->post('foodid');
		$itemvarient=$this->input->post('foodvarientid');
		$quantity = $this->input->post('product_quantity');
      	$unit = $this->input->post('product_unit_quantity');
       	$total_amt = $this->input->post('total_amount');
      	$sku_packaging = $this->input->post('quantity_purchased');
		$newdate= date('Y-m-d');
		$this->db->select('*');
		$this->db->from('production_details');
		$this->db->where('foodid',$itemid);
		$this->db->where('pvarientid',$itemvarient);
		$query = $this->db->get();
		if ($query->num_rows() > 0){
			return false;
		}
		else{
		for ($i=0, $n=count($p_id); $i < $n; $i++) {
			$product_quantity = $quantity[$i];
			$product_id = $p_id[$i];
          	$price = $total_amt[$i];
			$unitname = $unit[$i];
          	$sku = $sku_packaging[$i];
          
			$data1 = array(
				'foodid'		    =>	$itemid,
				'pvarientid'		=>	$itemvarient,
				'ingredientid'		=>	$product_id,
				'qty'				=>	$product_quantity,
				'createdby'			=>	$saveid,
				'created_date'		=>	$newdate,
              	'unitname'			=> 	$unitname,
              	'total_price'	=> $price,
              	'qty_unit'  	=> $sku
			);

			if(!empty($quantity))
			{
				$this->db->insert('production_details',$data1);
			}
			
		}
		if(empty($quantity))
			{
				return false;
			}
		return true;
		}
	}
	/*work on older methods*/
    public function read($limit = null, $start = null)
	{
	    $this->db->select('production_details.total_price,production_details.foodid,SUM(production_details.total_price) as total_p_amt,production_details.pro_detailsid,production_details.total_price,production_details.pvarientid,item_foods.ProductName,variant.variantName,variant.variantid');
        $this->db->from('production_details');
		$this->db->join('item_foods','item_foods.ProductsID = production_details.foodid','left');
		$this->db->join('variant','variant.variantid = production_details.pvarientid','left');
		$this->db->group_by('production_details.pvarientid');
        $query = $this->db->get();
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
        	$data = $this->totalcal($query->result());
            return $data;    
        }
        return false;
	}
	
	 public function readset($id,$vid)
	{
	    $this->db->select('production_details.foodid,production_details.unitname,item_foods.ProductName,variant.variantName,variant.variantid');
        $this->db->from('production_details');
		$this->db->join('item_foods','item_foods.ProductsID = production_details.foodid','left');
		$this->db->join('variant','variant.variantid = production_details.pvarientid','left');
		$this->db->where('production_details.foodid',$id);
		$this->db->where('production_details.pvarientid',$vid);
        $this->db->group_by('production_details.pvarientid'); 
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();    
        }
        return false;
	}  

	public function findById($id = null,$vid=null)
	{ 
		return $this->db->select("*")->from('production_details')
			->where('foodid',$id) 
			->where('pvarientid',$vid) 
			->get()
			->row();
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
	/*new change*/
	public function finditem($product_name)
		{ 
		$this->db->select('ingredients.*,ingredients.qty_unit as qty_unit,SUM(purchase_details.quantity) as uquantity,SUM(purchase_details.totalprice) as utotalprice, menu_unit.uom_short_code as m_unit, purchase_unit.uom_short_code as p_unit');
		$this->db->from('ingredients');
		$this->db->join('purchase_details','purchase_details.indredientid = ingredients.id','inner');
      	$this->db->join('unit_of_measurement as menu_unit','menu_unit.id = ingredients.uom_id','inner');   
      $this->db->join('unit_of_measurement as purchase_unit','purchase_unit.id = ingredients.purchase_unit_id','inner');   
		$this->db->where('ingredients.is_active',1);
		$this->db->like('ingredients.ingredient_name', $product_name);
		$this->db->group_by('ingredients.id');
		$query = $this->db->get();
		//echo $this->db->last_query();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
		}
	public function foodvarientlist($id = null)
	{
	    $this->db->select('*');
        $this->db->from('variant');
		$this->db->where('menuid',$id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
        	$data = $query->result();
            return $data;    
        }
        return false;
	}
	
	 public function findByvId($id = null)
	{
		$data = $this->db->select("*")
			->from('variant')
			->where('menuid',$id) 
			->get()
			->result();
		$list[''] = 'Select '.display('varient_name');
		if (!empty($data)) {
			foreach($data as $value)
				$list[$value->variantid] = $value->variantName;
			return $list;
		} else {
			return false; 
		}
	}
	public function get_total_product($product_id){
		$this->db->select('SUM(quantity) as total_purchase');
		$this->db->from('purchase_details');
		$this->db->where('indredientid',$product_id);
		$total_purchase = $this->db->get()->row();
		
		$this->db->select('SUM(qty) as total_ingredient');
		$this->db->from('production_details');
		$this->db->where('ingredientid',$product_id);
		$used_ingredient = $this->db->get()->row();
		$available_quantity = ($total_purchase->total_purchase - $used_ingredient->total_ingredient);
		
		$data2 = array(
			'total_purchase'  => $available_quantity
			);
		

		return $data2;
		}
		#new metho for cal total
	public function totalcal($values)
	{
		$i=0;
		$data=array();
        $totalvalucals = array();

        //var_dump($values);die();
		foreach ($values as $value) {
			# code...
			$toalvalue=0;
			$totalvalucals = $this->iteminfo($value->foodid,$value->pvarientid);

            if($totalvalucals) {
                foreach ($totalvalucals as $totalvalucal) {
                    # code...
                    $toalvalue = $totalvalucal->uprice * $totalvalucal->qty + $toalvalue;
                }
                $values[$i]->totalcost = $toalvalue;
            }

		$i++;
		}
		return $values;

	}
	/*work on older methods*/
 /*public function iteminfo($id){
	 	$this->db->select('production_details.*,ingredients.id,ingredients.ingredient_name,unit_of_measurement.uom_short_code,SUM(purchase_details.total_price)/SUM(purchase_details.quantity) as uprice');
		$this->db->from('production_details');
		$this->db->join('ingredients','production_details.ingredientid=ingredients.id','left');
		$this->db->join('unit_of_measurement','unit_of_measurement.id = ingredients.uom_id','inner');
		$this->db->join('purchase_details','purchase_details.indredientid = ingredients.id','left');

		$this->db->where('foodid',$id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();	
		}
		return false;
		
	 }
//item Dropdown*/
	 /*work on older methods*/
 public function iteminfo($id,$vid=null){
	 	$this->db->select('production_details.*,ingredients.id,ingredients.ingredient_name,unit_of_measurement.uom_short_code');
		$this->db->from('production_details');
		$this->db->join('ingredients','production_details.ingredientid=ingredients.id','left');
		$this->db->join('unit_of_measurement','unit_of_measurement.id = ingredients.uom_id','inner');
		//$this->db->join('purchase_details','purchase_details.indredientid = ingredients.id','left');

		$this->db->where('foodid',$id);
		if(!empty($vid)){
		$this->db->where('pvarientid',$vid);
		}
		$query = $this->db->get();
		//echo $this->db->last_query();
		if ($query->num_rows() > 0) {
				$results = $query->result();
				$i=0;
			foreach ($results as $result) {
			
				$this->db->select('SUM(purchase_details.totalprice)/SUM(purchase_details.quantity) as uprice');
				$this->db->from('purchase_details');
				$this->db->where('indredientid',$result->ingredientid);
				$value = $this->db->get()->row();
				$results[$i]->uprice=$value->uprice;
				$i++;
			}
			return $results;	
		}
		return false;
		
	 }
 public function item_dropdown()
	{
		$data = $this->db->select("*")
			->from('item_foods')
			->get()
			->result();

		$list[''] = 'Select '.display('item_name');
		if (!empty($data)) {
			foreach($data as $value)
				$list[$value->ProductsID] = $value->ProductName;
			return $list;
		} else {
			return false; 
		}
	}
 //ingredient Dropdown
 public function ingrediant_dropdown()
	{
		$data = $this->db->select("*")
			->from('ingredients')
			->where('is_active',1) 
			->get()
			->result();

		$list[''] = 'Select '.display('item_name');
		if (!empty($data)) {
			foreach($data as $value)
				$list[$value->id] = $value->ingredient_name;
			return $list;
		} else {
			return false; 
		}
	}
//item Dropdown
 public function supplier_dropdown()
	{
		$data = $this->db->select("*")
			->from('supplier')
			->get()
			->result();

		$list[''] = 'Select '.display('supplier_name');
		if (!empty($data)) {
			foreach($data as $value)
				$list[$value->supid] = $value->supName;
			return $list;
		} else {
			return false; 
		}
	}
public function suplierinfo($id){
	return $this->db->select("*")->from('supplier')
			->where('supid',$id) 
			->get()
			->row();
	
	}
public function countlist()
	{
		
	    $this->db->select('production_details.foodid,item_foods.ProductName');
        $this->db->from('production_details');
		$this->db->join('item_foods','item_foods.ProductsID = production_details.foodid','Inner');
        $this->db->group_by('production_details.foodid'); 
		
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();  
        }
        return false;
	}
#check stock
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
					 return 'Please set Ingredients first!!!'.$groupitem->items;
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
		return 'Please set Ingredients!! first!!!';
	}
		return 1;
	
	}
public function checkmeterials($foodid,$qty){
		$this->db->select('SUM(itemquantity) as producequantity');
        $this->db->from('production');
        $this->db->where('itemid',$foodid); 
		$query2 = $this->db->get();
		//echo $this->db->last_query();
		if($query2->num_rows() > 0) {
			$proqty1=$query2->row();
			$proqty=$proqty1->producequantity;
			}
		else{
			$proqty=0;
			}
		$this->db->select('foodid,ingredientid,qty');
        $this->db->from('production_details');
        $this->db->where('foodid',$foodid); 
        $query = $this->db->get();
		//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $alingredient= $query->result(); 
			$isavailable='';
			foreach($alingredient as $single){
					$inqty=$single->qty;
					$ingredientid=$single->ingredientid;
					$nitqty=$inqty*$qty;
					$isavailable2=$this->checkingredient($nitqty,$ingredientid,$foodid,$proqty);
					$isavailable.=$isavailable2.',';
				}
				 if( strpos($isavailable, '0') !== false ) {
					 echo "0";
				 }
				 else{
					 echo 1;
					 }
        }
		
	}
public function checkingredient($nitqty,$ingredientid,$foodid,$proqty){
		$this->db->select('SUM(purchase_details.quantity) as totalquantity,ingredients.id,ingredients.ingredient_name');
		$this->db->from('purchase_details');
		$this->db->join('ingredients','purchase_details.indredientid=ingredients.id','left');
		$this->db->where('purchase_details.indredientid',$ingredientid);
		$query = $this->db->get();
		//echo $this->db->last_query();
		if ($query->num_rows() > 0) {
			 $row=$query->row();
			 $purchaseqty=$row->totalquantity;
			 $foodwise=$this->db->select("production_details.foodid,production_details.ingredientid,production_details.qty,SUM(production.itemquantity*production_details.qty) as foodqty")->from('production_details')->join('production','production.itemid=production_details.foodid','Left')->where('production_details.ingredientid',$ingredientid)->group_by('production_details.foodid')->get()->result();
		      $lastqty=0;
			  foreach($foodwise as $gettotal){
				$lastqty=$lastqty+$gettotal->foodqty;
				}
			$restqty=$purchaseqty-$lastqty;
			 if($restqty>=$nitqty){
				return 1;
				}
			else{
				return 0;
				}
			}
		else{
			return 0;
		}
	}
    
}
