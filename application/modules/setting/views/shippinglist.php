<div class="form-group text-right">
 <?php if($this->permission->method('setting','create')->access()): ?>
<button type="button" class="btn btn-primary btn-md" data-target="#add0" data-toggle="modal"  ><i class="fa fa-plus-circle" aria-hidden="true"></i>
<?php echo display('shipping_add')?></button> 
<?php endif; ?>

</div>
<div id="add0" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <strong><?php echo display('shipping_add');?></strong>
            </div>
            <div class="modal-body">
           
<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body">

                    <?= form_open('setting/shippingmethod/create') ?>
                    <?php echo form_hidden('ship_id', (!empty($intinfo->ship_id)?$intinfo->ship_id:null)) ?>
                        <div class="form-group row">
                            <label for="shipping" class="col-sm-5 col-form-label"><?php echo display('shipping_name') ?> *</label>
                            <div class="col-sm-7">
                                <input name="shipping" class="form-control" type="text" placeholder="Add <?php echo display('shipping_name') ?>" id="shipping" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="shippingrate" class="col-sm-5 col-form-label"><?php echo display('shippingrate') ?> *</label>
                            <div class="col-sm-7">
                                <input name="shippingrate" class="form-control" type="text" placeholder="Add <?php echo display('shippingrate') ?>" id="shippingrate" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                        <label for="status" class="col-sm-5 col-form-label">Shipping Type</label>
                        <div class="col-sm-7 customesl">
                            <select name="status" class="form-control">
                                <option value=""  selected="selected">Select Option</option>
                                <option value="1">Home</option>
                                <option value="2">Pick Up</option>
								<option value="3">Dine-IN</option>
                              </select>
                        </div>
                    </div>
						<div class="form-group row">
                        <label for="status" class="col-sm-5 col-form-label">Status</label>
                        <div class="col-sm-7 customesl">
                            <select name="status" class="form-control">
                                <option value=""  selected="selected">Select Option</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                              </select>
                        </div>
                    </div>
  
                        <div class="form-group text-right">
                            <button type="reset" class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                            <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('Ad') ?></button>
                        </div>
                    <?php echo form_close() ?>

                </div>  
            </div>
        </div>
    </div>
             
    
   
    </div>
     
            </div>
            <div class="modal-footer">

            </div>

        </div>

    </div>

<div id="edit" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <strong><?php echo display('shipping_edit');?></strong>
            </div>
            <div class="modal-body editinfo">
            
    		</div>
     
            </div>
            <div class="modal-footer">

            </div>

        </div>

    </div>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="panel panel-default thumbnail"> 

            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('Sl') ?></th>
                            <th><?php echo display('shipping_name') ?></th>
                            <th><?php echo display('shippingrate') ?></th>
                            <th><?php echo display('status') ?></th>
                            <th><?php echo display('action') ?></th> 
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($shippinglist)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($shippinglist as $shipping) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $shipping->shipping_method; ?></td>
                                    <td><?php echo $shipping->shippingrate; ?></td>
                                    <td><?php if($shipping->is_active==1){echo "Active";}else{echo "Inactive";} ?></td>
                                   <td class="center">
                                    <?php if($this->permission->method('setting','update')->access()): ?>
                                    <input name="url" type="hidden" id="url_<?php echo $shipping->ship_id; ?>" value="<?php echo base_url("setting/shippingmethod/updateintfrm") ?>" />
                                        <a onclick="editinfo('<?php echo $shipping->ship_id; ?>')" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Update"><i class="fa fa-pencil" aria-hidden="true"></i></a> 
                                         <?php endif; 
										 if($this->permission->method('setting','delete')->access()): ?>
                                        <a href="<?php echo base_url("setting/shippingmethod/delete/$shipping->ship_id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="right" title="Delete "><i class="fa fa-trash-o" aria-hidden="true"></i></a> 
                                         <?php endif; ?>
                                    </td>
                                    
                                </tr>
                                <?php $sl++; ?>
                            <?php } ?> 
                        <?php } ?> 
                    </tbody>
                </table>  <!-- /.table-responsive -->
            </div>
        </div>
    </div>
</div>

     
