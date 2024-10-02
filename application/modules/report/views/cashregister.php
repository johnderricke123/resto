<script type="text/javascript">
function printDiv(divName) {
   
  $(".dataTables_filter, .dataTables_info, .dataTables_paginate").attr('style','display: none;');
  $(".dt-buttons").attr('style','display: none;');
   
  
  var printContents = document.getElementById(divName).innerHTML;
  var originalContents = document.body.innerHTML;
  
  printContents.innerHTML ='<style>@media print {div.dataTables_filter{visibility: hidden;display: none!important;}}</style>';
  
   w = window.open();
   w.document.write(printContents);
  w.document.close(); // necessary for IE >= 10
        w.focus(); // necessary for IE >= 10

        setTimeout(function () { // necessary for Chrome
            w.print();
            w.close();
          $(".dataTables_filter").attr('style','display: unset;');
          $(".dt-buttons").attr('style','display: unset;');
        }, 60);

        return true;
}

function getreportcash(){
  
	var from_date=$('#from_date').val();
	var to_date=$('#to_date').val();
	var user = $('#user').val();
	var counterno = $('#counterno').val();
	
	if(from_date!=''){
		 if(to_date==''){
			alert("Please select To date");
			return false;
		 }
		}
		if(to_date!=''){
			if(from_date==''){
				alert("Please select From date");
				return false;
			}
		}
	if(from_date=='' && to_date=='' && user=='' && counterno==''){
		alert("Please select at least one fields");
		return false;
		}
	var myurl = baseurl+'report/reports/getcashregister';
	    var dataString = "from_date="+from_date+'&to_date='+to_date+'&user='+user+'&counter='+counterno;
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
            {extend: 'pdf', title: 'Report', className: 'btn-sm',footer: true,customize: function (doc) {
    					doc.defaultStyle.alignment = 'center';
						doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');}}, 
            {extend: 'print', className: 'btn-sm',footer: true},
			{extend: 'colvis', className: 'btn-sm',footer: true}  
        ],
		"searching": true,
		  "processing": true,
		
    		}); 
		 } 
		});
		 } 
	function detailscash(startdate,enddate,uid){
      var myurl=baseurl+'report/reports/getcashregisterorder';
		 var dataString = "startdate="+startdate+'&enddate='+enddate+'&uid='+uid;
		  $.ajax({
		 	 type: "POST",
			 url: myurl,
			 data: dataString,
			 success: function(data) {
				 $('.orddetailspop').html(data);
				 $('#orderdetailsp').modal('show');
				 $('#billorder').DataTable({ 
        responsive: true, 
        paging: true,
		"searching": false,
        dom: 'Bfrtip', 
        "lengthMenu": [[ 25, 50, 100, 150, 200, 500, -1], [ 25, 50, 100, 150, 200, 500, "All"]], 
        buttons: [  
            {extend: 'csv', title: 'Report', className: 'btn-sm',footer: true}, 
            {extend: 'excel', title: 'Report', className: 'btn-sm', title: 'exportTitle',footer: true}, 
            {extend: 'pdf', title: 'Report', className: 'btn-sm',footer: true,customize: function (doc) {
    					doc.defaultStyle.alignment = 'center';
						doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');}},
            { customize: function ( win ) {
                    
                    $(win.document.body).find( 'table' )
                        .addClass( 'compact' )
                        .css( 'font-size', 'inherit' );
                }
          }
            
        ],
		  "processing": true,
    		});
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
          table {
            border: 1px solid #000;
          }
          
  body {
    margin: 0;
    color: #000;
    background-color: #fff;
  }
        }
    </style>
<div id="orderdetailsp" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <strong>
        <?php //echo display('unit_update');?>
        </strong> </div>
      <div class="modal-body orddetailspop"> </div>
    </div>
    <div class="modal-footer"> </div>
  </div>
</div>
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
		                <?php date_default_timezone_set("Asia/Dhaka"); $today = date('Y-m-d'); 
		               
							$start_date = date();?>
		                    <div class="form-group">
		                        <label class="" for="from_date"><?php echo display('start_date') ?></label>
		                       
		                        <input type="text" name="from_date" value="<?php echo $today?>" class="form-control datepicker5" id="from_date" placeholder="<?php echo display('start_date') ?>" readonly="readonly" >
		                    </div> 

		                    <div class="form-group">
		                        <label class="" for="to_date"><?php echo display('end_date') ?></label>
		                        <input type="text" name="to_date" class="form-control datepicker5" id="to_date" placeholder="<?php echo "To"; ?>" value="<?php echo $today?>" readonly="readonly">
		                    </div>
                            <?php if(!empty($alluser)){?> 
                            <div class="form-group">
		                    	 <?php echo form_dropdown('user',$alluser,'','class="postform resizeselect form-control " id="user"') ?>
		                    </div> 
		                   <?php } ?> 
                           <?php if(!empty($allcounter)){?> 
                            <div class="form-group">
		                    	 <?php echo form_dropdown('counterno',$allcounter,'','class="postform resizeselect form-control " id="counterno"') ?>
		                    </div> 
		                   <?php } ?> 
		                  <!--   <div class="form-group">
                            	 <label class="" for="orderid"></label>
		                    	 <input type="text" name="orderid" class="form-control" id="orderid" placeholder="" value="">
		                    </div>  -->
		                   
		                    <a  class="btn btn-success" onclick="getreportcash()"><?php echo display('search') ?></a>
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
		                    <h4><?php echo display('table'); ?></h4>
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

<script>
$(document).ready(function () {
    
    var dbDate = "<?php date('Y-m-d', strtotime('first day of this month'));?>";
    var date2 = new Date(dbDate);

    $(".datepicker5").datepicker({
        dateFormat: 'yy-mm-dd'
    }).datepicker('setDate', date2)


});

</script>