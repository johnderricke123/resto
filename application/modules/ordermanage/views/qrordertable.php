<table class="table table-fixed table-bordered table-hover bg-white" id="allqrorder" style="width:100%;">
                                    <thead>
                                         <tr>
                                               <th class="text-center"><?php echo display('sl');?>. </th>
                                                <th class="text-center"><?php echo display('invoice');?> </th>
                                                <th class="text-center"><?php echo display('customer_name');?></th>
                                                <th class="text-center"><?php echo display('customer_type');?></th> 
                                                <th class="text-center"><?php echo display('waiter');?></th> 
                                                <th class="text-center"><?php echo display('tabltno');?></th> 
                                                <th class="text-center"><?php echo display('payment_status');?></th>  
                                                <th class="text-center"><?php echo display('ordate');?></th>
                                                <th class="text-right"><?php echo display('amount');?></th>
                                                <th class="text-center"><?php echo display('action');?></th>  
                                            </tr>
                                    </thead>
                                    <tbody>
                                    
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="8" style="text-align:right"><?php echo display('total');?>:</th>
                                            <th colspan="2" style="text-align:center"></th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <script type="text/javascript">
                                    $(document).ready(function () {
        
                                   var qroredrlist=$('#allqrorder').DataTable({ 
        responsive: true, 
        paging: true,
		"language": {
        "sProcessing":     "<?php echo display('Processingod') ?>",
        "sSearch":         "<?php echo display('search') ?>:",
        "sLengthMenu":     "<?php echo display('sLengthMenu') ?>",
        "sInfo":           "<?php echo display('sInfo') ?>",
        "sInfoEmpty":      "<?php echo display('sInfoEmpty') ?>",
        "sInfoFiltered":   "<?php echo display('sInfoFiltered') ?>",
        "sInfoPostFix":    "",
        "sLoadingRecords": "<?php echo display('sLoadingRecords') ?>",
        "sZeroRecords":    "<?php echo display('sZeroRecords') ?>",
        "sEmptyTable":     "<?php echo display('sEmptyTable') ?>",
        "oPaginate": {
            "sFirst":      "<?php echo display('sFirst') ?>",
            "sPrevious":   "<?php echo display('sPrevious') ?>",
            "sNext":       "<?php echo display('sNext') ?>",
            "sLast":       "<?php echo display('sLast') ?>"
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
        "createdRow": function ( row, data, index ) {
                       // $('td', row).eq(10).addClass("hidetd");
						if( data[10] == 1 ){
                                $(row).css('background-color', '#e5cc34c4');
                            }
						else{
                                $(row).css('background-color', '#ffffff');
                            }
                    },
        "lengthMenu": [[ 25, 50, 100, 150, 200, 500, -1], [ 25, 50, 100, 150, 200, 500, "All"]], 
        buttons: [  
            {extend: 'copy', className: 'btn-sm',footer: true}, 
            {extend: 'csv', title: 'ExampleFile', className: 'btn-sm',footer: true}, 
            {extend: 'excel', title: 'ExampleFile', className: 'btn-sm', title: 'exportTitle',footer: true}, 
            {extend: 'pdf', title: 'ExampleFile', className: 'btn-sm',footer: true}, 
            {extend: 'print', className: 'btn-sm',footer: true},
			{extend: 'colvis', className: 'btn-sm',footer: true}  
        ],
		"searching": true,
		  "processing": true,
				 "serverSide": true,
				 "ajax":{
					url :"<?php echo base_url()?>ordermanage/order/allqrorder", // json datasource
					type: "post"  // type of method  ,GET/POST/DELETE
				  },
	    "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 8 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 8, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 			var pageTotal = pageTotal.toFixed(2); 
 			var total = total.toFixed(2); 
            // Update footer
            $( api.column( 8 ).footer() ).html(
                pageTotal +' ( '+ total +' total)'
            );
        }
    		});
			load_unseen_notification(); 
                                    });
                                </script>