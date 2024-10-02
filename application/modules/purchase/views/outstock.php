<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script type="text/javascript">
function printDiv() {
    var divName = "printArea";
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    // document.body.style.marginTop="-45px";
    window.print();
    document.body.innerHTML = originalContents;
}
</script>
<div class="row">
        <div class="col-sm-12 col-md-12">
           <div class="panel panel-bd lobidrag">
          
            <div class="form-group text-right">
 <?php if($this->permission->method('purchase','create')->access()): ?>
<a href="<?php echo base_url("purchase/purchase/create")?>" class="btn btn-primary btn-md"><i class="fa fa-plus-circle" aria-hidden="true"></i>
<?php echo display('purchase_add')?></a> 
<?php endif; ?>

</div> 
        
             
        <?php foreach ($purchase_details as $detail): ?>
        <tr>
            <td><?php echo $detail->purchaseid; ?></td>
            <td><?php echo $detail->purchasedate; ?></td>
            <td><?php echo $detail->purchase_unit; ?></td>
        </tr>
        <?php endforeach; ?>
             
             
             
            <div class="panel-body" id="printArea">
            <div class="text-center">
								<h3> <?php echo $setting->storename;?> </h3>
								
							</div>
             <table width="100%" class="datatable2 table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th><?php echo display('ingredients') ?></th>
                                        <th>Qty Purchase </th>
                                        <th>Purchase Unit </th>
                                        <th>Qty. Ingredient</th>
                                 
                                    </tr>
                                </thead>
                                <tbody id="addinvoiceItem">
                                    <?php 
                                    $sl=1;
                                    foreach ($outstock as $details) {?>
                                      
                                   
                                    <tr>
                                        <td ><?php echo $details->ingredient_name; ?></td>
                                        <td ><?php echo $details->qty_unit; ?></td>
                                        <td><?php
												echo $details->uom_name;
                                                                     echo $details->uom_id;
                                                                     
                                             ?></td>

                                        <td><?php echo $details->stock_qty; ?></td>
                                        
                                        
                                      
                                      <!-- <td ><?php echo $details->id; ?></td> -->
                                      
                                      
                                    </tr>                              
                                <?php $sl++; } 
                                 ?>
                                </tbody>                               
                               
                            </table>
            </div> 
             <div class="text-center" id="print" style="margin: 20px">
                <input type="button" class="btn btn-warning" name="btnPrint" id="btnPrint" value="Print" onclick="printDiv();"/>
                
            </div>
        </div> 
        </div>
    </div>

