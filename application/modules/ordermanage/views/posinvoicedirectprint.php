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
  /* newly added */
* {
font-size: 18px;
    }
/* newly added */

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
    margin-bottom: 25px;
}

.invoice-card .invoice-title {
    margin: 15px 0;
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
    padding-bottom: 10px;
    margin-bottom: 15px;
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
    max-width: 200px;
}

.item-title {
    /* adjusted from 14px to 18px */
    font-size: 18px;
    /* adjusted from 14px to 18px */
    margin: 0;
    line-height: 19px;
    font-weight: 500;
}

.item-size {
    line-height: 19px;
}

.item-size,
.item-number {
    margin: 5px 0;
}

.invoice-footer {
    margin-top: 20px;
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

<div class="page-wrapper">
        <div class="invoice-card">
            <div class="invoice-head">
                
                    <div class="middle-data">
                        <div class="item-info text-center">
                            <h4 class="invoice-title">DCCCO HOTEL <br> Invoice</h4>
                        </div>
                    </div>
                     
              
              <?php if($orderinfo->cutomertype === 99){ ?>
                    <div class="middle-data">
                      <div class="item-info">
                        <h5 class="invoice-title">For Room Service</h5>
                      </div>
                    </div>
              <?php } else {?>              
              	<div class="middle-data">
                    <div class="item-info gap_right">
                        <h5 class="item-title"><?php echo display('table');?>: <?php echo $tableinfo->tablename;?></h5>
                    </div>
                    <div class="item-info">
                        <h5 class="item-title"><?php echo display('orderno')?>: <?php echo $orderinfo->tokenno;?></h5>
                    </div>
                </div>
              <?php } ?>
            </div>
			<div class="invoice_address">
                <div class="middle-data">
                    <div class="item-info">
                        <!--<h5 class="text-center item-title"><?php echo display('date');?>: <?php echo date("M d, Y", strtotime($orderinfo->order_date));?></h5>-->
                                    <h5 class="item-title"><?php echo display('date');?>: <?php echo date("M d, Y h:i A", strtotime($orderinfo->order_date . ' ' . $orderinfo->order_time));?></h5>

                    </div>
<!--                    --><?php //if($storeinfo->isvatnumshow==1){?><!--<h5 class="item-title">--><?php //echo display('tinvat');?><!--: --><?php //echo $storeinfo->vattinno;?><!--</h5>--><?php //} ?>
            </div>
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
                                <h5 class="item-title"><?php echo $item->ProductName;?></h5>
                                <p class="item-size"><?php echo $item->variantName;?></p>
                                <!-- <p class="item-number"><?php echo $item->menuqty;?> x <?php echo $item->price;?></p>-->
<!-- added font style 18px -->
                                <p class="item-number" style="font-size: 18px;"><?php echo $item->menuqty;?> x <?php echo $item->price;?></p>
<!-- added font style 18px -->
                              
                            </div>
                            <h5><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo number_format($itemprice-$ptdiscount,2);?> <?php if($currency->position==2){echo $currency->curr_icon;}?></h5>
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
                            <h5><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo number_format($adonsinfo->price*$addonsqty[$y],2);?> <?php if($currency->position==2){echo $currency->curr_icon;}?></h5>
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
                <div class="row-data">
                    <div class="item-info">
                        <h5 class="item-title"><?php echo display('subtotal')?></h5>
                    </div>
                    <h5 class="my-5"><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo  number_format($subtotal,2);?> <?php if($currency->position==2){echo $currency->curr_icon;}?></h5>
                </div>
                <div class="row-data">
                    <div class="item-info">
                        <h5 class="item-title"><?php echo display('vat_tax')?>(<?php echo $storeinfo->vat;?>%)</h5>
                    </div>
                    <h5 class="my-5"><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $calvat=$billinfo->VAT; ?> <?php if($currency->position==2){echo $currency->curr_icon;}?></h5>
                </div>
                <div class="row-data">
                    <div class="item-info">
                        <h5 class="item-title"><?php echo display('service_chrg')?></h5>
                    </div>
                    <h5 class="my-5"><?php if($currency->position==1){echo $currency->curr_icon;}?><?php $sdcharge=0; if(empty($billinfo)){ echo $sdcharge;} else{echo $sdcharge=$billinfo->service_charge;} ?><?php if($currency->position==2){echo $currency->curr_icon;}?></h5>
                </div>
                <div class="row-data">
                    <div class="item-info">
                        <h5 class="item-title"><?php echo display('discount')?></h5>
                    </div>
                    <h5 class="my-5"><?php if($currency->position==1){echo $currency->curr_icon;}?>  <?php $discount=0; if(empty($billinfo)){ echo $discount;} else{echo $discount=$billinfo->discount;} ?> <?php if($currency->position==2){echo $currency->curr_icon;}?></h5>
                </div>
                
                <div class="row-data" style="border-top: 1px solid #000;">
                    <div class="item-info">
                        <h5 class="item-title"><?php echo display('grand_total')?></h5>
                    </div>
                    <h5 class="my-5"><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo number_format($billinfo->bill_amount,2);?> <?php if($currency->position==2){echo $currency->curr_icon;}?></h5>
                </div>
                <?php 
			if($orderinfo->customerpaid>0){
				$customepaid=$orderinfo->customerpaid;
				$changes=$customepaid-$orderinfo->totalamount;
              	$changes2=$orderinfo->totalamount;
				}
			else{
				$customepaid=$orderinfo->totalamount;
				$changes=0;
				}
			if($billinfo->bill_status==1 || $billinfo->bill_status==2 ){?>
                <div class="row-data">
                    <div class="item-info">
                      
                        <h5 class="item-title"><?php echo display('amount_paid')?></h5>
                      <?php if($billinfo->bill_status==2 && $billinfo->payment_method==2 ) { ?>
                      	
                      			<h5 class="item-title">Paid Breakfast Inclusion</h5>
                      
                      <?php } ?>
                    </div>
                    <h5 class="my-5"><?php if($currency->position==1){echo $currency->curr_icon;}?>  <?php echo $customepaid; ?> <?php if($currency->position==2){echo $currency->curr_icon;}?></h5>
                </div>
                <?php } else { ?>
                <div class="row-data">
                    <div class="item-info">
                        <h5 class="item-title"><?php echo display('total_due')?></h5>
                    </div>
                    <h5 class="my-5"><?php if($currency->position==1){echo $currency->curr_icon;}?>  <?php echo $customepaid; ?> <?php if($currency->position==2){echo $currency->curr_icon;}?></h5>
                </div>
                <?php } ?>
                
              
              <?php if($billinfo->bill_status==1){?>
                <div class="row-data">
                    <div class="item-info">
                        <h5 class="item-title"><?php echo display('change_due')?></h5>
                    </div>
                    <h5 class="my-5"><?php if($currency->position==1){echo $currency->curr_icon;}?>  <?php echo $changes; ?> <?php if($currency->position==2){echo $currency->curr_icon;}?></h5>
                </div>
              <?php }?>
             <?php if($billinfo->bill_status==1){ ?>
                <div class="row-data">
                    <div class="item-info">
                        <h5 class="item-title"><?php echo display('totalpayment')?></h5>
                    </div>
                    <h5 class="my-5">
                    <?php 
                  if($currency->position==1){
                  		echo $currency->curr_icon; 
                		} 
              	echo $changes2; 
                 if($currency->position==2){
                    echo $currency->curr_icon;
                  } else { 
                    
                    if($currency->position==1){
                      		echo " ";
                    } 
                    //echo $changes;
                    if($currency->position==2){
                      echo " ";
                    }  ?></h5>
                </div>
              <?php } }?>
               
            </div>
            
            <div class="invoice_address">
               <?php if($orderinfo->customer_name){?>
                    <div class="row-data">
                      <?php if($billinfo->payment_method_id == 6){?>
                              <div class="middle-data">
                                  <div class="item-info">
                                      <h5 class="invoice-title">Room Charge</h5>
                                  </div>
                              </div>
                           <h5 class="my-5"><?php if($currency->position==1){echo $currency->curr_icon;}?>  <?php echo $change; ?> <?php if($currency->position==2){echo $currency->curr_icon;}?></h5>
                          <?php } ?>                      
                   
                    </div>
              		<div class="item-info">
                      
                      <?php if($orderinfo->payment_method_id == 2) { ?>
                        <div class="item-info">
                            <h5 class="item-title">Paid Breakfast Buffet Inclusion</h5>
                        </div>
                      <?php } else { ?>
                      
                      <h5 class="item-title"><?php echo display('billing_to');?>: 
                        <?php } ?> 
                          <?php echo $customerinfo->customer_name;?></h5>
                    </div>
                    <div class="row-data">
                        <div class="item-info">
                          
                          <?php $rm = explode("|", $orderinfo->customer_note);?>
                                                        
                            <h5><?php echo $rm[2]; ?>  ID #___________</h5>
                          <br/>  
                          <h5>
                            Customer: <?php echo $orderinfo->customer_name;?>
                          </h5>
                          <span>___________________________</span>
                           <span>Signature over printed name</span>
                        </div>
                    </div>
                <?php } else { ?>
              
                <div class="row-data">
                    <div class="item-info">
                        <h5 class="item-title"><?php echo display('billing_to');?>: <?php echo $customerinfo->customer_name;?></h5>
                    </div>                  
                </div>
              <?php } ?>
              <div class="row-data">
                    <h5 class="my-5">Billed by: <?php echo $cashierinfo->firstname.' '.$cashierinfo->lastname;?></h5>
                </div>
                <div class="">
                    <span>TXN#<?php echo $orderinfo->order_id;?></span>
                </div>
                <div class="text-center">
                    <h3 class="mt-10"><?php echo display('thanks_you')?> <br> This is not an official receipt</h3>
                </div>
            </div>
        </div>
    </div>

