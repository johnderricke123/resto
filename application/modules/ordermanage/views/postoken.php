<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- Printable area start -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Print Invoice</title>
<script type="text/javascript">
   var pstatus="<?php echo $this->uri->segment(5);?>";
   if(pstatus==0){
       var returnurl="<?php echo base_url('ordermanage/order/pos_invoice'); ?>";
   }
   else{
      var returnurl="<?php echo base_url('ordermanage/order/pos_invoice'); ?>?tokenorder=<?php echo $orderinfo->order_id;?>"; 
   }
   window.print();
          setInterval(function(){
          document.location.href = returnurl;
           }, 3000);
	  
	
</script>
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
@media print {
    .pagebreak { page-break-before: always; } /* page-break-after works, as well */
}
</style>
</head>
<body>
<div id="printableArea" style="width:280px;margin:0 auto;overflow: hidden;float: left;font-size: 13px;">
    <?php
    foreach ($iteminfo as $item) {
    if ($kitchen->kitchenid === $item->kitchenid) {
        echo $kitchen->name;
        }
    }
    ?>

    <?php  foreach ($all_kitchen as $kitchen){ ?>
    <div class="panel-body">
        <div class="table-responsive m-b-20">
            <table border="0" style="width:100%; font-size:14px;">
                <tbody>
                <tr>
                    <td>
                        <table border="0" width="100%">
                            <tbody>
                            <tr>
                                <td align="center">
                                    <h4>Order Slip: <?php echo $orderinfo->tokenno; ?></h4>
                                </td>
                            </tr>
                            <tr><?php $date = new DateTime($orderinfo->order_time);?>
<!--                <td align="center"><nobr><date>--><?php //echo display('token_no')?><!--:--><?php //echo $orderinfo->tokenno;?><!--</nobr></td>-->
                                <td align="center">
                                    <b><?php if(!empty($tableinfo)){ echo display('table').': '.$tableinfo->tablename;}?></b>
                                </td>
                            </tr>
                            <tr>
                                  <td align="center">
                                      <nobr>Order Time: <?php echo $date->format('g:i A');?></nobr>
                                  </td>
                            </tr>
                            <tr>
                                <td align="center">
                                    <nobr><?php echo display('date')?>: <?php echo $date->format('M d, y');?></nobr>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <table width="100%">
                            <tbody>
                            <tr>
                                <th>Qty.</th>
                                <th>Variant/<?php echo display('size') ?></th>
                                <th>Menu/<?php echo display('item') ?></th>
                            </tr>
                            <?php
                            $i = 0;
                            $totalamount = 0;
                            $subtotal = 0;
                            $total = $orderinfo->totalamount;

                            foreach ($iteminfo as $item) {
                                if ($kitchen->kitchenid === $item->kitchenid) {
                                    $i++;
                                    $itemprice = $item->price * $item->menuqty;
                                    $discount = 0;
                                    $adonsprice = 0;

                                    if (!empty($item->add_on_id)) {
                                        $addons = explode(",", $item->add_on_id);
                                        $addonsqty = explode(",", $item->addonsqty);
                                        $x = 0;
                                        foreach ($addons as $addonsid) {
                                            $adonsinfo = $this->order_model->read('*', 'add_ons', array('add_on_id' => $addonsid));
                                            $adonsprice = $adonsprice + $adonsinfo->price * $addonsqty[$x];
                                            $x++;
                                        }
                                        $nittotal = $adonsprice;
                                        $itemprice = $itemprice;
                                    } else {
                                        $nittotal = 0;
                                        $text = '';
                                    }
                                    $totalamount = $totalamount + $nittotal;
                                    $subtotal = $subtotal + $item->price * $item->menuqty;
                                    ?>
                                    <tr>
                                        <td align="left"><?php echo $item->menuqty; ?></td>
                                        <td align="left"><?php echo $item->variantName; ?></td>
                                        <td align="left"><?php echo $item->ProductName; ?>
                                            <br><?php echo $item->notes; ?></td>
                                    </tr>
                                    <?php if (!empty($item->add_on_id)) {
                                        $y = 0;
                                        foreach ($addons as $addonsid) {
                                            $adonsinfo = $this->order_model->read('*', 'add_ons', array('add_on_id' => $addonsid));
                                            $adonsprice = $adonsprice + $adonsinfo->price * $addonsqty[$y]; ?>
                                            <tr>
                                                <td colspan="2">
                                                    <?php echo $adonsinfo->add_on_name; ?>
                                                </td>
                                                <td class="text-right">
                                                    <?php echo $addonsqty[$y]; ?>
                                                </td>
                                            </tr>
                                            <?php $y++;
                                        }
                                    }
                                    $itemtotal = $totalamount + $subtotal;
                                    $calvat = $itemtotal * 15 / 100;

                                    $servicecharge = 0;
                                    if (empty($billinfo)) {
                                        $servicecharge;
                                    } else {
                                        $servicecharge = $billinfo->service_charge;
                                    }
                                    foreach ($exitsitem as $exititem) {
                                        $isexitsitem = $this->order_model->readupdate('tbl_updateitems.*,SUM(tbl_updateitems.qty) as totalqty', 'tbl_updateitems', array('ordid' => $orderinfo->order_id, 'menuid' => $exititem->menu_id, 'varientid' => $exititem->varientid, 'addonsuid' => $exititem->addonsuid));
                                        //print_r($isexitsitem);
                                        if (!empty($isexitsitem)) {
                                            if ($isexitsitem->qty > 0) {
                                                $itemprice = $exititem->price * $isexitsitem->qty;
                                                ?>
                                                <tr>
                                                    <td align="left">
                                                        <?php echo $isexitsitem->isupdate; ?><?php echo $isexitsitem->totalqty; ?>
                                                    </td>
                                                    <td align="left">
                                                        <?php echo $exititem->ProductName; ?>
                                                        <br>
                                                        <?php echo $exititem->notes; ?>
                                                    </td>
                                                    <td align="left">
                                                        <?php echo $exititem->variantName; ?>
                                                    </td>
                                                </tr>
                                            <?php }
                                        }
                                    }
                                }
                            } ?>
                            <tr>
                                <td colspan="5" style="border-top:#333 1px dashed;">
                                    <nobr></nobr>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <?php if (!empty($tableinfo)) {
                            echo $orderinfo->kitchenid . ' ' . $kitchen->kitchen_name;
                        }?>
                        | By: <?php echo $waiter->firstname.' '.$waiter->lastname; ?>
                    </td>
                </tr>
                <tr><td align="center"><sup>TXN No.: <?php  echo $orderinfo->order_id; ?></sup></td></tr>
                </tbody>
            </table>
        </div>
    </div>
        <div class="pagebreak"> </div>
        <?php
    } ?>
</div>
</body>
</html>
