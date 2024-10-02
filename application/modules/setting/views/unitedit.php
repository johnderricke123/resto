<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body">

                    <?php echo form_open('setting/unitmeasurement/create'); ?>

                    <?php echo form_hidden('id', (!empty($unitinfo->id)?$unitinfo->id:null)) ?>
                        <div class="form-group row">
                            <label for="unit_name" class="col-sm-5 col-form-label">Sale Unit/Ingredient *</label>
                            <div class="col-sm-6">
                                <input name="unitname" class="form-control" type="text" placeholder="<?php echo display('unit_name') ?>" id="unitname" value="<?php echo (!empty($unitinfo->uom_name)?$unitinfo->uom_name:null) ?>">
                            </div>
                        </div>
                    <div class="form-group row">
                        <label for="sale_qty" class="col-sm-4 col-form-label">Ingredient Unit *</label>
                        <div class="col-sm-4">
                            <input name="sale_qty" class="form-control" type="text" placeholder="1000" id="ingredient_unitname" value="<?php echo (!empty($unitinfo->sale_qty)?$unitinfo->sale_qty:null) ?>">
                        </div>
                        <div class="col-sm-4">
                            <input name="sale_unit" class="form-control" type="text" id="sale_unit" value="<?php echo (!empty($unitinfo->sale_unit)?$unitinfo->sale_unit:null) ?>" placeholder="mg,gm,ml">
                            <?php
                            //  if(empty($categories)){$categories = array('' => '--Select--');}
                            //  echo form_dropdown('purchase_unit_id',$unitdropdown,(!empty($intinfo->purchase_unit_id)?$intinfo->purchase_unit_id:null),'class="form-control"') ?>
                        </div>
                    </div>

                    <div class="form-group row">
                            <label for="unit_short_name" class="col-sm-5 col-form-label"><?php echo display('unit_short_name') ?></label>
                            <div class="col-sm-6">
                                 <input name="shortname" class="form-control" type="text" placeholder="<?php echo display('unit_short_name') ?>" id="shortname" value="<?php echo (!empty($unitinfo->uom_short_code)?$unitinfo->uom_short_code:null) ?>">
                            </div>
                        </div> 
						<div class="form-group row">
                        <label for="lastname" class="col-sm-5 col-form-label">Status</label>
                        <div class="col-sm-6">
                            <select name="status"  class="form-control">
                                <option value=""  selected="selected">Select Option</option>
                                <option value="1" <?php if(!empty($unitinfo)){if($unitinfo->is_active==1){echo "Selected";}} ?>>Active</option>
                                <option value="0" <?php if(!empty($unitinfo)){if($unitinfo->is_active==0){echo "Selected";}} ?>>Inactive</option>
                              </select>
                        </div>
                    </div>
  
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('update') ?></button>
                        </div>
                    <?php echo form_close() ?>

                </div>  
            </div>
        </div>
    </div>