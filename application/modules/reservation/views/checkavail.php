<input name="sldate" id="sldate" type="hidden" value="<?php echo $newdate;?>" />
<input name="sltime" id="sltime" type="hidden" value="<?php echo $gettime;?>" />
<input name="people" id="people" type="hidden" value="<?php echo $nopeople;?>" />
<?php $color="#004040";
					if(!empty($tableinfo)){
					 foreach($tableinfo as $table){
						/*if($table->status==1){
							$color="#F00";
							}
						else{
							$color="#004040";
							}*/
						?>
                      <input name="url" type="hidden" id="url_<?php echo $table->tableid; ?>" value="<?php echo base_url("reservation/reservation/reservationform") ?>" />
                        <div class="col-sm-4">
                            <div id="seatsA" class="table_tables_item_content" onclick="editreserveinfo('<?php echo $table->tableid; ?>')">
                                <img src="<?php echo base_url(!empty($table->table_icon)?$table->table_icon:'assets/img/icons/table/default.jpg'); ?>" style="height: 60px;width: 60px; cursor:pointer;" class="img-thumbnail"/>

                                <div class="card-body">
                                    <h5 class="card-title"><span class=""><?php echo $table->tablename;?></span></h5>
                                    <p class="card-text"></p>

                                </div>
                            </div>

                        </div>

                        <?php 
						} }
						 else{
							 echo '<div class="col-sm-4"><h2>No Table found!!!</h2></div>';
							 }
						  ?>