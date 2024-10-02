<style>
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
.tab-content-xs{top:62px;position: relative;padding: 3px 0 40px;}
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
	line-height: 26px;
}
.popover {
	min-width: 50em !important;
}
.wrapper.pos {
	height: 100vh;
}
  .category-column {
    overflow: hidden;   
  }
  
   .category-column .product-category .listcat .{
    
    text-transform: capitalize;
  }
.parent {
  flex-wrap: wrap;
}
  .child {
  flex: 1 0 21%!important; 
  }

a[disabled="disabled"] {
  pointer-events: none;
}
.product-panel .panel-footer {
    
    text-align: center;
}
#caltotal {
    font-size: 56px;
  }  
  
  div.sticky {
  position: -webkit-sticky;
  position: sticky;
  bottom: -20px;
 
}
.tab-pane table tr td {
    text-align: left;
}
  
@keyframes anim_opa {
 50% {
opacity: 0.2;
}
}
  
  .col-md-2{
    width: 12%;
    display: inherit;
  }
  

@media (min-width: 768px) {  
  .category-column {    
    top: 1px;
    position: sticky;
  }
}
  
@media (max-width: 768px) {
 .tabsection {
	 left: 0;
	 padding: 9px 0px;
	}

    .product-category {
        display: flex;
    }

    .listcat {
        flex: 1 1 0;        
        border: 1px solid #fff;
    }
   .fixedclasspos {
       margin: unset;
   }
  #caltotal {
    font-size: 32px;
  }
  .category-column .product-category .listcat {
    font-size: 12px;
        text-transform: capitalize;
  }
  
}
@media (max-width:575px) {
 .tabsection {
	 left: 0;
	 padding: 15px 5px;
   		display: block;
	}
  .tab-content-xs{
    top:142px;
  }
  .col-md-6{
    width: 50%;
    display: inherit;
  }
  .nav-tabs {
    display: flex;
  }
  
}

</style>
<script src="<?php echo base_url();?>application/modules/ordermanage/assets/js/jspdf.umd.min.js"></script>
<script src="<?php echo base_url();?>application/modules/ordermanage/assets/js/html2pdf.bundle.min.js"></script>


<script>
  
   
    function calcNumbers(result){
        if(result=="C"){
            calc.displayResult.value='';
        }
        else{
        calc.displayResult.value=calc.displayResult.value+result;
        }
        
    }
    
     function inputNumbers(result){
        if(result=="C"){
            var totalpaid=0;
            $("#paidamount").val('');
            $("#change").val('');
        }
        else{
            var paidamount=$("#paidamount").val();
            var totalpaid=paidamount+result;
            $("#paidamount").val(totalpaid);
            var maintotalamount=$("#maintotalamount").val();
            var restamount=(parseFloat(totalpaid))-(parseFloat(maintotalamount));
            var changes=restamount.toFixed(2);
            $("#change").val(changes);
        }
        
        //placenum.paidamount.value=placenum.paidamount.value+result;
    }
    function givefocus(element){
         window.prevFocus = $(element);
    }
	function giveselecttab(element){
		$("#uidupdateid").val('');
		$('#onprocesslist').empty();
         window.prevsltab = $(element);
    }

    function inputNumbersfocus(result){
           if(result=="C"){
            var totalpaid=0;
           prevFocus.val(0);
            changedueamount();
        }
        else{
            if(prevFocus.val() == 0){
                prevFocus.val("")
            }
            var paidamount= prevFocus.val();
            var totalpaid=paidamount+result;
            prevFocus.val(totalpaid);
             changedueamount();
           
         
        }
    }
    </script>


<?php $subtotal=0;
    $ptdiscount=0;?>
  <div id="openregister" class="modal fade  bd-example-modal-lg" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id="openclosecash">
      
    </div>
  </div>
</div>

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
                                                <label class="control-label" for="foodnote"><?php echo display('foodnote') ?></label>
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="border:none;">
      <div class="modal-body" style="padding:0;">
        <div style="position:relative">
          <div class="calcbody">
            <form name="calc">
              <div class="cacldisplay">
                <input type="text" placeholder="0" name="displayResult" />
              </div>
              <div class="calcbuttons">
                <div class="calcrow">
                  <input type="button" name="c0" value="C" placeholder="0" onClick="calcNumbers(c0.value)">
                  <button type="button" data-dismiss="modal" aria-label="Close"> <i class="fa fa-power-off" aria-hidden="true"></i> </button>
                </div>
                <div class="calcrow">
                  <input type="button" name="b7" value="7" onClick="calcNumbers(b7.value)">
                  <input type="button" name="b8" value="8" onClick="calcNumbers(b8.value)">
                  <input type="button" name="b9" value="9" onClick="calcNumbers(b9.value)">
                  <input type="button" name="addb" value="+" onClick="calcNumbers(addb.value)">
                </div>
                <div class="calcrow">
                  <input type="button" name="b4" value="4" onClick="calcNumbers(b4.value)">
                  <input type="button" name="b5" value="5" onClick="calcNumbers(b5.value)">
                  <input type="button" name="b6" value="6" onClick="calcNumbers(b6.value)">
                  <input type="button" name="subb" value="-" onClick="calcNumbers(subb.value)">
                </div>
                <div class="calcrow">
                  <input type="button" name="b1" value="1" onClick="calcNumbers(b1.value)">
                  <input type="button" name="b2" value="2" onClick="calcNumbers(b2.value)">
                  <input type="button" name="b3" value="3" onClick="calcNumbers(b3.value)">
                  <input type="button" name="mulb" value="*" onClick="calcNumbers(mulb.value)">
                </div>
                <div class="calcrow">
                  <input type="button" name="b0" value="0" onClick="calcNumbers(b0.value)">
                  <input type="button" name="potb" value="." onClick="calcNumbers(potb.value)">
                  <input type="button" name="divb" value="/" onClick="calcNumbers(divb.value)">
                  <input type="button" class="calcred" value="=" onClick="displayResult.value = eval(displayResult.value)">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="payprint" class="modal fade  bd-example-modal-lg" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <strong><?php echo display('sl_payment');?></strong> </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-12 col-md-12">
            <div class="panel">
              <div class="panel-body">
                <div class="col-md-8">
                  <div class="form-group row">
                    <label for="card_typesl" class="col-sm-4 col-form-label"><?php echo display('paymd');?></label>
                    <div class="col-sm-7 customesl">
                      <?php $card_type=4;
                                  echo form_dropdown('card_typesl',$paymentmethod,(!empty($card_type)?$card_type:null),'class="postform resizeselect form-control" id="card_typesl"') ?>
                    </div>
                  </div>
                  <div id="cardarea" style="display:none; width:100%;" >
                    <div class="form-group row">
                      <label for="card_terminal" class="col-sm-4 col-form-label"><?php echo display('crd_terminal');?></label>
                      <div class="col-sm-7 customesl"> <?php echo form_dropdown('card_terminal',$terminalist,'','class="postform resizeselect form-control" id="card_terminal"') ?> </div>
                    </div>
                    <div class="form-group row">
                      <label for="bank" class="col-sm-4 col-form-label"><?php echo display('sl_bank');?></label>
                      <div class="col-sm-7 customesl"> <?php echo form_dropdown('bank',$banklist,'','class="postform resizeselect form-control" id="bank"') ?> </div>
                    </div>
                    <div class="form-group row">
                      <label for="last4digit" class="col-sm-4 col-form-label"><?php echo display('lstdigit');?></label>
                      <div class="col-sm-7 customesl">
                        <input type="text" class="form-control" id="last4digit" name="last4digit" value="" />
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="totalamount" class="col-sm-4 col-form-label"><?php echo display('total_amount');?></label>
                    <div class="col-sm-7 customesl">
                      <input type="hidden" id="maintotalamount" name="maintotalamount" value="" />
                      <input type="text" class="form-control" id="totalamount" name="totalamount" readonly="readonly" value="" />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="paidamount" class="col-sm-4 col-form-label"><?php echo display('cuspayment');?></label>
                    <div class="col-sm-7 customesl">
                      <input type="number"  class="form-control" id="paidamount" name="paidamount" placeholder="0" />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="change" class="col-sm-4 col-form-label"><?php echo display('cuspayment');?></label>
                    <div class="col-sm-7 customesl">
                      <input type="text" class="form-control" id="change" name="change" readonly="readonly" value="" />
                    </div>
                  </div>
                  <div class="form-group text-right">
                    <div class="col-sm-11" style="padding-right:0;">
                      <button type="button" id="paidbill" class="btn btn-success w-md m-b-5" onclick="orderconfirmorcancel()"><?php echo display('pay_print');?></button>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <form name="placenum">
                    <div class="grid-container">
                      <input type="button" class="grid-item" name="n1" value="1" onClick="inputNumbers(n1.value)">
                      <input type="button" class="grid-item" name="n2" value="2" onClick="inputNumbers(n2.value)">
                      <input type="button" class="grid-item" name="n3" value="3" onClick="inputNumbers(n3.value)">
                      <input type="button" class="grid-item" name="n4" value="4" onClick="inputNumbers(n4.value)">
                      <input type="button" class="grid-item" name="n5" value="5" onClick="inputNumbers(n5.value)">
                      <input type="button" class="grid-item" name="n6" value="6" onClick="inputNumbers(n6.value)">
                      <input type="button" class="grid-item" name="n7" value="7" onClick="inputNumbers(n7.value)">
                      <input type="button" class="grid-item" name="n8" value="8" onClick="inputNumbers(n8.value)">
                      <input type="button" class="grid-item" name="n9" value="9" onClick="inputNumbers(n9.value)">
                      <input type="button" class="grid-item" name="n10" value="10" onClick="inputNumbers(n10.value)">
                      <input type="button" class="grid-item" name="n20" value="20" onClick="inputNumbers(n20.value)">
                      <input type="button" class="grid-item" name="n50" value="50" onClick="inputNumbers(n50.value)">
                      <input type="button" class="grid-item" name="n100" value="100" onClick="inputNumbers(n100.value)">
                      <input type="button" class="grid-item" name="n500" value="500" onClick="inputNumbers(n500.value)">
                      <input type="button" class="grid-item" name="n1000" value="1000" onClick="inputNumbers(n1000.value)">
                      <input type="button" class="grid-item" name="n0" value="0" onClick="inputNumbers(n0.value)">
                      <input type="button" class="grid-item" name="n00" value="00" onClick="inputNumbers(n00.value)">
                      <input type="button" class="grid-item" name="c0" value="C" placeholder="0" onClick="inputNumbers(c0.value)">
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="paymentsselect" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <strong><?php echo display('sl_payment');?></strong> </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-12 col-md-12">
            <div class="panel">
              <div class="panel-body">
                <div class="form-group row">
                  <label for="payments" class="col-sm-4 col-form-label"><?php echo display('paymd');?></label>
                  <div class="col-sm-7 customesl">
                    <?php $card_type=4;
                                  echo form_dropdown('card_typesl',$paymentmethod,(!empty($card_type)?$card_type:null),'class="postform resizeselect form-control" id="card_typesl"') ?>
                  </div>
                </div>
                <div id="cardarea" style="display:none; width:100%;" >
                  <div class="form-group row">
                    <label for="card_terminal" class="col-sm-4 col-form-label"><?php echo display('crd_terminal');?></label>
                    <div class="col-sm-7 customesl"> <?php echo form_dropdown('card_terminal',$terminalist,'','class="postform resizeselect form-control" id="card_terminal"') ?> </div>
                  </div>
                  <div class="form-group row">
                    <label for="bank" class="col-sm-4 col-form-label"><?php echo display('sl_bank');?></label>
                    <div class="col-sm-7 customesl"> <?php echo form_dropdown('bank',$banklist,'','class="postform resizeselect form-control" id="bank"') ?> </div>
                  </div>
                  <div class="form-group row">
                    <label for="last4digit" class="col-sm-4 col-form-label"><?php echo display('lstdigit');?></label>
                    <div class="col-sm-7 customesl">
                      <input type="text" class="form-control" id="last4digit" name="last4digit" value="" />
                    </div>
                  </div>
                </div>
                <div class="form-group text-right">
                  <div class="col-sm-11" style="padding-right:0;">
                    <button type="button" class="btn btn-success w-md m-b-5" onclick="onlinepay()"><?php echo display('payn');?></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="cancelord" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <strong><?php echo display('can_ord');?></strong> </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-12 col-md-12">
            <div class="panel">
              <div class="panel-body">
                <div class="form-group row">
                  <label for="mycanorder" class="col-sm-4 col-form-label"><?php echo display('ordid');?></label>
                  <div class="col-sm-7 customesl"> <span id="canordid"></span>
                    <input name="mycanorder" id="mycanorder" type="hidden" value=""  />
                  </div>
                </div>
                <div class="form-group row">
                  <label for="canreason" class="col-sm-4 col-form-label"><?php echo display('can_reason');?></label>
                  <div class="col-sm-7 customesl">
                    <textarea name="canreason" id="canreason" cols="35" rows="3" class="form-control"></textarea>
                  </div>
                </div>
                <div class="form-group text-right">
                  <div class="col-sm-11" style="padding-right:0;">
                    <button type="button" class="btn btn-success w-md m-b-5" id="cancelreason"><?php echo display('submit');?></button>
                  </div>
                </div>
              </div>
            </div>
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
        <strong>
        <?php //echo display('unit_update');?>
        </strong> </div>
      <div class="modal-body addonsinfo"> </div>
    </div>
    <div class="modal-footer"> </div>
  </div>
</div>
<!-- 22-09 -->
<div id="payprint_marge" class="modal fade  bd-example-modal-lg" role="dialog">
  <div class="modal-dialog modal-lg" id="modal-ajaxview"> </div>
</div>
<div id="tablemodal" class="modal fade  bd-example-modal-lg" role="dialog">
  <div class="modal-dialog modal-inner" id="table-ajaxview"> </div>
</div>
<div id="payprint_split" class="modal fade  bd-example-modal-lg" role="dialog">
  <div class="modal-dialog modal-lg" id="modal-ajaxview-split"> </div>
</div>
<form action="<?php echo base_url("ordermanage/order/insert_customer") ?>" class="form-vertical" id="validate" method="post" accept-charset="utf-8">
  <div class="modal fade modal-warning" id="client-info" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h3 class="modal-title"><?php echo display('add_customer');?></h3>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <label for="name" class="col-sm-3 col-form-label"><?php echo display('customer_name');?> <i class="text-danger">*</i></label>
            <div class="col-sm-6">
              <input class="form-control simple-control" name ="customer_name" id="name" type="text" placeholder="Customer Name"  required="">
            </div>
          </div>
          <div class="form-group row">
            <label for="email" class="col-sm-3 col-form-label"><?php echo display('email');?> <i class="text-danger">*</i></label>
            <div class="col-sm-6">
              <input class="form-control" name ="email" id="email" type="email" placeholder="Customer Email"  required="">
            </div>
          </div>
          <div class="form-group row">
            <label for="mobile" class="col-sm-3 col-form-label"><?php echo display('mobile');?> <i class="text-danger">*</i></label>
            <div class="col-sm-6">
              <input class="form-control" name ="mobile" id="mobile" type="number" placeholder="Customer Mobile"  required="" min="0">
            </div>
          </div>
          <div class="form-group row">
            <label for="address " class="col-sm-3 col-form-label"><?php echo display('b_address');?></label>
            <div class="col-sm-6">
              <textarea class="form-control" name="address" id="address " rows="3" placeholder="Customer Address"></textarea>
            </div>
          </div>
          <div class="form-group row">
            <label for="favaddress " class="col-sm-3 col-form-label"><?php echo display('fav_addesrr');?></label>
            <div class="col-sm-6">
              <textarea class="form-control" name="favaddress" id="favaddress " rows="3" placeholder="Customer Address"></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo display('close');?> </button>
          <button type="submit" class="btn btn-success"><?php echo display('submit');?> </button>
        </div>
      </div>
      <!-- /.modal-content --> 
    </div>
    <!-- /.modal-dialog --> 
  </div>
  <!-- /.modal -->
</form>
<div class="modal fade modal-warning" id="myModal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"></h3>
      </div>
      <form id="updateCart" action="#" method="post">
        <div class="modal-body">
          <table class="table table-bordered table-striped">
            <tbody>
              <tr>
                <th style="width:25%;">Price</th>
                <th style="width:25%;"><span id="net_price" class="price"></span></th>
              </tr>
            </tbody>
          </table>
          <div class="form-group row">
            <label for="available_quantity" class="col-sm-4 col-form-label">Avail. Qty</label>
            <div class="col-sm-8">
              <input class="form-control" type="text" id="available_quantity" placeholder="Ava. Qnty" name="available_quantity" readonly="readonly">
            </div>
          </div>
          <div class="form-group row">
            <label for="unit" class="col-sm-4 col-form-label">Unit</label>
            <div class="col-sm-8">
              <input class="form-control" type="text" id="unit" placeholder="Unit" name="unit" readonly="readonly">
            </div>
          </div>
          <div class="form-group row">
            <label for="Qnty" class="col-sm-4 col-form-label">Qty <span class="color-red">*</span></label>
            <div class="col-sm-8">
              <input class="form-control" type="text" id="Qnty" name="quantity">
            </div>
          </div>
          <div class="form-group row">
            <label for="Rate" class="col-sm-4 col-form-label">Rate <span class="color-red">*</span></label>
            <div class="col-sm-8">
              <input class="form-control" type="text" id="Rate" name="rate">
            </div>
          </div>
          <div class="form-group row">
            <label for="Dis/ Pcs" class="col-sm-4 col-form-label">Dis/ Pcs</label>
            <div class="col-sm-8">
              <input class="form-control" type="text" id="Dis/ Pcs" placeholder="Dis/ Pcs" name="discount">
            </div>
          </div>
          <input type="hidden" name="rowID">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Save Changes</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>
<!-- /.modal -->
<?php 
 
$scan = scandir('application/modules/');
$qrapp=0;
foreach($scan as $file) {
   if($file=="qrapp"){
	   if (file_exists(APPPATH.'modules/'.$file.'/assets/data/env')){
	   $qrapp=1;
	   }
	   }
}

 ?>
<div class="row pos">
  <div class="panel">
    <div class="panel-body">
      <div class="tabsection"> 
        <span style="display: none;"><?php echo $settinginfo->language; ?></span>
        <div class="col-lg-6">        
        <ul class="nav nav-tabs mb-2" role="tablist">
          <li class="active"> <a href="#home" role="tab" data-toggle="tab" class="home btn-sm" onclick="giveselecttab(this)"> New </a> </li>
          <li><a href="#profile" role="tab" data-toggle="tab" class="ongord btn-sm" id="ongoingorder" onclick="giveselecttab(this)"> Ongoing </a> </li>
          <li><a href="#kitchen" role="tab" data-toggle="tab" class="torder btn-sm" id="kitchenorder" onclick="giveselecttab(this)"> Tables </a> </li>
          <?php if($qrapp==1){?>
          <li class="seelist2"> <a href="#qrorder" role="tab" data-toggle="tab" id="todayqrorder" class="home btn-sm" onclick="giveselecttab(this)"> <?php echo display('qr-order');?> </a> <a href="" class="notif2"><span class="label label-danger count2">0</span></a> </li>
          <?php } ?>
<!--          <li class="seelist"> <a href="#settings" role="tab" data-toggle="tab" class="comorder btn-sm" id="todayonlieorder" onclick="giveselecttab(this)"> --><?php //echo display('onlineord');?><!-- </a> <a href="" class="notif"><span class="label label-danger count">0</span></a> </li>-->
          <?php  if($this->session->userdata('isAdmin') ) { ?>
            <li> <a href="#messages" role="tab" data-toggle="tab" class="bg-info btn-sm" id="todayorder" onclick="giveselecttab(this)"> Done</a> </li>
           <?php } ?>
        </ul>
          </div>
        <div class="col-md-4 tgbar">
          <a href="javascript:;" class="btn" onclick="closeopenresister()" title="Close Register" role="button">
            <i class="fa fa-window-close fa-lg"></i>
          </a>
          <a href="<?php echo base_url();?>logout" class="btn" title="Logout" role="button">
            <i class="fa fa-sign-out fa-lg"></i>
          </a>
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" title="Toggle Sidebar" role="button"> <!-- Sidebar toggle button-->
          <span class="sr-only">Toggle navigation</span> <span class="pe-7s-keypad"></span> </a>
          <a id="fullscreen" href="#" title="Fullscreen"><i class="pe-7s-expand1"></i></a> 
          <a  href="#">
            <i class="fa fa-keyboard hover-q text-muted" aria-hidden="true" data-container="body" data-toggle="popover" data-placement="bottom" data-content="<table class='table table-condensed table-striped' >
        <tr>
        <th>Operations</th>
        <th>Keyboard Shortcut</th>
        <th>Operations</th>
        <th>Keyboard Shortcut</th>
    </tr>
     <tr>
    <td>New order tab</td>
    <td>shift+n</td>
    <td>On going tab</td>
    <td>shift+g</td>
    </tr>
    <tr>
    <td>Today order tab</td>
    <td>shift+t</td>
    <td>online order tab</td>
    <td>shift+o</td>
    </tr>
    <tr>
    <td>Place Order</td>
    <td>shift+p</td>
    <td>Quick Order</td>
    <td>shift+q</td>
    </tr>
    <tr>
    <td>Search product</td>
    <td>shift+s</td>
    <td>Select Customer</td>
    <td>shift+c</td>
    </tr>               
    <tr>
    <td>Select Customer Type</td>
    <td>shift+y</td>
    <td>Edit Discount:</td>
    <td>shift+d</td></tr>
    <tr>
    <td>Edit service charge</td>
    <td>shift+r</td>
    <td>Select waiter</td>
    <td>shift+w</td>
    </tr>          
    <tr>
    <td>select table</td>
    <td>shift+b</td>
    <td>Cooking time</td>
    <td>alt+k</td></tr>
    <tr>
    <td>Search Table</td>
    <td>alt+t</td>
    <td>Go Edit</td>
    <td>shift+e</td></tr>
    <tr>
    <td>Search today order</td>
    <td>shift+x</td>
    <td>Search online order</td>
    <td>shift+v</td>
    </tr>  
    <tr>
    <td>Update Search Product</td>
    <td>alt+s</td>
    <td>Update Select Customer</td>
    <td>alt+c</td>
    </tr>               
    <tr>
    <td>Update Select Customer Type</td>
    <td>alt+y</td>
    <td>Update Discount:</td>
    <td>alt+d</td></tr>
    <tr>
    <td>Update service charge:</td>
    <td>alt+r</td>
    <td>Update select table</td>
    <td>alt+b</td>
    </tr>          
    
    <td>Update Submit from</td>
    <td>alt+u</td>
    <td>Select payment type</td>
    <td>alt+m</td></tr>
    <tr>
    <td>Pay & Print bill</td>
    <td>alt+p</td>
    <td>Paid amount typing</td>
    <td>alt+a</td></tr>
</table>" data-html="true" data-trigger="hover" data-original-title="" title=""></i></a> </div>
        
      </div>
      
      <!-- Tab panes -->
      <div class="tab-content tab-content-xs">
        <div class="tab-pane fade active in" id="home">
          <div class="row">
            <div class="col-sm-12 col-md-12">
              <div class="panel">
                <input name="url" type="hidden" id="posurl" value="<?php echo base_url("ordermanage/order/getitemlist") ?>" />
                <input name="url" type="hidden" id="productdata" value="<?php echo base_url("ordermanage/order/getitemdata") ?>" />
                <input name="url" type="hidden" id="url" value="<?php echo base_url("ordermanage/order/itemlistselect") ?>" />
                <input name="url" type="hidden" id="carturl" value="<?php echo base_url("ordermanage/order/posaddtocart") ?>" />
                <input name="url" type="hidden" id="cartupdateturl" value="<?php echo base_url("ordermanage/order/poscartupdate") ?>" />
                <input name="url" type="hidden" id="addonexsurl" value="<?php echo base_url("ordermanage/order/posaddonsmenu") ?>" />
                <input name="url" type="hidden" id="removeurl" value="<?php echo base_url("ordermanage/order/removetocart") ?>" />
                <input name="updateid" type="hidden" id="updateid" value="" />
                <div class="row">
                  <div class="col-md-7">
                    <div class="row">
                      <div class="col-md-12">
                        <form class="navbar-search" method="get" action="<?php echo base_url("ordermanage/order/pos_invoice")?>" >
                          <label class="sr-only screen-reader-text" for="product_name"><?php echo display('search')?>:</label>
                          <div class="input-group">
                            <select id="product_name" class="form-control dont-select-me search-field" dir="ltr" name="s" tabindex="1">
                            </select>
                          </div>
                        </form>
                      </div>
                    </div>
                    <div class="row">
                      <div class="row" style="height: 100vh; overflow: auto;">                       
                  
                      <div class="col-sm-2 flex d-inline-flex p-0 category-column">
                        <div class="product-category parent">
                          <div class="listcat child" onclick="getslcategory('')"><?php echo display('all')?> </div>
                          <?php $result = array_diff($categorylist, array("Select Food Category"));
                                                                foreach($result as $key=>$test){ ?>
                          <div class="listcat child" onclick="getslcategory(<?php echo $key;?>)"><?php echo $test;?></div>
                          <?php } ?>
                        </div>
                      </div>
                      <div class="col-sm-10" >
                        <div class="product-grid">
                          <div class="row row-m-3" id="product_search">
                            <?php $i=0;
                                                                        foreach($itemlist as $item){
																			$item=(object)$item;
                                                                            $i++;
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
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-p-3">
                              <div class="panel panel-bd product-panel select_product">
                                <div class="panel-body"> <img src="<?php echo base_url(!empty($item->small_thumb)?$item->small_thumb:'assets/img/icons/default.jpg'); ?>" class="img-responsive" alt="<?php echo $item->ProductName;?>">
                                  <input type="hidden" name="select_product_id" class="select_product_id" value="<?php echo $item->ProductsID;?>">
                                  <input type="hidden" name="select_totalvarient" class="select_totalvarient" value="<?php echo $item->totalvarient;?>">
                                  <input type="hidden" name="select_iscustomeqty" class="select_iscustomeqty" value="<?php echo $item->is_customqty;?>">
                                  <input type="hidden" name="select_product_size" class="select_product_size" value="<?php echo $item->variantid;?>">
                                  <input type="hidden" name="select_product_isgroup" class="select_product_isgroup" value="<?php echo $item->isgroup;?>">
                                  <input type="hidden" name="select_product_cat" class="select_product_cat" value="<?php echo $item->CategoryID;?>">
                                  <input type="hidden" name="select_varient_name" class="select_varient_name" value="<?php echo $item->variantName;?>">
                                  <input type="hidden" name="select_product_name" class="select_product_name" value="<?php echo $item->ProductName; if(!empty($item->itemnotes)){ echo " -".$item->itemnotes;}?>">
                                  <input type="hidden" name="select_product_price" class="select_product_price" value="<?php echo $item->price;?>">
                                  <input type="hidden" name="select_addons" class="select_addons" value="<?php echo $getadons;?>">
                                </div>
                                <div class="panel-footer"><span><?php echo $item->ProductName;?> (<?php echo $item->variantName;?>)
                                  <?php if(!empty($item->itemnotes)){ echo " -".$item->itemnotes;}?>
                                  </span></div>
                              </div>
                            </div>
                            <?php } ?>
                          </div>
                        </div>
                      </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-5 sticky" style="padding-top: 12px;border-top: 1px solid #f1f1f1;">
                    <form action="<?php echo base_url("ordermanage/order/pos_order")?>" class="form-vertical" id="onlineordersubmit" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                      <div class="col-md-12 d-flex" >
                        <div class="col-md-6 form-group p-0" id="default_customer_name" style="flex:auto;">
                            <label for="customer_name"><?php echo display('customer_name');?><span class="color-red">*</span></label>
                            <div class="d-flex mx-1">
                              <?php $cusid=1;
                              echo form_dropdown('customer_name',$customerlist,(!empty($cusid)?$cusid:null),'class="postform resizeselect form-control" id="customer_name" required') ?>
                              <button type="button" class="btn btn-primary ml-l" aria-hidden="true" data-toggle="modal" data-target="#client-info"><i class="ti-plus"></i></button>
                            </div>
                          </div>
                          
                        <div class="col-md-6 form-group">
                          <label for="ctypeid">Serving Type <span class="color-red">*</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                          <?php $ctype=1;
                          echo form_dropdown('ctypeid',$curtomertype,(!empty($ctype)?$ctype:null),'class="form-control" id="ctypeid" required') ?>
                        </div>
                        
                        
                      </div>
                        <div id="nonthirdparty" class="col-md-12 p-0 d-flex">
                          
                         <div class="col-md-12 p-0 d-flex">  
                            <?php if($possetting->waiter==1){?>
                            <div class="col-md-3 form-group">
                              <label for="waiter"><?php echo display('waiter');?> <span class="color-red">*</span></label>
                              <?php $waiter_id = $this->session->userdata('id');
                              if(!$this->session->userdata('isAdmin')) {
                                 // echo  '<select name="waiter" id="waiter" class="form-control single-select" tabindex="-1" aria-hidden="true"><option value="'.$waiterkitchen.'" selected="selected">'.$this->session->userdata('fullname').'</option></select>';
                                
                                echo form_dropdown('waiter',$waiterlist, $waiter_id,' class="form-control" id="waiter" required');
                             }else {
                                //  echo form_dropdown('waiter',$waiterlist,(!empty($waiterlist) ?  $waiterlist:null),' class="form-control" id="waiter"');                                
                                                               echo form_dropdown('waiter',$waiterlist,$waiter_id,' class="form-control" id="waiter" required');
                              }?>
                            </div>
                           <div class="col-md-3 form-group" id="active_hotel_customer">
                              <label for="hotel_customer_name">Hotel Guest <span class="color-red">*</span></label>
                           
                                  <?php  $agid=2;
                                                            
                                  echo form_dropdown('hotel_customer_name',$active_hotel_customer,(!empty($agid)?$agid:null),'class="form-control" id="hotel_customer_name"') ?>
                              
                          </div>
                            <?php
                            if($possetting->tablemaping==1){								?>
                            <div class="col-md-3 form-group" id="tblsecp">
                              <label for="table_member" style="width:100%;">No.<span class="color-red">*</span></label>
                              <input style="width:auto;"  name="" type="button" class="btn btn-primary  form-control" onclick="showTablemodal()" id="table_person" value="<?php echo display('person');?>">
                              <input type="hidden" id="table_member" name="table_member" class="form-control" value="" />
                            </div>
                            <?php } ?>
                            <div class="col-md-3 form-group" id="tblsec"> 
                              <!--  <div class="d-flex"> -->
                              <label for="tableid"><?php echo display('table');?> <span class="color-red">*</span></label>
                              <?php echo form_dropdown('tableid',$tablelist,(!empty($tablelist->tableid)?$tablelist->tableid:null),'class="postform resizeselect form-control" id="tableid" required onchange="checktable()"')?>
                              <input type="hidden" id="table_member_multi" name="table_member_multi" class="form-control" value="0" />
                              <input type="hidden" id="table_member_multi_person" name="table_member_multi_person" class="form-control" value="0" />
                              <!-- working --> 
                              <!--   </div> --> 
                            </div>
                            <?php }
																	   //if($possetting->cooktime==1){
																	   ?>
<!--                            <div class="col-md-3 form-group" id="cookingtime">-->
<!--                              <label for="cookedtime">--><?php //echo display('cookedtime');?><!--</label>-->
<!--                              <input name="cookedtime" type="text" class="form-control timepicker3" id="cookedtime" placeholder="00:00:00" autocomplete="off" />-->
<!--                            </div>-->
                            <?php //} ?>
                         </div>
                        </div>
                        <div id="thirdparty" style="display:none;">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="delivercom"><?php echo display('del_company');?> <span class="color-red">*</span>&nbsp;&nbsp;&nbsp;&nbsp;</label>
                              <?php echo form_dropdown('delivercom',$thirdpartylist,(!empty($thirdpartylist->companyId)?$thirdpartylist->companyId:null),'class="form-control" style="width:95%;" id="delivercom" required disabled="disabled"') ?> </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="thirdinvoiceid"><?php echo display('thirdparty_orderid');?>&nbsp;&nbsp;&nbsp;&nbsp;</label>
                              <input  name="thirdinvoiceid" type="text" class="form-control" id="thirdinvoiceid">
                            </div>
                          </div>
                        </div>
                      
                        <div class="form-group">
                          <input class="form-control" type="hidden" id="order_date" name="order_date" required value="<?php echo date('d-m-Y')?>" />
                          <input class="form-control" type="hidden" id="bill_info" name="bill_info" required value="1"  />
                          <input type="hidden" id="card_type" name="card_type" value="4" />
                          <input type="hidden" id="isonline" name="isonline" value="0" />
                          <input type="hidden" id="assigncard_terminal" name="assigncard_terminal" value="" />
                          <input type="hidden" id="assignbank" name="assignbank" value="" />
                          <input type="hidden" id="assignlastdigit" name="assignlastdigit" value="" />
                          <input type="hidden" id="product_value" name="">
                        </div>                    
                      
                      <div class="col-md-12 product-list" style="overflow: auto; width: 100%;">
                        <div class="table-responsive" id="addfoodlist">
                          <?php $grtotal=0;
                                                                    $totalitem=0;
                                                                     $calvat=0;
                                                                     $discount=0;
                                                                     $itemtotal=0;
																	  $pdiscount=0;
                                                                      $this->load->model('ordermanage/order_model', 'ordermodel');
                        if($cart = $this->cart->contents()){?>
                          <table class="table table-bordered" border="1" width="100%" id="addinvoice">
                            <thead style="background-color:#f7f9fa;">
                            
                                <th><?php echo display('item')?></th>
                                <th><?php echo display('varient_name')?></th>
                                <th width="100"><?php echo display('price');?></th>
                                <th width="100"><?php echo display('quantity');?></th>
                                <th width="100"><?php echo display('total');?></th>
                                <th><?php echo display('action');?></th>
                            
                            </thead>
                            <tbody class="itemNumber">
                              <?php $i=0; 
                                                                          $totalamount=0;
                                                                          $subtotal=0;
																		  $ptdiscount=0;
																		  $pvat=0;
                                                                        foreach ($cart as $item){
																			$iteminfo=$this->ordermodel->getiteminfo($item['pid']);
                                                                            $itemprice= $item['price']*$item['qty'];
																$vatcalc=$itemprice*$iteminfo->productvat/100;
																$pvat=$pvat+$vatcalc;
																			
																			if($iteminfo->OffersRate>0){
																				$mypdiscount=$iteminfo->OffersRate*$itemprice/100;
																				$ptdiscount=$ptdiscount+($iteminfo->OffersRate*$itemprice/100);
																				}
																			else{
																				$mypdiscount=0;
																				$pdiscount=$pdiscount+0;
																				}
                                                                            if(!empty($item['addonsid'])){
                                                                                $nittotal=$item['addontpr'];
                                                                                $itemprice=$itemprice+$item['addontpr'];
                                                                                }
                                                                            else{
                                                                                $nittotal=0;
                                                                                $itemprice=$itemprice;
                                                                                }
                                                                             $totalamount=$totalamount+$nittotal;
                                                                             $subtotal=$subtotal+$nittotal+$item['price']*$item['qty'];
                                                                        $i++;
                                                                        ?>
                              <tr id="<?php echo $i;?>">
                                <td class="text-left" id="product_name_MFU4E" style="text-align: left;">
                                    <?php echo $item['name'];
                                    if(!empty($item['addonsid'])){
                                        echo "<br>";
                                        echo $item['addonname'];
                                        }
                                    ?>
                                    <a class="serach" onclick="itemnote('<?php echo $item['rowid']?>','<?php echo $item['itemnote']?>',<?php echo $item['qty'];?>,2)" style="padding-left:15px;" title="<?php echo display('foodnote') ?>"> <i class="fa fa-sticky-note" aria-hidden="true"></i> </a></td>
                                <td style="text-align: left;"><?php echo $item['size'];?></td>
                                <td style="text-align: right;"><?php if($currency->position==1){echo $currency->curr_icon;}?>
                                  <?php echo number_format($item['price'],2,'.','');?>
                                  <?php if($currency->position==2){echo $currency->curr_icon;}?></td>
                                <td scope="row"><a class="btn btn-info btn-sm btn-left-align" onclick="posupdatecart('<?php echo $item['rowid']?>',<?php echo $item['sizeid']?>,<?php echo $item['qty'];?>,'add')"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                    <span id="productionsetting-<?php echo $item['pid'].'-'.$item['sizeid'] ?>"> <?php echo number_format($item['qty'],0);?> </span>
                                    <a class="btn btn-danger btn-sm btn-right-align" onclick="posupdatecart('<?php echo $item['rowid']?>',<?php echo $item['sizeid']?>,<?php echo $item['qty'];?>,'del')"><i class="fa fa-minus" aria-hidden="true"></i></a>
                                </td>
                                <td width="auto" style="text-align: right;"><?php if($currency->position==1){echo $currency->curr_icon;}?>
                                  <?php echo number_format($itemprice-$mypdiscount, 2);?>
                                  <?php if($currency->position==2){echo $currency->curr_icon;}?></td>
                                <td width="80"><a class="btn btn-danger btn-sm btn-right-align" onclick="removecart('<?php echo $item['rowid'];?>')"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
                              </tr>
                            <?php }
                                                $itemtotal=$subtotal;
                                if($settinginfo->vat>0){
                                    $calvat=$itemtotal*$settinginfo->vat/100;
                                         }
                                    else{
                                    $calvat=$pvat;
                                        }
                                    $grtotal=$itemtotal;
                                        $totalitem=$i;
                                                ?>
                            </tbody>
                          </table>
                          <?php $pdiscount=$ptdiscount;} 
																	
							?>
                          <input name="subtotal" id="subtotal" type="hidden" value="<?php echo $subtotal-$ptdiscount;?>" />
                          <?php 
						  if(!empty($this->cart->contents())){
						 	if($settinginfo->service_chargeType==1){
							$totalsercharge=$subtotal-$pdiscount;
							  $servicetotal=$settinginfo->servicecharge*$totalsercharge/100;
							 }
							 else{
								 $servicetotal=$settinginfo->servicecharge;
								 }
						  $servicecharge= $settinginfo->servicecharge;
							}
						else{
							$servicetotal=0;
							$servicecharge=0;
							}
						  ?>
                        </div>
                      </div>
                    <div class="fixedclasspos">
                        <div class="row">  <!-- d-flex flex-wrap align-items-center" -->
                          <div class="col-md-4">
                            
                          </div>
                          <div class="col-md-4 col-sm-12">
                            <input name="distype" id="distype" type="hidden" value="<?php echo $settinginfo->discount_type;?>" />
                            <input name="sdtype" id="sdtype" type="hidden" value="<?php echo $settinginfo->service_chargeType;?>" />
                            <input type="hidden" id="orginattotal" value="<?php echo $calvat+$itemtotal+$servicetotal-($discount+$pdiscount);?>" name="orginattotal">
                            <input type="hidden" id="invoice_discount" class="form-control text-right" name="invoice_discount" value="<?php echo $discount+$pdiscount?>">
                              <table class="table table-bordered footersumtotal">
                                  <tr>
                                      <td><div class="row m-0">
                                              <label for="vat" class="col-sm-8 mb-0"><?php echo display('vat_tax1')?>:
                                           
                                                  <input type="hidden" id="vat" name="vat" value="<?php echo $calvat;?>"/>
                                              </label>
                                              <strong>
                                                  <?php if($currency->position==1){echo $currency->curr_icon;}?>
                                                  <span id="calvat"> <?php echo $calvat;?></span>
                                                  <?php if($currency->position==2){echo $currency->curr_icon;}?>
                                              </strong>
                                              </label>
                                          </div></td>
                                      <td rowspan="2" id="grandtxt">
                                          <label for="orggrandTotal" class="mb-0 col-sm-5"><?php echo display('grand_total')?>:</label>
                                          <label class="col-sm-7 p-0 mb-0">
                                              <input type="hidden" id="orggrandTotal" value="<?php echo $calvat+$itemtotal+$servicetotal-($discount+$pdiscount);?>" name="orggrandTotal">
                                              <input name="grandtotal" type="hidden" value="<?php echo $calvat+$itemtotal+$servicetotal-($discount+$pdiscount);?>" id="grandtotal" />
                                              <span class="badge badge-primary grandbg" style="width: 100%;">
                                                  <span style="text-align: left;font-size: 35px;">
                                                      <?php if($currency->position==1){echo $currency->curr_icon;}?>
                                                      <span id="caltotal" style="font-family: monospace;font-weight:800;"><?php $totalTxt = $calvat+$itemtotal+$servicetotal-($discount+$pdiscount);
                                                      echo number_format($totalTxt, 2); ?></span>
                                                      <?php if($currency->position==2){echo $currency->curr_icon;}?>
                                                  </span>
                                              </span>
                                          </label>
                                      </td>
                                  </tr>
                                  <tr>
                                    <td><?php if($servicecharge) { ?>
                                                        
                                                        <label for="service_charge" class="col-sm-8 mb-0"><?php echo display('service_chrg')?>
                                              <?php if($settinginfo->service_chargeType==0){ echo "(".$currency->curr_icon.")";}else{ echo "(%)";}?>
                                              :</label>
                                          <div class="col-sm-4 p-0">
                                              <input type="text" id="service_charge" onkeyup="calculatetotal();"  class="form-control text-right" value="<?php echo $servicecharge;?>" name="service_charge" placeholder ="0.00" style="margin-bottom:5px;" />
                                          </div>
                                      <?php } ?>
                                    </td>

                                  </tr>
                              </table>
                          </div>
                          <div class="col-md-4 text-right"> <a class="btn btn-primary cusbtn" data-toggle="modal" data-target="#exampleModal" style=""><i class="fa fa-calculator" aria-hidden="true"></i></a> <a href="<?php echo base_url("ordermanage/order/posclear") ?>" type="button" class="btn btn-danger cusbtn"><?php echo display('cancel')?></a>
                            <input type="hidden" id="getitemp" name="getitemp" value="<?php echo $totalitem-$discount;?>" />
<!--                            <input type="button" id="add_payment2" class="btn btn-primary btn-large cusbtn" onclick="quickorder()" name="add-payment" value="--><?php //echo display('quickorder') ?><!--">-->
                            <input type="button" id="add_payment" class="btn btn-success btn-large cusbtn" onclick="placeorder()" name="add-payment" value="<?php echo display('placeorder') ?>">
                            <!--<button type="button" class="btn btn-purple payment_button cusbtn" data-toggle="modal" data-target="#paymentsselect">Payment</button>--> 
                            <!--<input type="button" id="add_payment_cart" class="btn btn-info btn-large cusbtn" name="add-card" value="Card Payment" style="margin-right:30px;">-->
                            
                            <input type="hidden" id="production_setting" value="<?php echo $possetting->productionsetting; ?>" >
                            <input type="hidden" id="production_url" value="<?php echo base_url("production/production/ingredientcheck") ?>">
                              <input type="hidden" id="pdf_token" >
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="profile">
          <div class="row" id="onprocesslist"> </div>
        </div>
        <div class="tab-pane fade" id="kitchen">
          <div class="row" id="kitchenstatus"> </div>
        </div>
        <?php if($qrapp==1){?>
        <div class="tab-pane fade" id="qrorder"> </div>
        <?php } ?>
        <div class="tab-pane fade" id="settings"> </div>
        <div class="tab-pane fade" id="messages"> </div>
      </div>
    </div>
  </div>
</div>
<div id="payprint2"> </div>
<div class="modal fade modal-warning" id="posprint" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body" id="kotenpr"> </div>
    </div>
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>
<div id="orderdetailsp" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <strong>
        <?php //echo display('unit_update');?>
        </strong> </div>
      <div class="modal-body orddetailspop"> </div>
    </div>
    <div class="modal-footer"> </div>
  </div>
</div>
<?php 
$scan1 = scandir('application/modules/');
		$getdisc="";
		foreach($scan1 as $file) {
		   if($file=="loyalty"){
			   if (file_exists(APPPATH.'modules/'.$file.'/assets/data/env')){
			   $getdisc=1;
			   }
			   }
		} 
?>
<?php if($this->uri->segment(4)!=''){ ?>


<script src="assets/js/jspdf.umd.js"></script>
<script>
  
$(document).ready(function(){
swal({
        title: "<?php echo display('ord_uodate_success');?>",
        text: "<?php echo display('do_print_token');?>",
        type: "success",
        showCancelButton: true,
        confirmButtonColor: "#28a745",
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: true
    },
function (isConfirm) {
        if (isConfirm) {
          window.location.href="<?php echo base_url()?>ordermanage/order/postokengenerate/<?php echo $this->uri->segment(4);?>/1";
        } else {
            window.location.href="<?php echo base_url()?>ordermanage/order/pos_invoice";
        }
    });
});
</script>


<?php } ?>

<script src="<?php echo base_url();?>application/modules/ordermanage/assets/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url();?>application/modules/ordermanage/assets/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>application/modules/ordermanage/assets/js/websocket-printer.js"></script>


<script>
  
  $(window).on('load', function() {

  // Run code
  $(".sidebar-mini").addClass('sidebar-collapse');
  var myurl="<?php echo base_url()?>ordermanage/order/cashregister";
  $.ajax({
            type: "GET",
            async: false,
            url: myurl,
            success: function(data) {
			if(data==1){return false; }
			   $('#openclosecash').html(data);
			   $('#openregister').modal({
			   backdrop: 'static',
			   keyboard: false
			  });
            }
        });
  
  
	  
});
  
  
$(document).ready(function () {
    "use strict";
    // select 2 dropdown 
    $("select.form-control:not(.dont-select-me)").select2({
        placeholder: "<?php echo display('sl_option') ?>",
        allowClear: true,
      
    });




      //form validate
    $("#validate").validate();
    $("#add_category").validate();
    $("#customer_name").validate();

   /* $('.product-list').slimScroll({
        size: '3px',
       height: '545px',
        allowPageScroll: true,
        railVisible: true
    });*/

   /* $('.product-grid').slimScroll({
        size: '3px',
        height: '470px',
        allowPageScroll: true,
        railVisible: true
    });*/

  
});


 

 //Product search js
 function getslcategory(carid){
        var product_name = $('#product_name').val();
        var category_id = carid;
        var myurl= $('#posurl').val();
        $.ajax({
            type: "post",
            async: false,
            url: myurl,
            data: {product_name: product_name,category_id:category_id,isuptade:0},
            success: function(data) {
                if (data == '420') {
                    $("#product_search").html('Product not found !');
                }else{
                    $("#product_search").html(data); 
                }
            },
            error: function() {
                alert('<?php echo display('req_failed');?>');
            }
        });
     }
   
//Product search button js
    $('body').on('click', '#search_button', function() {
        var product_name = $('#product_name').val();
        var category_id = $('#category_id').val();
        var myurl= $('#posurl').val();
        $.ajax({
            type: "post",
            async: false,
            url: myurl,
            data: {product_name: product_name,
                   category_id:category_id},
            success: function(data) {
                if (data == '420') {
                    $("#product_search").html('Product not found !');
                }else{
                    $("#product_search").html(data); 
                }
            },
            error: function() {
                alert('<?php echo display('req_failed');?>');
            }
        });
    });    

//Product search button js
    $('body').on('click', '.select_product', function(e) {
        e.preventDefault();
       
        var panel = $(this);
        var pid = panel.find('.panel-body input[name=select_product_id]').val();
        var sizeid = panel.find('.panel-body input[name=select_product_size]').val();
		var totalvarient = panel.find('.panel-body input[name=select_totalvarient]').val();
		var customqty = panel.find('.panel-body input[name=select_iscustomeqty]').val();
		var isgroup = panel.find('.panel-body input[name=select_product_isgroup]').val();
        var catid = panel.find('.panel-body input[name=select_product_cat]').val();
        var itemname= panel.find('.panel-body input[name=select_product_name]').val();
        var varientname=panel.find('.panel-body input[name=select_varient_name]').val();
        var qty=1;
        var price=panel.find('.panel-body input[name=select_product_price]').val();
        var hasaddons=panel.find('.panel-body input[name=select_addons]').val();
        if(hasaddons==0 && totalvarient==1 && customqty==0){
            /*check production*/
                var productionsetting = $('#production_setting').val();
                if(productionsetting == 1){
                   
                    var isselected = $('#productionsetting-'+pid+'-'+sizeid).length;
                  
                    if(isselected ==1 ){

                        var checkqty = parseInt($('#productionsetting-'+pid+'-'+sizeid).text())+qty;

                                               
                    }
                    else{
                        var checkqty = qty;
                    }

                     var checkvalue = checkproduction(pid,sizeid,checkqty);

                        if(checkvalue == false){
                            return false;
                        }
                    
                }
            /*end checking*/
        var mysound=baseurl+"assets/";
        var audio =["beep-08b.mp3"];
        new Audio(mysound + audio[0]).play();
        var dataString = "pid="+pid+'&itemname='+itemname+'&varientname='+varientname+'&qty='+qty+'&price='+price+'&catid='+catid+'&sizeid='+sizeid+'&isgroup='+isgroup;
        var myurl= $('#carturl').val();
         $.ajax({
             type: "POST",
             url: myurl,
             data: dataString,
             success: function(data) {
                    $('#addfoodlist').html(data);
                    var total=$('#grtotal').val();
                    var totalitem=$('#totalitem').val();
                    $('#item-number').text(totalitem);
                    $('#getitemp').val(totalitem);
                    var tax=$('#tvat').val();
                    $('#vat').val(tax);
                    var discount=$('#tdiscount').val();
                     var tgtotal = parseFloat($('#tgtotal').val(),10).toFixed(2);
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
             var dataString = "pid="+pid+"&sid="+sizeid;
            $.ajax({
             type: "POST",
             url: geturl,
             data: dataString,
             success: function(data) {
                     $('.addonsinfo').html(data);
                     $('#edit').modal('show');
                     var totalitem=$('#totalitem').val();
                     var tax=$('#tvat').val();
                    var discount=$('#tdiscount').val();
                    var tgtotal = parseFloat($('#tgtotal').val(),10).toFixed(2);
                    $('#vat').val(tax);
                    $('#calvat').text(tax);
                    $('#getitemp').val(totalitem);
                    $('#invoice_discount').val(discount);
                    $('#caltotal').text(tgtotal);
                    $('#grandtotal').val(tgtotal);
                    $('#orggrandTotal').val(tgtotal);
                    $('#orginattotal').val(tgtotal);
             } 
        });
         }
    });

 //Payment method toggle 
    $(document).ready(function(){
        $("#nonthirdparty").show();
        $("#active_hotel_customer").hide();
        $("#thirdparty").hide();
        $("#delivercom").prop('disabled', true);
        $("#waiter").prop('disabled', false);
        $("#tableid").prop('disabled', false);
        $("#cookingtime").prop('disabled', false);
        $("#cardarea").hide();
        $("#default_customer_name").show();
        
        
        $("#paidamount").on('keyup', function(){ 
            var maintotalamount=$("#maintotalamount").val();
            var paidamount=$("#paidamount").val();
            var restamount=(parseFloat(paidamount))-(parseFloat(maintotalamount));
            var changes=restamount.toFixed(2);
            $("#change").val(changes);
        });
        
        $(".payment_button").click(function(){
            $(".payment_method").toggle();

            //Select Option
            $("select.form-control:not(.dont-select-me)").select2({
                placeholder: "<?php echo display('sl_option') ?>",
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
            	$("#cardarea").hide();
            }
          else if(cardtype==8){
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
         
        });
        $("#ctypeid").on('change', function(){ 
            var customertype=$("#ctypeid").val();
            if(customertype==3){
            $("#delivercom").prop('disabled', false);
            $("#waiter").prop('disabled', true);
            $("#tableid").prop('disabled', true);
            $("#cookingtime").prop('disabled', true);
            $("#nonthirdparty").hide();
            $("#thirdparty").show();
            $("#active_hotel_customer").hide();
            $("#default_customer_name").show();
              $("#customer_name").attr("disabled", false); 
              $("#customer_name").val(1).trigger('change');
            }
            else if(customertype==4){
                $("#nonthirdparty").show();
                $("#thirdparty").hide();
                $("#tblsec").hide();
				$("#tblsecp").hide();
                $("#delivercom").prop('disabled', true);
                $("#waiter").prop('disabled', false);
                $("#tableid").prop('disabled', true);
                $("#cookingtime").prop('disabled', true);
                $("#active_hotel_customer").hide();
                $("#default_customer_name").show();
              $("#customer_name").attr("disabled", false); 
              $("#customer_name").val(1).trigger('change');
            }
			else if(customertype==2){
                $("#nonthirdparty").show();
                $("#tblsecp").hide();
				$("#tblsec").hide();
                $("#thirdparty").hide();
                $("#active_hotel_customer").hide();
                $("#waiter").prop('disabled', false);
                $("#tableid").prop('disabled', false);
                $("#cookingtime").prop('disabled', false);
                $("#delivercom").prop('disabled', true);
                $("#default_customer_name").show();
              $("#customer_name").attr("disabled", false); 
              $("#customer_name").val(1).trigger('change');
            }
            else if(customertype==99){
                $("#nonthirdparty").show();
                $("#active_hotel_customer").show();
                $("#tblsecp").hide();
                $("#tblsec").hide();
                $("#thirdparty").hide();
                $("#waiter").prop('disabled', false);
                $("#tableid").prop('disabled', false);
                $("#cookingtime").prop('disabled', false);
                $("#delivercom").prop('disabled', true);
                $("#default_customer_name").show();
              	$("#customer_name").val(21).trigger('change');
				$("#customer_name").attr("disabled", true); 

            } else if(customertype==100){
                $("#nonthirdparty").show();
                $("#active_hotel_customer").show();
                $("#tblsecp").show();
                $("#tblsec").show();
                $("#thirdparty").hide();
                $("#waiter").prop('disabled', false);
                $("#tableid").prop('disabled', false);
                $("#cookingtime").prop('disabled', true);
                $("#delivercom").prop('disabled', true);
                $("#default_customer_name").show();
              	$("#customer_name").val(21).trigger('change');
				$("#customer_name").attr("disabled", false); 

            }
            else{
                $("#nonthirdparty").show();
                $("#default_customer_name").show();
                $("#tblsecp").show();
				$("#tblsec").show();
                $("#thirdparty").hide();
                $("#active_hotel_customer").hide();
                $("#waiter").prop('disabled', false);
                $("#tableid").prop('disabled', false);
                $("#cookingtime").prop('disabled', false);
                $("#delivercom").prop('disabled', true);
              	$("#customer_name").attr("disabled", false); 
              	$("#customer_name").val(1).trigger('change');
                
                }
        });
        $('[data-toggle="popover"]').popover({
container: 'body' });
        /*place order*/
        Mousetrap.bind('shift+p', function() {
             
                placeorder();
            });
        /*quick order*/
        Mousetrap.bind('shift+q',function(){
            quickorder();
          });
        /*select customer name*/
        Mousetrap.bind('shift+c',function(){
             $("#customer_name").select2('open');
          });

         /*select customer type*/
        Mousetrap.bind('shift+y',function(){
             $("#ctypeid").select2('open');
          });

        /*focus on discount*/
        Mousetrap.bind('shift+d',function(){
             $("#invoice_discount").focus();
             return false;
          });
        /*focus service charge*/
        Mousetrap.bind('shift+r',function(){
             $("#service_charge").focus();
             return false;
          });
               /*go ongoing order tab*/
        Mousetrap.bind('shift+g',function(){
             $(".ongord").trigger( "click" );
          });
        /*go total order tab*/
         Mousetrap.bind('shift+t',function(){
             $(".torder").trigger( "click" );
          });
        /*go online order tab*/
        Mousetrap.bind('shift+o',function(){
             $(".comorder").trigger( "click" );
          });
        /*go new order tab*/
        Mousetrap.bind('shift+n',function(){
             $(".home").trigger( "click" );
          });

        /*search unique product for cart*/
        Mousetrap.bind('shift+s',function(){
                    $("#product_name").select2('open');
                       });
        /*select item qty on addons modal*/
        Mousetrap.bind('alt+q',function(){
                    $('#itemqty_1').focus();
                    return false;
                       });
            /*add to cart on addons modal*/
        Mousetrap.bind('shift+a',function(){
                     $("#add_to_cart").trigger( "click" );
                       });
            /*edit on going order*/
        Mousetrap.bind('shift+e',function(e){
                   $('[id*=table-]').focus();
                  
                       });
       
          /*table search*/
        Mousetrap.bind('shift+x',function(e){
            $("input[aria-controls=onprocessing]").focus();
             return false;
          });
        /*table search*/
        Mousetrap.bind('shift+v',function(e){
            $("input[aria-controls=Onlineorder]").focus();
             return false;
          });
         /*edit on going order*/
        Mousetrap.bind('shift+m',function(e){
             $('[id*=table-today-]').focus();
                  
                       });
          /*select cooking time*/
        Mousetrap.bind('alt+k',function(){
                    $('#cookedtime').focus();
                    return false;
                       });
         /*select waiter*/
        Mousetrap.bind('shift+w',function(){
                   $('#waiter').select2('open');
                    return false;
                       });
         /*select table*/
        Mousetrap.bind('shift+b',function(){
                    $('#tableid').select2('open');
                    return false;
                       });
        /*select uniqe table on going order*/
        Mousetrap.bind('alt+t',function(){
                 $("#ongoingtable_name").select2('open');
                       });
        
        /*select update order list*/
        Mousetrap.bind('alt+s',function(){
                    $("#update_product_name").select2('open');
                       });
        /*select customer name*/
        Mousetrap.bind('alt+c',function(){
             $("#customer_name_update").select2('open');
          });

         /*select customer type*/
        Mousetrap.bind('alt+y',function(){
             $("#ctypeid_update").select2('open');
          });
         /*select waiter*/
        Mousetrap.bind('alt+w',function(){
                   $('#waiter_update').select2('open');
                    return false;
                       });
         /*select table*/
        Mousetrap.bind('alt+b',function(){
                    $('#tableid_update').select2('open');
                    return false;
                       });
           /*focus on discount*/
        Mousetrap.bind('alt+d',function(){
             $("#invoice_discount_update").focus();
             return false;
          });
        /*focus service charge*/
        Mousetrap.bind('alt+r',function(){
             $("#service_charge_update").focus();
             return false;
          });
         /*submit  update order*/
        Mousetrap.bind('alt+u',function(){
                     $("#update_order_confirm").trigger( "click" );
                       });
        /*end update sort cut*/
        /*quick paid modal*/
         /*select payment type name*/
        Mousetrap.bind('alt+m',function(){
             $(".card_typesl").select2('open');
          });
          /*type paid amount*/
        Mousetrap.bind('alt+a',function(){
             $('.number').focus();
              //window.prevFocus = $('.number');
             return false;
          });
          /*print bill paid amount*/
        Mousetrap.bind('alt+p',function(){
             $('#pay_bill').trigger( "click" );
          });
          /*print bill paid amount*/
        Mousetrap.bind('alt+x',function(){
             $('.close').trigger( "click" );
          });

    $('.search-field').select2({
        placeholder: '<?php echo display('sl_product') ?>',

        minimumInputLength: 1,
     
        ajax: {
          url: 'getitemlistdroup',
          dataType: 'json',
          delay: 200,
          processResults: function (data) {
            return {
             // results: data
              results:  $.map(data, function (item) {
                    return {
      					//results: data,
                        text: item.text+'-'+item.variantName+' - '+item.price,
                        id: item.id,
                        variantid: item.variantid,
                    }
                })
            };
          },
          cache: true
        },
      
      
      });
    
    /*all ongoingorder product as ajax*/
    $(document).on('click','#ongoingorder',function(){
      
          var url= 'getongoingorder';
         $.ajax({
             type: "GET",
             url: url,
             success: function(data) {
              $('#onprocesslist').html(data);
        }

        }); 


        });
	 /*all ongoingorder product as ajax*/
    $(document).on('click','#kitchenorder',function(){
          var url= 'kitchenstatus';
         $.ajax({
             type: "GET",
             url: url,
             success: function(data) {
              $('#kitchen').html(data);
        }

        }); 


        });
     /*all todayorder product as ajax*/
    $(document).on('click','#todayorder',function(){
          var url= 'showtodayorder';
         $.ajax({
             type: "GET",
             url: url,
             success: function(data) {
              $('#messages').html(data);
        }

        }); 


        });
          /*all todayorder product as ajax*/
    $(document).on('click','#todayonlieorder',function(){

          var url= 'showonlineorder';
         $.ajax({
             type: "GET",
             url: url,
             success: function(data) {
              $('#settings').html(data);
        }

        }); 


        });
		       /*all todayorder product as ajax*/
    $(document).on('click','#todayqrorder',function(){

          var url= 'showqrorder';
         $.ajax({
             type: "GET",
             url: url,
             success: function(data) {
              $('#qrorder').html(data);
        }

        }); 


        });
    
    });





    /*unique table data*/
    $(document).on('change','#ongoingtable_name',function(){
         var id = $(this).children("option:selected").val();
          var url= 'getongoingorder'+'/'+id;
         $.ajax({
             type: "GET",
             url: url,
             success: function(data) {
              $('#onprocesslist').html(data);

        }

        }); 
         $('#table-'+id).focus();

        });
    $(document).on('change','#ongoingtable_sr',function(){
         var id = $(this).children("option:selected").val();
         var url= 'getongoingorder'+'/'+id+'/table';
         $.ajax({
             type: "GET",
             url: url,
             success: function(data) {
              $('#onprocesslist').html(data);

        }

        }); 
         $('#table-'+id).focus();

        });
    
        /*select product from list*/
        $(document).on('change','#product_name', function(){

            var tid = $(this).children("option:selected").val();
          	var variantId = $("#product_name :selected").data().data.variantid;
                                         
			var idvid=tid.split('-');
			var id=idvid[0];
			var vid=idvid[1];
          
            //var url= 'srcposaddcart'+'/'+variantId;
//**********************FIXED BUG: WHEN ADDING BUKO JUICE IT ADDS UP TO RICE**********************
            var url= 'srcposaddcart'+'/'+variantId+"/"+tid;
//**********************FIXED BUG: WHEN ADDING BUKO JUICE IT ADDS UP TO RICE**********************
          
            /*check production*/
            /*please fixt count total counting*/
                var productionsetting = $('#production_setting').val();
                if(productionsetting == 1){
                   
              
                        var checkqty = 1;
                   

                     var checkvalue = checkproduction(id,vid,checkqty);

                        if(checkvalue == false){
                             $('#product_name').html('');
                            return false;
                        }
                    
                }
            /*end checking*/
            $.ajax({
             type: "GET",
             url: url,
             success: function(data) {
                if(data == 'adons'){
                 
                 var myurl ="adonsproductadd"+'/'+variantId;
                $.ajax({
             type: "GET",
             url: myurl,
             success: function(data) {
                     $('.addonsinfo').html(data);
                     $('#edit').modal('show');
                    var totalitem=$('#totalitem').val();
                    var tax=$('#tvat').val();
                    var discount=$('#tdiscount').val();
                    var tgtotal = parseFloat($('#tgtotal').val(),10).toFixed(2);
                    $('#vat').val(tax);
                    $('#calvat').text(tax);
					var sc=$('#sc').val();
					$('#service_charge').val(sc);
                    $('#getitemp').val(totalitem);
                    $('#invoice_discount').val(discount);
                    $('#caltotal').text(tgtotal);
                    $('#grandtotal').val(tgtotal);
                    $('#orggrandTotal').val(tgtotal);
                    $('#orginattotal').val(tgtotal);
                    $('#product_name').html('');
                    
                } 
                });

                }
               else{
                    $('#addfoodlist').html(data);
                    var total=$('#grtotal').val();
                    var totalitem=$('#totalitem').val();
                    $('#item-number').text(totalitem);
                    $('#getitemp').val(totalitem);
                    var tax=$('#tvat').val();
                    $('#vat').val(tax);
					var sc=$('#sc').val();
					$('#service_charge').val(sc);
                    var discount=$('#tdiscount').val();
                    var tgtotal = parseFloat($('#tgtotal').val(),10).toFixed(2);
                    $('#calvat').text(tax);
                    $('#invoice_discount').val(discount);
                    $('#caltotal').text(tgtotal);
                    $('#grandtotal').val(tgtotal);
                    $('#orggrandTotal').val(tgtotal);
                    $('#orginattotal').val(tgtotal);
                     $('#product_name').html('');
                }
             } 
        });

   
});
  

  

var printService = new WebSocketPrinter();



function printRawHtml(view, location = null) {

        if (typeof view['1'] !== "undefined") {

            printService.submit({
                'type': 'KITCHEN',
                'url': '<?php echo base_url()?>' + view['1']
            });
        }

        if (typeof view['2'] !== "undefined") {
            printService.submit({
                'type': 'BAR',
                'url': '<?php echo base_url()?>' + view['2']
            });
        }
        if (typeof view['3'] !== "undefined") {
            printService.submit({
                'type': 'DINING',
                'url': '<?php echo base_url()?>' + view['3']
            });
        }
    }

  /*** UPDATE ORDER PRINT to KITCHEN **/
  
  
  function printRawHtmlUpdateToken(view, location = null) {
    
   		
        $.ajax({
            url: '<?php echo base_url()?>assets/data/pdf/Token_update'+view+'_Kitchen.pdf',
            type: 'HEAD',
            success: function () {
                printService.submit({
                    'type': 'KITCHEN',
                    'url': '<?php echo base_url()?>assets/data/pdf/Token_update'+view+'_Kitchen.pdf'
                });
            }
        });

        $.ajax({
            url: '<?php echo base_url()?>assets/data/pdf/Token_update'+view+'_Dining.pdf',
            type: 'HEAD',
            success: function () {
                printService.submit({
                    'type': 'DINING',
                    'url': '<?php echo base_url()?>assets/data/pdf/Token_update'+view+'_Dining.pdf'
                });
            }
        });

        $.ajax({
            url: '<?php echo base_url()?>assets/data/pdf/Token_update'+view+'_Bar.pdf',
            type: 'HEAD',
            success: function () {
                printService.submit({
                    'type': 'BAR',
                    'url': '<?php echo base_url()?>assets/data/pdf/Token_update'+view+'_Bar.pdf'
                });
            }
        });
    }
  
  
  
/* $(document).on('change','#customer_name',function(){
         var id = $(this).children("option:selected").val();

		 if(isgetdiscount==1){
		 }
        });*/
function placeorder(){
      var ctypeid=$("#ctypeid").val();
      var waiter="";
      var isdelivary="";
	  var thirdinvoiceid="";
      var tableid="";
      var customer_name=$("#customer_name").val();
      var hotel_customer_name=$("#hotel_customer_name option:selected").val();
      var cardtype=4;
      var isonline=0;
      var order_date=$("#order_date").val();
      var grandtotal=$("#grandtotal").val();
      var customernote=$("#hotel_customer_name option:selected").text();
      var invoice_discount=$("#invoice_discount").val();
      var service_charge=$("#service_charge").val();
      var vat=$("#vat").val();
      var orggrandTotal=$("#subtotal").val();
      var isonline=$("#isonline").val();
      var isitem=$("#totalitem").val();
      var cookedtime=$("#cookedtime").val();
      var errormessage = '';
        if(customer_name == ''){ errormessage = errormessage+'<span>Please Select Customer Name.</span>';
            alert("Please Select Customer Name!!!");
            return false;
        }
        if(ctypeid == ''){ errormessage = errormessage+'<span>Please Select Customer Type.</span>';
            alert("Please Select Customer Type!!!");
            return false;
        }
        if(isitem == '' || isitem==0){ errormessage = errormessage+'<span>Please add Some Food</span>';
            alert("Please add Some Food!!!");
            return false;
        }
        if(ctypeid==3){
                 var isdelivary=$("#delivercom").val();
				 var thirdinvoiceid=$("#thirdinvoiceid").val();
                 if(isdelivary == ''){ errormessage = errormessage+'<span>Please Select Customer Type.</span>';
                    alert("Please Select Group Company!!!");
                    return false;
                }
            }
        else if(ctypeid==4 || ctypeid==2){
            <?php if($possetting->waiter==1){?>
                 var waiter=$("#waiter").val();
                 if(waiter == ''){ errormessage = errormessage+'<span>Please Select Waiter.</span>';
                    alert("Please Select Waiter!!!");
                    return false;
                }
              <?php }?>
            }
        else if(ctypeid==99 || ctypeid==100){
            if(hotel_customer_name == ''){ errormessage = errormessage+'<span>Please Select Active Hotel Guest.</span>';
                alert("Please Select Active Hotel Guest!!!");
                return false;
            }
        }
        else{
            var waiter=$("#waiter").val();
             var tableid=$("#tableid").val();
             var table_member_multi = $('#table_member_multi').val();
             var table_member_multi_person = $('#table_member_multi_person').val();
             var table_member=$("#table_member").val();//table member 02/11
             <?php if($possetting->waiter==1){
				 ?>
                if(waiter == ''){ errormessage = errormessage+'<span>Please Select Waiter.</span>';
                    $("#waiter").select2('open');
                    
                    return false;
                }
            <?php } 
			 if($possetting->tableid==1){?>
                if(tableid == ''){
					 $("#tableid").select2('open');
					toastr.warning("Please Select Table", 'Warning');
                    return false;
                }
				<?php if($possetting->tablemaping==1){?>
				if(tableid == ''||!$.isNumeric($('#table_person').val())){ 	toastr.warning("Please Select Table or number person", 'Warning');
						return false;
					}
                 <?php } } ?>
            }
        if(errormessage==''){
              order_date=encodeURIComponent(order_date);
              customernote=encodeURIComponent(customernote);
              var errormessage = '<span style="color:#060;">Signup Completed Successfully.</span>';
              var dataString = 'customer_name='+customer_name+'&ctypeid='+ctypeid+'&waiter='+waiter+'&tableid='+tableid+'&card_type='+cardtype+'&isonline='+isonline+'&order_date='+order_date+'&grandtotal='+grandtotal+'&customernote='+customernote+'&invoice_discount='+invoice_discount+'&service_charge='+service_charge+'&vat='+vat+'&subtotal='+orggrandTotal+'&assigncard_terminal=&assignbank=&assignlastdigit=&delivercom='+isdelivary+'&thirdpartyinvoice='+thirdinvoiceid+'&cookedtime='+cookedtime+'&tablemember='+table_member+'&table_member_multi='+table_member_multi+'&table_member_multi_person='+table_member_multi_person+'&guest_id='+hotel_customer_name;
               // alert(dataString);
               // return false; 
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url()?>ordermanage/order/pos_order",
                        data: dataString,
                        dataType:'JSON',
                        success: function(data){
                            $('#addfoodlist').empty();
                            $("#getitemp").val('0');
                            $('#calvat').text('0');
                            $('#vat').val('0');
                            $('#invoice_discount').val('0');
                            $('#caltotal').text('');
                            $('#grandtotal').val('');
							$('#thirdinvoiceid').val('');
                            $('#orggrandTotal').val('');
                            $("#hotel_customer_name").val('');
                            $('#waiter').select2('data', null);
                            $('#tableid').select2('data', null);
                            $('#waiter').val('');
                            //$('#tableid').select2('data', null);
                            //$('#tableid').val('').trigger('change');
                            $('#table_member').val('');
                            $('#table_person').val(lang.person);
                            $('#table_member_multi').val(0);
                            $('#table_member_multi_person').val(0);
                            $('#hotel_customer_name').select2('data',null);
                            $("#default_customer_name").show();
                            $("#active_hotel_customer").hide();
                            $('#hotel_customer_name').hide();

                            var err = data;
                         
                            if(err=="error"){
                                swal({
                                title: "<?php echo display('ord_failed');?>",
                                text: "<?php echo display('failed_msg');?>",
                                type: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "Yes, Cancel!",
                                closeOnConfirm: true
                                },
                                function () {
                                
                                });
                                }
                           else{
                            swal({
                                title: "<?php echo display('ord_succ');?>",
                                text: "Submit orders to Kichen/Bar?",
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
                                   $('#waiter').val('');
                                    $('#tableid').val('');
                                    $("#default_customer_name").show();
                                    $('#waiter').select2('data', null);
                                    $('#tableid').select2('data', null);
                                    $("#active_hotel_customer").hide();
                                    $('#hotel_customer_name').hide();

                                    printRawHtml(data,'kitchen');                                  
                               
                             
                                } else {
                                    $('#waiter').select2('data', null);
                                    $('#tableid').select2('data', null);
                                    $('#hotel_customer_name').select2('data',null);
                                    $("#active_hotel_customer").hide();
                                    $('#hotel_customer_name').hide();
                                    $("#default_customer_name").show();
                                    $('#waiter').val('');
                                    $('#tableid').val('');
                                   
                                }
                            });
                           }
                        }
                    });
// stock deduction code
                    insert_production_details();
// stock deduction code
            }
        
      
    }
  
// stock deduction code
  function insert_production_details(){
    $.ajax({
        type: "POST",
        url: "<?php echo base_url('ordermanage/order/insert_production_details'); ?>",
        //data: 'status='+status,
        contentType: "application/json; charset=utf-8",
        // dataType: "json",
        success: function(result){
            //alert(result.d);
            console.log(result);
        }
    });
  }
// stock deduction code

  
  
    function editposorder(id,view){
          var url= 'updateorder'+'/'+id;
          if(view == 1){
            var vid = $("#onprocesslist");
          }
          else if(view == 2){
            var vid = $("#messages");
          }
		  else if(view == 4){
			  var vid = $("#qrorder");
			  }
          else{
            var vid = $("#settings");
          }
         $.ajax({
             type: "GET",
             url: url,
             success: function(data) {
              vid.html(data);
        }
    });
    }
function quickorder(){
      var ctypeid=$("#ctypeid").val();
      var waiter="";
      var isdelivary="";
	  var thirdinvoiceid="";
      var tableid="";
      var customer_name=$("#customer_name").val();
      var cardtype=4;
      var isonline=0;
      var order_date=$("#order_date").val();
      var grandtotal=$("#grandtotal").val();
      var customernote="";
      var invoice_discount=$("#invoice_discount").val();
      var service_charge=$("#service_charge").val();
      var vat=$("#vat").val();
      var orggrandTotal=$("#subtotal").val();
      //var isonline=$("#isonline").val();
      var isitem=$("#totalitem").val();
      var cookedtime=$("#cookedtime").val();
      var errormessage = '';
        if(customer_name == ''){ errormessage = errormessage+'<span>Please Select Customer Name.</span>';
            alert("Please Select Customer Name!!!");
            return false;
        }
        if(ctypeid == ''){ errormessage = errormessage+'<span>Please Select Customer Type.</span>';
            alert("Please Select Customer Type!!!");
            return false;
        }
        if(isitem == '' || isitem==0){ errormessage = errormessage+'<span>Please add Some Food</span>';
            alert("Please add Some Food!!!");
            return false;
        }
        if(ctypeid==3){
                 var isdelivary=$("#delivercom").val();
				 var thirdinvoiceid=$("#thirdinvoiceid").val();
                 if(isdelivary == ''){ errormessage = errormessage+'<span>Please Select Customer Type.</span>';
                    alert("Please Select Delivery Company!!!");
                    return false;
                }
            }
        else if(ctypeid==4 || ctypeid==2){
                 var waiter=$("#waiter").val();
                 <?php if($possetting->waiter==1){?>
                 if(waiter == ''){ errormessage = errormessage+'<span>Please Select Waiter.</span>';
                 $("#waiter").select2('open');
                    
                    return false;
                }
                <?php } ?>
            }
        else{
             var waiter=$("#waiter").val();
             var tableid=$("#tableid").val();
             var table_member_multi = $('#table_member_multi').val();
             var table_member_multi_person = $('#table_member_multi_person').val();
             var table_member=$("#table_member").val();//table member 02/11
             <?php if($possetting->waiter==1){
				 ?>
                if(waiter == ''){ errormessage = errormessage+'<span>Please Select Waiter.</span>';
                    $("#waiter").select2('open');
                    return false;
                }
            <?php }
             if($possetting->tableid==1){?>
                if(tableid == ''){
					 $("#tableid").select2('open');
					toastr.warning("Please Select Table", 'Warning');
                    return false;
                }
				<?php if($possetting->tablemaping==1){?>
				if(tableid == ''||!$.isNumeric($('#table_person').val())){ 	toastr.warning("Please Select Table or number person", 'Warning');
						return false;
					}
                 <?php } }?>
            }
            
        
        if(errormessage==''){
              order_date=encodeURIComponent(order_date);
              customernote=encodeURIComponent(customernote);
              var errormessage = '<span style="color:#060;">Signup Completed Successfully.</span>';
              var dataString = 'customer_name='+customer_name+'&ctypeid='+ctypeid+'&waiter='+waiter+'&tableid='+tableid+'&card_type='+cardtype+'&isonline='+isonline+'&order_date='+order_date+'&grandtotal='+grandtotal+'&customernote='+customernote+'&invoice_discount='+invoice_discount+'&service_charge='+service_charge+'&vat='+vat+'&subtotal='+orggrandTotal+'&assigncard_terminal=&assignbank=&assignlastdigit=&delivercom='+isdelivary+'&thirdpartyinvoice='+thirdinvoiceid+'&cookedtime='+cookedtime+'&tablemember='+table_member+'&table_member_multi='+table_member_multi+'&table_member_multi_person='+table_member_multi_person;
                //alert(dataString);
                //return false; 
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url()?>ordermanage/order/pos_order/1",
                        data: dataString,
                        success: function(data){
                            $('#addfoodlist').empty();
                            $("#getitemp").val('0');
                            $('#calvat').text('0');
                            $('#vat').val('0');
                            $('#invoice_discount').val('0');
                            $('#caltotal').text('');
                            $('#grandtotal').val('');
							$('#thirdinvoiceid').val('');
                            $('#orggrandTotal').val('');
                            $('#waiter').select2('data', null);
                            $('#tableid').select2('data', null);
                            $('#hotel_customer_name').select2('data',null);
                            $('#waiter').val('');
                            //$('#tableid').val('').trigger('change');
                            $('#table_member').val('');
                            $('#table_person').val(lang.person);
                            $('#table_member_multi').val(0);
                            $('#table_member_multi_person').val(0);
                            var err = data;
                            if(err=="error"){
                                swal({
                                title: "<?php echo display('ord_failed');?>",
                                text: "<?php echo display('failed_msg');?>",
                                type: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "Yes, Cancel!",
                                closeOnConfirm: true
                                },
                                function () {
                                //window.location.href="<?php //echo base_url()?>ordermanage/order/pos_invoice";
                                });
                                }
                           else{
                            swal({
                                title: "<?php echo display('ord_places');?>",
                                text: "<?php echo display('do_print_in');?>",
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
                                createMargeorder(data,1)
                                 
                                } else {
                                    $('#waiter').select2('data', null);
                                    $('#tableid').select2('data', null);
                                    $('#hotel_customer_name').select2('data',null);
                                    $('#waiter').val('');
                                    $('#tableid').val('');
                                    //window.location.href="<?php echo base_url()?>ordermanage/order/pos_invoice";
                                }
                            });
                           }
                        }
                    });
            
            }
        
      
    }
	function printJobComplete() {
  //alert("print job complete");
  $("#kotenpr").empty();
}
function tokenupdate(test){
	/*$.ajax({
		 	 type: "GET",
			 url: "postokengenerateupdate/"+result.orderid+"/1",
			 success: function(data) {
				 	printRawHtmlupdate(data);
			 } */
	}
function printRawHtmlupdatexxxx(view,id) {
      printJS({
        printable: view,
        type: 'raw-html',
        onPrintDialogClose: function () {
			$.ajax({
		 	 type: "GET",
			 url: "tokenupdate/"+id,
			 success: function(data) {
				 	console.log("done");
			 }
		  });
		}
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
            dataType: 'JSON',          
            
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
			function(isConfirm) {
                      if (isConfirm) {
                          $.ajax({
                              type: "GET",
                              url: "postokengenerateupdate/" + result.orderid + "/1",
                              success: function(data) {
                                  printRawHtmlUpdateToken(result.orderid);
								   $(".maindashboard").removeClass("disabled");
									 $("#fhome").removeClass("disabled");
									 $("#kitchenorder").removeClass("disabled");
									 $("#todayqrorder").removeClass("disabled");
									 $("#todayonlieorder").removeClass("disabled");
									 $("#todayorder").removeClass("disabled");
									 $("#ongoingorder").removeClass("disabled");
                              }
                          });
                      } else {

                          $.ajax({
                              type: "GET",
                              url: "tokenupdate/" + result.orderid,
                              success: function(data) {
                                  console.log("done");
								  	 $(".maindashboard").removeClass("disabled");
									 $("#fhome").removeClass("disabled");
									 $("#kitchenorder").removeClass("disabled");
									 $("#todayqrorder").removeClass("disabled");
									 $("#todayonlieorder").removeClass("disabled");
									 $("#todayorder").removeClass("disabled");
									 $("#ongoingorder").removeClass("disabled");
                              }
                          });
                      }
                  });
              setTimeout(function() {
                  toastr.options = {
                      closeButton: true,
                      progressBar: true,
                      showMethod: 'slideDown',
                      timeOut: 4000,

                  };
                  toastr.success(result.msg, 'Success');
                  prevsltab.trigger("click");


              }, 300);
              //console.log(result)          
          },
          error: function(a) {

          }
      });
  }
  
function payorderbill(status,orderid,totalamount){
    $('#paidbill').attr('onclick','orderconfirmorcancel('+status+','+orderid+')');
    $('#maintotalamount').val(totalamount);
    $('#totalamount').val(totalamount);
    $('#paidamount').attr("max", totalamount);
    $('#payprint').modal('show');
    }
  
function onlinepay(){
  alert('dfghdfgh');
     $("#onlineordersubmit").submit();
    }   
  
function orderconfirmorcancel(status,orderid){
    mystatus=status;
    if(status==9 || status==10){
        status=4;
        var pval=$("#paidamount").val();
        if(pval<1 ||pval==''){
            alert("Please Insert Paid Amount!!!");
            return false;
        }
    }
    var carttype='';
    var cterminal='';
    var mybank='';
    var mydigit='';
    var paid='';
    if(status==4){
         var carttype=$("#card_typesl").val();
         var cterminal=$("#card_terminal").val();
          var mybank=$("#bank").val();
          var mydigit=$("#last4digit").val();
          var paid=$('#paidamount').val();
         if(carttype==''){
             alert("Please Select Payment Method!!!");
             return false;
             }
            if(carttype==1){
              if(cterminal==''){
                   alert("Please Select Card Terminal!!!");
                   return false;
                  }
            }
        }

     var dataString = 'status='+status+'&orderid='+orderid+'&paytype='+carttype+'&cterminal='+cterminal+'&mybank='+mybank+'&mydigit='+mydigit+'&paid='+paid;
     $.ajax({
            type: "POST",
            url: "<?php echo base_url()?>ordermanage/order/changestatus",//workingnow
            data: dataString,
            success: function(data){
                $("#onprocesslist").html(data);
                if(mystatus=="9"){
                    window.location.href="<?php echo base_url()?>ordermanage/order/orderinvoice/"+orderid;
                    }
               else if(mystatus=="10"){
                $('#payprint').modal('hide');
              
                prevsltab.trigger( "click" );
                
                
               }
               else if(mystatus==4){
                            swal({
                                title: "<?php echo display('ord_complte');?>",
                                text: "<?php echo display('ord_com_sucs');?>",
                                type: "success",
                                showCancelButton: false,
                                confirmButtonColor: "#28a745",
                                confirmButtonText: "Yes",
                                closeOnConfirm: true
                                },
                            function () {
                                 prevsltab.trigger( "click" );
                                 $('#paidamount').val('');
                                $('#payprint').modal('hide');
                                });
                   }
            }
        });
    }
 function load_unseen_notification(view = '')
 {
      var mysound="<?php echo base_url()?>assets/";
        var audio =["beep-08b.mp3"];
			  $.ajax({
			   url: "<?php echo base_url()?>ordermanage/order/notification",
			   method:"POST",
			   data:{view:view},
			   dataType:"json",
			   success:function(data)
			   {
				if(data.unseen_notification >= 0)
				{
				   
				 $('.count').html(data.unseen_notification);
				 //alert("dsfsgfd");
				}
			   }
			  });
 }
 // load_unseen_notification();
 // setInterval(function(){
 //  load_unseen_notification();
 // }, 700);
 
//  function load_unseen_notificationqr(view = '')
// {
//	  var mysound="<?php echo base_url()?>assets/";
//		var audio =["beep-08b.mp3"];
//  $.ajax({
//   url: "<?php echo base_url()?>ordermanage/order/notificationqr",
 //  method:"POST",
//   data:{view:view},
 //  dataType:"json",
//   success:function(data)
//   {
//    if(data.unseen_notificationqr > 0)
 //   {
       //alert('Done');	
		//new Audio(mysound + audio[0]).play();
//	 $('.count2').html(data.unseen_notificationqr);
//   }
 //  }
//  });
// }
 
 // load_unseen_notificationqr();
 //
 //
 // setInterval(function(){
 //  load_unseen_notificationqr();
 // }, 700);
function detailspop(orderid){
      var myurl='<?php echo base_url();?>ordermanage/order/orderdetailspop/'+orderid;
		 var dataString = "orderid="+orderid;
		  $.ajax({
		 	 type: "POST",
			 url: myurl,
			 data: dataString,
			 success: function(data) {
				 $('.orddetailspop').html(data);
				 $('#orderdetailsp').modal('show');
			 } 
		});
     
 }
  function pospageprint(orderid){
	 var datavalue = 'customer_name='+customer_name;
					$.ajax({
							type: "POST",
							url: "<?php echo base_url()?>ordermanage/order/posprintview/"+orderid,
							data: datavalue,
							success: function(printdata){											
								$("#kotenpr").html(printdata);
								const style = '@page { margin:0px;font-size:16px; }';
								printJS({
									printable: 'kotenpr',
									onPrintDialogClose: printJobComplete,
									type: 'html',
									font_size: '25px',
									style: style,
									scanStyles: false												
								  })
								}
									});
	 }
 function printPosinvoice(id){
        var url = 'posorderinvoice/'+id;
         $.ajax({
             type: "GET",
             url: url,
             success: function(data) {
              printRawHtml(data,'dining');
        }

        });
 }
 function pos_order_invoice(id){
        var url= 'pos_order_invoice/'+id;
         $.ajax({
             type: "GET",
             url: url,
             success: function(data) {
              $('#messages').html(data);
        }

        }); 

 }
 function orderdetails_post(id){
        var url= 'orderdetails_post/'+id;
         $.ajax({
             type: "GET",
             url: url,
             success: function(data) {
              $('#messages').html(data);
        }

        }); 

 }
  function orderdetails_onlinepost(id){
        var url= 'orderdetails_post/'+id;
         $.ajax({
             type: "GET",
             url: url,
             success: function(data) {
              $('#settings').html(data);
        }

        }); 

 }
 
 //load_unseen_notification();

 
function createMargeorder(orderid,value=null){
//alert("TEST");
    var url = 'showpaymentmodal/'+orderid;
    callback = function(a){
        $("#modal-ajaxview").html(a);
        $('#get-order-flag').val('2');
    };
    if(value == null){
       
    getAjaxModal(url);
    }
    else{
        getAjaxModal(url,callback); 
    }
   }


                       /*all ongoingorder product as ajax*/
    $(document).on('click','#add_new_payment_type',function(){
        var orderid = $('#get-order-id').val();
          var url= 'showpaymentmodal/'+orderid+'/1';
         $.ajax({
             type: "GET",
             url: url,
             success: function(data) {
              $('#add_new_payment').append(data);
              var length = $(".number").length;
              $(".number:eq("+(length-1)+")").val(parseFloat($("#pay-amount").text()));
             
        }

        }); 


        });
    $(document).on('click','.close_div',function(){
        
        $(this).parent('div').remove();
        changedueamount();
    });

                   /*show due invoice*/
    $(document).on('click','.due_print',function(){
         var id = $(this).children("option:selected").val();
         var url= $(this).attr("data-url");
        var elem =  $('#addPayment');
         $.ajax({
             type: "GET",
             url: url,
             success: function(data) {
             printRawHtml(data,'dining');
        }
        });
        elem.removeAttr('disabled');
        });

    function showhidecard(element){
        var cardtype = $(element).val();
        var data = $(element).closest('div.row').next().find('div.cardarea');
      
            if(cardtype==4){
            $("#isonline").val(0);
            $(element).closest('div.row').next().find('div.cardarea').hide();
            $("#assigncard_terminal").val('');
            $("#assignbank").val('');
            $("#assignlastdigit").val('');
            }
            else if(cardtype==1){
            $("#isonline").val(0);
            $(element).closest('div.row').next().find('div.cardarea').show();
            }
            else{
                $("#isonline").val(1);
                $(element).closest('div.row').next().find('div.cardarea').hide();
                $("#assigncard_terminal").val('');
                $("#assignbank").val('');
                $("#assignlastdigit").val('');
                }
    }

    function submitmultiplepay(){
            var thisForm = $('#paymodal-multiple-form');
             var inputval = parseFloat(0);
        var maintotalamount = $('#due-amount').text();
        var payment_method_id = $('#payment_method_id').val();
        var customer_name = $('#customer_name').val();
        $(".number").each(function(){
           var inputdata= parseFloat($(this).val());
            inputval = inputval+inputdata;

        });
        if(inputval<parseFloat(maintotalamount)  && payment_method_id === 1){
            
            setTimeout(function () {
                toastr.options = {
                closeButton: true,
                progressBar: true,
                showMethod: 'slideDown',
                timeOut: 4000
                    
        };
            
        toastr.error("Pay full amount ", 'Error');
        }, 100); 
        return false;
          
    }
     console.log(customer_name);
      
      if(!customer_name && payment_method_id == 2){
            
            
      alert("Please Select Hotel Guest");
        return false;
     }
       console.log(customer_name);
      
      if(!customer_name && payment_method_id == 6){
            
            
      alert("Please Select Hotel Guest");
        return false;
     }
    
    var formdata = new FormData(thisForm[0]);
  
        $.ajax({
        type: "POST",
        url: "<?php echo base_url()?>ordermanage/order/paymultiple",
        data: formdata,
        processData: false,
        contentType: false,
        success:function(data){
            var value = $('#get-order-flag').val();
            if(value ==1){
                 setTimeout(function () {
                toastr.options = {
                closeButton: true,
                progressBar: true,
                showMethod: 'slideDown',
                timeOut: 4000
                  
                };
                toastr.success("payment taken successfully", 'Success');
                $('#payprint_marge').modal('hide');
                $('#modal-ajaxview').empty();

                printRawHtmlInvoice(data,'dining');
                prevsltab.trigger( "click" );


            }, 100); }
         else{
            $('#payprint_marge').modal('hide');
            $('#modal-ajaxview').empty();

            printRawHtmlInvoice(data,'dining');

            prevsltab.trigger( "click" );
         }
            
        },
  
    });
    }
    function changedueamount(){
        var inputval = parseFloat(0);
        var maintotalamount = $('#due-amount').text();
        
        $(".number").each(function(){
           var inputdata= parseFloat($(this).val());
            inputval = inputval+inputdata;

        });
       
           restamount=(parseFloat(maintotalamount))-(parseFloat(inputval));
            var changes=restamount.toFixed(2);
            if(changes <=0){
                $("#change-amount").text(Math.abs(changes));
                $("#pay-amount").text(0);
            }
            else{
                $("#change-amount").text(0);
                $("#pay-amount").text(changes);
            }
            
    }
function mergeorderlist(){
	var values = $('input[name="margeorder"]:checked').map(function() {
		  return $(this).val();
		}).get().join(',');
    var dataString = 'orderid='+values;
    	$.ajax({
		   url: "<?php echo base_url()?>ordermanage/order/mergemodal",
		   method:"POST",
		   data: dataString,
		   success:function(data){
			$("#payprint_marge").modal('show');
			$("#modal-ajaxview").html(data);
			$('#get-order-flag').val('2');
		   }
		  });
   }
function margeorderconfirmorcancel(){
 
    var thisForm = $('#paymodal-multiple-form');
    var formdata = new FormData(thisForm[0]);
  
        $.ajax({
        type: "POST",
        url: "<?php echo base_url()?>ordermanage/order/changeMargeorder",
        data: formdata,
        processData: false,
        contentType: false,
        success:function(data){
            $('#payprint_marge').modal('hide');
			printRawHtml(data,'dining');
			prevsltab.trigger( "click" );
        },
  
    });
    }
     function margeorder(){
        var totaldue = 0;
        $(".marg-check").each(function() {
            if ($(this).is(":checked")){
                var id = $(this).val();
               totaldue = parseFloat($('#due-'+id).text())+totaldue;
               
            }
            $('#due-amount').text(totaldue);
            $('#totalamount_marge').text(totaldue); 
            $('#paidamount_marge').val(totaldue);
            });
     }
function checktable(id=null){
	//console.log("dsds");
        if(id !=null){
        var select = '#person-'+id;
       var valu =  $(select).val();
                $('#table_member').val(valu);
                var url= 'checktablecap/'+id;
                }
                else{
                   idd = $('#tableid').val();
                   var url= 'checktablecap/'+idd; 
                }
                var order_person = $('#table_member').val();
             
            
             if(order_person != ""){
         $.ajax({
             type: "GET",
             url: url,
             success: function(data) {
                if(order_person > data ){
                    
            setTimeout(function () {
                 
                toastr.options = {
                closeButton: true,
                progressBar: true,
                showMethod: 'slideDown',
                timeOut: 4000,
                    
                    };
        toastr.warning('table capacity overflow', 'Warning');
        


    }, 300);
        }
        else{
          if(id !=null){
            $('#tableid').val(id).trigger('change');
             $('#table_member_multi').val(0);
            $('#table_member_multi_person').val(0);
            $('#table_person').val(order_person);
            $('#tablemodal').modal('hide');
            }
       
            return false;

        }
             
        }

        }); 
     }
     else{
       
          setTimeout(function () {
             $("#table_member").focus();
         
                toastr.options = {
                closeButton: true,
                progressBar: true,
                showMethod: 'slideDown',
                timeOut: 4000,
                    
                    };
        toastr.error('Please type Number of person', 'Error');
        


    }, 300);
         

     }
     }

function showTablemodal(){
    var url = "showtablemodal";
    getAjaxModal(url,false,'#table-ajaxview','#tablemodal');
	
   }
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
function deleterow_table(id,tableid=null)
{
    if(tableid==null){
    var url = 'delete_table_details/'+id;
    $.ajax({
             type: "GET",
             url: url,
             success: function(data) {
                if(data ==1){
                    $('#table-tr-'+id).remove(); 
                }
                }
        }); 
    }
    else{
           var url = 'delete_table_details_all/'+tableid;
    $.ajax({
             type: "GET",
             url: url,
             success: function(data) {
                if(data ==1){
                    $('#table-tbody-'+tableid).empty();

                }
                }
        });
    }

    }

    function multi_table(){
       var arr =  $('input[name="add_table[]"]:checked').map(function() {
    return this.value;
            }).get();
        $('#table_member_multi').val(arr);
        var value =[];
        var order_person_t =0;
        for(i=0; i < arr.length; i++){
           value[i] = $('#person-'+arr[i]).val();
           order_person_t +=parseInt($('#person-'+arr[i]).val());
        }
       
        
         $('#table_member').val($('#person-'+arr[0]).val());
        $('#table_person').val(order_person_t);
        $('#table_member_multi_person').val(value);
        
        $('#tablemodal').modal('hide');
        $('#tableid').val(arr[0]).trigger('change');
    }
        
  
  $(document).on('change','#update_product_name', function(){
			var tid = $(this).children("option:selected").val();
			var idvid=tid.split('-');
			var id=idvid[0];
			var vid=idvid[1];
			
            var updateid=$("#saleinvoice").val();
            var url= 'addtocartupdate_uniqe'+'/'+id+'/'+updateid;
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
                 
                 var myurl ="adonsproductadd"+'/'+id;
                $.ajax({
             type: "GET",
             url: myurl,
             success: function(data) {
                      $('.addonsinfo').html(data);
                     $('#edit').modal('show');
                     var tax=$('#tvat').val();
                    var discount=$('#tdiscount').val();
                    var tgtotal = parseFloat($('#tgtotal').val(),10).toFixed(2);
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
                    var tgtotal = parseFloat($('#tgtotal').val(),10).toFixed(2);
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
  
$(function($){
$("#customer_name").select2();
var barcodeScannerTimer;
var barcodeString = '';

$('#customer_name').on("select2:open", function () { 
document.getElementsByClassName('select2-search__field')[0].onkeypress = function(evt) { 
barcodeString = barcodeString + String.fromCharCode(evt.charCode);
    clearTimeout(barcodeScannerTimer);
    barcodeScannerTimer = setTimeout(function () {
        processbarcodeGui();
    }, 300);
}
});
function processbarcodeGui() {
    if (barcodeString != '') {
        var customerid = Number(barcodeString).toString();
		if(Math.floor(customerid) == customerid && $.isNumeric(customerid)){ 
		$("#customer_name").select2().val(customerid).trigger('change');
		}
		$('#customer_name').val(customerid);
    } else {
        alert('barcode is invalid: ' + barcodeString);
    }

    barcodeString = ''; 
}
});

/*for split order js*/
     function showsplitmodal(orderid,option=null){
          var url = 'showsplitorder/'+orderid;
    callback = function(a){
        $("#modal-ajaxview").html(a);
        //$('#get-order-flag').val('2');
    };
    if(option == null){
       
       getAjaxModal(url,false,'#table-ajaxview','#tablemodal');
    }
    else{
        getAjaxModal(url,callback); 
    }
     }

    function showsuborder(element){
        var val = $(element).val();
        var url = $(element).attr('data-url')+val;
        var orderid = $(element).attr('data-value');
         var datavalue = 'orderid='+orderid;
   
        getAjaxView(url,"show-sub-order",false,datavalue,'post');

    } 

  function getAjaxView(url,ajaxclass,callback=false,data='',method='get')
    {
       console.log(data);
        $.ajax({
            url:url,
            type:method,
            data:data,
            beforeSend:function(xhr){
                
            },
            success:function(result){
                if(callback){
                    callback(result);
                return;
                }
                $('#'+ajaxclass).html(result);
            },
            error:function(a){
       
             console.log(a);              
            }
        });
        return false;
    }

    function selectelement(element){

        $( ".split-item" ).each(function( index ) {
            
      $(this).removeClass('split-selected');
    });
         $(element).toggleClass('split-selected');
    }

    function addintosuborder(menuid,orderid,element){
        var presentvalue = $(element).find("td:eq(1)").text();
        var isselected = $('.split-selected').length;
        if(presentvalue != 0 && isselected == 1){
        var suborderid = $('.split-selected').attr('data-value');
        var service_chrg = $('#service-'+suborderid).val();

       var datavalue = 'orderid='+orderid+'&menuid='+menuid+'&suborderid='+suborderid+'&qty='+1+'&service_chrg='+service_chrg;
       var url = $(element).attr('data-url');
       var id = 'table-tbody-'+orderid+'-'+suborderid;
        getAjaxView(url,id,false,datavalue,'post');
      
        var nowvalue = parseInt(presentvalue)-1;
        $(element).find("td:eq(1)").text(nowvalue);
    }


    }

    function paySuborder(element){
            var id = $(element).attr('id').replace('subpay-','');
            var url = $(element).attr('data-url');
		var vat = $('#vat-'+id).val();
		 if($('#vat-'+id).length){
            
            var service = $('#service-'+id).val();
            var total = $('#total-sub-'+id).val();
            var customerid = $('#customer-'+id).val();
             $('#tablemodal').modal('hide');
			 $("#modal-ajaxview").empty();
            var data = 'sub_id='+id+'&vat='+vat+'&service='+service+'&total='+total+'&customerid='+customerid;
        getAjaxModal(url,false,'#modal-ajaxview-split','#payprint_split',data,'post')
		 }
		else{
		return false;
		}
    }

    function submitmultiplepaysub(subid){
            var thisForm = $('#paymodal-multiple-form');
             var inputval = parseFloat(0);
        var maintotalamount = $('#due-amount').text();
        
        $(".number").each(function(){
           var inputdata= parseFloat($(this).val());
            inputval = inputval+inputdata;

        });
        if(inputval<parseFloat(maintotalamount)){
            
            setTimeout(function () {
                toastr.options = {
                closeButton: true,
                progressBar: true,
                showMethod: 'slideDown',
                timeOut: 4000
                    
        };
        toastr.error("Pay full amount ", 'Error');
        }, 100); 
        return false;
    }
       var formdata = new FormData(thisForm[0]);
        $.ajax({
        type: "POST",
        url: "<?php echo base_url()?>ordermanage/order/paymultiplsub",
        data: formdata,
        processData: false,
        contentType: false,
        success:function(data){
            var value = $('#get-order-flag').val();
            
                setTimeout(function () {
                toastr.options = {
                closeButton: true,
                progressBar: true,
                showMethod: 'slideDown',
                timeOut: 4000
                  
        };
                    toastr.success("payment taken successfully", 'Success');
                    $('#payprint_split').modal('hide');
                    $('#subpay-'+subid).hide();
                    $("#modal-ajaxview-split").empty();
                    printRawHtmlInvoice(data);
                    prevsltab.trigger( "click" );

                }, 100);
                    },

                });

                }

    function printRawHtmlInvoice(view, location = null){

        if (typeof view['1'] !== "undefined") {
            printJS({
                printable: view,
                type: 'raw-html'
            });
        }

    }

    function showsplit(orderid){
        var url = '<?php echo base_url()?>ordermanage/order/showsplitorderlist/'+orderid;
        getAjaxModal(url,false,'#modal-ajaxview-split','#payprint_split');
    }

    function possubpageprint(orderid){
   
                    $.ajax({
                            type: "GET",
                            url: "<?php echo base_url()?>ordermanage/order/posprintdirectsub/"+orderid,
                          
                            success: function(printdata){                                           
                                 printRawHtml(printdata,'dining');
                                }
                                    });
     }
/*end split order js*/
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
	
	function addnotetoitem(){
		  var rowid=$("#foodcartid").val();
		  var note=$("#foodnote").val();
		  var foodqty=$("#foodqty").val();
		  var geturl='<?php echo base_url();?>ordermanage/order/additemnote';
		  var dataString = "foodnote="+note+'&rowid='+rowid+'&qty='+foodqty;
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
			   $('#addfoodlist').html(data);
			   $('#vieworder').modal('hide');
			   }, 100); 
				 
			 } 
		});
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
function opencashregister(){
	var form = $('#cashopenfrm')[0];
		var formdata = new FormData(form);
        $.ajax({
        type: "POST",
        url: "<?php echo base_url()?>ordermanage/order/addcashregister",
        data: formdata,
        processData: false,
        contentType: false,
        success:function(data){
			if(data==1){
			$("#openregister").modal('hide');
			}
			else{
				alert("Something Wrong!!! .Please Select Counter Number!!");
				}
        }
  
    });
	}
function closeopenresister(){
var closeurl="<?php echo base_url()?>ordermanage/order/cashregisterclose";
  $.ajax({
            type: "GET",
            async: false,
            url: closeurl,
            success: function(data) {
			    $('#openclosecash').html(data);
				var htitle=$("#rpth").text();
				var counter=$("#pcounter").val();
				var puser=$("#puser").val();
				var fullheader = "Cash Register In"+htitle+"\n" + "Counter:"+counter+"\n"+puser;
				$("#openregister").modal('show');
				$('#RoleTbl').DataTable({ 
				responsive: true, 
				paging: true,
				dom: 'Bfrtip',
				"lengthMenu": [[ 25, 50, 100, 150, 200, 500, -1], [ 25, 50, 100, 150, 200, 500, "All"]], 
				buttons: [  
					{extend: 'csv', title: 'Open-Close Cash Register', className: 'btn-sm',footer: true,header: true,orientation: 'landscape',messageTop: fullheader}, 
					{extend: 'excel', title: 'Open-Close Cash Register', className: 'btn-sm', title: 'exportTitle',messageTop: fullheader,footer: true,header: true,orientation: 'landscape'}, 
					{extend: 'pdfHtml5', title: 'Open-Close Cash Register',className: 'btn-sm',footer: true,header: true,orientation: 'landscape',messageTop: fullheader,customize: function (doc) {
    					doc.defaultStyle.alignment = 'center';
						doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');}
					} 
				],
				"searching": true,
				  "processing": true,
				
					});
            }
        });
	   
	}
function closecashregister(){
  
  if($("input#closing_note").val() == ''){
    
    alert('Input Closing Amount');
    
    
  } else {
		var form = $('#cashopenfrm')[0];
		var formdata = new FormData(form);
        $.ajax({
        type: "POST",
        url: "<?php echo base_url()?>ordermanage/order/closecashregister",
        data: formdata,
        processData: false,
        contentType: false,
        success:function(data){
			if(data==1){
			//alert("Success!!!!");
			$("#openregister").modal('hide');
			window.location.href="<?php echo base_url()?>dashboard/home";
			}else{
				alert("Something Wrong On Cash Closing!!!");
				}
        }
  
    });
	}	
}
</script>