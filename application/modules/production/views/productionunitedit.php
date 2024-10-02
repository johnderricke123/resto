<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body"><?php 
				//print_r($varientinfo);
				 //print_r($productioninfo);?>
                   
                    <fieldset class="border p-2">
                       <legend  class="w-auto"><?php echo "Set Production Unit" ?></legend>
                    </fieldset>
                    <?php echo form_open_multipart('production/production/update_entry',array('class' => 'form-vertical', 'id' => 'insert_purchase','name' => 'insert_purchase'))?>
                     <?php echo form_hidden('itemid', (!empty($productioninfo->foodid)?$productioninfo->foodid:null)); ?>
                     <input name="url" type="hidden" id="url" value="<?php echo base_url("production/production/productionitem") ?>" />

                    <div class="row">
                             <div class="col-sm-6">
                               <div class="form-group row">
                                    <label for="supplier_sss" class="col-sm-4 col-form-label"><?php echo display('item_name') ?> <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-6">
                                        <?php if(empty($item)){$item = array('' => '--Select--');}
										echo form_dropdown('foodid',$item,(!empty($productioninfo->foodid)?$productioninfo->foodid:null),'class="form-control" readonly id="foodid" onchange="selectfoodvarient()"') 
										?>
                                    </div>
                                </div> 
                            </div>
                             <div class="col-sm-6">
                               <div class="form-group row">
                                    <label for="supplier_sss" class="col-sm-3 col-form-label"><?php echo display('varient_name') ?> <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-6">
                                        <?php 
						if(empty($item)){$item = array('' => '--Select--');}
						echo form_dropdown('foodvarientid',$varientinfo,(!empty($productioninfo->pvarientid)?$productioninfo->pvarientid:null),'class="form-control"  id="foodvarientid"') ?>
                                    </div>
                                </div> 
                            </div>
                        </div>
                     <table class="table table-bordered table-hover" id="purchaseTable">
                                <thead>
                                     <tr>
                                             <th class="text-center" width="20%">Item Information<i class="text-danger">*</i></th>
                                       		<th class="">Qty Purchase</th>
                                            <th class="text-center">Purchase Price<i class="text-danger">*</i></th>
                                       		<th class="text-center">SKU/Pkg. <i class="text-danger">*</i></th>
                                       
                                       		<th>Quantity Used</th>
                                       <th>Per Unit Cost</th>
                                            <th class="text-center"><?php echo display('price');?> </th>
                                            <th class="text-center"></th>
                                        </tr>
                                </thead>
                                <tbody id="addPurchaseItem">
                                <?php $i=0;
                                $total_pr = 0;
								foreach($iteminfo as $item){
								
                                  $total_pr = $total_pr + $item->total_price;
                                  
                                  $cost = $item->uprice / $item->qty_unit;
                                  
                                  
                                  $i++;
									?>
                                    <tr>
                                        <td class="span3 supplier">
                                        <input type="text" name="product_name" required="" class="form-control product_name" onkeypress="product_list(<?php echo $i;?>);" placeholder="Item Name" id="product_name_<?php echo $i;?>" value="<?php echo $item->ingredient_name;?>" tabindex="5">
                                   <input type="hidden" class="autocomplete_hidden_value product_id_<?php echo $i;?>" name="product_id[]" id="SchoolHiddenId" value="<?php echo $item->ingredientid;?>">
                                   <input type="hidden" class="sl" value="<?php echo $i;?>">
                                   
                                        </td>
                                       <td class="text-center">
                                         <?php echo $item->qty_unit;?> / <?php echo $item->unitname;?>
                                                <input type="hidden" name="product_unit_quantity[]" id="unit_<?php echo $i;?>" class="form-control inline store_cal_<?php echo $i;?>" value="<?php echo $item->qty_unit;?>" tabindex="6">
                                         <input type="hidden" name="unitname[]" value="<?php echo $item->unitname; ?>" >
                                            </td>
                                            <td class="text-right">
                                                <input type="text" name="purchased_price[]" id="purchased_price_<?php echo $i;?>" onkeyup='calprice(this)' class="form-control text-right store_cal_<?php echo $i;?>"" placeholder="0.00" value="<?php echo number_format($item->uprice,2);?>" min="0" tabindex="6">
                                            </td>
                                       <td class="text-center">
                                                <input type="text" name="quantity_purchased[]" id="quantity_purchased_<?php echo $i;?>" class="form-control text-center store_cal_1" value="<?php echo $item->qty_unit ;?>" min="0" tabindex="6">
                                            </td>
                                            <td class="text-right">
                                                <input type="text" name="product_quantity[]" id="cartoon_<?php echo $i;?>" onkeyup='calprice(this)' class="form-control text-right store_cal_1" placeholder="0.00" value="<?php echo $item->qty;?>" min="0" tabindex="6">
                                            </td>
                                      <td>
                                       
										<div class="text-center">
                                         		 <input type="number" name="unit_cost[]" id="unit_cost_<?php echo $i;?>" class="form-control text-center unit_cost store_cal_1" min="0" step="0.01" value="<?php if ($cost == null) {echo '0.00' ;} else{ echo number_format($cost,2); } ?>" min="0" tabindex="6">
                                        </div>
                                      </td>
                                             <td class="text-right">
                                                <input type="text"  id="price_<?php echo $i;?>" class="form-control text-right total_price store_cal_1" placeholder="0.00" min="0" step="0.01" value="<?php echo number_format($item->total_price,2);?>" min="0" name="total_amount[]" tabindex="6" readonly>
                                            </td>
                                            <td>
                                               <input type="hidden" id="unit-total_<?php echo $i;?>" >
                                                <button style="text-align: right;" class="btn btn-danger red" type="button" value="Delete" onclick="deleteRow(this)" tabindex="8">Delete</button>
                                            </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4">
                                            <input type="button" id="add_invoice_item" class="btn btn-success" name="add-invoice-item" onclick="addmore('addPurchaseItem');" value="Add More item" tabindex="9">
                                        </td>
                                    
                                  <td class="text-right"colspan="2">
                                      <b>Total</b>
                                      </td>
                                     
                                      <td>
                                        <input type="text" class="form-control text-right" id="total_price" value="<?php echo number_format($total_pr,2); ?>" >
                                      
                                      </td>
                                      </tr>
                                </tfoot>
                            </table>
                     <div class="form-group row">
                            <div class="col-sm-6">
                                <input type="submit" id="add_purchase" class="btn btn-success btn-large" name="add-purchase" value="Submit">
                            </div>
                        </div>
                        </form>
                </div> 
            </div>
        </div>
    </div>
<script>
var row = $("#purchaseTable tbody tr").length;
var count = row+1;
var limits = 500;

function product_list(sl) {
    var foodid = $('#foodid').val();
	 var geturl=$("#url").val();
	//alert(csrfname);
    if (foodid == 0 || foodid=='') {
        alert('Please select Desiger Food !');
        return false;
    }

    // Auto complete
    var options = {
        minLength: 0,
        source: function( request, response ) {
        var product_name = $('#product_name_'+sl).val();
        $.ajax( {
          url: geturl,
          method: 'post',
          dataType: "json",
          data: {
			product_name:product_name
          },
          success: function( data ) {
            response( data );
			//alert(data.csrf_token)
          }
        });
      },
       focus: function( event, ui ) {
           $(this).val(ui.item.label);
           return false;
       },
       select: function( event, ui ) {
            $(this).parent().parent().find(".autocomplete_hidden_value").val(ui.item.value); 
           
         var item_unit =  ui.item.qty_unit+ "" + ui.item.unitname;
         var u_cost = parseFloat(ui.item.uprice) / parseFloat(ui.item.qty_unit);
         
         	$('#purchased_price_'+sl).val(ui.item.uprice.toFixed(2));
         
          $('#quantity_purchased_'+sl).val(ui.item.qty_unit);
         
           $('#unit-total_'+sl).val(ui.item.uprice);
                                                                       
         	$('#price_'+sl).val(ui.item.uprice);        
        
         
         
         	$('#unit_'+sl).val(ui.item.unit);	    
         
         
            var product_id          = ui.item.value;
         	
                                              
          var  foodid=$('#foodid').val();
          	
         	
         
            $(this).unbind("change");
            
         return false;
       }
   }

   $('body').on('keydown.autocomplete', '.product_name', function() {
       $(this).autocomplete(options);
   });
}


    function addmore(divName){
		var row = $("#purchaseTable tbody tr").length;
		var count = row+1;
        if (count == limits)  {
            alert("You have reached the limit of adding " + count + " inputs");
        }
        else{
            var newdiv = document.createElement('tr');
            var tabin="product_name_"+count;
             tabindex = count * 4 ,
           newdiv = document.createElement("tr");
            tab1 = tabindex + 1;
            tab2 = tabindex + 2;
			tab3 = tabindex + 3;
            tab4 = tabindex + 4;         


  newdiv.innerHTML ='<td class="span3 supplier"><input type="text" name="product_name" required class="form-control product_name productSelection" onkeypress="product_list('+ count +');" placeholder="Item Name" id="product_name_'+ count +'" tabindex="'+tab1+'" > <input type="hidden" class="autocomplete_hidden_value product_id_'+ count +'" name="product_id[]" id="SchoolHiddenId"/>  <input type="hidden" class="sl" value="'+ count +'">  </td><td><input type="text" name="product_unit_quantity[]" id="unit_' + count + '" class="form-control text-center store_cal_' + count + '" value="" tabindex="'+tab2+'"/></td><td><input type="text" class="form-control text-right" id="purchased_price_'+count+'" name="purchased_price[]" value ></td><td><input type="text" class="form-control text-right" name="quantity_purchased[]" id="quantity_purchased_'+count+'" value ></td><td class="text-right"><input type="text" name="product_quantity[]" tabindex="'+tab2+'" required  id="cartoon_'+ count +'" class="form-control text-right store_cal_' + count + '" placeholder="0.00" value="" onkeyup="calprice(this)" min="0"/>  </td><td class="text-right"><input type="text" name="unit_cost[]" id="unit_cost_'+ count +'" class="form-control unit_cost text-right store_cal_'+ count +'" placeholder="0.00" value="" min="0" tabindex="6"></td><td class="text-right"><input type="text" tabindex="'+tab2+'" id="price_'+ count +'" name="total_amount[]" class="form-control text-right store_cal_' + count + '"  placeholder="0.00" value="" min="0" readonly/>  </td><td> <input type="hidden" id="unit-total_'+count+'" class="" /><input type="hidden" id="total_discount_1" class="" /><input type="hidden" id="all_discount_1" class="total_discount" /><button style="text-align: right;" class="btn btn-danger red" type="button" value="Delete" onclick="updatedeleteRow(this,0,0)" tabindex="8">Delete</button></td>';
  
            
            document.getElementById(divName).appendChild(newdiv);
            document.getElementById(tabin).focus();
            document.getElementById("add_invoice_item").setAttribute("tabindex", tab3);
            document.getElementById("add_purchase").setAttribute("tabindex", tab4);
           
            count++;

            $("select.form-control:not(.dont-select-me)").select2({
                placeholder: "Select option",
                allowClear: true
            });
        }
    }

       function calprice(element)
    {
      var id = element.id.replace('cartoon_', '');
      var ingrden = $('#product_name_'+id).val();
       if (ingrden == 0 || ingrden=='') {
        $(element).val('');
        alert('Please select Item!');

        return false;
    }
    else{
     
      var toatalval = $('#unit-total_'+id).val();
      var qty = $(element).val();      
      var pur_price = $("#cartoon"+id).val();
      var gr_tot = 0;
                                  
                                  
      var price = ( qty * $('#purchased_price_'+id).val() / $('#quantity_purchased_'+id).val() );
      
      var cost_price = $('#purchased_price_'+id).val() / $('#quantity_purchased_'+id).val();
      
      $('#unit_cost_'+id).val(cost_price.toFixed(2));
      
      $('#price_'+id).val(parseFloat(price).toFixed(2));
      
      $(".total_price").each(function() {
            isNaN(this.value) || 0 == this.value.length || (gr_tot += parseFloat(this.value))
        });
      
     //if(cost_price > 0) {
     // $('#unit_cost_'+id).val(parseFloat(cost_price.toFixed(2)));
                      // }
      
      
      
       

      $("#total_price").val(gr_tot.toFixed(2));
    }
  }

function selectfoodvarient(){
	      var id = $("#foodid").val();
          var url= '<?php echo base_url()?>production/production/getfoodfarient'+'/'+id;
         $.ajax({
             type: "GET",
             url: url,
             success: function(data) {
              $('#foodvarientid').html(data);
        	}
        });
	}
</script>