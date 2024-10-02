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
											<th><?php echo display('date'); ?></th>
                                            <th><?php echo display('item_name')?></th>
											<th><?php echo display('varient_name')?></th>                                         
                                            <th><?php echo display('quantity'); ?></th>
                                           <th>Cost Price</th>
                                            <th><?php echo display('price'); ?></th>
                                           <th>Total Sales(Cost)</th>
											<th></th>Total Selling Price</th>
                                          <th>Total Net</th>
										</tr>
									</thead>
									<tbody>
									<?php 
									$totalprice=0;
									if($preport) { 
									foreach($preport as $pitem){
										if($pitem['isgroup']==1){
                                          $group_varient = $pitem['groupvarient'];
                                          $groupmid = $pitem['groupmid'];
											//$isgrouporid="'".implode("','",$allorderid)."'";
											$condition="$daterange AND order_menu.groupmid=$groupmid AND order_menu.groupvarient=$group_varient";
											$sql="SELECT  DISTINCT(order_menu.groupmid) as menu_id,order_menu.qroupqty,order_menu.isgroup,customer_order.order_date FROM order_menu LEFT JOIN customer_order ON customer_order.order_id=order_menu.order_id WHERE {$condition} AND order_menu.isgroup=1 Group BY order_menu.order_id";
											$query=$this->db->query($sql);
											$myqtyinfo=$query->result();
											$mqty=0;
											foreach($myqtyinfo as $myqty){
												$mqty=$mqty+$myqty->qroupqty;
											}
											$itemqty=$mqty;
											$totalprice=$totalprice+($itemqty*$pitem['price']);
											}
										else{
											$itemqty=$pitem['qty'];
										$totalprice=$totalprice+($pitem->qty*$pitem['price']);
										}
										
									?>
											<tr>
												<td><?php $originalDate = $pitem['order_date'];
									echo $newDate = date("d-M-Y", strtotime($originalDate));
									 ?></td>
												<td><?php echo $pitem['ProductName'];?></td>
                                                <td><?php echo $pitem['variantName'];?></td>
												<td><?php echo $itemqty;?></td>
                                                <td><?php echo $pitem['total_cost'];?></td>

												<td style="text-align: right;"><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $pitem['price'];?> <?php if($currency->position==2){echo $currency->curr_icon;}?></td>
                                              <td></td>
                                              
                                              <td style="text-align: right;"><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $pitem['price']*$itemqty;?> <?php if($currency->position==2){echo $currency->curr_icon;}?></td>
                                              <td></td>
											</tr>
									<?php } 
									}
									?>
									</tbody>
									<tfoot>
										<tr>
											<td colspan="5" align="right" style="text-align:right;font-size:14px !Important">&nbsp; <b><?php echo display('total_sale') ?> </b></td>
											<td style="text-align: right;"><b><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo number_format($totalprice,2);?> <?php if($currency->position==2){echo $currency->curr_icon;}?></b></td>
										</tr>
									</tfoot>
			                    </table>
</div>                                