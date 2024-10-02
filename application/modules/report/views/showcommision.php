<style type="text/css">
        @media print {
            a[href]:after {
                content: none !important;
            }
        }
    </style>
<div class="table-responsive">
<table class="table table-bordered table-striped table-hover" id="respritbl">
			                        <thead>
										 <tr>
				                          
				                           <th><?php echo display('waiter')?></th>
				                           <th><?php echo display('total')?></th>
				                           <th><?php echo display('commission')?></th>
				                           
				                        </tr>
									</thead>
									<tbody>
										
										<?php $totalprice=0;
										foreach ($showcommision as $commission) {
											$totalprice= ($commission->totalamount*$commissionRate->rate/100)+$totalprice;
										?>
										<tr>
											
											<td>
												<?php echo $commission->WaiterName;?>
											</td>
											<td class="text-right">
												<?php echo $commission->totalamount;?>
											</td>
											<td class="text-right">
												<?php echo $commission->totalamount*$commissionRate->rate/100;
													
												?>
											</td>
										</tr>
								<?php }?>
									</tbody>
									<tfoot>
										<tr>
											<td colspan="2" align="right" style="text-align:right;font-size:14px !Important">&nbsp; <b><?php echo display('total_sale').' '.display('commission'); ?> </b></td>
											<td style="text-align: right;"><b><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $totalprice; //total?> <?php if($currency->position==2){echo $currency->curr_icon;}?></b></td>
										</tr>
									</tfoot>
			                    </table>
</div>                                