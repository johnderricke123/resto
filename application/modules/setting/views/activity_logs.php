<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="panel panel-default thumbnail"> 

          <div class="panel-body">
            <div class="table_content table_contentpost" >
              <div class="table_content_booking"> <span class="table_booking_header"><?php
                           echo display('actvity_logs'); ?>
             </span>
                <div class="row" id="showcom">
                    <div class="form-group text-right">
                      
                  </div>
                   </div>
                
<!-- DATE PICKER -->
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

            <form method="post" action="<?php echo site_url('setting/serversetting/logs'); ?>">
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
              </div>
              </div>



              <div class="grid-container">

                  <div class="grid">
                      <input type="date" value="<?php echo $start_date; ?>" class="form-control" name="start_date" />
                  </div>


                  <div class="grid">
                      <input type="date" value="<?php echo $end_date; ?>" class="form-control" name="end_date" />
                              
                  </div>
              <div class="grid">
                <button type="submit" class="btn btn-primary btn-md" id="buttonSub"> Submit
                </button>
              </div>
              </div>

            </form>

<!-- DATE PICKER -->
                
              <div class="row" id="availabletable">
                       
                <!--  table area -->
                <div class="col-sm-12">

                <table id="logTable" width="100%" class="table datatable table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                          	<th>Date/Time</th>
                            <th><?php echo display('name')?></th>
                            <th>Action Page</th>
                            <th>Action Done</th>
                          	<th>Activity</th>
                           
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
                          	<?php  echo date('Y-m-d h:i:s A', strtotime($pc->entry_date));?>
                          </td>
                          
                          <td>
                            <?php  echo $pc->user_name;?>
                          </td>
                          
                          <td>
                          	<?php  echo $pc->action_page?>
                          </td>
                          	
                          <td>
                          	<?php  echo $pc->action_done;?>
                          </td>

                          <td>
                          	<?php  echo $pc->remarks;?>
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



<script>

$('#logTable').dataTable( {
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


