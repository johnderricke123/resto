<style>
@media(max-width:400px){
.col-xlg-2{
	width:100%;
	}
}
@media(min-width:1200px){
.col-xlg-2{
	width:20%;
	}
}
@media(min-width:1500px){
.col-xlg-2{
	width:16.6666666666666%;
	}
}
</style>




<div class="col-md-12">
  <div class="row mb-2">
    <div class="col-sm-3">
      <select id="ongoingtable_name" class="form-control dont-select-me  search-table-field" dir="ltr" name="s">
      </select>
    </div>
    <div class="col-sm-3">
      <select id="ongoingtable_sr" class="form-control dont-select-me  search-tablesr-field" dir="ltr" name="ts">
      </select>
    </div>
    <div class="col-sm-6">
      <button class="btn btn-success pull-right" onclick="mergeorderlist()"><?php echo display('mergeord') ?></button>
    </div>
  </div>
  <div class="row">
    <?php 
         if(!empty($ongoingorder)){
         foreach($ongoingorder as $onprocess){
             $billtotal=round($onprocess->totalamount-$onprocess->customerpaid);
             ?>
    <div class="col-sm-4 col-md-3 col-xs-6 col-xlg-2">
      <div class="hero-widget well well-sm" style="height:auto !important">
        <div style="margin:0; display:flex; align-items:center; justify-content:space-between;">
          <label class="text-muted"><strong><?php echo display('table');?>:<?php echo $onprocess->tablename;?></strong></label>
          <?php if($this->permission->method('ordermanage','update')->access() && $onprocess->splitpay_status ==0):?>
          <div style="display:flex; align-items:center;">
          <div class="">
              <a href="javascript:;" onclick="editposorder(<?php echo $onprocess->order_id;?>,1)" class="btn btn-xs btn-success btn-sm mr-1" data-toggle="tooltip" data-placement="left" title="" data-original-title="Update Order" id="table-<?php echo $onprocess->order_id;?>" style="padding: 0px 5px;margin-right: 3px;"><i class="fa fa-pencil"></i></a>
          </div>
        <div class="kitchen-tab" style="background:none; padding:0; overflow:hidden;">
          <input id='chkbox-<?php echo $onprocess->order_id;?>' type='checkbox' class="individual" name="margeorder" value="<?php echo $onprocess->order_id;?>"/>
          <label for='chkbox-<?php echo $onprocess->order_id;?>' class="mb-0"> 
            <span class="radio-shape" style="margin-right:0"> <i class="fa fa-check"></i> </span> </label>
        </div>
        </div>
        <?php endif;?>
        </div>
        <p style="margin:0;">
          <label class="text-muted"><?php echo display('ord_num');?>:<?php echo $onprocess->saleinvoice;?></label>
        </p>
        <p style="margin:0;">
          <label class="text-muted"><?php echo display('waiter');?>:<?php echo $onprocess->first_name.' '.$onprocess->last_name;?></label>
        </p>
         <?php 
          $diff=0;
          
          $actualtime=date('H:i:s');
         
           $array1 = explode(':', $actualtime);
          $array2 = explode(':', $onprocess->order_time);
          $minutes1 = ($array1[0] * 3600.0 + $array1[1]*60.0+$array1[2]);
          $minutes2 = ($array2[0] * 3600.0 + $array2[1]*60.0+$array2[2]);
          $diff = $minutes1 - $minutes2;
          $format = sprintf('%02d:%02d:%02d', ($diff / 3600), ($diff / 60 % 60), $diff % 60);
          ?>
          <p style="margin:0;">
          <label class="text-muted"><?php echo display('before_time');?>:<?php echo  $format;?></label>
        </p>
        
          <div>

            <?php if($onprocess->splitpay_status == 0) { ?>
          <a href="javascript:;" onclick="createMargeorder(<?php echo $onprocess->order_id;?>,1);" class="btn btn-success btn-sm mr-1 mb-1"><?php echo display('cmplt');?></a>
           <a href="javascript:;" onclick="showsplitmodal(<?php echo $onprocess->order_id;?>);" class="btn btn-success btn-sm mr-1  mb-1"><?php echo display('split');?></a>
            <?php if($this->permission->method('ordermanage','delete')->access()){?>
            <a href="javascript:;" data-id="<?php echo $onprocess->order_id;?>" class="btn btn-danger btn-sm mr-1  mb-1 cancelorder" data-toggle="tooltip" data-placement="left" title="" data-original-title="Cancel Order"><i class="fa fa-trash-o"></i></a>&nbsp;
            <?php }?>
            <a href="javascript:;" onclick="createMargeorder(<?php echo $onprocess->order_id;?>,1);" id="addPayment" class="btn btn-success btn-sm mr-1  mb-1" data-toggle="tooltip" data-placement="left" title="" data-original-title="Add Payment">
                <i class="fa fa-window-maximize"></i></a>
                <?php if( $this->session->userdata('role') != "Waiter" ) { ?>
                &nbsp;<a href="javascript:;" onclick="printRawHtml(<?php echo $onprocess->order_id;?>);" class="btn btn-success btn-sm mr-1 due_print  mb-1" data-toggle="tooltip" data-placement="left" title="" data-url="<?php echo base_url("ordermanage/order/dueinvoice/".$onprocess->order_id) ?>" data-original-title="Bill Out">
                    <i class="fa fa-window-restore"></i>
                </a>
              <?php  } ?>
            <?php }
            else{ ?>
               <a href="javascript:;" onclick="showsplitmodal(<?php echo $onprocess->order_id;?>);" class="btn btn-success btn-sm mr-1  mb-1"><?php echo display('split');?></a>
               <br><br>
              <?php
            }?>
             <a href="javascript:;" onclick="printRawHtmlupdate(<?php echo $onprocess->order_id;?>,'kitchen');" class="btn btn-success btn-sm mr-1 due_print  mb-1" data-toggle="tooltip" data-placement="left" title="" data-url="<?php echo base_url("ordermanage/order/dueinvoice/".$onprocess->order_id) ?>" data-original-title="Send to Kitchen/Bar">
                  <i class="fa fa-bell"></i>
              </a>
          </div>
          
      </div>
    </div>
    <?php } }
          else{
           $odmsg=display('no_order_run');
          echo "<p style='padding-left:12px;'>".$odmsg."</p>";
          }
         ?>
  </div>
</div>
<script>
  
  
              $(document).ready(function(){
                $('.search-table-field').select2({
                    placeholder: '<?php echo display('type_slorder') ?>',
                     minimumInputLength: 1,
                  ajax: {
                    url: 'ongoingtable_name',
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                      return {
                        results:  $.map(data, function (item) {
                              return {
                                  text: item.text,
                                  id: item.id
                              }
                          })
                      };
                    },
                    cache: true
                  }
                });
              });
			  $(document).ready(function(){
                $('.search-tablesr-field').select2({
                 	placeholder: '<?php echo display('type_table') ?>',
                  	minimumInputLength: 1,
                  ajax: {
                    url: 'ongoingtablesearch',
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                      return {
                        results:  $.map(data, function (item) {
                              return {
                                  text: item.text,
                                  id: item.id
                              }
                          })
                      };
                    },
                    cache: true
                  }
                });
              });

              function printRawHtmltoken(id,view) {
                  printJS({
                      printable: view,
                      type: 'raw-html',
                      onPrintDialogClose: function () { 
                          $.ajax({
                              type: "GET",
                              url: "postokengenerate/"+id,
                              success: function(data) {
                                
                              printJS({
                                      printable: data,
                                      type: 'raw-html',

                                    });
                              }
                          });
                      }
                  }); 
              }


  
  function printRawHtml(id,view = null) {
           
            $.ajax({
              type: "GET",
              url: '<?php echo base_url("ordermanage/order/dueinvoice/") ?>'+id,
              success: function(data) {
             
                printJS({
                  printable: data,
                  type: 'raw-html',

                });
              }
            });
          
                   
   }
  
  

  function printRawHtmlupdate(view, location = null) {

    

    
        $.ajax({
            url: '<?php echo base_url()?>assets/data/pdf/Token_'+view+'_Kitchen.pdf',
            type: 'HEAD',
            success: function () {
                printService.submit({
                    'type': 'KITCHEN',
                    'url': '<?php echo base_url()?>assets/data/pdf/Token_'+view+'_Kitchen.pdf'
                });
            }
        });

        $.ajax({
            url: '<?php echo base_url()?>assets/data/pdf/Token_'+view+'_Dining.pdf',
            type: 'HEAD',
            success: function () {
                printService.submit({
                    'type': 'DINING',
                    'url': '<?php echo base_url()?>assets/data/pdf/Token_'+view+'_Dining.pdf'
                });
            }
        });

        $.ajax({
            url: '<?php echo base_url()?>assets/data/pdf/Token_'+view+'_Bar.pdf',
            type: 'HEAD',
            success: function () {
                printService.submit({
                    'type': 'BAR',
                    'url': '<?php echo base_url()?>assets/data/pdf/Token_'+view+'_Bar.pdf'
                });
            }
        });

   
}
              function printtoken(ordid,kitid){
                  var dataString = 'orderid='+ordid+'&kid='+kitid;
                  $.ajax({
                      type: "POST",
                      url: "<?php echo base_url()?>ordermanage/order/printtoken",
                      data: dataString,
                      success: function(data){
                          $("#kotenpr").html(data);
                          const style = '@page { margin-top: 0px;font-size:18px; }';
                          printJS({
                              printable: 'kotenpr',
                              onPrintDialogClose: printJobComplete,
                              type: 'html',
                              font_size: '32px;',
                              style: style,
                              scanStyles: false
                          })
                      }
                  });
              }
  
  
            </script> 
