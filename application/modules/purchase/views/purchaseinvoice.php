<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<!-- Stock report start -->
<script type="text/javascript">
function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
	document.body.style.marginTop="0px";
    window.print();
    document.body.innerHTML = originalContents;
}
</script>
<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body">
                    <fieldset class="border p-2">
                       <legend  class="w-auto"><?php echo "Invoice Information"; ?></legend>
                    </fieldset>
                    <div class="row">
			<div class="col-sm-12">
		        <div class="panel panel-default">
		            <div class="panel-body"> 
						<a  class="btn btn-warning" href="#" onclick="printDiv('printableArea')"><?php echo "Print"; ?></a>
		            </div>
		        </div>

		    </div>
	    </div>
					<div class="row">
		    <div class="col-sm-12">
		        <div class="panel panel-bd lobidrag">
		            <div class="panel-heading">
		                <div class="panel-title">
		                    <h4><?php echo "Invoice Information"; ?></h4>
		                </div>
		            </div>
		            <div class="panel-body">
						<div id="printableArea" style="margin-left:2px;">
							<div class="text-center">
								<h3> <?php echo $setting->storename;?> </h3>
								<h4>Supplier Name:<?php echo $supplierinfo->supName;?> </h4>
                                <h4>Date : <?php echo date("d-M-Y", strtotime($purchaseinfo->purchasedate));?></h4>
                                <h4>Invoice No : <?php echo $purchaseinfo->invoiceid;?></h4>
								<h4> <?php echo "Print Date" ?>: <?php echo date("d/m/Y h:i:s"); ?> </h4>
							</div>
			                <div class="table-responsive" style="margin-top: 10px;" id="stockproduct">
                            <table id="" class="table table-bordered table-striped table-hover">
			                        <thead>
										<tr>
											<th class="text-center"><?php echo display('ingredient_name') ?></th>
											<th class="text-center"><?php echo "Quantity"; ?></th>
											<th class="text-center"><?php echo "Unit Price"; ?></th>
											<th class="text-center"><?php echo "Total Price"; ?></th>
										</tr>
									</thead>
									<tbody>
                                     <?php foreach($iteminfo as $item){?>
									<tr>
											<td><?php echo $item->ingredient_name;?></td>
									
                                      
                                      
                                      <td class="text-center"><?php                  
                                                     echo $item->quantity;
                                                                       //if($item->purchase_unit == "grm."){
                                                                       //  echo number_format($item->quantity * 0.10, 2);
                                                                       //}else{
	                                                                     //echo $item->quantity;  
                                                                       //}
                                                                       
                                              ?> <?php
                                                                       if($item->purchase_unit == "grm."){
                                                                         echo "g";
                                                                       }else{
	                                                                     echo $item->purchase_unit;  
                                                                       }
                                                                       //echo $item->purchase_unit;
                                                                       ?></td>                                      
                                      
                                      
                                      
                                            <td class="text-right"><?php echo number_format($item->price, 2);?></td>
                                            <td class="text-right"><?php if($currency->position==1){echo "";}?> <?php echo number_format($item->totalprice, 2);?> <?php if($currency->position==2){echo $currency->curr_icon;}?></td>
                                    </tr>
                                    <?php } ?>
                                    <tr>
                                         <td class="text-right" colspan="4">Grand Total:  <?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo number_format($purchaseinfo->total_price - $purchaseinfo->paid_amount , 2);?> <?php if($currency->position==2){echo $currency->curr_icon;}?></td>
                                    </tr>
                                    <tr>
                                         <td class="text-right" colspan="4">Paid Amount:  <?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo number_format($purchaseinfo->paid_amount, 2);?> <?php if($currency->position==2){echo $currency->curr_icon;}?></td>
                                    </tr>
									</tbody>
									
			                    </table>
			                    
			                </div>
			            </div>
		            </div>
		        </div>
		    </div>
		</div>
                </div> 
            </div>
        </div>
    </div>

