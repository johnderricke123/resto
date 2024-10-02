<!--<div id="printableArea" class="main-div" style="width:320px;margin:0 auto;overflow: hidden;float: left;font-size: 13px;">-->
    <?php
//    $has_item = 0;
//    foreach ($iteminfo as $item) {
//        if ($kitchen_id === $item->kitchenid) {
//                $has_item += 1;
//            }
//    }
//    if($has_item === 0){
//        return $has_item;
//    }
    ?>

    <?php //foreach ($all_kitchen as $kitchen){?>
<style>
    .page_break { page-break-before: always; }
    @page {
        margin: 0 !important;
        padding: 0 !important;
        size: auto;
    }
    .display-none {
        display: none;
    }

</style>
    <div class="page panel-body <?php echo $kitchen_name; ?>" >
        <div class="table-responsive">
            <table border="0" style="width:100%; font-size:14px;">
                <tbody>
                <tr>
                    <td>
                        <table border="0" width="98%">
                            <tbody>
                            <tr>
                                <td align="center">
                                    <h4>Order Slip: <?php echo $orderinfo->tokenno; ?></h4>
                                </td>
                            </tr>
                            <tr><?php $date = new DateTime($orderinfo->order_time);?>
<!--                <td align="center"><nobr><date>--><?php //echo display('token_no')?><!--:--><?php //echo $orderinfo->tokenno;?><!--</nobr></td>-->
                                <td align="center">
                                    <b><?php
                                        if(!empty($tableinfo)){
                                            echo display('table').': '.$tableinfo->tablename;
                                        }
                                        if($ctype) {
                                            echo $ctype;
                                        }
                                        ?></b>
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
                            <thead>
                            <tr>
                                <th>Qty.</th>
                                <th>Variant/<?php echo display('size') ?></th>
                                <th>Menu/<?php echo display('item') ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 0;
                            $totalamount = 0;
                            $subtotal = 0;
                            $total = $orderinfo->totalamount;

                            foreach ($iteminfo as $item) {
                                if ($kitchen_id === $item->kitchenid) {
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
                                        <td align="center"><?php echo $item->menuqty; ?></td>
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
                                                <!-- <tr>
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
                                                </tr> -->
                                            <?php }
                                        }
                                    }
                                }
                            } ?>
                            <tr>
                                <td colspan="3" style="border-top:#333 1px dashed;">
                                    <nobr></nobr>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <?php if ($orderinfo->kitchenid) {
                            echo $orderinfo->kitchenid . ' ' . $kitchen_name;
                        }?>
                      
                      <?php if($kitchen_name) {
                              echo $kitchen_name;
                            } ?>
                        | Waiter: <?php echo $waiter->first_name.' '.$waiter->last_name; ?>
                    </td>
                </tr>
                <tr><td align="center"><sup>TXN No.: <?php  echo $orderinfo->order_id; ?></sup></td></tr>
                </tbody>
            </table>
        </div>
    </div>
        <div class="pagebreak page_break"> </div>
        <?php
   // } ?>
<!--</div>-->
<!--<script>-->
<!--    const divs = document.getElementsByClassName('main-div');-->
<!---->
<!--    for (let x = 0; x < divs.length; x++) {-->
<!--        const div = divs[x];-->
<!--        const content = div.textContent.trim();-->
<!---->
<!--        if (content == 'Handtekening' || content == 'Thuis') {-->
<!--            div.style.display = 'none';-->
<!--        }-->
<!--    }-->
<!--</script>-->