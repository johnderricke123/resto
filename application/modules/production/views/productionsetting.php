
<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body">
                    <fieldset class="border p-2">
                       <legend  class="w-auto"><?php echo $title; ?></legend>
                    </fieldset>
					<div class="row bg-brown">
                             <div class="col-sm-12 kitchen-tab" id="option">
                             					<p style="background: lightyellow; padding: 1em; box-shadow: 1px 3px 5px #0004; border-radius: 5px; cursor:alias;">
                     <strong style="color:#F00;">NOTE***:</strong> A restaurant should have a fixed recipe for a particular food
For making your work easy. This application has an auto production system which describes like this :<br />
If you have a sufficient amount of ingredients in your restaurant stock then it will automatically upgrade the amount of production for every sale.
Let me explain to you how:
Suppose, set a recipe for fried rice and a bbq chicken in your system once in the module Recipe Management>Add production with the ingredients, serving unit, variant, and price. Now you have got an order of 3 fried rice and 2 bbq chicken. You do not need to make this production again and again. Just select the food and make the order done from POS. The system will make the dish ready and it will automatically update the in-stock and out-stock quantity in the REPORT (Production-wise) and the ingredients will be reduced from the REPORT (Kitchen-wise). 
                 </p>
                                                <input id="chkbox-1760" type="checkbox" class="individual" name="productionsetting" value="productionsetting" <?php if($possetting->productionsetting==1){ echo "checked";}?>>
                                                <label for="chkbox-1760" style="display:inline-flex">
                                                    <span class="radio-shape">
                                                        <i class="fa fa-check"></i>
                                                    </span>
                                                   <?php echo display('select_auto') ?>
                                                </label>
                                               
                            </div>
                        </div>
                </div> 
            </div>
        </div>
    </div>
<script>

$('input[type="checkbox"]').click(function(){
            if($(this).is(":checked")){
               var menuid=$(this).val();
			   var ischeck=1;
			   var dataString = 'menuid='+menuid+'&status=1';
            }
            else if($(this).is(":not(:checked)")){
                var menuid=$(this).val();
				var ischeck=0;
				var dataString = 'menuid='+menuid+'&status=0';
            }
                $.ajax({
				type: "POST",
				url: "<?php echo base_url()?>ordermanage/order/settingenable",
				data: dataString,
				success: function(data){
					if(ischeck==1){
						swal("Enable", "Enable This Option to show on Production auto complete", "success");
						}
						else{
						swal("Disable", "Make This Field Is Optional On Production auto complete.", "warning");
						}
				    }
			    });
        });

</script>