<script src="<?php echo base_url();?>assets/js/jquery.validate.min.js" type="text/javascript"></script>
<style>
.listcat{
      color: #fff;
    background: #37a000;
    box-shadow: inset 0 0 0 0 rgba(0,0,0,.4), -2px -3px 5px -2px rgba(0,0,0,.4);
    cursor:pointer;
    padding:5px;
  }
  .tab-pane table tr th, .tab-pane table tr td {
    text-align: unset;
}
</style>
<div id="edit" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <strong><?php //echo display('unit_update');?></strong>
            </div>
            <div class="modal-body addonsinfo">
            
            </div>
     
            </div>
            <div class="modal-footer">

            </div>

        </div>

    </div>
    <div id="items" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <strong><?php echo "Item Information";?></strong>
            </div>
            <div class="modal-body iteminfo">
            
            </div>
     
            </div>
            <div class="modal-footer">

            </div>

        </div>

    </div>                              
    <div class="row">
        <div class="col-sm-12 col-md-12">
                    <div class="panel">
                            <fieldset class="border p-2">
                               <legend  class="w-auto"><?php echo "Update Order" ?></legend>
                            </fieldset>
                             <input name="url" type="hidden" id="posurl_update" value="<?php echo base_url("ordermanage/order/getitemlist") ?>" />
                            <input name="url" type="hidden" id="productdata" value="<?php echo base_url("ordermanage/order/getitemdata") ?>" />
                            <input name="url" type="hidden" id="updatecarturl" value="<?php echo base_url("ordermanage/order/addtocartupdate") ?>" />
                            <input name="url" type="hidden" id="cartupdateturl" value="<?php echo base_url("ordermanage/order/poscartupdate") ?>" />
                            <input name="url" type="hidden" id="addonexsurl" value="<?php echo base_url("ordermanage/order/posaddonsmenu") ?>" />
                            <input name="url" type="hidden" id="removeurl" value="<?php echo base_url("ordermanage/order/removetocart") ?>" />
                            <div class="row">
                                <div class="col-sm-7">
                                    <div class="row">
                                        <div class="col-md-12">
                                                   <form class="navbar-search" method="get" action="<?php echo base_url("ordermanage/order/pos_invoice")?>" >
                                           
                                                        <div class="input-group">
                                                           <label class="sr-only screen-reader-text" for="update_product_name"><?php echo display('search')?>:</label>
                                                              <select id="update_product_name" class="form-control dont-select-me  update_search_field" dir="ltr" name="s">
                                                              </select>   
                                                        </div>
                                        			</form>
                                        </div>
                                    </div>
                                    <div class="row">
                                            <div class="col-sm-2">
                                                <div class="product-category">
                                                        <div class="listcat" onclick="getslcategory_update('')">All</div>
                                                        <?php $result = array_diff($categorylist, array("Select Food Category"));
                                                            foreach($result as $key=>$test){ ?>
                                                           <div class="listcat" onclick="getslcategory_update(<?php echo $key;?>)"><?php echo $test;?></div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="col-sm-10">
                                                <div class="product-grid">
                                                    <div class="row row-m-3" id="product_search_update">
                                                    <?php $i=0;
                                                        foreach($itemlist as $item){
                                                            $item=(object)$item;
                                                            $i++;
                                                            if($item->isgroup==1){
                                                                $isgroupid=1;
                                                            }
                                                            else{
                                                                $isgroupid=0;
                                                                }
                                                            $this->db->select('*');
                                                                        $this->db->from('menu_add_on');
                                                                        $this->db->where('menu_id',$item->ProductsID);
                                                                        $query = $this->db->get();
                                                                        $getadons="";
                                                                        if ($query->num_rows() > 0) {
                                                                        $getadons = 1;
                                                                        }
                                                                        else{
                                                                            $getadons =  0;
                                                                            }
                                                            ?>
                                                        <div class="col-xs-6 col-sm-4 col-md-4 col-lg-3 col-p-3">
                                                        <div class="panel panel-bd product-panel update_select_product">
                                                                <div class="panel-body">
                                                                                    <img src="<?php echo base_url(!empty($item->ProductImage)?$item->ProductImage:'assets/img/icons/default.jpg'); ?>" class="img-responsive" alt="<?php echo $item->ProductName;?>">
                                                    		<input type="hidden" name="update_select_product_id" class="select_product_id" value="<?php echo $item->ProductsID;?>">
                                                    		<input type="hidden" name="update_select_totalvarient" class="select_totalvarient" value="<?php echo $item->totalvarient;?>">
                                  							<input type="hidden" name="update_select_iscustomeqty" class="select_iscustomeqty" value="<?php echo $item->is_customqty;?>">
                                                            <input type="hidden" name="update_select_product_size" class="select_product_size" value="<?php echo $item->variantid;?>">
                                                            <input type="hidden" name="update_select_product_isgroup" class="select_product_isgroup" value="<?php echo $isgroupid;?>">
                                                            <input type="hidden" name="update_select_product_cat" class="select_product_cat" value="<?php echo $item->CategoryID;?>">
                                                            <input type="hidden" name="update_select_varient_name" class="select_varient_name" value="<?php echo $item->variantName;?>">
                                                        <input type="hidden" name="update_select_product_name" class="select_product_name" value="<?php echo $item->ProductName; if(!empty($item->itemnotes)){ echo " -".$item->itemnotes;}?>">
                                                            <input type="hidden" name="update_select_product_price" class="select_product_price" value="<?php echo $item->price;?>">
                                                            <input type="hidden" name="update_select_addons" class="select_addons" value="<?php echo $getadons;?>">
                                                                                </div>
                                                                                            <div class="panel-footer"><span><?php echo $item->ProductName;?> (<?php echo $item->variantName;?>)<?php if(!empty($item->itemnotes)){ echo " -".$item->itemnotes;}?></span></div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <?php } ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                    </div>
                                </div>
                                 <?php echo form_open_multipart('ordermanage/order/modifyoreder',array('class' => 'form-vertical', 'id' => 'insert_purchase','name' => 'insert_purchase'))?>
                                <div class="col-sm-5">
                                 
                           <input name="url" type="hidden" id="url" value="<?php echo base_url("ordermanage/order/itemlistselect") ?>" />
                            <input name="url" type="hidden" id="addonsurl" value="<?php echo base_url("ordermanage/order/addonsmenu") ?>" />
                            <input name="url" type="hidden" id="updatecarturl" value="<?php echo base_url("ordermanage/order/addtocartupdate") ?>" />
                            <input name="url" type="hidden" id="delurl" value="<?php echo base_url("ordermanage/order/deletetocart") ?>" />
                            <input name="updateid" type="hidden" id="uidupdateid" value="<?php echo $orderinfo->order_id;?>" />
                            <input name="custmercode" type="hidden" id="custmercode" value="<?php echo $customerinfo->cuntomer_no;?>" />
                            <input name="custmername" type="hidden" id="custmername" value="<?php echo $customerinfo->customer_name;?>" />
                            <input name="saleinvoice" type="hidden" id="saleinvoice" value="<?php echo $orderinfo->saleinvoice;?>" />   
                            <div class="row">
                                    <!--<div class="col-md-6 form-group">
                                            <label for="customer_name"><?php echo display('customer_name');?> <span class="color-red">*</span></label>
                                            <div class="d-flex">
                                            <?php $cusid=1;
                                                echo form_dropdown('customer_name',$customerlist,(!empty($orderinfo->customer_id)?$orderinfo->customer_id:null),'class="postform resizeselect form-control" id="customer_name_update" required') ?>
                                            <button type="button" class="btn btn-primary ml-l" aria-hidden="true" data-toggle="modal" data-target="#client-info"><i class="ti-plus"></i></button>
                                            </div>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="store_id"><?php echo display('customer_type');?> <span class="color-red">*</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                        <?php $ctype=1;
                                            echo form_dropdown('ctypeid',$curtomertype,(!empty($orderinfo->cutomertype)?$orderinfo->cutomertype:null),'class="form-control" id="ctypeid_update" required') ?>
                                    </div>-->
                              
                                     <div class="col-md-6 form-group" id="update_default_customer_name">
                                        <label for="customer_name_update"><?php echo display('customer_name');?><span class="color-red">*</span></label>
                                        <div class="d-flex">
                                          <?php $cusid=1;
                                          echo form_dropdown('customer_name',$customerlist,(!empty($cusid)?$cusid:null),'class="postform resizeselect form-control" id="customer_name_update" required') ?>
                                          <button type="button" class="btn btn-primary ml-l" aria-hidden="true" data-toggle="modal" data-target="#client-info"><i class="ti-plus"></i></button>
                                        </div>
                                      </div>
                                      <div class="col-md-6 form-group" id="update_active_hotel_customer">
                                          <label for="update_hotel_customer_name">Active Hotel Guest <span class="color-red">*</span></label>
                                          <div class="d-flex">
                                              <?php  $agid=2;
                                              echo form_dropdown('hotel_customer_name',$active_hotel_customer,(!empty($agid)?$agid:null),'class="postform resizeselect form-control" id="update_hotel_customer_name" required') ?>
                                          </div>
                                      </div>
                                    <div class="col-md-6 form-group">
                                      <label for="tableid"><?php echo display('customer_type');?> <span class="color-red">*</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                      <?php $ctype=1;
                                      echo form_dropdown('ctypeid',$curtomertype,(!empty($ctype)?$ctype:null),'class="form-control" id="ctypeid_update" required') ?>
                                    </div>
                                    <div id="nonthirdparty_update" class="col-md-12">
                                        <div class="row">
                                        <?php if($possetting->waiter==1){?>
                                                <div class="col-md-6 form-group">
                                                    <label for="waiter"><?php echo display('waiter');?> <span class="color-red">*</span>&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                                  
                                                    <?php $waiter_id = $orderinfo->waiter_id;
                                                                     
                                                 //   if(!$this->session->userdata('isAdmin')) {
                                                  //      echo  '<select name="waiter" id="waiter" class="form-control" readonly tabindex="-1" aria-hidden="true"><option value="'.$waiter_id.'" selected="selected">'.$this->session->userdata('fullname').'</option></select>';
                                               //     }else {
                                                      
                                                        echo form_dropdown('waiter',$waiterlist,$waiter_id,' class="form-control" id="waiter" required');
                                                 //   }    ?>
                                                </div>
                                                 <?php } 
													if($possetting->tableid==1){
												?>
                                                <div class="col-md-6 form-group" id="tblsec_update" style="display:none;">
                                                    <label for="tableid_update"><?php echo display('table');?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="color-red">*</span></label>
                                                     <?php echo form_dropdown('tableid',$tablelist,(!empty($orderinfo->table_no)?$orderinfo->table_no:null),'class="form-control" readonly id="tableid_update" name="tableid_update" required') ?>
                                                </div>
                                                <?php } ?>
                                        </div>
                                      </div>
                                      <div id="thirdparty_update" class="col-md-12" style="display:none;">
                                        <div class="form-group">
                                                <label for="store_id"><?php echo display('del_company');?> <span class="color-red">*</span>&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                                <?php echo form_dropdown('delivercom',$thirdpartylist,(!empty($orderinfo->isthirdparty)?$orderinfo->isthirdparty:null),'class="form-control" style="width:95%;" id="delivercom_update" required disabled="disabled"') ?>
                                        </div>
                                        </div>
                                        <div class="form-group">
                                                     <input class="form-control" type="hidden" id="order_date" name="order_date" required value="<?php echo date('d-m-Y')?>" />
                                                    <input class="form-control" type="hidden" id="bill_info" name="bill_info" required value="<?php echo $billinfo->bill_status;?>" />
                                                    <input type="hidden" id="card_type" name="card_type" value="<?php echo $billinfo->payment_method_id;?>" />
                                                    <input type="hidden" id="orderstatus" name="orderstatus" value="<?php echo $orderinfo->order_status;?>" />
                                                    <input type="hidden" id="assigncard_terminal" name="assigncard_terminal" value="" />
                                                    <input type="hidden" id="assignbank" name="assignbank" value="" />
                                                    <input type="hidden" id="assignlastdigit" name="assignlastdigit" value="" />
                                                    <input type="hidden" id="product_value" name="">
                                        </div>
                               
                            </div>
                            <div class="product-list">
                                   <div id="updatefoodlist">
                                
                            
                               <div class="table-wrapper-scroll-y productclist">
                               	<div class="table-responsive">
                                <table class="table table-fixed table-bordered table-hover bg-white" id="purchaseTable">
                                <thead>
                                     <tr>
                                            <th class="text-center"><?php echo display('item')?> </th>
                                            <th class="text-center">Variant/Size</th>
                                            <th class="text-center" style="width:100px;"><?php echo display('unit_price')?></th> 
                                            <th class="text-center" style="width:100px;"><?php echo display('quantity');?></th> 
                                            <th class="text-center"><?php echo display('total_price')?></th> 
                                            <th class="text-center"><?php echo display('action')?></th> 
                                        </tr>
                                </thead>
                                <tbody>
                                <?php  $this->load->model('ordermanage/order_model','ordermodel');
                                $i=0; 
                                  $totalamount=0;
                                      $subtotal=0;
                                      $pvat=0;
                                      $total=$orderinfo->totalamount;
									  $pdiscount=0;
									   $discount=0;
                                    foreach ($iteminfo as $item){
                                        $i++;

                                      
										//print_r($item);
										if($item->isgroup==1){
											$isgroupidp=1;
											$isgroup=$item->menu_id;
										}
										else{
											$isgroupidp=0;
											$isgroup=0;
											}
                                        $itemprice= $item->price*$item->menuqty;
                                        $iteminfo=$this->ordermodel->getiteminfo($item->menu_id);
                                        $vatcalc=$itemprice*$iteminfo->productvat/100;
                                        $pvat=$pvat+$vatcalc;
										if($iteminfo->OffersRate>0){
											$mypdiscount=$iteminfo->OffersRate*$itemprice/100;
											$pdiscount=$pdiscount+($iteminfo->OffersRate*$itemprice/100);
											}
										else{
											$mypdiscount=0;
											$pdiscount=$pdiscount+0;
										}
                                       
                                        $adonsprice=0;
                                        if(!empty($item->add_on_id)){
                                            $addons=explode(",",$item->add_on_id);
                                            $addonsqty=explode(",",$item->addonsqty);
                                            $text='&nbsp;&nbsp;<a class="text-right adonsmore" onclick="expand('.$i.')">More..</a>';
                                            $x=0;
                                            foreach($addons as $addonsid){
                                                    $adonsinfo=$this->order_model->read('*', 'add_ons', array('add_on_id' => $addonsid));
                                                    $adonsprice=$adonsprice+$adonsinfo->price*$addonsqty[$x];
                                                    $x++;
                                                }
                                            $nittotal=$adonsprice;
                                            $itemprice=$itemprice+$adonsprice;
                                            }
                                        else{
                                            $nittotal=0;
                                            $text='';
                                            }
                                         $totalamount=$totalamount+$nittotal;
                                         $subtotal=$subtotal+$nittotal+$item->price*$item->menuqty;
                                    ?>
                                    <tr>
                                        <td class="text-left" align="left">
                                        <?php echo $item->ProductName;?><?php echo $text;?> <a class="serach" onclick="itemnote('<?php echo $item->row_id;?>','<?php echo $item->notes;?>',<?php echo $item->order_id;?>,1,<?php echo $isgroup;?>)" style="padding-left:15px;" title="<?php echo display('foodnote') ?>"> <i class="fa fa-sticky-note" aria-hidden="true"></i> </a>
                                        </td>
                                        <td>
                                        <?php echo $item->variantName;?>
                                        </td>
                                        <td class="text-right"><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo number_format($item->price, 2,'.','');?> <?php if($currency->position==2){echo $currency->curr_icon;}?> </td>
<!-- original code
                                        <td class="text-center" style="text-align: center;"> <?php if($item->food_status!=1){?><a class="btn btn-danger btn-sm btnrightalign" disabled onclick="positemupdate(<?php echo $item->menu_id?>',<?php echo number_format($item->menuqty, 0);?>,'<?php echo $item->order_id;?>','<?php echo $item->varientid?>','<?php echo $isgroupidp;?>','<?php echo $item->addonsuid?>','del')"><i class="fa fa-minus" aria-hidden="true"></i></a><?php } ?><input class="exists_qty" type="hidden" name="select_qty_<?php echo $item->menu_id?>" id="select_qty_<?php echo $item->menu_id?>_<?php echo $item->varientid?>" value="<?php echo number_format($item->menuqty,'.','2');?>"> <span id="productionsetting-update-<?php echo $item->menu_id.'-'.$item->varientid ?>"><?php echo number_format($item->menuqty,0);?> </span>  <?php if($item->food_status!=1){?><a class="btn btn-info btn-sm btnleftalign" disabled onclick="positemupdate('<?php echo $item->menu_id?>',<?php echo $item->menuqty;?>,'<?php echo $item->order_id;?>','<?php echo $item->varientid?>','<?php echo $isgroupidp;?>','<?php echo $item->addonsuid?>','add')"><i class="fa fa-plus" aria-hidden="true"></i></a><?php } ?></td>
                                        <td class="text-right"><strong><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo number_format($itemprice-$mypdiscount,2);?> <?php if($currency->position==2){echo $currency->curr_icon;}?> </strong></td>
original code                                      -->
<!-- newly added -->
<td class="text-center" style="text-align: center;"> <?php if($item->food_status!=1){?><a class="btn btn-danger btn-sm btnrightalign" disabled onclick="positemupdate(<?php echo $item->menu_id?>',<?php echo number_format($item->menuqty, 0);?>,'<?php echo $item->order_id;?>','<?php echo $item->varientid?>','<?php echo $isgroupidp;?>','<?php echo $item->addonsuid?>','del')"><i class="fa fa-minus" aria-hidden="true"></i></a><?php } ?><input class="exists_qty" type="hidden" name="select_qty_<?php echo $item->menu_id?>" id="select_qty_<?php echo $item->menu_id?>_<?php echo $item->varientid?>" value="<?php echo number_format($item->menuqty,'.','2');?>"> <span id="productionsetting-update-<?php echo $item->menu_id.'-'.$item->varientid ?>"><?php echo number_format($item->menuqty,0);?> </span>  <?php if($item->food_status!=1){?><a class="btn btn-info btn-sm btnleftalign" disabled ><i class="fa fa-plus" aria-hidden="true"></i></a><?php } ?></td>
                                        <td class="text-right"><strong><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo number_format($itemprice-$mypdiscount,2);?> <?php if($currency->position==2){echo $currency->curr_icon;}?> </strong></td>
                                      
<!-- newly added -->
                                      
                                        <td class="text-right">
                                          <?php if( $this->session->userdata('role') != "Waiter" ) { ?>
                                          
                                          <?php if($item->food_status!=1){?><a class="btn btn-danger btn-sm btnrightalign" onclick="deletecart(<?php echo $item->row_id;?>,<?php echo $item->order_id;?>)"><i class="fa fa-trash-o" aria-hidden="true"></i></a><?php 
                                                                               } else {
                                      echo '<i class="fa fa-check" ></i>';
                                    }
                                          
                                          
                                          ?>
                                          <?php } ?>
                                      </td>
                                     </tr>
                                    <?php 
                                    if(!empty($item->add_on_id)){
                                        $y=0;
                                            foreach($addons as $addonsid){
                                                    $adonsinfo=$this->order_model->read('*', 'add_ons', array('add_on_id' => $addonsid));
                                                    $adonsprice=$adonsprice+$adonsinfo->price*$addonsqty[$y];?>
                                                    <tr class="bg-deep-purple get_<?php echo $i;?> hasaddons" id="expandcol_<?php echo $i;?>">
                                                        <td colspan="2">
                                                        <?php echo $adonsinfo->add_on_name;?>
                                                        </td>
                                                        <td class="text-right"><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo number_format($adonsinfo->price, 2);?> <?php if($currency->position==2){echo $currency->curr_icon;}?> </td>
                                                        <td class="text-right"><?php echo number_format($addonsqty[$y],0);?></td>
                                                        <td class="text-right"><strong><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo number_format($adonsinfo->price*$addonsqty[$y], 2);?> <?php if($currency->position==2){echo $currency->curr_icon;}?> </strong></td>
                                                        <td class="text-right">&nbsp;</td>
                                                     </tr>
                                    <?php $y++;
                                                }
                                         }
                                    }
                                    $itemtotal=$subtotal;
                                    if($settinginfo->vat>0){
                                        $calvat=$itemtotal*$settinginfo->vat/100;
                                    }
                                    else{
                                        $calvat=$pvat;
                                        }
                                     ?>
                                    <tr>
                                        <td class="text-right" colspan="4"><strong><?php echo display('subtotal')?></strong></td>
                                        <td class="text-right"><strong><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo number_format($itemtotal-$pdiscount,2);?> <?php if($currency->position==2){echo $currency->curr_icon;}?> </strong></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    
                                </tfoot>
                            </table>
                            	</div>
                                </div>
                                <input name="subtotal" id="subtotal_update" type="hidden" value="<?php echo $subtotal-$pdiscount;?>" />
                                <?php $servicecharge=0;
                                            if(empty($billinfo)){
                                                $servicecharge=0;
                                                }
                                            else{
                                                    if($settinginfo->service_chargeType==0){
                                                      $servicecharge=$settinginfo->servicecharge;
                                                    }
                                                    else{
														$totalsercharge=$subtotal-$pdiscount;
							 							 $servicecharge=$settinginfo->servicecharge*$totalsercharge/100;
                                                        }
                                                    $sdamount=$settinginfo->service_charge;
                                                   } 
                                                ?>
                                            <?php $discount=0;
							$customerinfo=$this->ordermodel->read('*', 'customer_info', array('customer_id' =>$billinfo->customer_id));
							$mtype=$this->order_model->read('*', 'membership', array('id' => $customerinfo->membership_type));
                                            if(empty($billinfo)){
                                                $discount=$pdiscount;
                                                }
                                                else{
                                                    /*if($settinginfo->discount_type==0){
                                                    $discount=$billinfo->discount;
                                                    }
                                                    else{
                                                        $discount=$billinfo->discount*100/$billinfo->total_amount;
                                                        }*/
													$newsubtotal=$subtotal-$pdiscount;
													$discount=$pdiscount+($mtype->discount*$newsubtotal/100);
                                                    $disamount=$billinfo->discount;
                                                   } 
                                                 
                                                ?>
                                <input name="distype" id="distype_update" type="hidden" value="<?php echo $settinginfo->discount_type;?>" />
                                <input name="sdtype" id="sdtype_update" type="hidden" value="<?php echo $settinginfo->service_chargeType;?>" />
                                <input name="invoice_discount" class="text-right" id="invoice_discount_update" type="hidden" value="<?php echo $discount;?>" />
                                <table class="table table-bordered bg-white">
                                <?php if($servicecharge) { ?>
                                <tr>
                                    <td class="text-right" style="width: 49.4%;"><strong><?php echo display('service_chrg')?><?php if($settinginfo->service_chargeType==0){ echo "(".$currency->curr_icon.")";}else{ echo "(%)";}?></strong></td>
                                    <td class="text-right" style="width:28%">
                                            <strong>
                                            <input name="service_charge" class="text-right" id="service_charge_update" type="number" placeholder="0.00" onkeyup="sumcalculation(1)" value="<?php echo $settinginfo->servicecharge;?>" />
                                           
                                            </strong>
                                        </td>
                                    <td class="text-right" style="width:12.6%;">&nbsp;</td>
                                    </tr>
                                <tr>
                                  <?php } ?>
                                    <td class="text-right" style="width: 49.4%;"><strong><?php echo display('vat_tax')?></strong></td>
                                    <td class="text-right" style="width:28%"><input id="vat_update" name="vat" type="hidden" value="<?php echo $calvat;?>" />
                                            <strong><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo number_format($calvat,2);?> <?php if($currency->position==2){echo $currency->curr_icon;}?> </strong>
                                        </td>
                                    <td class="text-right" style="width:12.6%;">&nbsp;</td>
                                    </tr>
                                <tr>
                                    <td class="text-right" style="width: 49.4%;"><strong><?php echo display('grand_total')?></strong></td>
                                    <td class="text-right" style="width:28%"><input name="vat" type="hidden" value="<?php echo $calvat;?>" />
                                    <input name="tgtotal" type="hidden" value="<?php echo $calvat+$itemtotal+$servicecharge-$discount;?>" id="tgtotal" />
                                      <input name="item-number" type="hidden" id="item-number" />
                                             <input name="orginattotal" id="orginattotal_update" type="hidden" value="<?php echo $calvat+$itemtotal+$servicecharge-$discount;?>" /><input name="grandtotal" id="grandtotal_update" type="hidden" value="<?php echo $calvat+$itemtotal+$servicecharge-$discount;?>" /><?php if($currency->position==1){echo $currency->curr_icon;}?> <strong id="gtotal_update"><?php echo number_format($calvat+$itemtotal+$servicecharge-$discount,2);?></strong> <?php if($currency->position==2){echo $currency->curr_icon;}?>
                                        </td>
                                    <td class="text-right" style="width:12.6%;">&nbsp;</td>
                                    </tr>
                                
                                </table>
                            </div>
                                </div>
                                 
                            </div>
                    <div class="fixedclasspos">
                     <div class="bottomarea">
                         <div class="row">
                            <div class="col-sm-12">

                                <input type="button" id="update_order_confirm" onclick="postupdateorder_ajax()" class="btn btn-success btn-large cusbtn right" name="add-payment" value="Order Update">

                                </div>

                             </div>
                        </div>
                    </div>
                    </form>   
                </div>
                    </div>
        </div>
    </div>
 <script>

 $(window).on('load', function() {

  // Run code
  $(".sidebar-mini").addClass('sidebar-collapse');
});
   
   
$(document).ready(function () {
    "use strict";
    // select 2 dropdown 
    $("select.form-control:not(.dont-select-me)").select2({
        placeholder: "Select option",
        allowClear: true
    });

      //form validate
    $("#validate").validate();
    $("#add_category").validate();
    $("#customer_name").validate();

    $('.productclist').slimScroll({
        size: '3px',
        height: '545px',
        allowPageScroll: true,
        railVisible: true
    });

    $('.product-grid').slimScroll({
        size: '3px',
        height: '720px',
        allowPageScroll: true,
        railVisible: true
    });

});

$('body').on('keyup', '#update_product_name', function() {
        var product_name = $(this).val();
        var category_id = $('#category_id').val();
        var myurl= $('#posurl_update').val();
        $.ajax({
            type: "post",
            async: false,
            url: myurl,
            data: {product_name: product_name,category_id:category_id},
            success: function(data) {
                if (data == '420') {
                    $("#product_search_update").html('Product not found !');
                }else{
                    $("#product_search_update").html(data); 
                }
            },
            error: function() {
                alert('<?php echo display('req_failed');?>');
            }
        });
    });

 //Product search js
    /*$('body').on('change', '#category_id', function() {
        var product_name = $('#product_name').val();
        var category_id = $('#category_id').val();
        var myurl= $('#posurl').val();
        $.ajax({
            type: "post",
            async: false,
            url: myurl,
            data: {product_name: product_name,category_id:category_id},
            success: function(data) {
                if (data == '420') {
                    $("#product_search").html('Product not found !');
                }else{
                    $("#product_search").html(data); 
                }
            },
            error: function() {
                alert('Request Failed, Please check your code and try again!');
            }
        });
    });  */  
     function getslcategory_update(carid){
        var product_name = $('#update_product_name').val();
        var category_id = carid;
        var myurl= $('#posurl_update').val();
        $.ajax({
            type: "post",
            async: false,
            url: myurl,
            data: {product_name: product_name,category_id:category_id,isuptade:1},
            success: function(data) {
                if (data == '420') {
                    $("#product_search_update").html('Product not found !');
                }else{
                    $("#product_search_update").html(data); 
                }
            },
            error: function() {
                alert('<?php echo display('req_failed');?>');
            }
        });
     }  
//Product search button js
    $('body').on('click', '#search_button', function() {
       
      	var product_name = $('#update_product_name').val();
        var category_id = $('#category_id').val();
        var myurl= $('#posurl_update').val();
        $.ajax({
            type: "post",
            async: false,
            url: myurl,
            data: {product_name: product_name,category_id:category_id},
            success: function(data) {
                if (data == '420') {
                    $("#product_search_update").html('Product not found !');
                }else{
                    $("#product_search_update").html(data); 
                }
            },
            error: function() {
                alert('<?php echo display('req_failed');?>');
            }
        });
    });    


    /*select product from list*/

/*$('body').on('keyup', '#invoice_discount', function() {
  var total_price = $("#grandTotal").val();
  alert(total_price);
    inv_dis = $("#invoice_discount").val(),
    ser_chg = $("#service_charge").val(),
    sum = total_price+ser_chg - inv_dis;
    $("#grandTotal").val(sum.toFixed(2));
});
$('body').on('keyup', '#service_charge', function() {
  
});*/
 //Payment method toggle 
    $(document).ready(function(){
        <?php 
		if($orderinfo->isthirdparty>0) { ?>
                $("#nonthirdparty_update").hide();
                $("#thirdparty_update").show();        
                $("#delivercom_update").prop('disabled', false);
                $("#waiter_update").prop('disabled', true);
                $("#tableid_update").prop('disabled', true);
                $("#cardarea_update").show();
      			$("#update_active_hotel_customer").hide();
      			$("#update_hotel_customer_name").prop('disabled',true);
        <?php } else{
                      if($orderinfo->cutomertype==4){?>
                      $("#nonthirdparty_update").show();
                      $("#thirdparty_update").hide();
                      $("#tblsec_update").hide();
                      $("#delivercom_update").prop('disabled', true);
                      $("#waiter_update").prop('disabled', false);
                      $("#tableid_update").prop('disabled', true);
                      $("#cardarea_update").hide();
		<?php }else if($orderinfo->cutomertype==2){?>
                      $("#nonthirdparty_update").show();
                      $("#thirdparty_update").hide();
                      $("#tblsec_update").hide();
                      $("#delivercom_update").prop('disabled', true);
                      $("#waiter_update").prop('disabled', false);
                      $("#tableid_update").prop('disabled', true);
                      $("#update_active_hotel_customer").hide();
     					 $("#update_hotel_customer_name").prop('disabled',true);
                      $("#cardarea_update").hide();
        <?php } else{ ?>
                      $("#nonthirdparty_update").show();
                      $("#tblsec_update").show();
                      $("#thirdparty_update").hide();
                      $("#delivercom_update").prop('disabled', true);
                      $("#waiter_update").prop('disabled', false);
                      $("#tableid_update").prop('disabled', true);
                      $("#cardarea_update").hide();
                      $("#update_active_hotel_customer").hide();
      				$("#update_hotel_customer_name").prop('disabled',true);
				<?php } 
        } ?>
         
        $(".payment_button").click(function(){
            $(".payment_method").toggle();

            //Select Option
            $("select.form-control:not(.dont-select-me)").select2({
                placeholder: "Select option",
                allowClear: true
            });
        });
        
        $("#card_typesl").on('change', function(){ 
            var cardtype=$("#card_typesl").val();
            
            $("#card_type").val(cardtype);
             
          if(cardtype==4){
            $("#isonline").val(0);
            $("#cardarea").hide();
            $("#assigncard_terminal").val('');
            $("#assignbank").val('');
            $("#assignlastdigit").val('');
          }
          else if(cardtype==1){
            $("#isonline").val(0);
            $("#cardarea").show();
          }
            else{
                $("#isonline").val(1);
                $("#cardarea").hide();
                $("#assigncard_terminal").val('');
                $("#assignbank").val('');
                $("#assignlastdigit").val('');
                }
            /*if(cardtype==1){
                $("#cholder").show();
                $("#cnumber").show();
                }
            else{
                $("#cholder").hide();
                $("#cnumber").hide();
                }*/
        });
        $("#ctypeid_update").on('change', function(){ 
            var customertype=$("#ctypeid_update").val();
            if(customertype==3){
                $("#delivercom_update").prop('disabled', false);
                $("#waiter_update").prop('disabled', true);
                $("#tableid_update").prop('disabled', true);
                $("#nonthirdparty_update").hide();
                $("#thirdparty_update").show();           
                $("#update_default_customer_name").show();           
            
            }else if(customertype==4){
                $("#nonthirdparty").show();
                $("#thirdparty").hide();
                $("#tblsec").hide();
				$("#tblsecp").hide();
                $("#delivercom").prop('disabled', true);
                $("#waiter").prop('disabled', false);
                $("#tableid").prop('disabled', true);
                $("#cookingtime").prop('disabled', true);
                $("#update_active_hotel_customer").hide();
                $("#update_default_customer_name").show();
               
            }
			else if(customertype==2){
                $("#nonthirdparty").show();
                $("#tblsecp").hide();
				$("#tblsec").hide();
                $("#thirdparty").hide();                
                $("#waiter").prop('disabled', false);
                $("#tableid").prop('disabled', false);
                $("#cookingtime").prop('disabled', false);
                $("#delivercom").prop('disabled', true);
                $("#update_default_customer_name").show();
                $("#update_active_hotel_customer").hide();
            }
            else if(customertype==99 || customertype==100){
                $("#nonthirdparty").show();
                $("#update_active_hotel_customer").show();
                $("#tblsecp").show();
                $("#tblsec").show();
                $("#thirdparty").hide();
                $("#waiter").prop('disabled', false);
                $("#tableid").prop('disabled', false);
                $("#cookingtime").prop('disabled', false);
                $("#delivercom").prop('disabled', true);
                $("#update_default_customer_name").hide();              

            }
            else{
                $("#nonthirdparty_update").show();
                $("#tblsec_update").show();
                $("#thirdparty_update").hide();
                $("#delivercom_update").prop('disabled', true);
                $("#waiter_update").prop('disabled', false);
                $("#tableid_update").prop('disabled', false);
               	$("#update_active_hotel_customer").hide();
                $("#update_default_customer_name").show();              

                }
        });

      
    });
   
 $('.update_search_field').select2({
        placeholder: 'Select Product',
         minimumInputLength: 1,
        ajax: {
          url: 'getitemlistdroup',
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
            return {
              results:  $.map(data, function (item) {
                    return {
                        text: item.text+'-'+item.variantName+' - '+item.price,
                        id: item.id,
                        variantid: item.variantid,
                      
                    }
                })
            };
          },
          cache: true
        }
      });  
   

     
     
     
function positemupdate(itemid,existqty,orderid,varientid,isgroup,auid,status){
//gi dd para dile ma execute ang add or subtract quantity
  //return;
//gi dd para dile ma execute ang add or subtract quantity
        if(status == 'add'){
            /*check production*/
                var productionsetting = $('#production_setting').val();
                if(productionsetting == 1){
                    var checkqty = existqty+1;
                    var checkvalue = checkproduction(itemid,varientid,checkqty);

                        if(checkvalue == false){
                            return false;
                        }
                    
                }
            /*end checking*/
            }
			
			var dataString = "itemid="+itemid+"&existqty="+existqty+"&orderid="+orderid+"&varientid="+varientid+"&auid="+auid+"&status="+status+"&isgroup="+isgroup;
			var myurl="<?php echo base_url("ordermanage/order/itemqtyupdate"); ?>";
            $.ajax({
             type: "POST",
             url: myurl,
             data: dataString,
             success: function(data) {
                    $('#updatefoodlist').html(data);                   
               		var total=$('#grtotal').val();
                    var totalitem=$('#totalitem').val();
                    $('#item-number').text(totalitem.toFixed(2));
                    $('#getitemp').val(totalitem.toFixed(2));
                    var tax=$('#tvat').val();
                    //$('#vat').val(tax);
                    var discount=$('#tdiscount').val();
                    var tgtotal=$('#tgtotal').val();
                    $('#calvat').text(tax);
                    $('#invoice_discount').val(discount.toFixed(2));
					var sc=$('#sc').val();
					$('#service_charge').val(sc.toFixed(2));
                    $('#caltotal').text(tgtotal.toFixed(2));
                    $('#grandtotal').val(tgtotal.toFixed(2));
                    $('#orggrandTotal').val(tgtotal.toFixed(2));
                    $('#orginattotal').val(tgtotal.toFixed(2));
             } 
        });
	}
     
     
     
     
  
   
   
 </script>