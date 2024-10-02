<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- Printable area start -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Print Invoice</title>
    <!-- Bootstrap -->
    <style>
        @page
        {
            size: auto;   /* auto is the initial value */

            /* this affects the margin in the printer settings */
            margin: 0mm 0 0mm 0;
        }

        body
        {
            /* this affects the margin on the content before sending to printer */
            margin: 0px;
        }
        @media screen {
            .header, .footer {
                display: none;
            }
        }
        .mb-0 {
            margin-bottom: 0;
        }

        .my-50 {
            margin-top: 50px;
            margin-bottom: 50px;
        }

        .my-0 {
            margin-top: 0;
            margin-bottom: 0;
        }

        .my-5 {
            margin-top: 5px;
            margin-bottom: 5px;
        }

        .mt-10 {
            margin-top: 10px;
        }

        .mb-15 {
            margin-bottom: 15px;
        }

        .mr-18 {
            margin-right: 18px;
        }

        .mr-25 {
            margin-right: 25px;
        }

        .mb-25 {
            margin-bottom: 25px;
        }
        .h4, .h5, .h6, h4, h5, h6 {
            margin-top: 10px;
            margin-bottom: 10px;
        }
        .login-wrapper {
            background: url(../img/bhojon/login-bg.jpg) no-repeat;
            background-size: 100% 100%;
            height: 100vh;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .login-wrapper:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            display: block;
            background: rgba(0, 0, 0, 0.5);
        }

        .login_box {
            text-align: center;
            position: relative;
            width: 400px;
            background: #343434;
            padding: 40px 30px;
            border-radius: 10px;
        }

        .login_box .form-control {
            height: 60px;
            margin-bottom: 25px;
            padding: 12px 25px;
        }

        .btn-login {
            color: #fff;
            background-color: #45C203;
            border-color: #45C203;
            width: 100%;
            line-height: 45px;
            font-size: 17px;
        }

        .btn-login:hover,
        .btn-login:focus {
            color: #fff;
            background-color: transparent;
            border-color: #fff;
        }

        /*Bhojon List*/

        .invoice-card {
            display: flex;
            flex-direction: column;
            padding: 25px;
            width:300px;
            background-color: #fff;
            border-radius: 5px;
            /* box-shadow: 0px 10px 30px 15px rgba(0, 0, 0, 0.05);*/
            margin: 35px auto;
        }

        .invoice-head,
        .invoice-card .invoice-title {
            display: -webkit-flex;
            display: -moz-flex;
            display: -ms-flex;
            display: -o-flex;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .invoice-head {
            flex-direction: column;
            margin-bottom: 25px;
        }

        .invoice-card .invoice-title {
            margin: 15px 0;
        }

        .invoice-title span {
            color: rgba(0, 0, 0, 0.4);
        }

        .invoice-details {
            border-top: 0.5px dashed #747272;
            border-bottom: 0.5px dashed #747272;
        }

        .invoice-list {
            width: 100%;
            border-collapse: collapse;
            border-bottom: 1px dashed #858080;
        }

        .invoice-list .row-data {
            border-bottom: 1px dashed #858080;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .invoice-list .row-data:last-child {
            border-bottom: 0;
            margin-bottom: 0;
        }

        .invoice-list .heading {
            font-size: 16px;
            font-weight: 600;
            margin: 0;
        }

        .invoice-list thead tr td {
            font-size: 15px;
            font-weight: 600;
            padding: 5px 0;
        }

        .invoice-list tbody tr td {
            line-height: 25px;
        }

        .row-data {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            width: 100%;
        }

        .middle-data {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .item-info {
            max-width: 200px;
        }

        .item-title {
            font-size: 14px;
            margin: 0;
            line-height: 19px;
            font-weight: 500;
        }

        .item-size {
            line-height: 19px;
        }

        .item-size,
        .item-number {
            margin: 5px 0;
        }

        .invoice-footer {
            margin-top: 20px;
        }

        .gap_right {
            border-right: 1px solid #ddd;
            padding-right: 15px;
            margin-right: 15px;
        }

        .b_top {
            border-top: 1px solid #ddd;
            padding-top: 12px;
        }


        .food_item {
            display: -webkit-flex;
            display: -moz-flex;
            display: -ms-flex;
            display: -o-flex;
            display: flex;
            align-items: center;
            border: 1px solid #ddd;
            border-top: 5px solid #1DB20B;
            padding: 15px;
            margin-bottom: 25px;
            transition-duration: 0.4s;
        }

        .bhojon_title {
            margin-top: 6px;
            margin-bottom: 6px;
            font-size: 14px;
        }

        .food_item .img_wrapper {
            padding: 15px 5px;
            background-color: #ececec;
            border-radius: 6px;
            position: relative;
            transition-duration: 0.4s;
        }

        .food_item .table_info {
            font-size: 11px;
            background: #1db20b;
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 4px 8px;
            color: #fff;
            border-radius: 15px;
            text-align: center;
        }

        .food_item:focus,
        .food_item:hover {
            background-color: #383838;
        }

        .food_item:focus .bhojon_title,
        .food_item:hover .bhojon_title {
            color: #fff;
        }

        .food_item:hover .img_wrapper,
        .food_item:focus .img_wrapper {
            background-color: #383838;
        }

        .btn-4 {
            border-radius: 0;
            padding: 15px 22px;
            font-size: 16px;
            font-weight: 500;
            color: #fff;
            min-width: 130px;
        }

        .btn-4.btn-green {
            background-color: #1DB20B;
        }

        .btn-4.btn-green:focus,
        .btn-4.btn-green:hover {
            background-color: #3aa02d;
            color: #fff;
        }

        .btn-4.btn-blue {
            background-color: #115fc9;
        }

        .btn-4.btn-blue:focus,
        .btn-4.btn-blue:hover {
            background-color: #305992;
            color: #fff;
        }

        .btn-4.btn-sky {
            background-color: #1ba392;
        }

        .btn-4.btn-sky:focus,
        .btn-4.btn-sky:hover {
            background-color: #0dceb6;
            color: #fff;
        }

        .btn-4.btn-paste {
            background-color: #0b6240;
        }

        .btn-4.btn-paste:hover,
        .btn-4.btn-paste:focus {
            background-color: #209c6c;
            color: #fff;
        }

        .btn-4.btn-red {
            background-color: #eb0202;
        }

        .btn-4.btn-red:focus,
        .btn-4.btn-red:hover {
            background-color: #ff3b3b;
            color: #fff;
        }
        .text-center {
            text-align: center;
        }
    </style>

</head>

<body>
<style>
    .modal-inner {
        max-width: 1270px;
        width: 100%;
    }

    .info_part {
        margin-bottom: 30px;
    }



    .table-topper {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 15px;
    }

    .table-modal tr th {
        text-align: center;
    }

    .table-modal tr td .btn-del {
        padding: 0;
        background: transparent;
    }

    .table-modal tr td .btn i {
        font-size: 17px;
        color: #ff6e6e;
    }

    .table-info>tbody>tr>td {
        vertical-align: middle;
        text-align: center;
        font-size: 14px;
    }

    .table-title>tbody>tr>td {
        border: 0;
        font-size: 14px;
        padding: 2px;
        color: #676767;
        font-weight: 500;
        line-height: 15px;
    }

    .table-title>tbody>tr>td:last-child {
        text-align: right;
    }

    .table-img {
        max-width: 75px;
        margin: 0;
    }

    .btn-clear {
        min-width: 75px;
        background: #37a000;
        color: #fff;
        line-height: 20px;
        font-size: 13px;
        font-weight: 600;
    }

    .btn-clear:hover {
        background: #00a047;
        color: #fff;
    }

    .table-title {
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 0;
        max-width: 135px;
    }

    .modal-inner .modal-header,
    .modal-inner .modal-body,
    .modal-inner .modal-footer {
        padding: 15px 30px;
    }

    .table-bordered>thead>tr>td,
    .table-bordered>thead>tr>th {
        text-align: center;
        font-size: 12px;
    }


    .table-info {
        background: #f1f1f1;
        border: solid 1px #dcdbd9;
        border-spacing: 0;
    }

    .table-info tr {
        width: 100%;
        display: table;
        table-layout: fixed;
    }

    .table-info tr th,
    .table-info tr td {
        display: table-cell;
        padding: 0.5rem;
        text-align: left;
    }

    .table-info thead {
        display: table;
        width: 100%;
    }

    .table-info thead.ws {
        width: calc(100% - 17px);
    }

    .table-info thead th {
        border-bottom: solid 1px #dcdbd9;
        color: #4e4e4e;
        font-weight: bold;
        line-height: 1rem;
        text-transform: uppercase;
    }

    .table-info tbody {
        display: block;
        max-height: 12rem;
        overflow: auto;
    }

    .table-info tbody tr {
        background-color: white;
    }


    .table-info tbody tr:nth-child(even) {
        background-color: #fcfcfc;
    }

    .table-info tbody tr:not(:last-child) {
        border-bottom: solid 1px #ddd;
    }

    .table-info tbody tr td {
        color: #4e4e4e;
        line-height: 2rem;
        border: 1px solid #ddd;
    }

    .add_form {
        display: -webkit-flex;
        display: -moz-flex;
        display: -ms-flex;
        display: -o-flex;
        display: flex;
        max-width: 200px;
    }

    .add_input {
        border: 1px solid #dcdbd9;
        border-radius: 0;
    }

    .add_input:focus {
        border-color: #333333;
        outline: 0;
        -webkit-box-shadow: none;
        box-shadow: none;
    }

    .add_btn {
        border-radius: 0;
        margin-left: 5px;
        font-size: 12px;
        background-color: #333;
        border: 1px solid #333;
        color: #fff;
    }

    .add_btn:focus,
    .add_btn:hover {
        background-color: #37a000;
        border: 1px solid #37a000;
        color: #fff;
    }

    .extra_elem {
        display: -webkit-flex;
        display: -moz-flex;
        display: -ms-flex;
        display: -o-flex;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .booked .table-info {
        background: #de2222;
        border: solid 1px #de2222;
    }

    .booked .table-bordered>thead>tr>th{
        color: #fff;
    }

    .booked .table-info tbody tr td {
        border: 1px solid #de2222;
    }

</style>


<div id="payprint_marge" class="modal-dialog modal-inner" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><ul class="nav nav-tabs" role="tablist">
                    <?php
                    if(!empty($tablefloor)){
                        $f=0;
                        foreach($tablefloor as $floor){
                            $f++;
                            ?>
                            <li class="<?php if($f==1){ echo "active";}?>"> <a href="#floor<?php echo $floor->tbfloorid;?>" id="florlist<?php echo $f;?>" role="tab" data-toggle="tab" class="home" onclick="showfloor(<?php echo $floor->tbfloorid;?>)"><?php echo $floor->floorName;?></a> </li>
                        <?php } } ?>
                </ul><?php //echo display('table_map');?></h4>
        </div>
        <div class="modal-body">

            <div class="tab-content">
                <?php
                if(!empty($tablefloor)){
                    $a=0;
                    foreach($tablefloor as $floor){
                        $a++;
                        ?>
                        <div class="tab-pane fade <?php if($a==1){echo "active in";}?>" id="floor<?php echo $floor->tbfloorid;?>"></div>
                    <?php } } ?>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" onclick="multi_table()"class="btn btn-success btn-md"><?php echo display('submit')?></button>
            <button type="button" class="btn btn-danger btn-md" data-dismiss="modal"><?php echo display('cancel')?></button>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $("#florlist1").trigger("click");
    });

    function showfloor(floorid){
        var geturl='fllorwisetable';
        var dataString = "floorid="+floorid;
        $.ajax({
            type: "POST",
            url: geturl,
            data: dataString,
            success: function(data) {
                $('#floor'+floorid).html(data);
            }
        });
    }
</script>

