<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- Printable area start -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Print Invoice</title>

<style>
@page  
{ 
    size: auto;   /* auto is the initial value */ 

    /* this affects the margin in the printer settings */ 
    margin: 0mm 0 0mm 0;  
} 

body  
{ 
    /* this affects the margin on the content before sending to printer */ 
    margin: 0px;  
} 
@media screen {
    .header, .footer {
        display: none;
    }
}
</style>
<style>
.mb-0 {
    margin-bottom: 0;
}

.my-50 {
    margin-top: 50px;
    margin-bottom: 50px;
}

.my-0 {
    margin-top: 0;
    margin-bottom: 0;
}

.my-5 {
    margin-top: 5px;
    margin-bottom: 5px;
}

.mt-10 {
    margin-top: 10px;
}

.mb-15 {
    margin-bottom: 15px;
}

.mr-18 {
    margin-right: 18px;
}

.mr-25 {
    margin-right: 25px;
}

.mb-25 {
    margin-bottom: 25px;
}
.h4, .h5, .h6, h4, h5, h6 {
    margin-top: 10px;
    margin-bottom: 10px;
}
.login-wrapper {
    background: url(../img/bhojon/login-bg.jpg) no-repeat;
    background-size: 100% 100%;
    height: 100vh;
    position: relative;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.login-wrapper:before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    display: block;
    background: rgba(0, 0, 0, 0.5);
}

.login_box {
    text-align: center;
    position: relative;
    width: 400px;
    background: #343434;
    padding: 40px 30px;
    border-radius: 10px;
}

.login_box .form-control {
    height: 60px;
    margin-bottom: 25px;
    padding: 12px 25px;
}

.btn-login {
    color: #fff;
    background-color: #45C203;
    border-color: #45C203;
    width: 100%;
    line-height: 45px;
    font-size: 17px;
}

.btn-login:hover,
.btn-login:focus {
    color: #fff;
    background-color: transparent;
    border-color: #fff;
}

/*Bhojon List*/

.invoice-card {
    display: flex;
    flex-direction: column;
    padding: 5px;
    width:310px;
    background-color: #fff;
    border-radius: 5px;
   /* box-shadow: 0px 10px 30px 15px rgba(0, 0, 0, 0.05);*/
    margin: 15px auto;
}

.invoice-head,
.invoice-card .invoice-title {
    display: -webkit-flex;
    display: -moz-flex;
    display: -ms-flex;
    display: -o-flex;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.invoice-head {
    flex-direction: column;
    margin-bottom: 15px;
}

.invoice-card .invoice-title {
    margin: 8px 0;
}

.invoice-title span {
    color: rgba(0, 0, 0, 0.4);
}

.invoice-details {
    border-top: 0.5px dashed #747272;
    border-bottom: 0.5px dashed #747272;
}

.invoice-list {
    width: 100%;
    border-collapse: collapse;
    border-bottom: 1px dashed #858080;
}

.invoice-list .row-data {
    border-bottom: 1px dashed #858080;
    padding-bottom: 4px;
    margin-bottom: 4px;
}

.invoice-list .row-data:last-child {
    border-bottom: 0;
    margin-bottom: 0;
}

.invoice-list .heading {
    font-size: 16px;
    font-weight: 600;
	margin: 0;
}

.invoice-list thead tr td {
    font-size: 15px;
    font-weight: 600;
    padding: 5px 0;
}

.invoice-list tbody tr td {
    line-height: 20px;
}

.row-data {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    width: 100%;
}

.middle-data {
    display: flex;
    align-items: center;
    justify-content: center;
}

.item-info {
    max-width: 200px;
}

.item-title {
    font-size: 14px;
    margin: 0;
    line-height: 16px;
    font-weight: 500;
}

.item-size {
    line-height: 15px;
}

.item-size,
.item-number {
    margin: 1px 0;
}

.invoice-footer {
    margin-top: 10px;
}

.gap_right {
    border-right: 1px solid #ddd;
    padding-right: 15px;
    margin-right: 15px;
}

.b_top {
    border-top: 1px solid #ddd;
    padding-top: 12px;
}


.food_item {
    display: -webkit-flex;
    display: -moz-flex;
    display: -ms-flex;
    display: -o-flex;
    display: flex;
    align-items: center;

    border: 1px solid #ddd;
    border-top: 5px solid #1DB20B;
    padding: 15px;
    margin-bottom: 25px;
    transition-duration: 0.4s;
}

.bhojon_title {
    margin-top: 6px;
    margin-bottom: 6px;
    font-size: 14px;
}

.food_item .img_wrapper {
    padding: 8px 5px;
    background-color: #ececec;
    border-radius: 6px;
    position: relative;
    transition-duration: 0.4s;
}

.food_item .table_info {
    font-size: 11px;
    background: #1db20b;
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 4px 8px;
    color: #fff;
    border-radius: 15px;
    text-align: center;
}

.food_item:focus,
.food_item:hover {
    background-color: #383838;
}

.food_item:focus .bhojon_title,
.food_item:hover .bhojon_title {
    color: #fff;
}

.food_item:hover .img_wrapper,
.food_item:focus .img_wrapper {
    background-color: #383838;
}

.btn-4 {
    border-radius: 0;
    padding: 15px 22px;
    font-size: 16px;
    font-weight: 500;
    color: #fff;
    min-width: 130px;
}

.btn-4.btn-green {
    background-color: #1DB20B;
}

.btn-4.btn-green:focus,
.btn-4.btn-green:hover {
    background-color: #3aa02d;
    color: #fff;
}

.btn-4.btn-blue {
    background-color: #115fc9;
}

.btn-4.btn-blue:focus,
.btn-4.btn-blue:hover {
    background-color: #305992;
    color: #fff;
}

.btn-4.btn-sky {
    background-color: #1ba392;
}

.btn-4.btn-sky:focus,
.btn-4.btn-sky:hover {
    background-color: #0dceb6;
    color: #fff;
}

.btn-4.btn-paste {
    background-color: #0b6240;
}

.btn-4.btn-paste:hover,
.btn-4.btn-paste:focus {
    background-color: #209c6c;
    color: #fff;
}

.btn-4.btn-red {
    background-color: #eb0202;
}

.btn-4.btn-red:focus,
.btn-4.btn-red:hover {
    background-color: #ff3b3b;
    color: #fff;
}
.text-center {
    text-align: center;
}
</style>
</head>

<body>
<div class="page-wrapper">
        <div class="invoice-card">
<!--            <div class="invoice-head">-->
<!--                <img src="--><?php //echo base_url();?><!----><?php //echo $storeinfo->logo?><!--" alt="">-->
<!--                <h4>--><?php //echo $storeinfo->storename;?><!--</h4>-->
<!--                <p class="my-0">--><?php //echo $storeinfo->address;?><!--</p>-->
<!--            </div>-->
<!--			<div class="invoice_address">-->
<!--                <div class="row-data">-->
<!--                    <div class="item-info">-->
<!--                        <h5 class="item-title">--><?php //echo display('date');?><!--: --><?php //echo date("M d, Y", strtotime($billdate));?><!--</h5>-->
<!--                    </div>-->
<!--                    --><?php //if($storeinfo->isvatnumshow==1){?><!--<h5 class="item-title">--><?php //echo display('tinvat');?><!--: --><?php //echo $storeinfo->vattinno;?><!--</h5>--><?php //} ?>
<!--                </div>-->

<!--            </div>-->

            <?php
            $allorder = '';
            foreach($billinfo as $billinf){
                $itemtotal=$billinf->totalamount;
                $allsubtotal=$allsubtotal+$billinf->total_amount;
                $singlevat=$billinf->VAT;
                $calvat= $calvat+$singlevat;
                $sdpr=$billinf->service_charge;
                $servicecharge=$servicecharge+$sdpr;
                $sdr=$billinf->discount;
                $discount=$discount+$sdr;
                $grandtotal=$grandtotal+$billinf->bill_amount;
                $allorder.=$billinf->order_id.',';
            }
            ?>
            <div class="invoice-details">
                <div class="item-info gap_right">
                    <h5 class="item-title"><?php echo display('table');?>: <?php echo $tableinfo->tablename;?></h5>
                </div>
                <div class="item-info">
                    <h5 class="item-title"><?php echo display('orderno')?>: <?php echo $allorder;?></h5>
                </div>
                 <h5 class="item-title"><?php echo display('date');?>: <?php echo date("M d, Y", strtotime($billdate));?></h5>
            </div>


            <div class="invoice-details">
                <div class="invoice-list">
                    <div class="invoice-title">
                        <h4 class="heading"><?php echo display('item')?></h4>
                        <h4 class="heading heading-child"><?php echo display('total')?></h4>
                    </div>

                    <div class="invoice-data">
                        <?php $this->load->model('ordermanage/order_model',	'ordermodel');
				  $i=0; 
				  $totalamount=0;
					  $subtotal=0;
					  $total=$orderinfo->totalamount;
					  $pdiscount=0;
					foreach ($iteminfo as $item){
						$i++;
						$itemprice= $item->price*$item->menuqty;
						$itemdetails=$this->ordermodel->getiteminfo($item->menu_id);
						if($itemdetails->OffersRate>0){
						 $ptdiscount=$itemdetails->OffersRate*$itemprice/100;
						  $pdiscount=$pdiscount+($itemdetails->OffersRate*$itemprice/100);
						}
						else{
							$ptdiscount=0;
							$pdiscount=$pdiscount+0;
							}
						$discount=0;
						$adonsprice=0;
						if(!empty($item->add_on_id)){
							$addons=explode(",",$item->add_on_id);
							$addonsqty=explode(",",$item->addonsqty);
							$x=0;
							foreach($addons as $addonsid){
									$adonsinfo=$this->order_model->read('*', 'add_ons', array('add_on_id' => $addonsid));
									$adonsprice=$adonsprice+$adonsinfo->price*$addonsqty[$x];
									$x++;
								}
							$nittotal=$adonsprice;
							$itemprice=$itemprice;
							}
						else{
							$nittotal=0;
							$text='';
							}
						 $totalamount=$totalamount+$nittotal;
						 $subtotal=$subtotal+$item->price*$item->menuqty;
					?>                
                        <div class="row-data">
                            <div class="item-info">
                                <p class="item-title mb-0"><?php echo $item->ProductName;?></p>
                                <p><span class="item-size mt-1"><?php echo $item->variantName;?></span><span class="item-number"><?php echo $item->menuqty;?> x <?php echo $item->price;?></span></p>
                            </div>
                            <h5><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $itemprice-$ptdiscount;?> <?php if($currency->position==2){echo $currency->curr_icon;}?></h5>
                        </div>
                    <?php 
			if(!empty($item->add_on_id)){
				$y=0;
					foreach($addons as $addonsid){
							$adonsinfo=$this->order_model->read('*', 'add_ons', array('add_on_id' => $addonsid));
							$adonsprice=$adonsprice+$adonsinfo->price*$addonsqty[$y];?>
                        <div class="row-data">
                            <div class="item-info">
                                <h5 class="item-title">-<?php echo $adonsinfo->add_on_name;?></h5>
                                <p class="item-number"><?php echo $addonsqty[$y];?> x <?php echo $adonsinfo->price;?></p>
                            </div>
                            <h5><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $adonsinfo->price*$addonsqty[$y];?> <?php if($currency->position==2){echo $currency->curr_icon;}?></h5>
                        </div>
                    <?php $y++;
						}
				 }
			}
			$itemtotal=$totalamount+$subtotal;
							  $calvat=0;
							  $servicecharge=0; 
							  $discount=0; 
							  $grandtotal=0;
							  $allorder='';
							  $allsubtotal=0;
							  foreach($billinfo as $bill){
								  $itemtotal=$bill->totalamount;
								  $allsubtotal=$allsubtotal+$bill->total_amount;
			 					  $singlevat=$bill->VAT;
								  $calvat= $calvat+$singlevat;
								  $sdpr=$bill->service_charge;
								  $servicecharge=$servicecharge+$sdpr;
								  $sdr=$bill->discount;
								  $discount=$discount+$sdr;
								  $grandtotal=$grandtotal+$bill->bill_amount;
								  $allorder.=$bill->order_id.',';
								  }
							 $allorder=trim($allorder,',');
			 ?>
                        
                        
                    </div>
                </div>
                
            </div>

            <div class="invoice-footer mb-15">
                <div class="row-data">
                    <div class="item-info">
                        <h5 class="item-title"><?php echo display('subtotal')?></h5>
                    </div>
                    <h5 class="my-5"><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $allsubtotal;?> <?php if($currency->position==2){echo $currency->curr_icon;}?></h5>
                </div>
                <div class="row-data">
                    <div class="item-info">
                        <h5 class="item-title"><?php echo display('vat_tax')?></h5>
                    </div>
                    <h5 class="my-5"><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $calvat; ?> <?php if($currency->position==2){echo $currency->curr_icon;}?></h5>
                </div>
                <div class="row-data">
                    <div class="item-info">
                        <h5 class="item-title"><?php echo display('service_chrg')?></h5>
                    </div>
                    <h5 class="my-5"><?php if($currency->position==1){echo $currency->curr_icon;}?><?php  echo $servicecharge;?><?php if($currency->position==2){echo $currency->curr_icon;}?></h5>
                </div>
                <div class="row-data">
                    <div class="item-info">
                        <h5 class="item-title"><?php echo display('discount')?></h5>
                    </div>
                    <h5 class="my-5"><?php if($currency->position==1){echo $currency->curr_icon;}?>  <?php echo $discount;?> <?php if($currency->position==2){echo $currency->curr_icon;}?></h5>
                </div>
                
                <div class="row-data" style="border-top: 1px solid #000;">
                    <div class="item-info">
                        <h5 class="item-title"><?php echo display('grand_total')?></h5>
                    </div>
                    <h5 class="my-5"><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $grandtotal;?> <?php if($currency->position==2){echo $currency->curr_icon;}?></h5>
                </div>
                <?php 
			if($orderinfo->customerpaid>0){
				$customepaid=$orderinfo->customerpaid;
				$changes=$customepaid-$orderinfo->totalamount;
				}
			else{
				$customepaid=$orderinfo->totalamount;
				$changes=0;
				}
			?>
                <div class="row-data">
                    <div class="item-info">
                        <h5 class="item-title"><?php echo display('customer_paid_amount')?></h5>
                    </div>
                    <h5 class="my-5"><?php if($currency->position==1){echo $currency->curr_icon;}?>  <?php echo $grandtotal;?> <?php if($currency->position==2){echo $currency->curr_icon;}?></h5>
                </div>
                
                <div class="row-data">
                    <div class="item-info">
                        <h5 class="item-title"><?php echo display('change_due')?></h5>
                    </div>
                    <h5 class="my-5"><?php if($currency->position==1){echo $currency->curr_icon;}?>  <?php echo $changes; ?> <?php if($currency->position==2){echo $currency->curr_icon;}?></h5>
                </div>
                <div class="row-data">
                    <div class="item-info">
                        <h5 class="item-title"><?php echo display('totalpayment')?></h5>
                    </div>
                    <h5 class="my-5"> <?php if($currency->position==1){echo $currency->curr_icon;} echo $grandtotal;if($currency->position==2){echo $currency->curr_icon;}?></h5>
                </div>
            </div>
            
            <div class="invoice_address">
                <div class="row-data">
                    <div class="item-info">
                        <h5 class="item-title"><?php echo display('billing_to');?>: <?php echo $customerinfo->customer_name;?></h5>
                    </div>
                    <h5 class="my-5">Cashier : <?php echo $cashierinfo->firstname.' '.$cashierinfo->lastname;?></h5>
                </div>

                <div class="text-center">
                    <h3 class="mt-10"><?php echo display('thanks_you')?></h3>
                </div>
            </div>
        </div>
    </div>


</body>
</html>
