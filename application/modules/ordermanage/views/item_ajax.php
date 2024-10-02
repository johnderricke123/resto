<?php foreach($itemlist as $item){
$isexists=$this->db->select('tbl_kitchen_order.*')->from('tbl_kitchen_order')->where('orderid',$item->order_id)->where('itemid',$item->menu_id)->where('varient',$item->variantid)->get()->num_rows();	
$condition="orderid=".$item->order_id." AND menuid=".$item->menu_id." AND varient=".$item->variantid;
$accepttime=$this->db->select('*')->from('tbl_itemaccepted')->where($condition)->get()->row();
$readytime=$this->db->select('*')->from('tbl_orderprepare')->where($condition)->get()->row();
?>

<div class="single_item">
                <div class="d-flex-inline" style="position: relative; margin-bottom:5px;">
                  <div class="d-flex col-12">
                  <div class="col-md-2">
                      <?php echo $item->menuqty;?>
                  </div>
                    <div class="col-md-10">
                            <?php echo $item->ProductName;?>
                    </div>
                  </div>
                  <?php if($item->food_status==1){?>
                  <h6 class="quantity" style="color:#3C0"><?php echo display('serving') ?>
<!--                      <br/>Accept Time:--><?php //echo date("H:i:s", strtotime($accepttime->accepttime));?>
<!--                      <br/>Ready Time:--><?php //echo date("H:i:s", strtotime($readytime->preparetime));?>
                  </h6>
                  <?php } ?>
                  <?php if($item->food_status==0){
					  if($isexists>0){
						  
					  ?>
<!--                  <h6 class="quantity">--><?php //echo display('proccessing') ?><!--<br/>Accept Time:--><?php //echo date("H:i:s", strtotime($accepttime->accepttime));?><!--</h6>-->
                  <?php }else{?>
				  <h6 class="quantity"><?php echo display('kitnotacpt') ?></h6>
				  <?php }} ?>
                </div>

</div>
              <?php } ?>