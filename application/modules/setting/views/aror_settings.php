<link href="<?php echo base_url('assets/admin/plugins/iCheck/all.css')?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/admin')?>/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/admin')?>/plugins/fullcalendar/fullcalendar.print.css" rel="stylesheet" type="text/css" media='print' />
<link rel="stylesheet" href="<?php echo base_url('assets/front') ?>/js/datepicker3.css">
<link href="<?php echo base_url('assets/admin/plugins/toastr')?>/toastr.min.css" rel="stylesheet" type="text/css" media="all" />

<link href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css" rel="stylesheet" type="text/css"/>

<style>
    .datepicker table tr td.disabled, .datepicker table tr td.disabled:hover {
        background: #CCCCCC;
        color: #444;
        cursor: default;
    }

    .ar_row:hover td {
    background: #AAF0FF !important;
    }
</style>
<?php 
//var_dump("testing");die();
// var_dump($or['date_time']);die();
?> 


<section class="content">
    <!-- <div class="row">
        <div class="col-md-12">
            <div class="btn-group pull-right">
                <a class="btn btn-success" id="addArOr" href="#"><i class="fa fa-plus"></i> Add</a>
            </div>

        </div>
    </div> -->

    <div id="divModal">
    </div>


    <?php
        //var_dump($or[0]->or_code); 
        //echo "<br>";
    ?>

<div class="row" style="padding: 10px;">
    <form method="post">
        <div class="col-sm-2">
            <!-- <label for="start_date">Start Date</label> -->
            <input id="datepicker" class="form-control" placeholder="Start" name="start_date" value="<?php echo $start_date; ?>" />
        </div>
        <div class="col-sm-2">
            <!-- <label for="end_date">End Date</label> -->
            <input id="datepicker2" class="form-control" placeholder="End" name="end_date" value="<?php echo $end_date; ?>" />
        </div>
        <div class="col-sm-2">            
            <button type="submit" name="submit_button" class="btn btn-primary btn-sm">Submit</button>
        </div>
    </form>
</div>

<script src="<?php //echo base_url('assets/admin')?>/plugins/fullcalendar/moment.min.js" type="text/javascript"></script>
<script src="<?php //echo base_url('assets/admin')?>/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
<script>
     //$('.datepicker').datepicker();
</script>

<?php //var_dump($ar_or['invoice']);die(); ?>
    <table class="table table-hover" id="example" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th>OR Code</th>
                <th>AR Code</th>
                <th>Invoice</th>
                <th>Name</th>
                <th>Amount</th>
                <th>Date</th>
            </tr>
        </thead>

        <tbody>
            <?php $a = 0; foreach($ar_or['ar_or'] as $key => $val): 
                
                ?>
            <tr style="background-color: #aeff78;">
                <td> <label><?php echo "OR#".$key; ?></label> </td>
                <td></td>
                <td></td>
                <td></td>
                <td><label id="total<?php echo $a; ?>"></label></td>
                <td></td>
            </tr>
            <?php $total = 0; $i=0; foreach($ar_or['ar_or'][$key] as $arval):  ?>
                <tr class="ar_row">
                    <td></td>
                  <!--<td> <label> <?php if($arval){ echo "AR#".$arval;}else{ echo "No AR#"; } ?> </label></td>-->
                  <td> <?php if($arval){ ?> <label><?php echo "AR#".$arval; ?></label>  <?php } ?>  <?php if(!$arval){ ?> <label style="color: #9b9b9b;">No AR#</label> <?php } ?> </td>
                  
                    <td> <label> <?php echo $ar_or['invoice'][$key][$i]; ?> </label></td>
                    <td> <label> <?php echo $ar_or['customer_name'][$key][$i]; ?> </label></td>
                    <td> <label> <?php echo $ar_or['amount'][$key][$i] ?> </label></td>
                    <td> <label> <?php echo $ar_or['date'][$key][$i] ?> </label></td>
                </tr>
                <?php $total += $ar_or['amount'][$key][$i]; $i++; endforeach; ?>
                <script>
                    var total = <?php echo $total; ?>;
                    $('#total<?php echo $a;?>').html(total.toFixed(2));
                    //alert(total);
                </script>
            <?php $a++; endforeach; ?>
        </tbody>
    </table>





    

</section>







<script type="text/javascript">
    var TableBackgroundNormalColor = "#ffffff";
    var TableBackgroundMouseoverColor = "#87d7ff";
    function ChangeBackgroundColor(row) { row.style.backgroundColor = TableBackgroundMouseoverColor; }
    function RestoreBackgroundColor(row) { row.style.backgroundColor = TableBackgroundNormalColor; }

    var TableBackgroundNormalColorOR = "#ffffff";
    var TableBackgroundMouseoverColorOR = "#f3ffbd";
    function ChangeBackgroundColorOR(row) { row.style.backgroundColor = TableBackgroundMouseoverColorOR; }
    function RestoreBackgroundColorOR(row) { row.style.backgroundColor = TableBackgroundNormalColorOR; }
</script>

<script src="https://cdn.datatables.net/2.0.7/js/dataTables.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.dataTables.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js" type="text/javascript"></script>











<script type="text/javascript">

  $( function() {
    // $( "#datepicker, #datepicker2" ).datepicker();
    var date = $('#datepicker, #datepicker2').datepicker({ dateFormat: 'yy-mm-dd' }).val();
  } );

new DataTable('#example', {
    info: false,
    ordering: false,
    paging: false,
    searching: false,

    layout: {
        topStart: {
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
        }
    }
});

// $(function() {
//         $('.datepicker2').datepicker({
//             autoclose: true,
//             format: 'dd-M-yyyy',
//         }).on('changeDate', function (selected) {
//             var date1	= $(".datepicker1").datepicker('getDate');
//             var date2	= $(".datepicker2").datepicker('getDate');
//             if(date2<=date1){
//                 toastr.error('Checkout Date Must Be Greater Then Checkout Date');
//                 $('.datepicker2').val('');
//                 $('.datepicker1').focus();
//             }
//         });
// });

    // $("#preview").click(function(){
    //     var date1	= $(".datepicker1").datepicker('getDate');
    //     var date2	= $(".datepicker2").datepicker('getDate');
    //     var count = $("#room_count").val();

    //     if(date2 <= date1){
    //         toastr.error('Checkout Date Must Be Greater Then Checkout Date');
    //         $('.datepicker2').val('');
    //         $('.datepicker1').focus();
    //     }else{

    //             check_availbility();
    //     }
    // });






    // $(function() {
    //     $('#example1, #example2').dataTable({});

    // });
</script>

