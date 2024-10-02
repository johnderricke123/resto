<style>
.grid-container {
  display: grid; 
  grid-template-columns: auto auto auto auto;
   background-color: #FFFFFF;
  padding-bottom: 60px;
  border-style: none;
}
  .grid-label {
  display: grid; 
  grid-template-columns: auto auto auto auto;
   background-color: #FFFFFF;
   padding-bottom: 20px;
  border-style: none;
}
input {
  background-color: #FFFFFF;
  border: 1px;  
  padding: 10px;
  font-size: 10px;
  text-align: center;
  border-style: none;
}
  
</style>
<?php
 //var_dump($itemdata);
?>
<?php if($title == "Cancel Order"){ ?>
	<form method="post" action="<?php echo site_url('ordermanage/order/cancellist'); ?>">
<?php } ?>
  
<?php if($title == "Complete Order"){ ?>
	<form method="post" action="<?php echo site_url('ordermanage/order/completelist'); ?>">  
<?php } ?>

      <?php if($title !== "Pending Order"){ ?>
  
    <div class="grid-label">
    
        <div class="grid">
          <label for="start_date"> Start Date
          </label>

        </div>
	
    
        <div class="grid">
          <label for="end_date"> End Date
          </label>

                    
        </div>
    <div class="grid">
      <!--<button type="submit" class="form-control" id="buttonSub">
      </button>-->
    </div>
  </div>

  
  <div class="grid-container">
    
        <div class="grid">
          <!--<label for="start_date"> Start Date
          </label>-->
            <input type="date" value="<?php echo $start_date; ?>" class="form-control" name="start_date" />
        </div>
	
    
        <div class="grid">
          <!--<label for="end_date"> End Date
          </label>-->
            <input type="date" value="<?php echo $end_date; ?>" class="form-control" name="end_date" />
                    
        </div>
    <div class="grid">
      <button type="submit" class="btn btn-primary btn-md" id="buttonSub"> Submit
      </button>
    </div>
  </div>

</form>
      <?php } ?>


<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body">
                    <fieldset class="border p-2">
                       <legend  class="w-auto"><?php echo $title; ?></legend>
                    </fieldset>
					<div class="row">
                             <div class="col-sm-12" id="findfood">
                                <table class="table datatable table-fixed table-bordered table-hover bg-white" id="purchaseTable">
                                <thead>
                                     <tr>
                                            <th class="text-center"><?php echo display('sl')?> </th>
                                            <th class="text-center"><?php echo display('orderid')?> </th>
                                            <th class="text-center"><?php echo display('customer_name');?></th>
                                            <th class="text-center"><?php echo display('customer_type');?></th> 
                                            <th class="text-center"><?php echo display('waiter');?></th> 
                                            <th class="text-center"><?php echo display('table');?></th>
                                            <th class="text-center"><?php echo display('ordate');?></th>
                                            <th class="text-right"><?php echo display('amount');?></th>
                                            <th class="text-center"><?php echo display('action');?></th> 
                                        </tr>
                                </thead>
                                <tbody>
                                <?php $i=0;
								foreach($iteminfo as $item){
									$i++;
									?>
                                	<tr>
                                    	<td class="text-center"><?php echo $pagenum+$i;?></td>
                                        <td class="text-center"><?php echo $item->order_id;?></td>
                                        <td class="text-center"><?php echo $item->customer_name;?></td>
                                        <td class="text-center"><?php echo $item->customer_type;?></td>
                                        <td class="text-center"><?php echo $item->first_name.' '.$item->last_name;?></td>
                                        <td class="text-center"><?php echo $item->tablename;?></td>
                                         <td class="text-center"><?php $originalDate = $item->order_date;
											echo $newDate = date("d-M-Y", strtotime($originalDate));?></td>
                                        <td class="text-right"><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $item->totalamount;?> <?php if($currency->position==2){echo $currency->curr_icon;}?> </td>
                                    	<td class="text-center">
                                         <?php if($this->permission->method('ordermanage','update')->access()): ?>
                                        <a href="<?php echo base_url("ordermanage/order/orderdetails/$item->order_id") ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Details"><i class="fa fa-eye" aria-hidden="true"></i></a> 
                                         <?php endif; ?>
                                         <a href="<?php echo base_url("ordermanage/order/posorderinvoice/$item->order_id") ?>" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="left" title="" data-original-title="Invoice"><i class="fa fa-window-restore" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                                <tfoot>
                                    
                                </tfoot>
                            </table>
                            <div class="text-right"><?php //echo @$links?></div>
                            </div>
                        </div>
                </div> 
            </div>
        </div>
    </div>

<script>
  
$('#purchaseTable').dataTable( {
    "order": [[ 0, 'desc' ], [ 1, 'desc' ]]
} );
  
	 $(document).ready(function () {
        $('.start-date').datepicker({
            dateFormat: 'yy-mm-dd', 
            showButtonPanel: true,  
            onClose: function (selectedDate) {
              
                $('.end-date').datepicker('option', 'minDate', selectedDate);
            }
        });

        
        $('.end-date').datepicker({
            dateFormat: 'yy-mm-dd', 
            showButtonPanel: true,  
            onClose: function (selectedDate) {
                
                $('.start-date').datepicker('option', 'maxDate', selectedDate);
            }
        });
    });


</script>
