<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body">
                    <?php echo form_hidden('purID', (!empty($intinfo->purID)?$intinfo->purID:null)) ?>
                    <fieldset class="border p-2">
                       <legend  class="w-auto"><?php echo "Set Production Cost Per Unit" ?></legend>
                    </fieldset>
                    <?php echo form_open_multipart('production/production/production_entry',array('class' => 'form-vertical', 'id' => 'insert_purchase','name' => 'insert_purchase'))?>
                    <input name="url" type="hidden" id="url" value="<?php echo base_url("production/production/productionitem") ?>" />

                    <div class="row">
                             <div class="col-sm-6">
                               <div class="form-group row">
                                    <label for="supplier_sss" class="col-sm-4 col-form-label"><?php echo display('item_name') ?> <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-6">
                                        <?php 
						if(empty($item)){$item = array('' => '--Select--');}
						echo form_dropdown('foodid',$item,(!empty($item->ProductsID)?$item->ProductsID:null),'class="form-control" id="foodid"') ?>
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
						echo form_dropdown('foodvarientid','','','class="form-control" id="foodvarientid"') ?>
                                    </div>
                                </div> 
                            </div>
                        </div>
                     <table class="table table-bordered table-hover" id="purchaseTable">
                                <thead>
                                     <tr>
                                            <th class="text-center" width="20%">Item Information<i class="text-danger">*</i></th>
                                       		<th class="">Unit Purchase</th>
                                            <th class="text-center">Purchase Price<i class="text-danger">*</i></th>
                                       		<th class="text-center">SKU/Pkg. <i class="text-danger">*</i></th>
                                       
                                       		<th>Quantity Used</th>
                                       <th>Per Unit Cost</th>
                                            <th class="text-center"><?php echo display('price');?> </th>
                                            <th class="text-center"></th>
                                        </tr>
                                </thead>
                                <tbody id="addPurchaseItem">
                                    <tr>
                                        <td class="span3 supplier">
                                       <input type="text" name="product_name" required="" class="form-control product_name" onkeypress="product_list(1);" placeholder="Item Name" id="product_name_1" tabindex="5">
                                   <input type="hidden" class="autocomplete_hidden_value product_id_1" name="product_id[]" id="SchoolHiddenId">
                                   <input type="hidden" class="sl" value="1">
                                   <input type="hidden" id="unit-total_1" class="" />
                                        </td>
                                      <td class="text-center">
                                                <input type="text" name="product_unit_quantity[]" id="unit_1" class="form-control text-center store_cal_1" value="" tabindex="6">
                                            </td>
                                      <td class="text-right">
                                                <input type="text" name="purchased_price[]" id="purchased_price_1" onkeyup='calprice(this)' class="form-control text-right store_cal_1" placeholder="0.00" value="" min="0" tabindex="6">
                                            </td>
                                      <td class="text-right">
                                                <input type="text" name="quantity_purchased[]" id="quantity_purchased_1" onkeyup='calprice(this)' class="form-control text-right store_cal_1" placeholder="0.00" value="" min="0" tabindex="6">
                                            </td>
                                       <td class="text-right">
                                                <input type="text" name="product_quantity[]" id="cartoon_1" onkeyup='calprice(this)' class="form-control text-right store_cal_1" placeholder="0.00" value="" min="0" tabindex="6">
                                            </td>
                                      <td class="text-right">
                                                <input type="text" name="unit_cost[]" id="unit_cost_1" class="form-control text-right unit_cost store_cal_1" placeholder="0.00" value="" min="0" tabindex="6">
                                            </td>                                          
                                      
                                     
                                             <td class="text-right">
                                                <input type="number" id="price_1" name="total_amount[]" class="form-control total_price text-right store_cal_1" placeholder="0.00" value="" min="0" tabindex="6" readonly>
                                            </td>
                                            <td>
                                                <button style="text-align: right;" class="btn btn-danger red" type="button" value="Delete" onclick="deleteRow(this)" tabindex="8">Delete</button>
                                            </td>
                                    </tr>
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
                                        <input type="text" class="form-control text-right" name="total_price" id="total_price" value="" >
                                      
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
            
           
         
         	$('#purchased_price_'+sl).val(ui.item.uprice.toFixed(2));
         
            $('#quantity_purchased_'+sl).val(ui.item.qty_unit);
         
         	$('#unit-total_'+sl).val(ui.item.uprice);
         
         	$('#unit_'+sl).val(ui.item.p_unit);
            var product_id  = ui.item.value;
         	var foodid=$('#foodid').val();
            $(this).unbind("change");
            return false;
       }
   }

   $('body').on('keydown.autocomplete', '.product_name', function() {
       $(this).autocomplete(options);
   });
}
var count = 2;
    var limits = 500;

    function addmore(divName){
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
  newdiv.innerHTML ='<td class="span3 supplier"><input type="text" name="product_name" required class="form-control product_name productSelection" onkeypress="product_list('+ count +');" placeholder="Item Name" id="product_name_'+ count +'" tabindex="'+tab1+'"><input type="hidden" class="autocomplete_hidden_value product_id_'+ count +'" name="product_id[]" id="SchoolHiddenId"/><td><input type="text" name="product_unit_quantity[]" id="unit_' + count + '" class="form-control text-center store_cal_' + count + '" value="" tabindex="'+tab2+'"/></td><td><input type="text" class="form-control text-right" id="purchased_price_'+count+'" value ></td><td><input type="text" class="form-control text-right" name="quantity_purchased[]" id="quantity_purchased_'+count+'" value ></td><td class="text-right"><input type="text" name="product_quantity[]" tabindex="'+tab2+'" required  id="cartoon_'+ count +'" class="form-control text-right store_cal_' + count + '" onkeyup="calprice(this)"  placeholder="0.00" value="" min="0"/></td><td class="text-right"><input type="text" name="unit_cost[]" id="unit_cost_'+ count +'" class="form-control unit_cost text-right store_cal_'+ count +'" placeholder="0.00" value="" min="0" tabindex="6"></td><td class="text-right"><input type="text" tabindex="'+tab2+'" name="total_amount[]" id="price_'+ count +'" class="form-control text-right total_price store_cal_' + count + '"  placeholder="0.00" value="" min="0" readonly/></td><td> <input type="hidden" id="total_discount_1" class=""/><input type="hidden" id="unit-total_'+count+'" class="" /><input type="hidden" id="all_discount_1" class="total_discount" /><button style="text-align: right;" class="btn btn-danger red" type="button" value="Delete" onclick="deleteRow(this)" tabindex="8">Delete</button></td>';
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
      var gr_tot = 0;
     // var tot_cost = 0;
     // var price = parseFloat(totalval).toFixed(2)*parseFloat(qty).toFixed(2);
      var cost_price = toatalval / $('#quantity_purchased_'+id).val();
       
       var price = ( qty * $('#purchased_price_'+id).val() / $('#quantity_purchased_'+id).val() );
 
      $('#unit_cost_'+id).val(cost_price.toFixed(2));
      
      $('#price_'+id).val(price.toFixed(2));

      
      $(".total_price").each(function() {
            isNaN(this.value) || 0 == this.value.length || (gr_tot += parseFloat(this.value))
        });
      
      
      // $(".unit_cost").each(function() {
      //      isNaN(this.value) || 0 == this.value.length || (tot_cost += parseFloat(this.value))
       // });
      
      
  
      
      $("#total_price").val(gr_tot.toFixed(2));
       
      
     // $("#total_cost").val(tot_cost.toFixed(2));
      
    }

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