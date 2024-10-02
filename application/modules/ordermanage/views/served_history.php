<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->

<!--<h1>
  Served History
</h1>

<div class="row">
  <div class="col">col</div>
  <div class="col">col</div>
  <div class="col">col</div>
  <div class="col">col</div>
</div>
<div class="row">
  <div class="col-8">col-8</div>
  <div class="col-4">col-4</div>
</div>
-->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script> -->




<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body">
                    <fieldset class="border p-2">
                       <legend  class="w-auto"><?php echo $title; ?></legend>
                    </fieldset>
					<div class="row">
                             <div class="col-sm-12" id="findfood">
                                <table class="table datatable table-fixed table-bordered table-hover bg-white" id="test">
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
                                        <!-- <td class="text-center"><?php echo $item->customer_name;?></td>-->
                                      <td class="text-center"><?php echo $item->hotel_customer;?></td>
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

