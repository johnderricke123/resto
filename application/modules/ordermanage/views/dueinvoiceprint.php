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
.w-25 {
  width: 25% !important;
}

.w-50 {
  width: 50% !important;
}

.w-75 {
  width: 75% !important;
}

.w-100 {
  width: 100% !important;
}

.w-auto {
  width: auto !important;
}

.h-25 {
  height: 25% !important;
}

.h-50 {
  height: 50% !important;
}

.h-75 {
  height: 75% !important;
}

.h-100 {
  height: 100% !important;
}

.h-auto {
  height: auto !important;
}

.mw-100 {
  max-width: 100% !important;
}

.mh-100 {
  max-height: 100% !important;
}

.m-0 {
  margin: 0 !important;
}

.mt-0,
.my-0 {
  margin-top: 0 !important;
}

.mr-0,
.mx-0 {
  margin-right: 0 !important;
}

.mb-0,
.my-0 {
  margin-bottom: 0 !important;
}

.ml-0,
.mx-0 {
  margin-left: 0 !important;
}

.m-1 {
  margin: 0.25rem !important;
}

.mt-1,
.my-1 {
  margin-top: 0.25rem !important;
}

.mr-1,
.mx-1 {
  margin-right: 0.25rem !important;
}

.mb-1,
.my-1 {
  margin-bottom: 0.25rem !important;
}

.ml-1,
.mx-1 {
  margin-left: 0.25rem !important;
}

.m-2 {
  margin: 0.5rem !important;
}

.mt-2,
.my-2 {
  margin-top: 0.5rem !important;
}

.mr-2,
.mx-2 {
  margin-right: 0.5rem !important;
}

.mb-2,
.my-2 {
  margin-bottom: 0.5rem !important;
}

.ml-2,
.mx-2 {
  margin-left: 0.5rem !important;
}

.m-3 {
  margin: 1rem !important;
}

.mt-3,
.my-3 {
  margin-top: 1rem !important;
}

.mr-3,
.mx-3 {
  margin-right: 1rem !important;
}

.mb-3,
.my-3 {
  margin-bottom: 1rem !important;
}

.ml-3,
.mx-3 {
  margin-left: 1rem !important;
}

.m-4 {
  margin: 1.5rem !important;
}

.mt-4,
.my-4 {
  margin-top: 1.5rem !important;
}

.mr-4,
.mx-4 {
  margin-right: 1.5rem !important;
}

.mb-4,
.my-4 {
  margin-bottom: 1.5rem !important;
}

.ml-4,
.mx-4 {
  margin-left: 1.5rem !important;
}

.m-5 {
  margin: 3rem !important;
}

.mt-5,
.my-5 {
  margin-top: 3rem !important;
}

.mr-5,
.mx-5 {
  margin-right: 3rem !important;
}

.mb-5,
.my-5 {
  margin-bottom: 3rem !important;
}

.ml-5,
.mx-5 {
  margin-left: 3rem !important;
}

.p-0 {
  padding: 0 !important;
}

.pt-0,
.py-0 {
  padding-top: 0 !important;
}

.pr-0,
.px-0 {
  padding-right: 0 !important;
}

.pb-0,
.py-0 {
  padding-bottom: 0 !important;
}

.pl-0,
.px-0 {
  padding-left: 0 !important;
}

.p-1 {
  padding: 0.25rem !important;
}

.pt-1,
.py-1 {
  padding-top: 0.25rem !important;
}

.pr-1,
.px-1 {
  padding-right: 0.25rem !important;
}

.pb-1,
.py-1 {
  padding-bottom: 0.25rem !important;
}

.pl-1,
.px-1 {
  padding-left: 0.25rem !important;
}

.p-2 {
  padding: 0.5rem !important;
}

.pt-2,
.py-2 {
  padding-top: 0.5rem !important;
}

.pr-2,
.px-2 {
  padding-right: 0.5rem !important;
}

.pb-2,
.py-2 {
  padding-bottom: 0.5rem !important;
}

.pl-2,
.px-2 {
  padding-left: 0.5rem !important;
}

.p-3 {
  padding: 1rem !important;
}

.pt-3,
.py-3 {
  padding-top: 1rem !important;
}

.pr-3,
.px-3 {
  padding-right: 1rem !important;
}

.pb-3,
.py-3 {
  padding-bottom: 1rem !important;
}

.pl-3,
.px-3 {
  padding-left: 1rem !important;
}

.p-4 {
  padding: 1.5rem !important;
}

.pt-4,
.py-4 {
  padding-top: 1.5rem !important;
}

.pr-4,
.px-4 {
  padding-right: 1.5rem !important;
}

.pb-4,
.py-4 {
  padding-bottom: 1.5rem !important;
}

.pl-4,
.px-4 {
  padding-left: 1.5rem !important;
}

.p-5 {
  padding: 3rem !important;
}

.pt-5,
.py-5 {
  padding-top: 3rem !important;
}

.pr-5,
.px-5 {
  padding-right: 3rem !important;
}

.pb-5,
.py-5 {
  padding-bottom: 3rem !important;
}

.pl-5,
.px-5 {
  padding-left: 3rem !important;
}

.m-auto {
  margin: auto !important;
}

.mt-auto,
.my-auto {
  margin-top: auto !important;
}

.mr-auto,
.mx-auto {
  margin-right: auto !important;
}

.mb-auto,
.my-auto {
  margin-bottom: auto !important;
}

.ml-auto,
.mx-auto {
  margin-left: auto !important;
}
.text-bold{font-weight:700;}
.text-monospace {
  font-family: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
}

.text-justify {
  text-align: justify !important;
}

.text-nowrap {
  white-space: nowrap !important;
}

.text-truncate {
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}

.text-left {
  text-align: left !important;
}

.text-right {
  text-align: right !important;
}

.text-center {
  text-align: center !important;
}
.text-italic{font-style:italic;}
.border-bottom--dashed{border-bottom:1px #666 dashed;}
.justify-content-start {
  -ms-flex-pack: start !important;
  justify-content: flex-start !important;
}

.justify-content-end {
  -ms-flex-pack: end !important;
  justify-content: flex-end !important;
}

.justify-content-center {
  -ms-flex-pack: center !important;
  justify-content: center !important;
}

.justify-content-between {
  -ms-flex-pack: justify !important;
  justify-content: space-between !important;
}

.justify-content-around {
  -ms-flex-pack: distribute !important;
  justify-content: space-around !important;
}

.align-items-start {
  -ms-flex-align: start !important;
  align-items: flex-start !important;
}

.align-items-end {
  -ms-flex-align: end !important;
  align-items: flex-end !important;
}

.align-items-center {
  -ms-flex-align: center !important;
  align-items: center !important;
}

.align-items-baseline {
  -ms-flex-align: baseline !important;
  align-items: baseline !important;
}

.align-items-stretch {
  -ms-flex-align: stretch !important;
  align-items: stretch !important;
}

.align-content-start {
  -ms-flex-line-pack: start !important;
  align-content: flex-start !important;
}

.align-content-end {
  -ms-flex-line-pack: end !important;
  align-content: flex-end !important;
}

.align-content-center {
  -ms-flex-line-pack: center !important;
  align-content: center !important;
}

.align-content-between {
  -ms-flex-line-pack: justify !important;
  align-content: space-between !important;
}

.align-content-around {
  -ms-flex-line-pack: distribute !important;
  align-content: space-around !important;
}

.align-content-stretch {
  -ms-flex-line-pack: stretch !important;
  align-content: stretch !important;
}

.align-self-auto {
  -ms-flex-item-align: auto !important;
  align-self: auto !important;
}

.align-self-start {
  -ms-flex-item-align: start !important;
  align-self: flex-start !important;
}

.align-self-end {
  -ms-flex-item-align: end !important;
  align-self: flex-end !important;
}

.align-self-center {
  -ms-flex-item-align: center !important;
  align-self: center !important;
}

.align-self-baseline {
  -ms-flex-item-align: baseline !important;
  align-self: baseline !important;
}

.align-self-stretch {
  -ms-flex-item-align: stretch !important;
  align-self: stretch !important;
}
.d-flex{display:flex;}
.text-white {
  color: #fff !important;
}
</style>
<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div id="printableArea" class="bill__container bill-pos-mini__container" style="width: 284px; font-size:11px;">
    <div class="pt-1">
        <h5>DCCCO HOTEL <br> Invoice</h5>
<!--        <div class="bill-pos-mini__logo border" align="center"><img src="--><?php //echo base_url();?><!----><?php //echo $storeinfo->logo?><!--" class="img img-responsive" alt=""></div>-->
<!--    </div>-->
<!--    <div class="px-4">-->
<!--        <h5 class="text-center mt-3 mb-0 text-bold">--><?php //echo display('bill');?><!--</h5>-->
<!--        <p class="text-note text-primary text-center mb-0 text-bold">--><?php //echo $storeinfo->storename;?><!--</p>-->
<!--        <p class="text-note text-center mb-3">--><?php //echo $storeinfo->address;?><!--</p>-->
<!--        <div>-->
<!--            <p class="mb-0"><b class="text-bold">--><?php //echo display('recept')?><!--: </b> #--><?php //echo $orderinfo->saleinvoice;?><!--</p>-->
            <p class="mb-0"><b class="text-bold"><?php echo display('table');?>: </b> <?php echo $tableinfo->tablename;?></p>
      
      <p class="text-note text-center mb-3">Invoice No.: <?php echo $orderinfo->saleinvoice; ?></p>
<!--            --><?php //if($storeinfo->isvatnumshow==1){?><!--<p class="mb-0"><b class="text-bold">--><?php //echo display('tinvat');?><!--: </b>--><?php //echo $storeinfo->vattinno;?><!--</p>--><?php //} ?>
            <p class="mb-0"><b class="text-bold"><?php echo display('date');?>: </b><?php echo date("M d, Y", strtotime($orderinfo->order_date));?></p>
            <div class="d-flex justify-content-between">
                <p class="mb-0"><b class="text-bold"><?php echo display('checkin')?>: </b> <?php echo $orderinfo->order_time;?></p>
                <!--<p class="mb-0"><b class="text-bold"><?php //echo display('checkout')?>: </b> <?php //echo date('H:i:s');?></p>-->
            </div>
        </div>
        <div class="pb-3 border-bottom--dashed">
            <table class="w-100">
                <thead>
                    <th style="width: 50%;"><strong><?php echo display('item')?></strong></th>
                    <th style="width: 50%; text-align: right;"><strong><?php echo display('total')?></strong></th>
                </thead>
                <tbody>
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
                    <tr>
                        <td class="p-0"><p class="mb-0"><?php echo $item->ProductName;?>-<?php echo $item->variantName;?></p><small class="mb-0 text-italic"><?php echo $item->menuqty;?> x <?php echo $item->price;?></small></td>
                        <td valign="top" class="p-0 text-right"><p class="mb-0"><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $itemprice-$ptdiscount;?> <?php if($currency->position==2){echo $currency->curr_icon;}?></p></td>
                    </tr>
                    
                    <?php 
			if(!empty($item->add_on_id)){
				$y=0;
					foreach($addons as $addonsid){
							$adonsinfo=$this->order_model->read('*', 'add_ons', array('add_on_id' => $addonsid));
							$adonsprice=$adonsprice+$adonsinfo->price*$addonsqty[$y];?>
			 		<tr>
                        <td valign="top" class="p-0"><p class="mb-0 ml-2">-<?php echo $adonsinfo->add_on_name;?></p><small class="mb-0 ml-2 text-italic"><?php echo $addonsqty[$y];?> x <?php echo $adonsinfo->price;?></small></td>
                        <td valign="top" class="text-right"><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $adonsinfo->price*$addonsqty[$y];?> <?php if($currency->position==2){echo $currency->curr_icon;}?></td>
                    </tr>
             
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
                </tbody>
            </table>
        </div>
        <div class="border-bottom--dashed">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <p class="mb-0 text-note text-primary text-bold"><?php echo display('subtotal')?>:</p>
                <p class="mb-0 text-note text-primary text-bold"><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $billinfo->total_amount;?> <?php if($currency->position==2){echo $currency->curr_icon;}?></p>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-2">
                <p class="mb-0 text-note text-primary"><?php echo display('discount')?><?php //echo $discountpr;?></p>
                <p class="mb-0 text-note text-primary">-<?php if($currency->position==1){echo $currency->curr_icon;}?>  <?php $discount=0; if(empty($billinfo)){ echo $discount;} else{echo $discount=$billinfo->discount;} ?> <?php if($currency->position==2){echo $currency->curr_icon;}?></p>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-2">
                <p class="mb-0 text-note text-primary"><?php echo display('service_chrg')?>:</p>
                <p class="mb-0 text-note text-primary"><?php if($currency->position==1){echo $currency->curr_icon;}?><?php $sdcharge=0; if(empty($billinfo)){ echo $sdcharge;} else{echo $sdcharge=$billinfo->service_charge;} ?><?php if($currency->position==2){echo $currency->curr_icon;}?></p>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-2">
                <p class="mb-0 text-note text-primary"><?php echo display('vat_tax')?>(<?php echo $storeinfo->vat;?>%):</p>
                <p class="mb-0 text-note text-primary"><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $calvat=$billinfo->VAT; ?> <?php if($currency->position==2){echo $currency->curr_icon;}?></p>
            </div>
        </div>
        <div class="border-bottom--dashed">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <p class="mb-0 text-note text-primary text-bold"><?php echo display('grand_total')?>:</p>
                <p class="mb-0 text-note text-primary text-bold"><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $billinfo->bill_amount;?> <?php if($currency->position==2){echo $currency->curr_icon;}?></p>
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
            <div class="d-flex justify-content-between align-items-center mb-2">
                <p class="mb-0 text-note text-primary">Amount Paid/p>
                <p class="mb-0 text-note text-primary"><?php if($currency->position==1){echo $currency->curr_icon;}?>  <?php echo $customepaid; ?> <?php if($currency->position==2){echo $currency->curr_icon;}?></p>
            </div>
            <?php } else{ ?>
            <div class="d-flex justify-content-between align-items-center">
                <p class="mb-0 text-note text-primary"><?php echo display('total_due')?>:</p>
                <p class="mb-0 text-note text-primary"><?php if($currency->position==1){echo $currency->curr_icon;}?>  <?php echo $customepaid; ?> <?php if($currency->position==2){echo $currency->curr_icon;}?></p>
            </div>
            <?php } ?>
            <div class="d-flex justify-content-between align-items-center">
                <p class="mb-0 text-note text-primary"><?php echo display('change_due')?>:</p>
                <p class="mb-0 text-note text-primary"><?php if($currency->position==1){echo $currency->curr_icon;}?>  <?php echo $changes; ?> <?php if($currency->position==2){echo $currency->curr_icon;}?></p>
            </div>
        </div>
        <div class="" style="display: none;">
            <div class="d-flex justify-content-between">
                <p class="text-note text-center mb-0">+ <?php echo display('totalpayment')?></p>
                <?php if($billinfo->bill_status==1){?>
                    <p class="mb-0 text-note">
                        <?php if($currency->position==1){
                            echo $currency->curr_icon;
                        }?>
                        <?php echo $customepaid; ?>
                        <?php if($currency->position==2){
                            echo $currency->curr_icon;
                        }?>
                    </p>
				<?php } else{?>
                    <p class="mb-0 text-note">
                        <?php if($currency->position==1){echo $currency->curr_icon;}?>
                        <?php echo 0.00; ?> <?php if($currency->position==2){echo $currency->curr_icon;}?>
                    </p>
                <?php } ?>
            </div>
        </div>
    </div>

<div class="border-top py-1">
    <p class="text-note text-primary text-center mb-0 text-bold"><?php echo display('thanks_you')?> <br> This is not an official receipt</p>

</div>
</div>

