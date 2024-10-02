<!-- Add this to the head of your HTML document -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />



<?= form_open('reservation/reservation/create') ?>
                    <?php echo form_hidden('reserveid', (!empty($intinfo->reserveid)?$intinfo->reserveid:null)) ?>
                        <div class="form-group row">
                        <label for="tableid" class="col-sm-4 col-form-label"><?php echo "Table No."; ?>*</label>
                        <div class="col-sm-8 customesl">
                        <?php echo $tableno;?>
                        <input name="tableid" type="hidden" value="<?php echo $tableno;?>" />
                        </div>
                    </div>
                       <div class="form-group row">
                        <label for="tablicapacity" class="col-sm-4 col-form-label"><?php echo "No. of People"; ?>*</label>
                        <div class="col-sm-8 customesl">
                        <?php echo $nopeople;?>
                        <input name="tablicapacity" class="form-control" type="hidden" id="tablicapacity" value="<?php echo $nopeople;?>">
                        </div>
                    </div> 
                        <div class="form-group row">
                            <label for="bookdate" class="col-sm-4 col-form-label"><?php echo display('date') ?> *</label>
                            <div class="col-sm-8">
                            	 <?php echo $newdate;?>
                                <input name="bookdate" class="form-control" type="hidden" id="bookdate" value="<?php echo $newdate;?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bookfromtime" class="col-sm-4 col-form-label"><?php echo display('s_time') ?> *</label>
                            <div class="col-sm-8">
                             <?php echo $gettime;?>
                                <input name="bookfromtime" class="form-control" type="hidden" id="booktime" value="<?php echo $gettime;?>">
                            </div>
                        </div>
                        
                        
                        <div class="form-group row">
                            <label for="bookendtime" class="col-sm-4 col-form-label"><?php echo display('e_time') ?> *</label>
                            <div class="col-sm-8">
                                <input name="bookendtime" class="form-control timepicker" type="text" placeholder="<?php echo display('e_time') ?>" id="booktime" value="<?php echo $endtime;?>">
                            </div>
                        </div>

<!---
					<div class="form-group row">
                        <label for="customer_name" class="col-sm-4 col-form-label"><?php echo display('name') ?>*</label>
                        <div class="col-sm-8">
                        <input name="customer_name" class="form-control" type="text" id="customer_name" value="<?php if(!empty($customerinfo)){ echo $customerinfo->customer_name;}?>" placeholder="<?php echo display('name') ?>">
                        <?php //echo form_dropdown('customer_name',$customerlist,(!empty($customerlist->CategoryID)?$customerlist->CategoryID:null),'class="postform resizeselect form-control" id="customer_name" required') ?>
                        </div>
                    </div>
-->


<!-- newly added -->

      <!--<select class="form-select" aria-label="Default select example">
            <option value="<?php echo $customerNamesDrop[0]->customer_id ?>" name="customer_id" selected><?php echo $customerNamesDrop[0]->customer_name ?></option>
         <?php foreach($customerNamesDrop as $cnd){ ?>
          <option value="<?php echo $cnd->customer_id; ?>" name="customer_id" ><?php echo $cnd->customer_name; ?></option>
        <?php } ?>
      </select> -->
<!--<div class="form-group row">
  
<div class="col-form-label">
	<label for="name" class="col-sm-4 col-form-label"><?php echo "Select a name"; ?> *</label>  
</div>
<div class="col-sm-4">
    <select class="form-select" aria-label="Default select example" name="customer_id">
        <?php foreach($customerNamesDrop as $cnd){ ?>
            <option value="<?php echo $cnd->customer_id; ?>" <?php if ($cnd->customer_id == $selectedCustomerId) echo 'selected'; ?>>
                <?php echo $cnd->customer_name; ?>
            </option>
        <?php } ?>
    </select>
  
</div>
</div>  -->


<div class="form-group row">
    <div class="col-form-label">
        <label for="name" class="col-sm-4 col-form-label"><?php echo "Select a name"; ?> *</label>
    </div>
    <div class="col-sm-8">
        <select class="form-select" aria-label="Default select example" name="customer_id" id="customerSelect">
            <?php foreach($customerNamesDrop as $cnd): ?>
                <option value="<?php echo $cnd->customer_id; ?>" <?php if ($cnd->customer_id == $selectedCustomerId) echo 'selected'; ?>>
                    <?php echo $cnd->customer_name; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    // Initialize Select2 on the dropdown
    $(document).ready(function() {
        $('#customerSelect').select2();
    });
</script>



<!-- newly added -->

                        <div class="form-group row">
                        <label for="customer_name" class="col-sm-4 col-form-label"><?php echo display('mobile') ?>*</label>
                        <div class="col-sm-8">
                        <input name="mobile" class="form-control" type="text" id="mobile" value="<?php if(!empty($customerinfo)){ echo $customerinfo->customer_phone;}?>" placeholder="<?php echo display('mobile') ?>">
                        </div>
                    </div>
                        <div class="form-group row">
                        <label for="customer_name" class="col-sm-4 col-form-label"><?php echo display('email') ?>*</label>
                        <div class="col-sm-8">
                        <input name="email" class="form-control" type="text" id="email" value="<?php if(!empty($customerinfo)){ echo $customerinfo->customer_email;}?>" placeholder="<?php echo display('email') ?>">
                        </div>
                    </div>


<!-- newly added -->
                         <div class="form-group row">
                        <label for="event_name" class="col-sm-4 col-form-label">Event Name*</label>
                        <div class="col-sm-8">
                        <input name="event_name" class="form-control" type="text" id="event" value="<?php echo $customerinfo->event_name; ?>" placeholder="Event Name" required>
                        </div>
                    </div>

						<div class="form-group row">
                        <label for="company_name" class="col-sm-4 col-form-label">Company Name*</label>
                        <div class="col-sm-8">
                        <input name="company_name" class="form-control" type="text" id="company_name" value="<?php echo $customerinfo->company_name; ?>" placeholder="Company Name">
                        </div>
                    </div>


						<div class="form-group row">
                        <label for="meal" class="col-sm-4 col-form-label">Meal*</label>
                        <div class="col-sm-8">
                        <input name="meal" class="form-control" type="text" id="meal" value="<?php echo $customerinfo->company_name; ?>" placeholder="Meal">
                        </div>
                    </div>

                  
                  		<div class="form-group row">
                        <label for="down_payment" class="col-sm-4 col-form-label">Down Payment</label>
                        <div class="col-sm-8">
                        <input name="down_payment" class="form-control" type="number" step="0.01" id="down_payment" value="<?php echo $customerinfo->down_payment; ?>" placeholder="Down Payment">
                        </div>
                    </div>
                  
                  
                        <div class="form-group row">
                        <label for="ar_or" class="col-sm-4 col-form-label">Ar/Or</label>
                        <div class="col-sm-8">
                        <input name="ar_or" class="form-control" type="text" id="ar_or" value="<?php echo $customerinfo->ar_or; ?>" placeholder="AR/OR">
                        </div>
                    </div>

                        <div class="form-group row">
                        <label for="grand_total" class="col-sm-4 col-form-label">Grand Total</label>
                        <div class="col-sm-8">
                        <input name="grand_total" class="form-control" type="number" step="0.01" id="grand_total" value="<?php echo $customerinfo->grand_total; ?>" placeholder="Grand Total">
                        </div>
                    </div>

<!-- newly added -->


						<div class="form-group row">
                        <label for="lastname" class="col-sm-4 col-form-label">Status</label>
                        <div class="col-sm-8 customesl">
                            <select name="status" class="form-control">
                                <option value=""  selected="selected">Select Option</option>
                                <option value="2">Booked</option>
                                <option value="1">Realease</option>
<!-- newly added -->
            <option value="3" <?php if(!empty($intinfo)){if($intinfo->status==3){echo "Selected";}} ?>>Tentative</option>
<!-- newly added -->
                              </select>
                        </div>
                    </div>
  
                        <div class="form-group text-right">
                            <button type="reset" class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                            <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('Ad') ?></button>
                        </div>
                    <?php echo form_close();?>