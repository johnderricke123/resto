<script type="text/javascript">
  
function printDiv(divName) {
  
  $(".dataTables_filter, .dataTables_info, .dataTables_paginate").attr('style','display: none;');
  $(".dt-buttons").attr('style','display: none;');
   
  
  var printContents = document.getElementById(divName).innerHTML;
  var originalContents = document.body.innerHTML;
  
  printContents.innerHTML ='@media print {table {border:1px solid #ccc; }div.dataTables_filter{visibility: hidden;display: none!important;}}';
  
   w = window.open();
   w.document.write(printContents);
  w.document.close(); // necessary for IE >= 10
        w.focus(); // necessary for IE >= 10

        setTimeout(function () { // necessary for Chrome
            w.print();
            w.close();
          $(".dataTables_filter").attr('style','display: unset;');
          
        }, 60);

        return true;
}

  
  
function getreport(){
	var from_date=$('#from_date').val();
	var to_date=$('#to_date').val();

	//from_date = new Date(from_date).toISOString().slice(0, 19).replace('T', ' ');
   // to_date = new Date(to_date).toISOString().slice(0, 19).replace('T', ' ');
 
	if(from_date==''){
		alert("Please select from date");
		return false;
		}
	if(to_date==''){
		alert("Please select To date");
		return false;
		}
	var myurl =baseurl+'report/reports/purchasereport';
	    var dataString = "from_date="+from_date+'&to_date='+to_date;
		 $.ajax({
		 type: "POST",
		 url: myurl,
		 data: dataString,
		 success: function(data) {
			 $('#getresult2').html(data);
			 $('#respritbl').DataTable({ 
        responsive: true, 
        paging: true,
        dom: 'Bfrtip', 
        "lengthMenu": [[ 25, 50, 100, 150, 200, 500, -1], [ 25, 50, 100, 150, 200, 500, "All"]], 
        buttons: [  
            {extend: 'copy', className: 'btn-sm',footer: true}, 
            {extend: 'csv', title: 'Report', className: 'btn-sm',footer: true}, 
            {extend: 'excel', title: 'Report', className: 'btn-sm', title: 'exportTitle',footer: true}, 
            {extend: 'pdf', title: 'Report', className: 'btn-sm',footer: true}, 
            {extend: 'print', className: 'btn-sm',footer: true,
                messageTop: 'DCCCO Hotel'

            },
			{extend: 'colvis', className: 'btn-sm',footer: true}  
        ],
		"searching": true,
		  "processing": true,
		
    		});
		 } 
	});
	}
</script>
<style>
  
@media print {

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
<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body">
                    <fieldset class="border p-2">
                       <legend  class="w-auto"><?php echo $title; ?></legend>
                    </fieldset>
                    <div class="row">
			<div class="col-sm-12">
		        <div class="panel panel-default">
		            <div class="panel-body"> 
		                <?php echo form_open('report/index',array('class' => 'form-inline'))?>
		                <?php date_default_timezone_set("Asia/Manila"); $today = date('m-d-Y'); ?>
		                    <div class="form-group">
		                        <label class="" for="from_date"><?php echo display('start_date') ?></label>
		                        <input type="text" name="from_date" class="form-control datepicker" id="from_date" placeholder="<?php echo display('start_date') ?>" readonly="readonly" value="<?php echo $today; ?>" >
		                    </div> 

		                    <div class="form-group">
		                        <label class="" for="to_date"><?php echo display('end_date') ?></label>
		                        <input type="text" name="to_date" class="form-control datepicker" id="to_date" placeholder="<?php echo "To"; ?>" value="<?php echo $today?>" readonly="readonly">
		                    </div>  
 							<a  class="btn btn-success" onclick="getreport()"><?php echo display('search') ?></a>
		                    <a  class="btn btn-warning" href="#" onclick="printDiv('purchase_div')"><?php echo "Print"; ?></a>
		               <?php echo form_close()?>
		            </div>
		        </div>
		    </div>
	    </div>
					<div class="row">
		    <div class="col-sm-12">
		        <div class="panel panel-bd lobidrag">
		            <div class="panel-heading">
		                <div class="panel-title">
		                    <h4><?php echo display('purchase_report') ?></h4>
		                </div>
		            </div>
		            <div class="panel-body">
		            	<div id="purchase_div" style="margin-left:2px;">
			            	<div class="text-center">
								<h3> <?php echo $setting->storename;?> </h3>
								<h4 ><?php echo $setting->address;?> </h4>
								<p> <?php echo "Print Date" ?>: <?php echo date("M d, Y h:ia"); ?> </p>
							</div>
			                <div class="table-responsive" id="getresult2">
			                    <table class="table table-bordered table-striped table-hover" id="respritbl"  style="border-width: 1px !important;
                border-style: solid !important;
                border-color: black !important;
                -webkit-print-color-adjust:exact ;
             ">
			                        <thead>
										<tr>
											<th><?php echo "Purchase Date"; ?></th>
											<th><?php echo "Invoice no."; ?></th>
											<th><?php echo display('supplier_name') ?></th>
											<th><?php echo display('total_ammount') ?></th>
										</tr>
									</thead>
									<tbody>
									<?php 
									$totalprice=0;
									if($preport) { 
									foreach($preport as $pitem){
										$totalprice=$totalprice+$pitem->total_price;
									?>
											<tr>
												<td><?php $originalDate = $pitem->purchasedate;
									echo $newDate = date("d-M-Y", strtotime($originalDate));
									 ?></td>
												<td>
													<?php echo $pitem->invoiceid;?>
												</td>
												<td><?php echo $pitem->supName;?></td>
												<td style="text-align: right;"><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $pitem->total_price;?> <?php if($currency->position==2){echo $currency->curr_icon;}?></td>
											</tr>
									<?php } 
									}
									?>
									</tbody>
									<tfoot>
										<tr>
											<td colspan="3" align="right" style="text-align:right;font-size:14px !Important">&nbsp; <b><?php echo display('total_purchase') ?> </b></td>
											<td style="text-align: right;"><b><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $totalprice;?> <?php if($currency->position==2){echo $currency->curr_icon;}?></b></td>
										</tr>
									</tfoot>
			                    </table>
			                </div>
			            </div>
			            <div class="text-right">
			            </div>
		            </div>
		        </div>
		    </div>
		</div>
                </div> 
            </div>
        </div>
    </div>
