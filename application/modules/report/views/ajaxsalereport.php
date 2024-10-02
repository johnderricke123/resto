<style type="text/css">
        @media print {
            a[href]:after {
                content: none !important;
            }


            div.dataTables_filter, .dt-buttons{
                visibility: hidden;
                display: none!important;
            }


            .table thead tr td,.table tbody tr td{
                border-width: 1px !important;
                border-style: solid !important;
                border-color: black !important;

                -webkit-print-color-adjust:exact ;
            }


            .ta thead tr td,.ta tbody tr td{

                border-width: 0.7px !important;
                border-style: solid !important;
                border-color: #ccc !important;

                -webkit-print-color-adjust:exact ;
            }
        }

</style>
<div class="table-responsive">
<table class="table table-bordered table-striped table-hover" id="respritbl">
			                        <thead>
										<tr>
											<th><?php echo "Sale Date"; ?></th>
                                            <th><?php echo "Invoice No."; ?></th>
											<th><?php echo "Customer Name"; ?></th>
                                            <th><?php echo display('paymd');?></th>
											<th><?php echo display('order_total'); ?></th>
											<!-- <th><?php echo display('vat_tax1')?></th> -->
											<th><?php echo display('service_chrg')?></th>
											<th><?php echo display('discount')?></th>
											<th><?php echo display('total_ammount'); ?></th>
										</tr>
									</thead>
									<tbody>
									<?php 
									$totalprice=0;
									if($preport) { 
									foreach($preport as $pitem){
                                      $hotel_guest = '';
                                      $totalprice=$totalprice+$pitem->bill_amount;
                                      
                                      if($pitem->customer_id == '21') {
                                      
										
                                       	$hoteldb = $this->load->database('hmsdb', TRUE);
                                      	$hoteldb->select('*');
                                      	$hoteldb->where('id',$pitem->guest_id);
    									$hoteldb->from('guests');
                                      	$query = $hoteldb->get();
										$guest =  $query->row();
                                        
                                            $hotel_guest = $guest->firstname .' ' . $guest->lastname;
                                         
                                      }
									?>
											<tr>
												<td><?php $originalDate = $pitem->order_date;
												echo $originalDate; ?></td>
												<td><a href="<?php echo base_url("ordermanage/order/orderdetails/".$pitem->order_id) ?>" target="_blank">
												<?php echo $pitem->saleinvoice;?>
                                                </a></td>
                                                <td><?php echo ($hotel_guest == '') ? $pitem->customer_name : $hotel_guest; ?></td>
												<td><?php echo $pitem->payment_method;?></td>
												<td style="text-align: right;"><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo number_format($pitem->total_amount, 2, '.',',');?> <?php if($currency->position==2){echo $currency->curr_icon;}?></td>
												<!-- <td><?php echo $pitem->VAT;?></td> -->
												<td><?php echo $pitem->service_charge;?></td>
												<td><?php echo $pitem->discount;?></td>
												<td style="text-align: right;"><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo number_format($pitem->bill_amount, 2, '.',',');?> <?php if($currency->position==2){echo $currency->curr_icon;}?></td>
											</tr>
									<?php } 
									}
									?>
									</tbody>
									<tfoot>
										<tr>
											<td colspan="7" align="right" style="text-align:right;font-size:14px !Important">&nbsp; <b><?php echo display('total_sale') ?> </b></td>
											<td style="text-align: right;"><b><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $totalprice;?> <?php if($currency->position==2){echo $currency->curr_icon;}?></b></td>
										</tr>
									</tfoot>
			                    </table>
</div>                                