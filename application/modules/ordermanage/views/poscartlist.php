<?php $grtotal=0;
$totalitem=0;
 $calvat=0;
$discount=0;
$itemtotal=0;
 $pvat=0;
  $this->load->model('ordermanage/order_model',	'ordermodel');
if ($cart = $this->cart->contents()){?>
<table class="table table-bordered" border="1" width="100%" id="addinvoice">
                                    <thead>
                                        <tr>
                                            <th><?php echo display('item')?></th>
                                            <th>Variant/Size</th>
                                            <th><?php echo display('price');?></th>
                                            <th><?php echo display('qty');?></th>
                                            <th><?php echo display('total');?></th>
                                            <th><?php echo display('action');?></th>
                                        </tr>
                                    </thead>
                                    <tbody class="itemNumber">
                                    <?php $i=0; 
								      $totalamount=0;
									  $subtotal=0;
									 $pvat=0;
									 $discount=0;
									 $pdiscount=0;
									foreach ($cart as $item){
										$iteminfo=$this->ordermodel->getiteminfo($item['pid']);
										//print_r($iteminfo);
										$itemprice= $item['price']*$item['qty'];
										$vatcalc=$itemprice*$iteminfo->productvat/100;
										$pvat=$pvat+$vatcalc;
										if($iteminfo->OffersRate>0){
											$mypdiscount=$iteminfo->OffersRate*$itemprice/100;
											$pdiscount=$pdiscount+($iteminfo->OffersRate*$itemprice/100);
											}
										else{
											$mypdiscount=0;
											$pdiscount=$pdiscount+0;
											}
										if(!empty($item['addonsid'])){
											$nittotal=$item['addontpr'];
											$itemprice=$itemprice+$item['addontpr'];
											}
										else{
											$nittotal=0;
											$itemprice=$itemprice;
											}
										 $totalamount=$totalamount+$nittotal;
										$subtotal=$subtotal+$nittotal+$item['price']*$item['qty'];
									$i++;
									$totalitem=$i;
									?>
                                        <tr id="<?php echo $i;?>">
                                            <th id="product_name_MFU4E" class="text-left align-left"><?php echo  $item['name'];
											if(!empty($item['addonsid'])){
											echo "<br>";
											echo $item['addonname'];
											}
											?><a class="serach" onclick="itemnote('<?php echo $item['rowid']?>','<?php echo $item['itemnote']?>',<?php echo $item['qty'];?>,2)" style="padding-left:15px;" title="<?php echo display('foodnote') ?>"> <i class="fa fa-sticky-note" aria-hidden="true"></i> </a></th>
                                            <td>
                                            <?php echo $item['size'];?>
                                            </td>
                                            <td width="">
                                                <?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo number_format($item['price'], 2,'.',',');?><?php if($currency->position==2){echo $currency->curr_icon;}?>
                                            </td>
                                            <td scope="row">
                                            <a class="btn btn-info btn-sm btnleftalign" onclick="posupdatecart('<?php echo $item['rowid']?>',<?php echo $item['pid']?>,<?php echo $item['sizeid']?>,<?php echo $item['qty'];?>,'add')"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                             <span id="productionsetting-<?php echo $item['pid'].'-'.$item['sizeid'] ?>"> <?php echo $item['qty'];?> </span>
                                            <a class="btn btn-danger btn-sm btnrightalign" onclick="posupdatecart('<?php echo $item['rowid']?>',<?php echo $item['pid']?>,<?php echo $item['sizeid']?>,<?php echo $item['qty'];?>,'del')"><i class="fa fa-minus" aria-hidden="true"></i></a>
                                            </td>
                                            <td width="">
                                             <?php echo number_format($itemprice-$mypdiscount, 2,'.',',');?>
                                            </td>
                                            
                                            <td width:"80"=""><a class="btn btn-danger btn-sm btnrightalign" onclick="removecart('<?php echo $item['rowid'];?>')"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                        <?php } 
									$itemtotal=$subtotal;
										if($settinginfo->vat>0){
										$calvat=$itemtotal*$settinginfo->vat/100;
									}
									else{
										$calvat=$pvat;
										}
									$grtotal=$itemtotal;
									?>
                                        
                                    <input name="grandtotal" id="grtotal" type="hidden" value="<?php echo $grtotal-$pdiscount;?>" />
                                   
                                    </tbody>
                                </table>
<?php }  
if(!empty($this->cart->contents())){
	if($settinginfo->service_chargeType==1){
	  $totalsercharge=$subtotal-$pdiscount;
	  $servicetotal=$settinginfo->servicecharge*$totalsercharge/100;
	 }
	 else{
		 $servicetotal=$settinginfo->servicecharge;
		 }
  $servicecharge= $settinginfo->servicecharge;
	}
else{
	$servicetotal=0;
	$servicecharge=0;
	}

?>
<input name="subtotal" id="subtotal" type="hidden" value="<?php echo $subtotal-$pdiscount;?>" />
<input name="totalitem" id="totalitem" type="hidden" value="<?php echo $totalitem;?>" />
<input name="tvat" type="hidden" value="<?php echo $calvat;?>" id="tvat" />
<input name="sc" type="hidden" value="<?php echo $servicecharge;?>" id="sc" />
<input name="tdiscount" type="hidden" value="<?php echo $pdiscount;?>" placeholder="0.00" id="tdiscount" />
<input name="tgtotal" type="hidden" value="<?php echo $calvat+$servicetotal+$itemtotal-$pdiscount;?>" id="tgtotal" />
