 <form class="navbar-search" id="paymodal-multiple-form" method="get" action="">
     <div class="modal-content">

         <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal">&times;</button>
             <strong><?php echo display('sl_payment'); ?></strong>
         </div>
         <div class="modal-body">
             <div class="row">
                 <div class="panel">
                     <div class="panel-body">
                         <div class="col-md-8 row ">
                             <div class="row no-gutters">
                                 <div class="col-md-4">

                                     <div class="form-group">
                                         <label for="discounttt" class="col-form-label pb-2"><?php echo display('discount_type'); ?></label>
                                         <select name="discountttch" class="form-control" id="discountttch" onchange="changetype()">
                                             <option value="1">Percent(%)</option>
                                             <option value="2">Senior Citizen(20%)</option>
                                             <option value="0">Amount</option>
                                         </select>
                                     </div>


                                 </div>
                                 <div class="col-md-4">
                                     <div class="form-group">
                                         <label for="discount" class="col-form-label pb-2"><?php echo display('discount'); ?>(<span id="chty"><?php if ($settinginfo->discount_type == 0) {
                                                                                                                                                    echo $currency->curr_icon;
                                                                                                                                                } else {
                                                                                                                                                    echo "%";
                                                                                                                                                } ?></span>)</label>
                                         <input type="hidden" id="discounttype" value="<?php echo $settinginfo->discount_type; ?>" />
                                         <input type="hidden" id="ordertotal" value="<?php echo $totaldue; ?>" />
                                         <input type="hidden" id="orderdue" value="<?php echo $totaldue; ?>" />
                                         <input type="number" class="form-control" id="discount" name="discount" value="" placeholder="0" />
                                         <input type="hidden" id="grandtotal" name="grandtotal" value="<?php echo $totaldue; ?>" />
                                         <input type="hidden" id="granddiscount" name="granddiscount" value="" />
                                         <input type="hidden" id="isredeempoint" name="isredeempoint" value="" />
                                     </div>
                                 </div>
                                 <div class="col-md-4">
                                     <?php if ($pointsys == 1 && $membership > 1) {
                                            $customerpoints = $this->db->select("*")->from('tbl_customerpoint')->where('customerid', $customerid)->get()->row();
                                        ?>
                                         <div class="form-group">
                                             <label for="redempoint" class="col-form-label pb-2" style="width:100%; text-align:left; padding-left:15px;">Points: <?php echo $customerpoints->points; ?></label>
                                             <div class="kitchen-tab"><input id="chkbox-red" type="checkbox" class="individual" name="redeemit" value="<?php echo $customerid; ?>">
                                                 <label for="chkbox-red" class="mb-0"> Redeem It? &nbsp;&nbsp;
                                                     <span class="radio-shape" style="margin-right:0"> <i class="fa fa-check"></i> </span></label>
                                             </div>
                                         </div>
                                     <?php } ?>
                                     <div class="form-group" style="padding-top:<?php if ($pointsys == 1 && $membership > 1) {
                                                                                    echo "35px";
                                                                                } else {
                                                                                    echo "28px";
                                                                                } ?>">
                                         <button type="button" id="paymentnow" class="btn btn-success w-md m-b-5"><?php echo display('payment'); ?></button>
                                     </div>
                                 </div>
                                 <div class="col-md-12" id="senior-count" style="display: none;">
                                     <div class="col-md-4 form-group">
                                         <label for="no-person" class="col-form-label pb-2">Total No. of Guests</label>
                                         <input type="number" class="form-control" name="no-person" id="noPerson" value="0" />
                                     </div>
                                     <div class="col-md-4 form-group">
                                         <label for="no-senior" class="col-form-label pb-2">No. of Senior Citizen</label>
                                         <input type="number" class="form-control" name="no-senior" id="noSenior" value="0" />
                                     </div>
                                 </div>
                             </div>
                             <div id="adddiscount" style="display:none;">
                                 <div class="row no-gutters">
                                     <div class="form-group col-md-6">
                                         <label for="payments" class="col-form-label pb-2"><?php echo display('paymd'); ?></label>

                                         <?php $card_type = 1;
                                            echo form_dropdown('paytype[]', $paymentmethod, (!empty($card_type) ? $card_type : null), 'class="card_typesl postform resizeselect form-control " onchange="showhidecard(this)"') ?>

                                     </div>


                                     <div class="form-group col-md-6">
                                         <label for="4digit" class="col-form-label pb-2"><?php echo display('cuspayment'); ?></label>

                                         <input type="number" class="form-control number" id="paidamount_<?php echo $sub_id; ?>" name="paidamount[]" value="<?php echo number_format($totaldue, 2, '.', ''); ?>" onkeyup="changedueamount()" placeholder="0" onclick="givefocus(this)" />

                                     </div>
                                 </div>
                                 <div class="row no-gutters">
                                     <div class="cardarea-none w-100 no-gutters" style="display:none;">
                                         <div class="form-group col-md-6">
                                             <label for="card_terminal" class="col-form-label"><?php echo display('crd_terminal'); ?></label>

                                             <?php echo form_dropdown('card_terminal[]', $terminalist, '', 'class="postform resizeselect form-control" ') ?>

                                         </div>
                                         <div class="form-group col-md-6">
                                             <label for="bank" class="col-form-label"><?php echo display('sl_bank'); ?></label>

                                             <?php echo form_dropdown('bank[]', $banklist, '', 'class="postform resizeselect form-control" ') ?>

                                         </div>
                                         <div class="form-group col-md-6">
                                             <label for="4digit" class="col-form-label"><?php echo display('lstdigit'); ?></label>

                                             <input type="text" class="form-control" name="last4digit[]" value="" />

                                         </div>
                                     </div>

                                     <div class="row col-md-12" id="customer_active" style="display:none;">
                                         <div class="col-md-8 form-group" id="active_hotel_customer">
                                             <label for="customer_name">Active Hotel Guest<span class="color-red">*</span></label>
                                             <div class="d-flex">
                                                 <?php $cusid = 1;
                                                    echo form_dropdown('customer_name', $active_hotel_customer, (!empty($cusid) ? $cusid : null), 'class="postform resizeselect form-control" id="customer_name" onchange="customerid(this)"') ?>
                                             </div>
                                         </div>
                                         <div class="no-gutters">
                                             <div class="form-group col-md-6">
                                                 <label for="anyreason" class="col-form-label pb-2">Note </label>
                                                 <input type="text" id="anyreason" class="form-control anyreason" name="anyreason" value="" placeholder="" onclick="givefocus(this)" />
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="row no-gutters">
                                     <div class="room-guest w-100 no-gutters" style="display:none;">
                                         <div class="form-group col-md-6">
                                             <label for="card_terminal" class="col-form-label"><?php echo display('crd_terminal'); ?></label>

                                             <?php echo form_dropdown('card_terminal[]', $terminalist, '', 'class="postform resizeselect form-control" ') ?>

                                         </div>
                                         <div class="form-group col-md-6">
                                             <label for="bank" class="col-form-label"><?php echo display('sl_bank'); ?></label>

                                             <?php echo form_dropdown('bank[]', $banklist, '', 'class="postform resizeselect form-control" ') ?>

                                         </div>
                                         <div class="form-group col-md-6">
                                             <label for="4digit" class="col-form-label"><?php echo display('lstdigit'); ?></label>

                                             <input type="text" class="form-control" name="last4digit[]" value="" />

                                         </div>

                                     </div>
                                 </div>



                                 <div class="row col-md-12 m-0" id="add_new_payment">

                                 </div>
                                 <div class="form-group text-right">
                                     <div class="col-sm-12" style="padding-right:0;">
                                         <button type="button" id="add_new_payment_type" class="btn btn-success w-md m-b-5"><?php echo display('add_new_payment_type'); ?></button>
                                     </div>
                                 </div>
                             </div>

                         </div>
                         <div class="col-md-4">
                             <table class="table table-fixed table-bordered table-hover bg-white" style="width:100%;">
                                 <tr>
                                     <td>
                                         Total Amount
                                     </td>
                                     <td id="amount">
                                         <?php echo number_format($totaldue, 2, '.', ''); ?>
                                     </td>
                                 </tr>
                                 <tr>
                                     <td>
                                         Discount
                                     </td>
                                     <td id="tdiscount">
                                         <!-- <?php //echo number_format($totaldue, 2, '.', ''); ?> -->
                                         <?php echo '0.00'; ?>
                                     </td>
                                 </tr>
                                 <tr>
                                     <td>
                                         Total Due
                                     </td>
                                     <td id="due-amount">
                                         <?php echo number_format($totaldue, 2, '.', ''); ?>
                                     </td>
                                 </tr>
                                 <tr>
                                     <td>
                                         Amount Tender
                                     </td>
                                     <td id="pay-amount">
                                         0
                                     </td>
                                 </tr>
                                 <tr>
                                     <td>
                                         Change Amount
                                     </td>
                                     <td id="change-amount">

                                     </td>
                                 </tr>

                             </table>

                             <div class="grid-container">
                                 <input type="button" class="grid-item" name="n1" value="1" onClick="inputNumbersfocus(n1.value)">
                                 <input type="button" class="grid-item" name="n2" value="2" onClick="inputNumbersfocus(n2.value)">
                                 <input type="button" class="grid-item" name="n3" value="3" onClick="inputNumbersfocus(n3.value)">
                                 <input type="button" class="grid-item" name="n4" value="4" onClick="inputNumbersfocus(n4.value)">
                                 <input type="button" class="grid-item" name="n5" value="5" onClick="inputNumbersfocus(n5.value)">
                                 <input type="button" class="grid-item" name="n6" value="6" onClick="inputNumbersfocus(n6.value)">
                                 <input type="button" class="grid-item" name="n7" value="7" onClick="inputNumbersfocus(n7.value)">
                                 <input type="button" class="grid-item" name="n8" value="8" onClick="inputNumbersfocus(n8.value)">
                                 <input type="button" class="grid-item" name="n9" value="9" onClick="inputNumbersfocus(n9.value)">
                                 <input type="button" class="grid-item" name="n0" value="0" onClick="inputNumbersfocus(n0.value)">
                                 <input type="button" class="grid-item" name="n00" value="00" onClick="inputNumbersfocus(n00.value)">
                                 <input type="button" class="grid-item" name="c0" value="C" placeholder="0" onClick="inputNumbersfocus(c0.value)">

                             </div>

                             <div class="form-group text-right mt-3">
                                 <div class="col-sm-12" style="padding-right:0; margin-top:15px;">
                                     <button type="button" class="btn btn-success w-md m-b-5" id="paybutton-sub-<?php echo $sub_id; ?>" onclick="submitmultiplepaysub('<?php echo $sub_id; ?>')"><?php echo display('pay_print'); ?></button>
                                 </div>
                             </div>



                         </div>



                         <input type="hidden" id="get-order-id" name="orderid" value="<?php echo $sub_id; ?>">
                     </div>
                 </div>
             </div>
         </div>
     </div>

 </form>
 <input type="hidden" id="get-order-flag" name="orderid" value="1">
 <script type="text/javascript">
     $(document).ready(function() {
         "use strict";
         // select 2 dropdown 
         $("select.form-control:not(.dont-select-me)").select2({
             placeholder: "Select option",
             allowClear: true
         });
     });


     //  function changetype() {
     //      var distypech = $("#discountttch").val();
     //      var discount_val = 0;
     //      if (distypech == 0) {
     //          var thistype = "<?php echo $currency->curr_icon; ?>";
     //          $("#senior-count").hide();
     //      } else if (distypech == 2) {
     //          var thistype = "%";
     //          discount_val = 20;
     //          $("#senior-count").show();
     //      } else {
     //          $("#senior-count").hide();
     //          var thistype = "%";
     //          $("#discount").val('');
     //      }
     //      $("#chty").text(thistype);
     //      $("#discounttype").val(distypech);
     //      $("#discount").val(discount_val);
     //      $("#discount").trigger("change");
     //  }

     function changedue(){
		var main=$("#tamount").val();
		var paid=$("#paidamount_marge").val();
		var change = main-paid;
  
		//$("#change-amount").val(Math.round(change)).trigger('change');
	}

     function changetype() {

         var distypech = $("#discountttch").val();

         if (distypech == 0) {
             var thistype = "<?php echo $currency->curr_icon; ?>";
             $("#discount").val(0).trigger("change");

         } else if (distypech == 2) {
             var thistype = "%";
             $("#discount").val(20);
             $("#senior-count").show();
             $("#discount").trigger("change");
         } else {
             var thistype = "%";
             $("#discount").val(0).trigger('change');
             $("#senior-count").hide();
         }

         $("#chty").text(thistype);
         $("#discounttype").val(distypech);
         //$("#discount").val(0).trigger("change");
     }

     $(document).on('change', '#discount', function() {
         var discount = $("#discount").val();
         var distype = $("#discounttype").val();
         var total = $("#ordertotal").val();
         var due = $("#orderdue").val();

         if (discount == '' || discount == 0) {
             $("#tamount").text(total);
             $("#due-amount").text(due);
             $("#grandtotal").val(total);
             $("#granddiscount").val(0);
             //  new added
             $("#tdiscount").text('0.00');
             //  new added
            //  $("#paidamount_<?php echo $sub_id; ?>").val(total);
         } else {
             if (distype != 2) {
                 var totaldis = discount * total / 100;

             } else if (distype == 2) {
                 var noperson = $("#noPerson").val();
                 var nosenior = $("#noSenior").val();

                 var individual_amt = total / noperson;

                 var dis_senior = individual_amt * nosenior;
                 var dis_value = discount / 100;

                 var totaldis = dis_senior * dis_value;

             } else {
                 // var totaldis = discount;
                 var totaldis = $("#discount").val().trigger('change');
             }

             var afterdiscount = parseFloat(total - totaldis);
             var total = afterdiscount.toFixed(2);
             var granddiscount = parseFloat(totaldis);
             $("#tamount").text(total);
             $("#paidamount_marge").val(total);
            //  $("#paidamount_<?php echo $sub_id; ?>").val(total);
             $("#grandtotal").val(total);
             $("#due-amount").text(parseFloat(total));
             //$("#granddiscount").val(granddiscount.toFixed(2));
             //  new added
             $("#granddiscount").val(granddiscount).trigger('change');
             $("#tdiscount").text($("#granddiscount").val());
             // new added

         }
         $("#adddiscount").hide();
         $("#add_new_payment").empty();

     });


     $(document).on('click', '#paymentnow', function() {
         $("#adddiscount").show();
     });
     $('input[type="checkbox"]').click(function() {
         if ($(this).is(":checked")) {
             var test = $('input[name="redeemit"]:checked').val();
             $("#isredeempoint").val(test);
         } else {
             $("#isredeempoint").val('');
         }
     });


     $(document).on('keyup keypress change', '#noSenior', function(e) {

         var no_persons = $('#noPerson').val();
         //newly added
         var no_senior = $('#noSenior').val();
         //newly added

         //   if(this.value >  no_persons) {

         //newly added
         if (false) {
             //newly added
             alert('No of Senior must be less than or equal no. of persons.');
             $('#noSenior').val('');
             e.stopPropagation();
         } else {
             $("#discount").trigger("change");
         }

     });

     function updateDiscount(el) {

         var noperson = $("#noPerson").val();
         var nosenior = $("#noSenior").val();

         if (nosenior <= noperson) {
             $("#discount").trigger("change");
         } else {
             event.stopPropagation();
             alert('No of Senior must be less than or equal no. of persons.');
             //   el.preventDefault();
         }
     }


     function changedueamount() {

         var inputval = parseFloat(0);
         var maintotalamount = $('#tamount').text();

         //  var inputval = $('#paidamount_marge').val();

         $('.number').each(function() {
             var inputdata = parseFloat(inputval);
             inputval += Number($(this).val());
         });
         //new added
         $("#pay-amount").text(inputval.toFixed(2));
         //new added

         var restamount = (parseFloat(maintotalamount)) - (parseFloat(inputval));
         var changes = restamount;




         if (changes <= 0) {
             //  $("#change-amount").text(Math.abs(changes));
             $("#pay-amount").text(inputval.toFixed(2));
             $('#due-amount').text(0.00);
             $("#change-amount").text(changes.toFixed(2));
         } else {
             $("#change-amount").text(0);
             if (restamount < 0) {
                 $("#change-amount").text(restamount.toFixed(2));
             }

             $('#due-amount').text(restamount.toFixed(2));
             $("#pay-amount").text(inputval.toFixed(2));
         }

         var due = $('#due-amount').text();

         if (due > 0) {
             $("#paybutton-sub-<?php echo $sub_id; ?>").attr('disabled', 'disabled');
         } else {
             $("#paybutton-sub-<?php echo $sub_id; ?>").removeAttr('disabled');
         }
     }

     function showhidecard(element) {
         var cardtype = $(element).val();
         var data = $(element).closest('div.row').next().find('div.cardarea');

         if (cardtype == 8) { // debit/credit card
             $("#isonline").val(0);
             $('#customer_active').hide();
             $('#card-terminal').show();
             $("#assigncard_terminal").val('');
             $('#complementary_number').hide();
             $('#complementary_number_input').val('');
             $('#wallet_number').hide();
             $('#wallet_reference_number').val('');
             $("#assignbank").val('');
             $("#assignlastdigit").val('');
             $('#customer_name').val('');
             $("#payment_method_id").val(8);
         } else if (cardtype == 2) {
             $("#isonline").val(0);
             $('#customer_active').show();
             $('#card-terminal').hide();
             $('#complementary_number').hide();
             $('#complementary_number_input').val('');
             $("#assigncard_terminal").val('');
             $("#assignbank").val('');
             $('#wallet_reference_number').val('');
             $("#assignlastdigit").val('');
             $("#payment_method_id").val(2);
             givefocus('paidamount_marge');
             $('#wallet_number').hide();

         } else if (cardtype == 1) { // cash
             $("#isonline").val(0);
             $('#customer_active').hide();
             $('#customer_name').val('');
             $("#paidamount_marge").select();
             $('#customer_id').val('');
             $('#customer_name').val('');
             givefocus('paidamount_marge');
             $('#card-terminal').hide();
             $('#wallet_reference_number').val('');
             $('#complementary_number').hide();
             $('#complementary_number_input').val('');
             $('#wallet_number').hide();
             $("#payment_method_id").val(1);
             $(element).closest('div.row').next().find('div.cardarea').hide();
         } else if (cardtype == 6) { // room charge
             $("#isonline").val(0);
             $('#customer_active').show();
             $('#card-terminal').hide();
             $("#assigncard_terminal").val('');
             $('#complementary_number').hide();
             $('#complementary_number_input').val('');
             $('#wallet_number').hide();
             $("#assignbank").val('');
             $('#wallet_reference_number').val('');
             $("#assignlastdigit").val('');
             $("#payment_method_id").val(6);
             // $("#paidamount_marge").val(0);
         } else if (cardtype == 9) { // GCASH
             $("#isonline").val(0);
             $('#customer_active').hide();
             $('#card-terminal').hide();
             $('#complementary_number').hide();
             $('#wallet_number').show();
             $('#wallet_reference_number').val('');
             $('#complementary_number_input').val('');
             $("#assigncard_terminal").val('');
             $("#assignbank").val('');
             $("#assignlastdigit").val('');
             $("#payment_method_id").val(9);

             $(element).closest('div.row').next().find('div.cardarea').hide();
         } else if (cardtype == 11) { // complementary voucher
             $("#isonline").val(0);
             $('#customer_active').hide();
             $('#complementary_number').show();
             $('#wallet_number').hide();
             $('#wallet_reference_number').val('');
             $('#card-terminal').hide();
             $("#assigncard_terminal").val('');
             $("#assignbank").val('');
             $("#assignlastdigit").val('');
             $("#payment_method_id").val(11);
             givefocus('paidamount_marge');
             $(element).closest('div.row').next().find('div.cardarea').hide();

         } else if (cardtype == 5) {
             $("#isonline").val(1);
             $('#complementary_number').hide();
             $('#wallet_number').hide();
             $('#customer_name').val('');
             $(element).closest('div.row').next().find('div.cardarea').hide();
             $("#assigncard_terminal").val('');
             $("#assignbank").val('');
             $("#assignlastdigit").val('');
             $('#customer_name').val('');
             $('#wallet_reference_number').val('');
         }
     }

//     function newDiscount() {
//     var noperson = parseInt($("#noPerson").val());
//     var nosenior = parseInt($("#noSenior").val());
//     var disc = parseFloat($("#tdiscount").val());

//     if (isNaN(disc)) {
//         console.error("Invalid discount value");
//         return;
//     }

//     var div = disc / noperson;
//     var newdiscount = div * nosenior;
// }

 </script>