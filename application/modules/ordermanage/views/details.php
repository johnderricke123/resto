<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- Printable area start -->
<script type="text/javascript">
function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
	// document.body.style.marginTop="-45px";
    window.print();
    document.body.innerHTML = originalContents;
}
</script>
<!-- Printable area end -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd">
                <div class="panel-footer text-right">
						<a  class="btn btn-info" onclick="printDiv('printableArea')" title="Print"><span class="fa fa-print"></span>
						</a>
                    </div>
	                <div id="printableArea">
	                    <div class="panel-body">
	                        <div class="row">
	                            <div class="col-sm-10" style="display: inline-block;width: 68%">
	                                <img src="<?php echo base_url();?><?php echo $storeinfo->logo?>" class="img img-responsive" alt="" style="margin-bottom:20px;height: 55px;">
	                                <br>
	                                <span class="label label-success-outline m-r-15 p-10" ><?php echo display('billing_from') ?></span>
	                                <address style="margin-top:10px">
	                                    <strong><?php echo $storeinfo->storename;?></strong><br>
	                                    <?php echo $storeinfo->address;?><br>
	                                    <abbr><?php echo display('mobile') ?>:</abbr> <?php echo $storeinfo->phone;?><br>
	                                    <abbr><?php echo display('email') ?>:</abbr> 
	                                    <?php echo $storeinfo->email;?><br>
                                      
                                      <style>
                                          .bold-text {
                                              font-weight: bold;
                                          }
                                      </style>

                                      <abbr class="bold-text"><?php echo "Note"; ?>:</abbr>

 <!--                                     	<abbr><?//php echo "Note"; ?>:</abbr> -->
	                                    <?php echo $iteminfo[0]->note;?><br>

	                                </address>
	                            </div>
	                            <div class="col-sm-2 text-left" style="display: inline-block;margin-left: 5px; width: 30%">
	                                <h2 class="m-t-0"><?php echo display('invoice') ?></h2>
	                                <div><?php echo display('invoice_no') ?>: <?php echo $orderinfo->saleinvoice;?></div>
                                    <div><?php echo display('order_status') ?>: <?php if($orderinfo->order_status==1){echo display('pending_order');}else if($orderinfo->order_status==2){ echo display('processing_order');}else if($orderinfo->order_status==5){ echo display('Cancel');}else if($orderinfo->order_status==4){ echo display('served');}?></div>
	                                <div class="m-b-15"><?php echo display('billing_date') ?>: <?php echo $orderinfo->order_date;?></div>
	                                <span class="label label-success-outline m-r-15"><?php echo display('billing_to') ?></span>
	                                 <address style="margin-top:10px">  
	                                    <strong><?php echo $customerinfo->customer_name;?> </strong><br>
	                                    <abbr><?php echo display('address') ?>:</abbr>
		                                <c style="width: 10px;margin: 0px;padding: 0px;"><?php echo $customerinfo->customer_address;?></c><br>
	                                    <abbr><?php echo display('mobile') ?>:</abbr><?php echo $customerinfo->customer_phone;?></abbr>                               
	                                </address>
                                    <?php if($billinfo->shipping_type==2){?>
								<span class="label label-success-outline m-r-15"><?php echo "Shipping To"; ?></span>
								<address style="margin-top:10px">  	                                   
	                                    <abbr><?php echo display('address') ?>:</abbr>
		                                <c style="width: 10px;margin: 0px;padding: 0px;"><?php echo $shipinfo->address;?></c><br>                                                               
	                                </address>
								 <?php } ?>
	                            </div>
	                        </div> 
                            <?php if($orderinfo->order_status==5){?>
                            <div class="row">
                            <p class="col-sm-12"><strong><?php echo display('cancel_reason') ?>:</strong><br /><?php echo $orderinfo->anyreason;?></p>
                            </div>
                            <?php } ?>
                             <?php if($orderinfo->customer_note!=""){?>
                            <div class="row">
                            <p class="col-sm-12"><strong><?php echo display('customer_order') ?>:</strong><br /><?php echo $orderinfo->customer_note;?></p>
                            </div>
                            <?php } ?>
                            <?php if($billinfo->shipping_type==2){?>
                            <div class="row">
                            <p class="col-sm-12"><strong><?php echo display('customerpicktime') ?>:</strong><br /><?php echo $billinfo->delivarydate;?></p>
                            </div>
                            <?php } ?>
                            <hr>

	                        <div class="table-responsive m-b-20">
	                            <table class="table table-fixed table-bordered table-hover bg-white" id="purchaseTable">
                                <thead>
                                     <tr>
                                            <th class="text-center"><?php echo display('item')?> </th>
                                            <th class="text-center"><?php echo display('size')?></th>
                                            <th class="text-center" style="width:100px;"><?php echo display('unit_price')?></th> 
                                            <th class="text-center" style="width:100px;"><?php echo display('qty')?></th> 
                                            <th class="text-center"><?php echo display('total_price')?></th> 
                                        </tr>
                                </thead>
                                <tbody>
                                <?php $i=0; 
								  $totalamount=0;
									  $subtotal=0;
									  $total=$orderinfo->totalamount;
									foreach ($iteminfo as $item){
										$i++;
										$itemprice= $item->price*$item->menuqty;
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
                                        <td>
                                     	<?php echo $item->ProductName;?>
                                        </td>
                                        <td>
                                        <?php echo $item->variantName;?>
                                        </td>
                                        <td class="text-right"><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo number_format ($item->price, 2);?> <?php if($currency->position==2){echo $currency->curr_icon;}?> </td>
                                        <td class="text-right"><?php echo $item->menuqty;?></td>
                                        <td class="text-right"><strong><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo number_format ($itemprice, 2);?> <?php if($currency->position==2){echo $currency->curr_icon;}?> </strong></td>
                                     </tr>
                                    <?php 
									if(!empty($item->add_on_id)){
										$y=0;
											foreach($addons as $addonsid){
													$adonsinfo=$this->order_model->read('*', 'add_ons', array('add_on_id' => $addonsid));
													$adonsprice=$adonsprice+$adonsinfo->price*$addonsqty[$y];?>
                                                    <tr>
                                                        <td colspan="2">
                                                        <?php echo $adonsinfo->add_on_name;?>
                                                        </td>
                                                        <td class="text-right"><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $adonsinfo->price;?> <?php if($currency->position==2){echo $currency->curr_icon;}?> </td>
                                                        <td class="text-right"><?php echo $addonsqty[$y];?></td>
                                                        <td class="text-right"><strong><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $adonsinfo->price*$addonsqty[$y];?> <?php if($currency->position==2){echo $currency->curr_icon;}?> </strong></td>
                                                     </tr>
									<?php $y++;
												}
										 }
									}

									 $itemtotal=$totalamount+$subtotal;
									 $calvat=$itemtotal*$settinginfo->vat/100;
									 
									 $discountpr=0; 
									 if($settinginfo->discount_type==1){ 
									 $dispr=$billinfo->discount*100/$billinfo->total_amount;
									 $discountpr='('.$dispr.'%)';
									 } 
									 else{$discountpr='('.$currency->curr_icon.')';}
									 
									  $sdr=0; 
									 if($storeinfo->service_chargeType==1){ 
									 $sdpr=$billinfo->service_charge*100/$billinfo->total_amount;
									 $sdr='('.round($sdpr).'%)';
									 } 
									 else{$sdr='('.$currency->curr_icon.')';}
									 ?>
                                  
                                  
                                  
                                  
                                  
                                    <tr>
                                    	<td class="text-right" colspan="4"><strong><?php echo display('subtotal')?></strong></td>
                                        <td class="text-right"><strong><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo number_format ($itemtotal, 2);?> <?php if($currency->position==2){echo $currency->curr_icon;}?> </strong></td>
                                    </tr>
                                    <tr>
                                    	<td class="text-right" colspan="4"><strong><?php echo display('discount')?><?php echo $discountpr;?></strong></td>
                                        <td class="text-right"><strong><?php if($currency->position==1){echo $currency->curr_icon;}?>  <?php $discount=0; if(empty($billinfo)){ echo $discount;} else{echo $discount=$billinfo->discount;} ?> <?php if($currency->position==2){echo $currency->curr_icon;}?> </strong></td>
                                    </tr>
                                    <tr>
                                    	<td class="text-right" colspan="4"><strong><?php echo display('service_chrg')?><?php echo $sdr;?></strong></td>
                                        <td class="text-right"><strong><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php $servicecharge=0; if(empty($billinfo)){ echo $servicecharge;} else{echo $servicecharge=$billinfo->service_charge;} ?> <?php if($currency->position==2){echo $currency->curr_icon;}?> </strong></td>
                                    </tr>
                                    <tr>
                                    	<td class="text-right" colspan="4"><strong><?php echo display('vat_tax')?> (<?php echo $settinginfo->vat;?>%)</strong></td>
                                        <td class="text-right"><strong><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $calvat=$billinfo->VAT; ?> <?php if($currency->position==2){echo $currency->curr_icon;}?> </strong></td>
                                    </tr>
                                    <tr>
                                    	<td class="text-right" colspan="4"><strong><?php echo display('grand_total')?></strong></td>
                                        <td class="text-right"><strong><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo number_format ($calvat+$itemtotal+$servicecharge-$discount, 2);?> <?php if($currency->position==2){echo $currency->curr_icon;}?> </strong></td>
                                    </tr>
                                  
                                  
                                  
                                  
                                    <?php if($orderinfo->order_status==5){}else{
			if($orderinfo->customerpaid>0){
				$customepaid=$orderinfo->customerpaid;
				$changes=$customepaid-$orderinfo->totalamount;
				}
			else{
				$customepaid=$orderinfo->totalamount;
				$changes=0;
				}
			if($billinfo->bill_status==1){?>
            <tr>
              <td align="right" colspan="4"><nobr><?php echo display('customer_paid_amount')?></nobr></td>
              <td align="right"><nobr><?php if($currency->position==1){echo $currency->curr_icon;}?>  <?php echo number_format ($customepaid, 2); ?> <?php if($currency->position==2){echo $currency->curr_icon;}?></nobr></td>
            </tr>
            <?php } else{ ?>
            <tr>
              <td align="right" colspan="4"><nobr><?php echo display('total_due')?></nobr></td>
              <td align="right"><nobr><?php if($currency->position==1){echo $currency->curr_icon;}?>  <?php echo number_format ($customepaid, 2); ?> <?php if($currency->position==2){echo $currency->curr_icon;}?></nobr></td>
            </tr>
            <?php } ?>
            <tr>
              <td align="right" colspan="4"><nobr><?php echo display('change_due')?></nobr></td>
              <td align="right"><nobr><?php if($currency->position==1){echo $currency->curr_icon;}?>  <?php echo $changes; ?> <?php if($currency->position==2){echo $currency->curr_icon;}?></nobr></td>
            </tr>
            <?php } ?>
                                </tbody>
                                <tfoot>
                                    
                                </tfoot>
                            </table>

<!--newly added-->
                              <div class="table-responsive m-b-20"> 
                                <h3>
                                  <b>Cancelled Items</b>
                                </h3>
                                <table class="table table-fixed table-bordered table-hover bg-white" style="width:50%;" id="purchaseTable">
                                  <tr>
                                     <th class="text-center"><?php echo "Product Name";?> </th>
                                     <th class="text-center"><?php echo "Variant";?></th>
                                     <th class="text-center" style="width:100px;"><?php echo "Quantity";?></th> 
                                  </tr>
                                  <tr>
                                    <?php foreach($cancelled_items as $ci){
                                    ?>
                                    <tr>
                                      <td>
                                        <?php echo $ci->ProductName; ?>
                                      </td>
                                      <td>
                                        <?php echo $ci->variantName; ?>
                                      </td>
                                      <td>
                                        <?php echo $ci->item_qty."x"; ?>
                                      </td>
                                    </tr>

                                    <?php }?>                                
                                  </tr>
                                </table>
                      		  </div>

<!--newly added-->
                              
	                        </div>
	                    </div>
	                </div>

                     
                </div>
            </div>
        </div>



