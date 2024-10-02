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
											<th><?php echo display('sl');?></th>
                                            <th><?php echo display('date');?></th>
                                            <th><?php echo display('user');?></th>
                                            <th><?php echo display('counter_no');?></th>
                                            <th><?php echo display('opening_balance');?></th>
                                            <th><?php echo display('closing_balance');?></th>
                                           	<th><?php echo display('total');?></th>
                                          	<th>Manual Entry</th>
                                            <th><?php echo display('action');?></th>
											
										</tr>
									</thead>
									<tbody>
									<?php 
									$totalopen=0;
									$totalclose=0;
									$i=0;
										foreach ($cashreport as $item) {
										$i++;																											
									?>
											<tr>
																					
                                                <td><?php echo $i;?></td>
                                                <td><?php echo $item->openclosedate;?></td>
                                                <td><?php echo $item->firstname.' '.$item->lastname;?></td>
                                                <td><?php echo $item->counter_no;?></td>
                                                <td align="right"><?php echo $item->opening_balance;?></td>
                                                <td align="right"><?php echo $item->closing_balance;?></td>
                                               <?php $total_bal = $item->opening_balance + $item->closing_balance;?>
                                                <td align="right"><?php echo number_format($total_bal, 2,'.','');?></td>
                                              <td align="right"><?php echo number_format($item->closing_note, 2);?></td>
                                                <td><a href="javascript:;" onclick="detailscash('<?php echo $item->opendate;?>','<?php echo $item->closedate;?>',<?php echo $item->userid;?>)" class="btn btn-xs btn-success btn-sm mr-1" data-toggle="tooltip" data-placement="left" title="" data-original-title="Details"><i class="fa fa-eye"></i></a></td>
											</tr>

								<?php $totalopen = $totalopen+$item->opening_balance;  
								$totalclose = $totalclose+$total_bal;
								} ?>
									</tbody>
									<tfoot>
											<tr>
											<td colspan="5" align="right" style="text-align:right;font-size:14px !Important">&nbsp; <b><?php echo display('total') ?> </b></td>
											<td style="text-align: right;"><b> <?php echo number_format($totalopen,2);?></b></td>
                                            <td style="text-align: right;"><b> <?php echo number_format($totalclose,2);?></b></td>
                                            <td>&nbsp;</td>
										</tr>
									</tfoot>
			                    </table>
</div>                                