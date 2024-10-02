<div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h3 style="padding:0; margin:0;" >Current Register <span id="rpth">( <?php echo $newDate = date("d M, Y H:i", strtotime($registerinfo->opendate));?> - <?php echo date('d M, Y H:i')?> )</span> </h3></div>
<div class="modal-body">
        <div class="row">
          <div class="col-sm-12 col-md-12">
            <div class="panel">
              <div class="panel-body">
              <input name="counter" id="pcounter" type="hidden" value="<?php echo $registerinfo->counter_no;?>" />
              <input name="user" id="puser" type="hidden" value="<?php echo $userinfo->firstname.' '.$userinfo->lastname;?>" />
              <table class="table-bordered table-striped table-hover d-none" style="display:none;">
                        <thead>
                            <tr>
                                <th align="left"><?php echo display('sl_no') ?></th>
                                <th align="left"><?php echo display('payment_type') ?></th>
                                <th align="right"><?php echo display('total_price') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php  $total=0;
							if (!empty($totalamount)){ 
							 $sl = 1; 
							 foreach ($totalamount as $amount) { 
							 $total=$total+$amount->totalamount;
							?>
                            <tr>
                                <td><?php echo $sl++; ?></td>
                                <td><?php echo $amount->payment_method; ?></td>
                                <td align="right"><?php echo number_format($amount->totalamount,3); ?></td>
                            </tr>
							<?php  }  ?>
                            
                            <?php  }  ?>
                        </tbody>
                        <tfoot>
                            <td align="right" colspan="2"><?php echo display('total') ?>:</td>
                            <td align="right"><?php echo number_format($total,3); ?></td>
                        </tfoot>
                    </table>
                <form action="" method="post" name="cashopen" id="cashopenfrm">
                <input type="hidden" id="registerid" name="registerid" value="<?php echo $registerinfo->id;?>" />
                <div class="col-md-12" >
                  <div class="form-group row" style="display:none;">
                    <label for="4digit" class="col-sm-4 col-form-label"><?php echo display('total_amount');?></label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="totalamount" name="totalamount" value="<?php echo number_format($total,2, '.', ''); ?>"/>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="4digit" class="col-sm-4 col-form-label"><?php echo "Enter Closing Amount";?></label>
                    <div class="col-sm-7">
                      <!-- <textarea id="closingnote" class="form-control" name="closing_note" cols="30" rows="3" placeholder="Enter Closing Amount" required></textarea> --->                    							
                      <input type="text" class="form-control" id="closing_note" name="closing_note"  required>
                    </div>
                  </div>
                  <div class="form-group text-center">
                    <div class="col-sm-11" style="padding-right:0;">
                      <button type="button" id="openclosecash" class="btn btn-success w-md m-b-5" onclick="closecashregister()"><?php echo display('add_closing_balance');?></button>
                    </div>
                  </div>
                </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>


<script>
  
 $('#openclosecash').prop('disabled', true); 
  
$('input#closingnote').keyup (function(){ 
  

  console.log($(this).val());
  if ($(this).val() ) { 
    $('#openclosecash').prop('disabled', false); 
  } 
  else {   
    $('#openclosecash').prop('disabled', true); 
  } 
});

</script>