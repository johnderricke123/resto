<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="panel panel-default thumbnail"> 

          <div class="panel-body">
            <div class="table_content table_contentpost" >
              <div class="table_content_booking"> <span class="table_booking_header"><?php
                           echo display('cancel')."&nbsp"; echo display('setting'); ?>
             </span>
                <div class="row" id="showcom">
                    <div class="form-group text-right">
             
                      
                  </div>
                   </div>
              <div class="row" id="availabletable">
                       
                <!--  table area -->
                <div class="col-sm-12">

                <table id="cancelLogTable" width="100%" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                          	<th>Date/Time</th>
                            <th><?php echo display('name')?></th>
                            <th>Pincode</th>
                          	<th>Order ID</th>
                            <th><?php echo display('action') ?></th> 
                           
                        </tr>
                    </thead>
                    <tbody>
                      <?php 
                             $sl=0;
                             foreach ($logs as $pc) 
                      {
                        ?>
                        <tr>
                          <td>
                          	<?php  echo date('Y-m-d h:i:s A', strtotime($pc->added_at));?>
                          </td>
                          
                          <td>
                            <?php  echo $pc->name;?>
                          </td>
                          
                          <td>
                          	<?php  echo password_hash($pc->pincode, PASSWORD_BCRYPT);?>
                          </td>
                          	
                          <td>
                          	<?php  echo $pc->order_id;?>
                          </td>
                          
                          
                            <td class="center">
                                    
                                 
                                        <a href="<?php echo site_url('/ordermanage/order/orderdetails/'.$pc->order_id)?>" class="btn btn-info btn-sm" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a> 
                                         
                                    </td>
                        </tr>
                      
                      
                        <?php
                                   $sl++;
                           }
                      
                      ?>
                        
                    </tbody>
                </table>  <!-- /.table-responsive -->
                
                
            </div>
          </div>
                
              </div>
            </div>
            </div>
        </div>
    </div>
</div>

<!--Newly Added-->

<!--Newly Added-->


     <script type="text/javascript">
    $(function() {
        
        	var address = "Upper Lukewright, Dumaguete City, Negros Oriental 6200, Philippines";
        	var date = "01-Dec-2023 to 21-Dec-2023";
		

        $('#cancelLogTable').dataTable({

            dom: 'lBfrtip',
            buttons: [
                { extend: 'print', footer: true,
                    title: '<small>Cash Register Report '+date+'</small>',

                 exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                }
                }
            ],
          
            language: {
                buttons: {
                    print: 'Print',
                    copy: 'Copy',
                    colvis: 'Column Visibility',
                  exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                }
                } //buttons
            }, //language
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
          "order": [[0, 'desc']]
        });

    });
       
       
       
       
       
        function savedata(id = null){
          //console.log('test');
      var rate=$("#commission").val();
      var position=$("#poslist").val();
     
      if(id == null){
      var url = "<?php echo base_url()?>setting/Commissionsetting/del_pin/"
      }
      else{
         var url = "<?php echo base_url()?>setting/Commissionsetting/del_pin/"+id;

      }
      var errormessage = '';

        if(errormessage==''){
           var dataString = 'rate='+rate+'&position='+position;
              
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: dataString,
                        success: function(data){
                          if(data == 'insert'){
                            window.location.reload();
                          }
                        }
                    });
              
            
            }
        
      
    }



     </script>

