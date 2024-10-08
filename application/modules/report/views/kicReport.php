<script type="text/javascript">
function printDiv(divName) {
  
  $(".dataTables_filter, .dataTables_info, .dataTables_paginate").attr('style','display: none;');
  $(".dt-buttons").attr('style','display: none;');
   
  
  var printContents = document.getElementById(divName).innerHTML;
  var originalContents = document.body.innerHTML;
  
  printContents.innerHTML ='@media print {div.dataTables_filter{visibility: hidden;display: none!important;}}';
  
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
	var kitchen_id = $('#kitchen').val();

	if(from_date==''){
		alert("Please select from date");
		return false;
		}
	
		if(to_date==''){
		alert("Please select To date");
		return false;
		}
	var myurl =baseurl+'report/reports/<?php echo $view;?>';
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
            {extend: 'csv', title: 'Report', className: 'btn-sm',footer: true,exportOptions: {columns: ':visible'}}, 
            {extend: 'excel', title: 'Report', className: 'btn-sm', title: 'exportTitle',footer: true,exportOptions: {columns: ':visible'}}, 
            {extend: 'pdf', title: 'Report', className: 'btn-sm',footer: true,exportOptions: {columns: ':visible'}}, 
            {extend: 'print', className: 'btn-sm',footer: true,exportOptions: {columns: ':visible'}},
			{extend: 'colvis', className: 'btn-sm',footer: true}  
        ],
		"searching": true,
		  "processing": true,
		
    		});
		 } 
	});
	}
function generatereport(){
	var from_date=$('#from_date').val();
	var to_date=$('#to_date').val();
	if(from_date==''){
		alert("Please select from date");
		return false;
		}
	if(to_date==''){
		alert("Please select To date");
		return false;
		}
	var myurl =baseurl+'report/reports/generaterpt';
	    var dataString = "from_date="+from_date+'&to_date='+to_date;
		 $.ajax({
		 type: "POST",
		 url: myurl,
		 data: dataString,
		 success: function(data) {
			$('#getresult2').html(data);
		 } 
	});
	}
</script>
<style type="text/css">
        @media print {
            a[href]:after {
                content: none !important;
            }          
          
              div.dataTables_filter, .dt-buttons{
              visibility: hidden;
              display: none!important;
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
		                <?php date_default_timezone_set("Asia/Dhaka"); $today = date('m-d-Y'); ?>
		                    <div class="form-group">
		                        <label class="" for="from_date"><?php echo display('start_date') ?></label>
		                        <input type="text" name="from_date" class="form-control datepicker" id="from_date" placeholder="<?php echo display('start_date') ?>" value="<?php echo $today?>" readonly="readonly" >
		                    </div> 

		                    <div class="form-group">
		                        <label class="" for="to_date"><?php echo display('end_date') ?></label>
		                        <input type="text" name="to_date" class="form-control datepicker" id="to_date" placeholder="<?php echo "To"; ?>" value="<?php echo $today?>" readonly="readonly">
		                    </div> 
		                   
		                   
		                    <a  class="btn btn-success" onclick="getreport()"><?php echo display('search') ?></a>
                            <!--<a  class="btn btn-success" onclick="generatereport()"><?php //echo "Report Generate"; ?></a>-->
		                    <a  class="btn btn-warning" href="#" onclick="printDiv('purchase_div')"><?php echo "Print"; ?></a>
		                   </div>
		                  
 							
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
		                    <h4><?php echo display('sell_report') ?></h4>
		                </div>
		            </div>
		            <div class="panel-body">
		            	<div id="purchase_div" style="margin-left:2px;">
			            	<div class="text-center">
								<h3> <?php echo $setting->storename;?> </h3>
								<h4><?php echo $setting->address;?> </h4>
								<h4> <?php echo "Print Date" ?>: <?php echo date("M d, Y h:ia"); ?> </h4>
							</div>
			                <div class="table-responsive" id="getresult2">
			                    
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

<script type="text/javascript">
	$(document).ready(function(){
		getreport();

});
</script>