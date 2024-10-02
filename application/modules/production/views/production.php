<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body">
                    <fieldset class="border p-2">
                       <legend  class="w-auto"><?php echo "Add Production" ?></legend>
                    </fieldset>
                    <?php echo form_open_multipart('production/production/insert_production',array('class' => 'form-vertical', 'id' => 'insert_production','name' => 'insert_production'))?>
                    <div class="row">
                             <div class="col-sm-6">
                               <div class="form-group row">
                                    <label for="supplier_sss" class="col-sm-5 col-form-label"><?php echo display('item_name') ?> <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-7">
                                        <?php 
						if(empty($item)){$item = array('' => '--Select--');}
						echo form_dropdown('foodid',$item,(!empty($item->ProductsID)?$item->ProductsID:null),'class="form-control" id="foodid"') ?>
                                    </div>
                                </div> 
                            </div>
                            <div class="col-sm-6">
                               <div class="form-group row">
                                    <label for="supplier_sss" class="col-sm-5 col-form-label"><?php echo display('varient_name') ?> <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-7">
                                        <?php 
						if(empty($item)){$item = array('' => '--Select--');}
						echo form_dropdown('foodvarientid','','','class="form-control" id="foodvarientid"') ?>
                                    </div>
                                </div> 
                            </div>
                             <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="date" class="col-sm-5 col-form-label">Production Date<i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-7">
                                 <input type="text" class="form-control datepicker" name="production_date" value="<?php echo date('d-m-Y');?>" id="production_date" required="" tabindex="2">
                                    </div>
                                </div>
                            </div>
                      <div class="col-sm-6">
                            <div class="form-group row">
                                    <label for="date" class="col-sm-5 col-form-label">Expiry Date<i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-7">
                                 <input type="text" class="form-control datepicker" name="expire_date" value="<?php echo date('t-m-Y');?>" id="expire_date" required="" tabindex="2">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="row">
                             <div class="col-sm-6">
                               <div class="form-group row">
                                    <label for="quantity" class="col-sm-5 col-form-label"><?php echo "No. of Serving"; ?> <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="pro_qty" value="" id="pro_qty" required="" tabindex="3" onkeyup="checkavailablity()">
                                    </div>
                                </div> 
                               
                            </div>
                              <div class="col-sm-6">
                        </div>
                  </div>
                       <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row right">
                                  
                                	<div class="col-sm-2"><input type="submit" id="add_production" class="btn btn-success btn-large" name="add-purchase" value="Submit"></div>
                                  	<div class="col-sm-2"><input type="submit" id="back_to_list" class="btn btn-default btn-large" name="back" value="Cancel"></div>
                            	</div>
                            </div>
                        </div>
                     
                        </form>
                </div> 
            </div>
        </div>
    </div>
    
    <script>
	$(document).ready(function() {
		$('#add_production').prop("disabled", true);
		})
    function checkavailablity(){
		var foodid=$("#foodid").val();
		var foodvarientid=$("#foodvarientid").val();
		var servingqty=$("#pro_qty").val();
		if(servingqty=='' || servingqty==0){
		$('#add_production').prop("disabled", true);
		return false;	
		}
		
		if(foodid==''){
			alert("Select Food Item!!");
			$("#pro_qty").val('');
			return false;
			}
		var myurl ='<?php echo base_url("production/production/ingredientcheck") ?>';
	    var dataString = "foodid="+foodid+'&qty='+servingqty+'&vid='+foodvarientid;
	   //alert(myurl);
		 $.ajax({
		 type: "POST",
		 url: myurl,
		 data: dataString,
		 success: function(data) {
           
			if(data==1){
                $('#add_production').prop("disabled", false);
				
				}
			else{
				$('#add_production').prop("disabled", true);
                alert(data);
                $("#pro_qty").val('');
				}
		 } 
	});
		}
$(document).on('change','#foodid',function(){
          var id = $(this).children("option:selected").val();
          var url= 'getfoodfarient'+'/'+id;
         $.ajax({
             type: "GET",
             url: url,
             success: function(data) {
              $('#foodvarientid').html(data);
        	}
        }); 
     });
    </script>
