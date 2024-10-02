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
                      
                      
                      
<?php if($this->session->flashdata('error')){ ?>

<h2 style="text-align: center;">
   <?php echo $this->session->flashdata('error'); ?>
</h2>   

<?php } ?>


        <!-- <button type="button" class="btn btn-primary btn-md" onclick="showcom()"><i class="fa fa-plus-circle" aria-hidden="true"></i>
                       Add
                   </button> --> 
<!-- button with modal  -->

                      
<!--
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-plus-circle" aria-hidden="true"></i> Add
          </button>


          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p class="text-left">
                    testing...
                  </p>
                    </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button>
                </div>
              </div>
            </div>
          </div> -->

<!-- newly added-->

                      
	<div class="form-group text-right">
       
     
          <form method="get" action="<?php echo site_url('setting/Cancelogs/cancelog')?>">
            <button type="button" class="btn btn-primary btn-md" data-target="#add0" data-toggle="modal"  ><i class="fa fa-plus-circle" aria-hidden="true"></i> Add</button> 
              <button type="submit" class="btn btn-primary btn-md"  ><i aria-hidden="true"></i>Cancel Logs</button>    
            </form>
     </div>

<div id="add0" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
          	<div class="modal-header">          
              <div class="text-left">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <strong>Add a pincode</strong>
              </div>
            </div>
            <div class="modal-body">
           
<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body">

                    <form action="<?php echo site_url('setting/Commissionsetting/reg_pin') ?>" method="post" accept-charset="utf-8">
                    
<input type="hidden" value="" />
                    <div class="form-group row">
                        <label for="status" class="col-sm-5 col-form-label">User *</label>
                        <div class="col-sm-7 customesl">
                          <input class="form-control" type="text" name="username" placeholder="Enter Name">
 
                        </div>
                    </div>
                      
                        <div class="form-group row">
                            <label for="shipping" class="col-sm-5 col-form-label">Pincode *</label>
                            <div class="col-sm-7">
                                <input  name="pincode" class="form-control" type="password" placeholder="Pincode" id="shipping" value="">
                            </div>
                        </div>


  
                        <div class="form-group text-right">
                            <button type="reset" class="btn btn-primary w-md m-b-5">Reset</button>
                            <button type="submit" class="btn btn-success w-md m-b-5">Add</button>
                        </div>
                    </form>
                </div>  
            </div>
        </div>
    </div>
             
    
   
    </div>
     
            </div>
            <div class="modal-footer">

            </div>

        </div>

    </div>
<!-- newly added-->            
                      
<!-- button with modal  -->
                      
                  </div>
                   </div>
              <div class="row" id="availabletable">
                       
                <!--  table area -->
                <div class="col-sm-12">

                <table width="100%" class="datatable2 table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('name')?></th>
                            <th><?php echo display('password')?></th>
                            <th><?php echo display('action') ?></th> 
                           
                        </tr>
                    </thead>
                    <tbody>
                      <?php 
                             $sl=0;
                             foreach ($pincode as $pc) 
                      {
                        ?>
                        <tr>
                          <td>
                            <?php 
                            echo $pc->name;
                            ?>
                          </td>
                          <td>
                            <?php 
                             echo password_hash($pc->pincode, PASSWORD_BCRYPT);
                            ?>
                          </td>
                            <td class="center">
                                    
                                 
                                        <a data-target="#add1<?php echo $sl;?>" class="btn btn-info btn-sm" data-toggle="modal" data-placement="left" title="Update"><i class="fa fa-pencil" aria-hidden="true"></i></a> 
                                         
                                        <a href="<?php echo base_url("setting/Commissionsetting/del_pin/$pc->id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="right" title="Delete "><i class="fa fa-trash-o" aria-hidden="true"></i></a>  
                                       
                                    </td>
                        </tr>
                      
                      
  <div id="add1<?php echo $sl;?>" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
          	<div class="modal-header">          
              <div class="text-left">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <strong>Add a pincode</strong>
              </div>
            </div>
            <div class="modal-body">
           
<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body">
				
                    <form action="<?php echo site_url('setting/Commissionsetting/update_pin') ?>" method="post" accept-charset="utf-8">
                    
<input type="hidden" name="id" value="<?php echo $pc->id;?>" />
                    <div class="form-group row">
                        <label for="status" class="col-sm-5 col-form-label">User *</label>
                        <div class="col-sm-7 customesl">
                          <input value="<?php echo $pc->name;?>" class="form-control" type="text" name="username" placeholder="Enter Name">
 
                        </div>
                    </div>
                      
                        <div class="form-group row">
                            <label for="shipping" class="col-sm-5 col-form-label">Pincode *</label>
                            <div class="col-sm-7">
                                <input name="pincode" class="form-control" type="password" placeholder="Pincode" id="shipping" value="">
                            </div>
                        </div>


  
                        <div class="form-group text-right">
                            <button type="reset" class="btn btn-primary w-md m-b-5">Reset</button>
                            <button type="submit" class="btn btn-success w-md m-b-5">Add</button>
                        </div>
                    </form>
                </div>  
            </div>
        </div>
    </div>
             
    
   
    </div>
     
            </div>
            <div class="modal-footer">

            </div>

        </div>

    </div>
                      
                      
                      
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

