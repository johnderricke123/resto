<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- Printable area start -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Print Invoice</title>

<style>
  
@font-face {
    font-family: 'OCR';
    src: url('/assets/fonts/ocr-a-regular.ttf');
    src: local('/assets/fonts/ocr-a-regular.ttf'), format('truetype');
    font-style: normal;
}
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
  font-family: "OCR";
  font-size: 12pt!important;
  font-weight: 100!important;
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
  	margin-right: 4px;
}

.mt-10 {
    margin-top: 10px;
}

.mb-15 {
    margin-bottom: 5px;
}

.mr-18 {
    margin-right: 5px;
}

.mr-25 {
    margin-right: 5px;
}

.mb-25 {
    margin-bottom: 25px;
}
.h4, .h5, .h6, h4, h5, h6 {
    margin-top: 5px;
    margin-bottom: 5px;
  font-weight: 100!important;
}



/*Bhojon List*/

.invoice-card {
   display: flex;
    flex-direction: column;
    padding: 5px;
    width: 98%;
    background-color: #efefef;    
    /* box-shadow: 0px 10px 30px 15px rgba(0, 0, 0, 0.05); */
    margin: 0px 1px;
  font-size: 12pt!important;
  font-weight: 100!important;
}

  h5.item-title {
    font-weight: regular;
  }
.invoice-head,
.invoice-card .invoice-title {
    display: -webkit-flex;
    display: -moz-flex;
    display: -ms-flex;
    display: -o-flex;
    display: flex;
    justify-content: space-around;
    align-items: center;
}

.invoice-head {
    flex-direction: column;
    margin-bottom: 15px;
}

.invoice-card .invoice-title {
    margin: 6px 0;
  justify-content: space-between;
}

.invoice-title span {
    color: rgba(0, 0, 0, 0.4);
}

.invoice-details {
    border-top: 0.5px dashed #747272;
    border-bottom: 0.5px dashed #747272;
}

.invoice-list {
    width: 99%;
    border-collapse: collapse;
    border-bottom: 1px dashed #858080;
}

.invoice-list .row-data {
    border-bottom: 1px dashed #858080;
    padding-bottom: 8px;
    margin-bottom: 8px;
}

.invoice-list .row-data:last-child {
    border-bottom: 0;
    margin-bottom: 0;
}

.invoice-list .heading {
    font-size: 12px;
    font-weight: regular;
	margin: 0;
}

.invoice-list thead tr td {
    
    padding: 5px 0;
}

.invoice-list tbody tr td {
    line-height: 25px;
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
   /* max-width: 200px; */
}
.item-data-list {
  justify-content: between;
  font-size: 11pt!important;

}
  
  .item-data-list span {
    text-align: left;
  } 
  
  
.item-title {    
    margin: 0;
    line-height: 19px;    
}

.item-size {
    line-height: 19px;
}

.item-size,
.item-number {
    margin: 2px 0;
}

.invoice-footer {
    margin-top: 10px;
}

.gap_right {
    border-right: 1px solid #ddd;
    padding-right: 5px;
    margin-right: 5px;
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
    padding: 15px 5px;
    margin-bottom: 25px;
    transition-duration: 0.4s;
}

.bhojon_title {
    margin-top: 6px;
    margin-bottom: 6px;    
}

.food_item .img_wrapper {
    padding: 15px 5px;
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
    padding: 4px;
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
<!--                        <h5 class="item-title">--><?php //echo display('date');?><!--: --><?php //echo date("M d, Y", strtotime($orderinfo->order_date));?><!--</h5>-->
<!--                    </div>-->
<!--                    --><?php //if($storeinfo->isvatnumshow==1){?><!--<h5 class="item-title">--><?php //echo display('tinvat');?><!--: --><?php //echo $storeinfo->vattinno;?><!--</h5>--><?php //} ?>
<!--                </div>-->
<!--            </div>-->
            <div class="invoice-head">
                <h4 class="text-center">DCCCO HOTEL <br> Bill</h4>
                <div class="middle-data">
                    <div class="item-info gap_right">
                        <h5 class="item-title"><?php echo display('table');?>: <?php echo $tableinfo->tablename;?></h5>
                    </div>
                    <div class="item-info">
                        <h5 class="item-title">Order Slip #<?php echo $orderinfo->tokenno;?></h5>
                    </div>
                </div>
                <!--<h5 class="item-title"><?php echo display('date');?>: <?php echo date("M d, Y", strtotime($orderinfo->order_date));?></h5>-->
                            <h5 class="item-title"><?php echo display('date');?>: <?php echo date("M d, Y h:i A", strtotime($orderinfo->order_date . ' ' . $orderinfo->order_time));?></h5>

<!--                <div class="item-info">-->
<!--                    <h5 class="item-title">Order Slip #--><?php //echo $orderinfo->order_id;?><!--</h5>-->
<!--                </div>-->
            </div>
            <div class="invoice-details">
                <div class="invoice-list">
                    <div class="invoice-title">
                        <h4 class="heading"><?php echo display('qty')?></h4>
                        <h4 class="heading"><?php echo display('item')?></h4>
                        <h4 class="heading"><?php echo display('price')?></h4>
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
						 $subtotal=$subtotal+$nittotal;
					?>                
                        <div class="row-data item-data-list">                           
                            <span><?php echo $item->menuqty;?></span> <span style="margin: 0 3px; font-size: 12px; max-width:125px;display:inline-block;"><?php echo $item->ProductName;?></span><span style="margin-right: 3px;"> <?php echo $item->price;?></span>
                            <span style="margin:0 3px;"><?php // if($currency->position==1){echo $currency->curr_icon;}?><?php echo number_format($itemprice-$ptdiscount,"2",".",",");?><?php // if($currency->position==2){echo $currency->curr_icon;}?></span>
                            
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
			 $calvat=$itemtotal*15/100;
			 
			 $servicecharge=0; 
			 if(empty($billinfo)){ $servicecharge;} 
			 else{$servicecharge=$billinfo->service_charge;}
			 
			 $sdr=0; 
			 if($storeinfo->service_chargeType==1){ 
			 $sdpr=$billinfo->service_charge*100/$billinfo->total_amount;
			 $sdr='('.round($sdpr).'%)';
			 } 
			 else{$sdr='('.$currency->curr_icon.')';}
			 
			  $discount=0; 
			 if(empty($billinfo)){ $discount;} 
			 else{$discount=$billinfo->discount;}
			 
			 $discountpr=0; 
			 if($storeinfo->discount_type==1){ 
			 $dispr=$billinfo->discount*100/$billinfo->total_amount;
			 $discountpr='('.round($dispr).'%)';
			 } 
			 else{$discountpr='('.$currency->curr_icon.')';}
			 ?>
                        
                        
                    </div>
                </div>
                
            </div>

            <div class="invoice-footer mb-15">
                <div class="row-data" style="padding-right: 4px;">
                    <div class="item-info">
                        <h5 class="item-title"><?php echo display('subtotal')?></h5>
                    </div>
                    <h5 class="my-5"><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo number_format($total,"2",".",",");?> <?php if($currency->position==2){echo $currency->curr_icon;}?></h5>
                </div>
                <div class="row-data" style="padding-right: 4px;">
                    <div class="item-info">
                        <h5 class="item-title"><?php echo display('vat_tax')?>(<?php echo $storeinfo->vat;?>%)</h5>
                    </div>
                    <h5 class="my-5" style="padding-right: 4px;"><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $calvat=$billinfo->VAT; ?> <?php if($currency->position==2){echo $currency->curr_icon;}?> </h5>
                </div>
                <div class="row-data" style="padding-right: 4px;">
                    <div class="item-info">
                        <h5 class="item-title" style="padding-right: 4px;"><?php echo display('service_chrg')?></h5>
                    </div>
                    <h5 class="my-5" style="padding-right: 4px;"><?php if($currency->position==1){echo $currency->curr_icon;}?><?php $sdcharge=0; if(empty($billinfo)){ echo $sdcharge;} else{echo $sdcharge=$billinfo->service_charge;} ?><?php if($currency->position==2){echo $currency->curr_icon;}?></h5>
                </div>
                <div class="row-data" style="padding-right: 4px;">
                    <div class="item-info">
                        <h5 class="item-title"><?php echo display('discount')?></h5>
                    </div>
                    <h5 class="my-5" style="padding-right: 4px;"><?php if($currency->position==1){echo $currency->curr_icon;}?>  <?php $discount=0; if(empty($billinfo)){ echo $discount;} else{echo $discount=$billinfo->discount;} ?> <?php if($currency->position==2){echo $currency->curr_icon;}?></h5>
                </div>
                
                <div class="row-data" style="border-top: 1px solid #000;">
                    <div class="item-info">
                        <h5 class="item-title"><?php echo display('grand_total')?></h5>
                    </div>
                    <h5 class="my-5" style="padding-right: 4px;"><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo number_format($total,"2",".",",");?> <?php if($currency->position==2){echo $currency->curr_icon;}?></h5>
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
			if($billinfo->bill_status==1){?>
                <div class="row-data" style="padding-right: 4px;">
                    <div class="item-info">
                        <h5 class="item-title"><?php echo display('customer_paid_amount')?></h5>
                    </div>
                    <h5 class="my-5"><?php if($currency->position==1){echo $currency->curr_icon;}?>  <?php echo $customepaid; ?> <?php if($currency->position==2){echo $currency->curr_icon;}?></h5>
                </div>
                <?php } else{ ?>
                <div class="row-data" style="padding-right: 4px;">
                    <div class="item-info">
                        <h5 class="item-title"><?php echo display('total_due')?></h5>
                    </div>
                    <h5 class="my-5"><?php if($currency->position==1){echo $currency->curr_icon;}?>  <?php echo $customepaid; ?> <?php if($currency->position==2){echo $currency->curr_icon;}?></h5>
                </div>
                <?php } ?>
                <?php if($billinfo->bill_status==1){?>
                <div class="row-data" style="padding-right: 4px;">
                    <div class="item-info">
                        <h5 class="item-title"><?php echo display('change_due')?></h5>
                    </div>
                    <h5 class="my-5"><?php if($currency->position==1){echo $currency->curr_icon;}?>  <?php echo $changes; ?> <?php if($currency->position==2){echo $currency->curr_icon;}?></h5>
                </div>
                <div class="row-data" style="padding-right: 4px;">
                    <div class="item-info">
                        <h5 class="item-title"><?php echo display('totalpayment')?></h5>
                    </div>
                    <h5 class="my-5"> <?php if($billinfo->bill_status==1){if($currency->position==1){echo $currency->curr_icon;} echo $customepaid; if($currency->position==2){echo $currency->curr_icon;} } else{ if($currency->position==1){echo $currency->curr_icon;} echo $customepaid;if($currency->position==2){echo $currency->curr_icon;} }?></h5>
                </div>
                <?php } ?>
                <?php if($billinfo->payment_method_id==2){?>
                    <div class="row-data">
                        <div class="item-info">
                            <h5 class="item-title">Room Charge</h5>
                        </div>
                        <h5 class="my-5"><?php if($currency->position==1){echo $currency->curr_icon;}?>  <?php echo $changes; ?> <?php if($currency->position==2){echo $currency->curr_icon;}?></h5>
                    </div>
                    <div class="row-data">
                        <div class="item-info">
                            <h5 class="item-title">_________________________________</h5>
                        </div>
                        <h5 class="my-5">Signature Over Printed Name</h5>
                    </div>
                <?php } ?>
            </div>
            
            <div class="invoice_footer">
                <div class="row-data">
                    <div class="item-info">
                        <h5 class="item-title"><?php echo display('billing_to');?> : <?php echo $customerinfo->customer_name;?> </h5>
                    </div>
              </div>
              <div class="row-data">
                    <h5 class="item-title my-2">Waiter <?php echo $cashierinfo->firstname.' '.$cashierinfo->lastname;?> </h5>
                </div>
                <div class="">
                    <span>TXN# <?php echo $orderinfo->order_id;?></span>
                </div>
                <div class="text-center">
                    <h4 class="mt-5"><?php echo display('thanks_you')?> <br> This is not an official receipt</h4>
                </div>
            </div>
        </div>
    </div> 

</body>
</html>
