<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body">

                    <?php echo form_open('setting/ingradient/create'); ?>

                    <?php echo form_hidden('id', (!empty($intinfo->id)?$intinfo->id:null)) ?>
                        <div class="form-group row">
                          <label for="lastname" class="col-sm-5 col-form-label">Unit Sale/Ingredients *</label>
                          <div class="col-sm-6 customesl">
                          <?php 
                          if(empty($categories)){$categories = array('' => '--Select--');}
                          echo form_dropdown('unitid',$unitdropdown,(!empty($intinfo->uom_id)?$intinfo->uom_id:null),'class="form-control"') ?>
                          </div>
                    	</div>
                  <div class="form-group row">
                       	<label for="lastname" class="col-sm-5 col-form-label">Purchase Unit *</label>
                              <div class="col-sm-6 customesl">
                              <?php 
                              if(empty($categories)){$categories = array('' => '--Select--');}
                              echo form_dropdown('purchase_unit_id',$unitdropdown,(!empty($intinfo->purchase_unit_id)?$intinfo->purchase_unit_id:null),'class="form-control"') ?>
                              </div>
                    	</div>
                  		<div class="form-group row">
                              <label for="lastname" class="col-sm-5 col-form-label">Pkg. Unit </label>
                               <div class="col-sm-6">
                                <input name="qty_unit" class="form-control" type="number"   min="1" max="1000000" id="qty_unit" step="any" value="<?php echo (!empty($intinfo->qty_unit)?$intinfo->qty_unit:null) ?>">
                            </div>
                  		</div>
                        <div class="form-group row">
                            <label for="unit_name" class="col-sm-5 col-form-label"><?php echo display('ingredient_name') ?> *</label>
                            <div class="col-sm-6">
                                <input name="ingredientname" class="form-control" type="text" placeholder="<?php echo display('ingredient_name') ?>" id="unitname" value="<?php echo (!empty($intinfo->ingredient_name)?$intinfo->ingredient_name:null) ?>">
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="min_stock" class="col-sm-5 col-form-label"><?php echo display('stock_limit') ?> *</label>
                            <div class="col-sm-6">
                                <input name="min_stock" class="form-control" type="text" placeholder="<?php echo display('stock_limit') ?>" id="unitname" value="<?php echo (!empty($intinfo->min_stock)?$intinfo->min_stock:null) ?>">
                            </div>
                        </div>
						<div class="form-group row">
                        <label for="lastname" class="col-sm-5 col-form-label">Status</label>
                        <div class="col-sm-6">
                            <select name="status"  class="form-control">
                                <option value=""  selected="selected">Select Option</option>
                                <option value="1" <?php if(!empty($intinfo)){if($intinfo->is_active==1){echo "Selected";}} ?>>Active</option>
                                <option value="0" <?php if(!empty($intinfo)){if($intinfo->is_active==0){echo "Selected";}} ?>>Inactive</option>
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