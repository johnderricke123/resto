<script src="<?php echo base_url();?>assets/js/jquery.validate.min.js" type="text/javascript"></script>
<style>
.listcat{
      color: #fff;
    background: #37a000;
    box-shadow: inset 0 0 0 0 rgba(0,0,0,.4), -2px -3px 5px -2px rgba(0,0,0,.4);
    cursor:pointer;
    padding:5px;
  }
.tabsection {
	display: flex;
	align-items: flex-start;
	justify-content: space-between;
	position: fixed;
	z-index: 999;
	background: #fff;
	left: 50px;
	right: 0;
	padding: 20px 32px 0;
	top: 0;
}
.tab-content-xs{top:60px;position: relative;padding: 0 0 40px;}
.tgbar {
	min-width: 150px;
	display: flex;
	align-items: center;
	justify-content: flex-end;
}
.tgbar a {
	padding: 0px 5px;
	position: relative;
}
.tgbar>a>i {
	border: 1px solid #f2f2f2;
	padding: 6px 3px;
	width: 36px;
	text-align: center;
	color: #374767;
	background-color: #f5f5f5;
	height: 36px;
	font-size: 25px;
}
.tgbar .sidebar-toggle {
	float: left;
	background-color: #f5f5f5;
	background-image: none;
	padding: 6px 6px 3px;
	font-family: fontAwesome;
	color: #374767;
	font-size: 26px;
	line-height: 26px
}
.popover {
	min-width: 50em !important;
}
.wrapper.pos {
	height: 100vh;
}
@keyframes anim_opa {
 50% {
opacity: 0.2
}
}
@media (max-width: 767px) {
 .tabsection {
	 left: 0;
	 padding: 20px 17px 0;
	}
  
}
@media (max-width:575px) {
 .tabsection {
	 left: 0;
	 padding: 20px 17px 0;
	}
  .tab-content-xs{top:60px;}
}
</style>
<div class="modal fade" id="vieworder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="border:none;">
    <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo display('foodnote') ?></h5>
                    
                </div>
      <div class="modal-body" style="padding:25px;">
        	<div class="row">
            	<div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label" for="user_email"><?php echo display('foodnote') ?></label>
                                                <textarea cols="45" rows="3" id="foodnote" class="form-control" name="foodnote"></textarea>
                                                <input name="foodqty" id="foodqty" type="hidden" />
                                                 <input name="foodgroup" id="foodgroup" type="hidden" />
                                                <input name="foodid" id="foodid" type="hidden" />
                                                <input name="foodvid" id="foodvid" type="hidden"/>
                                                <input name="foodcartid" id="foodcartid" type="hidden"/>
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                        <a onclick="addnotetoitem()" class="btn btn-success btn-md text-white" id="notesmbt"><?php echo display('addnotesi') ?></a>
                                        </div>
            </div>
      </div>
    </div>
  </div>
</div>
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
                                            <label class="sr-only screen-reader-text" for="search"><?php echo display('search')?>:</label>
                                            <div class="input-group">
                                                   <select id="update_product_name" class="form-control dont-select-me  update_search-field" dir="ltr" name="s">
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
                                                                                    <input type="hidden" name="select_varient_name" class="update_select_varient_name" value="<?php echo $item->variantName;?>">
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
                                    <div class="col-md-6 form-group">
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
                                    </div>
                                    <div id="nonthirdparty_update" class="col-md-12">
                                        <div class="row">
                                        <?php if($possetting->waiter==1){?>
                                                <div class="col-md-6 form-group">
                                                    <label for="store_id"><?php echo display('waiter');?> <span class="color-red">*</span>&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                                    <?php echo form_dropdown('waiter',$waiterlist,(!empty($orderinfo->waiter_id)?$orderinfo->waiter_id:null),'class="form-control" id="waiter_update" required') ?>
                                                </div>
                                                 <?php } 
													if($possetting->tableid==1){
												?>
                                                <div class="col-md-6 form-group" id="tblsec_update" style="display:none;">
                                                    <label for="store_id"><?php echo display('table');?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="color-red">*</span></label>
                                                     <?php echo form_dropdown('tableid',$tablelist,(!empty($orderinfo->table_no)?$orderinfo->table_no:null),'class="form-control" id="tableid_update" required') ?>
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
                                                <th class="text-center"><?php echo display('varient_name')?></th>
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
                                        foreach ($iteminfo as $item){
                                            $i++;
                                            if($item->isgroup==1){
											$isgroupidp=1;
											$isgroup=$item->menu_id;
											}
											else{
												$isgroupidp=0;
												$isgroup=0;
												}
                                            $itemprice= $item->price*$item->menuqty;
                                            $iteminfor=$this->ordermodel->getiteminfo($item->menu_id);
                                            $vatcalc=$itemprice*$iteminfor->productvat/100;
                                            $pvat=$pvat+$vatcalc;
                                            if($iteminfor->OffersRate>0){
                                                $mypdiscount=$iteminfor->OffersRate*$itemprice/100;
                                                $pdiscount=$pdiscount+($iteminfor->OffersRate*$itemprice/100);
                                                }
                                            else{
                                                $mypdiscount=0;
                                                $pdiscount=$pdiscount+0;
                                            }
                                            $discount=0;
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
                                            <td class="text-left">
                                            <?php echo $item->ProductName;?><?php echo $text;?> <a class="serach" onclick="itemnote('<?php echo $item->row_id;?>','<?php echo $item->notes;?>',<?php echo $item->order_id;?>,1,<?php echo $isgroup;?>)" style="padding-left:15px;" title="<?php echo display('foodnote') ?>"> <i class="fa fa-sticky-note" aria-hidden="true"></i> </a>
                                            </td>
                                            <td>
                                            <?php echo $item->variantName;?>
                                            </td>
                                            <td class="text-right"><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo number_format($item->price, 2);?> <?php if($currency->position==2){echo $currency->curr_icon;}?> </td>
                                            <td class="text-right"><a class="btn btn-danger btn-sm btnrightalign" onclick="positemupdate('<?php echo $item->menu_id?>',<?php echo $item->menuqty;?>,'<?php echo $item->order_id;?>','<?php echo $item->varientid?>','<?php echo $isgroupidp;?>','<?php echo $item->addonsuid?>','del')"><i class="fa fa-minus" aria-hidden="true"></i></a><input class="exists_qty" type="hidden" name="select_qty_<?php echo $item->menu_id?>" id="select_qty_<?php echo $item->menu_id?>_<?php echo $item->varientid?>" value="<?php echo $item->menuqty;?>"> <?php echo number_format($item->menuqty,0);?> <a class="btn btn-info btn-sm btnleftalign" onclick="positemupdate('<?php echo $item->menu_id?>',<?php echo $item->menuqty, 2;?>,'<?php echo $item->order_id;?>','<?php echo $item->varientid?>','<?php echo $isgroupidp;?>','<?php echo $item->addonsuid?>','add')"><i class="fa fa-plus" aria-hidden="true"></i></a></td>
                                            <td class="text-right"><strong><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo number_format($itemprice-$mypdiscount,2);?> <?php if($currency->position==2){echo $currency->curr_icon;}?> </strong></td>
                                            <td class="text-right"><?php if($orderinfo->order_status!=4){?><a class="btn btn-danger btn-sm btnrightalign" onclick="deletecart(<?php echo $item->row_id;?>,<?php echo $item->order_id;?>)"><i class="fa fa-trash-o" aria-hidden="true"></i></a><?php } ?></td>
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
                                                            <td class="text-right"><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo number_format($adonsinfo->price, 0);?> <?php if($currency->position==2){echo $currency->curr_icon;}?> </td>
                                                            <td class="text-right"><?php echo number_format($addonsqty[$y], 0);?></td>
                                                            <td class="text-right"><strong><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo number_format($adonsinfo->price*$addonsqty[$y], 2,'.',',');?> <?php if($currency->position==2){echo $currency->curr_icon;}?> </strong></td>
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
                                            <td class="text-right"><strong><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo number_format($itemtotal,2);?> <?php if($currency->position==2){echo $currency->curr_icon;}?> </strong></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        
                                    </tfoot>
                                </table>
                                    </div>
                                </div>
                                <input name="subtotal" id="subtotal_update" type="hidden" value="<?php echo $subtotal-$pdiscount;?>" />
                                <table class="table table-bordered bg-white">
                                <tr>
                                    <td class="text-right" style="width: 49.4%;"><strong><?php echo display('discount')?><?php if($settinginfo->discount_type==0){ echo "(".$currency->curr_icon.")";}else{ echo "(%)";}?></strong></td>
                                    <td class="text-right" style="width:28%">
                                            <strong>
                                             <?php $servicecharge=0;
                                            if(empty($billinfo)){
                                                $servicecharge=0;
                                                }
                                            else{
                                                    if($settinginfo->service_chargeType==0){
                                                    $servicecharge=$billinfo->service_charge;
                                                    }
                                                    else{
                                                        $servicecharge=$billinfo->service_charge*100/$billinfo->total_amount;
                                                        }
                                                    $sdamount=$billinfo->service_charge;
                                                   } 
                                                ?>
                                            <?php $discount=0;
											$customerinfo=$this->ordermodel->read('*', 'customer_info', array('customer_id' =>$billinfo->customer_id));
							$mtype=$this->order_model->read('*', 'membership', array('id' => $customerinfo->membership_type));
                                            if(empty($billinfo)){
                                                $discount=0;
                                                }
                                                else{
                                                   /* if($settinginfo->discount_type==0){
                                                    $discount=$billinfo->discount;
                                                    }
                                                    else{
                                                        $discount=$billinfo->discount*100/$billinfo->total_amount;
                                                        }
                                                    $disamount=$billinfo->discount;*/
													$newsubtotal=$subtotal-$pdiscount;
													$discount=$pdiscount+($mtype->discount*$newsubtotal/100);
                                                    $disamount=$billinfo->discount;
                                                   } 
                                                 
                                                ?>
                                                <input name="distype" id="distype_update" type="hidden" value="<?php echo $settinginfo->discount_type;?>" />
                                                <input name="sdtype" id="sdtype_update" type="hidden" value="<?php echo $settinginfo->service_chargeType;?>" />
                                            <input name="invoice_discount" class="text-right" id="invoice_discount_update" type="hidden" placeholder="0.00" value="<?php echo $discount;?>" />
                                            
                                            </strong>
                                        </td>
                                    <td class="text-right" style="width:12.6%;">&nbsp;</td>
                                    </tr>
                                <tr>
                                    <td class="text-right" style="width: 49.4%;"><strong><?php echo display('service_chrg')?></strong></td>
                                    <td class="text-right" style="width:28%">
                                            <strong>
                                            <input name="service_charge" class="text-right" id="service_charge_update" type="number" placeholder="0.00" onkeyup="sumcalculation(1)" value="<?php echo $servicecharge;?>" />
                                           
                                            </strong>
                                        </td>
                                    <td class="text-right" style="width:12.6%;">&nbsp;</td>
                                    </tr>
                                <tr>
                                    <td class="text-right" style="width: 49.4%;"><strong><?php echo display('vat_tax')?></strong></td>
                                    <td class="text-right" style="width:28%"><input id="vat_update" name="vat" type="hidden" value="<?php echo $calvat;?>" />
                                            <strong><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo number_format($calvat,3);?> <?php if($currency->position==2){echo $currency->curr_icon;}?> </strong>
                                        </td>
                                    <td class="text-right" style="width:12.6%;">&nbsp;</td>
                                    </tr>
                                <tr>
                                    <td class="text-right" style="width: 49.4%;"><strong><?php echo display('grand_total')?></strong></td>
                                    <td class="text-right" style="width:28%"><input name="vat" type="hidden" value="<?php echo $calvat;?>" />
                                    <input name="tgtotal" type="hidden" value="<?php echo $calvat+$itemtotal+$sdamount-$disamount;?>" id="tgtotal" />
                                            <input name="orginattotal" id="orginattotal_update" type="hidden" value="<?php echo $calvat+$itemtotal+$sdamount-$disamount;?>" /><input name="grandtotal" id="grandtotal_update" type="hidden" value="<?php echo $calvat+$itemtotal+$sdamount-$disamount;?>" /><?php if($currency->position==1){echo $currency->curr_icon;}?> <strong id="gtotal_update"><?php echo number_format($calvat+$itemtotal+$sdamount-$disamount,3);?></strong> <?php if($currency->position==2){echo $currency->curr_icon;}?>
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
                                                                        <div class="col-sm-6">
                                                                        <div class="col-sm-12">
                                                                        <input type="hidden" id="production_setting" value="<?php echo $possetting->productionsetting; ?>" >
                            <input type="hidden" id="production_url" value="<?php echo base_url("production/production/ingredientcheck") ?>">
                                <input type="button" id="update_order_confirm" onclick="postupdateorder_ajax()" class="btn btn-success btn-large cusbtn" name="add-payment" value="Order Update">
                                                                        </div>
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

$( window ).load(function() {
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
        height: '345px',
        allowPageScroll: true,
        railVisible: true
    });

    $('.product-grid').slimScroll({
        size: '3px',
        height: '720px',
        allowPageScroll: true,
        railVisible: true
    });
 $('.update_search-field').select2({
        placeholder: 'Select Product',
         minimumInputLength: 1,
        ajax: {
          url: '<?php echo base_url()?>ordermanage/order/getitemlistdroup',
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
            return {
              results:  $.map(data, function (item) {
                    return {
                        text: item.text+'-'+item.variantName,
                        id: item.id+'-'+item.variantid
                    }
                })
            };
          },
          cache: true
        }
      });

});
  $(document).on('change','#update_product_name', function(){
			var tid = $(this).children("option:selected").val();
			var idvid=tid.split('-');
			var id=idvid[0];
			var vid=idvid[1];
			
            var updateid=$("#saleinvoice").val();
            var url= '<?php echo base_url()?>ordermanage/order/addtocartupdate_uniqe'+'/'+id+'/'+updateid;
             /*check production*/
             /*please fixt cart total counting*/
                var productionsetting = $('#production_setting').val();
                if(productionsetting == 1){
                   
                    var checkqty = 1;
                    var checkvalue = checkproduction(id,vid,checkqty);

                        if(checkvalue == false){
                             $('#update_product_name').html('');
                            return false;
                        }
                    
                }
            /*end checking*/
            $.ajax({
             type: "GET",
             url: url,
             success: function(data) {
                if(data == 'adons'){
                 
                 var myurl ="<?php echo base_url()?>ordermanage/order/adonsproductadd"+'/'+id;
                $.ajax({
             type: "GET",
             url: myurl,
             success: function(data) {
                      $('.addonsinfo').html(data);
                     $('#edit').modal('show');
                     var tax=$('#tvat').val();
                    var discount=$('#tdiscount').val();
                    var tgtotal=$('#tgtotal').val();
                    $('#vat').val(tax);
                    $('#calvat').text(tax);
					var sc=$('#sc').val();
					$('#service_charge').val(sc);
                    $('#invoice_discount').val(discount);
                    $('#caltotal').text(tgtotal);
                    $('#grandtotal').val(tgtotal);
                    $('#orggrandTotal').val(tgtotal);
                    $('#orginattotal').val(tgtotal);
                     $('#update_product_name').html('');

                } 
                });

                }
               else{
                   $('#updatefoodlist').html(data);
                    var total=$('#grtotal').val();
                    var totalitem=$('#totalitem').val();
                    $('#item-number').text(totalitem);
                    $('#getitemp').val(totalitem);
                    var tax=$('#tvat').val();
                    //$('#vat').val(tax);
                    var discount=$('#tdiscount').val();
                    var tgtotal=$('#tgtotal').val();
                    $('#calvat').text(tax);
					var sc=$('#sc').val();
					$('#service_charge').val(sc);
                    $('#invoice_discount').val(discount);
                    $('#caltotal').text(tgtotal);
                    $('#grandtotal').val(tgtotal);
                    $('#orggrandTotal').val(tgtotal);
                    $('#orginattotal').val(tgtotal);
                     $('#update_product_name').html('');
                }
                   
                   

             } 
        });

    //console.log($('#carturl').val());
});
/*$('body').on('keyup', '#update_product_name', function() {
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
            }
        });
    });*/

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

//Product search button js
    $('body').on('click', '.update_select_product', function(e) {
        e.preventDefault();
        var panel = $(this);
        var pid = panel.find('.panel-body input[name=update_select_product_id]').val();
        var sizeid = panel.find('.panel-body input[name=update_select_product_size]').val();
		var totalvarient = panel.find('.panel-body input[name=select_totalvarient]').val();
		var customqty = panel.find('.panel-body input[name=select_iscustomeqty]').val();
		var isgroup = panel.find('.panel-body input[name=update_select_product_isgroup]').val();
        var catid = panel.find('.panel-body input[name=update_select_product_cat]').val();
        var itemname= panel.find('.panel-body input[name=update_select_product_name]').val();
        var varientname=panel.find('.panel-body input[name=update_select_varient_name]').val();
        var qty=1;
        var price=panel.find('.panel-body input[name=update_select_product_price]').val();
        var hasaddons=panel.find('.panel-body input[name=update_select_addons]').val();
        var existqty=$('#select_qty_'+pid+'_'+sizeid).val();
         if(existqty === undefined){ 
           var existqty=0;
         }
         else{
          var existqty=$('#select_qty_'+pid+'_'+sizeid).val();
        }
        var qty=parseInt(existqty)+parseInt(qty);
        var updateid=$("#saleinvoice").val();
        if(hasaddons==0 && totalvarient==1 && customqty==0){
            var mysound=baseurl+"assets/";
        var audio =["beep-08b.mp3"];
        new Audio(mysound + audio[0]).play();
        var myurl= $('#updatecarturl').val();
        var dataString = "pid="+pid+'&itemname='+itemname+'&varientname='+varientname+'&qty='+qty+'&price='+price+'&catid='+catid+'&sizeid='+sizeid+'&isgroup='+isgroup+'&orderid='+updateid+'&totalvarient='+totalvarient+'&customqty='+customqty;
		 $.ajax({
             type: "POST",
             url: myurl,
             data: dataString,
             success: function(data) {
                    $('#updatefoodlist').html(data);
                    var total=$('#grtotal').val();
                    var totalitem=$('#totalitem').val();
                    $('#item-number').text(totalitem);
                    $('#getitemp').val(totalitem);
                    var tax=$('#tvat').val();
                    //$('#vat').val(tax);
                    var discount=$('#tdiscount').val();
                    var tgtotal=$('#tgtotal').val();
                    $('#calvat').text(tax);
                    $('#invoice_discount').val(discount);
					var sc=$('#sc').val();
					$('#service_charge').val(sc);
                    $('#caltotal').text(tgtotal);
                    $('#grandtotal').val(tgtotal);
                    $('#orggrandTotal').val(tgtotal);
                    $('#orginattotal').val(tgtotal);
             } 
        });
        }
     else{
            
			 var geturl=$("#addonexsurl").val();
             var myurl =geturl+'/'+pid;
             var dataString = "pid="+pid+"&sid="+sizeid+"&id="+catid+"&totalvarient="+totalvarient+"&customqty="+customqty;
            $.ajax({
             type: "POST",
             url: geturl,
             data: dataString,
             success: function(data) {
                     $('.addonsinfo').html(data);
                     $('#edit').modal('show');
                     var tax=$('#tvat').val();
                    var discount=$('#tdiscount').val();
                    var tgtotal=$('#tgtotal').val();
                    $('#vat').val(tax);
                    $('#calvat').text(tax);
                    $('#invoice_discount').val(discount);
                    $('#caltotal').text(tgtotal);
                    $('#grandtotal').val(tgtotal);
                    $('#orggrandTotal').val(tgtotal);
                    $('#orginattotal').val(tgtotal);
             } 
        });
         }
    });
    /*select product from list*/
/*        $(document).on('change','#update_product_name', function(){
            var id = $(this).children("option:selected").val();
            var updateid=$("#saleinvoice").val();
            var url= 'addtocartupdate_uniqe'+'/'+id+'/'+updateid;
			//alert(url);
            $.ajax({
             type: "GET",
             url: url,
             success: function(data) {
                if(data == 'adons'){
                 
                 var myurl ="adonsproductadd"+'/'+id;
                $.ajax({
             type: "GET",
             url: myurl,
             success: function(data) {
                      $('.addonsinfo').html(data);
                     $('#edit').modal('show');
                     var tax=$('#tvat').val();
                    var discount=$('#tdiscount').val();
                    var tgtotal=$('#tgtotal').val();
                    $('#vat').val(tax);
                    $('#calvat').text(tax);
                    $('#invoice_discount').val(discount);
                    $('#caltotal').text(tgtotal);
                    $('#grandtotal').val(tgtotal);
                    $('#orggrandTotal').val(tgtotal);
                    $('#orginattotal').val(tgtotal);
                     $('#update_product_name').html('');

                } 
                });

                }
               else{
                   $('#updatefoodlist').html(data);
                    var total=$('#grtotal').val();
                    var totalitem=$('#totalitem').val();
                    $('#item-number').text(totalitem);
                    $('#getitemp').val(totalitem);
                    var tax=$('#tvat').val();
                    //$('#vat').val(tax);
                    var discount=$('#tdiscount').val();
                    var tgtotal=$('#tgtotal').val();
                    $('#calvat').text(tax);
                    $('#invoice_discount').val(discount);
                    $('#caltotal').text(tgtotal);
                    $('#grandtotal').val(tgtotal);
                    $('#orggrandTotal').val(tgtotal);
                    $('#orginattotal').val(tgtotal);
                     $('#update_product_name').html('');
                }
                   
                   

             } 
        });

    console.log($('#carturl').val());
});*/
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
        <?php if($orderinfo->isthirdparty>0){?>
        $("#nonthirdparty_update").hide();
        $("#thirdparty_update").show();
        $("#delivercom_update").prop('disabled', false);
        $("#waiter_update").prop('disabled', true);
        $("#tableid_update").prop('disabled', true);
        $("#cardarea_update").show();
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
        $("#cardarea_update").hide();
        <?php } else{ ?>
		$("#nonthirdparty_update").show();
        $("#tblsec_update").show();
        $("#thirdparty_update").hide();
        $("#delivercom_update").prop('disabled', true);
        $("#waiter_update").prop('disabled', false);
        $("#tableid_update").prop('disabled', false);
        $("#cardarea_update").hide();
		<?php } } ?>
         
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
            }
            else if(customertype==4){
                $("#nonthirdparty_update").show();
                $("#thirdparty_update").hide();
                $("#tblsec_update").hide();
                $("#delivercom_update").prop('disabled', true);
                $("#waiter_update").prop('disabled', false);
                $("#tableid_update").prop('disabled', true);
            }
			else if(customertype==2){
                $("#nonthirdparty_update").show();
                $("#tblsec_update").hide();
                $("#thirdparty_update").hide();
                $("#waiter_update").prop('disabled', false);
                $("#tableid_update").prop('disabled', false);
                $("#cookingtime_update").prop('disabled', false);
                $("#delivercom_update").prop('disabled', true);
            }
            else{
                $("#nonthirdparty_update").show();
                $("#tblsec_update").show();
                $("#thirdparty_update").hide();
                $("#delivercom_update").prop('disabled', true);
                $("#waiter_update").prop('disabled', false);
                $("#tableid_update").prop('disabled', false);
                }
        });

                 
    });
	function printRawHtml(view) {
      printJS({
        printable: view,
        type: 'raw-html',
        
      });
    }
	function postupdateorder_ajax(){
	var form = $('#insert_purchase');
	var url = form.attr('action');
	var data = form.serialize();
	
	
	$.ajax({
            url:url,
            type:'POST',
            data:data,
            dataType: 'json',
          
            beforeSend:function(xhr){
            
            $('span.error').html('');
            },
          
            success:function(result){
				swal({
				title: result.msg,
				text: result.tokenmsg,
				type: "success",
				showCancelButton: true,
				confirmButtonColor: "#28a745",
				confirmButtonText: "Yes",
				cancelButtonText: "No",
				closeOnConfirm: true,
				closeOnCancel: true
			},
		function (isConfirm) {
				if (isConfirm) {
					$.ajax({
		 	 type: "GET",
			 url: "<?php echo base_url()?>ordermanage/order/postokengenerateupdate/"+result.orderid+"/1",
			 success: function(data) {
				 	printRawHtml(data);
			 } 
		});
				} else {
					//window.location.href="pos_invoice";
					$.ajax({
						 type: "GET",
						 url: "<?php echo base_url()?>ordermanage/order/tokenupdate/"+result.orderid,
						 success: function(data) {
								console.log("done");
								window.location.href="<?php echo base_url()?>ordermanage/order/orderlist";
						 }
					  });
				}
			});
            setTimeout(function () {
        		toastr.options = {
            	closeButton: true,
            	progressBar: true,
            	showMethod: 'slideDown',
            	timeOut: 4000,
                    // positionClass: "toast-top-left"
        };
        toastr.success(result.msg, 'Success');
		//window.location.href="<?php echo base_url()?>ordermanage/order/orderlist";
        //prevsltab.trigger( "click" );


    }, 300); 
              console.log(result)          
            },error:function(a){
                  
            }
        });
}
function positemupdate(itemid,existqty,orderid,varientid,auid,status){
			var dataString = "itemid="+itemid+"&existqty="+existqty+"&orderid="+orderid+"&varientid="+varientid+"&auid="+auid+"&status="+status;
			var myurl="<?php echo base_url("ordermanage/order/itemqtyupdate") ?>";
            $.ajax({
             type: "POST",
             url: myurl,
             data: dataString,
             success: function(data) {
                     $('#updatefoodlist').html(data);
                     var total=$('#grtotal').val();
                    var totalitem=$('#totalitem').val();
                    $('#item-number').text(totalitem);
                    $('#getitemp').val(totalitem);
                    var tax=$('#tvat').val();
                    //$('#vat').val(tax);
                    var discount=$('#tdiscount').val();
                    var tgtotal=$('#tgtotal').val();
                    $('#calvat').text(tax);
                    $('#invoice_discount').val(discount);
					var sc=$('#sc').val();
					$('#service_charge').val(sc);
                    $('#caltotal').text(tgtotal);
                    $('#grandtotal').val(tgtotal);
                    $('#orggrandTotal').val(tgtotal);
                    $('#orginattotal').val(tgtotal);
             } 
        });
	}
function itemnote(rowid,notes,qty,isupdate,isgroup=null){
		  $("#foodnote").val(notes);
		  $("#foodqty").val(qty);
		  $("#foodcartid").val(rowid);
		  $("#foodgroup").val(isgroup);
		  if(isupdate==1){
			  $("#notesmbt").text("Update Note");
			  $("#notesmbt").attr("onclick","addnotetoupdate()");
		  }
		  else{
			  $("#notesmbt").text("Update Note");
			  $("#notesmbt").attr("onclick","addnotetoitem()");
			  }
		  $('#vieworder').modal('show');
	}
	function addnotetoupdate(){
		  var rowid=$("#foodcartid").val();
		  var note=$("#foodnote").val();
		  var orderid=$("#foodqty").val();
		  var group=$("#foodgroup").val();
		  var geturl='<?php echo base_url();?>ordermanage/order/addnotetoupdate';
		  var dataString = "foodnote="+note+'&rowid='+rowid+'&orderid='+orderid+'&group='+group;
		  $.ajax({
		 	 type: "POST",
			 url: geturl,
			 data: dataString,
			 success: function(data) {
				 setTimeout(function () {
					toastr.options = {
					closeButton: true,
					progressBar: true,
					showMethod: 'slideDown',
					timeOut: 4000
					};
				toastr.success("Note Added Successfully", 'Success');
			   $('#updatefoodlist').html(data);
			   $('#vieworder').modal('hide');
			   }, 100); 
				 
			 } 
		});
	}
 </script>