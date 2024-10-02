<script type="text/javascript">
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        document.body.style.marginTop = "0px";
        window.print();
        document.body.innerHTML = originalContents;
    }

    function getreport() {
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        var orderid = $('#orderid').val();

        if (from_date == '') {
            alert("Please select from date");
            return false;
        }
        if (to_date == '') {
            alert("Please select To date");
            return false;
        }
        var myurl = baseurl + 'report/reports/<?php echo $view; ?>';
        //alert(myurl);
        var dataString = "from_date=" + from_date + '&to_date=' + to_date + '&orderid=' + orderid;
        $.ajax({
            type: "POST",
            url: myurl,
            data: dataString,
            success: function(data) {
                $('#getresult2').html(data);
                $('#respritbl').DataTable({
                    responsive: true,
                    paging: true,
                    dom: 'Bfrtip',
                    "lengthMenu": [
                        [25, 50, 100, 150, 200, 500, -1],
                        [25, 50, 100, 150, 200, 500, "All"]
                    ],
                    buttons: [{
                            extend: 'copy',
                            className: 'btn-sm',
                            footer: true
                        },
                        {
                            extend: 'csv',
                            title: 'Report',
                            className: 'btn-sm',
                            footer: true
                        },
                        {
                            extend: 'excel',
                            title: 'Report',
                            className: 'btn-sm',
                            title: 'exportTitle',
                            footer: true
                        },
                        {
                            extend: 'pdf',
                            title: 'Report',
                            className: 'btn-sm',
                            footer: true
                        },
                        {
                            extend: 'print',
                            className: 'btn-sm',
                            footer: true
                        },
                        {
                            extend: 'colvis',
                            className: 'btn-sm',
                            footer: true
                        }
                    ],
                    "searching": true,
                    "processing": true,

                });
            }
        });
    }
</script>
<style type="text/css">
    @media print {
        a[href]:after {
            content: none !important;
        }
    }
</style>
<div class="row">


    <div class="col-sm-12 col-md-12">
        <div class="panel">

            <div class="panel-body">
                <fieldset class="border p-2">
                    <legend class="w-auto"><?php echo $title; ?></legend>
                </fieldset>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-body">

                                <form method="post" action="<?php echo site_url('report/reports/stock_inventory') ?>">
                                    <?php date_default_timezone_set("Asia/Dhaka");
                                    $today = date('m-d-Y');
                                    $statdate = date('d-m-Y', strtotime('first day of this month')); ?>
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <!-- <label class="" for="from_date"><?php echo display('start_date') ?></label> -->
<!-- <input type="text" name="date" value="<?php echo $statdate ?>" class="form-control datepicker" id="from_date" placeholder="<?php echo "Date" ?>" readonly="readonly"> -->
<input type="text" id="datepicker" name="date" size="30" value="<?php echo $date ?>" class="form-control datepicker"/>
<!-- <input type="text" name="testing" value="testing" /> -->

                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <button class="btn btn-success" type="submit"><?php echo display('search') ?></button>
                                        </div>
                                        <div class="col-sm-1">
                                            <a class="btn btn-warning" href="#" onclick="printDiv('purchase_div')"><?php echo "Print"; ?></a>
                                        </div>
                                        <div class="col-sm-8"></div>
                                    </div>

                            </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4><?php echo display('table'); ?></h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div id="purchase_div" style="margin-left:2px;">
                                <!-- <div class="text-center">
                                    <h3> <?php echo $setting->storename; ?> </h3>
                                    <h4><?php echo $setting->address; ?> </h4>
                                    <h4> <?php echo "Print Date" ?>: <?php echo date("m/d/Y h:i:s"); ?> </h4>
                                </div> -->
                                <!-- <div class="table-responsive" id="getresult2">

                                </div> -->
                                <!-- newly added -->
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <div class="panel">

                                            <div class="panel-body">
                                                <fieldset class="border p-2">
                                                    <legend class="w-auto">Stock Inventory</legend>
                                                </fieldset>
                                                <div class="row">
                                                    <div class="col-sm-12" id="findfood">
                                                        <table class="table datatable table-fixed table-bordered table-hover bg-white" id="purchaseTable">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-center" colspan="1"></th>
                                                                    <th class="text-center" colspan="1"></th>
                                                                    <th class="text-center" colspan="3" style="font-weight: bold; background-color: #f7ffb0;">Beginning</th>
                                                                    <th class="text-center" colspan="3" style="font-weight: bold; background-color: #c2edff;">Purchase In</th>
                                                                    <th class="text-center" colspan="3" style="font-weight: bold; background-color: #99ffc2;">Sold</th>
                                                                    <th class="text-center" colspan="2" style="font-weight: bold; background-color: #54ccff;">Ending</th>
                                                                </tr>
                                                                <tr>
                                                                    <th class="text-center">Date</th>
                                                                    <th class="text-center">Ingredient Name</th>
                                                                    <th class="text-center">Qty</th>
                                                                    <th class="text-center">Price</th>
                                                                    <th class="text-center">Total</th>
                                                                    <th class="text-center">Qty</th>
                                                                    <th class="text-center">Price</th>
                                                                    <th class="text-center">Total</th>
                                                                    <th class="text-right">Qty. Sold</th>
                                                                    <th class="text-center">Price</th>
                                                                    <th class="text-center">Total Amt. Sold</th>
                                                                    <th class="text-center">Total Qty</th>
                                                                    <th class="text-center">Total Amt</th>
                                                                    <!-- <th class="text-center">Price</th> -->
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <p> <?php

                                                                    //var_dump($get_ingredients); 
                                                                    ?> </p>
                                                                <?php foreach($get_ingredients as $gi){ ?>
                                                                    <tr>
                                                                        <?php
                                                                            $ingredient_id = $gi->id;
                                                                            $get_stock_in = $this->report_model->get_stock_inventory_in_stock($ingredient_id,$date);
                                                                            $total_qty = 0;
                                                                            $total_amt = 0;
                                                                        ?>
                                                                        <td class="text-center"><?php echo $date; ?></td>
                                                                        <td class="text-center"><?php echo $gi->ingredient_name; ?></td>
                                                                        <?php
                                                                            $get_beginning = $this->report_model->get_beginning($ingredient_id,$date);
                                                                            //var_dump($get_beginning);die();
                                                                        ?>
                                                                <!-- Beginning -->
                                                                        <td class="text-center" style="font-weight: bold; background-color: #f7ffb0;"><?php echo $get_beginning['quantity_total'] - $get_beginning['stock_deduct']; ?></td>
                                                                        <td class="text-center" style="font-weight: bold; background-color: #f7ffb0;"><?php echo $get_beginning['purchase_details']->price; ?></td>
                                                                        <td class="text-center" style="font-weight: bold; background-color: #f7ffb0;"><?php $total_qty += $get_beginning['quantity_total'] - $get_beginning['stock_deduct']; $total_amt += $get_beginning['purchase_details']->price * ($get_beginning['purchase_details']->quantity - $get_beginning['stock_deduct']); echo ($get_beginning['purchase_details']->quantity - $get_beginning['stock_deduct']) * $get_beginning['purchase_details']->price; ?></td>
                                                                <!-- Beginning -->
                                                                <?php 
                                                                    //$get_stock_in = $this->report_model->get_stock_inventory_in_stock($ingredient_id,$date);
                                                                ?>
                                                                <!-- Stock In -->
                                                                        <td class="text-center" style="font-weight: bold; background-color: #c2edff;"><?php echo round($get_stock_in->quantity); ?></td>
                                                                        <td class="text-center" style="font-weight: bold; background-color: #c2edff;"><?php echo $get_stock_in->price; ?></td>
                                                                        <td class="text-center" style="font-weight: bold; background-color: #c2edff;"><?php $total_qty += $get_stock_in->quantity; $total_amt += $get_stock_in->price * $get_stock_in->quantity; echo $get_stock_in->quantity * $get_stock_in->price; ?></td>
                                                                <!-- Stock In -->
                                                                <?php 
                                                                    $get_stock_out = $this->report_model->get_stock_out($ingredient_id,$date);
                                                                    //var_dump($get_stock_out);
                                                                ?>
                                                                <!-- Stock out -->
                                                                        <td class="text-center" style="font-weight: bold; background-color: #99ffc2;"><?php  echo $get_stock_out; ?></td>
                                                                        <td class="text-center" style="font-weight: bold; background-color: #99ffc2;"><?php echo $get_beginning['purchase_details']->price; ?></td>
                                                                        <td class="text-center" style="font-weight: bold; background-color: #99ffc2;"><?php $total_qty -= $get_stock_out; $total_amt = $total_amt -  ($get_stock_out * $get_beginning['purchase_details']->price);  echo number_format($get_stock_out * $get_beginning['purchase_details']->price, 2); ?></td>
                                                                <!-- Stock out -->
                                                                <!-- EndingTotal  -->
                                                                        <td class="text-center" style="font-weight: bold; background-color: #54ccff;"><?php echo $total_qty; ?></td>
                                                                        <td class="text-center" style="font-weight: bold; background-color: #54ccff;"><?php echo number_format($total_amt, 2); ?></td>
                                                                <!-- EndingTotal  -->
                                                                    </tr>
                                                                <?php } ?>







                                                                <?php foreach ($get_stock_inventory_in as $gsii) {
                                                                    break;
                                                                    $total_qty = 0;
                                                                    $total_amt = 0; ?>
                                                                    <tr>
                                                                        <?php //var_dump($gsii); 
                                                                        ?>
                                                                        <td class="text-center"><?php
                                                                                                $date = date('Y-m-d', strtotime($gsii->purchasedate . ' +1 day'));
                                                                                                echo $date; ?></td>
                                                                        <td class="text-center"><?php echo $gsii->ingredient_name; ?></td>
                                                                        <td class="text-center">
                                                                            <?php $total_qty += $gsii->quantity;
                                                                            echo $gsii->quantity;
                                                                            ?>
                                                                        </td>
                                                                        <td class="text-center"><?php

                                                                                                echo $gsii->price; ?></td>
                                                                        <td class="text-center"><?php $total_amt += ($gsii->quantity * $gsii->price) - $gsii->purchase_stock_deduct;
                                                                                                echo $total_amt;
                                                                                                ?></td>
                                                                        <?php
                                                                        $stock_in = $this->report_model->get_stock_inventory_in_stock($gsii->id, $date);
                                                                        $stock_out = $this->report_model->get_stock_inventory_out_stock($gsii->id, $date);

                                                                        ?>
                                                                        <td class="text-center">
                                                                            <?php
                                                                            $total_qty += $stock_in[0]->quantity;
                                                                            echo $stock_in[0]->quantity;
                                                                            //echo $stock_out;die();
                                                                            ?>

                                                                        </td>
                                                                        <td class="text-center">
                                                                            <?php
                                                                            //$total_amt += $stock_in[0]->price;
                                                                            echo $stock_in[0]->price;
                                                                            ?>
                                                                        </td>
                                                                        <td class="text-center"><?php
                                                                                                $total_amt += $stock_in[0]->totalprice;
                                                                                                echo $stock_in[0]->totalprice; ?>
                                                                        </td>

                                                                        <?php

                                                                        ?>
                                                                        <td class="text-right">
                                                                            <?php
                                                                            $total_qty -= $gsii->purchase_stock_deduct;
                                                                            // echo $gsii->purchase_stock_deduct;
                                                                            echo $stock_out
                                                                            ?>
                                                                        </td>
                                                                        <td class="text-center"><?php
                                                                                                //$total_amt -= $gsii->price;
                                                                                                echo $gsii->price; ?></td>
                                                                        <td class="text-right">
                                                                            <?php
                                                                            $total_amt -= (intval($gsii->purchase_stock_deduct) * intval($gsii->price));
                                                                            //echo intval($gsii->purchase_stock_deduct) * intval($gsii->price);
                                                                            echo number_format(intval($stock_out) * intval($gsii->price), 2);
                                                                            ?>
                                                                        </td>


                                                                        <td class="text-right"><?php echo $total_qty; ?> </td>
                                                                        <td class="text-right"><?php echo $total_amt; ?> </td>
                                                                        <!-- <td class="text-right">₱ 100.00 </td> -->
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                            <tfoot>

                                                            </tfoot>
                                                        </table>
                                                        <div class="text-right"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- newly added -->

                            </div>
                            <div class="text-right">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        var myurl = baseurl + 'report/reports/<?php echo $view; ?>';
        // alert(myurl);
        // return;
        var dataString = 'from_date=<?php echo $statdate ?>&to_date=<?php echo $today ?>' + '&waiterid=';
        $.ajax({
            type: "POST",
            url: myurl,
            data: dataString,
            success: function(data) {
                $('#getresult2').html(data);
            }
        });
    });


</script>


   <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>  
   <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>  -->

   <script type="text/javascript">
       $(function() {
               $("#datepicker").datepicker({ dateFormat: "yy-mm-dd" }).val()
       });
   </script>