
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd ">
            <div class="panel-heading">
                <div class="panel-title">
                <div class="btn-group pull-right"> 
                     <a href="<?php echo base_url('dashboard/role/user_access_role')?>" class="btn btn-success"><i class="fa fa-plus"></i> <?=display('user_access_role')?></a>
                    </div>
                    <h4><?php echo (!empty($title)?$title:null) ?></h4>
                </div>
            </div>
            <?php echo form_open("dashboard/role/save_role_access") ?>
            <div class="panel-body">

                        <div class="form-group row">
                                <label for="user_id" class="col-sm-3 col-form-label"><?php echo display('user') ?> *</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="user_id" id="user_id" required="">
                                        <option value="">--Select--</option>
                                        <?php 
                                           foreach($user as $val){
                                            echo '<option value="'.$val->id.'">'.$val->firstname.' '.$val->lastname.'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            

                            <div class="form-group row">
                                <label for="role_id" class="col-sm-3 col-form-label"><?php echo display('role') ?> *</label>
                                <div class="col-sm-9">
                                <?php foreach($role as $val){ ?>
                                    <label class="radio-inline">
                                        <input type="checkbox" name="role[]" value="<?php echo $val->role_id;?>"> <?php echo $val->role_name;?>
                                    </label> 
                                <?php } ?>
                                </div>
                            </div>

                   

                    <div class="form-group text-right">
                       <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('save') ?></button>
                    </div>


            </div>
            <?php echo form_close();?>
        </div>
    </div>
</div>


<script>
$(document).on('change','#user_id',function(){
			  var id =$("#user_id").val();
			  var roleid=$('input[name="role[]"]:checked').val();
			  var dataString = 'userid='+id+'&role='+roleid;
			  $.ajax({
					type: "POST",
					url: "<?php echo base_url()?>dashboard/role/userisassign",
					data: dataString,
					success: function(data){
						if(data==404){
							$('input[name="role[]"]:checked').prop("checked", false);
							toastr.warning("This user is already Assign this role", 'Warning');
						}
					}
					});

        });
		
$('input[type="checkbox"]').click(function(){
            if($(this).is(":checked")){
				  var currentstate=$(this);
				  var id =$("#user_id").val();
				  var roleid=$('input[name="role[]"]:checked').val();
				  var dataString = 'userid='+id+'&role='+roleid;
				  $.ajax({
						type: "POST",
						url: "<?php echo base_url()?>dashboard/role/userisassign",
						data: dataString,
						success: function(data){
							if(data==404){
								currentstate.prop("checked", false);
								toastr.warning("This user is already Assign this role", 'Warning');
							}
						}
						});
            }
           
        });
</script>







 
 