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
				                          
				                           <th><?php echo display('table')?></th>
				                           <th><?php echo display('total')?></th>
				                           <th><?php echo display('view')?></th>
				                        </tr>
									</thead>
									<tbody>
										
										<?php $totalprice=0;
										foreach ($showcommision as $commission) {
											$totalprice= $commission->totalamount+$totalprice;
										?>
									
										<tr>
												
											<td>
												<a href="<?php echo base_url('report/reports/payroll_commission/').$commission->tableid?>"><?php echo $commission->tablename;?></a>
											</td>
											<td class="text-right">
												<?php echo $commission->totalamount;
													
												?>
											</td>
											<td>  <a  href="<?php echo base_url('report/reports/payroll_commission/').$commission->tableid?>" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="right" title="<?php echo display('view').' '.display('commission') ?>"><i class="fa fa-window-maximize" aria-hidden="true"></i></a> </td>
										</tr>
								<?php }?>
									</tbody>
									<tfoot>
										<tr>
											<td colspan="1" align="right" style="text-align:right;font-size:14px !Important">&nbsp; <b><?php echo display('total_sale') ?> </b></td>
											<td style="text-align: right;"><b><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $totalprice; //total?> <?php if($currency->position==2){echo $currency->curr_icon;}?></b></td>
										</tr>
									</tfoot>
			                    </table>
</div>                                