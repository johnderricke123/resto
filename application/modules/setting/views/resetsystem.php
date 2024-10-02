<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-body">
            		<div class="row">
                        <div class="form-group col-lg-6 col-sm-offset-3">
                            <p class="alert" style="color:#8a4246;background-color:#ffedb6;border: 2px dotted #ffd479;;border-radius:5px;padding:15px;margin-bottom:20px;"><?php echo display('fresettext')?></p>
                        </div>
                        <div class="form-group col-lg-6 col-sm-offset-3">                           
                           <a href="javascript:;" onclick="resetdata()" class="btn btn-xs btn-success resettxt">Do you want to Process ??</a>
                            
                              
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
<div id="resetdata" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <strong>
      	Verify Account
        </strong> </div>
      <div class="modal-body">
      	<div class="row">
                  
                  <div class="form-group row">
                    <label for="4digit" class="col-sm-4 col-form-label">Type your Password</label>
                    <div class="col-sm-7">
                      <input type="password" class="form-control" id="checkpassword" name="checkpassword" />
                    </div>
                  </div>
                  <div class="form-group text-right">
                    <div class="col-sm-11" style="padding-right:0;">
                      <button type="button" id="resetnow" class="btn btn-success w-md m-b-5" onclick="confirmreset()">Reset Data</button>
                    </div>
                  </div>
                </div>
      
      </div>
    </div>
    <div class="modal-footer"> </div>
  </div>
</div>
<style type="text/css">
blink {
    -webkit-animation: 2s linear infinite condemned_blink_effect; // for android
    animation: 2s linear infinite condemned_blink_effect;
}
@-webkit-keyframes condemned_blink_effect { // for android
    0% {
        visibility: hidden;
    }
    50% {
        visibility: hidden;
    }
    100% {
        visibility: visible;
    }
}
@keyframes condemned_blink_effect {
    0% {
        visibility: hidden;
    }
    50% {
        visibility: hidden;
    }
    100% {
        visibility: visible;
    }
}
.resettxt{font-size:16px;}
</style>
<script>
 function resetdata(){
	 	$("#resetdata").modal('show');
	 }
	function confirmreset(){
		var pass=$('#checkpassword').val();
		var datavalue="password="+pass
		$.ajax({
				type: "POST",
				url: "<?php echo base_url()?>setting/setting/checkpassword",
				data: datavalue,
				success: function(data){
					if(data==0){
					swal("Warming", "Your Password is Not match", "warning");	
					}
					else{
						swal({
                                title: "success",
                                text: "Reset Completed",
                                type: "success",
                                showCancelButton: false,
                                confirmButtonColor: "#28a745",
                                confirmButtonText: "OK",
                                closeOnConfirm: true,
                                closeOnCancel: false
                            },
                            function (isConfirm) {
                                if (isConfirm) {
                               		window.location.href="<?php echo base_url()?>dashboard/home";
                                }
                            });
						}
				}
			});
		}
</script>
 