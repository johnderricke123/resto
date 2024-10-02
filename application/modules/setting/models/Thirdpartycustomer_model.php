<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Thirdpartycustomer_model extends CI_Model {
	
	private $table = 'tbl_thirdparty_customer';
 
	public function create($data = array())
	{
		return $this->db->insert($this->table, $data);
	}
	public function delete($id = null)
	{
		$this->db->where('companyId',$id)
			->delete($this->table);

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 




	public function update($data = array())
	{
		return $this->db->where('companyId',$data["companyId"])
			->update($this->table, $data);
	}

    public function read($limit = null, $start = null)
	{
	   $this->db->select('*');
        $this->db->from($this->table);
        $this->db->order_by('companyId', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();    
        }
        return false;
	} 

	public function findById($id = null)
	{ 
		return $this->db->select("*")->from($this->table)
			->where('companyId',$id) 
			->get()
			->row();
	} 

 
public function countlist()
	{
		$this->db->select('*');
        $this->db->from($this->table);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();  
        }
        return false;
	}
  
  
  public function get_ar_or($start_date, $end_date){
	$this->db->select('bill.or_code');
	$this->db->where('or_code !=', null);
	$this->db->where('bill_date >=',$start_date);
	$this->db->where('bill_date <=',$end_date);
	$this->db->order_by('bill_date DESC');
	$query = $this->db->get('bill');
	$array = array();
	$ar_or = array();
	$invoice = array();
	$alldata = array();
	foreach($query->result() as $ar){
		$array[] = $ar->or_code;
	}
	$unique_array = array_unique($array);

	foreach($unique_array as $ua){
		$this->db->select('bill.ar_code, bill.order_id, bill.bill_amount, bill.bill_date, B.saleinvoice, C.customer_name');
		$this->db->where('or_code', $ua);
		$this->db->join('customer_order B','B.order_id = bill.order_id');
		$this->db->join('customer_info C','C.customer_id = bill.customer_id');
		$query2 = $this->db->get('bill');

		//var_dump($query2->result());die();
		foreach($query2->result() as $q2){
			$ar_or[$ua][] =  $q2->ar_code;
			$invoice[$ua][] = $q2->saleinvoice;
			$customer_name[$ua][] = $q2->customer_name; 
			$amount[$ua][] = $q2->bill_amount; 
			$date[$ua][] = $q2->bill_date; 
		}
	}
	$alldata['ar_or'] = $ar_or;
	$alldata['invoice'] = $invoice;
	$alldata['customer_name'] = $customer_name;
	$alldata['amount'] = $amount;
	$alldata['date'] = $date;
	//var_dump($alldata);die();
	return $alldata;
	
}
    
}
