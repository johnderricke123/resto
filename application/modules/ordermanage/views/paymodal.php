<form class="navbar-search" id="paymodal-multiple-form" method="post" action="">
    <div class="modal-content">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <strong><?php echo display('sl_payment'); ?></strong>
        </div>
        <div class="modal-body">

            <div class="row">
                <div class="panel">
                    <div class="panel-body">
                        <?php
                        if ($ismerge == 1) { ?>
                            <table class="table table-fixed table-bordered table-hover bg-white" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center"><?php echo display('sl'); ?>. </th>
                                        <th class="text-center"><?php echo display('ord_num'); ?> </th>
                                        <th class="text-center"><?php echo display('total_amount'); ?></th>
                                        <th class="text-center">Paid Amount</th>
                                        <th class="text-center">Due</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $totaldue = 0;
                                    $totalamount = 0;
                                    foreach ($order_info as $order) {
                                        $totalamount = $order->totalamount + $totalamount;

                                    ?>
                                        <tr>
                                            <td> <input class="marg-check" type="checkbox" value="<?php echo $order->order_id; ?>" onclick="margeorder()" name="order[]" checked></td>
                                            <td><?php echo $order->order_id; ?></td>
                                            <td class="text-right"><?php echo $order->totalamount; ?></td>
                                            <td class="text-right"><?php echo $order->customerpaid; ?></td>
                                            <td class="text-right" id="due-<?php echo $order->order_id; ?>">
                                                <?php echo $order->totalamount - $order->customerpaid;
                                                $totaldue = $totaldue + ($order->totalamount - $order->customerpaid)

                                                ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>

                                </tbody>

                            </table>
                        <?php } else {
                            $totaldue = ($order_info->totalamount - $order_info->customerpaid);
                            $totalamount = $order_info->totalamount;
                        }
                        $scan = scandir('application/modules/');
                        $pointsys = "";
                        foreach ($scan as $file) {
                            if ($file == "loyalty") {
                                if (file_exists(APPPATH . 'modules/' . $file . '/assets/data/env')) {
                                    $pointsys = 1;
                                }
                            }
                        }

                        ?>



                        <div class="col-md-8 row ">
                            <div class="row no-gutters">
                                <div class="col-md-4">

                                    <div class="form-group">
                                        <label for="discounttt" class="col-form-label pb-2"><?php echo display('discount_type'); ?></label>
                                        <select name="discountttch" class="form-control" id="discountttch" onchange="changetype();">
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

                                        <input type="hidden" id="ordertotal" value="<?php echo $totalamount; ?>" />
                                        <input type="hidden" id="orderdue" value="<?php echo $totaldue; ?>" />
                                        <input type="number" class="form-control" id="discount" name="discount" value="" placeholder="0" />
                                        <input type="hidden" id="grandtotal" name="grandtotal" value="<?php echo $totalamount; ?>" />
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
                                        <label for="no-person" class="col-form-label pb-2">No. of Person</label>
                                        <input type="number" class="form-control" name="no-person" id="noPerson" value="<?php echo $total_persons; ?>" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="no-senior" class="col-form-label pb-2">No. of Discount</label>
                                        <!-- <input type="number" class="form-control"  name="no-senior" id="noSenior" value="1" /> -->
                                        <input type="number" class="form-control" name="no-senior" id="noSenior" value="0" />
                                    </div>
                                </div>
                            </div>
                            <div id="adddiscount" style="display:none;">
                                <div class="row no-gutters">
                                    <div class="form-group col-md-6">
                                        <label for="payments" class="col-form-label pb-2"><?php echo display('paymd'); ?></label>
                                        <?php $card_type = 1;
                                        echo form_dropdown('paytype[]', $paymentmethod, (!empty($card_type) ? $card_type : null), 'class="card_typesl postform resizeselect form-control" id="payment_method[]" onchange="showhidecard(this)"') ?>

                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="paidamount_marge" class="col-form-label pb-2">Amount</label>
                                        <input type="number" step="0.01" id="paidamount_marge" class="form-control number" name="paidamount[]" value="<?php echo $totaldue; ?>" onkeyup="changedueamount()" placeholder="0" onclick="givefocus(this)" />
                                    </div>
                                </div>

                                <div class="row no-gutters" id="complementary_number" style="display:none;">
                                    <div class="form-group col-md-6">
                                        <label for="complementary_number_input" class="col-form-label pb-2">Number/Remarks <span class="color-red">*</span> </label>
                                        <input type="text" id="complementary_number_input"  class="form-control number"  name="complementary_num" value="" placeholder="No."  required onclick="givefocus(this)" />
                                        <!-- AR/OR feature Code -->
                                        <!-- <div class="row">
                                    <div class="col-sm-2"><label>AR#</label></div>
                                    <div class="col-sm-4"><input type="number" class="form-control" name="ar_code" id="ar_code"/></div>
                                    <div class="col-sm-2"><label>OR#</label></div>
                                    <div class="col-sm-4"><input type="number" class="form-control" name="or_code" id="or_code"/></div>
                                </div> -->
                                        <!-- AR/OR feature Code -->

                                    </div>
                                </div>
<!--
                                <div class="no-gutters" id="wallet_number" style="display:none;">
                                    <div class="form-group col-md-6">
                                        <label for="wallet_reference_number" class="col-form-label pb-2">Contact/Ref./Trans. No. <span class="color-red">*</span></label>
                                        <input type="text" id="wallet_reference_number" class="form-control number" name="note" value="" placeholder="" required onclick="givefocus(this)" />
                                    </div>
                                </div>
-->
                                <div class="row no-gutters">
                                    <div class="cardarea w-100 no-gutters" style="display:none;" id="card-terminal">
                                        <div class="form-group col-md-6">
                                            <label for="card_terminal" class="col-form-label"><?php echo display('crd_terminal'); ?></label>

                                            <?php echo form_dropdown('card_terminal[]', $terminalist, '', 'class="postform resizeselect form-control" ') ?>

                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="bank" class="col-form-label"><?php echo display('sl_bank'); ?></label>

                                            <?php echo form_dropdown('bank[]', $banklist, '', 'class="postform resizeselect form-control" ') ?>

                                        </div>
                                        
<!-- commented for ar/or feature -->
                                        <!-- <div class="form-group col-md-6">
                                            <label for="4digit" class="col-form-label">Reference No.</label>
                                            <input type="text" class="form-control" name="last4digit[]" value="" />
                                        </div> -->
<!-- commented for ar/or feature -->

                                    </div>

                                    <div class="row col-md-12" id="customer_active" style="display:none;">
                                        <div class="col-md-8 form-group" id="active_hotel_customer">
                                            <label for="customer_name">Active Hotel Guest<span class="color-red">*</span></label>
                                            <div class="d-flex">
                                                <?php $cusid = 1;
                                                echo form_dropdown('customer_name', $active_hotel_customer, '', 'class="postform resizeselect form-control" id="customer_name" required="required" onchange="customerid(this)"') ?>
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
<!-- AR/OR Feature code -->
                                <div class="row no-gutters" id="ar_or_input_field" style="display:none;">
                                    <div class="form-group col-md-12">
                                        <!-- <label for="complementary_number_input" class="col-form-label pb-2">Number/Remarks <span class="color-red">*</span> </label> -->
                                        <!-- <input type="text" id="complementary_number_input"  class="form-control number"  name="complementary_num" value="" placeholder="No."  required onclick="givefocus(this)" /> -->
<!-- AR/OR feature Code -->
                                    <div class="row">
                                        <div class="col-sm-1"><label>AR#</label></div>
                                        <div class="col-sm-5"><input type="number" class="form-control" name="ar_code" id="ar_code"/></div>
                                        <div class="col-sm-1"><label>OR#</label></div>
                                        <div class="col-sm-5"><input type="number" class="form-control" name="or_code" id="or_code"/></div>
                                    </div>
<!-- AR/OR feature Code -->
                                    </div>
                                </div>
<!-- AR/OR Feature code -->

                                <div class="no-gutters" id="wallet_number" style="display:none;">
                                    <div class="form-group col-md-6">

                                        <label for="wallet_reference_number" class="col-form-label pb-2">Contact/Ref./Trans. No. <span class="color-red">*</span></label>
                                        <input type="text" id="wallet_reference_number" class="form-control number" name="note" value="" placeholder="" required onclick="givefocus(this)" />

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
                                    <td id="totalamount">
                                        <?php echo $totalamount; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Discount
                                    </td>
                                    <td id="totaldiscount_marge">
                                        <?php echo '0.00'; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Total Due
                                    </td>
                                    <td id="due-amount">
                                        <?php echo $totaldue; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Amount Paid
                                    </td>
                                    <td id="pay-amount">
                                        <?php echo $order_info->customerpaid; ?>
                                    </td>
                                </tr>


                                <tr id="change-row" class="info">
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
                                    <?php if ($ismerge == 1) { ?>
                                        <button type="button" id="paidbill" class="btn btn-success w-md m-b-5" onclick="margeorderconfirmorcancel()"><?php echo display('pay_print'); ?></button>
                                    <?php } else {
                                    ?>
                                        <button type="button" class="btn btn-success w-md m-b-5" id="pay_bill" disabled onfocus="submitmultiplepay()"><?php echo display('pay_print'); ?></button>
                                        <input type="hidden" id="get-order-id" name="orderid" value="<?php echo $order_info->order_id; ?>">

                                        <input type="hidden" id="counterid" name="counterid" value="<?php echo $counter; ?>">
                                        <input type="hidden" id="customer_id" name="customer_id" value="">
                                        <input type="hidden" id="payment_method_id" name="payment_method_id" value="">
                                        <input type="hidden" id="customername" name="customername" value="">
                                        <input type="hidden" id="book_id" name="book_id" value="">
                                    <?php } ?>
                                </div>
                            </div>



                        </div>




                    </div>
                    <div class="col-md-12 alert alert-danger">
                        Alert!: Don't use Cash as payment method for Inclusions/Breakfast Buffet for Guest.

                    </div>
                </div>
            </div>
        </div>
    </div>


</form>

<input type="hidden" id="get-order-flag" value="1">


<script type="text/javascript">
    $(document).ready(function() {
        "use strict";
        // select 2 dropdown 
        $("select.form-control:not(.dont-select-me)").select2({
            placeholder: "Select option",
            allowClear: true
        });
// AR/OR Feature code
        $('#ar_or_input_field').show();
// AR/OR Feature code
    });

    function changedue() {
        var main = $("#totalamount_marge").val();
        var paid = $("#paidamount_marge").val();
        var change = main - paid;

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
            $("#totalamount_marge").text(total);
            $("#due-amount").text(due);
            $("#grandtotal").val(total);
            $("#granddiscount").val(0);
            $("#totaldiscount_marge").text('0.00');
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
                var totaldis = $("#discount").val().trigger('change');
            }

            var afterdiscount = parseFloat(total - totaldis)
            var newtotal = afterdiscount.toFixed(2);
            var granddiscount = parseFloat(totaldis);
            $("#totalamount_marge").text(newtotal);
            $("#paidamount_marge").val(newtotal);
            $("#grandtotal").val(newtotal);
            $("#due-amount").text(parseFloat(newtotal));
            $("#granddiscount").val(granddiscount).trigger('change');

            $("#totaldiscount_marge").text($("#granddiscount").val());

        }
        $("#adddiscount").hide();
        $("#add_new_payment").empty();

    });

    $(document).on('click', '#paymentnow', function() {
        $("#adddiscount").show();
        $('#paidamount_marge').focus();
        givefocus('paidamount_marge');
        $("#pay_bill").prop('disabled', false);
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
        // alert(no_senior);
        //original code
        //if(this.value >  no_persons) {
        //original code
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


    function showhidecard(element) {
        var cardtype = $(element).val();
        var data = $(element).closest('div.row').next().find('div.cardarea');

// alert(cardtype);
        // return;
        if (cardtype == 9) { //  gcash
// AR/OR Feature code
            $('#ar_or_input_field').show();
// AR/OR Feature code
            $("#isonline").val(0);
            $('#customer_active').hide();
            $('#card-terminal').show();
            $("#assigncard_terminal").val('');
            $('#complementary_number').hide();
            $('#complementary_number_input').val('');
            //$('#wallet_number').hide();
          	$('#wallet_number').show();
            $('#wallet_reference_number').val('');
            $("#assignbank").val('');
            $("#assignlastdigit").val('');
            $('#customer_name').val('');
            $("#payment_method_id").val(8);
            $('#book_id').val('');
        } else if (cardtype == 2) {
// AR/OR Feature code
            $('#ar_or_input_field').hide();
// AR/OR Feature code
            $("#isonline").val(0);
            $('#customer_active').show();
            $('#customer_name').val('Select');
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

        } else if (cardtype == 1 || cardtype == 7) { // cash or Cash buffet walk in
            // AR/OR Feature Code
            $('#ar_or_input_field').show();
            // AR/OR Feature Code
            $("#isonline").val(0);
            $('#customer_active').hide();
            $('#customer_name').val('');
            $("#paidamount_marge").select();
            $('#customer_id').val('');
            $('#customer_name').val('');
            $('#book_id').val('');
            givefocus('paidamount_marge');
            $('#card-terminal').hide();
            $('#wallet_reference_number').val('');
            $('#complementary_number').hide();
            $('#complementary_number_input').val('');
            $('#wallet_number').hide();
            $("#payment_method_id").val(1);
            $(element).closest('div.row').next().find('div.cardarea').hide();
        } else if (cardtype == 6) { // room charge
// AR/OR Feature code
            $('#ar_or_input_field').hide();
// AR/OR Feature code

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
        } else if (cardtype == 10 || cardtype == 8 || cardtype == 13) { // gift cert or BDO or PNB

// AR/OR Feature Code
            $('#ar_or_input_field').show();
// AR/OR Feature Code

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
            $('#book_id').val('');

            $(element).closest('div.row').next().find('div.cardarea').hide();
        } else if (cardtype == 11 || cardtype == 3) { // complementary voucher
// AR/OR Feature code
            //$('#ar_or_input_field').hide();
// AR/OR Feature code

// AR/OR Feature code
if(cardtype == 11){
            $('#ar_or_input_field').hide();
            $('#complementary_number').show();
}
// AR/OR Feature code

// AR/OR Feature code
if(cardtype == 3){
    $('#complementary_number').hide();
    $('#ar_or_input_field').show();
}
// AR/OR Feature code
            $("#isonline").val(0);
            $('#customer_active').hide();
            //$('#complementary_number').show();
            $('#wallet_number').hide();
            $('#wallet_reference_number').val('');
            $('#card-terminal').hide();
            $("#assigncard_terminal").val('');
            $("#assignbank").val('');
            $("#assignlastdigit").val('');
            $("#payment_method_id").val(11);
            givefocus('paidamount_marge');
            $(element).closest('div.row').next().find('div.cardarea').hide();

        } else if (cardtype == 5 || cardtype == 16 || cardtype == 17 || cardtype == 18 || cardtype == 19 || cardtype == 20 || cardtype == 21 || cardtype == 22 || cardtype == 23 || cardtype == 24 || cardtype == 25) { //all charges to
// AR/OR Feature code
            $('#ar_or_input_field').hide();
// AR/OR Feature code

            $('#customer_active').hide();
            $("#isonline").val(1);
            $('#complementary_number').hide();
            $('#complementary_number_input').val('');
            $('#customer_name').hide();
            $(element).closest('div.row').next().find('div.cardarea').hide();
            $("#assigncard_terminal").val('');
            $("#assignbank").val('');
            $("#assignlastdigit").val('');
            $('#customer_name').val('');
            $('#wallet_number').show();
            $('#wallet_reference_number').val('');
        } else if(cardtype == 12){
// AR/OR Feature code
            $('#ar_or_input_field').show();
// AR/OR Feature code
        }
    }

    function givefocus(element) {
        window.prevFocus = $(element);
    }

    function inputNumbersfocus(result) {
        if (result == "C") {
            var totalpaid = 0;
            prevFocus.val(0);
            changedueamount()
        } else {
            if (prevFocus.val() == 0) {
                prevFocus.val("")
            }
            var paidamount = prevFocus.val();
            var totalpaid = paidamount + result;
            prevFocus.val(totalpaid);
            changedueamount()


        }
    }

    function customerid(id) {

        var selectBox = document.getElementById("customer_name");
        var selectedValue = selectBox.options[selectBox.selectedIndex].value;

        var name = $("#customer_name option:selected").text();
        console.log(name);
        $("#customer_id").val(selectedValue);
        $('#customername').val(name);
        var book_id = name.split("|");
        console.log(book_id[1]);
        $('#book_id').val(book_id[1]);
    }



    function changedueamount() {

        var inputval = parseFloat(0);
        var maintotalamount = $('#totalamount_marge').text();

        //var inputval = $('#paidamount_marge').val();

        $('.number').each(function() {
            var inputdata = parseFloat(inputval);
            inputval += Number($(this).val());
        });

        $("#pay-amount").text(inputval.toFixed(2));


        var restamount = (parseFloat(maintotalamount)) - (parseFloat(inputval));
        var changes = restamount;

        var pay = Number($("#pay-amount").text());
        var total = Number($("#due-amount").text());


        var ch = Number(total - pay);
        console.log(ch);

        if (ch <= 0) {
            $("#change-row").show();

            $("#change-amount").text(ch.toFixed(2));
        } else {
            $("#change-row").hide();

            $("#change-amount").text('0.00');

        }

    }

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
</script>