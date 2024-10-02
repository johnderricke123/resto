<div id="cancelord" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <strong>Order Cancel</strong>
            </div>
            <div class="modal-body">
            	<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
                <div class="panel-body">
                        <div class="form-group row">
                            <label for="payments" class="col-sm-4 col-form-label">Order ID </label>
                            <div class="col-sm-7 customesl">
                            	<span id="canordid"></span>
                                <input name="mycanorder" id="mycanorder" type="hidden" value=""  />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="canreason" class="col-sm-4 col-form-label">Cancel Reason</label>
                            <div class="col-sm-7 customesl">
                            	  <textarea name="canreason" id="canreason" cols="35" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group text-right">
                        	<div class="col-sm-11" style="padding-right:0;">
                            <button type="button" class="btn btn-success w-md m-b-5" id="cancelreason">Submit</button>
                            </div>
                        </div>
                </div>  
            </div>
        </div>
    </div>
    		</div>
     
            </div>
        </div>

    </div>
 <div id="payprint_marge" class="modal fade  bd-example-modal-lg" role="dialog">
    <div class="modal-dialog modal-lg" id="modal-ajaxview">
 
        </div>

    </div>

<!-- newly added -->
<!--<style>
		button{
          float:right;
          margin-right: 5px;
        }
</style>
				<div class="row">
                    <div class="col">
                      <form method="post" action="<?php echo site_url('ordermanage/order/orderlist'); ?>">
                        <input type="hidden" value="1" name="userClick"/>
                          <button type="submit" class="btn btn-primary float-right">
                            Ongoing Orders
                          </button>  
                      </form>

                  </div>
                    <div class="col">
                      
                      
                      <form method="post" action="<?php echo site_url('ordermanage/order/servedHistory'); ?>">

                        <input type="hidden" value="4" name="userClick"/>
                        <button type="submit" class="btn btn-primary float-right">
                          Served History
                        </button>  
                      </form>

                    </div>

                  </div>

-->	
<!-- newly added -->                  


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
<form method="post" action="<?php echo site_url('ordermanage/order/orderlist'); ?>">

  
  
  
  
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


<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body">
                    <fieldset class="border p-2">
                       <legend  class="w-auto"><?php echo $title; ?></legend>
                    </fieldset>
                  
                  
					<div class="row">
                             <div class="col-sm-12" id="findfood">
                                <table class="table table-fixed table-bordered table-hover bg-white" id="tallorder" style="width:100%;">
                                <thead>
                                     <tr>
                                            <th class="text-center"><?php echo display('sl')?> </th>
                                            <th class="text-center"><?php echo display('invoice_no');?></th>
                                            <th class="text-center">Customer</th>
                                            <th class="text-center"><?php echo display('waiter');?></th> 
                                            <th class="text-center"><?php echo display('table');?></th>
                                            <th class="text-center"><?php echo display('state');?></th> 
                                       		<th class="text-center">Order Date</th> 
                                            <th class="text-left">Payment Method</th>
                                            <th class="text-right"><?php echo display('amount');?></th> 
                                            <th class="text-center"><?php echo display('action');?></th>
                                        </tr>
                                </thead>
                                <tbody>
									<?php $i = 1;
									foreach($itemdata as $item){ ?>
                                      <tr>
                                        <td>
                                          <?php echo $i; ?>
                                        </td>
                                        <td>
                                          <?php echo $item->order_id; ?>
                                        </td>
                                        <td>
                                          <?php

                                                                      if($item->cutomertype == 1 || $item->cutomertype == 0){
                                                                        
                                                                        //echo "Walk In";
                                                                        echo $item->customer_name;
                                                                        
                                                                      }if($item->cutomertype == 21){
                                                                        echo "Active Hotel Guest";
                                                                      }if($item->cutomertype == 22){
                                                                        echo "Banquet - Hotel Guest";
                                                                      }if($item->cutomertype == 23){
                                                                        echo "Banquet Customer";
                                                                      }else{
	                                                                    echo $item->hotel_customer;  
                                                                      }
                                                                       ?>
                                        </td>
                                        <td>
                                          <?php echo $item->fullname; ?>
                                        </td>
                                        <td>
                                          <?php echo $item->tablename; ?>
                                        </td>
                                        <td>
                                          <?php
                                                                      if($item->order_status == 1){
                                                                       echo "Pending"; 
                                                                      }if($item->order_status == 2){
                                                                        echo "Processing";
                                                                      }if($item->order_status == 3){
                                                                        echo "Ready";
                                                                      }if($item->order_status == 4){
                                                                        echo "Served";
                                                                      }if($item->order_status == 5){
                                                                        echo "Cancel";
                                                                      }
                                                                      //echo $item->order_status;
                                          ?>
                                        </td>
                                        <td>
                                          <?php echo $item->order_date; ?>
                                        </td>
                                        <td>
                                          <?php echo $item->payment_method; ?>
                                        </td>
                                        <td>
                                          <?php echo $item->totalamount; ?>
                                        </td>
                                        <td>
                                          <?php //echo $item->order_id;
                                          //newly added                                                                
                                          //newly added
                                          ?>
                                          <?php //if($item->splitpay_status ==1){ 
                                                  if(false){ ?>
                                          <a href="javascript:;" onclick="showsplit(<?php echo $item->order_id; ?>)" class="btn btn-xs btn-success btn-sm mr-1" data-toggle="tooltip" data-placement="left" title="Update" id="table-split-<?php echo $item->order_id; ?>">Split</a>
                                          <?php } ?>
                                          <?php //if($item->order_status==1 || $item->order_status==2 || $item->order_status==3 || $item->order_status==4){
                                          if(false){
                                          ?>
                                          <a href="<?php echo site_url('ordermanage/order/otherupdateorder/'.$item->order_id) ?>" class="btn btn-primary btn-sm" title="Edit"><i class="fa fa-pencil"></i></a>
                                          <?php } ?>
                                          
                                          <a href="<?php echo site_url('ordermanage/order/orderdetails/'.$item->order_id); ?>" class="btn btn-success btn-xs" title="View"><i class="fa fa-eye"></i></a>
                                          
                                          <?php if($item->order_status==1 || $item->order_status==2 || $item->order_status==3){ ?>
                                          <a href="javascript:;" onclick="createMargeorder(<?php echo $item->order_id;?>,1)" id="hidecombtn_<?php echo $item->order_id;?>" class="btn btn-xs btn-success btn-sm mr-1" data-toggle="tooltip" data-placement="left" title="" data-original-title="Make Payment"><i class="fa fa-window-restore" aria-hidden="true"></i></a>
                                          <?php } ?>
                                          
                                          <a href="javascript:;" onclick="printPosinvoice(<?php echo $item->order_id; ?>)" class="btn btn-xs btn-success btn-sm mr-1" data-toggle="tooltip" data-placement="left" title="" data-original-title="Pos Invoice"><i 													class="fa fa-window-maximize" aria-hidden="true"></i></a>
                                          
                                        </td>


                                      </tr>
                                  	<?php $i++; } ?>

                                </tbody>
                               
                            </table>
                            <div class="text-right"><?php //echo @$links?></div>
                            </div>
                        </div>
                </div> 
            </div>
        </div>
    </div>
    <div id="payprint_split" class="modal fade  bd-example-modal-lg" role="dialog">
  <div class="modal-dialog modal-lg" id="modal-ajaxview-split"> </div>
</div>


<script>

$(document).ready(function () {
     $('#tallorder').DataTable({ 
        responsive: true, 
        paging: true,
		"language": {
        "sProcessing":     "<?php echo display('Processingod') ?>",
        "sSearch":         "<?php echo display('search') ?>:",
        "sLengthMenu":     "<?php echo display('sLengthMenu') ?>",
        "sInfo":           "<?php echo display('sInfo') ?>",
        "sInfoEmpty":      "<?php echo display('sInfoEmpty') ?>",
        "sInfoFiltered":   "<?php echo display('sInfoFiltered') ?>",
       // "sInfoPostFix":    "",
        "sLoadingRecords": "<?php echo display('sLoadingRecords') ?>",
        "sZeroRecords":    "<?php echo display('sZeroRecords') ?>",
        "sEmptyTable":     "<?php echo display('sEmptyTable') ?>",
		"paginate": {
				"first":      "<?php echo display('sFirst') ?>",
				"last":       "<?php echo display('sLast') ?>",
				"next":       "<?php echo display('sNext') ?>",
				"previous":   "<?php echo display('sPrevious') ?>"
			},
        "oAria": {
            "sSortAscending":  ": <?php echo display('sSortAscending') ?>",
            "sSortDescending": ": <?php echo display('sSortDescending') ?>"
        },
        "select": {
                "rows": {
                    "_": "<?php echo display('_sign') ?>",
                    "0": "<?php echo display('_0sign') ?>",
                    "1": "<?php echo display('_1sign') ?>"
                }
        },
		buttons: {
                copy: '<?php echo display('copy') ?>',
				csv: '<?php echo display('csv') ?>',
				excel: '<?php echo display('excel') ?>',
				pdf: '<?php echo display('pdf') ?>',
				print: '<?php echo display('print') ?>',
				colvis: '<?php echo display('colvis') ?>'
            }
    },
        dom: 'Bfrtip', 
        "lengthMenu": [[ 25, 50, 100, 150, 200, 500, -1], [ 25, 50, 100, 150, 200, 500, "All"]], 
        buttons: [  
            {extend: 'copy', className: 'btn-sm'}, 
            {extend: 'csv', title: 'ExampleFile', className: 'btn-sm',exportOptions: {columns: ':visible'}}, 
            {extend: 'excel', title: 'ExampleFile', className: 'btn-sm', title: 'exportTitle',exportOptions: {columns: ':visible'}}, 
            {extend: 'pdf', title: 'ExampleFile', className: 'btn-sm',exportOptions: {columns: ':visible'}}, 
            {extend: 'print', className: 'btn-sm',exportOptions: {columns: ':visible'}},
			{extend: 'colvis', className: 'btn-sm'}  
			
        ],

/*
		"searching": true,
		  "processing": true,
				 "serverSide": true,
				 "ajax":{
					url :"<?php echo base_url()?>ordermanage/order/allorderlist",
					type: "post",
					//"dataSrc": "account"
				  },
*/
       
    		});
                                });
  
  
  
  function noteCheck(id){
	 var ordstatus=$("#status").val();
	 var myurl ='<?php echo base_url("ordermanage/order/ajaxupdateoreder/") ?>';
	 var dataString = "orderid="+id+"&status="+ordstatus;
	}
 function printRawHtml(view) {
      printJS({
        printable: view,
        type: 'raw-html',
        
      });
    }
function createMargeorder(orderid,value=null){
    var url = '<?php echo base_url()?>ordermanage/order/showpaymentmodal/'+orderid;
    callback = function(a){
        $("#modal-ajaxview").html(a);
        $('#get-order-flag').val('2');
    };
    if(value == null){
       
    getAjaxModal(url);
    }
    else{
        getAjaxModal(url,callback); 
    }
   }
 function submitmultiplepay(){
        var thisForm = $('#paymodal-multiple-form');
        var inputval = parseFloat(0);
        var maintotalamount = $('#due-amount').text();
        var payment_method_id = $('#payment_method_id').val();

        console.log(payment_method_id);
        $(".number").each(function(){
           var inputdata= parseFloat($(this).val());
            inputval = inputval+inputdata;

        });
        if(inputval<parseFloat(maintotalamount) && payment_method_id === 1 ){

                setTimeout(function () {
                    toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 4000

            };
            toastr.error("Pay full amount ", 'Error');
            }, 100);
            return false;
        }

        var formdata = new FormData(thisForm[0]);

        console.log(formdata);
        $.ajax({
        type: "POST",
        url: "<?php echo base_url()?>ordermanage/order/paymultiple",
        data: formdata,
        processData: false,
        contentType: false,
        success:function(data){
            var value = $('#get-order-flag').val();
            if(value === 1){
                setTimeout(function () {
                toastr.options = {
                closeButton: true,
                progressBar: true,
                showMethod: 'slideDown',
                timeOut: 4000
                  
        };
        toastr.success("payment taken successfully", 'Success');
        $('#payprint_marge').modal('hide');
        $(".home").trigger( "click" );


    }, 100); }
                 else{
                    $('#payprint_marge').modal('hide');
					var ordid=$("#get-order-id").val();
                    printRawHtml(data);
                    $("#hidecombtn_"+ordid).hide();
                 }
            
        },
  
    });
    }
 function printPosinvoice(id){
        var url = '<?php echo base_url()?>ordermanage/order/posorderinvoice/'+id;
         $.ajax({
             type: "GET",
             url: url,
             success: function(data) {
              printRawHtml(data);

        }

        });
 }
 function printmergeinvoice(id){
	 var id=atob(id);
        var url = '<?php echo base_url()?>ordermanage/order/checkprint/'+id;
         $.ajax({
             type: "GET",
             url: url,
             success: function(data) {
              printRawHtml(data);

        }

        });
 }
$(document).on('click','#add_new_payment_type',function(){
        var orderid = $('#get-order-id').val();
          var url= 'showpaymentmodal/'+orderid+'/1';
         $.ajax({
             type: "GET",
             url: url,
             success: function(data) {
              $('#add_new_payment').append(data);
              var length = $(".number").length;
              $(".number:eq("+(length-1)+")").val(parseFloat($("#pay-amount").text()));
             
        }

        }); 


        });
$(document).on('click','.close_div',function(){
        
        $(this).parent('div').remove();
        changedueamount();
    }); 
function possubpageprint(orderid){
   
                    $.ajax({
                            type: "GET",
                            url: "<?php echo base_url()?>ordermanage/order/posprintdirectsub/"+orderid,
                          
                            success: function(printdata){                                           
                                 printRawHtml(printdata);
                                }
                                    });
     }
 function showsplit(orderid){
        var url = '<?php echo base_url()?>ordermanage/order/showsplitorderlist/'+orderid;
        getAjaxModal(url,false,'#modal-ajaxview-split','#payprint_split');
    }

  
  
  
  
  $(document).ready(function () {
        // Target the start date input field and apply the datepicker
        $('.start-date').datepicker({
            dateFormat: 'yy-mm-dd', // Set the desired date format
            showButtonPanel: true,   // Show a button panel for easy navigation
            onClose: function (selectedDate) {
                // When the start date is selected, update the minDate option of the end date datepicker
                $('.end-date').datepicker('option', 'minDate', selectedDate);
            }
        });

        // Target the end date input field and apply the datepicker
        $('.end-date').datepicker({
            dateFormat: 'yy-mm-dd', // Set the desired date format
            showButtonPanel: true,   // Show a button panel for easy navigation
            onClose: function (selectedDate) {
                // When the end date is selected, update the maxDate option of the start date datepicker
                $('.start-date').datepicker('option', 'maxDate', selectedDate);
            }
        });
    });

</script>
