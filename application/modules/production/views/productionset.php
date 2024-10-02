<!-- work of this file -->
<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body">
                   
                    <fieldset class="border p-2">
                       <legend  class="w-auto"><?php echo "Production Set" ?></legend>
                    </fieldset>
                    <div class="row">
                             <div class="col-sm-8">
                               <div class="form-group row">
                                    <div class="col-sm-10">
                                     <strong><?php echo "Production Set For: " ?></strong> <?php echo $productioninfo->ProductName;?>
                                    </div>
                                </div> 
                            </div>
                             
                        </div>
                     <table class="table table-bordered table-hover" id="purchaseTable">
                                <thead>
                                     <tr>
                                            <th class="text-center">Item Information<i class="text-danger">*</i></th> 
                                            <th class="text-center">Qnty</th>
                                             <th class="text-center">Cost <?php echo display('price');?></th>
                                        </tr>
                                </thead>
                                <tbody id="addPurchaseItem">
                                <?php $i=0;
                                $totalcost=0;
								foreach($iteminfo as $item){
									$i++;
                                   // $totalcost = $item->uprice*$item->qty+$totalcost;
                                  $totalcost = $totalcost + $item->total_price;
									?>
                                    <tr>
                                        <td class="text-center"><?php echo $item->ingredient_name;?></td>
                                            <td class="text-right"><?php echo $item->qty." ".$item->uom_short_code;?></td>
                                      <td class="text-right"><?php echo number_format($item->total_price,2);?></td>
                                        <!--    <td class="text-right"><?php //echo number_format($item->uprice*$item->qty,2);?></td>-->
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                        <tr>
                                            <td colspan="2" align="right" style="text-align:right;font-size:14px !Important">&nbsp; <b><?php echo display('total');?> </b></td>
                                            <td style="text-align: right;"><b><?php echo $totalcost; //total?> </b></td>
                                        </tr>
                                    </tfoot>
                                
                            </table>
                     
                </div> 
            </div>
        </div>
    </div>
