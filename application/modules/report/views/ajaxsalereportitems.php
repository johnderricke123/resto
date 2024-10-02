<style type="text/css">
        @media print {
            a[href]:after {
                content: none !important;
            }
        }
  
                          .grid-container {
                            display: grid;
                            grid-template-columns: auto auto auto auto;
                            background-color: #0000;
                            padding: 10px;
                        }

                        .grid-item {
                            background-color: rgba(255, 255, 255, 0.8);
                            border: 1px solid rgba(0, 0, 0, 0.8);
                            padding: 5px;
                            font-size: 15px;
                            text-align: center;
                        }

    </style>






<div class="table-responsive">
<table class="table table-bordered table-striped table-hover" id="respritbl">
			                        <thead>
										<tr>

											<th><?php echo $name; ?></th>
											<?php if($name=="Items Name"){?>
                                            <th><?php echo "Variant Name"; ?></th>
											<th><?php echo "Quantity"; ?></th>
											<?php }?>
                                            <th><?php echo "Total amount"; ?></th>
                                          <th class="col-1"><?php echo "Action"; ?></th>
											
										</tr>
									</thead>
									<tbody>
									<?php 
									$totalprice=0;
									if($items) { 
										if($name == "Items Name"){
									foreach($items as $item){
										if($item->isgroup==1){
											$isgrouporid="'".implode("','",$allorderid)."'";
											$condition="order_id IN($isgrouporid) AND groupmid=$item->groupmid AND groupvarient=$item->groupvarient";
											$sql="SELECT  DISTINCT(groupmid) as menu_id,qroupqty,isgroup FROM order_menu WHERE {$condition} AND isgroup=1 Group BY order_id";
											$query=$this->db->query($sql);
											$myqtyinfo=$query->result();
											$mqty=0;
											foreach($myqtyinfo as $myqty){
												$mqty=$mqty+$myqty->qroupqty;
											}
											$itemqty=$mqty;
											$totalprice=$totalprice+($itemqty*$item->price);
											}
										else{
											$itemqty=$item->totalqty;
										$totalprice=$totalprice+($item->totalqty*$item->price);
										}
									?>
											<tr>
																					
                                                <td><?php echo $item->ProductName;?></td>
                                                <td><?php echo $item->variantName;?></td>
												<td><?php echo $itemqty;?></td>
												<td style="text-align: right;"><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php 
                                      $item_price = $itemqty*$item->price;
                                      echo number_format($item_price, 2);?> <?php if($currency->position==2){echo $currency->curr_icon;}?></td>
												
											</tr>
                                      
                                      
                                      
                                      
                                      
                                      
                                      
                                      
                                      
                                      
                                      
									<?php }
									}
									else{
                                      
                                      
                                      

                                      
                                      
                                      
                                      
                                      
                                      
										foreach($items as $item){ ?>
                                      
                                      
                                                                                        

<!-- Modal -->
<div id='GFG<?php echo $item->id ?>'>

    <div id="myModal<?php echo $item->id ?>" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Transaction logs </h4>
                </div>
                <div class="modal-body">

                    <style>
                        .grid-container {
                            display: grid;
                            grid-template-columns: auto auto auto auto;
                            background-color: #0000;
                            padding: 10px;
                        }

                        .grid-item {
                            background-color: rgba(255, 255, 255, 0.8);
                            border: 1px solid rgba(0, 0, 0, 0.8);
                            padding: 5px;
                            font-size: 15px;
                            text-align: center;
                        }
                    </style>

                    <!-- <button onClick="printdiv('printable_div_id');">PRINT</button> -->
                    <input type="button" value="Print" onclick="printDiv<?php echo $item->id ?>()">

                    <!-- Script to print the content of a div -->
                    <script>
                        function printDiv<?php echo $item->id ?>() {
                            var divContents = document.getElementById("GFG<?php echo $item->id ?>").innerHTML;
                            var a = window.open('', '', 'height=500, width=500');
                            a.document.write('<html>');
                            a.document.write('<body > <h1>DCCCO Fine Dining  <br>');
                            a.document.write(divContents);
                            a.document.write('</body></html>');
                            a.document.close();
                            a.print();
                        }
                    </script>

                    <?php
                    $restodb = $this->load->database('default', TRUE);
                    $restodb->select('*');
                    $restodb->where('create_by', $item->create_by);
                    $restodb->where("create_date BETWEEN '$start_date' AND '$end_date'", NULL, FALSE);
                    $restodb->from('bill');
                    $restodb->join('payment_method z', 'z.payment_method_id = bill.payment_method_id', 'left');
                    $restodb->join('customer_order b', 'bill.order_id = b.order_id', 'left');
                    $query = $restodb->get();


                    //var_dump($query->result());
                    $grand_total_amount = 0;
                    if ($query->num_rows() > 0) {
                        $result = $query->result();  // Fetch data as objects
                        // Alternatively, you can use $result = $query->result_array(); to fetch data as arrays
                    ?>

                        <?php foreach ($result as $row) {



                            if ($row->create_date) {
                        ?>

                                <?php
                                // Access individual columns
                                $create_by = $row->create_by;
                                $total_amount = $row->total_amount;

                                $grand_total_amount = $grand_total_amount + $total_amount;
                                $payment_method = $row->payment_method;
                                $sales_invoice = $row->saleinvoice;
                                // Access other columns as needed

                                // Do something with the data, e.g., echo or process it
                                //echo "Cashier: " . $create_by . "<br>";
                                ?>

                                <div class="grid-container">
                                    <div class="grid-item">
                                        <p>Sales Invoice: <?php echo $sales_invoice; ?></p>
                                    </div>
                                    <div class="grid-item">
                                        <p>Total amount: <?php echo $total_amount ?></p>
                                    </div>
                                    <div class="grid-item">
                                        <p>Payment method: <?php echo $payment_method ?></p>
                                    </div>
                                    <div class="grid-item">
                                        <p>Date of transaction: <?php echo $row->create_date ?></p>
                                    </div>
                                </div>





                            <?php

                                //echo "_________________"."<br>";
                            }
                            ?>

                            <!-- <hr -->




                        <?php } ?>
                    <?php
                    } else {
                        echo "No data found";
                    }
                    ?>




                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

</div>
<!-- modal -->

                                      
                                      
                                      
                                      <?php
										//$totalprice=$totalprice+$item->totalamount
                                         $totalprice=$totalprice+$total_amount
									?>
											<tr>
																					
                                                <td><?php echo $item->ProductName.$item->firstname." ".$item->lastname;?></td>
												
												<td style="text-align: right;"><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php $total_income += $grand_total_amount;  echo number_format($grand_total_amount, 2);?> <?php if($currency->position==2){echo $currency->curr_icon;}?></td>
                                              <td>
												
                                                <!-- <button type="button" title="View Transactions" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal<?php echo $item->id ?>"><i class="fas fa-eye"></i>View</button> -->


<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal<?php echo $item->id ?>">
 <i class="fas fa-eye"></i> View
</button>
                                                
                                                
                                              </td>
												
											</tr>

<?php foreach($items as $item){  ?>                              


          <?php } ?>



  
                                    

                                      
										<?php 
										} 
									}
									}
									?>
									</tbody>
									<tfoot>
										<tr>
											<td colspan="<?php if($name=="Items Name"){ echo 3;}else{ echo 1;}?>" align="right" style="text-align:right;font-size:14px !Important">&nbsp; <b><?php echo display('total_sale') ?> </b></td>
											<!-- <td style="text-align: right;"><b><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo number_format($totalprice, 2);?> <?php if($currency->position==2){echo $currency->curr_icon;}?></b></td> -->
                                          <td style="text-align: right;"><b><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo number_format($total_income, 2);?> <?php if($currency->position==2){echo $currency->curr_icon;}?></b></td>
                                          
                                          
										</tr>
									</tfoot>
			                    </table>
  
  
  
  
            <?php 
	          //var_dump($query->result());die();
//foreach($items as $item){
//  var_dump($item->id);
//}

//$i = 0;
//foreach ($items as $item) {
//   echo $item->saleinvoice;
// var_dump($item);
//  $i++;
//}
//echo "Loop ran $i times"; // This will show you how many times the loop iterated

//var_dump($item);
//var_dump($start_date);
//echo $total_income;
          ?>
  
  


  <!-- modal Final -->
<!-- test -->
<style>
    #printHeader {
        text-align: center;
    }
</style>

<?php foreach ($items as $item) { ?>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal<?php echo $item->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel<?php echo $item->id ?>" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel<?php echo $item->id ?>">Transaction Logs</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="form-control">
                    <input type="button" class="btn btn-primary btn-md" value="Print" onclick="printDiv<?php echo $item->id ?>()">
                </div>

                <div class="modal-body" id='divPrint<?php echo $item->id ?>'>


                    <?php
                    $restodb = $this->load->database('default', TRUE);
                    $restodb->select('*');
                    $restodb->where('create_by', $item->create_by);
                    $restodb->where("create_date BETWEEN '$start_date' AND '$end_date'", NULL, FALSE);
                    $restodb->from('bill');
                    $restodb->join('payment_method z', 'z.payment_method_id = bill.payment_method_id', 'left');
                    $restodb->join('customer_order b', 'bill.order_id = b.order_id', 'left');
                    $query = $restodb->get();


                    //var_dump($query->result());
                    $grand_total_amount = 0;
                    if ($query->num_rows() > 0) {
                        $result = $query->result();  // Fetch data as objects
                        // Alternatively, you can use $result = $query->result_array(); to fetch data as arrays
                    ?>
                        <?php $q = 1; ?>

                        <style>
                          table, th, td {
                            border: 1px solid;
                          }
                          

                            
                        </style>

                  <div class="d-flex justify-content-center">
                    
                        <table class="table table-striped" id="myTable" style="margin-left: auto; margin-right: auto;">
                            <thead>
                                <tr class="hideHeader">
                                    <th scope="col">#</th>
                                    <th scope="col">Sales Invoice</th>
                                    <th scope="col">Total amount</th>
                                    <th scope="col">Payment method</th>
                                    <th scope="col">Date of transaction</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($result as $row) {



                                    if ($row->create_date) {
                                ?>

                                        <?php
                                        // Access individual columns
                                        $create_by = $row->create_by;
                                        $total_amount = $row->total_amount;

                                        $grand_total_amount = $grand_total_amount + $total_amount;
                                        $payment_method = $row->payment_method;
                                        $sales_invoice = $row->saleinvoice;
                                        // Access other columns as needed

                                        // Do something with the data, e.g., echo or process it
                                        //echo "Cashier: " . $create_by . "<br>";
                                        ?>




                                        <tr>
                                            <th class="float-right" scope="row"><?php echo $q++; ?></th>
                                            <td class="float-right">
                                                <center><?php echo $sales_invoice; ?></center>
                                            </td>
                                            <td class="float-right">
                                                <center><?php echo $total_amount ?></center>
                                            </td>
                                            <td class="float-right">
                                                <center><?php echo $payment_method ?></center>
                                            </td>
                                            <td class="float-right">
                                                <center><?php echo $row->create_date ?></center>
                                              	
                                            </td>

                                        </tr>




                                    <?php

                                        //echo "_________________"."<br>";
                                    }
                                    ?>

                                    <!-- <hr -->




                                <?php } ?>
                            </tbody>
                        </table>
</div>

                    <?php
                    } else {
                        echo "No data found";
                    }
                    ?>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>




    <script>
        function printDiv<?php echo $item->id ?>() {
            var divContents = document.getElementById("divPrint<?php echo $item->id ?>").innerHTML;
            var a = window.open('', '', 'height=500, width=500');
            a.document.write('<html>');
            a.document.write('<body ><p> <h1 class="printHeader"><center>DCCCO Fine Dining</center></h1><br> <center>Lukewright Street, Dumaguete City, Negros Oriental 6200, PH  </center> <br> <center> <?php echo "Print Date" ?>: <?php echo date("m/d/Y h:i:s"); ?> </center> <br> <center> <?php echo $item->ProductName.$item->firstname." ".$item->lastname;?> </center> </p>');

            a.document.write(divContents);
            a.document.write('</body></html>');
            a.document.close();
            a.print();
        }
    </script>

<?php } ?>
<!-- test -->
<!-- modal Final -->

  
  
</div>                                